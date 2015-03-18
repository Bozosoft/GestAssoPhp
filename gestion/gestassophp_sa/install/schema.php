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
 
 * ENCODAGE UTF-8 sans BOM
 * basé sur le système d'installation de CMS made simple 
# CMS - CMS Made Simple
# (c)2004 by Ted Kulp 
# This Project's homepage is: http://cmsmadesimple.org/
 */
 
/**
 *  Directory :  /ROOT_DIR_GESTASSO/install/
 *   Fichier :
 *   Installation du système
 * ENCODAGE UTF-8 sans BOM  
*/



// Si efface table  'drop_bd'  //drop table coché oui = on en page 2
	if (isset($effacetables) && $effacetables == 'on') {
	
		$dbdict = NewDataDictionary($db);
		$sqlarray = $dbdict->DropTableSQL(DB_PREFIX."adherent");
		$dbdict->ExecuteSQLArray($sqlarray);

		$sqlarray = $dbdict->DropTableSQL(DB_PREFIX."cotisations") ;	
		$dbdict->ExecuteSQLArray($sqlarray);	
		
		$sqlarray = $dbdict->DropTableSQL(DB_PREFIX."fichier_adherent");
		$dbdict->ExecuteSQLArray($sqlarray);	

		$sqlarray = $dbdict->DropTableSQL(DB_PREFIX."logs") ;	
		$dbdict->ExecuteSQLArray($sqlarray);

		$sqlarray = $dbdict->DropTableSQL(DB_PREFIX."preference_asso") ;	
		$dbdict->ExecuteSQLArray($sqlarray);

		$sqlarray = $dbdict->DropTableSQL(DB_PREFIX."types_antennes") ;	
		$dbdict->ExecuteSQLArray($sqlarray);		
		
		$sqlarray = $dbdict->DropTableSQL(DB_PREFIX."types_cotisations") ;	
		$dbdict->ExecuteSQLArray($sqlarray);		

	}
	
	
	
// si installation	
$erreur_saisie = array() ;
	// Choix de mysql ou mysqli
	$type_bd = $_SESSION['type_bd']; // récupération du choix mysql ou mysqli
	if ($type_bd == 'mysql' || $type_bd == 'mysqli')
		@$db->Execute("ALTER DATABASE `" . $db->database . "` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");
	// force utf8
	$dbdict = NewDataDictionary($db);
	$taboptarray = array('mysql' => 'ENGINE MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci', 'mysqli' => 'ENGINE MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci');		


//*************************
#--  1 Structure de la table `_adherent`	
	$flds = "
		id_adht I(4) KEY AUTO, 
		soc_adht  C(3) NOT NULL default '',
		civilite_adht  C(13) default NULL,
		prenom_adht  C(50) NOT NULL default '',
		nom_adht  C(50) NOT NULL default '',
		adresse_adht  C(100) default NULL,
		cp_adht  C(8) NOT NULL default '0',
		ville_adht  C(50) NOT NULL default '',
		telephonef_adht  C(16) default NULL,
		telephonep_adht C(16) default NULL,
		telecopie_adht  C(16) default NULL,
		email_adht  C(75) default NULL,
		promotion_adht  C(25) default NULL,
		datecreationfiche_adht  D  NOT NULL,
		antenne_adht  I(4) NOT NULL ,
		datenaisance_adht  D  NOT NULL,
		visibl_adht  C(3) NOT NULL default 'Non',
		datemodiffiche_adht  D  NOT NULL,
		siteweb_adht  C(50) default NULL,
		password_adht  C(33) NOT NULL default '',
		login_adht  C(33) NOT NULL default '',
		priorite_adht  C(1) NOT NULL default '1',
		date_echeance_cotis  D  NOT NULL,
		dacces  TS NOT NULL,
		date_sortie  D  NOT NULL,
		tranche_age  C(20) NOT NULL default '',
		qui_enrg_adht  I(4) NOT NULL,
		cotis_adht  C(3) NOT NULL default 'Non',
		disponib_adht  C(250) NOT NULL,
		profession_adht C(50) NOT NULL default '',
		autres_info_adht C(100) NOT NULL default ''
	";
	

	$table = DB_PREFIX."adherent" ;
	$table_num = 't1';
	$_sqlarray = $dbdict->CreateTableSQL($table, $flds, $taboptarray);
	$_return = $dbdict->ExecuteSQLArray($_sqlarray);
//echo 	$_return; // 2 Ok   1 errreur	
		if ($_return == 2) {
		$message_bd[$table_num] =  'Ajout .... : '.$table.' =>  OK <br />';
		} else {
		$message_bd[$table_num] = 'Ajout .... : '.$table.' =>  Erreur -> '.$db->ErrorMsg().'<br />';	
		$erreur_saisie [$table_num] = 'erreur' ;	
		}	
		
