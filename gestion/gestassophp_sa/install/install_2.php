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
 * @version :  2017
 * @copyright 2007-2017  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */
 
/**
 *  Directory :  /ROOT_DIR_GESTASSO/install/
 *   Fichier :
 *   Installation du système
*/


	include_once 'include_install.php';  // les variables + les définitions de répertoires
	
	// Raz de variables
	$erreur_saisie = array();// tableau
	$config_bd = array(); //  12/01/17 // Illegal string offset 'drop_bd'
	$config_bd = array('drop_bd' => ''); //12/01/17 Illegal string offset 'drop_bd' // Vide non coché pour Effacement des tables
	// Test si PHP 7 - Pour choix de mysqli ou postgres si PHP 7.x
	if  (phpversion() > 6 ) { 
		$T_type_bd = array('mysqli'=>'MySQLi', 'postgres'=>'PostgreSQL');
	}else{
		$T_type_bd = array('mysqli'=>'MySQLi' , 'mysql'=>'MySQL' , 'postgres'=>'PostgreSQL');
	}
	

// On modifie le repertoire de Smarty pour .....	
	define('TEMPLATES_LOCATION_INSTAL', join_path(ROOT_DIR_GESTASSO,'install' ) ); // repertoire Fichiers des templates Installation
	$tpl = new Smarty; //instance de Smarty pour scripts PHP	
//	$tpl->compile_dir = TMP_TEMPLATES_C_LOCATION ;// répertoire par défaut de compilation = templates_c 
//	$tpl->template_dir = TEMPLATES_LOCATION; // répertoire par défaut des templates = templates
//  verson 3.x
	$tpl->setCompileDir (TMP_TEMPLATES_C_LOCATION) ;// répertoire par défaut de compilation = templates_c // Smarty version 3.x
	$tpl->setTemplateDir (TEMPLATES_LOCATION); // répertoire par défaut des templates = templates // Smarty version 3.x
// OPTIONS		
	$tpl->error_reporting = E_ALL & ~E_NOTICE;
	
	if (isset($_POST['valid1'])) {	// on arrive de la page 1 
		$ok_valid=(get_post_variable('valid1','')); // vérifie que c'et bien la page 1 qui a été envoyée
		if ($ok_valid == 'valid1') {

			$masession = new sessions(); // -->la classe session 
			//Gestion erreur retour arrière depuis page 5
			if ( isset($_SESSION['id_install2']) && $_SESSION['id_install2'] == '1') {
				$texterreurretour_ar = 'Op&eacute;ration retour arri&egrave;re INTERDITE !';
				header('location: install_5.php?id_adht=1&e_rar='.$texterreurretour_ar);
						exit;
			}			
			
/*****  on affiche la fiche la première fois  */	
			//$config_bd =''; // 12/01/17 // Cannot assign an empty string to a string offset
			$config_bd ['type_bd'] = ''; //Type de base de données 	 	//$T_type_bd	
			$config_bd ['serveur_bd'] = 'localhost'; //Addresse du serveur de base de données 				
			$config_bd ['nom_bd'] = 'gestassosimpl'; //Nom de la base de données
			$config_bd ['utilis_bd'] = 'root'; //Nom d'utilisateur				 
			$config_bd ['motpas_bd'] = ''; //Mot de passe 			
			$config_bd ['prefix_bd'] = 'gsa_'; //Préfix des tables				
/***** FIN  on affiche la fiche la première fois  */	
		
		} else {
			$config_bd ='';
			header('location: index.php');		
		}
		
	}


