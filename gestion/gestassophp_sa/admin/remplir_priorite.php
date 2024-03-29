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
 *  Directory :  /ROOT_DIR_GESTASSO/admin/
 *  Fichier :	remplir_priorite.php
 *  Définir les priorité des adhérents en fonction de
 *   0 = accés interdit,
 *   1 = Par défaut (créé lors de l'inscription) seul accés -> Votre Fiche et Annuaire
 *   4 = Membre du CA (idem 1 + Administration : Tableau bord)
 *   5 = Secrétaire (idem 1 + Administration : Tableau bord Adhérents Associations Besoins Asso Missions )
 *   7 = Trésorier (idem 5 + Cotis Adhts + Réactivation : adhérents, Assocations, Missions et Voir les Archives des Cotisations)
 *   9 = Admin Tous les droits
*/

include_once '../config/connexion.php';
$masession = new sessions(); // -->la classe session 	//session_start();

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

	/***** Si ADMINISTRATEUR donc $priorite_adht = 9  Tous les droits */
	if ($priorite_adht < 8 ) {  // INTERDIT
		$id_adht = $sessionadherent;
		// Renvoi vers Visualisation et Gestion des informations Adhérent
		header('location: ../adherent/gerer_fiche_adht.php');
	}

	// Raz de variables
	$message = '';
	$id_adht = '';
	$tpl->assign('message', $message);
	//Tableaux pour affichage
	$priorite = array(); // tableau


	/***** Récupération de id_adht_priorite du formulaire par le bouton Valider */
	$id_adht_priorite = get_post_variable_numeric('id_adht_priorite', '');

	/***** Si validation du Formulaire */
	if (isset($_POST['valid']) && ( !$id_adht_priorite)) {
		$message = '<span class="erreur-Jaunerouge">&nbsp;&nbsp;&nbsp;'._LANG_MESSAGE_SELECTIONNEZ_NOM.'&nbsp;&nbsp;&nbsp;</span>';
		$tpl->assign('message', $message);
	}
	if (isset($_POST['valid']) && ($id_adht_priorite)) {
		/***** Récupération de code_priorite du formulaire [0-4,5,7,9] */
		$code_priorite = get_post_variable_numeric('code_priorite', '');
		$req_modif_priorite = ("UPDATE ".TABLE_ADHERENTS." SET priorite_adht='$code_priorite'"
		." WHERE id_adht= '$id_adht_priorite'");
		$dbresult = $db->Execute($req_modif_priorite);
		// on repasse les données pour affichage
		$message = '<span class="erreur-Jaunerouge">&nbsp;&nbsp;&nbsp;'._LANG_MESSAGE_PRIORITE_OK.'&nbsp;&nbsp;&nbsp;</span>';
		$tpl->assign('id_adht_priorite', $id_adht_priorite);
		$tpl->assign('code_priorite', $code_priorite);
		$tpl->assign('message', $message);
		// écrit qui a fait la manip
		$ecritlog = $masession->write_log('Priorité_Adht : '.$id_adht_priorite.' Priorité->'
		.$code_priorite, addslashes($nom_adht).' '.addslashes($prenom_adht));

	} /***** FIN Si validation du Formulaire par le bouton Valider */


/***** Pour affichage de la liste  Nom Prénom */
	$req_list_benevol = "SELECT id_adht,nom_adht,prenom_adht FROM "
	.TABLE_ADHERENTS."  WHERE soc_adht <>'999' ORDER BY  nom_adht asc ";
	$dbresult = $db->Execute($req_list_benevol);
    $tab_benevol = array('' => (''._LANG_ARRAY_SELECTIONNEZ_NOM.'')); // ligne affichée si vide

	while ($dbresult && $row = $dbresult->FetchRow()) {
		// constrution du tableau ID=Nom Prénom
		$tab_benevol[$row['id_adht']] = htmlentities(stripslashes(strtoupper($row['nom_adht']).' '.$row['prenom_adht']),ENT_NOQUOTES,'UTF-8');
    }

/***** FIN pour affichage de la liste Nom Prénom */


/***** prépation de l'affichage des informations sur la priorité */

	// récupere la variable de la page pour afficher la suite
	$numpage_affiche= get_post_variable_numeric('numpage_affiche', '1'); // par défaut 1 page
	// prépation de l'affichage
	$affiche_nb_lines = NB_LIGNES_PAGE;
	if (isset($_GET['affiche_nb_fich'])) {
		$affiche_nb_lines = get_post_variable_numeric('affiche_nb_fich',NB_LIGNES_PAGE); // par défaut
	}

	// requête principale  lire les adhérents dont priorité  <> 1
	$req_lire_priorite = "SELECT id_adht,nom_adht,prenom_adht,priorite_adht FROM "
	.TABLE_ADHERENTS."  WHERE soc_adht <>'999' AND priorite_adht <> '1'";
	$req_lire_priorite .= " ORDER BY ";
	// requête pour comptage
	$reqcompt_priorite = "SELECT id_adht FROM "
	.TABLE_ADHERENTS."  WHERE soc_adht <>'999' AND priorite_adht <> '1'";

	// phase de tri par colonne  Adht   	Bénévole	Priorité
	if (isset($_GET['tri'])) { // récupere le N° de la colosne de tri
		if (is_numeric($_GET['tri'])) {
			if ($_SESSION['tri'] == $_GET['tri']) {
				$_SESSION['tri_sens'] = ($_SESSION['tri_sens']+1)%2; // 0 ou 1
			} else {
				$_SESSION['tri'] = $_GET['tri'];
				$_SESSION['tri_sens'] = 0;
			}
		}
	}

	if ($_SESSION['tri_sens'] == '0') {// sens du tri
		$tri_sens_txt = 'ASC';
	} else {
		$tri_sens_txt = 'DESC';
	}

	// tri par colonne id
	if ($_SESSION['tri'] == '0') {
		$req_lire_priorite .= "id_adht ".$tri_sens_txt.',';
		// tri par colonne  nom = adhérent
	} elseif ($_SESSION['tri'] == '1') {
		$req_lire_priorite .= "nom_adht ".$tri_sens_txt.',';
	// tri par colonne priorité
	} elseif ($_SESSION['tri'] == '2') {
		$req_lire_priorite .= "priorite_adht ".$tri_sens_txt.',';
	}

	$req_lire_priorite .= "id_adht ".$tri_sens_txt;

	// comptage des fiches
	$dbresult = $db->Execute($reqcompt_priorite); // Pour compter le NB d'enregistrements
	$nb_lines= $dbresult->RecordCount() ; // le NB de lignes totales

	// pour afficher le Nb de lignes par page
	if ($affiche_nb_lines == 0) {
		$nbpages = 1;
	} else if ($nb_lines % $affiche_nb_lines == 0) { // si modulo = reste donc prévoir 1 page de +
		$nbpages = intval($nb_lines/$affiche_nb_lines); // pas de reste donc page entière
	} else {
		$nbpages = intval($nb_lines/$affiche_nb_lines)+1; // reste <>0 donc page + 1
	}


	if ($nbpages == 0) $nbpages = 1; // si 0 on prévoit 1 page ;-)

	$indice = 1+($numpage_affiche-1)*NB_LIGNES_PAGE ; // le N° de ligne
	$nbpages = $nbpages+1; // pour affichage sur template Page  1 2 3... avec lien

	$dbresult = $db->Execute($req_lire_priorite);

			// pour afficher le Nb de lignes par page
	if ($affiche_nb_lines == 0) {
		$dbresult = $db->Execute($req_lire_priorite);
	} else {
	// pour afficher le Nb de lignes par page
		$dbresult = $db->SelectLimit($req_lire_priorite,$affiche_nb_lines,  (($numpage_affiche-1)*$affiche_nb_lines) );
	}
// echo "DEBUG indice =".$indice."<br>"; // DEBUG
	// prépation des données
	while ($dbresult && $row = $dbresult->FetchRow()) {
		$priorite[$indice]['id_adht'] = $row['id_adht'];
		$priorite[$indice]['nom_prenom_adht'] = $row['nom_adht']." ".$row['prenom_adht'];
		$priorite[$indice]['priorite_adht'] = $row['priorite_adht']; // pour eviter les \ dans les noms d'asso
		$priorite[$indice]['coul'] = $indice % 2; // Pour afficher 1 ligne sur 2  classs= Lignegris0  / Lignegris1
		$indice++;
	}

/***** FIN de prépation de l'affichage des informations sur la priorité */



/***** ------------------------------------------------------------ */
	// Préparation pour Affichage partie Fixe VERS TEMPLATE
	$tpl->assign('version', VERSION); // Version de Gestasso
	$tpl->assign('nom_asso_gestassophp', NOM_ASSO_GESTASSOPHP); // le Nom de l'association
	$tpl->assign('messagetitre', MESSAGETITRE); // Titre Bandeau haut
	$tpl->assign('priorite_adht', $priorite_adht);
	$tpl->assign('nomprenom_adht', $prenom_adht.' '.$nom_adht);
	$tpl->assign('id_adht', $id_adht);
	// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE
	$tpl->assign('listnoms', $tab_benevol); // la liste des noms des adhérents
	$tpl->assign('list_priorite_adht', $T_PRIORITE_ACCESS);	// la liste des priorités
	$tpl->assign('priorite', $priorite);	// tableau $priorite[$indice]['xxx']
	$tpl->assign('nb_lines', $nb_lines); // Nb de lignes de requête
	$tpl->assign('nb_pages', $nbpages); // le Nombre de pages totales
	$tpl->assign('numpage', $numpage_affiche); // le N° de la page courrante
	// POUR  AFFICHAGE VERS TEMPLATE
	$content = $tpl->fetch('admin/remplir_priorite.tpl'); // affichage ...
	$tpl->assign('content', $content);
	$tpl->display('page_index.tpl');


} else {
	/***** Si erreur Retour vers la page de login ... avec message */
	header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR);
}
