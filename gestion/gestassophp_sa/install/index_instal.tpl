 {* Installation de GestAssoPhp+Pg index_install.tpl copyright 2007-2018  (c) JC Etiemble HTML5*}
<!doctype html>
<html lang='fr' dir='ltr'>
<head>
	{* ne pas modifier les métas *}	
    <meta charset="UTF-8">
	<meta name="author" content="JCE" />
	<meta name="Description" content="{$version_i}">
	<meta name="ROBOTS" content="noindex, nofollow">
	<meta name="keywords" lang="fr" content="GestAssoPhp, gestion, association">
	<link rel="stylesheet" type="text/css" media="screen"  href="../js/{$style_i}"/>
	<!-- link rel="stylesheet" type="text/css" media="screen"  href="../js/style_screen.css"/ -->
	<title>GestAssoPhp+Pg - Installation</title>
</head>
<body>

<div id="conteneur_page">
    <header class="header_page">Installation de GestAssoPhp+Pg</header>	
	<div class="gauche_page">
	<nav class="menu_page">&nbsp;<br />
			<h1>Installation</h1>
			<ul>
			<li>{$Etape1}&nbsp;</li>
			<li>{$Etape2}&nbsp;</li>				
			<li>{$Etape3}&nbsp;</li>
			<li>{$Etape4}&nbsp;</li>
			<li>{$Etape5}&nbsp;</li>				
			</ul>
	</nav>
	<br /><br /><br />
	<div class="centre-txt"><img src='../images/logo/logo_gestassophp.gif' alt="Logo" width="128" height="20" title="Logo GestAssoPhp"/><br /><br /><a rel="license" href="http://creativecommons.org/licenses/by-sa/2.0/fr/" target="_blank"><img src='../images/licence/ccby-sa88x31.png' alt="Creative Commons License" width="88" height="31" title="mise Ã  disposition sous un contrat Creative Commons"/></a><br /><br /><span class="TextenoirR"><a href="../doc/CCBY-SA-France.htm" target="_blank" title="Contrat Creative Commons" >Licence</a></span><br /><br /></div>		
		</div> <!-- gauche_page -->

	<div class="section_centre_page">  {*défini les infos .. *}
	{$content}
	</div> {* / défini les infos .. *}
	
	<footer class="footer_pied_page">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://gestassophp.free.fr/" target="_blank" title="Gestion des associations" >Version : {$version_i}</a>
    </footer>
	
</div> <!-- / conteneur_page  -->

</body>
</html>
