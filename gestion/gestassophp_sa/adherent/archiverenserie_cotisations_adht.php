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
 *  Archiver en série les fiches Cotisations à une date donnée pour Admin 9 et compta 7 - Depuis V 7.3
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
	$id_adht = '';
	$req_lire_info_cotis = '';
	$reqcompt_info_cotis = '';	
	$affiche_liste_complete=''; // On affiche Toutes les citisation ou seulement 1 seul adhérent 
	$filtre_datedeb ='';
	$filtre_datefin ='';
	//Tableau xpour affichage
	$cotis_adht = array(); // Tableau $cotis_adht[champ de la table]  passage des data vers TPL
	$erreur_saisie = array(); //Erreur si  Champs Obligatoires à saisir
	// initialisation
	$date_du_jour=date("Y-m-d");//Pour définir la différence entre 2  dates
	$Date_fin_cotisation_pref = switch_date(JMA_FIN_COTIS); // ajout pour avoir la Date fin cotisation du menu  Préférences/Préférence Association au format 2016-12-31
		
	/***** Si ADMINISTRATEUR donc $priorite_adht > 8     (4, 5 et 7 n'a PAS le droit) */
	if ($priorite_adht >= 7 ) {
		$id_adht_cotis = get_post_variable_numeric('id_adht_cotis', '');// l'id cotis/adhérent pour affichage liste du seul cotisant			
		if ( $id_adht_cotis == '') { 
			$affiche_liste_complete = 1; //  On affichera la liste complete de Tous les cotisants		
		}
	}else {
		$id_adht = $sessionadherent;
		// Message erreur PAS LE DROIT
		header('location: ../adherent/gerer_fiche_adht.php'); 			
	} 
		

	// récupere la variable de la page pour afficher la suite
	$numpage_affiche= get_post_variable_numeric('numpage_affiche','1');// par défaut 1 page
		
		
	//On prépare l'affichage 
	$affiche_nb_lines = get_post_variable_numeric('affiche_nb_adht',NB_LIGNES_PAGE); //  par défaut NB_LIGNES_PAGE

	// recherche sur les dates début et fin cotisations par  les filtres "filtre_datedeb" et  "filtre_datefin" 
	$select_datedeb= get_post_variable('select_datedeb','');
	if ($select_datedeb) {	
		if (( check_madateFR($select_datedeb))== TRUE) {
			$filtre_datedeb = $select_datedeb;
			$select_datedeb_sql = switch_date($select_datedeb) ; // --> 1948-02-21
		} else {
			$filtre_datedeb = '';
			$erreur_saisie ['d_datedeb'] = _LANG_MESSAGE_LISTE_COTIS_ADHT_DATE_DEB;
		}
	}

	$select_datefin= get_post_variable('select_datefin','');
	if ($select_datefin) {		
		if (( check_madateFR($select_datefin))== TRUE) {
			$filtre_datefin =$select_datefin;
			$select_datefin_sql = switch_date($select_datefin) ; // --> 1948-02-21
		} else {
			$filtre_datefin = '';
			$erreur_saisie ['d_datefin'] = _LANG_MESSAGE_LISTE_COTIS_ADHT_DATE_FIN;
		}
	}		
			
		
	// filtre d'affichage  les cotisation  adhérents 0 => 'Les fiches actives', 1 => 'Toutes les fiches', 2 => 'Les fiches archivées'
	$filtre_fiche = get_post_variable_numeric('filtre_fiche', '1');  // Toutes les fiches uniquement + EXLURE les fiches archivées
	
	// requette principale    TABLE_COTISATIONS + TABLE_ADHERENTS + TABLE_TYPE_COTISATIONS
	$req_lire_info_cotis = "SELECT id_cotis,id_adhtasso,id_type_cotis,"
	."montant_cotis,date_enregist_cotis,date_debut_cotis,date_fin_cotis,cotis,datemodiffiche_cotis,"
	." prenom_adht,nom_adht," // TABLE_ADHERENTS
	." nom_type_cotisation" // TABLE_TYPE_COTISATIONS
	." FROM ".TABLE_COTISATIONS.", ".TABLE_ADHERENTS.", ".TABLE_TYPE_COTISATIONS 
	." WHERE qui_cotis ='adh' AND ".TABLE_COTISATIONS.".id_adhtasso=".TABLE_ADHERENTS.".id_adht "
	." AND ".TABLE_TYPE_COTISATIONS.".id_type_cotisation=".TABLE_COTISATIONS.".id_type_cotis"
	." AND ".TABLE_COTISATIONS.".cotis <>'999'" // EXLURE les fiches archivées	
	." AND ".TABLE_COTISATIONS.".date_fin_cotis <> '$Date_fin_cotisation_pref' ";
	// ET dont la date de fin de cotisation est antérieure à la date Date fin cotisation du menu  Préférences/Préférence Association 
	
	// requette pour comptage 	
	$reqcompt_info_cotis = "SELECT id_cotis FROM ".TABLE_COTISATIONS." WHERE qui_cotis ='adh' "
	." AND ".TABLE_COTISATIONS.".cotis <>'999'" // EXLURE les fiches archivées	
	." AND ".TABLE_COTISATIONS.".date_fin_cotis <> '$Date_fin_cotisation_pref' "; // ET dont la date de fin de cotisation est antérieure à la date Date fin cotisation		

	// Affichage liste pour seulement 1 seul adhérent
	if ($affiche_liste_complete !== 1) {
		$req_lire_info_cotis .= " AND ".TABLE_COTISATIONS.".id_adhtasso=".$id_adht_cotis ;
		$reqcompt_info_cotis .= " AND id_adhtasso=".$id_adht_cotis ;
	}	

	
	// recherche sur les dates début et fin cotisations par  les filtres "filtre_datedeb" et  "filtre_datefin" 
	if ($filtre_datedeb!='') {
	   $req_lire_info_cotis .= " AND date_debut_cotis >= '".$select_datedeb_sql."' ";
	   $reqcompt_info_cotis .= " AND date_debut_cotis >= '".$select_datedeb_sql."' ";
	}
	
	if ($filtre_datefin!='') {
		$req_lire_info_cotis .= " AND date_fin_cotis <= '".$select_datefin_sql."' ";
		$reqcompt_info_cotis .= " AND date_fin_cotis <= '".$select_datefin_sql."' ";
	}
		
		
	// filtre d'affichage les cotisation  adhérents  0 => 'Les fiches actives', 1 => 'Les fiches achivées', 2 => 'Toutes les fiches'
	if ($filtre_fiche == '0') { // Les fiches active
		$req_lire_info_cotis .= " AND cotis <>'999' AND date_fin_cotis >= '".$date_du_jour."'"; // 16/01/2009  v 3.0.3
		$reqcompt_info_cotis .= " AND cotis <>'999' AND date_fin_cotis >= '".$date_du_jour."'";	// 16/01/2009
	}

	//if ($filtre_fiche == '1') { //Toutes les fiche
		// aucune 
	//}
		
	if ($filtre_fiche == '2') { //Les fiches achivées
		$req_lire_info_cotis .= " AND cotis ='999' ";
		$reqcompt_info_cotis .= " AND cotis ='999' ";
	}


		
	// phase de tri sur les colonnes  #=N°    	 Date Enr    		 Nom Prénom    	 Type Cotis    	 Montant    	 Statut  
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
	$req_lire_info_cotis .= " ORDER BY ";
		
	// tri par colonne Date Enr 
	if ($_SESSION['tri'] == '1') {
		$req_lire_info_cotis .= "date_enregist_cotis ".$tri_sens_txt.',';
	// tri par colonne Date  début
	//	} elseif ($_SESSION['tri'] == '2') {
	//	$req_lire_info_cotis .= "date_debut_cotis ".$tri_sens_txt.',';	
	// tri par colonne Date fin
	} elseif ($_SESSION['tri'] == '3') {
		$req_lire_info_cotis .= "date_fin_cotis ".$tri_sens_txt.',';		
	// tri par colonne Nom + Prénom Bénévole
	} elseif ($_SESSION['tri'] == '4') {
		$req_lire_info_cotis .= "nom_adht ".$tri_sens_txt.',';
	// tri par colonne Type Cotis
	} elseif ($_SESSION['tri'] == '5') {
		$req_lire_info_cotis .= "id_type_cotis ".$tri_sens_txt.',';
	// tri par colonne Montant
	} elseif ($_SESSION['tri'] == '6') {
		$req_lire_info_cotis .= "montant_cotis ".$tri_sens_txt.',';
	// tri par colonne Statut = Archivé ou normal
	//	} elseif ($_SESSION['tri'] == '7') {
	//	$req_lire_info_cotis .= "cotis ".$tri_sens_txt.',';
	}				
		
	// tri par #=N°  = Id adhérents 
	$req_lire_info_cotis .= "id_cotis ".$tri_sens_txt;


	// comptage des fiches
	$dbresult = $db->Execute($reqcompt_info_cotis); //Pour compter le NB d'enregistrements
	$nb_lines = $dbresult->RecordCount() ; // le NB de ligne totales

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

	$dbresult = $db->Execute($req_lire_info_cotis);		
	
	// pour afficher le Nb de ligne par page		
	if ($affiche_nb_lines == 0) {
		$dbresult = $db->Execute($req_lire_info_cotis);	
	} else {
		$dbresult = $db->SelectLimit($req_lire_info_cotis,$affiche_nb_lines,  (($numpage_affiche-1)*$affiche_nb_lines) );	 
	}
	
	// On prépare les données
	while ($dbresult && $row = $dbresult->FetchRow()) {
		$cotis_adht[$indice]['id_cotis'] = $row['id_cotis'];
		$cotis_adht[$indice]['id_adhtasso'] =  $row['id_adhtasso'];			
		$cotis_adht[$indice]['date_enregist_cotis'] = switch_sqlFr_date($row['date_enregist_cotis']);
		$cotis_adht[$indice]['date_debut_cotis'] = switch_sqlFr_date($row['date_debut_cotis']);
		$cotis_adht[$indice]['date_fin_cotis'] = switch_sqlFr_date($row['date_fin_cotis']);
		// Si date cotisation échue
			if (( compare_date($date_du_jour ,  ($row['date_fin_cotis']) )) == FALSE) {
				//Retourne vrai si la date 1 est inférieure ou égale à la date 2, sinon retourne faux. 			
					$cotis_adht[$indice]['date_fin_cotis'] = '<span class="Texterouge" title="Cotisation échue">'
					.$cotis_adht[$indice]['date_fin_cotis'].'</span>';
			}			
		$cotis_adht[$indice]['nom_adht'] =  $row['nom_adht'];	
		$cotis_adht[$indice]['prenom_adht'] =  $row['prenom_adht'];				
		$cotis_adht[$indice]['nom_type_cotisation'] =  $row['nom_type_cotisation'];// 
		$cotis_adht[$indice]['montant_cotis'] =  $row['montant_cotis'];// 			
			if ( $row['cotis'] =='999') {
				$cotis_adht[$indice]['cotis'] =  $row['cotis']; // 999
//				$cotis_adht[$indice]['cotis_txt'] = _LANG_MESSAGE_LISTE_COTIS_ADHT_ARCHIV;// Affichage du statut Archivée
				$cotis_adht[$indice]['datemodiffiche_cotis'] = switch_sqlFr_date($row['datemodiffiche_cotis']);
			}
		$cotis_adht[$indice]['coul'] = $indice % 2; // Pour afficher 1 ligne sur 2  classs= Lignegris0  / Lignegris1
		$tpl->assign('cotis_adht',$cotis_adht); // tableau $cotis_adht[$indice]['xx_adht']	
		$indice++;	
	}
	
	
	// Il n'y a pas d'enregistrement sélectionné
	if ($indice == 1 && $affiche_liste_complete != 1) { // Il n'y a pas d'enregistrement sélectionné  et la liste est personnelle
		// Requette Pour affichage du Nom Prénom en fonction de l'Id adhérent = id_adht_cotis
	    $req_lire_benevol = "SELECT nom_adht,prenom_adht FROM "
		.TABLE_ADHERENTS."  WHERE id_adht= '$id_adht_cotis'";	
		$dbresult = $db->Execute($req_lire_benevol);	
		$tpl->assign('nom_prenom',($dbresult->fields['nom_adht']." ".$dbresult->fields['prenom_adht']));
	}
		

