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
 * @version :  2016
 * @copyright 2007-2016  (c) JC Etiemble
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
	<title>GestAssoPhp Aide - <?php echo _LANG_LISTE_COTIS_ADHT_LISTE_TITLE ;?></title> 
</head>
<body>

<p class="AfficheTitre"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20" title="Aidez-moi"/>
<span class="AfficheTitre14"><?php echo _LANG_LISTE_COTIS_ADHT_LISTE_TITLE ;?> et <?php echo _LANG_TITRE_ADMIN_LISTE_COTIS_ADHT ;?></span><br />
</p>
<div id="contenu"> 
  <p class="Textenoir">&nbsp;<br />
    Cette page affiche la liste des cotisations des <?php echo ADHERENT_BENE ;?>s 
    suivant des crit&egrave;res d&eacute;finis par les informations de la liste 
    d&eacute;roulante &quot;<span class="TextenoirGras"><?php echo _LANG_TPL_TEXTE_SELECT  ;?></span>&quot; 
    en haut &agrave; droite :<br/>
    - <span class="TextenoirGras"><?php echo ($T_AFFICHE_FILTRE_COTISATIONS[0]) ;?></span> 
    : Les fiches des <?php echo ADHERENT_BENE ;?>s qui sont à jour de leur cotisation<br/>
    - <span class="TextenoirGras"><?php echo ($T_AFFICHE_FILTRE_COTISATIONS[1]) ;?></span> 
    : Toutes les fiches des <?php echo ADHERENT_BENE ;?>s<br/>
    - <span class="TextenoirGras"><?php echo ($T_AFFICHE_FILTRE_COTISATIONS[2]) ;?></span> 
    : Les fiches archivées par l'ic&ocirc;ne <img src="../images/icones16/i_archive.png" width="16" height="16" alt="" title="<?php echo  _LANG_LISTE_COTIS_ADHT_ARCHIV_ICON_TITLE ;?>"/> 
    de la colonne &quot;<span class="TextenoirGras"><?php echo _LANG_TPL_COL_ACTIONS ;?></span>&quot;</p>	
  
  <p class="Textenoir">Il est possible :<br/>
    <br/>
    - de cr&eacute;er une nouvelle fiche gr&acirc;ce au bouton <span class="submit_ok" title=" <?php echo _LANG_LISTE_COTIS_ADHT_ADDCOTIS_BUTTON  ;?> ">&nbsp; <?php echo _LANG_LISTE_COTIS_ADHT_ADDCOTIS_BUTTON_TITLE  ;?>&nbsp;</span><br/>
    <br/>
	Il est préférable de sélectionner un <?php echo ADHERENT_BENE ;?> par l'ic&ocirc;ne <img src="../images/icones16/i_euro.png" width="16" height="16" alt="" title="<?php echo _LANG_ADMIN_LISTE_ADHT_COTIS_ICON_TITLE ;?>"/> 
    de la colonne &quot;<span class="TextenoirGras"><?php echo _LANG_TPL_COL_ACTIONS .'/'. _LANG_TITRE_ADMIN_LISTE_ADHT;?></span>&quot; qui donne directement acc&egrave;s au gestionnaire des cotisations.<br/>
	    <br/>
    <span class="TextenoirGras">Note importante</span> : Avant de créer une 
    nouvelle fiche cotisation, assurer vous qu'une <span class="Texterouge">fiche n'existe pas déja !!</span><br/>la cr&eacute;ation d'une 
    nouvelle fiche cotisation pour un <?php echo ADHERENT_BENE ;?> ayant d&eacute;j&agrave; 
    une fiche en cours cotisation est possible (Cotisations multiples). Vous pouvez procéder à l'archivage d'une fiche avant d'en créer une nouvelle.<br/>
	Le <span class="TextenoirGras">mode  <?php echo _LANG_MESSAGE_COTIS_ADHT_ARCHIV ;?></span> de la cotisation consiste &agrave; effacer la cotisation &agrave; l'&eacute;ch&eacute;ance de la p&eacute;riode cotis&eacute;e pour :<br/>
	- avoir un historique des cotisations<br/>
	- indiquer que le membre doit, soit renouveler sa cotisation, soit doit &ecirc;tre supprim&eacute; de l'association<br/>
	Cet archivage n'est pas obligatoire, mais permet de tracer l'activit&eacute; cotisation.<br/>
	(la fiche cotisation archiv&eacute;e est toujours gard&eacute;e en base de donn&eacute;es)<br/>
	<br/>
	<span class="TextenoirGras">Nota :</span> il est <span class="TexterougeGras">obligatoire d'archiver</span> la ou les cotisations avant de supprimer la fiche <?php echo ADHERENT_BENE ;?>. Si la ou les cotisations ne sont pas archivées un message d'erreur est affiché.
	<br/>
    <br/>
    - de <span class="submit_ok"><?php echo _LANG_TPL_FILTER_BUTTON  ;?></span> les cotisations des <?php echo ADHERENT_BENE ;?>s 
    entre une date de d&eacute;but et une date de fin (<?php echo _LANG_TPL_TEXTE_DATE_TITLE ;?> = 31/12/2007).<br/>
    - d<span class="TextenoirGras">'<?php echo _LANG_TPL_SELECT_AFFICHEPAR ;?></span> 10, 20, 50 lignes par page ou de Toute la liste sur une seule page. <br />
    - d'effectuer un tri en cliquant sur les colonnes : <span class="TextebleuGras">#, 
    <?php echo _LANG_LISTE_COTIS_ADHT_COL_D_ENR.', '._LANG_LISTE_COTIS_ADHT_COL_D_FIN.', '. _LANG_TPL_COL_NOMPRE.', '._LANG_LISTE_COTIS_ADHT_COL_TYPE .', '._LANG_LISTE_COTIS_ADHT_COL_MONTANT .', '._LANG_LISTE_COTIS_ADHT_COL_STATUT ;?></span>.<br/>
	la colonne <span class="TextebleuGras"><?php  echo _LANG_LISTE_COTIS_ADHT_COL_STATUT.'</span> indique que la fiche est <span class="TextenoirGras">'. _LANG_MESSAGE_LISTE_COTIS_ADHT_ARCHIV.'</span> ou <span class="TextenoirGras">'. _LANG_MESSAGE_LISTEARCHIV_ADHT_ARCHIV.'</span> (si archivée en série) avec une <span class="TextenoirGras">'._LANG_TPL_COL_DATE ;?></span>
	</p>
  <p class="Textenoir">- Le lien sur le &quot;<a href="#"><?php echo _LANG_TPL_COL_NOMPRE ;?></a>&quot; 
    permet de visualiser les cotisations de cette fiche <?php echo ADHERENT_BENE ;?> 
    <br/>
    - L'ic&ocirc;ne <img src="../images/icones16/i_modif.png" width="16" height="16" alt="" title="<?php echo  _LANG_LISTE_COTIS_ADHT_MODIF_ICON_TITLE ;?>"/> 
    de la colonne &quot;<span class="TextenoirGras"><?php echo _LANG_TPL_COL_ACTIONS ;?></span>&quot;, permet 
    de visualiser la fiche de la ligne, et de modifier &eacute;ventuellement ces 
    informations.<br/>
    - l'ic&ocirc;ne <img src="../images/icones16/i_archive.png" width="16" height="16" alt="" title="<?php echo  _LANG_LISTE_COTIS_ADHT_ARCHIV_ICON_TITLE ;?>"/> 
    de la colonne &quot;<span class="TextenoirGras"><?php echo _LANG_TPL_COL_ACTIONS ;?></span>&quot; permet 
    d'acc&eacute;der &agrave; la fiche avant de l'archiver virtuellement (<span class="Texterouge">ATTENTION</span> 
    l'archivage de la fiche est irr&eacute;versible et r&eacute;clame &quot; <?php echo _LANG_MESSAGE_COTIS_ADHT_RAISON_ARCHIV ;?>&quot;).</p> 
    
  <p class="Textenoir">Si la s&eacute;lection est &quot;<span class="TextenoirGras"><?php echo ($T_AFFICHE_FILTRE_COTISATIONS[2]) ;?></span>&quot; 
    :<br/>
    - l'ic&ocirc;ne <img src="../images/icones16/i_ficharch.png" width="16" height="16" alt="" title=" <?php echo  _LANG_LISTE_COTIS_ADHT_CONSULT_ICON_TITLE ;?>"/> 
    de la colonne &quot;<span class="TextenoirGras"><?php echo _LANG_TPL_COL_ACTIONS ;?></span>&quot; permet 
    de consulter la fiche cotisation &quot;<?php echo _LANG_MESSAGE_LISTE_COTIS_ADHT_ARCHIV ;?>&quot; pour cette ligne.
    <br /> <br />
    <span class="TextenoirGras">A partir de la version 7.3 de GestAssoPhp<br />
	ASTUCE :</span> Pour archiver plusieurs fiches, utiliser le lien <span class="TextebleuGras"><?php echo _LANG_TITRE_ADMIN_LISTEARCHIV_COTIS_ADHT ;?></span> à coté du bouton <span class="submit_ok" title=" <?php echo _LANG_LISTE_COTIS_ADHT_ADDCOTIS_BUTTON  ;?> ">&nbsp; <?php echo _LANG_LISTE_COTIS_ADHT_ADDCOTIS_BUTTON_TITLE  ;?>&nbsp;</span> pour ouvrir une nouvelle page <span class="header_titre"><?php echo _LANG_TITRE_ADMIN_LISTEARCHIV_COTIS_ADHT ;?></span>.
	 </p>
  <span class="TextenoirR">&nbsp;&nbsp;<a href="#" onclick="self.close();">Fermer cette fen&ecirc;tre</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:window.print()">Imprimer cette page</a></span>
</div>
</body>
</html>

