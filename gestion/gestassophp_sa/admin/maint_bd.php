<?php
/**
 * Projet : gestassophp_sa [GestAssoPhp+Pg]
 * ---------------------------
 * Licence Creative Commons selon les termes du présent contrat appelé Contrat Public Creative Commons
 * Auteur original : Jean-Claude Etiemble
 * @link :  http://creativecommons.org/licenses/by-sa/2.0/fr/  - Paternité - Partage à l'Identique 2.0 France (CC BY-SA 2.0)
 * ---------------------------
 *
 * @author :  JC Etiemble - http://jc.etiemble.free.fr
 * @version : 2022
 * @copyright 2007-2022  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */

/**
 *  Directory :  /ROOT_DIR_GESTASSO/admin/
 *  Fichier :	maint_bd.php
 *  Affiche les possibilités de sauvegarde de la base de Données
*/

include_once '../config/connexion.php';
$masession = new sessions(); // -->la classe session //session_start();
// Raz  du tri
$_SESSION['tri'] = 1; // par pour avoir colone 1 = Noms adhérents sur liste // Par défaut = 0
$_SESSION['tri_sens'] = 0; // pour avoir liste triée par 1--> 100 ou a-->z;

// Si pas de session ...
$sessionadherent = (empty($_SESSION['ses_id_adht'])) ? $sessionadherent = '' : $sessionadherent = $_SESSION['ses_id_adht'];

// récupération du login et le password correspondant au numéro de session en cours
$logpass = $masession->verifie_LogingPaswd_bd($sessionadherent);
$log = $logpass[0];
$pas = $logpass[1];

// vérification de l'authenticité du visiteur
if (($sessionadherent) && $log == ($_SESSION['ses_login_adht']) && $pas == ($_SESSION['ses_paswd_adht'])) {
/***** ici commence le code en cas d'authentification */

	$priorite_adht = $_SESSION['ses_priorite_adht'];
	$prenom_adht = $_SESSION['ses_prenom_adht']; // pour affichage
	$nom_adht = $_SESSION['ses_nom_adht'] ; // pour affichage

	/***** Si ADMINISTRATEUR donc $priorite_adht  > ou = 4  DROIT DE CONSUTER ET MODIFIER   (4 a le droit) */
	if ($priorite_adht < 8 ) {  // INTERDIT
		$id_adht = $sessionadherent;
		// Message erreur PAS LE DROIT
		header('location: ../adherent/gerer_fiche_adht.php');
	}

	// Raz de variables
	$sav_struct_bd = '';
	$sav_data_bd = '';
	// la date du jour
	$date_du_jour=date('Y-m-d'); // Pour définir la différence entre 2 dates


/***** VOIR POUR OPTIMISATION DES TABLES */
	 // opt_bd = Ok
	if (isset($_REQUEST["opt_bd"])) {
		$opt_bd_ok = get_post_variablehtml('opt_bd', '0'); // par défaut Ok
		if ($opt_bd_ok == 'Ok') {

// si postgresql OPTIMIZE  http://docs.postgresqlfr.org/8.2/sql-vacuum.html
			if ( TYPE_BD_AODB == 'postgres' ) {
				//Donne la liste des tables
				$sql_tables_pg =
				'SELECT table_name '.
				'FROM information_schema.tables '.
				"WHERE table_schema = 'public' ";
				$dbresult_tables_pg = $db->Execute($sql_tables_pg);
				while (($row = $dbresult_tables_pg->FetchRow())) {
					$dbresult_vacum_pg = $db->Execute('VACUUM FULL '.($row[0]));
					$tpl->assign('optimisation', '<span class="TextevertGras">'._LANG_MESSAGE_TABLES_OPT.'</span>');
	//				echo $mes_tables_pg .'<br>';
				}
				$dbresult_tables_pg->Close() ; // ferme les connexions
			} //FIN si postgres OPTIMIZE

// si  MySql OPTIMIZE
			if ( TYPE_BD_AODB == 'mysql' ||  TYPE_BD_AODB == 'mysqli') {   // 'mysql'  cette extension est obsolète depuis PHP 5.5.0 
				// préparation de la requête
				$sql = "OPTIMIZE TABLE";  //////////////////////
				//on recherche toutes les données des tables
				$dbresult = $db->Execute('SHOW TABLE STATUS');
				while (($row = $dbresult->FetchRow())) {
					// on regarde seulement les tables qui affichent des pertes   http://dev.mysql.com/doc/refman/5.0/fr/show-table-status.html
					if($row['Data_free'] > 0) {
							// et on l'inclut si elle comporte des pertes
							$sql .= '`'.$row['Name'].'`, ';
							// liste des tables avec pertes
	//						echo 'Table : <strong>'. $row['Name'].'</strong> Pertes : <strong>'.$row['Data_free']."</strong><br>\n\n";
					}
				}
				// on enlève le ', ' de trop
				$sql = substr($sql, 0, (strlen($sql)-2));
				// et on optimise
				$dbresult1 = $db->Execute($sql);
				$tpl->assign('optimisation', '<span class="TextevertGras">'._LANG_MESSAGE_TABLES_OPT.'</span>');

			}

		} else { // FIN si MySql OPTIMIZE
		header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR);
		}

	}


/***** ON SAUVEGARDE  les données  .... */
		// form action="export_bd.php"


/***** ------------------------------------------------------------ */
	// Préparation pour Affichage partie Fixe VERS TEMPLATE
	$tpl->assign('version', VERSION); // Version de Gestasso
	$tpl->assign('nom_asso_gestassophp', NOM_ASSO_GESTASSOPHP); // le Nom de l'association
	$tpl->assign('messagetitre', MESSAGETITRE); // Titre Bandeau haut
	$tpl->assign('priorite_adht', $priorite_adht);
	$tpl->assign('nomprenom_adht', $prenom_adht.' '.$nom_adht);
	$tpl->assign('list_structbd_on', $T_OUI_NON);
	$tpl->assign('list_structbd_o', 'Oui'); // Un seul choix posible Oui
	$tpl->assign('sav_struct_bd', $sav_struct_bd);
	$tpl->assign('sav_data_bd', $sav_data_bd);
	$tpl->assign('typebdmysql', TYPE_BD_AODB); // Pour afficher ou non l'export BD ( sauvegarde de la base de données) réservé à mysqli uniquement  // 'mysql' = extension est obsolète depuis PHP 5.5.0 
	// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE
	// On n'affiche rien juste le download du fichier .....

	// POUR  AFFICHAGE VERS TEMPLATE
	$content = $tpl->fetch('admin/maint_bd.tpl'); // affichage de la liste des logs
	$tpl->assign('content', $content);
	$tpl->display('page_index.tpl');


} else {
	/***** Si erreur Retour vers la page de login ... avec message */
	header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR);
}
