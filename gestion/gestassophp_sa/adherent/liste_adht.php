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
 * @version :  2014
 * @copyright 2007-2014  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */
 
/**
 *  Directory :  /ROOT_DIR_GESTASSO/adherent/
 *   Fichier :
 *   Liste des adhérents souhaitant afficher leurs coordonnées + trombinoscope par la photo
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
	$reqcompt_info_tousadht = '';
	$filtre_adht_nom1 = '';
	$id_adht = '' ;
	//Tableau xpour affichage	
	$membres = array();
	// initialisation	
		

	$numpage_affiche= get_post_variable_numeric('numpage_affiche','1');// par défaut 1 page
	$req_lire_info_adht='';
	
	//On prépare l'affichage 
	$affiche_nb_lines = get_post_variable_numeric('affiche_nb_adht',NB_LIGNES_PAGE); //  par défaut NB_LIGNES_PAGE
	
	// recherche sur le Nom ou prénom par filtre "filtre_nom"	
	$filtre_adht_nom ='';
	if (isset($_GET['filtre_nom'])) {
		//$filtre_adht_nom=trim(stripslashes(htmlspecialchars($_GET['filtre_nom'],ENT_QUOTES)));
		$filtre_adht_nom1 = addslashes(trim($_GET['filtre_nom']));// pour les problème d' apostrosphe	 Mod  04/11/2008		
	}
	
	// requette principale
	$req_lire_info_adht ="SELECT id_adht,prenom_adht,nom_adht,cp_adht,ville_adht, "
	."telephonef_adht,telephonep_adht,antenne_adht,id_type_antenne,nom_type_antenne FROM "
	.TABLE_ADHERENTS.", ".TABLE_ANTENNE." WHERE visibl_adht='Oui' AND antenne_adht=id_type_antenne AND soc_adht <>'999' ";
	// requette pour comptage 
	$reqcompt_info_adht = "SELECT id_adht FROM ".TABLE_ADHERENTS." WHERE visibl_adht='Oui' ";
	// requette pour Comptage de TOUS les adhérents inscrits		
	$reqcompt_info_tousadht = "SELECT id_adht FROM ".TABLE_ADHERENTS." WHERE soc_adht <>'999' ";

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
	

	// phase de tri sur les colonnes  #=N°    	 Nom    	 Ville    	 tél  fixe   	 Portable
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
	// tri par colonne  tél  fixe 
	} elseif ($_SESSION['tri'] == '3') {
		$req_lire_info_adht .= "telephonef_adht ".$tri_sens_txt.',';
	// tri par colonne  Portable
	} elseif ($_SESSION['tri'] == '4') {
		$req_lire_info_adht .= "telephonep_adht ".$tri_sens_txt.',';
	// tri par colonne   ++ //   Section / Antenne ...
	} elseif ($_SESSION['tri'] == '5') {
		$req_lire_info_adht .= "antenne_adht ".$tri_sens_txt.',';		
	}
				
		
	// tri par #=N°  = Id adhérents -  par défaut 
	$req_lire_info_adht .= "id_adht ".$tri_sens_txt;

	// comptage des fiches
	$dbresult = $db->Execute($reqcompt_info_adht); //Pour compter le NB d'enregistrements
//test si aucune fiche
		if ($dbresult) {
			$nb_lines = $dbresult->RecordCount() ; //Pour compter le NB de fiche	
		}else {
			$nb_lines = 0 ;
		}	
			
	
	// Comptage de TOUS les adhérents inscrits
	$dbresult_tous = $db->Execute($reqcompt_info_tousadht); //Pour compter le NB d'enregistrements
	$nb_inscrits = $dbresult_tous->RecordCount() ; // le NB de ligne totales	
		
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
// ++ trombinoscope // fin 04/12
		$id_photo_adht = $membres[$indice]['id_adht'];
	/***** AFFICHAGE PHOTO  */
		$membres[$indice]['image_adht'] = ""; //$image_adht = "";
		if (file_exists(DIR_PHOTOS . "/tn_" . $id_photo_adht . ".jpg")) {
			$membres[$indice]['image_adht'] = "../photos/tn_" . $id_photo_adht . ".jpg";
		}	
		elseif (file_exists(DIR_PHOTOS . "/tn_" . $id_photo_adht . ".gif")) {
			$membres[$indice]['image_adht'] = "../photos/tn_" . $id_photo_adht . ".gif";
		}	
// fin trombinoscope //			
		$membres[$indice]['nom_adht'] = $row['nom_adht'];	
		$membres[$indice]['prenom_adht'] = $row['prenom_adht'];				
		$membres[$indice]['ville_adht'] = $row['cp_adht']." "
		.stripslashes($row['ville_adht']);// pour eviter les \ dans les noms
		$membres[$indice]['telephonef_adht'] = $row['telephonef_adht'];
		$membres[$indice]['telephonep_adht'] = $row['telephonep_adht'];	
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
	$tpl->assign('affiche_nb_inscrits',$nb_inscrits); // NB adhérents inscrits
	$tpl->assign('filtre_adht_nom',$filtre_adht_nom); // Filtrage par Rechercher ...	
	$tpl->assign('affichenb_adht_options',$T_AFFICHE_NB_PAGE); /// Nb de lignes par page	
	//POUR  AFFICHAGE VERS TEMPLATE			
	$content = $tpl->fetch('adherent/liste_adht.tpl'); // On affiche ...
	$tpl->assign('content',$content);
	$tpl->display('page_index.tpl');	

		
} else { /***** il y a une erreur ... Si erreur  on envoie vers la page de login ... avec message */		
	header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR);  
}
	
?>
    