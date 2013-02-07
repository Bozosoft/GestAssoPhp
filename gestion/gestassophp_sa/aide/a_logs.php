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
 * @version :  2013
 * @copyright 2007-2013  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */
 include_once '../config/connexion.php';  
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

<head>
    <title>GestAssoPhp Aide - <?php echo _LANG_TITRE_ADMIN_LOGS ;?></title>
     <meta http-equiv="Content-Type" content="text/HTML; charset=<?php echo _LANG_CHARSET ;?>" />	
	<meta name="author" content="JCE" />
	<meta name="Description" content="Aide GestAssoPhp" />
	<meta name="Copyright" content="(c)JCE 2007" />	
	<meta name="Expires" content="never" />
	<meta name="ROBOTS" content="noindex, nofollow" />
	<link rel="stylesheet" type="text/css" media="screen"  href="../js/style_screen.css"/>
	<link rel="stylesheet" type="text/css" media="print"  href="../js/style_print.css"/>
</head>
<body>

<p class="AfficheTitre"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20" title="Aidez-moi"/>
<span class="AfficheTitre14"><?php echo _LANG_TITRE_ADMIN_LOGS ;?></span><br />
</p>
<div id="contenu"> 
  <p class="Textenoir">&nbsp;<br />
    Cette page permet de consulter les connexions &agrave; l'espace des "<?php echo ADHERENT_BENE ;?>"s 
    ainsi que les manipulations effectu&eacute;es (Cr&eacute;ations, modifications, suppressions).<br />
    <br />
    Il est possible d'effectuer un tri en cliquant sur les colonnes : <span class="TextebleuGras"><?php echo _LANG_TPL_COL_DATE.', '._LANG_ADMIN_LOGS_COL_UTILISATEUR.', '._LANG_TPL_COL_DESCRIPTION ;?></span>.<br />
    <br />
    Il est possible :<br />
	- d'exporter la liste des logs au format XLS, avant d'effacer<br />
	- d'effacer TOUS les logs de la base de donn&eacute;es en cliquant 
    sur l'ic&ocirc;ne <img src="../images/icones/i_poubelle.gif" alt="clear" width="10" height="11" title="<?php echo _LANG_ADMIN_LOGS_TITLE_CLEAR_LOGS ;?>" /> 
    <span class="TexterougeR">"<?php echo _LANG_ADMIN_LOGS_CLEAR_LOGS ;?>"</span> en haut &agrave; gauche. </p>
<p>&nbsp;</p>

<span class="TextenoirR">&nbsp;&nbsp;<a href="#" onclick="self.close();">Fermer cette fen&ecirc;tre</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:window.print()">Imprimer cette page</a></span>
</div>
</body>
</html>

