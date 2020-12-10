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
 * @version : 2020
 * @copyright 2007-2020  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */

/**
 *  Directory :  /ROOT_DIR_GESTASSO/install/
 *  Fichier :   index.php
 *  Installation du système
 *  ENCODAGE UTF-8 sans BOM
*/


//@error_reporting(E_ALL); // Décommenter pour debug

	// Raz de variables
	$accesstemp1 = $accesstemp2 = $accesstemp3 = $accesstemp4 = $accesstemp5 = $accesstemp6 = $accesstemp7 = '';

	// le repertoire des fichiers du système GestAssoPhp = ROOT_DIR_GESTASSO défini dans le fichier fileloc_gestasso_sa.php à la racine
	$file_loc = 'fileloc_gestasso_sa.php';
	// Test si le fichier fileloc_gestasso_xx existe
	$fileloc = '../../'.$file_loc;
	if (!file_exists ($fileloc) ) {
		echo "<br /><br /><br /><br /><strong>V&eacute;rifier votre installation.....</strong>strong><br /><br /> le fichier $fileloc est absent à la racine ... <br /><br /><br /><br />";
		exit;
	}

	// Sécurité si après installation (donc fichier/config/connexion.cfg.php présent) le dossier /install/ n'est pas renommé ou supprimé
	if  (file_exists ("../config/connexion.cfg.php"))  { 	// fichier connexion.cfg.php présent
		if (file_exists ("../install") ) {					// dossier /install/ n'est pas renommé ou supprimé
			echo "<br /><br /><br /><br /><strong>S&eacute;curit&eacute; de votre installation.....</strong><br /><br /> le fichier de configuation connexion.cfg.php est présent. <br />Mais <br /> le r&eacute;pertoire d'installation /install n'a pas &eacute;t&eacute; renomm&eacute; ou supprim&eacute;<br /><br /><br />";
			exit;
		}
	}


/***** TEST sur la version de PHP */

			$minPHPVersion = "5.6.0"; // ATTENTION PHP MINI = 5.6.0
			$PHPVersion = phpversion();
			if (phpversion() < $minPHPVersion) {
				echo "<br /><br />Votre version PHP : $PHPVersion&nbsp;&nbsp;<span class='TexterougeGras'>- Donc Erreur : PHP $minPHPVersion minimum pour une fonctionnement normal.</span>";
				echo "<br /><br /><br /><span class='TexterougeGras'>VERIFIER et MODIFIER Votre version PHP avant de continuer ...<br />Liser la FAQ ou contacter votre h&eacute;bergeur !!</span><br /><br /></body></html>";
				exit;
			}

/***** Test si les libs existent */

	$libadodb = '../../lib/adodb'; // défintion du dossier - Gestion de base de données MySql et POstgreSql : ADOdb
	if (!file_exists ($libadodb) ) {
		echo "<span class='TexterougeGras'><br /><br /><br /><br />V&eacute;rifier votte installation.....<br /><br /> le dossier $libadodb est absent &agrave; la racine ... <span><br /><br /><br /><br />";
		exit;
	}
	$libsmarty = '../../lib/smarty'; // défintion du dossier - Système de template : Smarty
	if (!file_exists ($libsmarty) ) {
		echo "<span class='TexterougeGras'><br /><br /><br /><br />V&eacute;rifier votte installation.....<br /><br /> le dossier $libsmarty est absent &agrave; la racine ... <span><br /><br /><br /><br />";
		exit;
	}

	include_once 'include_install.php'; // les variables + les définitions des répertoires
	$masession = new sessions(); // -->la classe session
	session_unset(); // RAZ
	session_destroy(); // RAZ
// echo "DEBUG 1= ". TEMPLATES_LOCATION_INSTAL;  // DEBUG

/*** Affichage page HTML */
?>

