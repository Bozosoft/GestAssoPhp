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
	<title>GestAssoPhp Aide - <?php echo _LANG_TITRE_ADMIN_FILE_ADHT ;?></title>
</head>
<body>

<p class="AfficheTitre"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20" title="Aidez-moi"/>
<span class="AfficheTitre14"><?php echo _LANG_TITRE_ADMIN_LISTE_FICHIERS_ADHT ;?></span><br />
</p>
<div id="contenu"> 
  <p class="Textenoir">&nbsp;<br />
    Cette page affiche la liste des fichiers des <?php echo ADHERENT_BENE ;?>s 
    suivant des crit&egrave;res d&eacute;finis par les informations de la liste 
    d&eacute;roulante &quot;<span class="TextenoirGras"><?php echo _LANG_TPL_TEXTE_SELECT ;?></span>&quot; 
    en haut &agrave; droite :<br/>
    - <span class="TextenoirGras"><?php echo ($T_AFFICHE_FILTRE_FICHIERS[0]) ;?></span> 
    : Les fichiers valides (téléchargeables) des <?php echo ADHERENT_BENE ;?>s 
    <br/>
    - <span class="TextenoirGras"><?php echo ($T_AFFICHE_FILTRE_FICHIERS[1]) ;?></span> 
    : Tous les fichiers des <?php echo ADHERENT_BENE ;?>s<br/>
    - <span class="TextenoirGras"><?php echo ($T_AFFICHE_FILTRE_FICHIERS[2]) ;?></span> 
    : Les fichiers supprimés ( les fichiers restent sur le serveur et sont renomm&eacute;s) 
    par l'ic&ocirc;ne <img src="../images/icones16/i_delete.png" width="16" height="16" alt="" title="<?php echo _LANG_LISTE_FICHIERS_ADHT_DEL_FILE_ICON_TITLE ;?>"/> de la colonne &quot;<span class="TextenoirGras"><?php echo _LANG_TPL_COL_ACTIONS ;?></span>&quot;.</p>	
  
  <p class="Textenoir">Il est possible :<br/>
    <br/>
    - d'ajouter depuis votre ordinateur vers le serveur (Upload) un nouveau fichier 
    gr&acirc;ce au bouton <span class="submit_ok" title="<?php echo _LANG_LISTE_FICHIERS_ADHT_ADFILE_BUTTON_TITLE ;?>">&nbsp;<?php echo _LANG_LISTE_FICHIERS_ADHT_ADFILE_BUTTON ;?>&nbsp;</span><br/>
    <br/>
    <span class="TextenoirGras">Note importante</span> : Attention &agrave; la 
    charte de nommage des fichiers.<br/>
    le nom du fichier doit &ecirc;tre de 25 caract&egrave;res MAXIMUM<br />
    Ne comporter aucun accent &quot;&eacute; &egrave; &agrave;&quot; ni espaces, 
    ni caract&egrave;res sp&eacute;ciaux tel que % &sect; / | # } ....<br />
    Les noms de fichiers doivent &ecirc;tre diff&eacute;rents de ceux d&eacute;j&agrave; 
    existant dans la base de donn&eacute;es (sinon message d'erreur). <br/>
	Les fichiers avec les extensions (php*, pl, js) sont interdits.  <br/>
	Utiliser de préférences les fichiers avec des <a href="http://fr.wikipedia.org/wiki/Format_ouvert" target="_blank">formats ouverts</a> et lisibles par tous.
    <br/> <br/>
    - de <span class="submit_ok"><?php echo _LANG_TPL_FILTER_BUTTON ;?></span> les fichiers par le <?php echo _LANG_TPL_COL_ADHT_NOM ;?> des <?php echo ADHERENT_BENE ;?>s.<br/>
    - d<span class="TextenoirGras">'<?php echo _LANG_TPL_SELECT_AFFICHEPAR ;?></span> 10, 20, 50 lignes par page ou de Toute la liste sur une seule page. <br />
    - d'effectuer un tri en cliquant sur les colonnes : <span class="TextebleuGras">#, <?php echo _LANG_LISTE_FICHIERS_COL_NOMFICHIER.', '. _LANG_TPL_COL_DESCRIPTION.', '._LANG_TPL_COL_DATE.', '._LANG_TPL_COL_ADHT_NOM.' '.ADHERENT_BENE ;?></span>.</p>
  <p class="Textenoir"><br/>
    - L'ic&ocirc;ne <img src="../images/icones16/i_voir.png" width="16" height="16" alt="" title="<?php echo _LANG_LISTE_FICHIERS_ADHT_VISU_FILE_ICON_TITLE ;?>"/> 
    de la colonne &quot;<span class="TextenoirGras"><?php echo _LANG_TPL_COL_ACTIONS ;?></span>&quot; ou Le 
    lien sur le &quot;<a href="#"> <?php echo _LANG_LISTE_FICHIERS_COL_NOMFICHIER ;?></a>&quot; permet de visualiser la 
    fiche de la ligne, et de modifier &eacute;ventuellement ces informations.<br/>
    - l'ic&ocirc;ne <img src="../images/icones16/i_disquet.png" width="16" height="16" alt="" title="<?php echo _LANG_LISTE_FICHIERS_ADHT_DOWNLOAD_FILE_ICON_TITLE ;?>"/> 
    de la colonne &quot;<span class="TextenoirGras"><?php echo _LANG_TPL_COL_ACTIONS ;?></span>&quot; permet 
    de t&eacute;l&eacute;charger vers votre ordinateur le fichier de la ligne.<br/>
    - l'ic&ocirc;ne <img src="../images/icones16/i_delete.png" width="16" height="16" alt="" title="<?php echo _LANG_LISTE_FICHIERS_ADHT_DEL_FILE_ICON_TITLE ;?>"/> 
    supprime de la liste le fichier ( (<span class="Texterouge">ATTENTION</span> 
    la suppression du fichier est irr&eacute;versible - Ce fichier est renomm&eacute; 
    sans &ecirc;tre supprim&eacute; du serveur)<br />
  </p>
  <p class="Textenoir">Si la s&eacute;lection est &quot;<span class="TextenoirGras"><?php echo ($T_AFFICHE_FILTRE_FICHIERS[2]) ;?></span>&quot; 
    :<br/>
    - l'ic&ocirc;ne <img src="../images/icones16/i_voir.png" width="16" height="16" alt="" title="<?php echo _LANG_LISTE_FICHIERS_ADHT_VISU_FILE_ICON_TITLE ;?>"/> 
    de la colonne &quot;<span class="TextenoirGras"><?php echo _LANG_TPL_COL_ACTIONS ;?></span>&quot; permet 
    de consulter la fiche supprim&eacute;e pour cette ligne.</p>
	<p>&nbsp;</p> 
  <span class="TextenoirR">&nbsp;&nbsp;<a href="#" onclick="self.close();">Fermer cette fen&ecirc;tre</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:window.print()">Imprimer cette page</a></span>
</div>
</body>
</html>

