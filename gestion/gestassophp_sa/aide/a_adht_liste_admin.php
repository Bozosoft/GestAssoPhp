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
    <title>GestAssoPhp Aide - <?php echo _LANG_TITRE_ADMIN_LISTE_ADHT ;?></title>
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
<span class="AfficheTitre14"><?php echo _LANG_TITRE_ADMIN_LISTE_ADHT ;?></span><br />
</p>
<div id="contenu"> 
  <p class="Textenoir">&nbsp;<br />
    Cette page affiche la liste des <?php echo ADHERENT_BENE ;?>s suivant des 
    crit&egrave;res d&eacute;finis par les informations de la liste d&eacute;roulante 
    &quot;<span class="TextenoirGras"><?php echo _LANG_TPL_TEXTE_SELECT ;?></span>&quot; en haut 
    &agrave; droite :<br/>
    - <span class="TextenoirGras"><?php echo ($T_AFFICHE_FILTRE_MEMBRES[0]) ;?></span> 
    : <?php echo ADHERENT_BENE ;?>s enregistr&eacute;s, sauf fiches supprim&eacute;es<br/>
    - <span class="TextenoirGras"><?php echo ($T_AFFICHE_FILTRE_MEMBRES[1]) ;?></span> 
    : <?php echo ADHERENT_BENE ;?>s dont la cotisation est en cours<br/>
    - <span class="TextenoirGras"><?php echo ($T_AFFICHE_FILTRE_MEMBRES[2]) ;?></span> 
    : <?php echo ADHERENT_BENE ;?>s dont la cotisation est &eacute;chue ou non r&eacute;gl&eacute;e<br/>
    - <span class="TextenoirGras"><?php echo ($T_AFFICHE_FILTRE_MEMBRES[3]) ;?></span> 
    : <?php echo ADHERENT_BENE ;?>s retir&eacute;s de la liste<br/>
    - <span class="TextenoirGras"><?php echo ($T_AFFICHE_FILTRE_MEMBRES[4]) ;?></span> 
    : Tous les <?php echo ADHERENT_BENE ;?>s </p>
	
  <p class="Textenoir">Il est possible :<br/>
        <br/>
    - de cr&eacute;er une nouvelle fiche <?php echo ADHERENT_BENE ;?> gr&acirc;ce 
    au bouton <span class="submit_ok" title="Ajouter <?php echo ADHERENT_BENE ;?>">&nbsp;
    <?php echo _LANG_ADMIN_LISTE_ADHT_ADDADHT_BUTTON ;?>&nbsp;</span><br/>
    <br/>
    - de <span class="submit_ok"><?php echo _LANG_TPL_FILTER_BUTTON ;?></span> parmi <?php echo _LANG_LISTE_ADHT_PARMI ;?> des fiches <?php echo ADHERENT_BENE ;?>s pour rechercher <?php echo _LANG_TPL_COL_ADHT_NOM ;?> ou un <?php echo _LANG_FICHE_ADHT_PRENOM ;?> particulier.<br/>
    - d'<span class="TextenoirGras"><?php echo _LANG_TPL_SELECT_AFFICHEPAR ;?></span> 10, 20, 50 lignes par page ou de Toute la liste sur une seule page. <br />
    - d'effectuer un tri en cliquant sur les colonnes : <span class="TextebleuGras">#, 
    <?php echo _LANG_TPL_COL_NOMPRE.', '._LANG_TPL_COL_ADHT_VILLE.','._LANG_TPL_COL_ADHT_TELEPH.', '._LANG_ADMIN_LISTE_ADHT_COL_INSCRIPT.', '._LANG_ADMIN_LISTE_ADHT_COL_ECH.', '._LANG_ADMIN_LISTE_ADHT_COL_ENR.', '. _LANG_FICHE_ADHT_ANT;?></span>. <br/><?php  echo _LANG_ADMIN_LISTE_ADHT_COL_ECH ;?> = Ech&eacute;ance cotisation, <?php  echo _LANG_ADMIN_LISTE_ADHT_COL_ENR ;?> = La personne qui a enregistr&eacute;e la fiche la premi&egrave;re fois, <?php  echo _LANG_FICHE_ADHT_ANT.' = '. _LANG_PREF_LANG_FICHE_ADHT_ANT ;?></p>
	
  <p class="Textenoir">- L'ic&ocirc;ne <img src="../images/icones16/i_voir.png" width="16" height="16" alt="Visu" title="<?php echo _LANG_LISTE_ADHT_VISU_ICON_TITLE ;?>"/> 
    de la colonne &quot;<span class="TextenoirGras"><?php echo _LANG_TPL_COL_ACTIONS ;?></span>&quot;, ou le 
    lien sur le &quot;<a href="#"><?php echo _LANG_TPL_COL_NOMPRE ;?></a>&quot; permet de visualiser les <?php echo _LANG_TITRE_VISU_FICHE_ADHT ;?> de la fiche <?php echo ADHERENT_BENE ;?> pour cette ligne, et de modifier &eacute;ventuellement ces informations.<br/>
    - l'ic&ocirc;ne <img src="../images/icones16/i_folder.png" width="16" height="16" alt="Fichier" title="<?php echo _LANG_ADMIN_LISTE_ADHT_ADDFILE_TITLE ;?>"/> 
    de la colonne &quot;<span class="TextenoirGras"><?php echo _LANG_TPL_COL_ACTIONS ;?></span>&quot; donne 
    acc&egrave;s au gestionnaire de fichiers qui permet d'ajouter depuis votre 
    ordinateur vers le serveur (Upload) des fichiers <?php echo ADHERENT_BENE ;?> 
    pour cette ligne.<br />
    - l'ic&ocirc;ne <img src="../images/icones16/i_euro.png" width="16" height="16" alt="" title="<?php echo _LANG_ADMIN_LISTE_ADHT_COTIS_ICON_TITLE ;?>"/> 
    de la colonne &quot;<span class="TextenoirGras"><?php echo _LANG_TPL_COL_ACTIONS ;?></span>&quot; donne 
    acc&egrave;s au gestionnaire des cotisations qui permet :<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;- Si la &quot;Fiche cotisation&quot; existe, de visualiser 
    les cotisations de la fiche <?php echo ADHERENT_BENE ;?> de la ligne, et de 
    modifier &eacute;ventuellement ces informations, <br/>
    &nbsp;&nbsp;&nbsp;&nbsp;- Si la &quot;Fiche cotisation&quot; n'existe pas, 
    d'en cr&eacute;er une,<br/>
    <span class="TextenoirGras"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;si le niveau 
    de priorit&eacute; vous y autorise</span>. <br/>
    - l'ic&ocirc;ne <img src="../images/icones16/i_delete.png" width="16" height="16" alt="" title="<?php echo _LANG_ADMIN_LISTE_ADHT_DEL_FICHE_ICON_TITLE ;?>"/> 
    de la colonne &quot;<span class="TextenoirGras"><?php echo _LANG_TPL_COL_ACTIONS ;?></span>&quot; supprime 
    virtuellement la fiche de la liste sauf si la date de fin de cotisation est 
    sup&eacute;rieure &agrave; la date du jour (il est possible de r&eacute;activer une &quot;Fiche&quot; supprim&eacute;e. La fiche supprim&eacute;e est toujours gard&eacute;e en base de donn&eacute;es)<br/>
	Nota : il est conseill&eacute; d'archiver la fiche cotisation avant de supprimer la fiche <?php echo ADHERENT_BENE ;?>.
	</p>
  <p>Si la s&eacute;lection est &quot;<span class="TextenoirGras"><?php echo ($T_AFFICHE_FILTRE_MEMBRES[3]) ;?></span>&quot; 
    :<br/>
    - l'ic&ocirc;ne <img src="../images/icones16/i_voir.png" width="16" height="16" alt="" title="<?php echo _LANG_LISTE_ADHT_VISU_ICON_TITLE ;?>"/> 
    de la colonne &quot;<span class="TextenoirGras"><?php echo _LANG_TPL_COL_ACTIONS ;?></span>&quot; permet 
    de consulter la fiche supprim&eacute;e pour cette ligne (Eventuellement de 
    r&eacute;activer cette fiche <span class="TextenoirGras">si le niveau de priorit&eacute; 
    vous y autorise</span>).</p>

<span class="TextenoirR">&nbsp;&nbsp;<a href="#" onclick="self.close();">Fermer cette fen&ecirc;tre</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:window.print()">Imprimer cette page</a></span>
</div>
</body>
</html>

