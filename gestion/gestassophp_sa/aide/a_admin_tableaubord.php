<?php
/**
 * Projet : gestassophp_sa [GestAssoPhp+Pg]
 * ---------------------------
 * Licence Creative Commons selon les termes du présent contrat appelé Contrat Public Creative Commons
 * Auteur original : Jean-Claude Etiemble
 * @link :  http://creativecommons.org/licenses/by-sa/2.0/fr/  - Paternité - Partage à l'Identique 2.0 France (CC BY-SA 2.0)
 * ---------------------------
 *
 * @author :  JC Etiemble - http://jc.etiemble.free.fr
 * @version : 2022
 * @copyright 2007-2022  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */

/**
 *  Directory :  /ROOT_DIR_GESTASSO/aide/
 *  Fichier :	a_admin_tableaubord.php
 *  Affiche l'aide pour le Tableau de bord - Administration
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
	<link rel="stylesheet" type="text/css" media="screen"  href="../js/style_screen.css">
	<link rel="stylesheet" type="text/css" media="print"  href="../js/style_print.css">
	<title>GestAssoPhp+ Aide - <?php echo _LANG_TITRE_ADMIN_TABLEAUBORD ;?></title>
</head>
<body>

<p class="AfficheTitre"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20" title="Aidez-moi">
<span class="AfficheTitre14"><?php echo _LANG_TITRE_ADMIN_TABLEAUBORD ;?></span><br>
</p>
<div id="contenu">
  <p class="Textenoir">&nbsp;<br>
    Cette page affiche un r&eacute;capitulatif de la gestion de l'association
    : <br>
    <br>
    - la ligne <span class="TextenoirGras">"<?php echo ADHERENT_BENE ;?>s"</span>
    donne le nombre d'inscrits depuis <?php echo DATE_DEBANNEE_ASSO ;?> et le
    nombre de cotisants ainsi que le montant cotisations. En cliquant sur le nombre,
    une fiche donne les détails.<br>

      - la ligne <span class="TextenoirGras">"<?php echo _LANG_TITRE_ADMIN_LISTE_COTIS_ADHT ;?>"</span>
    donne le montant des <?php echo _LANG_LISTE_COTIS_ADHT_COTISS;?>  depuis <?php echo DATE_DEBANNEE_ASSO ;?> et le montant des <?php echo _LANG_LISTE_COTIS_ADHT_COTISS;?> en cours.<br>

    - la ligne <span class="TextenoirGras">"<?php echo _LANG_LISTE_FICHIERS_ADHT_DOWNLOAD_FILE_ICON_TITLE;?> <?php echo ADHERENT_BENE ;?>s"</span> permet de télécharger une liste <?php echo _LANG_MESSAGE_FICHE_COT_ECHUE;?> et <?php echo _LANG_MESSAGE_FICHE_COT_NONOK;?> à la date du <?php echo date('d/m/Y');?> (Date du jour).
    <br><br>
    <span class="TextenoirGras">Suivant la priorité, </span> qui vous a été attribuée
    des menus sont accessibles ou non :<br>
  <span class="Textenoir">Sur cette page :  </span><br>
	- La priorité <span class="TextenoirGras">4 = Membre du CA</span> consutation seulement<br>
	- Les priorités <span class="TextenoirGras">5 = Secrétaire, 7 = Trésorier, 9 = Admin</span> ont la possibilité de toutes les actions et en particulier de télécharger les fichiers.</p>


  - <span class="TextenoirGras">Pour l'export du fichier des "<?php echo ADHERENT_BENE ;?>s"</span> (adherents.xls) sur chaque ligne de la colonne &quot;Societaire&quot; :<br>
- si vide il n'y a aucune cotisation en cours ou une ou plusieurs cotisations sont &eacute;chues,<br>
- si &quot;s&quot; une cotisation est en cours avec une date de fin cotisation non &eacute;chue,<br>
- si &quot;xx&quot; toutes les cotisations "<?php echo ADHERENT_BENE ;?>" sont archiv&eacute;es, <br>
- si &quot;999&quot; la fiche "<?php echo ADHERENT_BENE ;?>" a &eacute;t&eacute; supprim&eacute;e (mais la fiche est r&eacute;activable).<br><br>

    - <span class="TextenoirGras">Pour télécharger un fichier</span>, apr&egrave;s
    avoir positionné la souris sur le nom l'icône <img src="../images/icones16/disque16.png" alt="Télécharger" title="Télécharger le fichier">
    de la ligne concernée, cliquer sur l'icône, ou cliquer sur le bouton droit
    de la souris puis "Enregistrer le cible sous..." pour t&eacute;l&eacute;charger
    le fichier vers votre ordinateur. <br>
	Le format du fichier t&eacute;l&eacute;charg&eacute; est compatible <a href="http://fr.libreoffice.org/" target="_blank">LibreOffice Calc</a> (séparateur des colonnes tabulation).<br>

	<table style="border-spacing: 10px;">
		<tbody>
		<tr>
			<td style="width: 60%;">Pour importer sous LibreOffice Calc, utiliser la fonction "Ouvrir avec LibreOffice" et lors de la fenêtre "Import...", régler les paramètres suivant l'image ci dessous (cliquer sur l'image pour l'agrandir)</td>
			<td style="width: 40%;"><a href="import_lbo.jpg"><img src='import_lbo_r.jpg' alt="import" width="100" height="84" title="import"></a></td>
		</tr>
		</tbody>
	</table>

<span class="TextenoirR">&nbsp;&nbsp;<a href="#" onclick="self.close();">Fermer cette fen&ecirc;tre</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:window.print()">Imprimer cette page</a></span>
</div>
</body>
</html>
