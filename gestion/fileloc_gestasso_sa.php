<?php
// +-------------------------------------------------------------------------------------+
// | Pour GestAssoPhp+
// +--------------------------------------------------------------------------------------+
// |
/*****************************************************************************
*   Définit le Rep racine
    ****************************************************************************/

// -----------Les chemins
// On est Ici ... la racine du site
	$dirname = dirname(__FILE__); 
	define('ROOT_DIR', $dirname);

// le repertoire de gestasso = ROOT_DIR_GESTASSO
// Peut etre modifié en modifiant  'gestassophp_s'  par 'votre-dossier'
	define('ROOT_DIR_GESTASSO', ROOT_DIR.DIRECTORY_SEPARATOR.'gestassophp_sa');	 //F:\Sites\TestDevel\gestion\gestassophp_sa
	
	//define('ROOT_DIR_GESTASSO', ROOT_DIR.DIRECTORY_SEPARATOR.'gestassophp_sa_u');	 //F:\Sites\TestDevel\gestion\gestassophp_sa_u HTML5

?>