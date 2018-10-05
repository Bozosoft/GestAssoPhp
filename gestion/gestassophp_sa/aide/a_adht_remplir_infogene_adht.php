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
 * @version :  2018
 * @copyright 2007-2018  (c) JC Etiemble
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
	<title>GestAssoPhp Aide - <?php echo _LANG_GESTION_FICHE_ADHT ;?></title>
</head>
<body>

<p class="AfficheTitre"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20" title="Aidez-moi"/>
<span class="AfficheTitre14"><?php echo _LANG_GESTION_FICHE_ADHT ;?></span><br />
</p>
<div id="contenu"> 
  <p class="Textenoir">&nbsp;<br />
    Cette page permet de :</p>
  <p class="Textenoir"> 
    <?php	if ($priorite_adht > 4 ) { // AUTORISATION si 5-7-9 ?>
    - Cr&eacute;er une fiche <?php echo _LANG_GESTION_FICHE_ADHT ;?> : <span class="TextenoirGras">mode 
    <?php echo _LANG_MESSAGE_CREATE ;?></span> (Certains champs sont <span class="Texterouge">obligatoires</span>)<br/>
	&nbsp;&nbsp; Pour information :<br/>
	&nbsp;&nbsp; <?php echo _LANG_FICHE_ADHT_LOGIN_UPPER;?><br/>
	 &nbsp;&nbsp; le <?php echo _LANG_FICHE_ADHT_PASSWD410 ?><br/>De préférence 16 caractères en combinant des minuscules, majuscules avec les caractères _ -<br/><br/>
    - Consulter ou de modifier une fiche <?php echo _LANG_GESTION_FICHE_ADHT ;?> 
    : <span class="TextenoirGras">mode <?php echo _LANG_MESSAGE_MODIF ;?></span> (Les zones non modifiables 
    sont gris&eacute;es )<br/>
    	&nbsp;&nbsp;Avec la possibilit&eacute; de&nbsp; :<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;- de renseigner la zone &quot;<span class="TextenoirGras"><?php echo _LANG_FICHE_ADHT_COORD ;?></span> [consultables par TOUS...]&quot; afin de permettre ou non aux autres de voir vos informations<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;- de modifier son mot de passe dans la zone <span class="TextenoirGras">&quot;<?php echo _LANG_FICHE_ADHT_MODIF_PASSWD ;?>&quot;</span>, pour sa propre fiche et &eacute;ventuellement 
    sur les fiches des autres <?php echo ADHERENT_BENE ;?>s <span class="TextenoirGras"> 
    si le niveau de priorit&eacute; vous y autorise</span><br/>
    &nbsp;&nbsp;&nbsp;&nbsp;- <?php echo _LANG_FICHE_ADHT_UPLOAD_PHOTO;?> qui sera redimensionnée automatiquement à 66 pixels de larg et/ou 94 pixels de haut (<span class="TextenoirGras">Attention</span> celle ci doit être au format GIF ou JPEG de taille maxi 800x600)<br/> 
	    La zone "<?php echo _LANG_FICHE_ADHT_FICHE_ENR ;?>" est remplie automatiquement lors du premier enregistrement de la fiche.</p>
<br/><span class="TextenoirGras">Attention</span><br/>- la zone <?php echo _LANG_FICHE_ADHT_COMPL;?>	ne doit pas comporter de retour à la ligne (touche Entrée) afin de permettre un export correct du fichier "<?php echo ADHERENT_BENE ;?>s" au format tableur.<br/>
		- La zone "<span class="TextenoirGras"><?php echo _LANG_FICHE_ADHT_FICHE_ENR ;?></span> est remplie automatiquement lors du premier enregistrement de la fiche. Elle ne peut être modifiée que <span class="TextenoirGras">si le niveau de priorit&eacute; (9) vous y autorise</span><br/></p>
  <?php	}else { ?>
  - consulter ou de modifier une fiche <?php echo 'GESTION_FICHE_ADHERENT' ;?> : 
  <span class="TextenoirGras">mode <?php echo _LANG_MESSAGE_MODIF ;?></span> (Les zones non modifiables 
  sont gris&eacute;es )<br/>
  Avec la possibilit&eacute; de&nbsp; : <br/>
  &nbsp;&nbsp;&nbsp;&nbsp;- de renseigner la zone &quot;<span class="TextenoirGras"><?php echo _LANG_FICHE_ADHT_COORD ;?></span> [consultables par TOUS...]&quot; afin de permettre ou non aux autres de voir vos informations<br/>
  &nbsp;&nbsp;&nbsp;&nbsp;- de modifier son mot de passe dans la zone <span class="TextenoirGras">&quot;<?php echo _LANG_FICHE_ADHT_MODIF_PASSWD ;?>&quot;</span><br/>
  &nbsp;&nbsp;&nbsp;&nbsp;- <?php echo _LANG_FICHE_ADHT_UPLOAD_PHOTO;?> qui sera redimensionnée automatiquement à 66 pixels de larg et/ou 94 pixels de haut (<span class="TextenoirGras">Attention</span> celle ci doit être au format GIF ou JPEG de taille maxi 800x600)<br/>
  <span class="TextenoirGras">Attention</span><br/>- la zone <?php echo _LANG_FICHE_ADHT_COMPL;?>	ne doit pas comporter de retour à la ligne (touche Entrée) afin de permettre un export correct du fichier "<?php echo ADHERENT_BENE ;?>s" au format tableur.<br/>
  <br/> 

	
  <?php	} ?>
  <p>&nbsp;</p>

<span class="TextenoirR">&nbsp;&nbsp;<a href="#" onclick="self.close();">Fermer cette fen&ecirc;tre</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:window.print()">Imprimer cette page</a></span>
</div>
</body>
</html>

