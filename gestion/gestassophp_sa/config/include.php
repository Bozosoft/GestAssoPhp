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
 *  Directory :  /ROOT_DIR_GESTASSO/config/
 *  Fichier :   include.php
 *  Les fichiers Include  et les chemins de repertoires  et les menus pour les templates page_index et login
 *  MODIFICATIONS
 *  - 08/08/2008 Maintenance base données
 *  - 22/08/2008 Refonte pour ajout fichier Langues
 *  - 11/11/2020 Modifications PHP 8.x et Smarty
*/

/**
* --------------------------------------------------------------------
*  NOM DES TABLES BASE DE DONNEES
*  ---- ATTENTION --- NE PAS MODIFIER
*  SANS MODIFIER LE NOMS DES TABLES EN BASE DE DONNEES !!
* --------------------------------------------------------------------
*/
	// TABLES ADHERENTS
	define('TABLE_ADHERENTS', DB_PREFIX.'adherent'); // Administration - Gestion des Adhérents
	// TABLES pour écrire les logs
	define('TABLE_LOGS', DB_PREFIX.'logs'); // Historique des connexions
	// Table cotisation pour les adhérents
	define('TABLE_COTISATIONS', DB_PREFIX.'cotisations'); // Administration - Gestion des cotisations Adhérents
	// Table Type de cotisation
	define('TABLE_TYPE_COTISATIONS', DB_PREFIX.'types_cotisations'); // Détail des types de cotisations
	// Table pour gestion fichiers
	define("TABLE_FICHIER_ADHERENTS", DB_PREFIX.'fichier_adherent'); // Administration - Gestion des fichiers Adhérents
	// Table pour lire les preference_asso	//+ V. 3
	define("TABLE_PREFERENCES", DB_PREFIX.'preference_asso'); // Année de début, ... Date fin cotisation
	// Table pour lire les preference_asso	//+ V. 3
	define("TABLE_ANTENNE", DB_PREFIX.'types_antennes'); // Détail des désignation des activités

/** --------------------------------------------------------------- */

/***** Les chemins fonctions et classes */
	//NOTA le repertoire de gestasso =  ROOT_DIR_GESTASSO Défini dans   fileloc_gestasso à la racine du site
	include ROOT_DIR_GESTASSO.DIRECTORY_SEPARATOR.'include/fonctions.php'; // les fonctions
// echo "DEBUG ".ROOT_DIR_GESTASSO.DIRECTORY_SEPARATOR.'include/fonctions.php';
	include ROOT_DIR_GESTASSO.DIRECTORY_SEPARATOR.'include/class_session.php'; // la classe session

/***** Les chemins des libs */
	define('ROOT_LIB', join_path(ROOT_DIR,'lib'));

/***** Les chemins et variables pour ADOdb */
	define('AODB_DIR', join_path(ROOT_LIB ,'adodb'). DIRECTORY_SEPARATOR );
	include (AODB_DIR.'adodb.inc.php');  //charge le code de ADOdb
	// include (AODB_DIR.'toexport.inc.php'); // Voir
	// Creé une connexion sur la Base de donnée   TYPE_BD_AODB = postgres ou mysql ou mysqli
	$db = ADONewConnection(TYPE_BD_AODB); //crée une connexion  Strict Standards: Only variables should be assigned by reference SUPRESSION de &  deavant &ADONewConnection
	$db->debug = false; //true; // false; // Mode débug ou Non
	if(!@$db->Connect(SERVEUR_BD, NOMUTILISATEUR_BD, MOTPASSE_BD, NOM_BD)) die("S&eacute;lection de la base de donn&eacute;es impossible !!!");


	// On lit la table preference_asso   (`id_pref`, `design_pref`, `val_pref`)  // ADOdb
	$result = $db->Execute("SELECT * FROM  ".TABLE_PREFERENCES);
	while (!$result->EOF)
	{
	   define(strtoupper($result->fields['design_pref']), $result->fields['val_pref']);
	   $result->MoveNext();
	}
	$result->Close();