/***** Si on validé le Formulaire  par le bouton Valider  */
	if (isset($_POST['valid2'] )) { // on a validé la page 2 .tpl
		
		$ok_valid2=(get_post_variable('valid2',''));
//echo'--->'. $ok_valid2 ;		
		// -- Récuprération des variable du formulaire ---
		$config_bd['type_bd'] = post_variable('type_bd',''); //'MySQL ou  postgres'; //Type de base de données
//echo $config_bd['type_bd'].'-';			
		$config_bd ['serveur_bd']= post_variable('serveur_bd',''); //Addresse du serveur de base de données
//echo $config_bd ['serveur_bd'].'-';	
		$config_bd ['nom_bd']= post_variable('nom_bd','');//Nom de la base de données
//echo $config_bd ['nom_bd'].'-';	
		$config_bd ['utilis_bd']= post_variable('utilis_bd','');//Nom de la base de données
//echo $config_bd ['utilis_bd'].'-';	
		$config_bd ['motpas_bd']= post_variable('motpas_bd',''); //Mot de passe
//echo $config_bd ['motpas_bd'].'-';		
		$config_bd ['prefix_bd']= post_variable('prefix_bd','gs0_'); //Préfix des table  /////////////////////////////////
//echo $config_bd ['prefix_bd'].'-';		
		$config_bd ['drop_bd']= post_variable('drop_bd',''); //drop table coché oui = on  = Effacement des tables
//echo '->'.$config_bd ['drop_bd'].'-';

	
		if ($config_bd ['serveur_bd'] == '') {
			$erreur_saisie ['serveur_bd'] = 'Addresse du serveur de base de donn&eacute;es';
		}	
		if ($config_bd ['nom_bd'] == '') {
			$erreur_saisie ['nom_bd'] = 'Nom de la base de donn&eacute;es';
		}
		if ($config_bd ['utilis_bd'] == '') {
			$erreur_saisie ['utilis_bd'] = 'Nom utilisateur';
		}			
		if 	($config_bd ['serveur_bd'] != 'localhost') {	
			if ($config_bd ['motpas_bd'] == '') {
				$erreur_saisie ['motpas_bd'] = 'Mot de passe';
			}
		}
		if ( !preg_match('/^[a-zA-Z0-9_]+$/', trim($config_bd ['prefix_bd'])) ) {
			$erreur_saisie ['prefix_bd'] = 'Le pr&eacute;fix des tables de base de donn&eacute;es contient des caract&egrave;res invalides !';
		}				

									
// Test Connexion à la  base données			
	// Creé une connexion sur la Base de donnée
	$db = ADONewConnection($config_bd ['type_bd']); //crée une connexion  
	$db->debug = false; // true;// false; // Mode débug ou Non

	// cherche  un port existe pour postgres
	$dbport = '';	 // en général $dbport = '5432';  
		if ( ($config_bd['type_bd']) == "postgres") {
			$pgsql_conn = pg_connect("dbname=".$config_bd['nom_bd']." host=".$config_bd['serveur_bd']
			." user=".$config_bd['utilis_bd']." password=".$config_bd['motpas_bd']." ");
			if ($pgsql_conn) {
			   $dbport = pg_port($pgsql_conn) ;
			}	
// TEST sur free.fr  Supprimer les lignes suivant SINON erreur : Connexion base de données PostgreSQL impossible !!!			
//			if(!@$db->Connect($config_bd['serveur_bd'], $config_bd['utilis_bd'], $config_bd['motpas_bd'], $config_bd['nom_bd'],$dbport)) {
//				$erreur_saisie ['connexion'] = 'Connexion base de donn&eacute;es PostgreSQL impossible !!! ';
	//if(!@$db->Connect(SERVEUR_BD, NOMUTILISATEUR_BD, MOTPASSE_BD, NOM_BD)) die("S&eacute;lection de la base de donn&eacute;es impossible !!!");
//			}
		} else {
			if(!@$db->Connect($config_bd ['serveur_bd'], $config_bd ['utilis_bd'], $config_bd ['motpas_bd'], $config_bd ['nom_bd'])) {
				$erreur_saisie ['connexion'] = 'Connexion base de donn&eacute;es MySQL impossible !!!';		
			}
		}	
	//Fin check port BD
		
		if (count($erreur_saisie)== 0  && $ok_valid2 == 'valid2') { // si pas erreur Et  on a validé la page 2 .tpl	
		// Si Aucune erreur de saisie ON Valide lesdonnées
			$masession = new sessions(); // -->la classe session 	//session_start();
			$_SESSION['type_bd'] = $config_bd ['type_bd'];	
			$_SESSION['serveur_bd'] = $config_bd ['serveur_bd'];	
			$_SESSION['nom_bd'] = $config_bd ['nom_bd'];
			$_SESSION['utilis_bd'] = $config_bd ['utilis_bd'];	
			$_SESSION['motpas_bd'] = $config_bd ['motpas_bd'];
			$_SESSION['prefix_bd'] = $config_bd ['prefix_bd'];
			$_SESSION['drop_bd'] = $config_bd ['drop_bd'];
			$_SESSION['valid2'] = 'valid2';	
		// on passee à la page suivante			
			header('location: install_3.php?valid2=ok'); // on passe à la page 3 
		}
	
		// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE				
		$tpl->assign('config_bd',$config_bd); //	  on réaffiche les informations dans le formulaire de saisie		
		
/***** FIN Si on validé le Formulaire  par le bouton Valider  */
	} 

		// Recherche pour savoir si  Driver postgres (PostgreSQL Support) et/ou mysql  (MySQL Support) existe
		$postgres = function_exists('pg_connect');
		$pgsql_bd = 'PostgreSQL : '.($postgres ? 'Oui' : '<strong>Non</strong>');	
		$mysql = function_exists('mysql_connect');
		$mysql_bd = 'MySQL  : '.($mysql ? 'Oui' : '<strong>Non</strong>');
		$tpl->assign('pgsql_bd', $pgsql_bd); //		
		$tpl->assign('mysql_bd', $mysql_bd); //	
	
/***** ---------------------------------------------------------------------- */		
	// Préparation pour Affichage partie Fixe VERS TEMPLATE	 	
	$tpl->assign('version',VERSION_I); // Version de Gestasso		
	$tpl->assign('messagetitre','Information sur la base de donn&eacute;es'); // titre de la  page
	$tpl->assign('Etape1','Etape 1 - OK'); // menu	
	$tpl->assign('Etape2','<span class="TextenoirGras">Etape 2</span>'); // menu	
		$tpl->assign('Etape3','<span class="TextenoirR">Etape 3</span>'); // menu	
		$tpl->assign('Etape4','<span class="TextenoirR">Etape 4</span>'); // menu	
		$tpl->assign('Etape5','<span class="TextenoirR">Etape 5</span>'); // menu	
	$tpl->assign('titre','Etape 2'); // Titre de la page	
	$tpl->assign('list_type_bd',$T_type_bd);
	
	$tpl->assign('erreur_saisie',$erreur_saisie); // Erreur de saisie				
	$tpl->assign('config_bd',$config_bd); // le tableau des variables de configuration
	//$tpl->assign('message',$message); // information	connexion BD OK
	
	$content = $tpl->fetch('install_2.tpl'); // On affiche ...	
	$tpl->assign('content',$content);		
	$tpl->display('index_instal.tpl');
	
?>
