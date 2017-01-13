<?php
/**
 * Projet : gestassophp_sa [GestAssoPhp+Pg]
 * Basé sur Gestion membres Pour CAP Compétences Version originale avril 2003 et sur la version Pour FB-Rouen 2007  (c) JC Etiemble 
 * ---------------------------
 * Licence Creative Commons selon les termes du présent contrat appelé Contrat Public Creative Commons 
 * Auteur original : Jean-Claude Etiemble
 * @link :  http://creativecommons.org/licenses/by-nc-sa/2.0/fr/  - Paternité - Pas d'Utilisation Commerciale - Partage des Conditions Initiales à l'Identique 2.0 France
 * Vous êtes libres : de reproduire, distribuer et communiquer cette création au public, de modifier cette création
 * Selon les conditions suivantes : 
 * Paternité. Vous devez citer le nom de l'auteur original de la manière indiquée par l'auteur de l'oeuvre ou le titulaire des droits qui vous confère cette autorisation 
 * Pas d'Utilisation Commerciale. Vous n'avez pas le droit d'utiliser cette création à des fins commerciales. 
 * Partage des Conditions Initiales à l'Identique.  
 * Si vous modifiez, transformez ou adaptez cette création, vous n'avez le droit de distribuer la création qui en résulte que sous un contrat identique à celui-ci
 *
 * Chacune de ces conditions peut être levée si vous obtenez l'autorisation du titulaire des droits sur cette oeuvre.
 * Rien dans ce contrat ne diminue ou ne restreint le droit moral de l'auteur ou des auteurs.
 *
 * Code Juridique (la version intégrale du contrat). http://creativecommons.org/licenses/by-nc-sa/2.0/fr/legalcode
 * Copie de la licence - Contrat Public Creative Commons   /doc/CCA-NA-France.htm
 * Auteur original : Jean-Claude Etiemble
 * ---------------------------
 *	
 * @link :  http://   pour test
 * @author : JC Etiemble - http://jc.etiemble.free.fr
 * @version :  2014
 * @copyright 2007-2014  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */
 
/**
 *  Directory :  /ROOT_DIR_GESTASSO/adherent/
 *   Fichier :
 *   Redirige  sur  Fiche adherent OU Tableau de bord Admin
*/

include_once '../config/connexion.php';
$masession = new sessions(); // -->la classe session 
// Raz  du tri	
$_SESSION['tri']=0;
$_SESSION['tri_sens']=1;
	
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
		
		
	// Envoi vers la page en fonction de 	priorite_adht	>=4  -->4 = admin en consultation tableau de bord	
		if ($priorite_adht >=4) {
			header('location: ../admin/tableau_bord.php');
			//echo 'Ok pour tabbord adht/index<br/>';
		} else {
			header('location: ../adherent/gerer_fiche_adht.php');
		}


} else { /***** il y a une erreur ... Si erreur  on envoie vers la page de login ... avec message */		
	header('location: ../index.php?texterreur=Erreur... Identifiez-vous de nouveau !!'); 
}

?>
    