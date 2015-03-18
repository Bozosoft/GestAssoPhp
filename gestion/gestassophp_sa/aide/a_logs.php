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
	<link rel="stylesheet" type="text/css" media="screen"  href="../js/style_screen.css"/>
	<link rel="stylesheet" type="text/css" media="print"  href="../js/style_print.css"/>
	<title>GestAssoPhp+ Aide - <?php echo _LANG_TITRE_ADMIN_LOGS ;?></title>
</head>
<body>

<p class="AfficheTitre"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20" title="Aidez-moi"/>
<span class="AfficheTitre14"><?php echo _LANG_TITRE_ADMIN_LOGS ;?></span><br />
</p>
<div id="contenu"> 
  <p class="Textenoir">&nbsp;<br />
    Cette page permet de consulter les connexions à l'espace des "<?php echo ADHERENT_BENE ;?>"s 
    ainsi que les manipulations effectuées (Cr&eacute;ations, modifications, suppressions).<br />
    <br />
    Il est possible d'effectuer un tri en cliquant sur les colonnes : <span class="TextebleuGras"><?php echo _LANG_TPL_COL_DATE.', '._LANG_ADMIN_LOGS_COL_UTILISATEUR.', '._LANG_TPL_COL_DESCRIPTION ;?></span>.<br />
    <br />
    Il est possible :<br />
	- d'exporter la liste des logs au format XLS, avant d'effacer<br />
	- d'effacer TOUS les logs de la base de données en cliquant 
    sur l'icône <img src="../images/icones/i_poubelle.gif" alt="clear" width="10" height="11" title="<?php echo _LANG_ADMIN_LOGS_TITLE_CLEAR_LOGS ;?>" /> 
    <span class="TexterougeR">"<?php echo _LANG_ADMIN_LOGS_CLEAR_LOGS ;?>"</span> en haut à gauche. </p>
<p>&nbsp;</p>

<span class="TextenoirR">&nbsp;&nbsp;<a href="#" onclick="self.close();">Fermer cette fen&ecirc;tre</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:window.print()">Imprimer cette page</a></span>
</div>
</body>
</html>

