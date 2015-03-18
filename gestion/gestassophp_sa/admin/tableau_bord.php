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
 *   Affiche le tableau de bord Admin
*/

include_once '../config/connexion.php';
$masession = new sessions(); // -->la classe session //
// Raz  du tri	
$_SESSION['tri']=0; // par pour avoir colone 1 = Nom adherents sur liste // Par défaut =0
$_SESSION['tri_sens']=0; // pour avoir liste triée par 1--> 100 ou a-->z;	

$sessionadherent=(empty($_SESSION['ses_id_adht'])) ? $sessionadherent='' :$sessionadherent = $_SESSION['ses_id_adht'];
	//echo 'super ICI tab bord = '.$log .'<br/>';
	
	// on récupère le login et le password correspondant au numéro de session en cours	
$logpass=$masession->verifie_LogingPaswd_bd($sessionadherent);
$log = $logpass[0];
$pas = $logpass[1];
	//echo 'LOG = '.$log .'<br/>';
		//echo 'PASS = '.$pas .'<br/>';
		
// vérification de l'authenticité du visiteur		
if (($sessionadherent) && $log == ($_SESSION['ses_login_adht']) && $pas == ($_SESSION['ses_paswd_adht'])) {
/***** ici commence le code en cas d'authentification */

	$priorite_adht = $_SESSION['ses_priorite_adht'];
	$prenom_adht = $_SESSION['ses_prenom_adht']; //  pour affichage
	$nom_adht = $_SESSION['ses_nom_adht'] ; //  pour affichage

/***** Si ADMINISTRATEUR donc $priorite_adht  > ou = 4  DROIT DE CONSUTER ET MODIFIER   (4 a le droit)  */
	if ($priorite_adht < 4 ) {
		$id_adht = $sessionadherent;
		// Message erreur PAS LE DROIT
		header('location: ../adherent/gerer_fiche_adht.php'); 
	}	
	
	// Raz de variables
	$nb_adherent_asso = '' ;
	$nb_adherent_soc_asso = '' ;
	// la date du jour	
	$date_du_jour=date('Y-m-d');//Pour définir la différence entre 2  dates
//echo 'date_du_jour=date = '.$date_du_jour .'<br/>';
		
	/***** ADHERENTS *****/	
	// on met à jour pour les cotisations  avec Soc_Adh= "s"  en vérifiant la date du jour / datefin_cotisation
	$req_cherche_soc=("UPDATE ".TABLE_ADHERENTS." SET soc_adht='' WHERE soc_adht='s'"); 	
	$dbresult = $db->Execute($req_cherche_soc);	
	// 2- chercher toutes les fiches actives  dans TABLE_COTISATIONS en groupant par id_adhtasso
	$req_verif_cotis_adht = "SELECT id_adhtasso, date_fin_cotis FROM "
	.TABLE_COTISATIONS." WHERE qui_cotis ='adh' AND cotis <>'999'AND date_fin_cotis >= '".$date_du_jour."' GROUP BY id_adhtasso,date_fin_cotis";
//echo $req_verif_cotis_adht;
	$dbresult = $db->Execute($req_verif_cotis_adht);
	//3-  a affecter  les cotisations  avec Soc_Adh= "s"  +  datefin_cotisation	
		while ($dbresult && $row = $dbresult->FetchRow()) {
			$id_adht = $row['id_adhtasso'];
			$datefin_cotisation = $row['date_fin_cotis'];		
			$soc_adht = 's';
			$req_modif_adht=("UPDATE ".TABLE_ADHERENTS
			." SET soc_adht='$soc_adht', date_echeance_cotis='$datefin_cotisation' WHERE id_adht='$id_adht'"); 	
			$dbresultb = $db->Execute($req_modif_adht); 	
		}
		
	
	// NB total d'adhérents  //renvoie le nombre Total de lignes de la base 
	$reqcompt_adht = "SELECT id_adht FROM ".TABLE_ADHERENTS ;
	$dbresult = $db->Execute($reqcompt_adht);
	 $nb_adherent = $dbresult->RecordCount() ;
	 
	// NB total d'ahérents Qui ont Cotisé //renvoie le nombre Total de lignes de la base SI Sociétaire
	$reqcompt_adht_soc = "SELECT id_adht FROM ".TABLE_ADHERENTS." WHERE soc_adht ='s'";
	$dbresult = $db->Execute($reqcompt_adht_soc);
	$nb_adherent_soc = $dbresult->RecordCount() ;

	 // Montant total des cotisations TOTALE  d'adhérents
	$montant_cotisation_adh = 0;
	$req_verif_montant_adht = "SELECT montant_cotis FROM ".TABLE_COTISATIONS
	." WHERE qui_cotis='adh' "; //AND cotis =''";
	$dbresult = $db->Execute($req_verif_montant_adht);
	
	while ($dbresult && $row = $dbresult->FetchRow()) {
		$montant_cotisation_adh = $montant_cotisation_adh  + ($row['montant_cotis']); 
	}		
	// Montant total des cotisations d'adhérents à jour de la cotisation  // modif 12/08/2008
	$montant_cotisation_adh_encours = 0;
	$req_verif_montant_adht_encours = "SELECT montant_cotis FROM ".TABLE_COTISATIONS
	." WHERE qui_cotis='adh' AND cotis ='' AND date_fin_cotis > '$date_du_jour' ";
	$dbresult = $db->Execute($req_verif_montant_adht_encours);
	
	while ($dbresult && $row = $dbresult->FetchRow()) {
		$montant_cotisation_adh_encours = $montant_cotisation_adh_encours  + ($row['montant_cotis']); 
	}		
	
	/***** FIN ADHERENTS *****/
	
/************** OPTIONS  ***********/			
		
/*************  Fin  OPTIONS  ***********/	
	
			
		
/***** ---------------------------------------------------------------------- */	
	// Préparation pour Affichage partie Fixe VERS TEMPLATE	  		
	$tpl->assign('version',VERSION); // Version de Gestasso
	$tpl->assign('nom_asso_gestassophp',NOM_ASSO_GESTASSOPHP); // le Nom de l'association				
	$tpl->assign('messagetitre',MESSAGETITRE); // Titre Bandeau haut
	$tpl->assign('priorite_adht',$priorite_adht);
	$tpl->assign('nomprenom_adht',$prenom_adht.' '.$nom_adht);
	// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE
	$tpl->assign('date_debannee_asso',DATE_DEBANNEE_ASSO); // Date de début de l'assocation  -->tableaubord  //++	
	$tpl->assign('nb_adherent',$nb_adherent);
	$tpl->assign('nb_adherent_soc',$nb_adherent_soc);
	$tpl->assign('montant_cotisation_adh',$montant_cotisation_adh); 	
	$tpl->assign('montant_cotisation_adh_encours',$montant_cotisation_adh_encours); // modif 12/08/2008
	//POUR  AFFICHAGE VERS TEMPLATE			
	$content = $tpl->fetch('admin/tableaubord.tpl'); // On affiche la fiche Tableau de bord
	$tpl->assign('content',$content);
	$tpl->display('page_index.tpl');
		
} else { /***** il y a une erreur ... Si erreur  on envoie vers la page de login ... avec message */		
	header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR); 
}
	
?>
    
