<?php
/**
 * Projet : gestassophp_sa [GestAssoPhp+Pg]
 * ---------------------------
 * Licence Creative Commons selon les termes du pr�sent contrat appel� Contrat Public Creative Commons 
 * Auteur original : Jean-Claude Etiemble
 * @link :  http://creativecommons.org/licenses/by-sa/2.0/fr/  - Paternit� - Partage � l'Identique 2.0 France (CC BY-SA 2.0)
 * ---------------------------
 *	
 * @author : JC Etiemble - http://jc.etiemble.free.fr
 * @version :  2013
 * @copyright 2007-2013  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */
 
/**
 *  Directory :  /ROOT_DIR_GESTASSO/config/
 *   Fichier :
 *   Le fichier de connexion � la BD 
*/	

//----------------------------------------------------------------------------------
//@error_reporting(E_ALL | E_STRICT); // debug pour TESTS
//@error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);;
//---------------------------------------------------------------------------------

	$file_loc = 'fileloc_gestasso_sa.php';  //******************** A DEFINIR

//information sur la Base de donn�e
	@eval("include 'connexion.cfg.php';");
	// Utilisation de adodb   TYPE_BD_AODB =  postgres ou  mysql
	define("TYPE_BD_AODB", strtolower(TYPE_BD) ); // pour compibilt� version ant�rieure si  TYPE_BD = MySql
	
		
// Inclu le fichier qui dispatch les autres 
	if (!defined('INDEX0')) {
		define('INDEX0',false);
	}
	if (INDEX0 != 'OK') { // Si on est pas sur l'index.php de la racine
		include_once '../../'.$file_loc;  //----------Pour TEMPLATE et localise rep ATTENTION au nom voir dans index.php de la racine
	} else {
		include_once '../'.$file_loc;  // si on est dans index.php de la racine
	}
	include_once 'include.php'; 

?>