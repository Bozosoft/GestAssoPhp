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
    <title>GestAssoPhp Aide - <?php echo _LANG_TITRE_ADMIN_PREFERENCES ;?></title>
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
<span class="AfficheTitre14"> <?php echo _LANG_TITRE_ADMIN_PREFERENCES ;?></span><br />
</p>
<div id="contenu"> 
  <p class="Textenoir">&nbsp;<br />
    Cette page permet une modification des informations qui sont les donn&eacute;es pour l'affichage de l'association 
    <br/><span class="TextenoirGras">Cette page comporte 3 onglets :</span><br /><br />
	
	- <span class="TextenoirGras"><?php echo _LANG_TITRE_ADMIN_PREFTAB1 ;?></span> 
	<br/>
	&nbsp;&nbsp;<span class="TextenoirGras">les informations de base : </span><?php echo _LANG_PREF_MESSAGETITRE.', '._LANG_PREF_NOM_ASSO_GESTASSOPHP.', '._LANG_PREF_DATE_DEBANNEE_ASSO_TITLE ;?><br/>
	&nbsp;&nbsp;<span class="TextenoirGras">les informations de fonctionnement : </span><?php echo _LANG_PREF_NB_LIGNES_PAGE.', '._LANG_PREF_EMAIL_ADRESSE ;?>
		<br/>
	&nbsp;&nbsp;<span class="TextenoirGras"><?php echo _LANG_PREF_ADHERENT_BENE.'</span> : '._LANG_PREF_ADHERENT_BENE_TITLE .' ' ._LANG_PREF_ADHERENT_BENE_INFO ;?> 	
				<br/>
	&nbsp;&nbsp;<span class="TextenoirGras"><?php echo _LANG_PREF_LANG_FICHE_ADHT_ANT.'</span> : '._LANG_PREF_LANG_FICHE_ADHT_ANT_INFO ;?><br /> 				
	&nbsp;&nbsp;<span class="TextenoirGras"><?php echo _LANG_FICHE_COTIS_ADHT_DATE_FIN.'</span> : '._LANG_PREF_LANG_JMA_FIN_COTIS_INFO ;?>
	<br />
				<br />
	- <span class="TextenoirGras"><?php echo _LANG_TITRE_ADMIN_PREFTAB2 ;?></span><br />
	&nbsp;&nbsp;<span class="TextenoirGras"><?php echo _LANG_PREF_COL_DESIGNATION_ACTIV ;?></span><br /> Exemple dans une association une activit&eacute; de base (celle par d&eacute;faut dans la fiche <?php echo _LANG_GESTION_FICHE_ADHT;?>) et des activ&eacute;s autres de reliure, danse, aide aux devoirs ...<br /><br />
	- <span class="TextenoirGras"><?php echo _LANG_TITRE_ADMIN_PREFTAB3 ;?></span><br />
	&nbsp;&nbsp;<span class="TextenoirGras"><?php echo _LANG_PREF_COL_DESIGNATION_COTIS ;?></span> et 
	&nbsp;&nbsp;<span class="TextenoirGras"><?php echo _LANG_PREF_NEW_MONT_COTISATION ;?></span>
      <br/>
      - L'ic&ocirc;ne <img src="../images/icones16/i_modif.png" width="16" height="16" alt="" title="<?php echo  _LANG_LISTE_COTIS_ADHT_MODIF_ICON_TITLE ;?>"/> 
    de la colonne &quot;<span class="TextenoirGras"><?php echo _LANG_TPL_COL_ACTIONS ;?></span>&quot;, permet 
    de modifier &eacute;ventuellement ces 
    informations.<br/><br />
</p>

<span class="TextenoirR">&nbsp;&nbsp;<a href="#" onclick="self.close();">Fermer cette fen&ecirc;tre</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:window.print()">Imprimer cette page</a></span>
</div>
</body>
</html>