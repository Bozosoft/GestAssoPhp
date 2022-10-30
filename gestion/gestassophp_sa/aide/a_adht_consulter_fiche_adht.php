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
 *  Directory :  /ROOT_DIR_GESTASSO/aide/
 *  Fichier :	a_adht_consulter_fiche_adht.php
 *  Affiche l'aide pour récapitulatif des informations Adhérent
*/

	include_once '../config/connexion.php';
	$masession = new sessions();
	$priorite_adht = $_SESSION['ses_priorite_adht'];
?>

<!doctype html>
<html lang='fr' dir='ltr'>
<head>
	<meta charset="UTF-8">
	<meta name="author" content="JCE">
	<meta name="Description" content="GestAssoPhp+Pg">
	<meta name="ROBOTS" content="noindex, nofollow">
	<meta name="keywords" lang="fr" content="GestAssoPhp">
	<link rel="stylesheet" type="text/css" media="screen"  href="../js/style_screen.css">
	<link rel="stylesheet" type="text/css" media="print"  href="../js/style_print.css">
	<title>GestAssoPhp Aide - <?php echo _LANG_TITRE_VISU_FICHE_ADHT ;?></title>
</head>
<body>
<body>

<p class="AfficheTitre"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20" title="Aidez-moi">
<span class="AfficheTitre14"><?php echo _LANG_TITRE_CONSULT_FICHE_ADHT ;?></span><br>
</p>
<div id="contenu">
  <p class="Textenoir">&nbsp;<br>
    Cette page montre un r&eacute;capitulatif des informations <?php echo ADHERENT_BENE ; ?><br>
    <br>
    Plusieurs zones d&eacute;finisse cette page :<br>
    <span class="TextenoirGras">- <?php echo _LANG_VISU_FICHE_ADHT_RECAP ; ?> </span>
    :<br>
    Le num&eacute;ro et date de cr&eacute;ation de la fiche, la date de modification
    et les informations sur la cotisation<br>
    <span class="TextenoirGras">- <?php echo _LANG_GESTION_FICHE_ADHT ; ?></span>
    :<br>
    Affiche les informations administratives.
    </p>
  <p>&nbsp;</p>

<span class="TextenoirR">&nbsp;&nbsp;<a href="#" onclick="self.close();">Fermer cette fen&ecirc;tre</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:window.print()">Imprimer cette page</a></span>
</div>
</body>
</html>
