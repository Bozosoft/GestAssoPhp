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
 *  Directory :  /ROOT_DIR_GESTASSO/adherent/
 *   Fichier :
 *   affichage pour Consulter/Imprimer/copier une cotisation de l'adhérent
*/

include_once '../config/connexion.php';
$masession = new sessions(); // -->la classe session 	//session_start();
	
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
	$affiche_message =''; // Raz message	
	//Tableau xpour affichage
	$cotis_adh=array(); // Tableau $cotis_adht[champ de la table]  passage des data vers TPL
	// initialisation	
	$date_du_jour=date('Y-m-d');// la date du jour // aaa-mm-jj -->2007-08-08

	

//echo $priorite_adht;
	/***** Si ADMINISTRATEUR donc $priorite_adht >4  DROIT DE CONSUTER ET MODIFIER     (4 n'a PAS le droit)	*/
	if ($priorite_adht > 5 ) { // AUTORISATION
		$id_cotis_adht = get_post_variable_numeric('id_cotis', '');// l'id de la cotisation existante		
		$affiche_message =' N&deg; '.$id_cotis_adht;	
		$req_lire_info_cotis = "SELECT id_cotis,qui_cotis,id_adhtasso,"
		."id_type_cotis,montant_cotis,info_cotis,date_enregist_cotis,"
		."paiement_cotis,"  //+ Ajout Zone PAIEMENT
		."date_debut_cotis,date_fin_cotis,info_archiv_cotis,datemodiffiche_cotis,"
		." id_type_cotisation,nom_type_cotisation" // TABLE_TYPE_COTISATIONS
		." FROM ".TABLE_COTISATIONS.", ".TABLE_TYPE_COTISATIONS 
		." WHERE id_cotis='$id_cotis_adht' "			
		." AND ".TABLE_TYPE_COTISATIONS.".id_type_cotisation=".TABLE_COTISATIONS.".id_type_cotis";	
		$dbresult = $db->Execute($req_lire_info_cotis);
		$cotis_adh = $dbresult->FetchRow();
			
		// le nom de la  cotisation  = $cotis_adh[nom_type_cotisation]			
		$cotis_adh['date_enregist_cotis'] = switch_sqlFr_date($cotis_adh['date_enregist_cotis']);
		$cotis_adh['date_debut_cotis'] = switch_sqlFr_date($cotis_adh['date_debut_cotis']);
		$cotis_adh['date_fin_cotis'] = switch_sqlFr_date($cotis_adh['date_fin_cotis']);	
		$cotis_adh['paiement_cotis'] = $T_PAIEMENT_COTIS[$cotis_adh['paiement_cotis']];	//+ Ajout Zone PAIEMENT		
			
		// les données perso
		$req_lire_perso_adht = "SELECT civilite_adht, nom_adht, prenom_adht, adresse_adht,"
		." cp_adht, ville_adht FROM  ".TABLE_ADHERENTS." WHERE "
		." id_adht='$cotis_adh[id_adhtasso]'";
		$dbresult_adht = $db->Execute($req_lire_perso_adht);		
		$cotis_adh['np_adht'] = $dbresult_adht->fields['civilite_adht']
		.' '.$dbresult_adht->fields['prenom_adht'].' '.$dbresult_adht->fields['nom_adht'];		
		$cotis_adh['adr_adht'] = $dbresult_adht->fields['adresse_adht'] ;
		$cotis_adh['cpv_adht'] = $dbresult_adht->fields['cp_adht'].' '.$dbresult_adht->fields['ville_adht'];

		$tpl->assign('data_cotis_adh',$cotis_adh);	

	}else { // Pas d'AUTORISATION
		$id_adht = $sessionadherent; // Cas erreur
		// Message erreur PAS LE DROIT
		header('location: ../adherent/gerer_fiche_adht.php'); 
	} 
				
		
		
/***** ---------------------------------------------------------------------- */		
	// Préparation pour Affichage partie Fixe VERS TEMPLATE	 	
	$tpl->assign('version',VERSION); // Version de Gestasso
	$tpl->assign('nom_asso_gestassophp',NOM_ASSO_GESTASSOPHP); // le Nom de l'association				
	$tpl->assign('messagetitre',MESSAGETITRE); // Titre Bandeau haut
	$tpl->assign('priorite_adht',$priorite_adht);
	$tpl->assign('nomprenom_adht',$prenom_adht.' '.$nom_adht);
	// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE		
	$tpl->assign('date_dujour',switch_sqlFr_date($date_du_jour));// date du jour pour  Date d'inscription 
	$tpl->assign('affiche_message',$affiche_message); // pour afficher
	//POUR  AFFICHAGE VERS TEMPLATE			
	$content = $tpl->fetch('adherent/consulter_cotisations_adht.tpl'); // On affiche ...	
	$tpl->assign('content',$content);		
	$tpl->display('page_index.tpl');	

/***** il y a une erreur ... Si erreur  on envoie vers la page de login ... avec message */	
	} else {
		header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR);  
	}
	

?>
    