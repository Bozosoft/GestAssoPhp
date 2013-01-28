{* Affichage de la page type AVEC menu à gauche et CONTENU à définir*}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
    <title>GestAssoPhp+Pg - {$nomprenom_adht}</title>
	<!-- ne pas modifier les métas -->	
    <meta http-equiv="Content-Type" content="text/HTML; charset={language name=charset}" />	
	<meta name="author" content="JCE" />
	<meta name="Description" content="GestAssoPhp+Pg" />
	<meta name="Copyright" content="(c) JCE 2007-2013" />	
	<meta name="Expires" content="never" />
	<meta name="ROBOTS" content="noindex, nofollow" />
	<meta name="keywords" lang="fr" content="GestAssoPhp+Pg" />
	<link rel="shortcut icon" href="../favicon.ico" />
	<link rel="stylesheet" type="text/css" media="screen"  href="../js/style_screen.css"/>
	<link rel="stylesheet" type="text/css" media="print"  href="../js/style_print.css"/>
	{*  IE lt IE 7 (lt signifiant less than : "plus petit que")  voir largeur sur IE5.5 *}
<!--[if lt IE 7]>
{literal}
<style type="text/css">
#gauche_page {
position: absolute;
left:0;
width: 10em;
background-color:#FFFFFF;
}
</style>
{/literal}
<![endif]-->
	
</head>
<body>

<div id="conteneur_page"> {*défini la page extérieure *}
      <div id="header_page"> {*défini le bandeau haut *}
			{$messagetitre} {$nom_asso_gestassophp}
      </div>	
	
	<div id="gauche_page"> {*défini les menus gauche *}
	<div class="menu_page">
			<h1>{language name=menu_adht_membres}</h1>
			<ul>
{if $priorite_adht == ''} 
			<li><a href="../index.php">{language name=login_user}</a></li>
{/if}				
{if $priorite_adht > 0} 				
				<li>&nbsp;&nbsp;<a href="../adherent/gerer_fiche_adht.php">{language name=menu_adht_information}</a></li>
				<li>&nbsp;&nbsp;<a href="../adherent/liste_adht.php">{language name=menu_adht_liste}</a></li>	
{/if}				
			</ul>			
		</div>
{if $priorite_adht == 4} 		
		<div class="menu_page">
			<h1>{language name=menu_admin_gestion}</h1>
			<ul>			
				<li><a href="../admin/tableau_bord.php">{language name=menu_admin_gestion_tb}</a></li>			
			</ul>			
		</div>	
{/if}
{if $priorite_adht > 4} 		
		<div class="menu_page">
			<h1>{language name=menu_admin_gestion}</h1>
			<ul>			
				<li>&nbsp;&nbsp;<a href="../admin/tableau_bord.php">{language name=menu_admin_gestion_tb}</a></li>
{if $priorite_adht == 9}					
				<li>&nbsp;&nbsp;<a href="../admin/remplir_priorite.php">{language name=menu_admin_gestion_pa}</a></li>
				<li>&nbsp;&nbsp;<a href="../admin/liste_logs.php">{language name=menu_admin_gestion_log}</a></li>
				<li>&nbsp;&nbsp;<a href="../admin/remplir_preferences.php">{language name=menu_admin_gestion_pref}</a></li>{*Préférences*}				
				<li>&nbsp;&nbsp;<a href="../admin/maint_bd.php">{language name=menu_admin_gestion_maint_bd}</a></li>		
{/if}				
				<li><h1>{language name=menu_adherent_bene}</h1></li>
				<li>&nbsp;&nbsp;<a href="../adherent/liste_adht_admin.php">{language name=menu_adherent_gestion}</a></li>	
				
				<li>&nbsp;&nbsp;<a href="../adherent/liste_adht_admin2.php">{language name=titre_admin_liste_adht2}</a></li>
{if $priorite_adht > 6}				
				<li>&nbsp;&nbsp;<a href="../adherent/liste_cotisations_adht.php">{language name=menu__gestion_cotis}</a></li>
{/if}
				<li>&nbsp;&nbsp;<a href="../adherent/liste_fichiers_adht.php">{language name=menu__gestione_file}</a></li>			
			</ul>			
		</div>	
{/if}
		<div class="menu_page">
			<span class="TextenoirGras">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../index.php?logout=1" title="{language name=menu_exit_title}">&nbsp;{language name=menu_exit}&nbsp;</a></span>
		</div>
		<div class="centre-txt">{* Logo de votre asso *}<img src='../images/logo/logo_gestassophp.gif' alt="Logo" width="128" height="20" title="Logo de votre Asso"/></div>
		
	</div> {*/ défini les menus gauche *}


	
	
	<div id="centre_page"> {*défini les infos .. *}
	{$content}
	</div> {* / défini les infos .. *}
	 
	<div id="pied_page">  {*défini le pied de page  ne pas modifier lces lignes*}
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://gestassophp.free.fr/cms/" target="_blank" title="R&eacute;alisation" >{$version}</a>&nbsp;&nbsp;&nbsp;&nbsp; <span class="TextenoirR"><a href="../doc/CCBY-SA-France.htm" target="_blank" title="Contrat Creative Commons" >Licence</a></span>
    </div> {* / défini le pied de page *}
	
</div> {* / défini la page extérieure *}
</body>
</html>
