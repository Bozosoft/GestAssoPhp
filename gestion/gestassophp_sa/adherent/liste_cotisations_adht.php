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
 * @version :  2020
 * @copyright 2007-2020  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */

/**
 *  Directory :  /ROOT_DIR_GESTASSO/adherent/
 *  Fichier :	liste_cotisations_adht.php
 *  Liste des cotisations de tous / ou 1 seul les adhérent(s) pour les Administrateurs
 *  Inspiré pour la partie tri de GALLETTE  v0.63 Copyright (c) 2003 Frédéric Jaqcuot
*/

include_once '../config/connexion.php';
$masession = new sessions(); // -->la classe session 	//session_start();

// Si pas de session ...
$sessionadherent = (empty($_SESSION['ses_id_adht'])) ? $sessionadherent = '' : $sessionadherent = $_SESSION['ses_id_adht'];

// récupération du login et du password correspondant au numéro de session en cours
$logpass = $masession->verifie_LogingPaswd_bd($sessionadherent);
$log = $logpass[0];
$pas = $logpass[1];

// vérification de l'authenticité du visiteur
if (($sessionadherent) && $log == ($_SESSION['ses_login_adht']) && $pas == ($_SESSION['ses_paswd_adht'])) {
/***** ici commence le code en cas d'authentification */

	$priorite_adht = $_SESSION['ses_priorite_adht'];
	$prenom_adht = $_SESSION['ses_prenom_adht']; // pour affichage
	$nom_adht = $_SESSION['ses_nom_adht'] ; // pour affichage

	// Raz de variables
	$id_adht = '';
	$req_lire_info_cotis = '';
	$reqcompt_info_cotis = '';
	$affiche_liste_complete = ''; // affichage de Toutes les cotisation ou seulement 1 seul adhérent
	$filtre_datedeb = '';
	$filtre_datefin = '';
	// Tableau pour affichage
	$cotis_adht = array(); // Tableau $cotis_adht[champ de la table]  passage des data vers TPL
	$erreur_saisie = array(); // Erreur si Champs Obligatoires à saisir
	// initialisation
	$date_du_jour=date("Y-m-d"); // Pour définir la différence entre 2 dates
	$archiceserie = ''; // + V 7.3


	/***** Si ADMINISTRATEUR donc $priorite_adht >4 DROIT DE CONSUTER ET MODIFIER  (4 et 5 n'a PAS le droit) */
	if ($priorite_adht > 5) {
		$id_adht_cotis = get_post_variable_numeric('id_adht', ''); // l'id  adhérent pour affichage liste du seul cotisant
		if ( $id_adht_cotis == '') {
			$affiche_liste_complete = 1; // affichage de la liste complete de Tous les cotisants
		}
	}else {
		$id_adht = $sessionadherent;
		// Message erreur PAS LE DROIT
		header('location: ../adherent/gerer_fiche_adht.php');

	}


	// récupère la variable de la page pour afficher la suite
	$numpage_affiche= get_post_variable_numeric('numpage_affiche', '1'); // par défaut 1 page


	// préparation de l'affichage
	$affiche_nb_lines = get_post_variable_numeric('affiche_nb_adht',NB_LIGNES_PAGE); // par défaut NB_LIGNES_PAGE

	// recherche sur les dates début et fin cotisations par les filtres "filtre_datedeb" et  "filtre_datefin"
	$select_datedeb= get_post_variable('select_datedeb', '');
	if ($select_datedeb) {
		if (( check_madateFR($select_datedeb)) == TRUE) {
			$filtre_datedeb = $select_datedeb;
			$select_datedeb_sql = switch_date($select_datedeb) ; // --> 19xx-02-2x
		} else {
			$filtre_datedeb = '';
			$erreur_saisie['d_datedeb'] = _LANG_MESSAGE_LISTE_COTIS_ADHT_DATE_DEB;
		}
	}

	$select_datefin= get_post_variable('select_datefin', '');
	if ($select_datefin) {
		if (( check_madateFR($select_datefin)) == TRUE) {
			$filtre_datefin = $select_datefin;
			$select_datefin_sql = switch_date($select_datefin) ; // --> 19xx-02-2x
		} else {
			$filtre_datefin = '';
			$erreur_saisie['d_datefin'] = _LANG_MESSAGE_LISTE_COTIS_ADHT_DATE_FIN;
		}
	}


	// filtre d'affichage  les cotisation  adhérents 0 => 'Les fiches actives', 1 => 'Toutes les fiches', 2 => 'Les fiches archivées'
	$filtre_fiche = get_post_variable_numeric('filtre_fiche', '0'); '0'; // affiche par défaut que les fiches actives

	// requête principale TABLE_COTISATIONS +
	$req_lire_info_cotis = "SELECT id_cotis,id_adhtasso,id_type_cotis,"
	."montant_cotis,date_enregist_cotis,date_debut_cotis,date_fin_cotis,cotis,info_archiv_cotis,datemodiffiche_cotis,"
	// + info_archiv_cotis
	." prenom_adht,nom_adht," // TABLE_ADHERENTS
	." nom_type_cotisation" // TABLE_TYPE_COTISATIONS
	." FROM ".TABLE_COTISATIONS.", ".TABLE_ADHERENTS.", ".TABLE_TYPE_COTISATIONS
	." WHERE qui_cotis ='adh' AND ".TABLE_COTISATIONS.".id_adhtasso=".TABLE_ADHERENTS.".id_adht "
	." AND ".TABLE_TYPE_COTISATIONS.".id_type_cotisation=".TABLE_COTISATIONS.".id_type_cotis";

	// requête pour comptage
	$reqcompt_info_cotis = "SELECT id_cotis FROM ".TABLE_COTISATIONS." WHERE qui_cotis ='adh' ";

	// Affichage liste pour seulement 1 seul adhérent
	if ($affiche_liste_complete !== 1) {
		$req_lire_info_cotis .= " AND ".TABLE_COTISATIONS.".id_adhtasso=".$id_adht_cotis ;
		$reqcompt_info_cotis .= " AND id_adhtasso=".$id_adht_cotis ;
	}


	// recherche sur les dates début et fin cotisations par les filtres "filtre_datedeb" et  "filtre_datefin"
	if ($filtre_datedeb != '') {
	   $req_lire_info_cotis .= " AND date_debut_cotis >= '".$select_datedeb_sql."' ";
	   $reqcompt_info_cotis .= " AND date_debut_cotis >= '".$select_datedeb_sql."' ";
	}

	if ($filtre_datefin != '') {
		$req_lire_info_cotis .= " AND date_fin_cotis <= '".$select_datefin_sql."' ";
		$reqcompt_info_cotis .= " AND date_fin_cotis <= '".$select_datefin_sql."' ";
	}


	// filtre d'affichage les cotisation  adhérents  0 => 'Les fiches actives', 1 => 'Les fiches achivées', 2 => 'Toutes les fiches'
	if ($filtre_fiche == '0') { // Les fiches actives  si suppression ou archivage fiche cotis=999
		$req_lire_info_cotis .= " AND cotis <>'999' AND date_fin_cotis >= '".$date_du_jour."'";
		$reqcompt_info_cotis .= " AND cotis <>'999' AND date_fin_cotis >= '".$date_du_jour."'";
	}

	// if ($filtre_fiche == '1') { //Toutes les fiches
		// aucune
	// }

	if ($filtre_fiche == '2') { // Les fiches achivées si suppression ou archivage fiche cotis=999
		$req_lire_info_cotis .= " AND cotis ='999' ";
		$reqcompt_info_cotis .= " AND cotis ='999' ";
	}



	// phase de tri sur les colonnes  #=N°    	 Date Enr    		 Nom Prénom    	 Type Cotis    	 Montant    	 Statut
	if (isset($_GET['tri'])) { // récupère le N° de la colosne de tri
		if (is_numeric($_GET['tri'])) {
			if ($_SESSION['tri'] == $_GET['tri']) {
				$_SESSION['tri_sens'] = ($_SESSION['tri_sens']+1)%2; // 0 ou 1
			} else {
				$_SESSION['tri'] = $_GET['tri'];
				$_SESSION['tri_sens'] = 0;
			}
		}
	}

	// donne le sens du tri ASC ou DESC
	if ($_SESSION['tri_sens'] == '0') { // sens du tri
		$tri_sens_txt = 'ASC';
	} else {
		$tri_sens_txt = 'DESC';
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
	} elseif ($_SESSION['tri'] == '7') {
		if ($filtre_fiche == '2') {
			$req_lire_info_cotis .= "datemodiffiche_cotis ".$tri_sens_txt.',';	// Si Les fiches sont achivées Tri par date
		} else {
			$req_lire_info_cotis .= "cotis ".$tri_sens_txt.',';
		}
	}

	// tri par #=N°  = Id adhérents
	$req_lire_info_cotis .= "id_cotis ".$tri_sens_txt;


	// comptage des fiches
	$dbresult = $db->Execute($reqcompt_info_cotis); // Pour compter le NB d'enregistrements
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
	$nbpages = $nbpages+1; // pour affichage sur template Page  1 2 3... avec lien

	$dbresult = $db->Execute($req_lire_info_cotis);

	// pour afficher le Nb de lignes par page
	if ($affiche_nb_lines == 0) {
		$dbresult = $db->Execute($req_lire_info_cotis);
	} else {
		$dbresult = $db->SelectLimit($req_lire_info_cotis, $affiche_nb_lines, (($numpage_affiche-1)*$affiche_nb_lines));
	}

	// préparation des données
	while ($dbresult && $row = $dbresult->FetchRow()) {
		$cotis_adht[$indice]['id_cotis'] = $row['id_cotis'];
		$cotis_adht[$indice]['id_adhtasso'] = $row['id_adhtasso'];
		$cotis_adht[$indice]['date_enregist_cotis'] = switch_sqlFr_date($row['date_enregist_cotis']);
		$cotis_adht[$indice]['date_debut_cotis'] = switch_sqlFr_date($row['date_debut_cotis']);
		$cotis_adht[$indice]['date_fin_cotis'] = switch_sqlFr_date($row['date_fin_cotis']);
		// Si date cotisation échue
			if ((compare_date($date_du_jour , ($row['date_fin_cotis']))) == FALSE) {
				// Retourne vrai si la date 1 est inférieure ou égale à la date 2, sinon retourne faux.
					$cotis_adht[$indice]['date_fin_cotis'] = '<span class="Texterouge" title="Cotisation échue">'
					.$cotis_adht[$indice]['date_fin_cotis'].'</span>';
			}
		$cotis_adht[$indice]['nom_adht'] = $row['nom_adht'];
		$cotis_adht[$indice]['prenom_adht'] = $row['prenom_adht'];
		$cotis_adht[$indice]['nom_type_cotisation'] = $row['nom_type_cotisation'];
		$cotis_adht[$indice]['montant_cotis'] = $row['montant_cotis'];
			if ( $row['cotis'] == '999') {
				$cotis_adht[$indice]['cotis'] = $row['cotis']; // 999
				$cotis_adht[$indice]['info_archiv_cotis'] = $row['info_archiv_cotis'];
				$archiceserie = substr( $cotis_adht[$indice]['info_archiv_cotis'], 0, 5);
				if ($archiceserie == 'Arch+') {
				$cotis_adht[$indice]['cotis_txt'] = _LANG_MESSAGE_LISTEARCHIV_ADHT_ARCHIV; // Archivée-Série
				} else {
				$cotis_adht[$indice]['cotis_txt'] = _LANG_MESSAGE_LISTE_COTIS_ADHT_ARCHIV; // Affichage du statut Archivée
				}
				$cotis_adht[$indice]['datemodiffiche_cotis'] = switch_sqlFr_date($row['datemodiffiche_cotis']);
			} else { // + else { PHP8.x
				$cotis_adht[$indice]['cotis'] = "1"; // Cause PHP8 Undefined array key "cotis" PHP8.x
			} //+ } PHP8.x
		$cotis_adht[$indice]['coul'] = $indice % 2; // Pour afficher 1 ligne sur 2  classs= Lignegris0 ou Lignegris1
		$tpl->assign('cotis_adht', $cotis_adht); // tableau $cotis_adht[$indice]['xx_adht']
		$indice++;
	}


	// Il n'y a pas d'enregistrement sélectionné
	if ($indice == 1 && $affiche_liste_complete != 1) { // Il n'y a pas d'enregistrement sélectionné  et la liste est personnelle
		// Requête pour affichage du Nom Prénom en fonction de l'Id adhérent = id_adht_cotis
	    $req_lire_benevol = "SELECT nom_adht,prenom_adht FROM "
		.TABLE_ADHERENTS."  WHERE id_adht= '$id_adht_cotis'";
		$dbresult = $db->Execute($req_lire_benevol);
		$tpl->assign('nom_prenom',($dbresult->fields['nom_adht']." ".$dbresult->fields['prenom_adht']));
	}


/***** ------------------------------------------------------------ */
	// Préparation pour Affichage partie Fixe VERS TEMPLATE
	$tpl->assign('version', VERSION); // Version de Gestasso
	$tpl->assign('nom_asso_gestassophp', NOM_ASSO_GESTASSOPHP); // le Nom de l'association
	$tpl->assign('messagetitre', MESSAGETITRE); // Titre Bandeau haut
	$tpl->assign('priorite_adht', $priorite_adht);
	$tpl->assign('nomprenom_adht', $prenom_adht.' '.$nom_adht);
	// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE
	$tpl->assign('id_adht', $id_adht_cotis);	// On passe l'Id adhérent qui a déclencher l'opération
	$tpl->assign('nb_lines', $nb_lines); // Nb de ligne de requête
	$tpl->assign('nb_pages', $nbpages); // le Nombre de pages totale
	$tpl->assign('numpage', $numpage_affiche); // le N° de la page courrante
	$tpl->assign('affiche_liste_complete', $affiche_liste_complete); // Affichage liste pour seulement 1 seul adhérent si vide
	$tpl->assign('affiche_nb_adht', $affiche_nb_lines); // NB lignes par select
	$tpl->assign('filtre_datedeb', $filtre_datedeb); // Filtrage par Rechercher les dates début
	$tpl->assign('filtre_datefin', $filtre_datefin); // Filtrage par Rechercher les dates  fin
	$tpl->assign('filtre_fiche', $filtre_fiche); // Filtrage par  parmi  0 Les fiches actives  1 Les fiches achivées 2 Toutes les fiches
	$tpl->assign('filtre_options', $T_AFFICHE_FILTRE_COTISATIONS); // la litse des options  membres actifs, à jour,...
	$tpl->assign('affichenb_adht_options', $T_AFFICHE_NB_PAGE); // Nb de lignes par page
	$tpl->assign('erreur_saisie', $erreur_saisie); // Erreur de saisie sur champs Dates
	// POUR AFFICHAGE VERS TEMPLATE
	$content = $tpl->fetch('adherent/liste_cotisations_adht.tpl'); // affichage ...
	$tpl->assign('content', $content);
	$tpl->display('page_index.tpl');


} else {
	/***** Si erreur Retour vers la page de login ... avec message */
	header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR);
}

?>
