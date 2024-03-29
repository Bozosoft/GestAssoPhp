<?php
/**
 * Projet : gestassophp_sa [GestAssoPhp+Pg]
 * ---------------------------
 * Licence Creative Commons selon les termes du présent contrat appelé Contrat Public Creative Commons
 * Auteur original : Jean-Claude Etiemble
 * @link :  http://creativecommons.org/licenses/by-sa/2.0/fr/  - Paternité - Partage à l'Identique 2.0 France (CC BY-SA 2.0)
 * ---------------------------
 *
 * @author :  JC Etiemble - http://jc.etiemble.free.fr
 * @version : 2022
 * @copyright 2007-2022  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */

/**
 *  Directory :  /ROOT_DIR_GESTASSO/admin/
 *  Fichier :	remplir_preferences.php
 *  Préférences et Antennes(sections) de GestAssophp_s
*/

include_once '../config/connexion.php';
$masession = new sessions(); // -->la classe session //session_start();

// Si pas de session ...
$sessionadherent = (empty($_SESSION['ses_id_adht'])) ? $sessionadherent = '' : $sessionadherent = $_SESSION['ses_id_adht'];

// récupération du login et le password correspondant au numéro de session en cours
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
	$antenne = '';
	$indice = '0'; // Modification = '0' sinon PHP8 =>Fatal error: Uncaught TypeError: abs(): Argument #1 ($num)
	// Tableau pour affichage
	$preference_asso = array();
	$antenne = array(); // 12/01/17
	$new_antenne = array();
	$type_cotisation = array();
	$new_type_cotisation = array();
	$erreur_saisie = array(); // Erreur si Champs Obligatoires à saisir
	$required = array();
	// initialisation
	$date_du_jour=date('Y-m-d'); // la date du jour


	/***** Si ADMINISTRATEUR donc $priorite_adht  > ou = 4 DROIT DE CONSUTER ET MODIFIER (4 a le droit) */
	if ($priorite_adht < 8 ) {  // INTERDIT
		$id_adht = $sessionadherent;
		// Message erreur PAS LE DROIT
		header('location: ../adherent/gerer_fiche_adht.php');
	}

	// récupération des valeurs
	$tab = get_post_variable_numeric('tab', '1'); // l'onglet par défaut l'onglet 1


/***** Si validation du Formulaire par le bouton Valider pour onglet 1  - preference_asso */
	if (isset($_POST['valid_tab1']) ) {
		$pref_asso[1] = (get_post_variablehtml('messagetitre', '')); // (1, 'messagetitre'
		$pref_asso[2] = (get_post_variablehtml('nom_asso_gestassophp', '')); //(2, 'nom_asso_gestassophp'
		$pref_asso[3] = (get_post_variable_numeric('date_debannee_asso', '')); //(3, 'date_debannee_asso'
		$pref_asso[4] = (get_post_variable_numeric('nb_lignes_page', '20')); //(4, 'nb_lignes_page'
		$pref_asso[5] = (get_post_variable('email_adresse', '')); //(5, 'email_adresse'
		$pref_asso[6] = (get_post_variablehtml('adherent_bene', '')); // (6, 'adherent_bene',
		$pref_asso[7] = (get_post_variablehtml('_lang_fiche_adht_ant', '')); //(7, '_lang_fiche_adht_ant'
//--
		$pref_asso[8] = SITEMASK;
		$pref_asso[9] = (get_post_variablehtml('jma_fin_cotis', '')); //(9, Jour/mois de "Date fin cotisation"
//--
		// vérification Non vide
		//$erreur_saisie['champ'] == '';
		if 	($pref_asso[1] == '' || $pref_asso[2] == '' || $pref_asso[3] == '' || $pref_asso[4] == ''  || $pref_asso[6] == '' || $pref_asso[7] == ''  || $pref_asso[9] == '') {
				$erreur_saisie['champ'] =_LANG_MESSAGE_REMPLIR_CHAMP ;
// echo "DEBUG ES ".$erreur_saisie['champ'];
		}

		// contrôle date fin cotis parrapport date du jour
		if ($pref_asso[9] > $date_du_jour) {
			$alert_saisie['date'] = 1 ;
		}
		// contrôle date au format jj/mm/aaaa
		if 	(( check_madateFR($pref_asso[9]) ) == FALSE) {
				$erreur_saisie['date'] = '!! '.$pref_asso[9].' '. _LANG_MESSAGE_LISTE_COTIS_ADHT_DATE_FIN ;
		}

		// vérification email pour Administrateur
		if 	($pref_asso[5] == '') {
				$erreur_saisie['email'] = _LANG_MESSAGE_REMPLIR_CHAMP ;
		}
		if 	($pref_asso[5] != '') {
			if (!is_valid_email($pref_asso[5])) {
				$erreur_saisie['email'] = _LANG_MESSAGE_REMPLIR_ERR_MAIL ;
			}
		}

		if (count($erreur_saisie) == 0) {
		// Si Aucune erreur de saisie validation
		// Modification 1 à 9 pour ajout 8 SITEMASK et 9 Jour/mois de "Date fin cotisation"
			for ($i = 1, $c = 10; $i < $c; $i++) {
				$req_ecrit_modif = "UPDATE ".TABLE_PREFERENCES ." SET val_pref='$pref_asso[$i]' WHERE id_pref='$i'";
//				$qi = mysql_query($req_ecrit_modif);
				$dbresult = $db->Execute($req_ecrit_modif);
			}
			// écrit qui a fait la manip
			$ecritlog = $masession->write_log('Modif_preference_asso ', addslashes($nom_adht).' '.addslashes($prenom_adht));
			// retour à la page ... gerer_fiche_adht
			header('location: remplir_preferences.php');
		}
	/***** FIN Si validation du Formulaire par le bouton Valider pour onglet 1 */
	}



