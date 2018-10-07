<?php
/**
 * Projet : gestassophp_sa [GestAssoPhp+Pg]
 * Basé sur Gestion membres Pour CAP Compétences Version originale avril 2003 et sur la version Pour FB-Rouen 2007  (c) JC Etiemble 
 * ---------------------------
 * Licence Creative Commons selon les termes du présent contrat appelé Contrat Public Creative Commons 
 * Auteur original : Jean-Claude Etiemble
 * @link :  http://creativecommons.org/licenses/by-nc-sa/2.0/fr/  - Paternité - Pas d'Utilisation Commerciale - Partage des Conditions Initiales à l'Identique 2.0 France
 * Vous êtes libres : de reproduire, distribuer et communiquer cette création au public, de modifier cette création
 * Selon les conditions suivantes : 
 * Paternité. Vous devez citer le nom de l'auteur original de la manière indiquée par l'auteur de l'oeuvre ou le titulaire des droits qui vous confère cette autorisation 
 * Pas d'Utilisation Commerciale. Vous n'avez pas le droit d'utiliser cette création à des fins commerciales. 
 * Partage des Conditions Initiales à l'Identique.  
 * Si vous modifiez, transformez ou adaptez cette création, vous n'avez le droit de distribuer la création qui en résulte que sous un contrat identique à celui-ci
 *
 * Chacune de ces conditions peut être levée si vous obtenez l'autorisation du titulaire des droits sur cette oeuvre.
 * Rien dans ce contrat ne diminue ou ne restreint le droit moral de l'auteur ou des auteurs.
 *
 * Code Juridique (la version intégrale du contrat). http://creativecommons.org/licenses/by-nc-sa/2.0/fr/legalcode
 * Copie de la licence - Contrat Public Creative Commons   /doc/CCA-NA-France.htm
 * Auteur original : Jean-Claude Etiemble
 * ---------------------------
 *	
 * @author : JC Etiemble - http://jc.etiemble.free.fr
 * @version :  2018
 * @copyright 2007-2018  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */
 
/**
 *  Directory :  /ROOT_DIR_GESTASSO/install/
 *   Fichier :
 *   Installation du système
 * ENCODAGE UTF-8 sans BOM
*/


	

//@error_reporting(E_ALL); // debug
	// Raz de variables
	$accesstemp1 = $accesstemp2 = $accesstemp3 = $accesstemp4 = $accesstemp5 = $accesstemp6 = $accesstemp7 = '';
	
	$file_loc = 'fileloc_gestasso_sa.php';   //******************** A DEFINIR
	// Test si  fileloc existe
	$fileloc = '../../'.$file_loc; // défintion du fichier pour définir  ROOT_DIR
	if (!file_exists ($fileloc) ) {
		echo "<span class='TexterougeGras'><br /><br /><br /><br />V&eacute;rifier votte installation.....<br /><br /> le fichier $fileloc est absent à la racine ... <span><br /><br /><br /><br />";
		exit;
	}

//*******************************************************************		
// TEST Version de PHP car les utilisateur ne font pas attention !!
			$minPHPVersion = "5.6.0"; // ATTENTION PHP
			$PHPVersion = phpversion();
			if (phpversion() < $minPHPVersion) {
				echo "<br /><br />Votre version PHP : $PHPVersion&nbsp;&nbsp;<span class='TexterougeGras'>- Donc Erreur : PHP $minPHPVersion minimum pour une fonctionnement normal.</span>";
				echo "<br /><br /><br /><span class='TexterougeGras'>VERIFIER et MODIFIER Votre version PHP avant de continuer ...<br />Liser la FAQ ou contacter votre h&eacute;bergeur !!</span><br /><br /></body></html>";
				exit;
			}
