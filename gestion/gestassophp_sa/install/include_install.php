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
 *  Directory :  /ROOT_DIR_GESTASSO/config/
 *   Fichier :
 *   Les fichiers Include  et les chemins de repertoires  et les menus pour les templates page_index et login
 * ENCODAGE UTF-8 sans BOM
*/

/**
* --------------------------------------------------------------------
*  NOM DES TABLES BASE DE DONNEES 
*  ---- ATTENTION --- NE PAS MODIFIER 
*  SANS MODIFIER LE NOMS DES TABLES EN BASE DE DONNEES !!
* --------------------------------------------------------------------
*/

	define('VERSION_I', 'Installateur_Php+Pg V 1.3.0'); // version installateur 04/02/2013 - 13/01/2017 1.2 - 03/10/18 1.3
	define('STYLE_I', 'style_screen.css'); // Feuille de syle  style_screen.css ou m_style_screen.css
	$file_loc = 'fileloc_gestasso_sa.php';  //******************** A DEFINIR
	include_once '../../'.$file_loc; // défintion du fichier pour définir  ROOT_DIR
	
/* --------------------------------------------------------------------*/

/**** Configuration  */		
	//NOTA  le repertoire de gestasso =  ROOT_DIR_GESTASSO Défini dans   fileloc_gestasso à la racine du site
	
	include_once ROOT_DIR_GESTASSO.DIRECTORY_SEPARATOR.'include/fonctions.php'; // les fonctions
	include_once ROOT_DIR_GESTASSO.DIRECTORY_SEPARATOR.'include/class_session.php'; // la classe session
	

/**** Les chemins des répertoires  */
	define('TEMPLATES_LOCATION', join_path(ROOT_DIR_GESTASSO,'templates' ) ); // répertoire Fichiers des templates
	define('TMP_LOCATION', join_path(ROOT_DIR_GESTASSO,'temp'));  // répertoire  des Fichiers temporaires
	define('TMP_TEMPLATES_C_LOCATION', join_path(ROOT_DIR_GESTASSO,'temp','templates_c')); // répertoire  des Fichiers temporaires de templates  
// OPTIONS	

	
/**** Les chemins des libs  */	
	define('ROOT_LIB', join_path(ROOT_DIR,'lib'));

/**** Les chemins et variables  pour adodb  */	
	define('AODB_DIR', join_path(ROOT_LIB ,'adodb'). DIRECTORY_SEPARATOR );
	include (AODB_DIR.'adodb.inc.php');  //charge le code deADOdb  


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

	
?>
