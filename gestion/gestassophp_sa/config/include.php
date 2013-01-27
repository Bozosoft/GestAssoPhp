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
 *   Les fichiers Include  et les chemins de repertoires  et les menus pour les templates page_index et login
 *   MODIFICATIONS
 *  - 08/08/2008 Maintenance base donn�es
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
	// Table cotisation Commune pour les adh�rents et les associations	
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
	//NOTA  le repertoire de gestasso =  ROOT_DIR_GESTASSO D�fini dans   fileloc_gestasso � la racine du site
	include ROOT_DIR_GESTASSO.DIRECTORY_SEPARATOR.'include/fonctions.php'; // les fonctions
//echo ROOT_DIR_GESTASSO.DIRECTORY_SEPARATOR.'include/fonctions.php';
	include ROOT_DIR_GESTASSO.DIRECTORY_SEPARATOR.'include/class_session.php'; // la classe session

/**** Les chemins des libs  */	
	define('ROOT_LIB', join_path(ROOT_DIR,'lib'));	
	
/**** Les chemins et variables  pour adodb  */	
	define('AODB_DIR', join_path(ROOT_LIB ,'adodb'). DIRECTORY_SEPARATOR );
	include (AODB_DIR.'adodb.inc.php');  //charge le code deADOdb  
	// include (AODB_DIR.'toexport.inc.php'); //  Voir
	// Cre� une connexion sur la Base de donn�e   TYPE_BD_AODB=  postgres ou  mysql
	$db = ADONewConnection(TYPE_BD_AODB); //cr�e une connexion  Strict Standards: Only variables should be assigned by reference SUPRESSION de &  deavant &ADONewConnection
	$db->debug =  false;//true; // false; // Mode d�bug ou Non
	if(!@$db->Connect(SERVEUR_BD, NOMUTILISATEUR_BD, MOTPASSE_BD, NOM_BD)) die("S&eacute;lection de la base de donn&eacute;es impossible !!!");	

//Jeux de caract�res et collations de connexion http://dev.mysql.com/doc/refman/5.0/fr/charset-connection.html	
//iso-8859-1 correspond effectivement � latin1
//le SET NAMES indique avec quel jeu de caract�res on envoie les donn�es � MySQL, quel que soit le jeu utilis� dans la colonne cible.   "SET NAMES utf8",  "SET NAMES latin1"	
		//Pour Postgres, charset to iso-8859-1 (LATIN1)
        if ( TYPE_BD_AODB == 'postgres' ) {		
			$db->SetCharSet('LATIN1');
		 }
        // Pour mysql,  jeu de caract�res iso-8859-1 correspond effectivement � latin1
        if ( TYPE_BD_AODB == 'mysql' ) {
            $db->Execute("SET NAMES 'latin1'");
        }
		
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

	
/**** Les chemins des r�pertoires  pour SMARTY */
	define('TEMPLATES_LOCATION', join_path(ROOT_DIR_GESTASSO,'templates' ) ); // r�pertoire Fichiers des templates
	define('TMP_LOCATION', join_path(ROOT_DIR_GESTASSO,'temp'));  // r�pertoire  des Fichiers temporaires
	define('TMP_TEMPLATES_C_LOCATION', join_path(ROOT_DIR_GESTASSO,'temp','templates_c')); // r�pertoire  des Fichiers temporaires de templates  
// OPTIONS	


/**** Les chemins et variables  pour SMARTY  */	
	//Il doit s'agir du chemin complet du r�pertoire o� se trouvent les fichiers classes de Smarty., le chemin doit se terminer par un slash.
	define('SMARTY_DIR', join_path(ROOT_LIB ,'smarty'). DIRECTORY_SEPARATOR );
	require (SMARTY_DIR.'Smarty.class.php'); // la classe

	$tpl = new Smarty; //instance de Smarty pour scripts PHP	
//	$tpl->compile_dir = TMP_TEMPLATES_C_LOCATION ;// r�pertoire par d�faut de compilation = templates_c 
//	$tpl->template_dir = TEMPLATES_LOCATION; // r�pertoire par d�faut des templates = templates
//  verson 3.x
	$tpl->setCompileDir (TMP_TEMPLATES_C_LOCATION) ;// r�pertoire par d�faut de compilation = templates_c // Smarty version 3.x
	$tpl->setTemplateDir (TEMPLATES_LOCATION); // r�pertoire par d�faut des templates = templates // Smarty version 3.x
	
// OPTIONS	
	//$tpl->debugging = true;

//3.0.5 has been released. More minor bug fixes, one important change:
//Smarty now follows the PHP error_reporting level by default. If PHP does not mask E_NOTICE and you try to access an unset template variable, you will now get an E_NOTICE warning. To revert to the old behavior:	
	$tpl->error_reporting = E_ALL & ~E_NOTICE;


/**** Les chemins des r�pertoires  utilis�s en interne */	
	define('DIR_PHOTOS', join_path(ROOT_DIR_GESTASSO,'photos')); // r�pertoire photo
	define('DIR_FILES_ADHTS', join_path(ROOT_DIR_GESTASSO,'fichiersadht').DIRECTORY_SEPARATOR); // r�pertoire Fichiers pour les adhts

/**** Les chemins WEB en fonction du serveur et des r�pertoires utilis�s pour le t�l�chargement des fichiers */	
	// Pour le t�l�chargement des fichiers qui se trouve dans le dossier gestassophp_s/adherent/ on d�temine :
	//echo dirname($_SERVER['PHP_SELF']);  //  le chemin  /xxx/xx/gestassophp_s/adherent
	$path_adht = rtrim(dirname($_SERVER['PHP_SELF']), 'adherent'); // On supprime  le Rep  /adherent  pour avoir   /xxx/xx/gestassophp_s/
/**** D�finir   WEB_FILES_ ADHTS   */	
	define('WEB_FILES_ADHTS', " http://".$_SERVER['SERVER_NAME'].$path_adht."fichiersadht/");
	//echo WEB_FILES_ADHTS;   // http://localhost         /xxx/xx/gestassophp_s/     fichiersadht/


// Affichage en template 
	$tpl->assign('adherent_bene',ADHERENT_BENE); // adh�rent ou  B�n�vole au singulier
// FIN  Affichage en template
	
?>
