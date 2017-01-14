<?php
/**
 * Projet : gestassophp_sa [GestAssoPhp+Pg]
 * ---------------------------
 * Licence Creative Commons selon les termes du présent contrat appelé Contrat Public Creative Commons 
 * Auteur original : Jean-Claude Etiemble
 * @link :  http://creativecommons.org/licenses/by-sa/2.0/fr/  - Paternité - Partage à l'Identique 2.0 France (CC BY-SA 2.0)
 * ---------------------------
 *	
 * @author : JC Etiemble - http://jc.etiemble.free.fr
 * @version :  2017
 * @copyright 2007-2017  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */
 
/**
 *  Directory :  /ROOT_DIR_GESTASSO/adherent/
 *   Fichier : gerer_fiche_adht
 *  Affiche les détails de la fiche Mon Récapitulatif et  Informations personnelles de l'ahérent et permet les modifications
*/

include_once '../config/connexion.php';
$masession = new sessions(); // -->la classe session //session_start();
// Raz  du tri		
$_SESSION['tri']=1; // par pour avoir colone 1 = Nom adherents sur liste // Par défaut =0
$_SESSION['tri_sens']=0; // pour avoir liste triée par 1--> 100 ou a-->z;

// Si pas de session ...	
$sessionadherent=(empty($_SESSION['ses_id_adht'])) ? $sessionadherent='' :$sessionadherent = $_SESSION['ses_id_adht'];

// on récupère le login et le password correspondant au numéro de session en cours	
$logpass=$masession->verifie_LogingPaswd_bd($sessionadherent);
$log = $logpass[0];
$pas = $logpass[1];
	