/***** Si onglet 2 - # Détail des désignation des activités */
	if ($tab == 2 ) {
		$modifok = get_post_variable_numeric('modifant', ''); // pour modifier
		$id_type_antenne_modif = get_post_variable_numeric('id_ant', ''); // ID antenne

		if ( $id_type_antenne_modif == '') { // On crée un nouveau nom
			$required['creation_ant'] = 1; // il faut créer
		}
		/***** Si on cliqué sur modifier le Nom  pour  onglet 2 - # Détail des désignation des activités */
		if ($modifok == 1 && $id_type_antenne_modif != 0 ) {
			$req_lire_info = "SELECT id_type_antenne,nom_type_antenne FROM ".TABLE_ANTENNE." WHERE id_type_antenne='$id_type_antenne_modif'";
			$dbresult = $db->Execute($req_lire_info);
			$new_antenne['nom_type_antenne'] = $dbresult->fields['nom_type_antenne'];
//			$new_antenne['nom_type_antenne'] = stripslashes($dbresult->fields['nom_type_antenne']);	//SI magic_quotes_gpc	est à On
			$new_antenne['id_type_antenne'] = $dbresult->fields['id_type_antenne'];
		/*****  FIN Si on cliqué sur modifier le Nom  pour  onglet 2 - # Détail des désignation des activités */
		}

/***** Si validation du Formulaire par le bouton Valider pour onglet 2 - # Détail des désignation des activités */
		if (isset($_POST['valid_tab2']) ) {
		/***** Récupération des variable du formulaire */
		$new_nom_type_antenne = addslashes(get_post_variable('new_nom_type_antenne', ''));
		// verification Non vide
		if ($new_nom_type_antenne == '' || $new_nom_type_antenne == ' ') {  // si vide ou 1 espace
				$erreur_saisie['nom_antenne'] = _LANG_MESSAGE_REMPLIR_NOM ;
		}
		/***** On crée un nouveau nom */
			if ( !empty($required['creation_ant']) && $required['creation_ant'] == 1) {
				if (count($erreur_saisie) == 0) {
					// Si Aucune erreur de saisie validation
					$req_ecrit_nouvelle_ant = "INSERT INTO ".TABLE_ANTENNE." (nom_type_antenne)"
					." VALUES('$new_nom_type_antenne')";
					$dbresult = $db->Execute($req_ecrit_nouvelle_ant);

					$id_type_antenne = my_last_id('id_type_antenne',TABLE_ANTENNE); // récupération du N° de la derniere Insertion
					// écrit qui a fait la manip
					$ecritlog = $masession->write_log('Creation_Antenne_asso id : '
					.$id_type_antenne, addslashes($nom_adht).' '.addslashes($prenom_adht));
					// retour à la page ...
					header('location: remplir_preferences.php?tab=2');
				}

			} else {  /*****  cas modification du nom, on Update simplement */
				if (count($erreur_saisie) == 0) {
					// Si Aucune erreur de saisie Udpate
					$req_ecrit_modif_ant = "UPDATE ".TABLE_ANTENNE
					." SET nom_type_antenne='$new_nom_type_antenne' WHERE id_type_antenne='$id_type_antenne_modif'";
					$dbresult = $db->Execute($req_ecrit_modif_ant);
					// écrit qui a fait la manip
					$ecritlog = $masession->write_log('Modif_Antenne_asso id : '
					.$id_type_antenne_modif, addslashes($nom_adht).' '.addslashes($prenom_adht));
					// retour à la page ...
					header('location: remplir_preferences.php?tab=2');
				}

			}

		/***** FIN Sivalidation du Formulaire par le bouton Valider pour onglet 2 */
		}
		/***** préparation de l'affichage des informations sur Détail des désignation des activités */
		// par défaut 1 page
		// requête principale  lire	 N° 		Nom des activités
		$req_lire_ant = "SELECT id_type_antenne,nom_type_antenne FROM ".TABLE_ANTENNE ;
		$req_lire_ant .= " ORDER BY ";
		// requête pour comptage
		$reqcompt_ant = "SELECT id_type_antenne FROM ".TABLE_ANTENNE ;

		// phase de tri par colonne Adht  	N° 		Nom des activités
		if (isset($_GET['tri'])) { // récupere le N° de la colosne de tri
			if (is_numeric($_GET['tri'])) {
				if ($_SESSION['tri'] == $_GET['tri']) {
					$_SESSION['tri_sens'] = ($_SESSION['tri_sens']+1)%2; // 0 ou 1
				} else {
					$_SESSION['tri'] = $_GET['tri'];
					$_SESSION['tri_sens'] = 0;
				}
			}
		}

		if ($_SESSION['tri_sens'] == '0') {// sens du tri
			$tri_sens_txt = 'ASC';
		} else {
			$tri_sens_txt = 'DESC';
		}

		// tri par colonne id
		if ($_SESSION['tri'] == '0') {
			$req_lire_ant .= "id_type_antenne ".$tri_sens_txt.',';
		} elseif ($_SESSION['tri'] == '1') {
			$req_lire_ant .= "nom_type_antenne ".$tri_sens_txt.',';
		}

		$req_lire_ant .= "id_type_antenne ".$tri_sens_txt;

		// pour afficher le Nb de lignes par page
		// comptage des fiches
		$dbresult = $db->Execute($reqcompt_ant); // Pour compter le NB d'enregistrements
		$nb_lines= $dbresult->RecordCount() ; // le NB de lignes totales
		$dbresult = $db->Execute($req_lire_ant);

		// préparation des données
		while ($dbresult && $row = $dbresult->FetchRow()) {
			$antenne[$indice]['id_type_antenne'] = $row['id_type_antenne'];
			$antenne[$indice]['nom_type_antenne'] = $row['nom_type_antenne'];
//			$antenne[$indice]['nom_type_antenne'] = stripslashes($row['nom_type_antenne']); //SI magic_quotes_gpc	est à On
			$antenne[$indice]['coul'] = abs($indice) % 2 ; //12/01/17 // Pour afficher 1 ligne sur 2  classs= Lignegris0  / Lignegris1
			$indice++;
		}
		/***** FIN de préparation de l'affichage des informations */

	/***** FIN Si onglet 2 - # Détail des désignation des activités */
	}



