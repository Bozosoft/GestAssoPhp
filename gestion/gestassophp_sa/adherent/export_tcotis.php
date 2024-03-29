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
 * @version :  2022
 * @copyright 2007-2022  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */

/**
 *  Directory :  /ROOT_DIR_GESTASSO/adherent/
 *  Fichier :	export_tcotis.php
 *  Export au format texte (extension XLS   -> pour Excel) de la table cotisation adhérent bénévole
 *  Modification PHP 8.2.x mb_convert_encoding($string, 'ISO-8859-1', 'UTF-8');  REMPLACE  utf8_decode($string);  CAUSE Function utf8_decode() is deprecated en PHP 8.2  // MODIFICATION DU 27/11/22
*/

include_once '../config/connexion.php';
$masession = new sessions(); // -->la classe session 	//session_start();

// Raz de variables

// Si pas de session ...
$sessionadherent = (empty($_SESSION['ses_id_adht'])) ? $sessionadherent = '' : $sessionadherent = $_SESSION['ses_id_adht'];

// récupération du login et du password correspondant au numéro de session en cours
$logpass = $masession->verifie_LogingPaswd_bd($sessionadherent);
$log = $logpass[0];
$pas = $logpass[1];

// vérification de l'authenticité du visiteur
if (($sessionadherent) && $log == ($_SESSION['ses_login_adht']) && $pas == ($_SESSION['ses_paswd_adht'])) {
/***** ici commence le code en cas d'authentification */

	$priorite_adht = $_SESSION['ses_priorite_adht'];
	$prenom_adht = $_SESSION['ses_prenom_adht']; // pour affichage
	$nom_adht = $_SESSION['ses_nom_adht'] ; // pour affichage

// entête du fichier téléchargé
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=cotis_adherents.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    $now_date = date('d-m-Y H:i');
    $title = _LANG_EXTRAIT_TABLE.TABLE_COTISATIONS." - ".$now_date;

    echo("$title\n"); // affiche la ligne de titre

	//id_cotis	qui_cotis	id_adhtasso	id_type_cotis	montant_cotis	info_cotis	date_enregist_cotis	date_debut_cotis	date_fin_cotis	cotis	info_archiv_cotis	datemodiffiche_cotis

	$req_lire_table_cotis = "SELECT id_cotis,id_adhtasso,id_type_cotis,"
	." montant_cotis,info_cotis,date_enregist_cotis,date_debut_cotis,date_fin_cotis,cotis,"
	."paiement_cotis,"  // Ajout Zone PAIEMENT
	." info_archiv_cotis,datemodiffiche_cotis,"
	." prenom_adht,nom_adht," // TABLE_ADHERENTS
	." nom_type_cotisation" // TABLE_TYPE_COTISATIONS
	." FROM ".TABLE_COTISATIONS.", ".TABLE_ADHERENTS.", ".TABLE_TYPE_COTISATIONS
	." WHERE qui_cotis ='adh' AND ".TABLE_COTISATIONS.".id_adhtasso=".TABLE_ADHERENTS.".id_adht "
	." AND ".TABLE_TYPE_COTISATIONS.".id_type_cotisation=".TABLE_COTISATIONS."
	.id_type_cotis ORDER BY id_cotis";

    print("Num\t Nom Prenom\t type\t montant\t information\t date_enregist\t date_debut\t date_fin\t archive\t paiement\t info_archiv\t date_modif_fiche\n");

	$dbresult = $db->Execute($req_lire_table_cotis);
	while ($dbresult && $row = $dbresult->FetchRow()) {
		$champ0 = $row['id_cotis'];
		// $champ1 = $row['id_adhtasso'];	
		$champ2 = html_entity_decode( mb_convert_encoding($row['nom_adht'], 'ISO-8859-1', 'UTF-8')." ".mb_convert_encoding($row['prenom_adht'], 'ISO-8859-1', 'UTF-8') , ENT_QUOTES ); // Nom Prenom // mb_convert_encoding
		$champ3 = mb_convert_encoding($row['nom_type_cotisation'], 'ISO-8859-1', 'UTF-8'); // type // mb_convert_encoding
		$champ4 = $row['montant_cotis']; //
		$champ5	= html_entity_decode(mb_convert_encoding($row['info_cotis'], 'ISO-8859-1', 'UTF-8'),ENT_QUOTES); // information // mb_convert_encoding
		$champ6 = switch_sqlFr_date($row['date_enregist_cotis']);
		$champ7 = switch_sqlFr_date($row['date_debut_cotis']);
		$champ8 = switch_sqlFr_date($row['date_fin_cotis']);
		$champ9 = $row['cotis']; // cotis 999 ou vide
		if ($champ9 == '999') {
			$champ9 = 'Archive'; // Affichage du statut Archivée
		}
		$champ10 = $row['paiement_cotis']; // + Ajout Zone PAIEMENT
		$champ11 = mb_convert_encoding($row['info_archiv_cotis'], 'ISO-8859-1', 'UTF-8'); 	// info_archiv // mb_convert_encoding
		$champ12 = switch_sqlFr_date($row['datemodiffiche_cotis']);
		if ($champ12 == '00/00/0000'){
			$champ12 = '';
		}

		// écriture de la ligne
		print ("$champ0\t $champ2\t $champ3\t $champ4\t $champ5\t $champ6\t $champ7\t"
		." $champ8\t $champ9\t $champ10\t  $champ11\t $champ12 \n");

	}


} else {
	/***** Si erreur Retour vers la page de login ... avec message */
	header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR);
}
