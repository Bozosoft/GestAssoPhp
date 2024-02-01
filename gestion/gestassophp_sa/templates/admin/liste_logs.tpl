{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2023 (c) JC Etiemble HTML5 *}
{* Affiche des logs adhérents *}
{* Affichage du CONTENU avec AIDE *}
	<header class="header_titre_aide"><a href='#' style="cursor:pointer;" onclick="javascript :window.open('../aide/a_logs.php','popup','height=300,toolbar=no,location=no,directories=no,status=yes,width=660,resizable=no,scrollbars=yes,top=10,left=10')" title="{_LANG_TITLE_AIDE}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20">{_LANG_AIDE}</a></header>

    <header class="header_titre">&nbsp;{_LANG_TITRE_ADMIN_LOGS}</header>
	<div class="ligne_coul"></div>
	<div id="contenu">
{* défini le contenu .. *}

{* Affichage du NB pages *}
	<form action="liste_logs.php" method="get" name="filtre">
		<table  style="width:100%;">
			<tr>
				<td><span class="TextenoirR">{$nb_lines}
				 {if $nb_lines != 1}
					{_LANG_ADMIN_LOGS_ENR_S} 
				 {else}
					{_LANG_ADMIN_LOGS_ENR} 
				 {/if}
				 &nbsp;&nbsp;<a href="../admin/export_tlogs.php?export_ok=1" title="{_LANG_ADMIN_LOGS_TITLE_EXPORT}">{_LANG_ADMIN_LOGS_EXPORT}</a></span>&nbsp;<br><img src="../images/icones/exclam.png" alt="clear" width="16" height="16"><span class="TexterougeR">{_LANG_ADMIN_LOGS_CLEAR_LOGS}<a href="liste_logs.php?reset=1" onclick="return confirm('{_LANG_ADMIN_LOGS_JS_CLEAR_LOGS}')"> <img src="../images/icones/i_poubelle.gif" alt="clear" width="10" height="11" title="{_LANG_ADMIN_LOGS_TITLE_CLEAR_LOGS}"></a></span></td>
				<td class="centre-txt">{_LANG_TPL_SELECT_AFFICHEPAR}
					<select name="affiche_nb_fich" onchange="form.submit()">
						{html_options options = $affichenb_log_options selected = $affiche_nb_fich}
					</select>
				</td>
				<td class="aff_droite-txt" >{_LANG_TPL_PAGES}<span class="NumPageGras">
	{section name = pageLoop start = 1 loop = $nb_pages}
			{if $smarty.section.pageLoop.index eq $numpage}{$smarty.section.pageLoop.index}
		{else}
			<a href="liste_logs.php?numpage_affiche={$smarty.section.pageLoop.index}&amp;affiche_nb_fich={$affiche_nb_fich}" title="{_LANG_TPL_GO_PAGES}">{$smarty.section.pageLoop.index} </a>
		{/if}
	{/section}</span>
				</td>
			</tr>
		</table>
	</form>
{* FIN Affichage du NB pages *}
	<table style="width:100%;">
		<tr>
		{* # *}
			<th class="LignegrisTC" style="width:6%;">
				<a href="liste_logs.php?tri=0&amp;affiche_nb_fich={$affiche_nb_fich}" title="{_LANG_TPL_TITLE_CLICTRI}">#</a>
				{if $smarty.session.tri eq 0}
					{if $smarty.session.tri_sens eq 1}
						<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_UP}">
					{else}
						<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_DOWN}">
					{/if}
				{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt="">
				{/if}
			</th>
		{* Date *}
			<th class="LignegrisTC" style="width:22%;">
				<a href="liste_logs.php?tri=1&amp;affiche_nb_fich={$affiche_nb_fich}" title="{_LANG_TPL_TITLE_CLICTRI}">{_LANG_TPL_COL_DATE}</a>
				{if $smarty.session.tri eq 1}
					{if $smarty.session.tri_sens eq 1}
						<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_UP}">
					{else}
						<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_DOWN}">
					{/if}
				{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt="">
				{/if}
			</th>
		{* IP *}
			<th class="LignegrisTC" style="width:15%;">
				<a href="liste_logs.php?tri=2&amp;affiche_nb_fich={$affiche_nb_fich}" title="{_LANG_TPL_TITLE_CLICTRI}">"IP"</a>
				{if $smarty.session.tri eq 2}
					{if $smarty.session.tri_sens eq 1}
						<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_UP}">
					{else}
						<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_DOWN}">
					{/if}
				{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt="">
				{/if}
			</th>
		{* Utilisateur *}
			<th class="LignegrisTC" style="width:22%;">
				<a href="liste_logs.php?tri=3&amp;affiche_nb_fich={$affiche_nb_fich}" title="{_LANG_TPL_TITLE_CLICTRI}">{_LANG_ADMIN_LOGS_COL_UTILISATEUR}</a>
				{if $smarty.session.tri eq 3}
					{if $smarty.session.tri_sens eq 1}
						<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_UP}">
					{else}
						<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_DOWN}">
					{/if}
				{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt="">
				{/if}
			</th>
		{* Description *}
			<th class="LignegrisTC" style="width:35%;">
				<a href="liste_logs.php?tri=4&amp;affiche_nb_fich={$affiche_nb_fich}" title="{_LANG_TPL_TITLE_CLICTRI}">{_LANG_TPL_COL_DESCRIPTION}</a>
				{if $smarty.session.tri eq 4}
					{if $smarty.session.tri_sens eq 1}
						<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_UP}">
					{else}
						<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_DOWN}">
					{/if}
				{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt="">
				{/if}
			</th>

		</tr>
{foreach from = $logs item = log key = ordre}
		<tr class="Lignegris{$log.coul}">
			<td>{$log.id}</td>		{* # *}
			<td>{$log.date}</td>	{* Date *}
			<td>{$log.ip}</td>		{* IP *}
			<td>{$log.adh}</td>		{* Utilisateur *}
			<td>{$log.action}</td>	{* Description *}
		</tr>
{foreachelse}
		{* La liste est vide *}
		<tr><td colspan="6">{_LANG_TPL_LISTE_VIDE}</td></tr>
{/foreach}
	</table>
{* Affichage du NB pages *}
	<div class="aff_droite-txt">{_LANG_TPL_PAGES}<span class="NumPageGras">
	{section name = pageLoop start = 1 loop = $nb_pages}
		{if $smarty.section.pageLoop.index eq $numpage}{$smarty.section.pageLoop.index}
		{else}
			<a href="liste_logs.php?numpage_affiche={$smarty.section.pageLoop.index}" title="{_LANG_TPL_GO_PAGES}">{$smarty.section.pageLoop.index} </a>
		{/if}
	{/section}</span></div>
{* FIN Affichage du NB pages *}

	</div>
{* FIN défini le contenu .. *}