//*******************************************************************	
	
	// Test si  les libs existe
	$libadodb = '../../lib/adodb'; // défintion du fichier pour définir  ROOT_DIR
	if (!file_exists ($libadodb) ) {
		echo "<span class='TexterougeGras'><br /><br /><br /><br />V&eacute;rifier votte installation.....<br /><br /> le dossier $libadodb est absent &agrave; la racine ... <span><br /><br /><br /><br />";
		exit;
	}	
	$libsmarty = '../../lib/smarty'; // défintion du fichier pour définir  ROOT_DIR
	if (!file_exists ($libsmarty) ) {
		echo "<span class='TexterougeGras'><br /><br /><br /><br />V&eacute;rifier votte installation.....<br /><br /> le dossier $libsmarty est absent &agrave; la racine ... <span><br /><br /><br /><br />";
		exit;
	}	
	
	include_once 'include_install.php'; // les variables + les définitions de répertoires
	$masession = new sessions(); // -->la classe session
	session_unset(); // RAZ
	session_destroy(); //  RAZ

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
	
	<br /><span class='TexterougeGras'>* Avant toute installation vérifier les informations sur le fichier <a href="../doc/lisez_moi.txt">lisez_moi.txt</a></span>
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
				echo TMP_LOCATION."&nbsp;&nbsp;<span class='TexterougeGras'>Erreur : V&eacute;rifier les droits sur le serveur (777).</span><br />";
				$accesstemp1 = true;
			}
			if (is_writeable(TMP_TEMPLATES_C_LOCATION)) {
				echo "<span class='TextevertGras'>OK</span> (".TMP_TEMPLATES_C_LOCATION.")<br />";
				$accesstemp2 = false;					
			} else 	{
				echo TMP_TEMPLATES_C_LOCATION."&nbsp;&nbsp;<span class='TexterougeGras'>Erreur : V&eacute;rifier les droits sur le serveur (777).</span><br />";
				$accesstemp2 = true;
			}
// Fichiers Photo
	echo "<br /><span class='TextenoirGras'>V&eacute;rification permissions d'&eacute;criture pour les Photos :<br /></span>";
			if (is_writeable(DIR_PHOTOS)) {
				echo "<span class='TextevertGras'>OK</span> (".DIR_PHOTOS.")<br />";
				$accesstemp3 = false;	
				} else 	{
				echo DIR_PHOTOS."&nbsp;&nbsp;<span class='TexterougeGras'>Erreur : V&eacute;rifier les droits sur le serveur  (777).</span><br />";
				$accesstemp3 = true;
			}	
// Fichiers Adhérents
	echo "<br /><span class='TextenoirGras'>V&eacute;rification permissions d'&eacute;criture pour les fichiers adh&eacute;rents :<br /></span>";		
			if (is_writeable(DIR_FILES_ADHTS)) {
				$accesstemp4 = false;	
			echo "<span class='TextevertGras'>OK</span> (".DIR_FILES_ADHTS.")<br />";
			} else 	{
				echo DIR_FILES_ADHTS."&nbsp;&nbsp;<span class='TexterougeGras'>Erreur : V&eacute;rifier les droits sur le serveur (777).</span><br />";
				$accesstemp4 = true;
			}	
		
// Répertoire /config pour installation
	echo "<br /><span class='TextenoirGras'>V&eacute;rification permissions d'&eacute;criture pour le r&eacute;pertoire /config :<br /></span>";		
			if (is_writeable(ROOT_DIR_GESTASSO.DIRECTORY_SEPARATOR.'config/')) {
				$accesstemp6 = false;	
			echo "<span class='TextevertGras'>OK</span> (".ROOT_DIR_GESTASSO.DIRECTORY_SEPARATOR."config) <br />";
			} else 	{
				echo ROOT_DIR_GESTASSO.DIRECTORY_SEPARATOR."'config/&nbsp;&nbsp;<span class='TexterougeGras'>Erreur : V&eacute;rifier les droits sur le serveur (777).</span><br />";
				$accesstemp6 = true;
			}		
	
// Fichiers sessions			
	echo "<br /><span class='TextenoirGras'>V&eacute;rification du r&eacute;pertoire sessions :</span><br />";	
			if (function_exists('session_start')) {
				echo "<span class='TextevertGras'>OK</span> sauvegarde des sessions<br />";
				$accesstemp7 = false;	
				} else 	{
				echo $sessionpath."&nbsp;&nbsp;<span class='TexterougeGras'>Erreur : V&eacute;rifier les droits sur les sessions.</span><br />";
				$accesstemp7 = true;
			}	

			
		if($miniPHPVer || $accesstemp1 || $accesstemp2|| $accesstemp3|| $accesstemp4|| $accesstemp5|| $accesstemp6 || $accesstemp7)  //erreur pas de bouton
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
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://gestassophp.free.fr/" target="_blank" title="Gestion des associations">Version : <?php echo VERSION_I ?></a>
    </footer>
	
</div> <!-- / conteneur_page  -->

</body>
</html>
