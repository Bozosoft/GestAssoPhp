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
    <title>GestAssoPhp Aide - <?php echo _LANG_LOGIN_ADHERENT ;?></title>
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
<span class="AfficheTitre14"><?php echo _LANG_LOGIN_ADHERENT ;?></span><br />
</p>
<div id="contenu">
<p class="Textenoir">&nbsp;<br />
- Bienvenue dans la gestion de l'association "<?php echo NOM_ASSO_GESTASSOPHP ;?>".<br />
Le but de cet espace est de pouvoir gérer les membres et leur cotisation.<br />
Les administrateurs peuvent inscrire et modifier des membres, et effectuer des opérations de gestion.
Chaque membre bénéficie de la possibilité de consulter et de modifier ses informations.<br />
 Il peut éventuellement pourvoir consulter les informations sur les autres membres, si ceux-ci ont donné leur accord sur "l'affichage de ces données".
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