/***** Si on SUPPRIME la fiche cotisaton - Basé sur remplir_cotisations_adht.php*/
	$cotis_adh = array(); // Tableau $cotis_adht[champ de la table] 
		
	$id_cotis_adht = get_post_variable_numeric('id_cotis', '');// l'id de la cotisation existante		
	$supp_fiche_cotis = get_post_variable_numeric('supp_fiche_cotis', ''); // controle si suppression fiche

	if ( ($supp_fiche_cotis == 1) && ($id_cotis_adht) ) {
		// texte du message 
		$cotis_adh['info_archiv_cotis'] = "Arch+ par id=".$_SESSION['ses_id_adht']." ".switch_sqlFr_date($date_du_jour);		
		//on SUPPRIME  .... en fait on met 999  dans le champ  Cotis + Date du jour dans DateModifFiche_Cotis 
		$req_supp_cotis=("UPDATE ".TABLE_COTISATIONS." SET cotis='999',"
		." datemodiffiche_cotis='$date_du_jour' , info_archiv_cotis='$cotis_adh[info_archiv_cotis]'" 
		." WHERE id_cotis='$id_cotis_adht'");	
		$dbresult = $db->Execute($req_supp_cotis);
			if  (! $dbresult) $erreur_saisie ['bd'] = _LANG_MESSAGE_LISTEARCHIV_ADHT_ERREUR. $id_cotis_adht.' supp_cotis';

		// On récupere le Id adht qui vient de la ligne cotisation A supprimer	
		$req_lire_info_idadht = "SELECT id_adhtasso FROM ".TABLE_COTISATIONS
		." WHERE id_cotis='$id_cotis_adht'";
		$dbresult = $db->Execute($req_lire_info_idadht);
			if  (! $dbresult) $erreur_saisie ['bd'] = _LANG_MESSAGE_LISTEARCHIV_ADHT_ERREUR. $id_cotis_adht.' lire_info_idadht';
			
		while ($dbresult && $row = $dbresult->FetchRow()) {	
				$id_result = $row['id_adhtasso']; // 
		}	

// LES vérfications à faire.....
		// vérifier si il y a une autre cotisation pour le même adhérent $id_result V 5.5.0 + 5.5.1 AND cotis <> '999'
		$compt_adht_cotis = "SELECT id_cotis, date_fin_cotis"
		." FROM ".TABLE_COTISATIONS
		." WHERE id_adhtasso ='$id_result' AND cotis <> '999'";
		$dbresult = $db->Execute($compt_adht_cotis);
		if  (! $dbresult) $erreur_saisie ['bd'] = _LANG_MESSAGE_LISTEARCHIV_ADHT_ERREUR. $id_cotis_adht.' compt_adht_cotis';
		$nb_compt_adht_cotis = $dbresult->RecordCount() ; // on compte le Nb cotis pour $id_result

		// vérfier si la fiche _adherent ne contient pas 999 donc serait déja archivée		
		$req_lire_soc_adht = "SELECT soc_adht"
		." FROM ".TABLE_ADHERENTS
		." WHERE id_adht ='$id_result' "; 			
		$dbresult_soc_adht = $db->Execute($req_lire_soc_adht);		
		if  (! $dbresult) $erreur_saisie ['bd'] = _LANG_MESSAGE_LISTEARCHIV_ADHT_ERREUR. $id_cotis_adht.' lire_soc_adht';
		//- si "xx" toutes les cotisations "Bénévole" sont archivées,
		//- si "999" la fiche "Bénévole" a été supprimée (mais la fiche est réactivable).
		//- si "999" la fiche "Bénévole" a été supprimée (mais la fiche est réactivable).
		$check_soc_adht= $dbresult_soc_adht->fields['soc_adht']; // valeur fiche _adherent "s" ou si "vide" ou "xx" ou "999"

			// si Nb cotis pour $id_result = 0 ET QUE la fiche _adherent n'EST PAS déja archivée // VOIR 75
			If ($nb_compt_adht_cotis == 0 && $check_soc_adht <> '999'){		
				// Il faut aussi supprimer le 's'  de  soc_adht  et date_echeance_cotis =0  dans la table TABLE_ADHERENTS 
				$req_supp_cotis_adht=("UPDATE ".TABLE_ADHERENTS
				//." SET soc_adht='xx',  date_echeance_cotis='0000-00-00'" // Null Remplace pour postgresql
				." SET soc_adht='xx',  date_echeance_cotis=NULL "
				." WHERE id_adht='$id_result'");  // Id la suppression
				
			$dbresult = $db->Execute($req_supp_cotis_adht);
			if  (! $dbresult) $erreur_saisie ['bd'] = _LANG_MESSAGE_LISTEARCHIV_ADHT_ERREUR. $id_cotis_adht.' supp_cotis_adht';
			} else { 	
  		
				// si Nb cotis pour $id_result >= 1 on prends la date la cotis qui reste en triant - Le Cas ici
				$compt_last_cotis = "SELECT id_cotis, date_fin_cotis"
				." FROM ".TABLE_COTISATIONS
				." WHERE id_adhtasso ='$id_result' AND cotis <>'999' ORDER BY id_cotis ASC";
				$dbresult = $db->Execute($compt_last_cotis);
				if  (! $dbresult) $erreur_saisie ['bd'] = _LANG_MESSAGE_LISTEARCHIV_ADHT_ERREUR. $id_cotis_adht.' compt_last_cotis';
				while ($dbresult && $row = $dbresult->FetchRow()) {
					$date_result = ($row['date_fin_cotis']); 
				}			
				
				// Il faut modifier la date_echeance_cotis dans table TABLE_ADHERENTS date_echeance_cotis
				$req_modif_date_echeance=("UPDATE ".TABLE_ADHERENTS
				." SET date_echeance_cotis='$date_result'"
				." WHERE id_adht='$id_result'");  // Id la suppression
				$dbresult = $db->Execute($req_modif_date_echeance);
				if  (! $dbresult) $erreur_saisie ['bd'] = _LANG_MESSAGE_LISTEARCHIV_ADHT_ERREUR. $id_cotis_adht.' modif_date_echeance';
				
			} // fin si Nb cotis ...

		if (count($erreur_saisie) == 0) {	
			//ecrit qui a fait la manip		
			$ecritlog = $masession->write_log('ArchiveSérie_Adht_Cotis : '
			.$id_cotis_adht, addslashes($nom_adht).' '.addslashes($prenom_adht));	
			// on retourne à la page apres avoir SUPPRIMé la fiche cotisaton
			header('location: archiverenserie_cotisations_adht.php');			
		}	
									
		
	} // fin  Si on SUPPRIMé la fiche cotisaton   

