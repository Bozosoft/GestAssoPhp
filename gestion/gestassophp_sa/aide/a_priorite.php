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
	<title>GestAssoPhp+ Aide - <?php echo _LANG_TITRE_ADMIN_GERER_PRIORITE_ADHERENTS ;?></title>
</head>
<body>

<p class="AfficheTitre"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20" title="Aidez-moi"/>
<span class="AfficheTitre14"><?php echo _LANG_TITRE_ADMIN_GERER_PRIORITE_ADHERENTS ;?></span><br />
</p>
<div id="contenu">
<p class="Textenoir">&nbsp;<br />
    Cette page permet de gérer les accès des "<?php echo ADHERENT_BENE ;?>s" grâce 
    à un code de priorité :<br />
<?php
 include_once 'a_codepriorite.php';  
 ?><br /><br /><br />

Il faut sélectionner "<?php echo ADHERENT_BENE ;?>" puis. <br />
choisir le "<?php echo _LANG_ADMIN_PRIORITE_CODE_PRIORITE ;?>", puis <span class="submit_ok"><?php echo _LANG_TPL_VALID_BUTTON ;?></span><br />
L'affichage montre les adhérents qui ont un "<?php echo _LANG_ADMIN_PRIORITE_CODE_PRIORITE ;?>" <span class="TextenoirGras">autre que 1</span>.<br /><br />
Il est possible d'effectuer un tri en cliquant sur les colonnes : <span class="TextebleuGras"><?php echo _LANG_TPL_COL_NUM.', '. _LANG_TPL_COL_NOMPRE.', '. _LANG_ADMIN_PRIORITE_COL_PRIORITE ;?></span>.
</p>
<p><span class="TextenoirGras">Nota :</span> il est <span class="TexterougeGras">obligatoire changer le niveau de priorité à 0</span> avant de supprimer une fiche <?php echo ADHERENT_BENE ;?>. Sinon un message d'erreur est affiché.</p>
<p>&nbsp;</p> 

<span class="TextenoirR">&nbsp;&nbsp;<a href="#" onclick="self.close();">Fermer cette fen&ecirc;tre</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:window.print()">Imprimer cette page</a></span>
</div>
</body>
</html>

