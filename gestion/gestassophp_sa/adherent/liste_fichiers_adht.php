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
 * @version :  2018
 * @copyright 2007-2018  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */
 
/**
 *  Directory :  /ROOT_DIR_GESTASSO/adherent/
 *   Fichier :
 *   Affiche la liste des fichiers de l'ahérent 
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
	$req_lire_info_fichier = '';
	$reqcompt_info_fichier = '';
	$affiche_message = ''; // Raz message alerte	
	$id_adht = '' ;
	//Tableau xpour affichage	
	$fichier = array();
	// initialisation	
	$date_du_jour=date('Y-m-d');//Pour définir la date du jour et la  différence entre 2  dates


	
	/***** Si ADMINISTRATEUR donc $priorite_adht >5  DROIT DE CONSUTER ET MODIFIER     (4  n'a PAS le droit) */
	if ($priorite_adht < 5 ) { // INTERDIT
		$id_adht = $sessionadherent;
		// Message erreur PAS LE DROIT
		header('location: ../adherent/gerer_fiche_adht.php'); 
	} 		

		
/***** Si on TELECHARGE fichier adhérent  */	
	$fichier_adht = get_post_variable_numeric('fichier_adht', '');
	$id_file_adht_download = get_post_variable_numeric('id_file_adht', '');	
	if ( ($fichier_adht == 1) && ($id_file_adht_download) ) {
		$req_lire_info_fichier = "SELECT nom_file_adht From ".TABLE_FICHIER_ADHERENTS
		." WHERE id_file_adht='$id_file_adht_download'";
		$dbresult = $db->Execute($req_lire_info_fichier);			
	    //affiche les variables de la ligne 
		$myfile = $dbresult->fields['nom_file_adht'];
		$filename = DIR_FILES_ADHTS.$myfile;

		if (file_exists($filename)) {
			//print "Le fichier $filename existe";
			header('Location:'.WEB_FILES_ADHTS.$myfile );
		} else {
			//print affiche en rouge en haut "Le fichier $filename n'existe pas";
			$affiche_message =' -&nbsp;(<span class="Texterouge">'._LANG_MESSAGE_LISTE_FICHIERS_ADH_FILE.' '.$myfile.' '.
			_LANG_MESSAGE_LISTE_FICHIERS_ADH_NOTEXIST.'</span>)';
			$tpl->assign('affiche_message',$affiche_message); // pour afficher
		}	
	}

/***** FIN Si on TELECHARGE fichier adhérent  */		
		
/***** Si on SUPPRIME le fichier adhérent  */
	$supp_fichier_adht = get_post_variable_numeric('supp_fichier_adht', '');
	$id_file_adht_supp = get_post_variable_numeric('id_file_adht', '');	
	if ( ($supp_fichier_adht == 1) && ($id_file_adht_supp) ) {

		// on récuprere le Nom du fichier
		$req_supp_fichier_adht = "SELECT nom_file_adht From ".TABLE_FICHIER_ADHERENTS
		." WHERE id_file_adht='$id_file_adht_supp'";
		$dbresult = $db->Execute($req_supp_fichier_adht);		
        //affiche les variables de la ligne 
		$nom_fichier = $dbresult->fields['nom_file_adht'];
		// on renomme le fichier avec 999_
		$nom_fichier_renom="999_".$nom_fichier;
        //on ajoute un 999_ dans file_adht de la table TABLE_FICHIER_ADHERENTS  + datemodif_file_adht = date_du_jour
        $req_supp_fichier =  ("UPDATE ".TABLE_FICHIER_ADHERENTS." SET "
		."nom_file_adht='$nom_fichier_renom', datemodif_file_adht ='$date_du_jour', file_adht='999' "
		." WHERE id_file_adht='$id_file_adht_supp'");		
		$dbresult_supp = $db->Execute($req_supp_fichier);			
		// on renome le fichier du repertoire du serveur
		$a_effacer = DIR_FILES_ADHTS.$nom_fichier;
	    if (file_exists($a_effacer)) {
	        //unlink($a_effacer); // on  efface 
			/********************* VOIR SI FICHIER EXISTE DéJà  On efface l'ancien fichier**/
			if (file_exists(DIR_FILES_ADHTS.'999_'.$nom_fichier)) {
				unlink(DIR_FILES_ADHTS.'999_'.$nom_fichier); // on  efface 
			}
			rename($a_effacer, (DIR_FILES_ADHTS.$nom_fichier_renom)); // on renomme le fichier dans le répertoire
		}
			
		//ecrit qui a fait la manip			
		$ecritlog = $masession->write_log("Suppression_Fichier_Adht : "
		.$id_file_adht_supp,$masession->get_var_session('ses_nom_adht')." "
		.$masession->get_var_session('ses_prenom_adht'));
			
		header('location: liste_fichiers_adht.php'); 
	
	}
