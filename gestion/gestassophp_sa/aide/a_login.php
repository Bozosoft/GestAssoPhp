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
	<title>GestAssoPhp+ Aide - <?php echo _LANG_LOGIN_ADHERENT ;?></title>
</head>
<body>

<p class="AfficheTitre"><img src='../images/icones/login.png' alt="Aide" width="36" height="36" title="Aidez-moi"/>
<span class="AfficheTitre14"><?php echo _LANG_LOGIN_ADHERENT ;?></span><br />
</p>
<div id="contenu">
<p class="Textenoir">&nbsp;<br />
<span class="TextenoirGras">Bienvenue dans la gestion de l'association "<?php echo NOM_ASSO_GESTASSOPHP ;?>".</span><br /><br />
Le but de cet espace est de pouvoir gérer les membres et leur cotisation.<br />
Les administrateurs peuvent inscrire et modifier des membres, et effectuer des opérations de gestion.
Chaque membre bénéficie de la possibilité de consulter et de modifier ses informations.<br />
 Il peut éventuellement consulter certaines informations sur les autres membres, si ceux-ci ont donné leur accord sur "l'affichage de ces données" par la consultation du menu <?php echo _LANG_MENU_ADHT_MEMBRES ;?>/<?php echo _LANG_MENU_ADHT_LISTE ;?>.
<br />
- Pour pouvoir utiliser cet espace, vous devez vous identifier avec votre "Login" et votre "Mot de passe".<br />

- Si vous avez oublié vos identifiants, cliquez sur le lien "<span class="TextebleuGras">J'ai oublié mon mot de passe !</span>" pour envoyer un mail à votre administrateur.<br />
<span class="TextenoirGras">Suivant la priorité, </span> qui vous a été attribuée des menus sont accessibles ou non :<br />
<?php
 include_once 'a_codepriorite.php';  
 ?> 
 
</p>
<p>&nbsp;</p>

<span class="TextenoirR">&nbsp;&nbsp;<a href="#" onclick="self.close();">Fermer cette fen&ecirc;tre</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:window.print()">Imprimer cette page</a></span>
</div>
</body>
</html>

