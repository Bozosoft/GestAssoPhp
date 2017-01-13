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
//include_once '../../fileloc_gestasso_s.php';  //----------Pour TEMPLATE et localise rep 
include_once '../config/connexion.php';
 $masession = new sessions(); 
 $priorite_adht = $_SESSION['ses_priorite_adht'];

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
	<title>GestAssoPhp Aide - <?php echo _LANG_TITRE_VISU_FICHE_ADHT ;?></title>
</head>
<body>

<p class="AfficheTitre"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20" title="Aidez-moi"/>
<span class="AfficheTitre14"><?php echo _LANG_TITRE_VISU_FICHE_ADHT ;?></span>
</p>
<div id="contenu"> 
  <p class="Textenoir">&nbsp;
    Cette page montre un r&eacute;capitulatif des informations <?php echo ADHERENT_BENE ; ?><br/>
    <br />
    Plusieurs zones d&eacute;finisse cette page :<br/>
    <span class="TextenoirGras">- <?php echo _LANG_VISU_FICHE_ADHT_RECAP ; ?></span> 
    :<br/>
    Le num&eacute;ro et date de cr&eacute;ation de la fiche, la date de modification 
    et les informations sur la(les) cotisation(s) et qui a enregistré la Fiche<br/>
    <span class="TextenoirGras">- <?php echo _LANG_GESTION_FICHE_ADHT ; ?></span> 
    :<br/>
    Affiche les informations administratives.<br/>
   - La zone "Oui/Non... afficher mes coordonnées consultables par les ..." permet de donner ou non la possibilité aux autres membres de consulter certaines informations personnelles par la consultation du menu <?php echo _LANG_MENU_ADHT_MEMBRES ;?>/<?php echo _LANG_MENU_ADHT_LISTE ;?><br/>

	-La zone <span class="TextenoirGras"><?php echo _LANG_FICHE_ADHT_ANT ; ?></span> à droite est une information sur l'activité principale définie dans les "<?php echo _LANG_GESTION_FICHE_ADHT ; ?>"<br/><br/>
    
 <?php	if ($priorite_adht > 4 ) { // AUTORISATION si 5-7-9 ?>
     Un formulaire d'envoi d'un mail pour le destinataire est possible en cliquant sur l'icône <img src="../images/icones16/i_mail.png" width="16" height="11" alt="" title="<?php echo _LANG_VISU_FICHE_ADHT_MAIL_TITLE ; ?>"/> de la ligne  <?php echo _LANG_FICHE_ADHT_MAIL; ?><br/>
    <?php	} ?>	
	<span class="TextenoirGras">- <?php echo _LANG_TITRE_FICHIER_MISSIONS ; ?></span> :
	<br/>
    Affiche les fichiers.<br/>
    <br/><br/>
	
   
    Note : Le bouton <span class="submit_ok"><?php echo _LANG_VISU_FICHE_ADHT_MODIF_BUTTON ; ?></span>&nbsp; (s'il est visible) 
    donne acc&egrave;s &agrave; la page de modification de ces donn&eacute;es.<br/>
    <br />
    <?php	if ($priorite_adht > 4 ) { // AUTORISATION si 5-7-9 ?>
    Si la Fiche a &eacute;t&eacute; <span class="Texterouge">supprimée</span>, 
    le bouton <span class="submit_del"><?php echo _LANG_VISU_FICHE_ADHT_REACTIV_BUTTON ; ?></span> permet 
    de r&eacute;activer cette fiche, <span class="TextenoirGras">si le niveau 
    de priorit&eacute; vous y autorise</span>. 
    <?php	} ?>
  </p>
  <p>&nbsp;</p>

<span class="TextenoirR">&nbsp;&nbsp;<a href="#" onclick="self.close();">Fermer cette fen&ecirc;tre</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:window.print()">Imprimer cette page</a></span>
</div>
</body>
</html>