/***** FIN Si on SUPPRIME  le fichier adhérent  */	


	// récupere la variable de la page pour afficher la suite
	$numpage_affiche= get_post_variable_numeric('numpage_affiche','1');// par défaut 1 page
	

	//On prépare l'affichage 
	//Nb de fichiers
	$affiche_nb_lines = get_post_variable_numeric('affiche_nb_fich',NB_LIGNES_PAGE);
	
	// recherche sur le Nom ou prénom par filtre "filtre_nom"	
	$filtre_adht_nom ='';
	if (isset($_GET['filtre_nom'])) {
		$filtre_adht_nom=trim(stripslashes(htmlspecialchars($_GET['filtre_nom'],ENT_QUOTES)));
		$filtre_adht_nom1 = trim($_GET['filtre_nom']);// pour les problème d' apostrosphe			
	}

	// filtre d'affichage des fichiers par 0 => 'Les fichiers actifs',1 => 'Les fichiers supprimées 2 => 'Tous les fichiers
	$filtrefichier_ou ='0'; // affiche par défaut que les fichiers actifs
		
	if (isset($_GET['filtrefichier'])) {
		if (is_numeric($_GET['filtrefichier'])) {
		$filtrefichier_ou=$_GET['filtrefichier'];
		}
	}

	// requette principale
	$req_lire_info_fichier ="SELECT id_file_adht,id_adht_file,nom_file_adht,design_file_adht,"
	."date_file_adht,file_adht, "	
	." prenom_adht,nom_adht" // TABLE_ADHERENTS		
	." FROM ".TABLE_FICHIER_ADHERENTS.", ".TABLE_ADHERENTS
	." WHERE ".TABLE_FICHIER_ADHERENTS.".id_adht_file=".TABLE_ADHERENTS.".id_adht ";
	// requette pour comptage 
	$reqcompt_info_fichier="SELECT id_file_adht,id_adht_file"	
	." FROM ".TABLE_FICHIER_ADHERENTS.", ".TABLE_ADHERENTS
	." WHERE ".TABLE_FICHIER_ADHERENTS.".id_adht_file=".TABLE_ADHERENTS.".id_adht ";


	// recherche sur le Nom ou prénom par filtre "filtre_nom"
	if ($filtre_adht_nom != '') {
		$filtre_adht_nom1 = $filtre_adht_nom1; // pour les problème d' apostrosphe	
		// Concat($s1,$s2,....) Generates the sql string used to concatenate $s1, $s2		
		$concat_np = $db->Concat(TABLE_ADHERENTS.".nom_adht ",$db->Qstr(" "),TABLE_ADHERENTS.".prenom_adht "); //  gs_adherent.nom_adht ||gs_adherent.prenom_adht 
		$concat_pn = $db->Concat(TABLE_ADHERENTS.".prenom_adht ",$db->Qstr(" "),TABLE_ADHERENTS.".nom_adht "); //  gs_adherent.prenom_adht ||gs_adherent.nom_adht 
		
		$req_lire_info_fichier .= "AND (".$concat_np." like '%".$filtre_adht_nom1."%' ";
		$req_lire_info_fichier .= "OR ".$concat_pn." like '%".$filtre_adht_nom1."%') ";
		$reqcompt_info_fichier .= "AND (".$concat_np." like '%".$filtre_adht_nom1."%' ";
		$reqcompt_info_fichier .= "OR ".$concat_pn ." like '%".$filtre_adht_nom1."%') ";
		/*
		$req_lire_info_fichier .= "AND (CONCAT( nom_adht like '%".$filtre_adht_nom1."%') ";
		$req_lire_info_fichier .= "OR CONCAT( prenom_adht like '%".$filtre_adht_nom1."%')) ";
		$reqcompt_info_fichier .= "AND (CONCAT( nom_adht like '%".$filtre_adht_nom1."%') ";
		$reqcompt_info_fichier .= "OR CONCAT( prenom_adht like '%".$filtre_adht_nom1."%')) ";		
		*/
	}
		
	// filtre d'affichage des fichiers par 0 => 'Les fichiers actifs',1 => 'Les fichiers supprimées 2 => 'Tous les fichiers
	if ($filtrefichier_ou == '0') { // Les fichier actifs
		$req_lire_info_fichier .= "AND file_adht <>'999' ";
		$reqcompt_info_fichier .= "AND file_adht <>'999' ";
	}

	//if ($filtre_fiche == '1') { //Tous les fichiers
		// aucune 
	//}
		
	if ($filtrefichier_ou == '2') { // Les fichier supprimés
		$req_lire_info_fichier .= "AND file_adht ='999' ";
		$reqcompt_info_fichier .= "AND file_adht ='999' ";
	}
		

		
	// phase de tri sur les colonnes  #=N°      	 Nom fichier    	 Description    	 Date    	 Nom adhérent
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
	$req_lire_info_fichier .= " ORDER BY ";
		
	// tri par colonne Nom fichier
	if ($_SESSION['tri'] == '1') {
		$req_lire_info_fichier .= "nom_file_adht ".$tri_sens_txt.',';
	// tri par colonne  Description
	} elseif ($_SESSION['tri'] == '2') {
		$req_lire_info_fichier .= "design_file_adht ".$tri_sens_txt.',';
	// tri par colonne Date 
	} elseif ($_SESSION['tri'] == '3') {
		$req_lire_info_fichier .= "date_file_adht ".$tri_sens_txt.',';
	// tri par colonne Nom adhérent
	} elseif ($_SESSION['tri'] == '4') {
		$req_lire_info_fichier .= "id_adht_file ".$tri_sens_txt.',';
	}
				
	// tri par #=N°  = Id fichier
	$req_lire_info_fichier .= "id_file_adht ".$tri_sens_txt;
	

	// comptage des fiches
	$dbresult = $db->Execute($reqcompt_info_fichier); //Pour compter le NB d'enregistrements
