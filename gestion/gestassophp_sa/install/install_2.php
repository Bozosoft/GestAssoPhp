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
 *  Directory :  /ROOT_DIR_GESTASSO/install/
 *  Fichier :   install_2.php
 *  Installation du système
 *  ENCODAGE UTF-8 sans BOM
*/


	include_once 'include_install.php';  // les variables + les définitions de répertoires

	// Raz de variables
	$erreur_saisie = array(); // tableau
	$config_bd = array(); // Illegal string offset 'drop_bd'
	$config_bd = array('drop_bd' => ''); // Illegal string offset 'drop_bd' // Vide non coché pour Effacement des tables
	// suppression des bases type mysql - reste le choix de mysqli ou postgres
		$T_type_bd = array('mysqli'=>'MySQLi', 'postgres'=>'PostgreSQL');

// echo "DEBUG 2= ".TEMPLATES_LOCATION_INSTAL;  // DEBUG

	if (isset($_POST['valid1'])) {	// suite à la page 1
		$ok_valid = (get_post_variable('valid1', '')); // vérifie que c'est bien la page 1 qui a été envoyée
		if ($ok_valid == 'valid1') {

			$masession = new sessions(); // -->la classe session
			//Gestion erreur retour arrière depuis page 5
			if ( isset($_SESSION['id_install2']) && $_SESSION['id_install2'] == '1') {
				$texterreurretour_ar = 'Op&eacute;ration retour arri&egrave;re INTERDITE !';
				header('location: install_5.php?id_adht=1&e_rar='.$texterreurretour_ar);
						exit;
			}

/*****  affichage de la fiche la première fois */
			//$config_bd = ''; // Cannot assign an empty string to a string offset
			$config_bd['type_bd'] = ''; // Type de base de données 	 	//$T_type_bd
			$config_bd['serveur_bd'] = 'localhost'; // Addresse du serveur de base de données
			$config_bd['nom_bd'] = 'gestassosimpl'; // Nom de la base de données
			$config_bd['utilis_bd'] = 'root'; // Nom d'utilisateur
			$config_bd['motpas_bd'] = ''; // Mot de passe
			$config_bd['prefix_bd'] = 'gsa_'; // Préfix des tables
/***** FIN affichage de la fiche la première fois */

		} else {
			$config_bd = '';
			header('location: index.php');
		}

	}