/***** Si onglet 3 - # type_cotisations */
	if ($tab == 3 ) {
		$modifcok = get_post_variable_numeric('modifc', ''); // pour modifier
		$id_type_cotis_modif = get_post_variable_numeric('id_typecotis', ''); // ID cotis
// echo 'DEBUG idd='. $id_type_cotis_modif .'->';
		if ( $id_type_cotis_modif == '') { // On crée un nouveau nom
			$required['creation_type_cotis'] = 1; // il faut créer
		}
		/***** Si validation sur modifier le Nom pour onglet 3 - # type_cotisations */
		if ($modifcok == 1 && $id_type_cotis_modif != 0 ) {
			$req_lire_info_cotis = "SELECT id_type_cotisation,nom_type_cotisation, montant_cotisation FROM "
			.TABLE_TYPE_COTISATIONS." WHERE id_type_cotisation='$id_type_cotis_modif'";
			$dbresult = $db->Execute($req_lire_info_cotis);
			$new_type_cotisation['nom_type_cotisation'] = $dbresult->fields['nom_type_cotisation'];
			$new_type_cotisation['id_type_cotisation'] = $dbresult->fields['id_type_cotisation'];
			$new_type_cotisation['montant_cotisation'] = $dbresult->fields['montant_cotisation']; // + new_montant_cotisation

		/*****  FIN Si validation sur modifier le Nom  pour onglet 3 - # type_cotisations */
		}


/***** Si validation par le Formulaire par le bouton Valider pour onglet 3 - # type_cotisation */
		if (isset($_POST['valid_tab3']) ) {
		/***** Récupéation des variable du formulaire */
		$new_nom_type_cotisation = get_post_variablehtml('new_nom_type_cotisation', ''); // si vide ou 1 espace
		// vérification Non vide
		if ($new_nom_type_cotisation == '' || $new_nom_type_cotisation == ' ') {
				$erreur_saisie['nom_type_cotisation'] = _LANG_MESSAGE_REMPLIR_NOM ;
//+
$new_type_cotisation['nom_type_cotisation'] = $new_nom_type_cotisation ; // + réécrit si erreur
				$tpl->assign('new_type_cotisation', $new_type_cotisation); // + réécrit si erreur
//+
		}
//+
		$new_montant_cotisation = (get_post_variable('new_montant_cotisation', '0'));
		if (  !is_numeric($new_montant_cotisation) ) {
			$erreur_saisie['montant_cotisation'] = _LANG_MESSAGE_COTIS_ADHT_ALERT_MONTANT;
			$new_type_cotisation['nom_type_cotisation'] = $new_nom_type_cotisation ; // + réécrit si erreur
			$new_type_cotisation['montant_cotisation'] = $new_montant_cotisation ; // + réécrit si erreur
			$tpl->assign('new_type_cotisation', $new_type_cotisation); // + réécrit si erreur
		}
//+

		/*****  On à créé un nouveau nom */
			if ( !empty($required['creation_type_cotis']) && $required['creation_type_cotis'] == 1) {
				if (count($erreur_saisie) == 0) {
					// Si Aucune erreur de saisie validation
					$req_ecrit_nouvelle_cot = "INSERT INTO ".TABLE_TYPE_COTISATIONS." (nom_type_cotisation, montant_cotisation)"
					." VALUES('$new_nom_type_cotisation','$new_montant_cotisation' )";	// + new_montant_cotisation
					$dbresult = $db->Execute($req_ecrit_nouvelle_cot);
					$id_type_cotisation = my_last_id('id_type_cotisation',TABLE_TYPE_COTISATIONS); // on récupere le N° de la derniere Insertion
					// écrit qui a fait la manip
					$ecritlog = $masession->write_log('Creation_Type_Cotis id : '
					.$id_type_cotisation, addslashes($nom_adht).' '.addslashes($prenom_adht));
					// retour à la page ...
					header('location: remplir_preferences.php?tab=3');
				}

			} else {  /*****  cas modification du nom, on Update simplement */
				if (count($erreur_saisie) == 0) {
					// Si Aucune erreur de saisie Udpate
					$req_ecrit_modif_cot = "UPDATE ".TABLE_TYPE_COTISATIONS
					." SET nom_type_cotisation='$new_nom_type_cotisation',montant_cotisation ='$new_montant_cotisation' WHERE id_type_cotisation='$id_type_cotis_modif'"; // + new_montant_cotisation
					$dbresult = $db->Execute($req_ecrit_modif_cot);
					// écrit qui a fait la manip
					$ecritlog = $masession->write_log('Modif_Type_Cotis id : '
					.$id_type_cotis_modif, addslashes($nom_adht).' '.addslashes($prenom_adht));
					// retour à la page ...
//					header('location: remplir_preferences.php?tab=3');
				}

			}

		/***** FIN Si validation du Formulaire par le bouton Valider pour onglet 3 - # type_cotisations */
		}


		/***** préparation de l'affichage des informations sur type_cotisation */
		// par défaut 1 page
		// requête principale  lire		N° 	Nom des types de cotisation   Montant cotisation
		$req_lire_cotis = "SELECT id_type_cotisation,nom_type_cotisation ,montant_cotisation FROM ".TABLE_TYPE_COTISATIONS ; //+ montant_cotisation
		$req_lire_cotis .= " ORDER BY ";
		// requête pour comptage
		$reqcompt_cotis = "SELECT id_type_cotisation FROM ".TABLE_TYPE_COTISATIONS ;

		// phase de tri par colonne  Adht   	N° 	Nom des types de cotisation
		if (isset($_GET['tri'])) { // récupere le N° de la colosne de tri
			if (is_numeric($_GET['tri'])) {
				if ($_SESSION['tri'] == $_GET['tri']) {
					$_SESSION['tri_sens'] = ($_SESSION['tri_sens']+1)%2; // 0 ou 1
				} else {
					$_SESSION['tri'] = $_GET['tri'];
					$_SESSION['tri_sens'] = 0;
				}
			}
		}
// echo 'DEBUG Sens'.$_SESSION['tri_sens'];
		if ($_SESSION['tri_sens'] == '0') {// sens du tri
			$tri_sens_txt = 'ASC';
		} else {
			$tri_sens_txt = 'DESC';
		}

		// tri par colonne id
// echo "DEBUG Senstri'.$_SESSION['tri'];
		if ($_SESSION['tri'] == '0') {
			$req_lire_cotis .= "id_type_cotisation ".$tri_sens_txt.',';
		} elseif ($_SESSION['tri'] == '1') {
			$req_lire_cotis .= "nom_type_cotisation ".$tri_sens_txt.',';
		}

		$req_lire_cotis .= "id_type_cotisation ".$tri_sens_txt;

		// pour afficher le Nb de lignes par page
		// comptage des fiches
		$dbresult = $db->Execute($reqcompt_cotis); // Pour compter le NB d'enregistrements
		$nb_lines= $dbresult->RecordCount() ; // le NB de lignes totales
		$dbresult = $db->Execute($req_lire_cotis);

		// préparation des données
		while ($dbresult && $row = $dbresult->FetchRow()) {
			$type_cotisation[$indice]['id_type_cotisation'] = $row['id_type_cotisation'];
			$type_cotisation[$indice]['nom_type_cotisation'] = $row['nom_type_cotisation'];
			$type_cotisation[$indice]['montant_cotisation'] = $row['montant_cotisation']; //+ new_montant_cotisation
			$type_cotisation[$indice]['coul'] = abs($indice) % 2; //12/01/17 // Pour afficher 1 ligne sur 2  classs= Lignegris0  / Lignegris1
			$indice++;
		}


		/***** FIN de préparation de l'affichage des informations */

	/***** FIN Si onglet 3 - # type_cotisations */
	}

