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


	include_once 'include_install.php'; // les variables + les définitions de répertoires
	
	// Raz de variables
	$erreur_saisie = array();// tableau
	$valid_bd_config = '';
	$sql_query = '';
	$effacetables = 0;
	$valid_bd_sql = '';
	
	
	define('TEMPLATES_LOCATION_INSTAL', join_path(ROOT_DIR_GESTASSO,'install' ) ); // repertoire Fichiers des templates Installation
	$tpl = new Smarty; //instance de Smarty pour scripts PHP	
//	$tpl->compile_dir = TMP_TEMPLATES_C_LOCATION ;// répertoire par défaut de compilation = templates_c 
//	$tpl->template_dir = TEMPLATES_LOCATION; // répertoire par défaut des templates = templates
//  verson 3.x
	$tpl->setCompileDir (TMP_TEMPLATES_C_LOCATION) ;// répertoire par défaut de compilation = templates_c // Smarty version 3.x
	$tpl->setTemplateDir (TEMPLATES_LOCATION); // répertoire par défaut des templates = templates // Smarty version 3.x
// OPTIONS		
	$tpl->error_reporting = E_ALL & ~E_NOTICE;
	
	$masession = new sessions(); // -->la classe session 	
		//Gestion erreur retour arrière depuis page 5
		if ( isset($_SESSION['id_install2']) && $_SESSION['id_install2'] == '1') {
			$texterreurretour_ar = 'Op&eacute;ration retour arri&egrave;re INTERDITE !';
			header('location: install_5.php?id_adht=1&e_rar='.$texterreurretour_ar);
					exit;
		}

	if (isset($_GET['valid2'])) { // on arrive de la page 2 // header('location: install_3.php?valid2=ok');
		$ok_valid2 = $_SESSION['valid2'];	 // vérifie que c'et bien la page 2 qui a été envoyée
		if ($ok_valid2 == 'valid2') {	

//on  écrit les fichier de config et installe la BD
	
			$type_bd = $_SESSION['type_bd'];
			$serveur_bd = $_SESSION['serveur_bd'];		
			$utilis_bd = $_SESSION['utilis_bd'];
			$nom_bd = $_SESSION['nom_bd'];		
			$motpas_bd = $_SESSION['motpas_bd'];
			$prefix_bd = $_SESSION['prefix_bd'] ;
			$effacetables =	$_SESSION['drop_bd'] ; // = on ==1	
			$errorfile_config = '';
/*	
echo 'type_bd='.$type_bd.'-';	
echo 'serveur_bd='.$serveur_bd.'-';	
echo 'utilis_bd='.$utilis_bd.'-';		
echo 'nom_bd='.$nom_bd.'-';	
echo 'motpas_bd='.$motpas_bd.'-';				
echo 'prefix_bd='.$prefix_bd.'-';
*/


// création du fichier de configuration
		
		define('CONFIG_FILE', join_path(ROOT_DIR_GESTASSO,'config','connexion.cfg.php')); // 	
			if($fd = @fopen (CONFIG_FILE , 'w')) {
//Modéle Fichier de config			
				$data = "<?php 
				
/**
 * Projet : gestassophp_sa [GestAssoPhp+Pg]
 *  Directory :  /ROOT_DIR_GESTASSO/config/
 *  Fichier : config.cfg.php
 *  Page connexion - configuation   
 * @author : JC Etiemble - http://jc.etiemble.free.fr
 * @version :  2018
 * @copyright 2007-2018  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */


// Definition de la BD - Parametres de connexion	
			
define(\"TYPE_BD\", \"".$type_bd."\"); //Type de la BD			
define(\"NOMUTILISATEUR_BD\", \"".$utilis_bd."\"); //Nom d'utilisateur de la BD
define(\"MOTPASSE_BD\", \"".$motpas_bd."\"); // Mot de passe de la BD
define(\"SERVEUR_BD\", \"".$serveur_bd."\"); // Serveur de la BD
define(\"NOM_BD\", \"".$nom_bd."\"); // Nom de la BD

define(\"DB_PREFIX\", \"".$prefix_bd."\"); // Modifiable pour la BD

?>";
// Fin Modèle Fichier de config	


// Ecrit les informations de config

				fwrite($fd,$data);
				fclose($fd);
				$message_file_config = '<span class="TextevertGras">Fichier de configuration cr&eacute;&eacute; ... OK</span>';
				$valid_file_config = 'oui';
			} else {
				$message_file_config = 'Erreur : Impossible de cr&eacute;er le fichier de configuration ...<br />'.CONFIG_FILE;
				$valid_file_config = 'non';
			}	

//Création de la base de données
		
			if ($valid_file_config == 'oui') { // on continue
				$valid_bd_sql = 'non'; // initialise pour erreur
				$erreur_saisie = '' ; // initialise pour erreur		
				include '../config/connexion.cfg.php';	 //  /*********connexion.cfg.php
	// Creé une connexion sur la Base de donnée	
				$db = ADONewConnection(TYPE_BD); //crée une connexion  Strict Standards: Only variables should be assigned by reference SUPRESSION de &  deavant &ADONewConnection
				if(!@$db->Connect(SERVEUR_BD, NOMUTILISATEUR_BD, MOTPASSE_BD, NOM_BD)) die("S&eacute;lection de la base de donn&eacute;es impossible !!!");	


//Création des TABLES  la base de données

				include 'schema.php';	


// Insertion des DONNéES de la base de données

				$message_bd['data'] =  '<span class="TextevertGras">Insertion des donn&eacute;es .... : </span><br />';
				define('FILE_SQL', join_path(ROOT_DIR_GESTASSO,'install','data.sql')); // 	
				include 'sql_parse.php';			
				// on lit le fichier SQL
				$sql_query .= @fread(@fopen(FILE_SQL, 'r'), @filesize(FILE_SQL))."\n";
				// on remplace par le prefix
				$sql_query = preg_replace('/gs_/', DB_PREFIX, $sql_query);
				$sql_query = remove_remarks($sql_query);	
				// on= crée un tableau de chaque ligne de requette  -->fin de ligne ;
				$sql_query = split_sql_file($sql_query, ";");

				for ($i = 0; $i < sizeof($sql_query); $i++) {
					$query = trim($sql_query[$i]);
					if ($query != '' && $query[0] != '-') {				
						// la requette vers la base de données
						$req = $sql_query[$i];
						$dbresult = $db->Execute($req);
						if (!$dbresult) {					
							$valid_bd_sql = 'non';
							//echo $dbresult;
							$message_bd[$i] = 'erreurs lors de la cr&eacute;ation .... : '.($db->ErrorMsg()). '<br />';
						} else {
							$valid_bd_sql = 'oui';
							$message_bd[$i] = 'Requette '.$i.' -> '.$req.' => Ok <br />';
						}
					}
				}				

// Contrôle final
	
				if (count($erreur_saisie)== 0) {
					$message_bd_config = 'Cr&eacute;ation de la base de donn&eacute;es et des tables ... OK';	
					$valid_bd_sql = 'oui';
				}
				if (count($erreur_saisie)>= 1) {
					$message_bd_config = 'Erreur : Base de donn&eacute;es et tables... ';	
					$valid_bd_sql = 'non';
				}
//si config NON valide			
			} else {
				$message_bd_config = 'Erreur : Cr&eacute;ation de la base de donn&eacute;es et des tables... Impossible ! ';
				$valid_bd_config = 'non';			
			}

		} else { // SI ERREUR 
			header('location: index.php');
		}
	}

	
/***** ---------------------------------------------------------------------- */		
	// Préparation pour Affichage partie Fixe VERS TEMPLATE	 	
	$tpl->assign('version_i',VERSION_I); // version installateur
    $tpl->assign('style_i',STYLE_I); //  Feuille de syle  style_screen.css ou m_style_screen.css
	$tpl->assign('messagetitre','Cr&eacute;ation du fichier de configuration et la base de donn&eacute;es'); // titre de la  page
	$tpl->assign('Etape1','Etape 1 - OK'); // menu	
	$tpl->assign('Etape2','Etape 2 - OK'); // menu	
	$tpl->assign('titre','Etape 3'); // Titre de la page
	$tpl->assign('Etape3','<span class="TextenoirGras">Etape 3</span>'); // menu	
		$tpl->assign('Etape4','<span class="TextenoirR">Etape 4</span>'); // menu	
		$tpl->assign('Etape5','<span class="TextenoirR">Etape 5</span>'); // menu		
	$tpl->assign('erreur_saisie',$erreur_saisie); // Erreur de saisie sur champs Obligatoires	
	
	$tpl->assign('valid_file_config',$valid_file_config); //message file config OK ou Non
	$tpl->assign('message_file_config',$message_file_config); // File config problème
	
	$tpl->assign('valid_bd_sql',$valid_bd_sql); //message sql		
	$tpl->assign('message_bd',$message_bd); // 	
	
	$tpl->assign('valid_bd_config',$valid_bd_config); //message BD OK ou Non
	$tpl->assign('message_bd_config',$message_bd_config); //problème BD	

	$content = $tpl->fetch('install_3.tpl'); // On affiche ...	
	$tpl->assign('content',$content);		
	$tpl->display('index_instal.tpl');	

?>
