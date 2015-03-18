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
	<title>GestAssoPhp+ Aide - <?php echo _LANG_TITRE_ADMIN_MAINT_BD ;?></title>
</head>
<body>

<p class="AfficheTitre"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20" title="Aidez-moi"/>
<span class="AfficheTitre14"><?php echo _LANG_TITRE_ADMIN_MAINT_BD ;?></span><br />
</p>
<div id="contenu">
<p class="Textenoir">&nbsp;<br />
Cette page permet la maintenance de la base de données et donc :<br />
<br />
- D'effectuer une optimisation de toutes les tables afin d'avoir une meilleure performance.<br />A faire une fois tous les 15 jours environ<br /><br />

- De sauvegarder de la base de données en cas de problème d'hébergement.<br />
<br />
<span class="TextenoirGras">Il existe donc 2 possibilités</span> :<br />
<span class="TextenoirGras">Non/Oui - <?php echo _LANG_ADMIN_MAINT_BD_SAV_STRUCT ;?></span>, l'ossature des tables (à faire une fois ou si des modifications sont apportées sur les tables<br />
<span class="TextenoirGras">Oui - <?php echo _LANG_ADMIN_MAINT_BD_SAV_DATA ;?></span> les informations contenues dans les tables (à faire en fonction de la fiabilité de l'hébergement )
<br />

</p>
<p>&nbsp;</p>

<span class="TextenoirR">&nbsp;&nbsp;<a href="#" onclick="self.close();">Fermer cette fen&ecirc;tre</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:window.print()">Imprimer cette page</a></span>
</div>
</body>
</html>