/***** Si validation du Formulaire par le bouton Valider */
	if (isset($_POST['valid2'] )) { // validation de la page 2 .tpl

		$ok_valid2 = (get_post_variable('valid2', ''));
// echo "DEBUG---> ". $ok_valid2 ."<br>";  // DEBUG
		/***** Récupération des variable du formulaire */
		$config_bd['type_bd'] = post_variable('type_bd', ''); // 'MySQL ou  postgres'; //Type de base de données
// echo "DEBUG type = ". $config_bd['type_bd']."<br>";  // DEBUGG
		$config_bd['serveur_bd'] = post_variable('serveur_bd', ''); // Addresse du serveur de base de données
// echo "DEBUG serveur = ". $config_bd['serveur_bd']."<br>";  // DEBUGG
		$config_bd['nom_bd'] = post_variable('nom_bd', ''); // Nom de la base de données
// echo "DEBUG nom_bd = ". $config_bd['nom_bd']."<br>";  // DEBUG
		$config_bd['utilis_bd'] = post_variable('utilis_bd', ''); // Nom de la base de données
// echo "DEBUG utilis = ". $config_bd['utilis_bd']."<br>";  // DEBUG
		$config_bd['motpas_bd'] = post_variable('motpas_bd', ''); // Mot de passe
// echo "DEBUG motpas = ". $config_bd['motpas_bd']."<br>";  // DEBUG
		$config_bd['prefix_bd'] = post_variable('prefix_bd', 'gs0_'); // Préfix des table
// echo "DEBUG prefix = ". $config_bd['prefix_bd']."<br>";  // DEBUG
		$config_bd['drop_bd'] = post_variable('drop_bd', ''); // drop table coché oui = on  = Effacement des tables
// echo "DEBUG drop = ". $config_bd['drop_bd']."<br>";  // DEBUG


		if ($config_bd['serveur_bd'] == '') {
			$erreur_saisie['serveur_bd'] = 'Addresse du serveur de base de donn&eacute;es';
		}
		if ($config_bd['nom_bd'] == '') {
			$erreur_saisie['nom_bd'] = 'Nom de la base de donn&eacute;es';
		}
		if ($config_bd['utilis_bd'] == '') {
			$erreur_saisie['utilis_bd'] = 'Nom utilisateur';
		}
		if 	($config_bd['serveur_bd'] != 'localhost') {
			if ($config_bd['motpas_bd'] == '') {
				$erreur_saisie['motpas_bd'] = 'Mot de passe';
			}
		}

/***** cas bd =	postgres */
		if ($config_bd['type_bd'] == 'postgres') {
			if ($config_bd['motpas_bd'] == '') {
				$erreur_saisie['motpas_bd'] = 'Mot de passe postgres vide';
			}
		}

		if ( !preg_match('/^[a-zA-Z0-9_]+$/', trim($config_bd['prefix_bd'])) ) {
			$erreur_saisie['prefix_bd'] = 'Le pr&eacute;fix des tables de base de donn&eacute;es contient des caract&egrave;res invalides !';
		}

/***** Test Connexion à la  base données */
	// Creé une connexion sur la Base de donnée
	$db = ADONewConnection($config_bd['type_bd']); //crée une connexion
	$db->debug = false; // true; // false; // Mode débug ou Non
// echo "DEBUG TESTpg = " .$pgsql_conn." -->".$config_bd['nom_bd'] ." + ".$config_bd['serveur_bd']." + ".$config_bd['utilis_bd']." +" .$config_bd['motpas_bd'];  // DEBUG
	// cherche  un port existe pour postgres
	$dbport = '';	 // en général $dbport = '5432';
		if ( ($config_bd['type_bd']) == "postgres") {
			$pgsql_conn = pg_connect("dbname=".$config_bd['nom_bd']." host=".$config_bd['serveur_bd']
			." user=".$config_bd['utilis_bd']." password=".$config_bd['motpas_bd']." ");
			if ($pgsql_conn) {
			   $dbport = pg_port($pgsql_conn) ;

			}else {
				$erreur_saisie['connexion'] = 'Connexion base de donn&eacute;es '. $config_bd['type_bd'] .' impossible !!!';
// décommenter les 2 lignes pour Free.fr pour éviter erreurs
// echo "S&eacute;lection de la base de donn&eacute;es PostgreSQL impossible !!!";
// exit;
// Fin de décommenter pour Free.fr pour éviter erreurs
			}

/***** ATTENTION uniquement pour Free.fr */
// TEST sur free.fr Supprimer les lignes suivantes SINON erreur : Connexion base de données PostgreSQL impossible !!!
/*
			if(!@$db->Connect($config_bd['serveur_bd'], $config_bd['utilis_bd'], $config_bd['motpas_bd'], $config_bd['nom_bd'],$dbport)) {
				$erreur_saisie['connexion'] = 'Connexion base de donn&eacute;es PostgreSQL impossible !!! ';
				if(!@$db->Connect(SERVEUR_BD, NOMUTILISATEUR_BD, MOTPASSE_BD, NOM_BD)) die("S&eacute;lection de la base de donn&eacute;es PostgreSQL impossible !!!");
			}
*/
/***** Fin pour Free.fr */
		} else {
			if(!@$db->Connect($config_bd['serveur_bd'], $config_bd['utilis_bd'], $config_bd['motpas_bd'], $config_bd['nom_bd'])) {
				$erreur_saisie['connexion'] = 'Connexion base de donn&eacute;es '. $config_bd['type_bd'] .' impossible !!!';
				// $config_bd['type_bd'] = mysqli ou postgres
			}
		}
	// Fin check port BD

		if (count($erreur_saisie) == 0  && $ok_valid2 == 'valid2') { // si pas d'erreur Et validation de la page 2 .tpl
		// Si Aucune erreur de saisie validation des données
			$masession = new sessions(); // -->la classe session 	//session_start();
			$_SESSION['type_bd'] = $config_bd['type_bd'];
			$_SESSION['serveur_bd'] = $config_bd['serveur_bd'];
			$_SESSION['nom_bd'] = $config_bd['nom_bd'];
			$_SESSION['utilis_bd'] = $config_bd['utilis_bd'];
			$_SESSION['motpas_bd'] = $config_bd['motpas_bd'];
			$_SESSION['prefix_bd'] = $config_bd['prefix_bd'];
			$_SESSION['drop_bd'] = $config_bd['drop_bd'];
			$_SESSION['valid2'] = 'valid2';
		// Passage à la page suivante
			header('location: install_3.php?valid2=ok'); // passe à la page 3
		}

		// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE
		$tpl->assign('config_bd', $config_bd); // réaffiche les informations dans le formulaire de saisie

/***** FIN Si validation du Formulaire par le bouton Valider */
	}


/***** Recherche pour savoir si Driver postgres (PostgreSQL Support) et/ou mysqli (MySQL Support) existe */
		$postgres = function_exists('pg_connect');
		$pgsql_bd = 'PostgreSQL : '.($postgres ? 'Oui' : '<strong>Non</strong>');
		$mysqli = function_exists('mysqli_connect');
		$mysqli_bd = 'MySQLi  : '.($mysqli ? 'Oui' : '<strong>Non</strong>');
		$tpl->assign('pgsql_bd', $pgsql_bd); //
		$tpl->assign('mysql_bd', $mysqli_bd); //


/***** ------------------------------------------------------------ */
	// Préparation pour Affichage partie Fixe VERS TEMPLATE
	$tpl->assign('version_i', VERSION_I); // version installateur
	$tpl->assign('style_i', STYLE_I); // Feuille de syle  style_screen.css ou m_style_screen.css
	$tpl->assign('messagetitre', 'Information sur la base de donn&eacute;es'); // titre de la  page
	$tpl->assign('Etape1', 'Etape 1 - OK'); // menu
	$tpl->assign('Etape2', '<span class="TextenoirGras">Etape 2</span>'); // menu
		$tpl->assign('Etape3', '<span class="TextenoirR">Etape 3</span>'); // menu
		$tpl->assign('Etape4', '<span class="TextenoirR">Etape 4</span>'); // menu
		$tpl->assign('Etape5', '<span class="TextenoirR">Etape 5</span>'); // menu
	$tpl->assign('titre', 'Etape 2'); // Titre de la page
	$tpl->assign('list_type_bd', $T_type_bd);

	$tpl->assign('erreur_saisie', $erreur_saisie); // Erreur de saisie
	$tpl->assign('config_bd', $config_bd); // le tableau des variables de configuration
	//$tpl->assign('message', $message); // information connexion BD OK

	$content = $tpl->fetch('install_2.tpl'); // affichage ...
	$tpl->assign('content', $content);
	$tpl->display('index_instal.tpl');
