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
 *  Liste totale des adhérents pour les Administrateurs
 *  Inspiré pour la partie tri de GALLETTE  v0.63 Copyright (c) 2003 Frédéric Jaqcuot     
*/

include_once '../config/connexion.php';
$masession = new sessions(); // -->la classe session 	//session_start();

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
	$req_lire_info_adht = '';
	$reqcompt_info_adht  = ''; 
	//Tableau xpour affichage
	$membres = array();
	// initialisation	
	$filtre_adht_nom1 = '';
	$id_adht = '' ;
	$date_du_jour=date('Y-m-d');//Pour définir la date du jour et la  différence entre 2  dates
	
	/***** Si ADMINISTRATEUR donc $priorite_adht >5  DROIT DE CONSUTER ET MODIFIER     (4 et 5 n'a PAS le droit) */
	if ($priorite_adht < 5 ) { // INTERDIT
		$id_adht = $sessionadherent;
		// Message erreur PAS LE DROIT
		header('location: ../adherent/gerer_fiche_adht.php'); 
	} 		

		
/***** Si on SUPPRIME la fiche adhérent	*/
	$supp_fiche_adht = get_post_variable_numeric('supp_fiche_adht', '');
	$id_adht_supp = get_post_variable_numeric('id_adht', '');		
	if ( ($supp_fiche_adht == 1) && ($id_adht_supp) ) {
	
	
	// Verifier si la cotisation est échue !!
		$req_lire_info_adht ="SELECT date_echeance_cotis FROM ".TABLE_ADHERENTS." WHERE id_adht='$id_adht_supp' ";	
		$dbresult = $db->Execute($req_lire_info_adht);	
		$date_echeance_cotisation['date_echeance_cotis'] = $dbresult->fields['date_echeance_cotis'];	

// On vérfie la date de cotisation
		$check_fin_cotisation = switch_sqlFr_date($date_echeance_cotisation['date_echeance_cotis']);
		if (( compare_date($date_du_jour ,$date_echeance_cotisation['date_echeance_cotis'] ) )== FALSE) {
			//Retourne vrai si la date 1 est inférieure ou égale à la date 2, sinon retourne faux. 
			if ($check_fin_cotisation == '00/00/0000' || $check_fin_cotisation == '') { // pas de date ou date NULL
				$check_fin_cotisation = '0' ;
			} else {	// Si date échue				
				$check_fin_cotisation  = '-1';
			}	
		}
		
// Verifier niveau priorité si niveau priorité <> 0  alors message		 		
		$req_lire_info_adht ="SELECT priorite_adht, nom_adht,prenom_adht FROM ".TABLE_ADHERENTS." WHERE id_adht='$id_adht_supp' ";	
		$dbresult = $db->Execute($req_lire_info_adht);	
		$priorite_adht_del['priorite_adht'] = $dbresult->fields['priorite_adht'];
		$nom_adht_adht_del = $dbresult->fields['nom_adht'];
		$prenom_adht_adht_del = $dbresult->fields['prenom_adht'];		
		if ($priorite_adht_del['priorite_adht']  <> 0)  {		
			// on ne peut pas effacer ---> message
			$erreur1_suppression_fiche = 1;
			$tpl->assign('erreur1_suppression_fiche',$erreur1_suppression_fiche); // Impossible supprimer fiche date fin de cotis non échue
			$tpl->assign('erreur1_suppression_priorite',$priorite_adht_del['priorite_adht']); // niveau priorité
			$tpl->assign('erreur1_suppression_id',$id_adht_supp." = ".$nom_adht_adht_del." ".$prenom_adht_adht_del); // ID adhérent + Nom prénom	
		}
		
// si date de fin de cotisation est encore valable Ou si la date de fin de cotisationest echue Alerte
		if ($priorite_adht_del['priorite_adht'] == 0)  { // si niveau priorité = 0  modif V 7.3 ->OLD if ($erreur1_suppression_fiche != 1)
			if ($date_echeance_cotisation['date_echeance_cotis'] > $date_du_jour || ($check_fin_cotisation  == '-1') ) {
				// on ne peut pas effacer ---> message
				$erreur_suppression_fiche =1;
				$tpl->assign('erreur_suppression_fiche',$erreur_suppression_fiche); // Impossible supprimer fiche date fin de cotis non échue
				$tpl->assign('erreur_suppression_date',switch_sqlFr_date($date_echeance_cotisation['date_echeance_cotis'])); // date
				$tpl->assign('erreur_suppression_id',$id_adht_supp); // ID adhérent			
			
			} else { 
	
// On enregistre dans la BD.  on met 999 dans le champ Soc_Adht  pour récupérer si erreur + Date_sortie  et date de mise à jour fiche = date du jour	
				$req_supp_adht=("UPDATE ".TABLE_ADHERENTS." SET soc_adht='999',"
				." datemodiffiche_adht='$date_du_jour'," 
				." date_sortie='$date_du_jour'" 
				." WHERE id_adht='$id_adht_supp'");
				$dbresult = $db->Execute($req_supp_adht);
				
				//ecrit qui a fait la manip			
				$ecritlog = $masession->write_log('Suppression_Adht : '
				.$id_adht_supp,$masession->get_var_session('ses_nom_adht').' '
				.$masession->get_var_session('ses_prenom_adht'));
				header('location: liste_adht_admin.php'); 			
			}
		}
	}
