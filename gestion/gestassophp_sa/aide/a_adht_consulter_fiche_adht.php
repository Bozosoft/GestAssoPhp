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
//include_once '../../fileloc_gestasso_s.php';  //----------Pour TEMPLATE et localise rep 
include_once '../config/connexion.php';
 $masession = new sessions(); 
 $priorite_adht = $_SESSION['ses_priorite_adht'];

?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

<head>
    <title>GestAssoPhp Aide - <?php echo _LANG_TITRE_CONSULT_FICHE_ADHT ;?></title>
    <meta http-equiv="Content-Type" content="text/HTML; <?php echo _LANG_CHARSET ;?>" />	
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
<span class="AfficheTitre14"><?php echo _LANG_TITRE_CONSULT_FICHE_ADHT ;?></span><br />
</p>
<div id="contenu"> 
  <p class="Textenoir">&nbsp;<br />
    Cette page montre un r&eacute;capitulatif des informations <?php echo ADHERENT_BENE ; ?><br/>
    <br />
    Plusieurs zones d&eacute;finisse cette page :<br/>
    <span class="TextenoirGras">- <?php echo _LANG_VISU_FICHE_ADHT_RECAP ; ?></span> 
    :<br/>
    Le num&eacute;ro et date de cr&eacute;ation de la fiche, la date de modification 
    et les informations sur la cotisation<br/>
    <span class="TextenoirGras">- <?php echo _LANG_GESTION_FICHE_ADHT ; ?></span> 
    :<br/>
    Affiche les informations administratives.
    </p>
  <p>&nbsp;</p>

<span class="TextenoirR">&nbsp;&nbsp;<a href="#" onclick="self.close();">Fermer cette fen&ecirc;tre</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:window.print()">Imprimer cette page</a></span>
</div>
</body>
</html>

