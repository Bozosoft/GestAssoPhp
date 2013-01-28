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
    <title>GestAssoPhp Aide - <?php echo _LANG_TITRE_ADMIN_FICHE_COTIS ;?></title>
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
<span class="AfficheTitre14"><?php echo _LANG_TITRE_ADMIN_FICHE_COTIS ;?></span><br />
</p>
<div id="contenu"> 
  <p class="Textenoir">&nbsp;<br />
    Cette page permet de :<br/>
    <br/>
    - cr&eacute;er une fiche cotisation : <span class="TextenoirGras">mode <?php echo _LANG_MESSAGE_CREATE ;?></span> 
    (Certains champs sont <span class="Texterouge">obligatoires</span>)<br/>
		Nota <?php echo _LANG_FICHE_COTIS_ADHT_MONTANT_COTIS  ;?>, onglet "<?php echo  _LANG_TITRE_ADMIN_PREFTAB3 ;?>".
	<br/>Il suffit donc de sélectionner "<?php echo _LANG_FICHE_COTIS_ADHT_TYPE  ;?>" pour avoir le  " <?php echo _LANG_PREF_COL_MONT_COTISATION  ;?>"<br/>
	
	<br/><br/>
	
	
    - consulter ou de modifier une fiche cotisation : <span class="TextenoirGras">mode 
    <?php echo _LANG_MESSAGE_MODIF ;?></span> (Les zones non modifiables sont gris&eacute;es )<br/>
	<span class="TextenoirGras">Attention si vous modifiez le "<?php echo _LANG_FICHE_COTIS_ADHT_TYPE  ;?>", vous devez aussi modifier le " <?php echo _LANG_PREF_COL_MONT_COTISATION  ;?>"</span>
	<br/><br/>
	
	Le bouton <span class="submit_ok" title="<?php echo _LANG_FICHE_COTIS_ADHT_VISU_BUTTON_TITLE;?>">&nbsp;<?php echo _LANG_FICHE_COTIS_ADHT_VISU_BUTTON ;?>&nbsp;</span> permet d'afficher dans une page un reçu de la cotisation pour impression. (Utiliser la fonction Imprimer du navigateur)<br/><br/>
    - archiver une fiche cotisation : <span class="TextenoirGras">mode  <?php echo _LANG_MESSAGE_COTIS_ADHT_ARCHIV ;?></span><br/>
    &nbsp;&nbsp;&nbsp;&nbsp;une alerte sur la Date fin cotisation (<span class="erreur-Jaunerouge"><?php echo _LANG_MESSAGE_COTIS_ADHT_ALERT_ARCHIV;?></span>) si la date de fin de 
    cotisation est sup&eacute;rieure &agrave; la date du jour<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;(<span class="Texterouge">ATTENTION</span> l'archivage 
    de la fiche est irr&eacute;versible et affiche un message <span class="erreur-Jaunerouge"><?php echo _LANG_MESSAGE_COTIS_ADHT_RAISON_ARCHIV  ;?></span>)<br/>
    - consulter une fiche cotisation archiv&eacute;e : <span class="TextenoirGras">mode 
    <?php echo _LANG_MESSAGE_COTIS_ADHT_CONSULT_ARCHIV ;?></span> (Toutes les zones sont gris&eacute;es 
    ) </p>
  <p>&nbsp;</p>

<span class="TextenoirR">&nbsp;&nbsp;<a href="#" onclick="self.close();">Fermer cette fen&ecirc;tre</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:window.print()">Imprimer cette page</a></span>
</div>
</body>
</html>

