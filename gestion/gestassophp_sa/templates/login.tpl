{* Projet : gestassophp_sa [GestAssoPhp+Pg] *}{* Affichage de la page Acccés avec Login et mot de passe  login.tpl copyright 2007-2022  ↄ⃝  JC Etiemble HTML5 *}
<!doctype html>
<html lang='fr' dir='ltr'>
<head>
{* ne pas modifier les métas *}
	<meta charset="{language name=charset}">
	<meta name="author" content="JCE">
	<meta name="Description" content="{$version}">
	<meta name="ROBOTS" content="noindex, nofollow">
	<meta name="keywords" lang="fr" content="GestAssoPhp, gestion, association">
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" media="screen"  href="js/style_screen.css">
{*  IE est non conforme aux standards - Ici IE version inférieure à 9 *}
	<!--[if lt IE 9]>
	{literal}
	<script src="js/html5shiv.min.js"></script>
	{/literal}
	<![endif]-->
	<title>GestAssoPhp+Pg pour g&eacute;rer votre association - {$version}</title>
</head>

<body onload="document.getElementById('login').focus()">
{* défini la page extérieure *}
<div id="conteneur_page">
{* défini le bandeau haut *}
    <header class="header_page">
			{$messagetitre} {$nom_asso_gestassophp}
{* Logo de votre asso est défini dans le fichier /js/style_screen.css avec l'image dans\images\logo\logo_asso.jpg *}
    </header>
{* / défini le bandeau haut *}

{* défini la zone gauche *}
	<div class="gauche_page">
		<nav>
			<h4>{language name = menu_adht_membres}</h4>
			<ul>
{if $priorite_adht == ''}
			<li>{language name=login_user}</li>
{/if}
{if $priorite_adht == '0'}
			<li>{language name=login_interdit}</li>
{/if}
{if $priorite_adht > 0}
			<li>&nbsp;&nbsp;<a href="index.php?logout=1" title="Se D&eacute;connecter">{language name = menu_exit}</a></li>
{/if}
			</ul>

		</nav>
		<br><br><br>
		<figure class="centre-txt">
			<img src='images/logo/logo_gestassophp.gif' alt="Logo" width="128" height="20" title="Logo GestAssoPhp+">
			<br><br>
			<a rel="license" href="http://creativecommons.org/licenses/by-sa/2.0/fr/" target="_blank"><img src='images/licence/ccby-sa88x31.png' alt="Creative Commons License" width="88" height="31" title="Syst&egrave;me mise &agrave; disposition sous un contrat Creative Commons"></a><br><br><figcaption  class="TextenoirR"><a href="./doc/CCBY-SA-France.htm" target="_blank" title="Contrat Creative Commons" >Licence</a></figcaption>
		</figure>
{* !! Supprimer cette ligne SI demo pour étourdis - Voir gestassophp_sa/index.php
			<figure class="centre-txt">
			<img src='images/icones/help.gif' alt="alerte" width="32" height="32" title="ATTENTION pour acc&egrave;s &agrave; la version d&eacute;monstration GestAssoPhp, Merci de remplir le formulaire">
			<p class="TexterougeR">Pour acc&egrave;s &agrave; la version d&eacute;monstration GestAssoPhp<br><a href="http://gestassophp.free.fr/cms/index.php/demo.html">Merci de remplir le formulaire</a><img src='images/icones/paire-de-lunettes-64.png' alt="lunettes" title="INUTILE de faire des essais avec DEMO ou TEST ou autres logins La *démo*, est sur demande UNIQUEMENT ! Pour cela : Merci de remplir le formulaire"></p>
			</figure>
 Supprimer cette ligne SI demo pour étourdis *}
	</div>
{* / défini la zone gauche *}

{* défini les informations de la page *}
	<div class="section_centre_page">

		<header class="header_titre_aide"><a href='#' style="cursor:pointer;" onclick="javascript :window.open('aide/a_login.php','popup','height=450,toolbar=no,location=no,directories=no,status=yes,width=660,resizable=no,scrollbars=yes,top=10,left=10')" title="{language name=title_aide}"><img src='images/icones/help.gif' alt="Aide" width="20" height="20">{language name = aide}</a></header>

		<header class="header_titre">&nbsp;{language name=login_adherent}</header>
		<div class="ligne_coul"></div>
{* défini le contenu .. *}
		<div id="contenu">
{* !! Supprimer cette ligne SI demo pour étourdis - Voir gestassophp_sa/index.php
		<div class="centre-txt">
			<h2><span class="erreur-Jaunerouge">l'acc&eacute;s n'est possible qu'apr&egrave;s remise de VOS identifiants personnels <u>sur demande</u> ! <br><u>INUTILE</u> de faire des essais avec DEMO ou TEST ou autres logins<br>La *d&eacute;mo*, est sur demande <u>UNIQUEMENT</u> ! <br>Pour cela : <a href="http://gestassophp.free.fr/cms/index.php/demo.html">Merci de remplir le formulaire</a></span> </h2>
		</div>
Supprimer cette ligne SI demo pour étourdis *}
{* défini l'accées Login MdP *}
			<div class="login-box">
			<br><img src='images/icones/login.png' alt="login" title="{language name=login_adherent_title}"><br>
			<form action="index.php" method="post">

						<label class="label_login" for="login">{language name=login_my_login}</label>
						<input type="text" name="login" id="login" title="{language name=login_enter_login}" value="" size="32" tabindex="1" onfocus="this.className='focus';" onblur="this.className='normal';" onchange="javascript:this.value=this.value.toUpperCase();">
	<br>
						<label class="label_login" for="password">{language name=login_my_passwd}</label>
						<input  type="password" name="password" id="password" title="{language name=login_enter_passwd}" value="" size="32" tabindex="2" onfocus="this.className='focus';" onblur="this.className='normal';">

				<br><br><br>
				<input type="submit" class="submit_ok" name="submit" value="{language name=login_button}" title="{language name=login_button_title}">
				<input type="hidden" name="ident" value="1">
			</form>

{* / défini l'accées Login MdP *}
			</div>
{* !! dSupprimer cette ligne SI demo pour étourdis - Voir gestassophp_sa/index.php
	<div class="centre-txt">
			<h1><span class="erreur-Jaunerouge"><u>INUTILE</u> de faire des essais avec DEMO ou TEST ou autres logins<br>La *d&eacute;mo*, est sur demande <u>UNIQUEMENT</u> ! <br>Pour cela : <a href="http://gestassophp.free.fr/cms/index.php/demo.html">Merci de remplir le formulaire</a></span></h1>
	</div>
Supprimer cette ligne SI demo pour étourdis *}
	<br>
			<footer class="centre-txt">
				<span class="TexterougeGras">&nbsp;{$texterreurlogin}
				{if !empty($texterreurlogin0) && $texterreurlogin0 == 1}{*  PHP8 *}
				{language name = mail_contacter}{mailto address="$email_adresse" text="Administrateur" subject="Autorisation_Espace_membres" encode="javascript"} {language name = mail_mail}
				{/if}
				</span><br><br>
				<span class="TextenoirR">&nbsp;{mailto address="$email_adresse" text="Oubli de mon mot de passe !" subject="Oubli_mot_de_passe_Espace_membres" encode="javascript"}</span><br><br>
			</footer>
		</div> {* / défini le contenu .. *}
	</div>
{* / défini les informations de la page *}

{* défini le pied de page  ne pas modifier lces lignes *}
	<footer class="footer_pied_page">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://gestassophp.free.fr/cms/" target="_blank" title="Evolution" >{$version}</a>
    </footer>
{* / défini le pied de page *}

</div>
{* / défini la page extérieure *}
</body>
</html>
