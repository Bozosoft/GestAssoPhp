{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2023 (c) JC Etiemble HTML5 *}
{* Affichage du CONTENU avec AIDE  Liste des adhérents affichage Admin uniquement 18/12/11 *}
	<header class="header_titre_aide"><a href='#' style="cursor:pointer;" onclick="javascript :window.open('../aide/a_adht_liste_adht_admin2.php','popup','height=280,toolbar=no,location=no,directories=no,status=yes,width=660,resizable=no,scrollbars=yes,top=10,left=10')" title="{_LANG_TITLE_AIDE}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20">{_LANG_AIDE}</a></header>

    <header class="header_titre">{_LANG_MENU_ADMIN_GESTION}&nbsp;-&nbsp;{_LANG_TITRE_ADMIN_LISTE_ADHT2}</header>
	<div class="ligne_coul"></div>
	<div id="contenu">
{* défini le contenu .. *}

{* Affichage  Recherche *}
	<form action="liste_adht_admin2.php" method="get" name="filtre">
{* Filtrer les fiches ... *}
		<div id="listfilter">
			<input type="submit" class="submit_ok" value="{_LANG_TPL_FILTER_BUTTON}" title=" {_LANG_TPL_FILTER_BUTTON_TITLE}">
			<label for="filtre_nom">{_LANG_LISTE_ADHT_PARMI}</label>
				{* filtrer parmi les noms/prénoms *}
			<input type="text" name="filtre_nom" id="filtre_nom" value="{$filtre_adht_nom}" title="{_LANG_TPL_LISTE_ADHT_PARMI_TITLE}">
		</div>

{* Affichage NB adhérents -  - NB pages *}
	<table style="width:100%;">
		<tr>
		{* $affiche_nb_inscrits *}
			<td style="width:25%;">{$nb_lines}
			{if $nb_lines > 1}
				{$adherent_bene}s  {_LANG_LISTE_ADHT_INSCRIT}
			{else}
				{$adherent_bene}
			{/if}</td>
			<td class="centre-txt" style="width:25%;">{_LANG_TPL_SELECT_AFFICHEPAR}
				<select name="affiche_nb_adht" onchange="form.submit()">
					{* Afficher par Nb de lignes par page *}
					{html_options options = $affichenb_adht_options selected = $affiche_nb_adht}
				</select>
			</td>
			{* Affichage NB pages *}
			<td class="aff_droite-txt">{_LANG_TPL_PAGES}<span class="NumPageGras">
				{section name = pageLoop start = 1 loop = $nb_pages}
					{if $smarty.section.pageLoop.index eq $numpage}
						{$smarty.section.pageLoop.index}
					{else}
						<a href="liste_adht_admin2.php?numpage_affiche={$smarty.section.pageLoop.index}&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{_LANG_TPL_GO_PAGES}">{$smarty.section.pageLoop.index}</a>
					{/if}
				{/section}</span>
			</td>
		</tr>
	</table>
{* FIN Affichage NB adhérents -  - NB pages *}
</form>
{* FIN Affichage  Recherche *}