// vérification de l'authenticité du visiteur		
if (($sessionadherent) && $log == ($_SESSION['ses_login_adht']) && $pas == ($_SESSION['ses_paswd_adht'])) {	
/***** ici commence le code en cas d'authentification */	

	$priorite_adht = $_SESSION['ses_priorite_adht'];
	$prenom_adht = $_SESSION['ses_prenom_adht']; //  pour affichage
	$nom_adht = $_SESSION['ses_nom_adht'] ; //  pour affichage

	// Raz de variables
	$id_adht = ''; //RAZ	
	$indice = '' ;
	//Tableau xpour affichage
	$adherent=array(); // pour affichage adherent
	// initialisation
	$affiche_message = '';
	$date_du_jour=date('Y-m-d');// la date du jour	//Pour définir la différence entre 2  dates	
	

	/*****  Si ADMINISTRATEUR donc $priorite_adht >4  DROIT DE CONSUTER ET MODIFIER   */
	if (($priorite_adht > 4) && get_post_variable_numeric('id_adht', '') )  {
		$id_adht = get_post_variable_numeric('id_adht', '');// l'id de la personne de la fiche infogénérales
	} else {
		$id_adht = $sessionadherent;	
	}


/***** SI REACTIVATION DE LA FICHE */
	// gerer_fiche_adht.php?reactiv_adht=1&id_adht=62
	$reactiv_adht = get_post_variable_numeric('reactiv_adht', '');
	$id_adht_reactiv = get_post_variable_numeric('id_adht', '');		
	if ( ($reactiv_adht == 1) && ($id_adht_reactiv) ) {
		// on remet Date_sortie à 0 , datemodiffiche_adht  et datecreationfiche_adht = date du jour  Et on modifie soc_adht=''
		$req_ecrit_reactiv_adht=("UPDATE ".TABLE_ADHERENTS." SET soc_adht='', "
		." datecreationfiche_adht='$date_du_jour',"
		//." datemodiffiche_adht='$date_du_jour', date_sortie='0000-00-00'" // Null Remplace pour postgresql
		." datemodiffiche_adht='$date_du_jour', date_sortie=NULL "
		." WHERE id_adht='$id_adht_reactiv'"); 
		$dbresult = $db->Execute($req_ecrit_reactiv_adht);	
	
		$affiche_message ='-&nbsp;<span class="TexterougeGras">'._LANG_MESSAGE_FICHE_REACT.'</span>';
		//ecrit qui a fait la manip			
		$ecritlog = $masession->write_log('Reactivation_Adht : '
		.$id_adht_reactiv,$masession->get_var_session('ses_nom_adht').' '
		.$masession->get_var_session('ses_prenom_adht'));
	}

/***** FIN SI REACTIVATION DE LA FICHE */

/***** Pour affichage de la fiche  Mon Récapitulatif et  Informations personnelles */		
	// On lit la table adherent
    $req_lire_perso_adht = "SELECT soc_adht, civilite_adht, nom_adht, prenom_adht, adresse_adht,"
	." cp_adht, ville_adht, telephonef_adht, telephonep_adht, telecopie_adht, email_adht,"
	." datecreationfiche_adht, antenne_adht,datenaisance_adht,"
//	." (TO_DAYS(NOW())-TO_DAYS(datenaisance_adht))/365 AS age,
	." visibl_adht, datemodiffiche_adht," 
	." datemodiffiche_adht,"
	." disponib_adht, " 
	." profession_adht, autres_info_adht," // ajout V 7
	." siteweb_adht, password_adht, login_adht, date_echeance_cotis, date_sortie, "
	." tranche_age, qui_enrg_adht, nom_type_antenne, promotion_adht " 
	." FROM  ".TABLE_ADHERENTS.", ".TABLE_ANTENNE." WHERE " 
	." id_adht='$id_adht' AND antenne_adht=id_type_antenne "; 
	$dbresult = $db->Execute($req_lire_perso_adht);		
	

	while (($adherent = $dbresult->FetchRow())) {
		// on crée le tableau $adherent['champ de la table']
		$qui_enrg_adht = $adherent['qui_enrg_adht']; 		
		// modification affichage dates
		$adherent['datecreationfiche_adht'] = switch_sqlFr_date($adherent['datecreationfiche_adht']); 			
		$adherent['datemodiffiche_adht'] = switch_sqlFr_date($adherent['datemodiffiche_adht']); 
		$adherent['age']= age($adherent['datenaisance_adht']); // pour calcul age
		$adherent['datenaisance_adht'] = switch_sqlFr_date($adherent['datenaisance_adht']); 
//		$adherent['nom_type_antenne'] = stripslashes($adherent['nom_type_antenne']); ////SI magic_quotes_gpc	est à On

// vérification  de la date de cotisationenregistrée dans la table  ADHERENTS	(la date de la derniere Cotis modifiée)
// Il faut afficher TOUTES les cotis en cours vérifier date de fin .... id_adhtasso, cotis
	$req_lire_info_cotis = "SELECT id_cotis,id_adhtasso,id_type_cotis,"
	."date_debut_cotis,date_fin_cotis,"
	." nom_type_cotisation" // TABLE_TYPE_COTISATIONS
	." FROM ".TABLE_COTISATIONS.", ".TABLE_TYPE_COTISATIONS 
	." WHERE id_adhtasso ='$id_adht' AND ".TABLE_COTISATIONS.".cotis= '' "
	." AND ".TABLE_TYPE_COTISATIONS.".id_type_cotisation=".TABLE_COTISATIONS.".id_type_cotis";		
	$dbresult_cotis = $db->Execute($req_lire_info_cotis);	
	
		while ($dbresult && $row = $dbresult_cotis->FetchRow()) {		
			$cotis_adht[$indice]['id_adhtasso'] = $row['id_adhtasso'];	
			$cotis_adht[$indice]['nom_type_cotisation'] = $row['nom_type_cotisation'];// 
			$cotis_adht[$indice]['date_debut_cotis'] = switch_sqlFr_date($row['date_debut_cotis']);
			$cotis_adht[$indice]['date_fin_cotis'] = switch_sqlFr_date($row['date_fin_cotis']);
			if (( compare_date($date_du_jour ,  ($row['date_fin_cotis']) ) )== FALSE) {
				//Retourne vrai si la date 1 est inférieure ou égale à la date 2, sinon retourne faux. 			
					$cotis_adht[$indice]['date_fin_cotis'] = '<span class="TexterougeGras" title="Cotisation échue">'
					.$cotis_adht[$indice]['date_fin_cotis'].'</span>';
					$cotis_adht[$indice]['nom_type_cotisation'] = '<span class="Texterouge" title="Cotisation échue">'
					.$cotis_adht[$indice]['nom_type_cotisation'].'</span>';				
			}			
			$cotis_adht[$indice]['coul'] =  abs($indice) % 2; //12/01/17 // Pour afficher 1 ligne sur 2  classs= Lignegris0  / Lignegris1
			$tpl->assign('cotis_adht',$cotis_adht); // tableau $cotis_adht[$indice]['xx_adht']	
		$indice++;		
		}
		
		if ($adherent['soc_adht'] == 999) { // Fiche supprimée
			$affiche_message ='-&nbsp;<span class="TexterougeGras">('._LANG_MESSAGE_FICHE_SUPP.' '.switch_sqlFr_date($adherent['date_sortie']).')</span>';
		}					
				
			/***** AFFICHAGE PHOTO  */
			$image_adht = '';
			if (file_exists(DIR_PHOTOS . "/tn_" . $id_adht . ".jpg")) {
				$image_adht = "../photos/tn_" . $id_adht . ".jpg";
				$image_adht_full = "../photos/" . $id_adht . ".jpg";
			}	
			elseif (file_exists(DIR_PHOTOS . "/tn_" . $id_adht . ".gif")) {
				$image_adht = "../photos/tn_" . $id_adht . ".gif";
				$image_adht_full = "../photos/" . $id_adht . ".gif";
			}

		if ($image_adht != "") {
			// pour affichage de la photo avec lien vers  pour agrandir dans une autre fenetre
			if (function_exists("ImageCreateFromString")) {  
	            $imagedata = getimagesize($image_adht); 
			} else {
				$imagedata = array("66","");
			}
	        $photo_adht ="<a href=\"".$image_adht_full."\" target=\"_blank\"><img src=\""
			.$image_adht."?nocache".time()."\"  alt=\"".("Photo")
			."\" title=\""._LANG_MESSAGE_FICHE_AGRANDIR_PHOTO."\" width=\""
			.$imagedata[0]."\" height=\"".$imagedata[1]."\" /></a>"; //on  peut  agrandir                       	
		} else {
			$photo_adht = '';
		} /***** FIN AFFICHAGE PHOTO -- */		
				
		// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE	
		$tpl->assign('data_adherent',$adherent); // tableau $adherent['champ de la table]	
		$tpl->assign('photo_adht',$photo_adht); // Pour affichage de la Photo	
		$tpl->assign('affiche_message',$affiche_message); /// message fiche supprimée			
	}		
	
	//+  qui a enregistré la fiche
	$req_lire_nom_enregistrant = "SELECT prenom_adht,nom_adht"
	." From ".TABLE_ADHERENTS." WHERE id_adht='$qui_enrg_adht'";	
	$dbresult_enr = $db->Execute($req_lire_nom_enregistrant);		
	$tpl->assign('pnom_creation_fiche_adht', $dbresult_enr->fields['prenom_adht']." ".$dbresult_enr->fields['nom_adht']);		
	// fin +  qui a enregistré

// ajout test message Ok ou Erreur + Ajout 15/04/09 FONCTION MAIL
	$result_mail = get_post_variable ('mail','');// enléve les parasites	
		if ($result_mail == 'Ok') {
			$tpl->assign('resultat_mail','<span class="TextenoirGras">'._LANG_MESSAGE_FICHE_MAIL_OK.'</span>'); //message  Ok
		} else if ($result_mail == '0') {
			$tpl->assign('resultat_mail','<span class="TexterougeGras">'._LANG_MESSAGE_FICHE_MAIL_NONOK.'</span>'); // NOnOk			
		}else {
			$tpl->assign('resultat_mail',''); //vide		
		}
	
	/***** FIN Pour affichage de la fiche Mon Récapitulatif et  Informations personnelles */	

/**
Si l'adhérent est SUPPRIME soit soc_adht='999' NE PAS AFFICHER LES DONNEES SUIVANTES
*/	

	/*****  Pour affichage de la fiche Mes fichiers et mes missions */
		if (INFO_FICHIER_MISSIONS == '1') {
			include 'consulter_info_fichiermission_adht.php';
			// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE	
			$tpl->assign('info_fichiermission_adht',INFO_FICHIER_MISSIONS);
		}
	/***** FIN Pour affichage de la fiche Mes fichiers et mes missions  */


		
/***** ---------------------------------------------------------------------- */	
	// Préparation pour Affichage partie Fixe VERS TEMPLATE	
	$tpl->assign('version',VERSION); // Version de Gestasso
	$tpl->assign('nom_asso_gestassophp',NOM_ASSO_GESTASSOPHP); // le Nom de l'association				
	$tpl->assign('messagetitre',MESSAGETITRE); // Titre Bandeau haut	
	$tpl->assign('priorite_adht',$priorite_adht);
	$tpl->assign('nomprenom_adht',$prenom_adht.' '.$nom_adht);	
	// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE				
	$tpl->assign('id_adht',$id_adht);	
	$content = $tpl->fetch('adherent/gerer_fiche_adht.tpl'); // On affiche la fiche GESTION adhérent	
	$tpl->assign('content',$content);
	$tpl->display('page_index.tpl');
			

} else { /***** il y a une erreur ... Si erreur  on envoie vers la page de login ... avec message */	
	header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR);  
}

?>
    
