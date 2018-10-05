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
 *  Directory :  /ROOT_DIR_GESTASSO/install/
 *   Fichier :
 *   Installation du système
 * ENCODAGE UTF-8 sans BOM 
*/


	include 'include_install.php';  // les variables + les définitions de répertoires
	
	// Raz de variables
	$message = '' ;
	
// On modifie le repertoire de Smarty pour .....	
	define('TEMPLATES_LOCATION_INSTAL', join_path(ROOT_DIR_GESTASSO,'install' ) ); // repertoire Fichiers des templates Installation
	$tpl = new Smarty; //instance de Smarty pour scripts PHP	
//	$tpl->compile_dir = TMP_TEMPLATES_C_LOCATION ;// répertoire par défaut de compilation = templates_c 
//	$tpl->template_dir = TEMPLATES_LOCATION; // répertoire par défaut des templates = templates
//  verson 3.x
	$tpl->setCompileDir (TMP_TEMPLATES_C_LOCATION) ;// répertoire par défaut de compilation = templates_c // Smarty version 3.x
	$tpl->setTemplateDir (TEMPLATES_LOCATION); // répertoire par défaut des templates = templates // Smarty version 3.x
//echo TEMPLATES_LOCATION_INSTAL;
// OPTIONS	
	$tpl->error_reporting = E_ALL & ~E_NOTICE;
	//Gestion erreur retour arrière depuis page 5
	$texterreurretour_ar = (get_post_variable('e_rar','')); // 
	$tpl->assign('texterreurretour_ar',$texterreurretour_ar); // information	erreur
	
	$id_adht = (get_post_variable('id_adht','')); // 
//$id_adht = '1'; // pour TEST
	$confing_fin = 'ok';
	if ($id_adht == '1') {	 // vérifie que c'est bien la page 4 qui a été envoyée
		define('CONFIG_FILEOK', join_path(ROOT_DIR_GESTASSO,'config','connexion.cfg.php')); // 	
		define('CONFIG_REPOK', join_path(ROOT_DIR_GESTASSO,'config')); // 		
		} else {
			$confing_fin = 'nonok';		
			$message = "<span class='TexterougeGras'>Une erreur s'est produite sur l'enregsitrement de l'administrateur ...</span>";
		}
		

	
/***** ---------------------------------------------------------------------- */		
	// Préparation pour Affichage partie Fixe VERS TEMPLATE	 	
	$tpl->assign('version_i',VERSION_I); // version installateur	
	$tpl->assign('style_i',STYLE_I); //  Feuille de syle  style_screen.css ou m_style_screen.css
	$tpl->assign('messagetitre','Fin de la configuration-installation'); // titre de la  page
	$tpl->assign('Etape1','Etape 1 - OK'); // menu	
	$tpl->assign('Etape2','Etape 2 - OK'); // menu	
	$tpl->assign('Etape3','Etape 3 - OK'); // menu	
	$tpl->assign('Etape4','Etape 4 - OK'); // menu	
	$tpl->assign('Etape5','<span class="TextenoirGras">Etape 5</span>'); // menu	
	$tpl->assign('titre','Etape 5'); // Titre de la page		
	$tpl->assign('confing_fin',$confing_fin); // Erreur 		
	
	$tpl->assign('configuration',CONFIG_FILEOK); // le fichier de configuration
	$tpl->assign('configuration_rep',CONFIG_REPOK); // le repertoire de configuration	
	$tpl->assign('message',$message); // information	erreur
		
	$content = $tpl->fetch('install_5.tpl'); // On affiche ...	
	$tpl->assign('content',$content);		
	$tpl->display('index_instal.tpl');	

?>
