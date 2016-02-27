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
	<title>GestAssoPhp+ Aide - <?php echo _LANG_TITRE_ADMIN_PREFERENCES ;?></title>
</head>
<body>

<p class="AfficheTitre"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20" title="Aidez-moi"/>
<span class="AfficheTitre14"> <?php echo _LANG_TITRE_ADMIN_PREFERENCES ;?></span><br />
</p>
<div id="contenu"> 
  <p class="Textenoir">&nbsp;<br />
    Cette page permet une modification des informations qui sont les données pour l'affichage de l'association et une information sur l'évolution de la version
    <br/><span class="TextenoirGras">Cette page comporte 4 onglets :</span><br /><br />
	
	-1 <span class="TextenoirGras"><?php echo _LANG_TITRE_ADMIN_PREFTAB1 ;?></span> 
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
	-2 <span class="TextenoirGras"><?php echo _LANG_TITRE_ADMIN_PREFTAB2 ;?></span><br />
	&nbsp;&nbsp;<span class="TextenoirGras"><?php echo _LANG_PREF_COL_DESIGNATION_ACTIV ;?></span><br /> Exemple dans une association une activité de base (celle par défaut dans la fiche <?php echo _LANG_GESTION_FICHE_ADHT;?>) et des activés autres de reliure, danse, aide aux devoirs ...<br />
	- L'ic&ocirc;ne <img src="../images/icones16/i_modif.png" width="16" height="16" alt="" title="<?php echo  _LANG_LISTE_COTIS_ADHT_MODIF_ICON_TITLE ;?>"/> 
    de la colonne &quot;<span class="TextenoirGras"><?php echo _LANG_TPL_COL_ACTIONS ;?></span>&quot;, permet 
    de modifier &eacute;ventuellement ces 
    informations.<br/><br />
	
	-3 <span class="TextenoirGras"><?php echo _LANG_TITRE_ADMIN_PREFTAB3 ;?></span><br />
	&nbsp;&nbsp;<span class="TextenoirGras"><?php echo _LANG_PREF_COL_DESIGNATION_COTIS ;?></span> et 
	&nbsp;&nbsp;<span class="TextenoirGras"><?php echo _LANG_PREF_NEW_MONT_COTISATION ;?></span>
      <br/>
      - L'ic&ocirc;ne <img src="../images/icones16/i_modif.png" width="16" height="16" alt="" title="<?php echo  _LANG_LISTE_COTIS_ADHT_MODIF_ICON_TITLE ;?>"/> 
    de la colonne &quot;<span class="TextenoirGras"><?php echo _LANG_TPL_COL_ACTIONS ;?></span>&quot;, permet 
    de modifier &eacute;ventuellement ces 
    informations.<br/><br />
	-4 <span class="TextenoirGras">Information de la version</span> 
	<br/>
	&nbsp;&nbsp;<span class="TextenoirGras">le num&eacute;ro de la version en cours : </span><?php echo VERSION ;?><br/>
	&nbsp;&nbsp;<span class="TextenoirGras">les informations d'évolution du système : </span>le fichier Changelog.txt
	<br/><br/>
	NOTE : vous pouvez modifier le fichier lang.php contenu dans le dossier /config/ pour adapter vos textes. Nota ce fichier doit impérativement être sauvegardé en utf-8.
	
</p>

<span class="TextenoirR">&nbsp;&nbsp;<a href="#" onclick="self.close();">Fermer cette fen&ecirc;tre</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:window.print()">Imprimer cette page</a></span>
</div>
</body>
</html>
