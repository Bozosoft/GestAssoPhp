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
    <title>GestAssoPhp Aide - <?php echo _LANG_MENU_ADMIN_GESTION.'/'._LANG_TITRE_ADMIN_LISTE_ADHT2 ;?></title>
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
<span class="AfficheTitre14"><?php echo _LANG_MENU_ADMIN_GESTION.'/'._LANG_TITRE_ADMIN_LISTE_ADHT2 ;?></span><br />
</p>
<div id="contenu"> 
  <p class="Textenoir">&nbsp;<br />
    Cette page affiche <span class="TextenoirGras">uniquement</span> la liste 
    des <?php echo ADHERENT_BENE ;?>s actifs.</p>
  <p class="Textenoir">Il est possible :<br/>
    - de <span class="submit_ok"><?php echo _LANG_TPL_FILTER_BUTTON ;?></span> <?php echo _LANG_LISTE_ADHT_PARMI.' des '. ADHERENT_BENE ;?>s pour rechercher un <?php echo _LANG_TPL_COL_ADHT_NOM ;?> ou un <?php echo _LANG_FICHE_ADHT_PRENOM ;?> particulier.<br/>
    - d'<span class="TextenoirGras"><?php echo _LANG_TPL_SELECT_AFFICHEPAR ;?></span> 10, 20, 50 lignes par page ou de Toute la liste sur une seule page. <br />
    - d'effectuer un tri en cliquant sur les colonnes : <span class="TextebleuGras">#, 
   <?php echo _LANG_TPL_COL_ADHT_NOM.', '._LANG_FICHE_ADHT_PRENOM.', '. _LANG_TPL_COL_ADHT_VILLE ;?>, <?php echo _LANG_TPL_COL_ADHT_TELEPH ;?>  ,  <?php echo _LANG_TPL_COL_ADHT_PORTABLE ;?>, <?php echo _LANG_FICHE_ADHT_ANT ;?>   </span>.</p>
  <p class="Textenoir">L'ic&ocirc;ne <img src="../images/icones16/i_voir.png" width="16" height="16" alt="Visu" title="<?php echo _LANG_LISTE_ADHT_VISU_ICON_TITLE ;?>"/> 
    de la colonne &quot;<span class="TextenoirGras"><?php echo _LANG_TPL_COL_ACTION ;?></span>&quot;, ou le 
    lien sur le &quot;<a href="#"><?php echo _LANG_TPL_COL_NOMPRE ;?></a>&quot; permet la &quot;<?php echo _LANG_TITRE_CONSULT_FICHE_ADHT ;?> &quot; de la fiche <?php echo ADHERENT_BENE ;?> 
    pour cette ligne. <br />
  </p>
  <p>&nbsp;</p>

<span class="TextenoirR">&nbsp;&nbsp;<a href="#" onclick="self.close();">Fermer cette fen&ecirc;tre</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:window.print()">Imprimer cette page</a></span>
</div>
</body>
</html>