/***** FIN Si on SUPPRIME la fiche adhérent */	

	// récupere la variable de la page pour afficher la suite
	$numpage_affiche= get_post_variable_numeric('numpage_affiche','1');// par défaut 1 page
	

	//On prépare l'affichage 
	$affiche_nb_lines = get_post_variable_numeric('affiche_nb_adht',NB_LIGNES_PAGE); //  par défaut NB_LIGNES_PAGE
	
	// recherche sur le Nom ou prénom par filtre "filtre_nom"	
	$filtre_adht_nom ='';
	if (isset($_GET['filtre_nom'])) {
		$filtre_adht_nom1 = addslashes(trim($_GET['filtre_nom']));// pour les problème d' apostrosphe	
	}

	// filtre d'affichage des adherents par  0 => 'Les membres inscrits' 1 => 'Les membres à jour', 2 => 'Les membres en retard',  3 => Les fiches supprimées + Toutes les fiches 14/11/07
	$filtremembre_adht ='0'; // affiche par défaut que les membres inscrits
		
	if (isset($_GET['filtre_membre'])) {
		if (is_numeric($_GET['filtre_membre'])) {
		$filtremembre_adht=$_GET['filtre_membre'];
		}
	}
	
	// requette principale
	$req_lire_info_adht ="SELECT id_adht,soc_adht,prenom_adht,nom_adht,ville_adht,datecreationfiche_adht,antenne_adht,qui_enrg_adht,"
	."date_echeance_cotis,nom_type_antenne FROM "
	.TABLE_ADHERENTS.", ".TABLE_ANTENNE." WHERE 1=1 AND antenne_adht=id_type_antenne "; //  ++ antenne_adht

	// requette pour comptage 
	$reqcompt_info_adht = "SELECT id_adht FROM ".TABLE_ADHERENTS." WHERE 1=1 ";		
	
	// recherche sur le Nom ou prénom par filtre "filtre_nom"
	if ($filtre_adht_nom1 != '') {
		//$filtre_adht_nom1 = $filtre_adht_nom1; // pour les problème d' apostrosphe		
		
		// Concat($s1,$s2,....) Generates the sql string used to concatenate $s1, $s2		
		$concat_np = $db->Concat(TABLE_ADHERENTS.".nom_adht ",$db->Qstr(" "),TABLE_ADHERENTS.".prenom_adht "); //  gs_adherent.nom_adht ||gs_adherent.prenom_adht 
		$concat_pn = $db->Concat(TABLE_ADHERENTS.".prenom_adht ",$db->Qstr(" "),TABLE_ADHERENTS.".nom_adht "); //  gs_adherent.prenom_adht ||gs_adherent.nom_adht 
		
		$req_lire_info_adht .= "AND (".$concat_np." like '%".$filtre_adht_nom1."%' ";
		$req_lire_info_adht .= "OR ".$concat_pn." like '%".$filtre_adht_nom1."%') ";
		$reqcompt_info_adht .= "AND (".$concat_np." like '%".$filtre_adht_nom1."%' ";
		$reqcompt_info_adht .= "OR ".$concat_pn." like '%".$filtre_adht_nom1."%') ";
		/*
		$req_lire_info_adht .= "AND (CONCAT( nom_adht like '%".$filtre_adht_nom1."%') ";
		$req_lire_info_adht .= "OR CONCAT( prenom_adht like '%".$filtre_adht_nom1."%')) ";
		$reqcompt_info_adht .= "AND (CONCAT( nom_adht like '%".$filtre_adht_nom1."%') ";
		$reqcompt_info_adht .= "OR CONCAT( prenom_adht like '%".$filtre_adht_nom1."%')) ";
		*/
	}
		
	// filtre d'affichage des adherents par  0 => 'Les membres inscrits' 1 => 'Les membres à jour', 2 => 'Les membres en retard',  3 => Les fiches supprimées
	if ($filtremembre_adht == '0') { // Les membres inscrits
		$req_lire_info_adht .= "AND soc_adht <>'999' ";
		$reqcompt_info_adht .= "AND soc_adht <>'999' ";
	}

	if ($filtremembre_adht == '1') { //Les membres à jour
		$req_lire_info_adht .= "AND soc_adht ='s' ";
		$reqcompt_info_adht .= "AND soc_adht ='s' ";
	}
		
	if ($filtremembre_adht == '2') { // Les membres en retard
		$req_lire_info_adht .= "AND soc_adht ='' AND date_echeance_cotis < '$date_du_jour' ";
		$reqcompt_info_adht .= "AND soc_adht ='' AND date_echeance_cotis < '$date_du_jour'";
	}
		
	if ($filtremembre_adht == '3') { // Les fiches supprimées
		$req_lire_info_adht .= "AND soc_adht ='999' ";
		$reqcompt_info_adht .= "AND soc_adht ='999' ";
	}
	
	if ($filtremembre_adht == '4') { // + Toutes les fiches 14/11/07
		$req_lire_info_adht .= " ";
		$reqcompt_info_adht .= " ";
	}	

	// phase de tri sur les colonnes  #=N°    	 Nom    	 Ville    	 Inscription    	 Cotisation
	if (isset($_GET['tri'])) { // récupere l le N° de la colosne de tri 
		if (is_numeric($_GET['tri'])) {
			if ($_SESSION['tri']==$_GET['tri']) {
				$_SESSION['tri_sens']=($_SESSION['tri_sens']+1)%2; // 0 ou 1
			} else {
				$_SESSION['tri']=$_GET['tri'];
				$_SESSION['tri_sens']=0;
			}
		}
	}
	
	// donne le sens du tri ASC ou DESC
	if ($_SESSION['tri_sens'] == '0') {// sens du tri
		$tri_sens_txt='ASC';
	} else {
		$tri_sens_txt='DESC';
	}
		
	// tri par ordre
	$req_lire_info_adht .= " ORDER BY ";
		
	// tri par colonne Nom
	if ($_SESSION['tri'] == '1') {
		$req_lire_info_adht .= "nom_adht ".$tri_sens_txt.',';
	// tri par colonne Ville
	} elseif ($_SESSION['tri'] == '2') {
		$req_lire_info_adht .= "ville_adht ".$tri_sens_txt.',';
	// tri par colonne Date inscription
	} elseif ($_SESSION['tri'] == '3') {
		$req_lire_info_adht .= "datecreationfiche_adht ".$tri_sens_txt.',';
	// tri par colonne Cotisation   - attention affiche que les cotisants
	} elseif ($_SESSION['tri'] == '4') {
		$req_lire_info_adht .= "date_echeance_cotis ".$tri_sens_txt.',';
	// tri par colonne  ++ //   qui a enregistré la fiche
	} elseif ($_SESSION['tri'] == '5') {
		$req_lire_info_adht .= "qui_enrg_adht ".$tri_sens_txt.',';	
	// tri par colonne  ++ //   Section / Antenne ...
	} elseif ($_SESSION['tri'] == '6') {
		$req_lire_info_adht .= "antenne_adht ".$tri_sens_txt.',';	
	}	
	
				
	// tri par #=N°  = Id adhérents
	$req_lire_info_adht .= "id_adht ".$tri_sens_txt;
		
	// comptage des fiches
	$dbresult = $db->Execute($reqcompt_info_adht); //Pour compter le NB d'enregistrements