<!doctype html>
<html lang='fr' dir='ltr'>
<head>
    <meta charset="UTF-8">
	<meta name="author" content="JCE" />
	<meta name="Description" content="<?php echo VERSION_I ?>">
	<meta name="ROBOTS" content="noindex, nofollow">
	<meta name="keywords" lang="fr" content="GestAssoPhp, gestion, association">
	<link rel="stylesheet" type="text/css" media="screen"  href="../js/<?php echo STYLE_I ?>"/>
	<!-- link rel="stylesheet" type="text/css" media="screen"  href="../js/style_screen.css"/ -->
	<title>GestAssoPhp+Pg - Installation</title>
</head>
<body>


<div id="conteneur_page">
    <header class="header_page">Installation de GestAssoPhp+Pg</header>
	<div class="gauche_page">
	<nav>&nbsp;<br />
			<h1>Installation</h1>
			<ul>
			<li>Etape 1</li>
			<li>&nbsp;...</li>
			<li>&nbsp;...</li>
			<li>&nbsp;...</li>
			<li>&nbsp;...</li>
			</ul>
	</nav>
	<br /><br /><br />
	<div class="centre-txt"><img src='../images/logo/logo_gestassophp.gif' alt="Logo" width="128" height="20" title="Logo GestAssoPhp"/><br /><br /><a rel="license" href="http://creativecommons.org/licenses/by-sa/2.0/fr/" target="_blank"><img src='../images/licence/ccby-sa88x31.png' alt="Creative Commons License" width="88" height="31" title="mise à disposition sous un contrat Creative Commons"/></a><br /><br /><span class="TextenoirR"><a href="../doc/CCBY-SA-France.htm" target="_blank" title="Contrat Creative Commons" >Licence</a></span><br /><br /></div>
		</div> <!-- gauche_page -->

<section class="section_centre_page">

    <div id="titre">&nbsp;V&eacute;rification de la configuration PHP et des permissions r&eacute;pertoires</div>
	<div class="ligne_coul"></div>
	<div id="contenu">

	<br /><span class='TexterougeGras'>* Avant toute installation v&eacute;rifier les informations sur le fichier <a href="../doc/lisez_moi.txt">lisez_moi.txt</a></span>
	<br /><br /><br />
	<span class='TextenoirGras'>V&eacute;rification version PHP minimum (PHP 5.6.x):</span>
	<br />
<?php
// Version de PHP
			//$minPHPVersion = "5.6.0"; // ATTENTION PHP mini
			// $PHPVersion = phpversion();
			if (phpversion() >= $minPHPVersion) {
				echo "Votre version : (PHP $PHPVersion) est <span class='TextevertGras'>OK</span>";
				$miniPHPVer = false;
			} else {
				echo "(PHP $PHPVersion)&nbsp;&nbsp;<span class='TexterougeGras'>Erreur : PHP $minPHPVersion minimum.</span>";
				$miniPHPVer = true;
			}
?>

	<br /><br />
	<span class='TextenoirGras'>V&eacute;rification permissions d'&eacute;criture pour les templates :</span>
	<br />
<?php
// Fichiers template
			if (is_writeable(TMP_LOCATION)) {
				echo "<span class='TextevertGras'>OK</span> (".TMP_LOCATION.")<br />";
				$accesstemp1 = false;
			} else 	{
			$accesstemp = true;
				echo TMP_LOCATION."&nbsp;&nbsp;<span class='TexterougeGras'>Erreur : V&eacute;rifier les droits sur le serveur (selon hébergement).</span><br />";
				$accesstemp1 = true;
			}
			if (is_writeable(TMP_TEMPLATES_C_LOCATION)) {
				echo "<span class='TextevertGras'>OK</span> (".TMP_TEMPLATES_C_LOCATION.")<br />";
				$accesstemp2 = false;
			} else 	{
				echo TMP_TEMPLATES_C_LOCATION."&nbsp;&nbsp;<span class='TexterougeGras'>Erreur : V&eacute;rifier les droits sur le serveur (selon hébergement).</span><br />";
				$accesstemp2 = true;
			}
