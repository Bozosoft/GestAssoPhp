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
    <title>GestAssoPhp Aide - <?php echo _LANG_TITRE_ADMIN_TABLEAUBORD ;?></title>
    <meta http-equiv="Content-Type" content="text/HTML; <?php echo _LANG_CHARSET ;?>" />		
	<meta name="author" content="JCE" />
	<meta name="Description" content="Aide GestAssoPhp" />
	<meta name="Copyright" content="(c)JCE 2007-2013" />	
	<meta name="Expires" content="never" />
	<meta name="ROBOTS" content="noindex, nofollow" />
	<link rel="stylesheet" type="text/css" media="screen"  href="../js/style_screen.css"/>
	<link rel="stylesheet" type="text/css" media="print"  href="../js/style_print.css"/>
</head>
<body>

<p class="AfficheTitre"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20" title="Aidez-moi"/>
<span class="AfficheTitre14"><?php echo _LANG_TITRE_ADMIN_TABLEAUBORD ;?></span><br />
</p>
<div id="contenu"> 
  <p class="Textenoir">&nbsp;<br />
    Cette page affiche un r&eacute;capitulatif de la gestion de l'association 
    : <br/>
    <br/>
    - la ligne <span class="TextenoirGras">"<?php echo ADHERENT_BENE ;?>s"</span> 
    donne le nombre d'inscrits depuis <?php echo DATE_DEBANNEE_ASSO ;?> et le 
    nombre de cotisants ainsi que le montant cotisations. En cliquant sur le nombre, 
    une fiche donne les d&eacute;tails.<br />
    <br />
    <br />
    <span class="TextenoirGras">Suivant la priorit&eacute;, </span> qui vous a &eacute;t&eacute; attribu&eacute;e 
    des menus sont accessibles ou non :<br />
<?php
 include_once 'a_codepriorite.php';  
 ?><br /><br /><br />

    - <span class="TextenoirGras">Pour t&eacute;l&eacute;charger un fichier</span>, apr&egrave;s 
    avoir positionn&eacute; la souris sur le nom l'ic&ocirc;ne <img src="../images/icones16/i_disquet.png" alt="T&eacute;l&eacute;charger" title="T&eacute;l&eacute;charger le fichier" /> 
    de la ligne concern&eacute;e, cliquer sur l'ic&ocirc;ne, ou cliquer sur le bouton droit 
    de la souris puis "Enregistrer le cible sous..." pour t&eacute;l&eacute;charger 
    le fichier vers votre ordinateur. <br />
	Le format du fichier t&eacute;l&eacute;charg&eacute; est compatible <a href="http://fr.libreoffice.org/" target="_blank">LibreOffice Calc</a> (s&eacute;parateur des colonnes tabulation).</p>
	<p class="centre-txt">Pour importer sous LibreOffice Calc, utiliser la fonction "Ouvrir avec LibreOffice" et lors de la fen&ecirc;tre "Import...", r&eacute;gler les param&egrave;tres suivant l'image ci dessous (cliquer sur l'image pour l'agrandir)<br />
	<a href="import_lbo.jpg"><img src='import_lbo_r.jpg' alt="import" width="100" height="84" title="import"/></a></p>
	
	
<p>&nbsp;</p>

<span class="TextenoirR">&nbsp;&nbsp;<a href="#" onclick="self.close();">Fermer cette fen&ecirc;tre</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:window.print()">Imprimer cette page</a></span>
</div>
</body>
</html>

