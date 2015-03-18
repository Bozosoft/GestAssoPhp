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
 *   Affiche la liste des logs + Possibiliter de supprimer TOUS les logs
 *  Inspiré pour la partie tri de GALLETTE  v0.63 Copyright (c) 2003 Frédéric Jaqcuot 
*/

include_once '../config/connexion.php';
$masession = new sessions(); // -->la classe session //session_start();

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

	// Raz de variables
	$export_ok = '';
	//Tableau xpour affichage
	$logs = array();
	// initialisation
	
	/***** Si ADMINISTRATEUR donc $priorite_adht >4  DROIT DE CONSUTER ET MODIFIER       (4 , 5 , 7  n'a PAS le droit) */
	if ($priorite_adht < 8 ) {  // INTERDIT
		$id_adht = $sessionadherent;
		// Message erreur PAS LE DROIT
		header('location: ../adherent/gerer_fiche_adht.php'); 
	}

	// Optimise la tables

/***** VOIR POUR OPTIMISATION DES TABLES */	
	

	
	
/***** On efface tout les logs	*/
	if (isset($_GET['reset'])) {
		$req_del = "DELETE FROM ".TABLE_LOGS;
		$dbresult = $db->Execute($req_del);		
		$req_raz = "ALTER TABLE ".TABLE_LOGS." AUTO_INCREMENT =2"; //+
		$dbresult = $db->Execute($req_raz);	//+
		
		// on enregistre le mouvement en log
		$ecritlog = $masession->write_log('Efface les logs',addslashes($nom_adht).' '.addslashes($prenom_adht));
		header('location: ../admin/liste_logs.php'); 
	}
/***** FIN On efface tout les logs	*/	

/***** On EXPORTE tout les logs	*/
	// Voir fichier  admin/export_tlogs.php