//test si aucune fiche
		if ($dbresult) {
			$nb_lines = $dbresult->RecordCount() ; //Pour compter le NB de fiche	
		}else {
			$nb_lines = 0 ;
		}	
		
//echo  $nb_lines ;
		
	if ($affiche_nb_lines == 0) {
		$nbpages = 1;
	} else if ($nb_lines % $affiche_nb_lines == 0) { // si modulo = reste donc prévoir 1 page de +
		$nbpages = intval($nb_lines/$affiche_nb_lines); // pas de reste donc page entière
	} else {
		$nbpages = intval($nb_lines/$affiche_nb_lines)+1; // reste <>0 donc page + 1
	}	
		
	if ($nbpages == 0) $nbpages = 1; // si 0 on prévoit 1 page ;-)
		
	$indice = 1+($numpage_affiche-1)*$affiche_nb_lines ; // le N° de ligne
	$nbpages=$nbpages+1;// pour affichage sur template Page  1 2 3... avec lien
//echo $req_lire_info_adht;
	$dbresult = $db->Execute($req_lire_info_adht);	

	// pour afficher le Nb de ligne par page	
	if ($affiche_nb_lines == 0) {
		$dbresult = $db->Execute($req_lire_info_adht);	
	} else {
		$dbresult = $db->SelectLimit($req_lire_info_adht,$affiche_nb_lines,  (($numpage_affiche-1)*$affiche_nb_lines) );	 
	}	
	

	// On prépare les données
	while ($dbresult && $row = $dbresult->FetchRow()) {
		$membres[$indice]['id_adht'] = $row['id_adht'];
		$membres[$indice]['soc_adht'] = $row['soc_adht'];		
		$membres[$indice]['nom_adht'] = $row['nom_adht'];	
		$membres[$indice]['prenom_adht'] = $row['prenom_adht'];				
		$membres[$indice]['ville_adht'] = stripslashes($row['ville_adht']);// pour eviter les \ dans les noms d'asso
		$membres[$indice]['date_adht'] = switch_sqlFr_date($row['datecreationfiche_adht']);
			
		$membres[$indice]['fin_cotisation'] = switch_sqlFr_date($row['date_echeance_cotis']);
			if (( compare_date($date_du_jour , ($row['date_echeance_cotis'])) )== FALSE) {
				//Retourne vrai si la date 1 est inférieure ou égale à la date 2, sinon retourne faux. 
				if ($membres[$indice]['fin_cotisation'] == '00/00/0000' || $membres[$indice]['fin_cotisation'] == '') { // pas de date ou date NULL
					$membres[$indice]['fin_cotisation'] = '<span class="Texterouge">'
					._LANG_MESSAGE_ADMIN_LISTE_ADHT_.'</span>'; //Cotisation "NON règlée"
				} else {	// Si date échue				
					$membres[$indice]['fin_cotisation'] = '<span class="Texterouge">'
					.$membres[$indice]['fin_cotisation'].'</span>';
				}
			}
	
//echo $membres[$indice]['id_adht'];	
		// +  qui a enregistré la fiche 	
		$membres[$indice]['qui_enrg_adht'] =$row['qui_enrg_adht'];	
		$numf = $membres[$indice]['qui_enrg_adht']  ;	
		$req_lire_nom_enregistrant = "SELECT prenom_adht,nom_adht"
		." From ".TABLE_ADHERENTS." WHERE id_adht='$numf'";	
		$dbresult_enr = $db->Execute($req_lire_nom_enregistrant);		
		$membres[$indice]['pnom_creation_fiche_adht'] = $dbresult_enr->fields['prenom_adht']." ".$dbresult_enr->fields['nom_adht'];		
		// fin +  qui a enregistré
		
		$membres[$indice]['nom_type_antenne'] =$row['nom_type_antenne'];	// +sections ou secteurs d'activité" propre à l'association
		$membres[$indice]['coul'] = $indice % 2; // Pour afficher 1 ligne sur 2  classs= Lignegris0  / Lignegris1
		$indice++;	
	}	


