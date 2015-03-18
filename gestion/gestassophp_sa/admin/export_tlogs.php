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
 *   Fichier :
 *   Export au format texte XLS de la table logs
*/

include_once '../config/connexion.php';
$masession = new sessions(); // -->la classe session 	//session_start();
// Raz  du tri
	//$_SESSION['tri']=0;
	//$_SESSION['tri_sens']=1;
	
// Si pas de session ...	
$sessionadherent=(empty($_SESSION['ses_id_adht'])) ? $sessionadherent='' :$sessionadherent = $_SESSION['ses_id_adht'];

// on récupère le login et le password correspondant au numéro de session en cours	
$logpass=$masession->verifie_LogingPaswd_bd($sessionadherent);
$log = $logpass[0];
$pas = $logpass[1];

// Raz de variables
$i= 0;

// vérification de l'authenticité du visiteur		
if (($sessionadherent) && $log == ($_SESSION['ses_login_adht']) && $pas == ($_SESSION['ses_paswd_adht'])) {
/***** ici commence le code en cas d'authentification */
	$priorite_adht = $_SESSION['ses_priorite_adht'];
	$prenom_adht = $_SESSION['ses_prenom_adht']; //  pour affichage
	$nom_adht = $_SESSION['ses_nom_adht'] ; //  pour affichage
	

/***** On EXPORTE tout les logs	*/
	if (isset($_GET['export_ok'])) {
		$export_ok = get_post_variable_numeric('export_ok','0');// par défaut 1 
		if ($export_ok == 1) {	
		// entete du fichier téléchargé	
		
		    header("Content-Type: application/vnd.ms-excel");
		    header("Content-Disposition: attachment; filename=logs_gestassophp.xls");
		    header("Pragma: no-cache");
		    header("Expires: 0");
		     

		    $now_date = date('d-m-Y H:i');
			// titre de la première ligne du fichier
		    $title = "Extrait de la table ".TABLE_LOGS." - le ".$now_date;	
		    echo("$title\n");  // affiche la ligne de titre

			$dbresult = $db->Execute("SELECT * FROM  ".TABLE_LOGS );
			//id_log	date_log	ip_log	nom_log	action_log
		    print("Num\t Date \t IP \t Nom \t Action \n");	
			//  chaque fois que "$res" est dif. de "$i", donc qu'il y a un enregisrement 	

			while ($dbresult && $row = $dbresult->FetchRow()) {
				$champ0 = $row['id_log'];	
		        $champ1 = $row['date_log'];
		        $champ2 = $row['ip_log'];
		        $champ3 = $row['nom_log'];
		        $champ4 = $row['action_log'];
				
				//$indice++;	
				print ("$champ0\t $champ1\t $champ2\t $champ3\t $champ4\n");
			}			

			
		} else {
		header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR); 		
		}
	
	}	
	
} else { /***** il y a une erreur ... Si erreur  on envoie vers la page de login ... avec message */		
	header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR);  
}
	
?>
    