/***** Si onglet 4 - # affichage Changelog */
	if ($tab == 4 ) {

		$ch_filename = join_path(ROOT_DIR_GESTASSO, 'doc', 'Changelog.txt');
		$changelog = file($ch_filename);

		for ($i = 0; $i < count($changelog); $i++) {
		  if (strstr($changelog[$i], 'Version')) {
			  if ($i == 0) {
				  $changelog[$i] = "<div class=\"version\"><h4>" . $changelog[$i] . "</h4>";
			  } else {
				  $changelog[$i] = "</div><div class=\"version\"><h4>" . $changelog[$i] . "</h4>";
			  }

		  }
		}
		$changelog = implode("<br>", $changelog);
		$tpl->assign("changelog",$changelog);
		$tpl->assign("changelogfilename",$ch_filename);

	/***** FIN Si onglet 4 -# affichage Changelog */
	}

/********* On recupère les informations déja enregistrées */
	// On lit la table preference_asso   id_pref design_pref  val_pref
	$req_lire_pref = "SELECT * FROM  ".TABLE_PREFERENCES;
	$dbresult = $db->Execute($req_lire_pref);
	while ($dbresult && $row = $dbresult->FetchRow()) {
		$preference_asso [($row['design_pref'])] = ($row['val_pref']) ;
   	}

