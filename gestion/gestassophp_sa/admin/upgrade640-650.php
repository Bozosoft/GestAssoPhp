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
 * @version :  2013
 * @copyright 2007-2013  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */
 
/**
 *  Directory :  /ROOT_DIR_GESTASSO/admin/
 *   Fichier : upgrade5-sa.php
 *   MISE A JOUR ENTRE V 5.x et GestAssoPhp+Pg (gestassophp_sa)
*/

error_reporting(0);

$valid_modif='';

include_once '../config/connexion.php';
	// la date du jour	
	$date_du_jour=date('d/m/Y');//Pour définir la date
		

		
//------------------------- DEBUT UPGRADE + MODIFICATIONS -------------------
echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
    <title>GestAssoPhp+Pg mise à jour de V 6.4.0 vers 6.5.0(gestassophp_sa)</title>
    <meta http-equiv="Content-Type" content="text/HTML; charset={language name=charset}" />		
	<link rel="stylesheet" type="text/css" media="screen"  href="../js/style_screen.css"/>
</head>
<body> 
';

    echo 'GestAssoPhp+Pg mise &agrave; jour de V 6.4.0 GestAssoPhp vers '.$VERSION.' (gestassophp_sa) le : '.$date_du_jour.'  <br /><br />';
	
	echo '<big>MODIFICATION BASE DE DONNEES </big><br />';
	echo '------------------------------------------- <br />';
	echo '<b>Modifications Champs cp_adht dans table '.TABLE_ADHERENTS.'</b><br />pour afficher le code postal commen&ccedil;ant par 0 <br />';	
//	ALTER TABLE `gs_adherent` CHANGE `cp_adht` `cp_adht` VARCHAR( 8 ) NOT NULL DEFAULT '0'
// POUR mySql
//  ALTER TABLE "gsa_adherent" ALTER COLUMN "cp_adht" TYPE character varying(8)
// Pour Postrgresql  integer -> character varying(8)
//	Colonne		Type			
// 	cp_adht		character varying(8

	//Si Mysql
	if ( TYPE_BD_AODB == 'mysql' ) {
		$req_upgrade_adht = "ALTER TABLE ".TABLE_ADHERENTS." CHANGE `cp_adht` `cp_adht` VARCHAR( 8 ) NOT NULL DEFAULT '0' ";
		echo $req_upgrade_adht .' <br />';	
		echo ' <br />';	
		$dbresult = $db->Execute($req_upgrade_adht);	
			if ($dbresult == true) {
				echo 'Mysql - Modification r&eacute;ussie : champ "cp_adht" <br />';
				$valid_modif = 1;
			} else {
				echo '<span class="erreur-Jaunerouge">Erreur requ&ecirc;te ou champ "cp_adht" ! </span><br />';
				$valid_modif = 0;
			}
	}
	
	//Si postgresql
	if ( TYPE_BD == 'postgres' ) {	
		$req_upgrade_adht = "ALTER TABLE ".TABLE_ADHERENTS." ALTER COLUMN cp_adht TYPE character varying(8) ";
		echo $req_upgrade_adht .' <br />';	
		echo ' <br />';	
		$dbresult = $db->Execute($req_upgrade_adht);	
			if ($dbresult == true) {
				echo 'PostgreSql - Modification r&eacute;ussie : champ "cp_adht" <br />';
				$valid_modif = 1;
			} else {
				echo '<span class="erreur-Jaunerouge">Erreur requ&ecirc;te ou champ "cp_adht" ! </span><br />';
				$valid_modif = 0;
			}	
	}

		//echo ' <br />'.$valid_modif;			
		if ($valid_modif == 1) {
			echo ' Vous pouvez vous connectez &agrave; <a href="../index.php" title="Connexion">GestAssoPhp+Pg</a>, et v&eacute;rifier le fonctionnement dans Administration<br />';
		} else {
			echo '<span class="erreur-Jaunerouge">Erreur requ&ecirc;te - Contacter votre administrateur syst&egrave;me! </span><br />';
		}




echo '  
  </body>
</html>
';

?>