// Fichiers Photo
	echo "<br /><span class='TextenoirGras'>V&eacute;rification permissions d'&eacute;criture pour les Photos :<br /></span>";
			if (is_writeable(DIR_PHOTOS)) {
				echo "<span class='TextevertGras'>OK</span> (".DIR_PHOTOS.")<br />";
				$accesstemp3 = false;
				} else 	{
				echo DIR_PHOTOS."&nbsp;&nbsp;<span class='TexterougeGras'>Erreur : V&eacute;rifier les droits sur le serveur  (selon hébergement).</span><br />";
				$accesstemp3 = true;
			}
// Fichiers Adhérents
	echo "<br /><span class='TextenoirGras'>V&eacute;rification permissions d'&eacute;criture pour les fichiers adh&eacute;rents :<br /></span>";
			if (is_writeable(DIR_FILES_ADHTS)) {
				$accesstemp4 = false;
			echo "<span class='TextevertGras'>OK</span> (".DIR_FILES_ADHTS.")<br />";
			} else 	{
				echo DIR_FILES_ADHTS."&nbsp;&nbsp;<span class='TexterougeGras'>Erreur : V&eacute;rifier les droits sur le serveur (selon hébergement).</span><br />";
				$accesstemp4 = true;
			}

// Répertoire /config pour installation
	echo "<br /><span class='TextenoirGras'>V&eacute;rification permissions d'&eacute;criture pour le r&eacute;pertoire /config :<br /></span>";
			if (is_writeable(ROOT_DIR_GESTASSO.DIRECTORY_SEPARATOR.'config/')) {
				$accesstemp6 = false;
			echo "<span class='TextevertGras'>OK</span> (".ROOT_DIR_GESTASSO.DIRECTORY_SEPARATOR."config) <br />";
			} else 	{
				echo ROOT_DIR_GESTASSO.DIRECTORY_SEPARATOR."'config/&nbsp;&nbsp;<span class='TexterougeGras'>Erreur : V&eacute;rifier les droits sur le serveur (selon h&eacute;bergement).</span><br />";
				$accesstemp6 = true;
			}

// Fichiers de sessions		// Attention pour pagesperso FREE.fr il faut un dossiers sessions à la racine
	echo "<br /><span class='TextenoirGras'>V&eacute;rification du r&eacute;pertoire sessions :</span><br />";
			if (function_exists('session_start')) {
				echo "<span class='TextevertGras'>OK</span> sauvegarde des sessions<br />";
				$accesstemp7 = false;
				} else 	{
				echo "&nbsp;&nbsp;<span class='TexterougeGras'>Erreur : V&eacute;rifier les droits sur les sessions.</span><br />";
				$accesstemp7 = true;
			}


		if($miniPHPVer || $accesstemp1 || $accesstemp2|| $accesstemp3|| $accesstemp4|| $accesstemp5|| $accesstemp6 || $accesstemp7)
			// SI erreur donc pas de bouton pour continuer
			{
			echo "<br /><br /><br /><span class='TexterougeGras'>VERIFIER et MODIFIER les donn&eacute;es avant de continuer ...</span><br /><br />";
?>
				<br /><div class="centre-txt"><br /><form method="post" name="installation" action="index.php">
				<input type="submit" class="submit_ok" name="Recommencer" value="Recommencer" title="Recommencer"/>
				<!--input type="hidden" name="valid1" value="valid1"/ -->
				</form><br /></div>
<?php
			} else {// si Ok on continue
?>
				<br /><div class="centre-txt"><br /><form method="post" name="installation" action="install_2.php">
				<input type="submit" class="submit_ok" name="Continuer" value="Continuer" title="Continuer"/>
				<input type="hidden" name="valid1" value="valid1"/>
				</form><br /></div>
<?php
			}
?>


</div>	<!--  / contenu  -->

</section>	<!-- / centre_page -->
	<footer class="footer_pied_page">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://gestassophp.free.fr/cms/index.php/home/installation-du-systeme.html" target="_blank" title="Gestion des associations - Installation">Version : <?php echo VERSION_I ?></a>
    </footer>

</div> <!-- / conteneur_page  -->

</body>
</html>
