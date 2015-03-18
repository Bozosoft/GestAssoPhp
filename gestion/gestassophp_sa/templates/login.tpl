{* Projet : gestassophp_sa [GestAssoPhp+Pg]*}{* Affichage de la page Acccés avec Login et mot de passe  login.tpl copyright 2007-2014 (c) JC Etiemble HTML5*}
<!doctype html>
<html lang='fr' dir='ltr'>
<head>
	{* ne pas modifier les métas *}	
    {*<meta http-equiv="Content-Type" content="text/html; charset={language name=charset}">*}	
	<meta charset="{language name=charset}">
	<meta name="author" content="JCE" />
	<meta name="Description" content="{$version}">
	<meta name="ROBOTS" content="noindex, nofollow">
	<meta name="keywords" lang="fr" content="GestAssoPhp, gestion, association">
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" media="screen"  href="js/style_screen.css">
	<!-- link rel="stylesheet" type="text/css" media="print"  href="../js/style_print.css" -->
	{*  IE est non conforme aux standards *}
	<!--[if IE]>
	{literal}
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	{/literal}
	<![endif]-->
	<title>GestAssoPhp+Pg Pour g&eacute;rer votre association - {$version}</title>
</head>
<body onload="document.getElementById('login').focus()">
 	
<div id="conteneur_page"> {*défini la page extérieure *}
    <header class="header_page"> {*défini le bandeau haut *}
			{$messagetitre} {$nom_asso_gestassophp}
    </header> {* / défini le bandeau haut *}	
	
	<div class="gauche_page"> {*défini la zone gauche *}
		<nav>
			<h1>{language name=menu_adht_membres}</h1>
			<ul>
{if $priorite_adht == ''} 
			<li>{language name=login_user}</li>
{/if}
{if $priorite_adht == '0'} 
			<li>{language name=login_interdit}</li>
{/if}				
{if $priorite_adht > 0} 				
			<li>&nbsp;&nbsp;<a href="index.php?logout=1" title="Se D&eacute;connecter">{language name=menu_exit}</a></li>	
{/if}				
			</ul>

		</nav>
		<br /><br /><br />
		<figure class="centre-txt">{* Logo de votre asso *}
			<img src='images/logo/logo_gestassophp.gif' alt="Logo" width="128" height="20" title="Logo GestAssoPhp+"/>
			<br /><br />
			<a rel="license" href="http://creativecommons.org/licenses/by-sa/2.0/fr/" target="_blank"><img src='images/licence/ccby-sa88x31.png' alt="Creative Commons License" width="88" height="31" title="Syst&egrave;me mise &agrave; disposition sous un contrat Creative Commons"/></a><br /><br /><figcaption  class="TextenoirR"><a href="./doc/CCBY-SA-France.htm" target="_blank" title="Contrat Creative Commons" >Licence</a></figcaption>
		</figure>			
	</div> {* / défini la zone gauche*}	
	<section class="section_centre_page">{*défini les infos .. *}
	
		<header class="header_titre_aide"><a href='#' style="cursor:pointer;cursor:hand" onclick="javascript :window.open('aide/a_login.php','popup','height=420,toolbar=no,location=no,directories=no,status=yes,width=660,resizable=no,scrollbars=yes,top=10,left=10')" title="{language name=title_aide}"><img src='images/icones/help.gif' alt="Aide" width="20" height="20"/>{language name=aide}</a></header> 

		<header class="header_titre">&nbsp;{language name=login_adherent}</header>
		<div class="ligne_coul"></div> 	
		<div id="contenu"> {*défini le contenu .. *}
		
			<div class="login-box"> {*défini l'accées Log MdP *}
			<br/><img src='images/icones/login.png' alt="login" title="{language name=login_adherent_title}" /><br/>
			<form action="index.php" method="post">

						<label class="label_login" for="login">{language name=login_my_login}</label>
						<input type="text" name="login" id="login" title="{language name=login_enter_login}" value="" size="32" tabindex="1" onfocus="this.className='focus';" onblur="this.className='normal';" onchange="javascript:this.value=this.value.toUpperCase();" />
	<br/>
						<label class="label_login" for="password">{language name=login_my_passwd}</label>
						<input  type="password" name="password" id="password" title="{language name=login_enter_passwd}" value="" size="32" tabindex="2" onfocus="this.className='focus';" onblur="this.className='normal';" />

				<br/><br/><br/>
				<input type="submit" class="submit_ok" name="submit" value="{language name=login_button}" title="{language name=login_button_title}"/>
				<input type="hidden" name="ident" value="1" />
			</form>
			</div>{* / défini l'accées Log MdP *}
	<br/>
			<footer class="centre-txt">
				<span class="TexterougeGras">&nbsp;{$texterreurlogin}
				{if $texterreurlogin0 == 1}
				{language name=mail_contacter}{mailto address="$email_adresse" text="Administrateur" subject="Autorisation_Espace_membres" encode="javascript"} {language name=mail_mail}
				{/if}
				</span><br/><br/>
				<span class="TextenoirR">&nbsp;{mailto address="$email_adresse" text="J\'ai oubli&eacute; mon mot de passe !" subject="Oubli_mot_de_passe_Espace_membres" encode="javascript"}</span><br/><br/>
			</footer>
		</div> {* / défini le contenu .. *}	
	</section>{* / défini les infos .. *}

	<footer class="footer_pied_page"> {*défini le pied de page  ne pas modifier lces lignes*}
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://gestassophp.free.fr/cms/" target="_blank" title="R&eacute;alisation" >{$version}</a>
    </footer> {* / défini le pied de page *}
	
</div>  {* / défini la page extérieure *}
</body>
</html>
