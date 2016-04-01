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
 * @version :  2016
 * @copyright 2007-2016  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */
 
/**
 *  Directory :  /ROOT_DIR_GESTASSO/adherent/
 *   Fichier :
 *   Affiche les détails des fiches de l'ahérent POUR CONSULTATION a partir de la liste adhérent QUI ont donné le "Oui" pour Voir les informations 
*/

include_once '../config/connexion.php';
$masession = new sessions(); // -->la classe session //session_start();
// Raz  du tri	
$_SESSION['tri']=0;
$_SESSION['tri_sens']=1;

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

	$adherent=array(); //On passe par un Tableau pour affichage adherent
	
/**** Tout le monde a le  DROIT DE CONSUTER   */
	$id_adht = get_post_variable_numeric('id_adht', '');// l'id de la personne de la fiche infogénérales
/* 	ne sert à rien ici
	//Vérifier si la personne a donné sont accord pour voir sa fiche - SINON  visualise fiche du connecté
    $req_lire_info_visibl_adht = "SELECT visibl_adht FROM ".TABLE_ADHERENTS." WHERE id_adht='$id_adht'"; 	
	$dbresult = $db->Execute($req_lire_info_visibl_adht);	
	$oui_fiche_adht = $dbresult->fields['visibl_adht'];
	echo $oui_fiche_adht;
		if (($oui_fiche_adht['visibl_adht'] == 'Non') )  { // si visibl_adht=NON
			$id_adht = $sessionadherent; // on visualise SA propre fiche	
		}	
	*/
	// On lit la table adherent
    $req_lire_info_adht = "SELECT civilite_adht, nom_adht, prenom_adht, adresse_adht, cp_adht, ville_adht,"
	." telephonef_adht, telephonep_adht, telecopie_adht, email_adht,"
	." datecreationfiche_adht, antenne_adht,datenaisance_adht,"
//	." (TO_DAYS(NOW())-TO_DAYS(datenaisance_adht))/365 AS age, 
	." visibl_adht, datemodiffiche_adht,"
	." siteweb_adht, date_echeance_cotis, date_sortie, "
	." tranche_age, nom_type_antenne" // + 	nom_type_antenne
	." FROM  ".TABLE_ADHERENTS.", ".TABLE_ANTENNE." WHERE " // + TABLE_ANTENNE
	." id_adht='$id_adht' AND antenne_adht=id_type_antenne "; //  ++ AND antenne_adht=id_type_antenne
	$dbresult = $db->Execute($req_lire_info_adht);	
	
	
	while (($adherent = $dbresult->FetchRow())) {
		// on crée le tableau $adherent[champ de la table]
		// modification affichage dates
		$adherent['datecreationfiche_adht'] = switch_sqlFr_date($adherent['datecreationfiche_adht']); 			
		$adherent['datemodiffiche_adht'] = switch_sqlFr_date($adherent['datemodiffiche_adht']); 
		$adherent['age']= age($adherent['datenaisance_adht']); // pour calcul age
		$adherent['datenaisance_adht'] = switch_sqlFr_date($adherent['datenaisance_adht']); 

		/***** AFFICHAGE PHOTO  */
		$image_adht = "";
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
			.$image_adht."?nocache".time()."\" alt=\"".("Photo")
			."\" title=\""._LANG_MESSAGE_FICHE_AGRANDIR_PHOTO."\" width=\""
			.$imagedata[0]."\" height=\"".$imagedata[1]."\" /></a>"; //on  peut  agrandir                       
		
		} else {
			$photo_adht = '';
		} /***** FIN AFFICHAGE PHOTO -- */		
				
		// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE		
//		$tpl->assign('affiche_cotisation',$affiche_cotisation);
		$tpl->assign('data_adherent',$adherent); // tableau $adherent[champ de la table]	
		$tpl->assign('photo_adht',$photo_adht); // Pour affichage de la Photo			
	}		

	
		
/***** ---------------------------------------------------------------------- */	
	// Préparation pour Affichage partie Fixe VERS TEMPLATE	 
	$tpl->assign('version',VERSION); // Version de Gestasso
	$tpl->assign('nom_asso_gestassophp',NOM_ASSO_GESTASSOPHP); // le Nom de l'association				
	$tpl->assign('messagetitre',MESSAGETITRE); // Titre Bandeau haut
	$tpl->assign('priorite_adht',$priorite_adht);
	$tpl->assign('nomprenom_adht',$prenom_adht.' '.$nom_adht);	
	// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE				
	$tpl->assign('id_adht',$id_adht);	
	$tpl->assign('vientde',_LANG_MENU_ADMIN_GESTION.' -'); // V 7.3
	//POUR  AFFICHAGE VERS TEMPLATE				
	$content = $tpl->fetch('adherent/consulter_fiche_adht.tpl'); // On affiche la fiche GESTION adhérent	
	$tpl->assign('content',$content);
	$tpl->display('page_index.tpl');
		

} else { /***** il y a une erreur ... Si erreur  on envoie vers la page de login ... avec message */	
	header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR);  
}

?>
    