/********* FIN On recupère les informations déja enregistrées */

/***** ------------------------------------------------------------ */
	// Préparation pour Affichage partie Fixe VERS TEMPLATE
	$tpl->assign('version', VERSION); // Version de Gestasso
	$tpl->assign('nom_asso_gestassophp', NOM_ASSO_GESTASSOPHP); // le Nom de l'association
	$tpl->assign('messagetitre', MESSAGETITRE); // Titre Bandeau haut
	$tpl->assign('priorite_adht', $priorite_adht);
	$tpl->assign('nomprenom_adht', $prenom_adht.' '.$nom_adht);
	// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE
	$tpl->assign('tab', $tab); // pour afficher l'onglet
	$tpl->assign('preference_asso', $preference_asso); // tableau original pour affichage
	$tpl->assign('new_antenne', $new_antenne); // tableau modification désignation des activités
	$tpl->assign('antenne', $antenne); // tableau original pour affichage des Nom des activités
	$tpl->assign('PHPVersion', phpversion()); // ajout 03/10/18 Version PHP
	$tpl->assign('new_type_cotisation', $new_type_cotisation); // tableau modification types de cotisations
	$tpl->assign('type_cotisation', $type_cotisation); // tableau original pour affichage des types de cotisation 
	$tpl->assign('erreur_saisie', $erreur_saisie); // Erreur de saisie sur champs Obligatoires
	// POUR  AFFICHAGE VERS TEMPLATE
	$content = $tpl->fetch('admin/remplir_preferences.tpl'); // affichage ...
	$tpl->assign('content', $content);
	$tpl->display('page_index.tpl');


} else {
	/***** Si erreur Retour vers la page de login ... avec message */
	header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR);
}
