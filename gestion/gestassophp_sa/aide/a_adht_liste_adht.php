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
 *  Fichier :	a_adht_liste_adht.php
 *  Affiche l'aide pour la liste des Adhérents souhaitant afficher leurs coordonnées - Gestion Membres
*/

	include_once '../config/connexion.php';
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
	<title>GestAssoPhp Aide - <?php echo _LANG_TITRE_LISTE_ADHT ;?></title>
</head>
<body>

<p class="AfficheTitre"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20" title="Aidez-moi">
<span class="AfficheTitre14"><?php echo _LANG_TITRE_LISTE_ADHT ;?></span><br>
</p>
<div id="contenu">
  <p class="Textenoir">&nbsp;<br>
    Cette page affiche, surtout pour les <?php echo ADHERENT_BENE ;?>s de <span class="TextenoirGras">Priorité = 1</span>, la liste
    des <?php echo ADHERENT_BENE ;?>s qui ont donn&eacute; leur accord pour afficher
    leurs coordonn&eacute;es consultables par TOUS les <?php echo ADHERENT_BENE ;?>s
    dans la fiche &quot;<?php echo _LANG_GESTION_FICHE_ADHT ;?>&quot;.</p>
  <p class="Textenoir">
    <span class="TextenoirGras">NOTA :</span> si aucun Adhérent n'a donner le consentement pour afficher
   <span class="TextenoirGras">ses coordonn&eacute;es</span> consultables par TOUS les <?php echo ADHERENT_BENE ;?>s, sur sa fiche, il n'y aura aucun affichage.
   </p>
  <p class="Textenoir">Il est possible :<br>
    - de <span class="submit_ok"><?php echo _LANG_TPL_FILTER_BUTTON ;?></span> <?php echo _LANG_LISTE_ADHT_PARMI.' des '. ADHERENT_BENE ;?>s pour rechercher un <?php echo _LANG_TPL_COL_ADHT_NOM ;?> ou un <?php echo _LANG_FICHE_ADHT_PRENOM ;?> particulier.<br>
    - d'<span class="TextenoirGras"><?php echo _LANG_TPL_SELECT_AFFICHEPAR ;?></span> 10, 20, 50 lignes par page ou de Toute la liste sur une seule page. <br>
    - d'effectuer un tri en cliquant sur les colonnes : <span class="TextebleuGras">#,
   <?php echo _LANG_TPL_COL_ADHT_NOM.', '._LANG_FICHE_ADHT_PRENOM.', '. _LANG_TPL_COL_ADHT_VILLE ;?>, <?php echo _LANG_TPL_COL_ADHT_TELEPH ;?>  ,  <?php echo _LANG_TPL_COL_ADHT_PORTABLE ;?>, <?php echo _LANG_FICHE_ADHT_ANT ;?>   </span>.</p>
  <p class="Textenoir">L'ic&ocirc;ne <img src="../images/icones16/i_voir.png" width="16" height="16" alt="Visu" title="<?php echo _LANG_LISTE_ADHT_VISU_ICON_TITLE ;?>">
    de la colonne &quot;<span class="TextenoirGras"><?php echo _LANG_TPL_COL_ACTION ;?></span>&quot;, ou le
    lien sur le &quot;<a href="#"><?php echo _LANG_TPL_COL_NOMPRE ;?></a>&quot; permet la &quot;<?php echo _LANG_TITRE_CONSULT_FICHE_ADHT ;?> &quot; de la fiche <?php echo ADHERENT_BENE ;?>
    pour cette ligne. <br>
  </p>
  <p>&nbsp;</p>

<span class="TextenoirR">&nbsp;&nbsp;<a href="#" onclick="self.close();">Fermer cette fen&ecirc;tre</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:window.print()">Imprimer cette page</a></span>
</div>
</body>
</html>
