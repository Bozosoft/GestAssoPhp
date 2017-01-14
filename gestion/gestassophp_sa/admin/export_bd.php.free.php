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
 *  Directory :  /ROOT_DIR_GESTASSO/admin/
 *   Fichier : export_bd.php
 *   Export au format texte SQL des tables  Strucure Et/Ou données 
 *   Grâce à la class phpmysqldump Auteur/author... : Pascal CASENOVE  phpdev@cawete.com
*/

include_once '../config/connexion.php';


$masession = new sessions(); // -->la classe session 	//session_start();

// définir variable
define('CURRENTLANGUAGE','fr'); // la langue fr
// Raz de variables
//$link = '';
$sav_struct_bd ='';
	
// Si pas de session ...	
$sessionadherent=(empty($_SESSION['ses_id_adht'])) ? $sessionadherent='' :$sessionadherent = $_SESSION['ses_id_adht'];

// on récupère le login et le password correspondant au numéro de session en cours	
$logpass=$masession->verifie_LogingPaswd_bd($sessionadherent);
$log = $logpass[0];
$pas = $logpass[1];

// vérification de l'authenticité du visiteur		
if (($sessionadherent) && $log == ($_SESSION['ses_login_adht']) && $pas == ($_SESSION['ses_paswd_adht'])) {
/***** ici commence le code en cas d'authentification */
	$priorite_adht = $_SESSION['ses_priorite_adht'];
	$prenom_adht = $_SESSION['ses_prenom_adht']; //  pour affichage
	$nom_adht = $_SESSION['ses_nom_adht'] ; //  pour affichage
	

/***** On EXPORTE less données	*/

	 if (isset($_REQUEST["valid_sav"])) {
		
		$sav_struct_bd =(get_post_variable('struct',''));	
		$sav_data_bd =(get_post_variable('data',''));	// modif 12 Un seul choix posible Oui
		
// si  postgres export
		if ( TYPE_BD_AODB == 'postgres' ) {		
			include_once '../include/phppgdump.class.php' ;	 
			
// ATTENTION  suivant serveur les lignes suivantes doivent être commentées ou supprimées
// // supprimer les lignes suivantes car ouvre plusieurs connexion chez Free.fr				
/*			$link = '';	
			$pgsql_conn = pg_connect(" dbname=".NOM_BD." host=".SERVEUR_BD." user=".NOMUTILISATEUR_BD." password=".MOTPASSE_BD." ");
				if ($pgsql_conn) {
					$link = pg_port($pgsql_conn); //			$link = '5432';	
				}	
*/		
// // Fin de supprimer les lignes

			$db->Close() ; // ferme les connexions 				
			$pg_sav = new phpmypostgresqldump( SERVEUR_BD, NOMUTILISATEUR_BD, MOTPASSE_BD, NOM_BD, CURRENTLANGUAGE, $link);			
			if ($sav_struct_bd == 'Non') {
				$pg_sav->struct_yes = 0; // 1 = structure  0 pas de stucture 
			} else {
				$pg_sav->struct_yes = 1; // 1 = structure  0 pas de stucture
			}
			
			$pg_sav->data_yes = 1; //1 = données  
			$pg_sav->encoding = "UTF8"; // + Encodoge Base ATTENTION ODIFIER si necessaire
			$pg_sav->fly = true; // pas de creation de fichier sauvegarde au vol / 
			//$pg_sav->nettoyage(); // facultatif enleve les anciens fichiers de sauvegarde / empty the temp directory SI utilisation SAV avec fichier sur l'espace
			//$pg_sav->compress_ok = true; // active la compression gz sauf si $fly = true; Et pour  utilisation SAV avec fichier sur l'espace
			$pg_sav->backup();  //or  $pg_sav->backup( $sql_file);   le nom fichier export - si vide le nom sera créer par la cless
		
			//affiche les erreurs
			if($pg_sav->errr){ echo $pg_sav->errr;} // affichage des messages d'erreur	
		}
		
// si  mysql export		
		if ( TYPE_BD_AODB == 'mysql' ||  TYPE_BD_AODB == 'mysqli') { //12/01/2017
			include_once '../include/phpmysqldump.class.php' ;	 		
			$sav = new phpmysqldump( SERVEUR_BD, NOMUTILISATEUR_BD, MOTPASSE_BD, NOM_BD, CURRENTLANGUAGE, $link='');
			
			if ($sav_struct_bd == 'Non') {
				$sav->struct_yes = 0; // 1 = structure  0 pas de stucture 
			} else {
				$sav->struct_yes = 1; // 1 = structure  0 pas de stucture
			}
			
			$sav->data_yes = 1; //1 = données    // modif 12/12/09 Un seul choix posible Oui		
			$sav->fly=1; // pas de creation de fichier sauvegarde au vol / 1-> on fly backup other hard drive backup
			//	$sav->nettoyage(); // facultatif enleve les anciens fichiers de sauvegarde SI utilisation SAV avec fichier sur l'espace
			//$sav->compress_ok=1; // flag pour activer la compression / 1->zip backup not for on fly backup
			$sav->backup();	// lance la sauvegarde		// start the backup whith an automatic name for the backup file

			//affiche les erreurs
			if($sav->errr){ echo $sav->errr;} // affichage des messages d'erreur / display errors		
		}
		
	} // Fin valid_sav
	
		
	
} else { /***** il y a une erreur ... Si erreur  on envoie vers la page de login ... avec message */		
	header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR);  
}
	
?>
    
