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
	<title>GestAssoPhp Aide - <?php echo _LANG_TITRE_ADMIN_FICHE_COTIS ;?></title>
</head>
<body>

<p class="AfficheTitre"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20" title="Aidez-moi"/>
<span class="AfficheTitre14"><?php echo _LANG_TITRE_ADMIN_FICHE_COTIS_ADHT ;?></span><br />
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
    ) <br/> 
	Le <span class="TextenoirGras">mode  <?php echo _LANG_MESSAGE_COTIS_ADHT_ARCHIV ;?></span> de la cotisation consiste &agrave; effacer la cotisation &agrave; l'&eacute;ch&eacute;ance de la p&eacute;riode cotis&eacute;e pour :<br/>
- avoir un historique des cotisations<br/>
- indiquer que le membre doit, soit renouveler sa cotisation, soit doit &ecirc;tre supprim&eacute; de l'association<br/>
Cet archivage n'est pas obligatoire, mais permet de tracer l'activit&eacute; cotisation.<br/>
(la fiche cotisation archiv&eacute;e est toujours gard&eacute;e en base de donn&eacute;es)<br/>
</p>
  <p>&nbsp;</p>

<span class="TextenoirR">&nbsp;&nbsp;<a href="#" onclick="self.close();">Fermer cette fen&ecirc;tre</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:window.print()">Imprimer cette page</a></span>
</div>
</body>
</html>

