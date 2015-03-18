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
 * @version :  2014
 * @copyright 2007-2014  (c) JC Etiemble
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
    <title>GestAssoPhp mise à jour de V 5.x GestAssoPhp vers GestAssoPhp+Pg (gestassophp_sa)</title>
    <meta http-equiv="Content-Type" content="text/HTML; charset={language name=charset}" />		
	<link rel="stylesheet" type="text/css" media="screen"  href="../js/style_screen.css"/>
</head>
<body> 
';

    echo 'GestAssoPhp mise à jour de V 5.x GestAssoPhp vers '.$VERSION.' (gestassophp_sa) le : '.$date_du_jour.'  <br /><br />';
	
	echo '<big>MODIFICATION BASE DE DONNEES </big><br />';
	echo '------------------------------------------- <br />';
	echo '<b>Modifications Champs datenaisance_adht DATE NULL DEFAULT NULL dans table '.TABLE_ADHERENTS.'</b><br />';	
//	echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;----------------------  <br />';	
// On upgrade  datenaisance_adht  datemodiffiche_adht date_echeance_cotis date_sortie
// pour éviter erreur si datenaisance_adht non remplie 	
	$req_upgrade_adht = "ALTER TABLE ".TABLE_ADHERENTS." CHANGE `datenaisance_adht` `datenaisance_adht` DATE NULL DEFAULT NULL ";
	echo $req_upgrade_adht .' <br />';	
	echo ' <br />';	
	$dbresult = $db->Execute($req_upgrade_adht);	
		if ($dbresult == true) {
			echo 'Modification réussie : champ "datenaisance_adht" <br />';
			$valid_modif = 1;
		} else {
			echo '<span class="erreur-Jaunerouge">Erreur requête ou champ "datenaisance_adht" ! </span><br />';
			$valid_modif = 0;
		}
	
	echo ' <br />';	
	echo '------------------------------------------- <br />';
	echo ' <br />';	
	echo '<b>Modifications Champs datenaisance_adht DATE NULL DEFAULT NULL dans table '.TABLE_ADHERENTS.'</b><br />';	
// On upgrade  datenaisance_adht  Si datenaisance_adht = 0000-00-00  age = 2011 ans donc mettre à null 
	$req_upgrade_adht1 = "UPDATE ".TABLE_ADHERENTS." SET `datenaisance_adht` = NULL WHERE `datenaisance_adht` = '0000-00-00'";
	echo $req_upgrade_adht1.' <br />';
	$dbresult1 = $db->Execute($req_upgrade_adht1);	
					
	echo ' <br />';		
		if ($dbresult1 == true) {
			echo 'Modification réussie : champ "datenaisance_adht = NULL" <br />';
			$valid_modif = 2;
		} else {
			echo '<span class="erreur-Jaunerouge">Erreur requête ou champ "datenaisance_adht = NULL" ! </span><br />';
			$valid_modif = 0;
		}	
				
		echo ' <br /><br /><br />';			
	/*	

BD Mysql avant
------------------
datecreationfiche_adht	date			Non	0000-00-00
datenaisance_adht	date			Non	0000-00-00  -------------->
datemodiffiche_adht	date			Non	0000-00-00
date_echeance_cotis	date			Non	0000-00-00		 	 	 	 	 	 	 
dacces	datetime			Non	0000-00-00 00:00:00		 	 	 	 	 	 	 
date_sortie	date			Non	0000-00-00
	
BD Mysql aprés
------------------
datecreationfiche_adht	date			Oui	NULL
datenaisance_adht	date			Oui	NULL --------------> Uniquement
datemodiffiche_adht	date			Oui	NULL
date_echeance_cotis	date			Oui	NULL		 	 	 	 	 	 	 
dacces	datetime			Oui	NULL		 	 	 	 	 	 	 
date_sortie	date			Oui	NULL



*/	
		//echo ' <br />'.$valid_modif;			
		if ($valid_modif == 2) {
			echo ' Vous pouvez vous connectez à <a href="../index.php" title="Connexion">GestAssoPhp</a>, et verifier le fonctionnement dans Administration<br />';
		} else {
			echo '<span class="erreur-Jaunerouge">Erreur requête - Contacter votre administrateur système! </span><br />';
		}




echo '  
  </body>
</html>
';

?>