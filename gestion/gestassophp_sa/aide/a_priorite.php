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
    <title>GestAssoPhp Aide - <?php echo _LANG_TITRE_ADMIN_GERER_PRIORITE_ADHERENTS ;?></title>
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
<span class="AfficheTitre14"><?php echo _LANG_TITRE_ADMIN_GERER_PRIORITE_ADHERENTS ;?></span><br />
</p>
<div id="contenu">
<p class="Textenoir">&nbsp;<br />
    Cette page permet de gérer les accès des "<?php echo ADHERENT_BENE ;?>"s grâce 
    à un code de priorité :<br />
<?php
 include_once 'a_codepriorite.php';  
 ?><br /><br /><br />

Il faut sélectionner "<?php echo ADHERENT_BENE ;?>" puis. <br />
choisir le "<?php echo _LANG_ADMIN_PRIORITE_CODE_PRIORITE ;?>", puis <span class="submit_ok"><?php echo _LANG_TPL_VALID_BUTTON ;?></span><br />
L'affichage montre les adhérents qui ont un "<?php echo _LANG_ADMIN_PRIORITE_CODE_PRIORITE ;?>" <span class="TextenoirGras">autre que 1</span>.<br /><br />
Il est possible d'effectuer un tri en cliquant sur les colonnes : <span class="TextebleuGras"><?php echo _LANG_TPL_COL_NUM.', '. _LANG_TPL_COL_NOMPRE.', '. _LANG_ADMIN_PRIORITE_COL_PRIORITE ;?></span>.
</p>
<p>&nbsp;</p> 

<span class="TextenoirR">&nbsp;&nbsp;<a href="#" onclick="self.close();">Fermer cette fen&ecirc;tre</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:window.print()">Imprimer cette page</a></span>
</div>
</body>
</html>