/***** FIN  Si on SUPPRIMé la fiche cotisaton */

		
/***** ---------------------------------------------------------------------- */

	// Préparation pour Affichage partie Fixe VERS TEMPLATE	 	
	$tpl->assign('version',VERSION); // Version de Gestasso
	$tpl->assign('nom_asso_gestassophp',NOM_ASSO_GESTASSOPHP); // le Nom de l'association				
	$tpl->assign('messagetitre',MESSAGETITRE); // Titre Bandeau haut
	$tpl->assign('priorite_adht',$priorite_adht);
	$tpl->assign('nomprenom_adht',$prenom_adht.' '.$nom_adht);	
	// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE		
	$tpl->assign('id_adht',$id_adht_cotis);	// On passe l'Id adhérent qui a déclencher l'opération		
	$tpl->assign('nb_lines',$nb_lines); // Nb de ligne de requete
	$tpl->assign('nb_pages',$nbpages); // le Nombre de pages totale
	$tpl->assign('numpage',$numpage_affiche); // le N° de la page courrante
	$tpl->assign('affiche_liste_complete',$affiche_liste_complete); // Affichage liste pour seulement 1 seul adhérent si vide
	$tpl->assign('affiche_nb_adht',$affiche_nb_lines); // NB lignes par select
	$tpl->assign('filtre_datedeb',$filtre_datedeb); // Filtrage par Rechercher les dates début 
	$tpl->assign('filtre_datefin',$filtre_datefin); // Filtrage par Rechercher les dates  fin
	$tpl->assign('filtre_fiche',$filtre_fiche);// Filtrage par  parmi  0 Les fiches actives  1 Les fiches achivées 2 Toutes les fiches
	$tpl->assign('filtre_options', $T_AFFICHE_FILTRE_COTISATIONS); // la litse des options  membres actifs, à jour,...
	$tpl->assign('affichenb_adht_options',$T_AFFICHE_NB_PAGE); // Nb de lignes par page
	$tpl->assign('erreur_saisie',$erreur_saisie); // Erreur de saisie sur champs Dates
	$tpl->assign('date_3112',JMA_FIN_COTIS);// date pour fin de cotisation			

	//POUR  AFFICHAGE VERS TEMPLATE		
	$content = $tpl->fetch('adherent/archiverenserie_cotisations_adht.tpl'); // On affiche ...
	$tpl->assign('content',$content);
	$tpl->display('page_index.tpl');	

/***** il y a une erreur ... Si erreur  on envoie vers la page de login ... avec message */				
	} else {
		header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR);  
	}
	
?>