{* Affichage de la Table des adhérents *}

	<table style="width:100%;">
		<tr>
		{* # *}
			<th class="LignegrisTC" style="width:4%;">
				<a href="liste_adht_admin2.php?tri=0&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{_LANG_TPL_TITLE_CLICTRI}">#</a>{* #=N°*}
				{if $smarty.session.tri eq 0}
				{if $smarty.session.tri_sens eq 0}
				<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_UP}">
				{else}
				<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="Tri D&eacute;croissant">
				{/if}
				{else}
				<img src="../images/symboles/empty.png" width="7" height="7" alt="">
				{/if}
			</th>
		{* Nom Prénom *}
			<th class="LignegrisTC"  style="width:23%;">
				<a href="liste_adht_admin2.php?tri=1&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{_LANG_TPL_TITLE_CLICTRI}">{_LANG_TPL_COL_NOMPRE}</a>
				{if $smarty.session.tri eq 1}
				{if $smarty.session.tri_sens eq 0}
				<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_UP}">
				{else}
				<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="Tri D&eacute;croissant">
				{/if}
				{else}
				<img src="../images/symboles/empty.png" width="7" height="7" alt="">
				{/if}
			</th>
		{* Ville *}
			<th class="LignegrisTC"  style="width:25%;">
				<a href="liste_adht_admin2.php?tri=2&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{_LANG_TPL_TITLE_CLICTRI}">{_LANG_TPL_COL_ADHT_VILLE}</a>
				{if $smarty.session.tri eq 2}
				{if $smarty.session.tri_sens eq 0}
				<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_UP}">
				{else}
				<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="Tri D&eacute;croissant">
				{/if}
				{else}
				<img src="../images/symboles/empty.png" width="7" height="7" alt="">
				{/if}
			</th>
		{* Téléphone *}
			<th class="LignegrisTC"  style="width:12%;">
				<a href="liste_adht_admin2.php?tri=3&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{_LANG_TPL_TITLE_CLICTRI}">{_LANG_TPL_COL_ADHT_TELEPH}  </a>
				{if $smarty.session.tri eq 3}
				{if $smarty.session.tri_sens eq 0}
				<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_UP}">
				{else}
				<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="Tri D&eacute;croissant">
				{/if}
				{else}
				<img src="../images/symboles/empty.png" width="7" height="7" alt="">
				{/if}
			</th>
		{* Tel Portable *}
			<th class="LignegrisTC"  style="width:12%;">
				<a href="liste_adht_admin2.php?tri=4&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{_LANG_TPL_TITLE_CLICTRI}"> {_LANG_TPL_COL_ADHT_PORTABLE}  </a>
				{if $smarty.session.tri eq 4}
				{if $smarty.session.tri_sens eq 0}
				<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_UP}">
				{else}
				<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="Tri D&eacute;croissant">
				{/if}
				{else}
				<img src="../images/symboles/empty.png" width="7" height="7" alt="">
				{/if}
			</th>
		{* sections ou secteurs d'activité *}
			<th class="LignegrisTC"  style="width:16%;">
				<a href="liste_adht_admin2.php?tri=5&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{_LANG_TPL_TITLE_CLICTRI}"> {_LANG_PREF_LANG_FICHE_ADHT_ANT}</a>
				{if $smarty.session.tri eq 5}
				{if $smarty.session.tri_sens eq 0}
				<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_UP}">
				{else}
				<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_DOWN}">
				{/if}
				{else}
				<img src="../images/symboles/empty.png" width="7" height="7" alt="">
				{/if}
			</th>
		{* Actions *}
			<th class="LignegrisTC"  style="width:6%;">{_LANG_TPL_COL_ACTION}
			</th>

		</tr>
{foreach from = $membres item = item_membres key = ordre}
		<tr class="Lignegris{$item_membres.coul}">
			<td>{$item_membres.id_adht}</td>								{* # *}
			<td><a href="../adherent/consulter_fiche_adht_admin2.php?id_adht={$item_membres.id_adht}" title="{_LANG_LISTE_ADHT_VISU_ICON_TITLE}">{$item_membres.nom_adht} {$item_membres.prenom_adht}</a></td> 	{* Nom Prénom lien vers Visualisation des informations Adhérent *}
			<td>{$item_membres.ville_adht}</td>								{* Ville *}
			<td>{$item_membres.telephonef_adht}</td>						{* Téléphone *}
			<td>&nbsp;{$item_membres.telephonep_adht}</td>					{* Tel Portable *}
			<td>&nbsp;{$item_membres.nom_type_antenne}</td>					{* sections ou secteurs d'activité *}
			<td class="centre-txt">											{* Action = Visualisation des informations Adhérent *}
			<a href="../adherent/consulter_fiche_adht_admin2.php?id_adht={$item_membres.id_adht}"><img src="../images/icones16/i_voir.png" width="16" height="16" alt="Visu" title="{_LANG_LISTE_ADHT_VISU_ICON_TITLE}"></a></td>
		</tr>
{foreachelse}
		{* La liste est vide *}
		<tr><td colspan="7">{_LANG_TPL_LISTE_VIDE}</td></tr>
{/foreach}
	</table>
{* FIN Affichage de la Table des adhérents *}

	<div class="aff_droite-txt">{_LANG_TPL_PAGES}<span class="NumPageGras">
			{section name = pageLoop start = 1 loop = $nb_pages}
				{if $smarty.section.pageLoop.index eq $numpage}
					{$smarty.section.pageLoop.index}
				{else}
					<a href="liste_adht_admin2.php?numpage_affiche={$smarty.section.pageLoop.index}&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{_LANG_TPL_GO_PAGES}">{$smarty.section.pageLoop.index}</a>
				{/if}
			{/section}</span></div>


	</div>
{* FIN défini le contenu .. *}
