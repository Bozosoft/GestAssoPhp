<?php
/**
 * Projet : gestassophp_sa [GestAssoPhp+Pg] * Basé sur Gestion membres Pour CAP Compétences Version originale avril 2003 et sur la version Pour FB-Rouen 2007  (c) JC Etiemble 
 * ---------------------------
 * Licence Creative Commons selon les termes du présent contrat appelé Contrat Public Creative Commons 
 * Auteur original : Jean-Claude Etiemble
 * @link :  http://creativecommons.org/licenses/by-sa/2.0/fr/  - Paternité - Partage à l'Identique 2.0 France (CC BY-SA 2.0)
 * Vous êtes libres : partager — reproduire, distribuer et communiquer cette création, remixer — modifier cette création, d’utiliser cette création à des fins commerciales
 * Selon les conditions suivantes : 
 * Paternité. Vous devez citer le nom de l'auteur original de la manière indiquée par l'auteur de l'oeuvre ou le titulaire des droits qui vous confère cette autorisation 
 * Partage des Conditions Initiales à l'Identique.  
 * Si vous modifiez, transformez ou adaptez cette création, vous n'avez le droit de distribuer la création qui en résulte que sous un contrat identique à celui-ci
 * Chacune de ces conditions peut être levée si vous obtenez l'autorisation du titulaire des droits sur cette oeuvre.
 * Rien dans ce contrat ne diminue ou ne restreint le droit moral de l'auteur ou des auteurs.
 *
 * Code Juridique (la version intégrale du contrat). http://creativecommons.org/licenses/by-sa/2.0/fr/legalcode
 * Copie de la licence - Contrat Public Creative Commons   /doc/CCBY-SA-France.htm
 * Auteur original : Jean-Claude Etiemble
 * ---------------------------
 *
 * @author : JC Etiemble - http://jc.etiemble.free.fr
 * @version :  2014
 * @copyright 2007-2014  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */
 
/**
 *  Directory :  /ROOT_DIR_GESTASSO/
 *   Fichier :
 *   Fichier Index controle l'authentfication et redirige vers /adherent/index.php
*/

//Test si l'installation est existante par le fichier config/connexion.cfg.php
	if (file_exists('config/connexion.cfg.php')) {
		define('INDEX0', 'OK');// pour inclusion de  fileloc_gestasso dans la suite du programme
		include_once 'config/connexion.php';
	}else {
		// sinon vers install
		if (file_exists('install/index.php')) {
			header('location: install/index.php');
		} else {
			echo '<br /><br /><span style="color:#FF0000; font-weight : bold">Fichier config/connexion.cfg.php absent !  STOP !</span>
			<br /><br /> Vérifier ou connectez vous sur '.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"].'/install/ <br />
			Si vous êtes autorisé à effectuer cette opération';			
		}
		exit;
	}

	// Raz de variables
	$dbresult = '' ;
	$nom_adht = $prenom_adht = '' ;
	
// Il faut renommer le dossier  /install !!
	
$masession = new sessions(); // -->la classe session //session_start();

// Si pas de session ...
$priorite_adht=(empty($_SESSION['ses_priorite_adht'])) ? $priorite_adht='' :$priorite_adht = $_SESSION['ses_priorite_adht'];

$texterreurlogin = get_post_variablehtml('texterreur', '');// récupère un erreur ... fin de session, erreur de connexion...
	if ($texterreurlogin != '') {	
		$texterreurlogin =_LANG_MESSAGE_TEXTERREUR	;
	}

// Si pas de session ...
$priorite_adht=(empty($_SESSION['ses_priorite_adht'])) ? $priorite_adht='' :$priorite_adht = $_SESSION['ses_priorite_adht'];

$texterreurlogin = get_post_variablehtml('texterreur', '');// récupère un erreur ... fin de session, erreur de connexion...
	if ($texterreurlogin != '') {	
		$texterreurlogin =_LANG_MESSAGE_TEXTERREUR	;
	}	

