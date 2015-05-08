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
 * @version :  2015
 * @copyright 2007-2015  (c) JC Etiemble
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

// entete du fichier téléchargé	
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=adherents.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
     

    $now_date = date('d-m-Y H:i');
	// titre de la première ligne du fichier
    $title = _LANG_EXTRAIT_TABLE.TABLE_ADHERENTS." - ".$now_date;	
    echo("$title\n");  // affiche la ligne de titre

// requete	
	$req_lire_table_adht = "SELECT id_adht,soc_adht,civilite_adht,prenom_adht,nom_adht, adresse_adht, cp_adht, ville_adht,"
	." telephonef_adht, telephonep_adht, telecopie_adht, email_adht, promotion_adht, datecreationfiche_adht,"
	." antenne_adht, datenaisance_adht, visibl_adht, datemodiffiche_adht, siteweb_adht,"
	." priorite_adht,date_echeance_cotis,date_sortie,tranche_age,"
	." profession_adht, autres_info_adht," // ajout V 7
	." qui_enrg_adht,disponib_adht,nom_type_antenne" //+ antenne
	." FROM  ".TABLE_ADHERENTS.", ".TABLE_ANTENNE." WHERE antenne_adht=id_type_antenne ";
	
// 1ere ligne
print utf8_decode("Num\t Societaire\t "._LANG_FICHE_ADHT_CIVIL."\t "._LANG_FICHE_ADHT_PRENOM."\t "._LANG_TPL_COL_ADHT_NOM."\t "._LANG_FICHE_ADHT_ADRESS."\t "._LANG_FICHE_ADHT_CP."\t "._LANG_TPL_COL_ADHT_VILLE."\t "._LANG_TPL_COL_ADHT_TELEPH."\t "._LANG_TPL_COL_ADHT_PORTABLE."\t "._LANG_FICHE_ADHT_FAX."\t "._LANG_FICHE_ADHT_MAIL."\t DateCreationFiche\t "._LANG_FICHE_ADHT_ANT."\t "._LANG_TPL_ADHT_DATENAIS."\t visible\t "._LANG_VISU_FICHE_ADHT_LASTMOD."\t  "._LANG_FICHE_ADHT_WEB."\t "._LANG_ADMIN_PRIORITE_COL_PRIORITE."\t "._LANG_FICHE_COTIS_ADHT_DATE_FIN."\t Date_Sortie\t "._LANG_FICHE_ADHT_TAGE."\t "._LANG_FICHE_ADHT_PROMOTION."\t "._LANG_FICHE_ADHT_FICHE_ENR."\t "._LANG_FICHE_ADHT_PROFESSION."\t "._LANG_FICHE_ADHT_AUTRES_INFO."\t "._LANG_FICHE_ADHT_COMPL."\n");

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
		
		$champ15 = switch_sqlFr_date($row['datenaisance_adht']);
			if ($champ15 == '00/00/0000'){
				$champ15='';
			}	
		$champ16 = $row['visibl_adht'];
		$champ17 = switch_sqlFr_date($row['datemodiffiche_adht']);
			if ($champ17 == '00/00/0000'){
				$champ17='';
			}	
		$champ18 = utf8_decode($row['siteweb_adht']); //modif pour éviter les   RÃ©fÃ©rent, recrutement
		$champ19 = $row['priorite_adht'];
		$champ20 = switch_sqlFr_date($row['date_echeance_cotis']);
			if ($champ20 == '00/00/0000'){
				$champ20='';
			}	
		$champ21 = switch_sqlFr_date($row['date_sortie']);			
			if ($champ21 == '00/00/0000'){
				$champ21='';
			}
		$champ22 = $row['tranche_age'];

		$champ23 = $row['promotion_adht']; //N° adhésion 
		$champ23 = utf8_decode(($champ23)); // Convertira les guillemets et les apostrophes
		/*		
		$champ24 = $row['situation_socialv;
		$champ25 = $row['profession'];
		$champ26 = $row['etudes'];
		$champ27 = $row['vehicule'];
		$champ28 = $row['permis'];
		$champ29 = $row['deja_benevol'];
		$champ30 = $row['maitrise_infor'];
		$champ31 = $row['connu_asso'];
		*/
		$champ32 = $row['qui_enrg_adht'];
			if ($champ32 == '0'){
				$champ32='x';
			} else {
		//  qui a enregistré la fiche
		$req_lire_nom_enregistrant = "SELECT prenom_adht,nom_adht"
		." From ".TABLE_ADHERENTS." WHERE id_adht='$champ32'";	
		$dbresult_nom = $db->Execute($req_lire_nom_enregistrant);			
		$champ32 = utf8_decode($dbresult_nom->fields['nom_adht']." ".$dbresult_nom->fields['prenom_adht']); 		
		// fin   qui a enregistré		
			}
		//$champ33 = $row['cotis_adht'];
		$champ34 =$row['disponib_adht'];
		if ($champ34 != ''){
			$champ34 = substr($row['disponib_adht'],0,510)."...";
			$champ34 = html_entity_decode(utf8_decode($champ34),ENT_QUOTES);
		}
		$champ35 = html_entity_decode(utf8_decode($row['profession_adht']),ENT_QUOTES); // ajout V 7
		$champ36 = html_entity_decode(utf8_decode($row['autres_info_adht']),ENT_QUOTES); // ajout V 7
		
		//ecriture de la ligne
        print ("$champ0\t $champ1\t $champ2\t $champ3\t $champ4\t $champ5\t $champ6\t $champ7\t $champ8\t $champ9\t $champ10\t $champ11\t  $champ13\t $champ14\t $champ15\t $champ16\t $champ17\t $champ18\t $champ19\t  $champ20\t $champ21\t $champ22\t $champ23\t $champ32\t $champ35\t $champ36\t $champ34\n");
		
	}
	
	
} else { /***** il y a une erreur ... Si erreur  on envoie vers la page de login ... avec message */		
	header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR);  
}
	
	
?>
    