/***** le fichier de langues */
	include_once 'lang.php'; // le fichier de langue  /config/lang.php

/***** La version de GestAsssoPhp */
	include_once 'version.php'; // le fichier qui donne la version de GestAssoPhp+Pg


/***** Les chemins des répertoires pour SMARTY */
	define('TEMPLATES_LOCATION', join_path(ROOT_DIR_GESTASSO, 'templates' ) ); // répertoire Fichiers des templates
	define('TMP_LOCATION', join_path(ROOT_DIR_GESTASSO, 'temp'));  // répertoire  des Fichiers temporaires
	define('TMP_TEMPLATES_C_LOCATION', join_path(ROOT_DIR_GESTASSO, 'temp', 'templates_c')); // répertoire des Fichiers temporaires de templates
// OPTIONS


/***** Les chemins et variables pour SMARTY */
	//Il doit s'agir du chemin complet du répertoire où se trouvent les fichiers classes de Smarty, le chemin doit se terminer par un slash.
	define('SMARTY_DIR', join_path(ROOT_LIB ,'smarty'). DIRECTORY_SEPARATOR );
	require (SMARTY_DIR.'Smarty.class.php'); // la classe

	$tpl = new Smarty; // instance de Smarty pour scripts PHP
	// $tpl->compile_dir = TMP_TEMPLATES_C_LOCATION ; // répertoire par défaut de compilation = templates_c // Smarty version 2x
	// $tpl->template_dir = TEMPLATES_LOCATION; // répertoire par défaut des templates = templates // Smarty version 2x
	// Pour verson 3.x  et 4.x
	$tpl->setCompileDir (TMP_TEMPLATES_C_LOCATION) ; // répertoire par défaut de compilation = /gestassophp_sa/temp/templates_c
	$tpl->setTemplateDir (TEMPLATES_LOCATION); // répertoire par défaut des templates =  /gestassophp_sa/templates/

/***** OPTIONS */
	//$tpl->debugging = true;

	//3.0.5 has been released. More minor bug fixes, one important change:
	//Smarty now follows the PHP error_reporting level by default. If PHP does not mask E_NOTICE and you try to access an unset template variable, you will now get an E_NOTICE warning. To revert to the old behavior:
	$tpl->error_reporting = E_ALL & ~E_NOTICE; // ancien error_reporting version Smarty 3.1.36
	// $tpl->error_reporting = E_ALL & ~E_WARNING & ~E_NOTICE; 	// Pour tests PHP 8.x  version Smarty à venir

/***** Les chemins des répertoires  utilisés en interne */
	define('DIR_PHOTOS', join_path(ROOT_DIR_GESTASSO,'photos')); // répertoire photo
	define('DIR_FILES_ADHTS', join_path(ROOT_DIR_GESTASSO,'fichiersadht').DIRECTORY_SEPARATOR); // répertoire Fichiers pour les adhts

/***** Les chemins WEB en fonction du serveur et des répertoires utilisés pour le téléchargement des fichiers */
	// Pour le téléchargement des fichiers qui se trouve dans le dossier gestassophp_xx/adherent/ on détemine :
// echo "DEBUG ".dirname($_SERVER['PHP_SELF']);  // le chemin  /xxx/xx/gestassophp_xx/adherent
	$path_adht = rtrim(dirname($_SERVER['PHP_SELF']), 'adherent'); // On supprime  le Rep  /adherent  pour avoir   /xxx/xx/gestassophp_xx/

/***** Définir WEB_FILES_ ADHTS */
	define('WEB_FILES_ADHTS', " http://".$_SERVER['SERVER_NAME'].$path_adht."fichiersadht/");
// echo "DEBUG ".WEB_FILES_ADHTS;   // http://localhost         /xxx/xx/gestassophp_xx/     fichiersadht/

/*****  Affichage en template */
	$tpl->assign('adherent_bene',ADHERENT_BENE); // adhérent ou  Bénévole au singulier
	$tpl->assign('nomlienpage', basename($_SERVER['SCRIPT_NAME']));
