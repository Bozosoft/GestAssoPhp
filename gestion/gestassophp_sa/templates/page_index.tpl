{* Affichage de la page type AVEC menu à gauche et CONTENU à définir copyright 2007-2023  JC Etiemble HTML5 *}
<!doctype html>
<html lang='fr' dir='ltr'>
<head>
	<meta charset="{_LANG_CHARSET}">
	<meta name="author" content="JCE">
	<meta name="Description" content="{$version}">
	<meta name="ROBOTS" content="noindex, nofollow">
	<meta name="keywords" lang="fr" content="GestAssoPhp, gestion, association">
	<link rel="shortcut icon" href="../favicon.ico">
	<link rel="stylesheet" type="text/css" media="screen"  href="../js/style_screen.css">
	<link rel="stylesheet" type="text/css" media="print"  href="../js/style_print.css">
	<title>GestAssoPhp+Pg - {$nomprenom_adht}</title>
{*  IE est non conforme aux standards - Ici IE version inférieure à 9 *}
	<!--[if lt IE 9]>
	{literal}
	<script src="../js/html5shiv.min.js"></script>
	{/literal}
	<![endif]-->

</head>
<body>
{* défini la page extérieure *}
<div id="conteneur_page">
{* défini le bandeau haut *}
      <header class="header_page">
			{$messagetitre} {$nom_asso_gestassophp}
      </header>
{* / défini le bandeau haut *}

{* défini la zone gauche *}
	<div class="gauche_page">
		<nav>
			<h1>{_LANG_MENU_ADHT_MEMBRES}</h1>
			<ul>
{if $priorite_adht == ''}
			<li><a href="../index.php">{_LANG_LOGIN_USER}</a></li>
{/if}
{if $priorite_adht > 0}
				<li{if $nomlienpage == "gerer_fiche_adht.php"||$nomlienpage == "remplir_infogene_adht.php"} class="menu_page_active"{/if}>&nbsp;&nbsp;<a href="../adherent/gerer_fiche_adht.php" title="{_LANG_TITRE_VISU_FICHE_ADHT}">{_LANG_MENU_ADHT_INFORMATION}</a></li>
				<li{if $nomlienpage == "liste_adht.php"||$nomlienpage == "consulter_fiche_adht.php"} class="menu_page_active"{/if}>&nbsp;&nbsp;<a href="../adherent/liste_adht.php" title="{_LANG_TITRE_LISTE_ADHT}">{_LANG_MENU_ADHT_LISTE}</a></li>
{/if}
			</ul>

{if $priorite_adht == 4}

			<h1>{_LANG_MENU_ADMIN_GESTION}</h1>
			<ul>
				<li{if $nomlienpage == "tableau_bord.php"} class="menu_page_active"{/if}><a href="../admin/tableau_bord.php" title="{_LANG_TITRE_ADMIN_TABLEAUBORD}">{_LANG_MENU_ADMIN_GESTION_TB}</a></li>
			</ul>

