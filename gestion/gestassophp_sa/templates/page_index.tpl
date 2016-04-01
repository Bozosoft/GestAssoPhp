{* Affichage de la page type AVEC menu à gauche et CONTENU à définir copyright 2007-2016 (c) JC Etiemble HTML5*}
<!doctype html>
<html lang='fr' dir='ltr'>
<head>
	<meta charset="{language name=charset}">
	<meta name="author" content="JCE">
	<meta name="Description" content="{$version}">
	<meta name="ROBOTS" content="noindex, nofollow">
	<meta name="keywords" lang="fr" content="GestAssoPhp, gestion, association">
	<link rel="shortcut icon" href="../favicon.ico">
	<link rel="stylesheet" type="text/css" media="screen"  href="../js/style_screen.css">
	<link rel="stylesheet" type="text/css" media="print"  href="../js/style_print.css">
	<title>GestAssoPhp+Pg - {$nomprenom_adht}</title>
	{*  IE est non conforme aux standards *}
	<!--[if IE]>
	{literal}
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	{/literal}
	<![endif]-->
	
</head>
<body>

<div id="conteneur_page"> {*défini la page extérieure *}
      <header class="header_page"> {*défini le bandeau haut *}
			{$messagetitre} {$nom_asso_gestassophp}
      </header>	
	
	<div class="gauche_page"> {*défini la zone gauche *}
		<nav>
			<h1>{language name=menu_adht_membres}</h1>
			<ul>
{if $priorite_adht == ''} 
			<li><a href="../index.php">{language name=login_user}</a></li>
{/if}				
{if $priorite_adht > 0} 				
				<li{if $nomlienpage == "gerer_fiche_adht.php"||$nomlienpage == "remplir_infogene_adht.php"} class="menu_page_active"{/if}>&nbsp;&nbsp;<a href="../adherent/gerer_fiche_adht.php" title="{language name=titre_visu_fiche_adht}">{language name=menu_adht_information}</a></li>
				<li{if $nomlienpage == "liste_adht.php"||$nomlienpage == "consulter_fiche_adht.php"} class="menu_page_active"{/if}>&nbsp;&nbsp;<a href="../adherent/liste_adht.php" title="{language name=titre_liste_adht}">{language name=menu_adht_liste}</a></li>	
{/if}				
			</ul>			
	
{if $priorite_adht == 4} 		
		
			<h1>{language name=menu_admin_gestion}</h1>
			<ul>			
				<li{if $nomlienpage == "tableau_bord.php"} class="menu_page_active"{/if}><a href="../admin/tableau_bord.php" title="{language name=titre_admin_tableaubord}">{language name=menu_admin_gestion_tb}</a></li>			
			</ul>			
			
{/if}
{if $priorite_adht > 4} 		
		
			<h1>{language name=menu_admin_gestion}</h1>
			<ul>			
				<li{if $nomlienpage == "tableau_bord.php"} class="menu_page_active"{/if}>&nbsp;&nbsp;<a href="../admin/tableau_bord.php" title="{language name=titre_admin_tableaubord}">{language name=menu_admin_gestion_tb}</a></li>
{if $priorite_adht == 9}					
				<li{if $nomlienpage == "remplir_priorite.php"} class="menu_page_active"{/if}>&nbsp;&nbsp;<a href="../admin/remplir_priorite.php" title="{language name=titre_admin_gerer_priorite_adherents}">{language name=menu_admin_gestion_pa}</a></li>
				<li{if $nomlienpage == "liste_logs.php"} class="menu_page_active"{/if}>&nbsp;&nbsp;<a href="../admin/liste_logs.php" title="{language name=titre_admin_logs}">{language name=menu_admin_gestion_log}</a></li>
				<li{if $nomlienpage == "remplir_preferences.php"} class="menu_page_active"{/if}>&nbsp;&nbsp;<a href="../admin/remplir_preferences.php" title="{language name=titre_admin_preferences}">{language name=menu_admin_gestion_pref}</a></li>{*Préférences*}				
				<li{if $nomlienpage == "maint_bd.php"} class="menu_page_active"{/if}>&nbsp;&nbsp;<a href="../admin/maint_bd.php" title="{language name=titre_admin_maint_bd}">{language name=menu_admin_gestion_maint_bd}</a></li>		
{/if}				
				<li><h1>{language name=menu_adherent_bene}</h1></li>
				<li{if $nomlienpage == "liste_adht_admin.php"} class="menu_page_active"{/if}>&nbsp;&nbsp;<a href="../adherent/liste_adht_admin.php" title="{language name=menu_admin_gestion}&nbsp;-&nbsp;{language name=titre_admin_liste_adht}">{language name=menu_adherent_gestion}</a></li>	
				
				<li{if $nomlienpage == "liste_adht_admin2.php"||$nomlienpage == "consulter_fiche_adht_admin2.php"} class="menu_page_active"{/if}>&nbsp;&nbsp;<a href="../adherent/liste_adht_admin2.php"  title="{language name=menu_admin_gestion}&nbsp;-&nbsp;{language name=titre_admin_liste_adht2}">{language name=titre_admin_liste_adht2}</a></li>
{if $priorite_adht > 6}				
				<li{if $nomlienpage == "liste_cotisations_adht.php"||$nomlienpage == "remplir_cotisations_adht.php"} class="menu_page_active"{/if}>&nbsp;&nbsp;<a href="../adherent/liste_cotisations_adht.php"  title="{language name=menu_admin_gestion}&nbsp;-&nbsp;{language name=titre_admin_liste_cotis_adht}">{language name=menu__gestion_cotis}</a></li>
{/if}
				<li{if $nomlienpage == "liste_fichiers_adht.php"||$nomlienpage == "remplir_fichier_adht.php"} class="menu_page_active"{/if}>&nbsp;&nbsp;<a href="../adherent/liste_fichiers_adht.php"  title="{language name=menu_admin_gestion}&nbsp;-&nbsp;{language name=titre_admin_liste_fichiers_adht}">{language name=menu__gestione_file}</a></li>			
			</ul>			
		
{/if}
			<br/>
			<div class="contourligne">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../index.php?logout=1" title="{language name=menu_exit_title}"><img src='../images/icones16/i_stop.png' alt="out" width="16" height="16" title="{language name=menu_exit_title}"/>&nbsp;{language name=menu_exit}&nbsp;</a></div>
		</nav>
		<figure class="centre-txt">{* Logo GestAssoPhp+ *}<img src='../images/logo/logo_gestassophp.gif' alt="Logo" width="128" height="20" title="Logo GestAssoPhp+"/></figure>
		
	</div> {*/ défini la zone gauche *}

	<div class="section_centre_page"> {*défini les infos .. *}
	{$content}
	</div> {* / défini les infos .. *}
	 
	<footer class="footer_pied_page">  {*défini le pied de page  ne pas modifier ces lignes*}
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://gestassophp.free.fr/cms/" target="_blank" title="R&eacute;alisation" >{$version}</a>&nbsp;&nbsp;&nbsp;&nbsp; <span class="TextenoirR"><a href="../doc/CCBY-SA-France.htm" target="_blank" title="Contrat Creative Commons" >Licence</a></span>
    </footer> {* / défini le pied de page *}
	
</div> {* / défini la page extérieure *}
</body>
</html>