/***** FIN On EXPORTE tout les logs	*/		


	// récupere la variable de la page pour afficher la suite
	$numpage_affiche= get_post_variable_numeric('numpage_affiche','1');// par défaut 1 page

	//On prépare l'affichage 
	$affiche_nb_lines = NB_LIGNES_PAGE;
	// si on a modifié le nb de ligne par page par selecteur Afficher par : 
	if (isset($_GET['affiche_nb_fich'])) {
		$affiche_nb_lines = get_post_variable_numeric('affiche_nb_fich',NB_LIGNES_PAGE);// par défaut  	
	}
	
	// requette principale
	$req_lire_logs = "SELECT id_log,date_log,ip_log,nom_log,action_log FROM ".TABLE_LOGS;
	$req_lire_logs .= " ORDER BY ";
	// requette pour comptage
	$reqcompt_logs = "SELECT id_log FROM ".TABLE_LOGS;

		
	// phase de tri par colonne  Date     	 Utilisateur    	 Action  
	if (isset($_GET['tri'])) { // récupere l le N° de la colosne de tri 
		if (is_numeric($_GET['tri'])) {
			if ($_SESSION['tri']==$_GET['tri']) {
				$_SESSION['tri_sens']=($_SESSION['tri_sens']+1)%2; // 0 ou 1
			} else {
				$_SESSION['tri']=$_GET['tri'];
				$_SESSION['tri_sens']=0;
			}
		}
	}

	if ($_SESSION['tri_sens'] == '1') {// sens du tri 0 par défaut modifié pour avoir la derniere date ... 1 + modif tpl
		$tri_sens_txt='ASC';
	} else {
		$tri_sens_txt='DESC';
	}

		
	// tri par colonne 0 id_log
	if ($_SESSION['tri'] == '0') {//($tri=='0') +++
		$req_lire_logs .= "id_log ".$tri_sens_txt.',';
	// tri par colonne date
	} elseif($_SESSION['tri'] == '1') {
		$req_lire_logs .= "date_log ".$tri_sens_txt.',';
	// tri par colonne 2 ip -->  //06/12
	} elseif($_SESSION['tri'] == '2') {	
		$req_lire_logs .= "ip_log ".$tri_sens_txt.',';
	// tri par colonne  Utilisateur = adhérent
	} elseif ($_SESSION['tri'] == '3') {
		$req_lire_logs .= "nom_log ".$tri_sens_txt.',';
	// tri par colonne action
	} elseif ($_SESSION['tri'] == '4') {
		$req_lire_logs .= "action_log ".$tri_sens_txt.',';
	}
	 
	$req_lire_logs .= "id_log ".$tri_sens_txt; // Tri  par colonne #

	// comptage des fiches
	$dbresult = $db->Execute($reqcompt_logs); //Pour compter le NB d'enregistrements
	$nb_lines= $dbresult->RecordCount() ; // le NB de ligne totales	

	if ($affiche_nb_lines == 0) {
		$nbpages = 1;
	} else if ($nb_lines % $affiche_nb_lines == 0) { // si modulo = reste donc prévoir 1 page de +
		$nbpages = intval($nb_lines/$affiche_nb_lines); // pas de reste donc page entière
	} else {
		$nbpages = intval($nb_lines/$affiche_nb_lines)+1; // reste <>0 donc page + 1
	}	
		
	if ($nbpages == 0) $nbpages = 1; // si 0 on prévoit 1 page ;-)
		
	$indice = 1+($numpage_affiche-1)*$affiche_nb_lines ; // le N° de ligne
	$nbpages=$nbpages+1;// pour affichage sur template Page  1 2 3... avec lien	

	$dbresult = $db->Execute($req_lire_logs);	

	// pour afficher le Nb de ligne par page
	if ($affiche_nb_lines == 0) {
		$dbresult = $db->Execute($req_lire_logs);	
	} else {
	// pour afficher le Nb de ligne par page	
		$dbresult = $db->SelectLimit($req_lire_logs,$affiche_nb_lines,  (($numpage_affiche-1)*$affiche_nb_lines) );	 
	}	
	
	// On prépare les données	
		while ($dbresult && $row = $dbresult->FetchRow()) {
		$logs[$indice]['id'] = $row['id_log'];			
		$logs[$indice]['date'] = switch_date_heure($row['date_log']);
		$logs[$indice]['adh'] = $row['nom_log'];
		$logs[$indice]['ip'] = $row['ip_log'];
		$logs[$indice]['action'] = stripslashes($row['action_log']);// pour eviter les \ dans les noms d'asso
		$logs[$indice]['coul'] = $indice % 2; // Pour afficher 1 ligne sur 2  classs= Lignegris0  / Lignegris1
		$indice++;	
	}

/***** ---------------------------------------------------------------------- */	
	// Préparation pour Affichage partie Fixe VERS TEMPLATE	 		
	$tpl->assign('version',VERSION); // Version de Gestasso
	$tpl->assign('nom_asso_gestassophp',NOM_ASSO_GESTASSOPHP); // le Nom de l'association				
	$tpl->assign('messagetitre',MESSAGETITRE); // Titre Bandeau haut
	$tpl->assign('priorite_adht',$priorite_adht);
	$tpl->assign('nomprenom_adht',$prenom_adht.' '.$nom_adht);	
	// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE
	$tpl->assign('logs',$logs);	// tableau $logs[$indice]['xxx']
	$tpl->assign('nb_lines',$nb_lines); // Nb de ligne de requete
	$tpl->assign('nb_pages',$nbpages); // le Nombre de pages totale
	$tpl->assign('numpage',$numpage_affiche); // le N° de la page courrante
	$tpl->assign('affiche_nb_fich',$affiche_nb_lines); // NB lignes par select
	$tpl->assign('affichenb_log_options',$T_AFFICHE_NB_PAGE); // Nb de lignes par page			
	//POUR  AFFICHAGE VERS TEMPLATE			
	$content = $tpl->fetch('admin/liste_logs.tpl'); // On affiche la liste des logs	
	$tpl->assign('content',$content);
	$tpl->display('page_index.tpl');
	

} else { /***** il y a une erreur ... Si erreur  on envoie vers la page de login ... avec message */		
	header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR);  
}
	
?>
    