{/if}
{if $priorite_adht > 4}

			<h1>{_LANG_MENU_ADMIN_GESTION}</h1>
			<ul>
				<li{if $nomlienpage == "tableau_bord.php"} class="menu_page_active"{/if}>&nbsp;&nbsp;<a href="../admin/tableau_bord.php" title="{_LANG_TITRE_ADMIN_TABLEAUBORD}">{_LANG_MENU_ADMIN_GESTION_TB}</a></li>
{if $priorite_adht == 9}
				<li{if $nomlienpage == "remplir_priorite.php"} class="menu_page_active"{/if}>&nbsp;&nbsp;<a href="../admin/remplir_priorite.php" title="{_LANG_TITRE_ADMIN_GERER_PRIORITE_ADHERENTS}">{_LANG_MENU_ADMIN_GESTION_PA}</a></li>
				<li{if $nomlienpage == "liste_logs.php"} class="menu_page_active"{/if}>&nbsp;&nbsp;<a href="../admin/liste_logs.php" title="{_LANG_TITRE_ADMIN_LOGS}">{_LANG_MENU_ADMIN_GESTION_LOG}</a></li>
				<li{if $nomlienpage == "remplir_preferences.php"} class="menu_page_active"{/if}>&nbsp;&nbsp;<a href="../admin/remplir_preferences.php" title="{_LANG_TITRE_ADMIN_PREFERENCES}">{_LANG_MENU_ADMIN_GESTION_PREF}</a></li>{*Préférences*}
				<li{if $nomlienpage == "maint_bd.php"} class="menu_page_active"{/if}>&nbsp;&nbsp;<a href="../admin/maint_bd.php" title="{_LANG_TITRE_ADMIN_MAINT_BD}">{_LANG_MENU_ADMIN_GESTION_MAINT_BD}</a></li>
{/if}
				<li><h1>{_LANG_MENU_ADHERENT_BENE}</h1></li>
				<li{if $nomlienpage == "liste_adht_admin.php"} class="menu_page_active"{/if}>&nbsp;&nbsp;<a href="../adherent/liste_adht_admin.php" title="{_LANG_MENU_ADMIN_GESTION}&nbsp;-&nbsp;{_LANG_TITRE_ADMIN_LISTE_ADHT}">{_LANG_MENU_ADHERENT_GESTION}</a></li>

				<li{if $nomlienpage == "liste_adht_admin2.php"||$nomlienpage == "consulter_fiche_adht_admin2.php"} class="menu_page_active"{/if}>&nbsp;&nbsp;<a href="../adherent/liste_adht_admin2.php"  title="{_LANG_MENU_ADMIN_GESTION}&nbsp;-&nbsp;{_LANG_TITRE_ADMIN_LISTE_ADHT2}">{_LANG_TITRE_ADMIN_LISTE_ADHT2}</a></li>
{if $priorite_adht > 6}
				<li{if $nomlienpage == "liste_cotisations_adht.php"||$nomlienpage == "remplir_cotisations_adht.php"} class="menu_page_active"{/if}>&nbsp;&nbsp;<a href="../adherent/liste_cotisations_adht.php"  title="{_LANG_MENU_ADMIN_GESTION}&nbsp;-&nbsp;{_LANG_TITRE_ADMIN_LISTE_COTIS_ADHT}">{_LANG_MENU__GESTION_COTIS}</a></li>
{/if}
				<li{if $nomlienpage == "liste_fichiers_adht.php"||$nomlienpage == "remplir_fichier_adht.php"} class="menu_page_active"{/if}>&nbsp;&nbsp;<a href="../adherent/liste_fichiers_adht.php"  title="{_LANG_MENU_ADMIN_GESTION}&nbsp;-&nbsp;{_LANG_TITRE_ADMIN_LISTE_FICHIERS_ADHT}">{_LANG_MENU__GESTIONE_FILE}</a></li>
			</ul>

{/if}
			<br>
			<div class="contourligne">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../index.php?logout=1" title="{_LANG_MENU_EXIT_TITLE} - !! IMPORTANT !! OBLIGATOIRE pour votre sécurité"><img src='../images/icones16/i_stop.png' alt="out" width="16" height="18" title="{_LANG_MENU_EXIT_TITLE}">&nbsp;{_LANG_MENU_EXIT}&nbsp;</a></div>
		</nav>
		<figure class="centre-txt">{* Logo GestAssoPhp+ *}<img src='../images/logo/logo_gestassophp.gif' alt="Logo" width="128" height="20" title="Logo GestAssoPhp+"></figure>

	</div>
{* / défini la zone gauche *}

{* défini les informations de la page *}
	<div class="section_centre_page">
	{$content}
	</div>
{* / défini les informations de la page *}

{* défini le pied de page  ne pas modifier lces lignes *}
	<footer class="footer_pied_page">
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://gestassophp.free.fr/cms/" target="_blank" title="Evolution" >{$version}</a>&nbsp;&nbsp;&nbsp;&nbsp; <span class="TextenoirR"><a href="../doc/CCBY-SA-France.htm" target="_blank" title="Contrat Creative Commons  - Ouverture dans un nouvel onglet" >Licence</a></span>
    </footer>
{* / défini le pied de page *}

</div>
{* / défini la page extérieure *}
</body>
</html>
