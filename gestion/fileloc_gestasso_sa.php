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
 * 
 * @ ATTENTION GestAssoPhp+Pg utlise un dossier /lib avec
 * @ Smarty 3.x  GNU LESSER GENERAL PUBLIC LICENSE : 
 *  	https://github.com/smarty-php/smarty/blob/master/LICENSE
 * @ ADOdb Library for PHP  GNU LESSER GENERAL PUBLIC LICENSE :
 *   	https://github.com/ADOdb/ADOdb/blob/master/LICENSE.md#gnu-lesser-general-public-license
 */
 
/**
 *  Fichier :
 *   Définir le Répertoire racine du programme
 *   ENCODAGE UTF-8 sans BOM
*/

// ----------- Le chemin
// On est à la racine de votre dossier hébergement
	$dirname = dirname(__FILE__); 
	define('ROOT_DIR', $dirname); // dossier ou se trouve les fichiers du programm

// le repertoire de gestassophp = ROOT_DIR_GESTASSO
// Peut etre modifié en modifiant le mot 'gestassophp_sa'  par 'votre dossier ou se trouve les fichiers du programme'
// Si vous remplacer gestassophp_sa par gestassophp_xx votre dossier ou se trouve les fichiers du programme se nommera /gestassophp_xx/
	define('ROOT_DIR_GESTASSO', ROOT_DIR.DIRECTORY_SEPARATOR.'gestassophp_sa');	 //dossier du programme

/** exemple d'installation dans un dossier hébergement nommé /gestion/
 * /gestion/gestassophp_sa/	= dossier ou se trouve les fichiers du programme
 * /gestion/lib 			= les libs 	- smarty (système de template) et adodb 
 * /gestion/.htaccess		 
 * /gestion/fileloc_gestasso_sa.php	= ce fichier
 * /gestion/index.html
*/

?>
