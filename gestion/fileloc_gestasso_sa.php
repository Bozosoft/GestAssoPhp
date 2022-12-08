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
 * 
 * @ ATTENTION GestAssoPhp+Pg utlise un dossier /lib avec
 * @ Smarty 4.x  GNU LESSER GENERAL PUBLIC LICENSE : 
 *  	https://github.com/smarty-php/smarty/blob/master/LICENSE
 * @ ADOdb Library for PHP  GNU LESSER GENERAL PUBLIC LICENSE :
 *   	https://github.com/ADOdb/ADOdb/blob/master/LICENSE.md#gnu-lesser-general-public-license
 */
 
/**
 *  Directory :  /ROOT_DIR/
 *  Fichier : fileloc_gestasso_sa.php
 *  Définir le Répertoire racine du programme
 *  ENCODAGE UTF-8 sans BOM
*/

/** 
 * Exemple d'installation dans un dossier hébergement nommé /gestion/
 * /gestion/									= la racine
 * /gestion/gestassophp_sa/			= dossier ou se trouve les fichiers du programme
 * /gestion/lib 								= les libs 	- smarty (système de template) et adodb 
 * /gestion/.htaccess		 				= sécurité
 * /gestion/fileloc_gestasso_sa.php	= ce fichier
 * /gestion/index.html					= fichier HTML lien direct vers /gestion/gestassophp_sa/	
*/

/**
 * Définir le chemin initial
 * ROOT_DIR = la racine pour l'hébergement des dossiers où se trouve les fichiers du programme GestAssoPhp
*/
	$dirname = dirname(__FILE__); 
	define('ROOT_DIR', $dirname);  

/**
 * le dossier de gestassophp = ROOT_DIR_GESTASSO
 * Peut etre modifié en modifiant le mot 'gestassophp_sa' par 'votre dossier où se trouve les fichiers du programme
 * Si vous remplacer gestassophp_sa par gestassophp_xx votre dossier ou se trouve les fichiers du programme se nommera /gestassophp_xx/ . NOTA modifier aussi la ligne du fichier /config/connexion.php $file_loc = 'fileloc_gestasso_sa.php';
*/
	define('ROOT_DIR_GESTASSO', ROOT_DIR.DIRECTORY_SEPARATOR.'gestassophp_sa');	 //dossier du programme
