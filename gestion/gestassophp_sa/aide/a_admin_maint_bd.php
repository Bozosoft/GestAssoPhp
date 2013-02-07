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
    <title>GestAssoPhp Aide - <?php echo _LANG_TITRE_ADMIN_MAINT_BD ;?></title>
    <meta http-equiv="Content-Type" content="text/HTML; <?php echo _LANG_CHARSET ;?>" />	
	<meta name="author" content="JCE" />
	<meta name="Description" content="Aide GestAssoPhp" />
	<meta name="Copyright" content="(c)JCE 2008" />	
	<meta name="Expires" content="never" />
	<meta name="ROBOTS" content="noindex, nofollow" />
	<link rel="stylesheet" type="text/css" media="screen"  href="../js/style_screen.css"/>
	<link rel="stylesheet" type="text/css" media="print"  href="../js/style_print.css"/>
</head>
<body>

<p class="AfficheTitre"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20" title="Aidez-moi"/>
<span class="AfficheTitre14"><?php echo _LANG_TITRE_ADMIN_MAINT_BD ;?></span><br />
</p>
<div id="contenu">
<p class="Textenoir">&nbsp;<br />
Cette page permet la maintenance de la base de donn&eacute;es et donc :<br />
<br />
- D'effectuer une optimisation de toutes les tables afin d'avoir une meilleure performance.<br />A faire une fois tous les 15 jours environ<br /><br />

- De sauvegarder de la base de donn&eacute;es en cas de probl&egrave;me d'h&eacute;bergement.<br />
<br />
<span class="TextenoirGras">Il existe donc 2 possibilit&eacute;s</span> :<br />
<span class="TextenoirGras">Non/Oui - <?php echo _LANG_ADMIN_MAINT_BD_SAV_STRUCT ;?></span>, l'ossature des tables (&agrave; faire une fois ou si des modifications sont apport&eacute;es sur les tables<br />
<span class="TextenoirGras">Oui - <?php echo _LANG_ADMIN_MAINT_BD_SAV_DATA ;?></span> les informations contenues dans les tables (&agrave; faire en fonction de la fiabilit&eacute; de l'h&eacute;bergement )
<br />

</p>
<p>&nbsp;</p>

<span class="TextenoirR">&nbsp;&nbsp;<a href="#" onclick="self.close();">Fermer cette fen&ecirc;tre</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:window.print()">Imprimer cette page</a></span>
</div>
</body>
</html>