//test si aucune fiche
		if ($dbresult) {
			$nb_lines = $dbresult->RecordCount() ; //Pour compter le NB de fiche	
		}else {
			$nb_lines = 0 ;
		}	
			
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

	$dbresult = $db->Execute($req_lire_info_fichier);	
	
	// pour afficher le Nb de ligne par page	
	if ($affiche_nb_lines == 0) {
		$dbresult = $db->Execute($req_lire_info_fichier);	
	} else {
		$dbresult = $db->SelectLimit($req_lire_info_fichier,$affiche_nb_lines,  (($numpage_affiche-1)*$affiche_nb_lines) );	 
	}
	
	// On prépare les données
	while ($dbresult && $row = $dbresult->FetchRow()) {
		
		$fichier[$indice]['id_file_adht'] = $row['id_file_adht'];	//Id		
		$fichier[$indice]['nom_file_adht'] = $row['nom_file_adht']; //Nom fichier				
		$fichier[$indice]['designation_file_adht'] = stripslashes($row['design_file_adht']);// Description
		$fichier[$indice]['date_file_adht'] = switch_sqlFr_date($row['date_file_adht']); //Date
		$id_adht_file = $row['id_adht_file']; // id adht
		$fichier[$indice]['prenom_adht'] = $row['prenom_adht']; //  Prénom de la table adhérent
		$fichier[$indice]['nom_adht'] = $row['nom_adht']; // Nom de la table adhérent
		$fichier[$indice]['file_adht'] = $row['file_adht']; // pour voir si 999 = archive
		$fichier[$indice]['coul'] = $indice % 2; // Pour afficher 1 ligne sur 2  classs= Lignegris0  / Lignegris1	
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
	$tpl->assign('fichier',$fichier); // tableau $fichier[$indice]['xx_xx']			
	$tpl->assign('nb_lines',$nb_lines); // Nb de ligne de requete
	$tpl->assign('nb_pages',$nbpages); // le Nombre de pages totale
	$tpl->assign('numpage',$numpage_affiche); // le N° de la page courrante
	$tpl->assign('affiche_nb_fich',$affiche_nb_lines); // NB lignes par select
	//$tpl->assign('affiche_nb_lines',$affiche_nb_lines);
	$tpl->assign('filtre_adht_nom',$filtre_adht_nom); // Filtrage par Rechercher ...
	$tpl->assign('filtrefichier_ou',$filtrefichier_ou);// Filtrage parmi .les fichiers actifs, supprimés
	$tpl->assign('filtre_options', $T_AFFICHE_FILTRE_FICHIERS); // la litse des options  fichier actifs ou supprimés..
	$tpl->assign('affichenb_adht_options',$T_AFFICHE_NB_PAGE); // Nb de lignes par page		
	//POUR  AFFICHAGE VERS TEMPLATE		
	$content = $tpl->fetch('adherent/liste_fichiers_adht.tpl'); // On affiche ...
	$tpl->assign('content',$content);
	$tpl->display('page_index.tpl');	

		
} else { /***** il y a une erreur ... Si erreur  on envoie vers la page de login ... avec message */		
	header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR);  
}
	
?>
    