/***** si on a validé le formulaire login */
if (isset($_POST['ident'])) {

		$mylogin =  htmlentities(post_variable('login',''), ENT_QUOTES); //++	
			if ( is_valid_mylogin($mylogin)==  false  ) {	
			// veriffication lettre-chiffre ET  Nb caractéres  suivant /fonction.php	
				$mylogin = '';				
			}	
		$mypassword = htmlentities(post_variable('password',''), ENT_QUOTES); //++ 
			if ( is_valid_mypasswd($mypassword) ==  false ) {	
			// veriffication lettre-chiffre ET  Nb caractéres  suivant /fonction.php	
				$mypassword ='' ;
			}

		// Si le adminsalt existe
		if (defined('SITEMASK')) { // Retourne TRUE si le nom de la constante fournie a été définie
			$mypassword =(SITEMASK.$mypassword);
		} 
		
		$req_auth = "SELECT id_adht,prenom_adht,nom_adht,login_adht,password_adht,priorite_adht"
		." FROM ".TABLE_ADHERENTS." WHERE password_adht='".(md5($mypassword))
		."' and login_adht='".($mylogin)."'";			
		$dbresult = $db->Execute($req_auth);
	/***** vérification de l'autorisation */

		if ($dbresult->RecordCount() == 1) {  // 1 enregistrement					   
			$sessionadherent = $dbresult->fields['id_adht'];
			$priorite_adht = $dbresult->fields['priorite_adht'];
			// copie dans SESSIONS[]  les variables
			$_SESSION['ses_id_adht'] = $sessionadherent;
			$_SESSION['ses_priorite_adht'] = $priorite_adht; //ses_priorite_adht 0 à 9			
			$_SESSION['ses_login_adht'] = $dbresult->fields['login_adht']; //$row['login_adht'];
			$_SESSION['ses_paswd_adht'] = $dbresult->fields['password_adht'];
			$_SESSION['ses_prenom_adht'] = $dbresult->fields['prenom_adht'];
			$_SESSION['ses_nom_adht'] = $dbresult->fields['nom_adht'];
			$prenom_adht = $_SESSION['ses_prenom_adht']; //  pour écrture log
			$nom_adht = $_SESSION['ses_nom_adht']; //  pour écrture log		
						
		if ( $priorite_adht == 0 ) { // PAS autorisé à se loguer 
			//ecrit qui s'est connecté	
			$ecritlog = $masession->write_log('LoginInterdit',$nom_adht.' '.$prenom_adht);
			$texterreurlogin = _LANG_TEXTERREURLOGIN1;
			$alerte = 1; // Pour afficher message Contacter ...
			$tpl->assign('texterreurlogin0',$alerte);// si erreur login Pour afficher message Contacter 
		} else { //  Si Autorisation OK 
			$texterreurlogin = '';
			//ecrit qui s'est connecté
			$ecritlog =  $masession->write_log('Login', addslashes($nom_adht).' '.addslashes($prenom_adht)); 
			// On inscrit la date de dernier accés dans la base de données 
			$datedernier_acces = date('Y-m-d H:i:s'); 
			$req_ecrit_acces = ("UPDATE ".TABLE_ADHERENTS." SET dacces ='$datedernier_acces'"
			." WHERE id_adht='$sessionadherent'");
			$dbresult = $db->Execute($req_ecrit_acces);
			header('location: adherent/index.php'); // Si Auht OK on envoie vers la page  ...
		}	
		
	} else { // LOGIN ou MDP NON Valide
		$ecritlog = $masession->write_log('ErreurLogin',$mylogin); //ecrit qui s'est connecté	
		$texterreurlogin = _LANG_TEXTERREURLOGIN2;
		
	} /***** FIN vérification de l'autorisation */
	
} /***** FIN si on a validé le formulaire login */


/**** DECONNEXION si on se déconnecte ... */
if (isset($_REQUEST['logout'])) {
	//ecrit qui s'est déconnecté
	$priorite_adht == '';
	if(!empty($_SESSION['ses_nom_adht']) && !empty($_SESSION['ses_prenom_adht'])) {
		$ecritlog = $masession->write_log('Logout',addslashes($_SESSION['ses_nom_adht']).' '.addslashes($_SESSION['ses_prenom_adht'])); 	
		session_unset();
		session_destroy();
	} else {
		session_unset();
		session_destroy();
		$priorite_adht == '';	
	}
	header('location: index.php'); //  on rafraichi  la page
}
/***** FIN DECONNEXION si on se déconnecte .. */

		
/***** ---------------------------------------------------------------------- */	
// Préparation pour Affichage partie Fixe VERS TEMPLATE	 
$tpl->assign('version',VERSION); // Version de Gestasso
$tpl->assign('messagetitre',MESSAGETITRE); // Titre Bandeau haut
$tpl->assign('nom_asso_gestassophp',NOM_ASSO_GESTASSOPHP); // le Nom de l'association	

$tpl->assign('priorite_adht',$priorite_adht);
// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE
$tpl->assign('texterreurlogin',$texterreurlogin);// si erreur login Pour afficher message erreur
$tpl->assign('email_adresse',EMAIL_ADRESSE);// message Oubli mot de passe ...	

//POUR  AFFICHAGE VERS TEMPLATE	
$tpl->display('login.tpl');

?>
    