//-----------------------------	
#-- 2 Structure de la table `_cotisations`
	$flds = "
	   id_cotis  I(4) KEY AUTO, 
	   qui_cotis  C(3) NOT NULL default '',
	   id_adhtasso   I(4) NOT NULL default '0',
	   id_type_cotis   I(2) NOT NULL default '0',
	   montant_cotis  N(10.2) default '0.00',
	   info_cotis  C(80) NOT NULL default '',
	   date_enregist_cotis  D NOT NULL ,
	   date_debut_cotis  D  NOT NULL ,
	   date_fin_cotis  D  NOT NULL ,
	   cotis  char(3) NOT NULL default '',
	   paiement_cotis char(3) NOT NULL default '',
	   info_archiv_cotis  C(30) NOT NULL default '',
	   datemodiffiche_cotis  D  NOT NULL 
	";

	$table = DB_PREFIX."cotisations" ;
	$table_num = 't2';
	$_sqlarray = $dbdict->CreateTableSQL($table, $flds, $taboptarray);
	$_return = $dbdict->ExecuteSQLArray($_sqlarray);

		if ($_return == 2) {
		$message_bd[$table_num] =  'Ajout .... : '.$table.' =>  OK <br />';
		} else {
		$message_bd[$table_num] = 'Ajout .... : '.$table.' =>  Erreur -> '.$db->ErrorMsg().'<br />';	
		$erreur_saisie [$table_num] = 'erreur' ;	
		}		

//-----------------------------		
#-- 3 Structure de la table `_fichier_adherent`
	$flds = "
	   id_file_adht  I(4) KEY AUTO, 
	   id_adht_file  I(4) NOT NULL default '0',
	   nom_file_adht  C(50) NOT NULL default '',
	   design_file_adht  C(55) NOT NULL default '',
	   date_file_adht  D NOT NULL ,
	   qui_file_adht  I(4) NOT NULL default '0',
	   datemodif_file_adht  D NOT NULL ,
	   file_adht  C(3) NOT NULL default ''
	";

	$table = DB_PREFIX."fichier_adherent" ;
	$table_num = 't3';
	$_sqlarray = $dbdict->CreateTableSQL($table, $flds, $taboptarray);
	$_return = $dbdict->ExecuteSQLArray($_sqlarray);

		if ($_return == 2) {
		$message_bd[$table_num] =  'Ajout .... : '.$table.' =>  OK <br />';
		} else {
		$message_bd[$table_num] = 'Ajout .... : '.$table.' =>  Erreur -> '.$db->ErrorMsg().'<br />';	
		$erreur_saisie [$table_num] = 'erreur' ;	
		}		

//-----------------------------		
#--  4 Structure de la table `_logs`
	$flds = "
   id_log  I(6) KEY AUTO, 
   date_log TS NOT NULL ,
   ip_log  C(30) NOT NULL default '',
   nom_log  C(50) NOT NULL default '',
   action_log  C(50) NOT NULL default ''
	";
	
	$table = DB_PREFIX."logs" ;
	$table_num = 't4';
	$_sqlarray = $dbdict->CreateTableSQL($table, $flds, $taboptarray);
	$_return = $dbdict->ExecuteSQLArray($_sqlarray);

		if ($_return == 2) {
		$message_bd[$table_num] =  'Ajout .... : '.$table.' =>  OK <br />';
		} else {
		$message_bd[$table_num] = 'Ajout .... : '.$table.' =>  Erreur -> '.$db->ErrorMsg().'<br />';	
		$erreur_saisie [$table_num] = 'erreur' ;	
		}	

//-----------------------------		
#-- 5 Structure de la table `_types_cotisations`
	$flds = "
   id_type_cotisation  I(2) KEY AUTO,
   nom_type_cotisation  C(60) NOT NULL default '',
   montant_cotisation N(10.2) default '0.00'
	";
	
	$table = DB_PREFIX."types_cotisations" ;
	$table_num = 't5';
	$_sqlarray = $dbdict->CreateTableSQL($table, $flds, $taboptarray);
	$_return = $dbdict->ExecuteSQLArray($_sqlarray);

		if ($_return == 2) {
		$message_bd[$table_num] =  'Ajout .... : '.$table.' =>  OK <br />';
		} else {
		$message_bd[$table_num] = 'Ajout .... : '.$table.' =>  Erreur -> '.$db->ErrorMsg().'<br />';	
		$erreur_saisie [$table_num] = 'erreur' ;	
		}	
		
//-----------------------------
#-- 6 Structure de la table `_preference_asso`
	$flds = "
   id_pref  I(2) KEY AUTO,
   design_pref  C(25) NOT NULL default '',
   val_pref  C(40) NOT NULL default ''
	";
	
	$table = DB_PREFIX."preference_asso" ;
	$table_num = 't6';
	$_sqlarray = $dbdict->CreateTableSQL($table, $flds, $taboptarray);
	$_return = $dbdict->ExecuteSQLArray($_sqlarray);

		if ($_return == 2) {
		$message_bd[$table_num] =  'Ajout .... : '.$table.' =>  OK <br />';
		} else {
		$message_bd[$table_num] = 'Ajout .... : '.$table.' =>  Erreur -> '.$db->ErrorMsg().'<br />';	
		$erreur_saisie [$table_num] = 'erreur' ;	
		}	

//-----------------------------
#--  7 Structure de la table `_types_antennes`
	$flds = "
   id_type_antenne  I(2) KEY AUTO,
   nom_type_antenne  C(30) NOT NULL default ''
	";
	
	$table = DB_PREFIX."types_antennes" ;
	$table_num = 't7';
	$_sqlarray = $dbdict->CreateTableSQL($table, $flds, $taboptarray);
	$_return = $dbdict->ExecuteSQLArray($_sqlarray);

		if ($_return == 2) {
		$message_bd[$table_num] =  'Ajout .... : '.$table.' =>  OK <br />';
		} else {
		$message_bd[$table_num] = 'Ajout .... : '.$table.' =>  Erreur -> '.$db->ErrorMsg().'<br />';	
		$erreur_saisie [$table_num] = 'erreur' ;	
		}	
	

?>