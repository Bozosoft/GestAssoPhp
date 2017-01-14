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
 * @copyright 2007-2017 (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */
 
/**
 *  Directory :  /ROOT_DIR_GESTASSO/config/
 *   Fichier :
 *   Les fichiers Include  et les chemins de repertoires  et les menus pour les templates page_index et login
 *   MODIFICATIONS
 *  - 08/08/2008 Maintenance base données
 *  - 22/08/2008  Refonte pour ajout fichier Langues	
 *  - 
*/

/**
* --------------------------------------------------------------------
*  NOM DES TABLES BASE DE DONNEES 
*  ---- ATTENTION --- NE PAS MODIFIER 
*  SANS MODIFIER LE NOMS DES TABLES EN BASE DE DONNEES !!
* --------------------------------------------------------------------
*/
	// TABLES ADHERENTS	
	define('TABLE_ADHERENTS', DB_PREFIX.'adherent');
	//  TABLES Pour ecrire les logs
	define('TABLE_LOGS', DB_PREFIX.'logs');
	// Table cotisation Commune pour les adhérents et les associations	
	define('TABLE_COTISATIONS', DB_PREFIX.'cotisations');
	// Table Type de cotisation 
	define('TABLE_TYPE_COTISATIONS', DB_PREFIX.'types_cotisations');
	// TABLES  Pour gestion fichiers	
	define("TABLE_FICHIER_ADHERENTS", DB_PREFIX.'fichier_adherent');
	
	// TABLES  Pour lire les preference_asso	//+ V. 3
	define("TABLE_PREFERENCES", DB_PREFIX.'preference_asso');
	// TABLES  Pour lire les preference_asso	//+ V. 3
	define("TABLE_ANTENNE", DB_PREFIX.'types_antennes');	
	
/* --------------------------------------------------------------------*/

/**** Les chemins fonctions et classes  */	
	//NOTA  le repertoire de gestasso =  ROOT_DIR_GESTASSO Défini dans   fileloc_gestasso à la racine du site
	include ROOT_DIR_GESTASSO.DIRECTORY_SEPARATOR.'include/fonctions.php'; // les fonctions
//echo ROOT_DIR_GESTASSO.DIRECTORY_SEPARATOR.'include/fonctions.php';
	include ROOT_DIR_GESTASSO.DIRECTORY_SEPARATOR.'include/class_session.php'; // la classe session

/**** Les chemins des libs  */	
	define('ROOT_LIB', join_path(ROOT_DIR,'lib'));	
	
/**** Les chemins et variables  pour adodb  */	
	define('AODB_DIR', join_path(ROOT_LIB ,'adodb'). DIRECTORY_SEPARATOR );
	include (AODB_DIR.'adodb.inc.php');  //charge le code deADOdb  
	// include (AODB_DIR.'toexport.inc.php'); //  Voir
	// Creé une connexion sur la Base de donnée   TYPE_BD_AODB = postgres ou mysql ou mysqli
	$db = ADONewConnection(TYPE_BD_AODB); //crée une connexion  Strict Standards: Only variables should be assigned by reference SUPRESSION de &  deavant &ADONewConnection
	$db->debug =  false;//true; // false; // Mode débug ou Non
	if(!@$db->Connect(SERVEUR_BD, NOMUTILISATEUR_BD, MOTPASSE_BD, NOM_BD)) die("S&eacute;lection de la base de donn&eacute;es impossible !!!");	

	
	// On lit la table preference_asso   (`id_pref`, `design_pref`, `val_pref`)  //  adodb		
	$result = $db->Execute("SELECT * FROM  ".TABLE_PREFERENCES);
	while (!$result->EOF)
	{
	   define(strtoupper($result->fields['design_pref']), $result->fields['val_pref']);
	   $result->MoveNext();
	}
	$result->Close();

/**** le fichier de langues */		
	include_once 'lang.php'; // le fichier de langue  lang.php 
	
/**** La version de GestAsssoPhp  */
	include_once 'version.php'; //  -> PHP 5.3

	
/**** Les chemins des répertoires  pour SMARTY */
	define('TEMPLATES_LOCATION', join_path(ROOT_DIR_GESTASSO,'templates' ) ); // répertoire Fichiers des templates
	define('TMP_LOCATION', join_path(ROOT_DIR_GESTASSO,'temp'));  // répertoire  des Fichiers temporaires
	define('TMP_TEMPLATES_C_LOCATION', join_path(ROOT_DIR_GESTASSO,'temp','templates_c')); // répertoire  des Fichiers temporaires de templates  
// OPTIONS	


/**** Les chemins et variables  pour SMARTY  */	
	//Il doit s'agir du chemin complet du répertoire où se trouvent les fichiers classes de Smarty., le chemin doit se terminer par un slash.
	define('SMARTY_DIR', join_path(ROOT_LIB ,'smarty'). DIRECTORY_SEPARATOR );
	require (SMARTY_DIR.'Smarty.class.php'); // la classe

	$tpl = new Smarty; //instance de Smarty pour scripts PHP	
//	$tpl->compile_dir = TMP_TEMPLATES_C_LOCATION ;// répertoire par défaut de compilation = templates_c 
//	$tpl->template_dir = TEMPLATES_LOCATION; // répertoire par défaut des templates = templates
//  verson 3.x
	$tpl->setCompileDir (TMP_TEMPLATES_C_LOCATION) ;// répertoire par défaut de compilation = templates_c // Smarty version 3.x
	$tpl->setTemplateDir (TEMPLATES_LOCATION); // répertoire par défaut des templates = templates // Smarty version 3.x
	
// OPTIONS	
	//$tpl->debugging = true;

//3.0.5 has been released. More minor bug fixes, one important change:
//Smarty now follows the PHP error_reporting level by default. If PHP does not mask E_NOTICE and you try to access an unset template variable, you will now get an E_NOTICE warning. To revert to the old behavior:	
	$tpl->error_reporting = E_ALL & ~E_NOTICE;


/**** Les chemins des répertoires  utilisés en interne */	
	define('DIR_PHOTOS', join_path(ROOT_DIR_GESTASSO,'photos')); // répertoire photo
	define('DIR_FILES_ADHTS', join_path(ROOT_DIR_GESTASSO,'fichiersadht').DIRECTORY_SEPARATOR); // répertoire Fichiers pour les adhts

/**** Les chemins WEB en fonction du serveur et des répertoires utilisés pour le téléchargement des fichiers */	
	// Pour le téléchargement des fichiers qui se trouve dans le dossier gestassophp_s/adherent/ on détemine :
	//echo dirname($_SERVER['PHP_SELF']);  //  le chemin  /xxx/xx/gestassophp_s/adherent
	$path_adht = rtrim(dirname($_SERVER['PHP_SELF']), 'adherent'); // On supprime  le Rep  /adherent  pour avoir   /xxx/xx/gestassophp_s/
/**** Définir   WEB_FILES_ ADHTS   */	
	define('WEB_FILES_ADHTS', " http://".$_SERVER['SERVER_NAME'].$path_adht."fichiersadht/");
	//echo WEB_FILES_ADHTS;   // http://localhost         /xxx/xx/gestassophp_s/     fichiersadht/


// Affichage en template 
	$tpl->assign('adherent_bene',ADHERENT_BENE); // adhérent ou  Bénévole au singulier
	$tpl->assign('nomlienpage', basename($_SERVER['SCRIPT_NAME']));
// FIN  Affichage en template
	
?>
