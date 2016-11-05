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
 *   upgrade depuis 6.4.0  vers 7.0.0
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
    <title>GestAssoPhp+Pg mise &agrave; jour de V 6.5.0 vers 7.0.0(gestassophp_sa)</title>
    <meta http-equiv="Content-Type" content="text/HTML; charset={language name=charset}" />		
	<link rel="stylesheet" type="text/css" media="screen"  href="../js/style_screen.css"/>
</head>
<body> 
';
	//http://phplens.com/lens/adodb/docs-datadict.htm
	$dbdict = NewDataDictionary($db);
		
    echo 'GestAssoPhp+Pg mise &agrave; jour de V 6.5.0 GestAssoPhp vers '.$VERSION.' (gestassophp_sa) le : '.$date_du_jour.'  <br /><br />';
	
	echo '<big>MODIFICATION BASE DE DONNEES </big><br />';
	echo '------------------------------------------- <br />';
	
	echo '<b>1- Modifications Champs cp_adht dans table '.TABLE_ADHERENTS.'</b><br />pour afficher le code postal commen&ccedil;ant par 0 <br />';	
//	ALTER TABLE `gs_adherent` CHANGE `cp_adht` `cp_adht` VARCHAR( 8 ) NOT NULL DEFAULT '0'
// POUR mySql
//  ALTER TABLE "gsa_adherent" ALTER COLUMN "cp_adht" TYPE character varying(8)
// Pour Postrgresql  integer -> character varying(8)
//	Colonne		Type			
// 	cp_adht		character varying(8)

	$sqlarray = $dbdict->AlterColumnSQL(TABLE_ADHERENTS,'cp_adht C(8)`');
	$return = $dbdict->ExecuteSQLArray($sqlarray);
	//echo 	$return; // 2 Ok   1 errreur	
		if ($return == 2) {
		echo 'Modification r&eacute;ussie : champ "cp_adht" <br />';
		} else {
		echo '<span class="erreur-Jaunerouge"><span class="erreur-Jaunerouge">Erreur requ&ecirc;te ou champ "cp_adht" ! </span><br />'.$db->ErrorMsg().'<br />';		
		}
	echo '<br />------------------------------------------- <br />';		
	echo '<b>2- Ajout de 2 champs : profession_adht et autres_info_adht dans table '.TABLE_ADHERENTS.'</b><br />
	1- profession_adht <br />';		
	// On upgrade TABLE_TABLE_ADHERENTS  POUR mySql profession_adht	char(50)
	// Pour Postrgresql character varying(50)
	$sqlarray = $dbdict->AddColumnSQL(TABLE_ADHERENTS,'profession_adht C(50)`');
	$return = $dbdict->ExecuteSQLArray($sqlarray);
		if ($return == 2) {
		echo 'Modification r&eacute;ussie : ajout champ "profession_adht" <br />';
		} else {
		echo '<span class="erreur-Jaunerouge">Erreur requ&ecirc;te ou champ "profession_adht" d&eacute;j&agrave; existant ! </span><br />'.$db->ErrorMsg().'<br />';		
		}	

	echo '<br />2- autres_info_adht <br />';		
	// On upgrade TABLE_ADHERENTS  POUR mySql autres_info_adht	char(100)
	// Pour Postrgresql character varying(100)
	$sqlarray = $dbdict->AddColumnSQL(TABLE_ADHERENTS,'autres_info_adht C(100)`');
	$return = $dbdict->ExecuteSQLArray($sqlarray);
		if ($return == 2) {
		echo 'Modification r&eacute;ussie : ajout champ "autres_info_adht" <br />';
		} else {
		echo '<span class="erreur-Jaunerouge">Erreur requ&ecirc;te ou champ "autres_info_adht" d&eacute;j&agrave; existant ! </span><br />'.$db->ErrorMsg().'<br />';		
		}		
	
	/* EXISTE en V 6.5.0
	echo '<br />------------------------------------------- <br />';	
	echo '<b>3- Modifications Champs cp_adht dans table '.TABLE_COTISATIONS.'</b><br />Ajout colonne paiement_cotis pour une zone de PAIEMENT dans Gestion Cotisations<br />';	
	// On upgrade TABLE_COTISATION  POUR mySql paiement_cotis	char(3)
	// Pour Postrgresql character varying(3)
	$sqlarray = $dbdict->AddColumnSQL(TABLE_COTISATIONS,'paiement_cotis C(3)`');
	$return = $dbdict->ExecuteSQLArray($sqlarray);
	//echo 	$return; // 2 Ok   1 errreur	
		if ($return == 2) {
		echo 'Modification r&eacute;ussie : ajout champ "paiement_cotis" <br />';
		} else {
		echo '<span class="erreur-Jaunerouge">Erreur requ&ecirc;te ou champ "paiement_cotis" d&eacute;j&agrave; existant ! </span><br />'.$db->ErrorMsg().'<br />';		
		}	
	*/
	echo '<br />------------------------------------------- <br />';	
	echo 'Vous pouvez retourner sur <a href="../admin/" title="Connexion">GestAssoPhp/Administration</a><br /><br />';	
	echo '<span class="erreur-Jaunerouge">Supprimer le fichier admin/upgrade700.php pour des raison de s&eacute;curit&eacute;</span><br />';
		

echo '  
  </body>
</html>
';

?>