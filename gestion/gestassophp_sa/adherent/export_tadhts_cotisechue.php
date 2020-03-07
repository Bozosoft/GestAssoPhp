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
 * @version :  2020
 * @copyright 2007-2020  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */
 
/**
 *  Directory :  /ROOT_DIR_GESTASSO/adherent/
 *   Fichier :
 *   Export au format texte XLS de la table adherent
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

// entête du fichier téléchargé	
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=adherents_cotisechues.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
     

    $now_date = date('d-m-Y H:i');
	// titre de la première ligne du fichier
    $title = _LANG_EXTRAIT_TABLE.TABLE_ADHERENTS." - ".$now_date;	
    echo("$title\n");  // affiche la ligne de titre

// requête	
	$date_du_jour=date("Y-m-d"); // Pour définir la date du jour pour controler la date date_echeance_cotis 
	$req_lire_table_adht = "SELECT id_adht,soc_adht,civilite_adht,prenom_adht,nom_adht, adresse_adht, cp_adht, ville_adht,"
	." telephonef_adht, telephonep_adht, telecopie_adht, email_adht, promotion_adht, datecreationfiche_adht,"
	." antenne_adht, date_echeance_cotis,"
	." qui_enrg_adht,disponib_adht,nom_type_antenne" //+ antenne
	." FROM  ".TABLE_ADHERENTS.", ".TABLE_ANTENNE." WHERE antenne_adht=id_type_antenne "
	." AND soc_adht <>'999'"  // si suppression ou archivage fiche soc_adht=999
	." AND date_echeance_cotis <= '".$date_du_jour."'";	// test sur la date du jour


	
// 1ere ligne
print utf8_decode("Num\t Societaire\t "._LANG_FICHE_ADHT_CIVIL."\t "._LANG_FICHE_ADHT_PRENOM."\t "._LANG_TPL_COL_ADHT_NOM."\t "._LANG_FICHE_ADHT_ADRESS."\t "._LANG_FICHE_ADHT_CP."\t "._LANG_TPL_COL_ADHT_VILLE."\t "._LANG_TPL_COL_ADHT_TELEPH."\t "._LANG_TPL_COL_ADHT_PORTABLE."\t "._LANG_FICHE_ADHT_FAX."\t "._LANG_FICHE_ADHT_MAIL."\t DateCreationFiche\t "._LANG_FICHE_ADHT_ANT."\t "._LANG_FICHE_COTIS_ADHT_DATE_FIN."\n");

// Boucle préparation écriture de la ligne	
	$dbresult = $db->Execute($req_lire_table_adht);

	while ($dbresult && $row = $dbresult->FetchRow()) {
		$champ0 = $row['id_adht'];
		$champ1 = $row['soc_adht'];
		$champ2 = $row['civilite_adht'];
		$champ3 = utf8_decode($row['prenom_adht']);
		$champ4 = $row['nom_adht'];
		$champ5 = html_entity_decode(utf8_decode($row['adresse_adht']),ENT_QUOTES);
		$champ6 = $row['cp_adht'];
		$champ7 = $row['ville_adht'];
		$champ7 = html_entity_decode(utf8_decode($champ7),ENT_QUOTES); // Convertira les guillemets et les apostrophes + utf8_decode accents
		$champ8 = $row['telephonef_adht'];
		$champ9 = $row['telephonep_adht'];
		$champ10 = $row['telecopie_adht'];
		$champ11 = $row['email_adht'];
		$champ13 = switch_sqlFr_date($row['datecreationfiche_adht']);	
		$champ14 = $row['nom_type_antenne']; // + antenne
		$champ14 = utf8_decode(($champ14)); // Convertira les guillemets et les apostrophes
	
		$champ20 = switch_sqlFr_date($row['date_echeance_cotis']);
			if ($champ20 == '00/00/0000'){
				$champ20 = html_entity_decode(utf8_decode("NON règlée"),ENT_QUOTES); //"NON règlée";
			}	
			 		
		// écriture de la ligne
		//Num	 Societaire	 Civilité	 Prénom	 Nom	 Adresse	 Code Postal	 Ville	 Téléphone	 Tel Portable	 Tel Professionnel	 Email	 DateCreationFiche	 Section	 Date fin cotisation
        print ("$champ0\t $champ1\t $champ2\t $champ3\t $champ4\t $champ5\t $champ6\t $champ7\t $champ8\t $champ9\t $champ10\t $champ11\t  $champ13\t $champ14\t $champ20 \n");
	}
	
	
} else { /***** il y a une erreur ... Si erreur  on envoie vers la page de login ... avec message */		
	header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR);  
}
	
	
?>
    