/***** ---------------------------------------------------------------------- */
	// Préparation pour Affichage partie Fixe VERS TEMPLATE	 	
	$tpl->assign('version',VERSION); // Version de Gestasso
	$tpl->assign('nom_asso_gestassophp',NOM_ASSO_GESTASSOPHP); // le Nom de l'association				
	$tpl->assign('messagetitre',MESSAGETITRE); // Titre Bandeau haut
	$tpl->assign('priorite_adht',$priorite_adht);
	$tpl->assign('nomprenom_adht',$prenom_adht.' '.$nom_adht);	
	$tpl->assign('id_adht',$id_adht);	
	// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE	
	$tpl->assign('membres',$membres); // tableau $membres[$indice]['xx_adht']	
	$tpl->assign('nb_lines',$nb_lines); // Nb de ligne de requete
	$tpl->assign('nb_pages',$nbpages); // le Nombre de pages totale
	$tpl->assign('numpage',$numpage_affiche); // le N° de la page courrante
	$tpl->assign('affiche_nb_adht',$affiche_nb_lines); // NB lignes par select
	//$tpl->assign('affiche_nb_lines',$affiche_nb_lines);
	$tpl->assign('filtre_adht_nom',$filtre_adht_nom); // Filtrage par Rechercher ...
	$tpl->assign('filtremembre_adht',$filtremembre_adht);// Filtrage par  parmi ...
	$tpl->assign('filtre_options', $T_AFFICHE_FILTRE_MEMBRES); // la litse des options  membres actifs, à jour,...
	$tpl->assign('affichenb_adht_options',$T_AFFICHE_NB_PAGE); // Nb de lignes par page			
	//POUR  AFFICHAGE VERS TEMPLATE	
	$content = $tpl->fetch('adherent/liste_adht_admin.tpl'); // On affiche ...
	$tpl->assign('content',$content);
	$tpl->display('page_index.tpl');	

			
} else { /***** il y a une erreur ... Si erreur  on envoie vers la page de login ... avec message */	
	header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR);  
}
	
?>
    
