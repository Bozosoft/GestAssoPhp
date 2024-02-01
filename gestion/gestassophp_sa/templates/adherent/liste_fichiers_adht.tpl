{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2023 (c) JC Etiemble HTML5 *}
{* Affichage du CONTENU avec AIDE Liste fichiers des adhérents *}
	<header class="header_titre_aide"><a href='#' style="cursor:pointer;" onclick="javascript :window.open('../aide/a_adht_liste_fichiers_adht.php','popup','height=620,toolbar=no,location=no,directories=no,status=yes,width=660,resizable=no,scrollbars=yes,top=10,left=10')" title="{_LANG_TITLE_AIDE}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20">{_LANG_AIDE}</a></header>

    <header class="header_titre">{_LANG_MENU_ADMIN_GESTION}&nbsp;-&nbsp;{_LANG_TITRE_ADMIN_LISTE_FICHIERS_ADHT}
    {if !empty($affiche_message)}{$affiche_message}{/if}</header>
	<div class="ligne_coul"></div>
	<div id="contenu">
{* défini le contenu .. *}

{* Affichage  Recherche *}
	<form action="liste_fichiers_adht.php" method="get" name="filtre">
		<div id="listfilter">
			<input type="submit" class="submit_ok" value="{_LANG_TPL_FILTER_BUTTON}" title="{_LANG_TPL_FILTER_BUTTON_TITLE}">
			<label for="filtre_nom">{_LANG_LISTE_FICHIERS_ADHT_PARMI}</label>
				{* filtrer parmi les noms/prénoms *}
			<input type="text" name="filtre_nom" id="filtre_nom" value="{$filtre_adht_nom}" title="{_LANG_TPL_LISTE_ADHT_PARMI_TITLE}">&nbsp;
		 	{_LANG_TPL_TEXTE_SELECT}
			<select name="filtrefichier" onchange="form.submit()">
				{* la liste des options : fichier actifs ou supprimés ou tous *}
				{html_options options = $filtre_options selected = $filtrefichier_ou}
			</select>

		</div>

{* Affichage NB adhérents -  - NB pages *}
	<table style="width:100%;">
		<tr>
			<td>{$nb_lines}
			{if $nb_lines > 1} 
				{_LANG_LISTE_FICHIERS_ADHT_FILES} 
			{else}
				{_LANG_LISTE_FICHIERS_ADHT_FILE} 
			{/if}
			 &nbsp;&nbsp;<a href="../adherent/remplir_fichier_adht.php"><span class="submit_ok" title="{_LANG_LISTE_FICHIERS_ADHT_ADFILE_BUTTON_TITLE}">&nbsp; {_LANG_LISTE_FICHIERS_ADHT_ADFILE_BUTTON}&nbsp;</span></a></td>
			<td class="centre-txt">{_LANG_TPL_SELECT_AFFICHEPAR}
				<select name="affiche_nb_fich" onchange="form.submit()">
					{html_options options = $affichenb_adht_options selected = $affiche_nb_fich}
				</select>
			</td>
			{* Affichage NB pages *}
			<td class="aff_droite-txt">{_LANG_TPL_PAGES}<span class="NumPageGras">
				{section name = pageLoop start = 1 loop = $nb_pages}
					{if $smarty.section.pageLoop.index eq $numpage}
						{$smarty.section.pageLoop.index}
					{else}
						<a href="liste_fichiers_adht.php?numpage_affiche={$smarty.section.pageLoop.index}&amp;affiche_nb_fich={$affiche_nb_fich}&amp;filtrefichier={$filtrefichier_ou}&amp;filtre_nom={$filtre_adht_nom}" title="{_LANG_TPL_GO_PAGES}">{$smarty.section.pageLoop.index}</a>
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
				<a href="liste_fichiers_adht.php?tri=0&amp;affiche_nb_fich={$affiche_nb_fich}&amp;filtrefichier={$filtrefichier_ou}&amp;filtre_nom={$filtre_adht_nom}" title="{_LANG_TPL_TITLE_CLICTRI}">#</a>
				{if $smarty.session.tri eq 0}
					{if $smarty.session.tri_sens eq 0}
						<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_UP}">
					{else}
						<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_DOWN}">
					{/if}
				{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt="">
				{/if}
			</th>
		{* Nom fichier *}
			<th class="LignegrisTC" style="width:25%;">
				<a href="liste_fichiers_adht.php?tri=1&amp;affiche_nb_fich={$affiche_nb_fich}&amp;filtrefichier={$filtrefichier_ou}&amp;filtre_nom={$filtre_adht_nom}" title="{_LANG_TPL_TITLE_CLICTRI}">{_LANG_LISTE_FICHIERS_COL_NOMFICHIER}</a>
				{if $smarty.session.tri eq 1}
					{if $smarty.session.tri_sens eq 0}
						<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_UP}">
					{else}
						<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_DOWN}">
					{/if}
				{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt="">
				{/if}
			</th>
		{* Description fichier *}
			<th class="LignegrisTC" style="width:24%;">
				<a href="liste_fichiers_adht.php?tri=2&amp;affiche_nb_fich={$affiche_nb_fich}&amp;filtrefichier={$filtrefichier_ou}&amp;filtre_nom={$filtre_adht_nom}" title="{_LANG_TPL_TITLE_CLICTRI}">{_LANG_TPL_COL_DESCRIPTION}</a>
				{if $smarty.session.tri eq 2}
					{if $smarty.session.tri_sens eq 0}
						<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_UP}">
					{else}
						<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_DOWN}">
					{/if}
				{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt="">
				{/if}
			</th>
		{* Date du dépôt du fichier *}
			<th class="LignegrisTC" style="width:12%;">
				<a href="liste_fichiers_adht.php?tri=3&amp;affiche_nb_fich={$affiche_nb_fich}&amp;filtrefichier={$filtrefichier_ou}&amp;filtre_nom={$filtre_adht_nom}" title="{_LANG_TPL_TITLE_CLICTRI}">{_LANG_TPL_COL_DATE}</a>
				{if $smarty.session.tri eq 3}
					{if $smarty.session.tri_sens eq 0}
						<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_UP}">
					{else}
						<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_DOWN}">
					{/if}
				{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt="">
				{/if}
			</th>
		{* Nom Prénom Adhérent *}
			<th class="LignegrisTC" style="width:23%;">
				<a href="liste_fichiers_adht.php?tri=4&amp;affiche_nb_fich={$affiche_nb_fich}&amp;filtrefichier={$filtrefichier_ou}&amp;filtre_nom={$filtre_adht_nom}" title="{_LANG_TPL_TITLE_CLICTRI}">{_LANG_TPL_COL_ADHT_NOM} {$adherent_bene}</a>
				{if $smarty.session.tri eq 4}
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
			<th class="LignegrisTC" style="width:12%;">{_LANG_TPL_COL_ACTIONS}
			</th>

		</tr>
{foreach from = $fichier item = item_fichier key = ordre}
		<tr class="Lignegris{$item_fichier.coul}">
			<td>{$item_fichier.id_file_adht}</td>
			<td>{if $item_fichier.file_adht != '999'} 						{* Nom fichier lien vers Gestion fichier N°.. *}
					<a href="../adherent/remplir_fichier_adht.php?id_file_adht={$item_fichier.id_file_adht}" title="{_LANG_LISTE_FICHIERS_ADHT_VISU_FILE_ICON_TITLE}Visualisation des informations fichier">{$item_fichier.nom_file_adht}</a>
				{else}<span class="Texterouge"> 							{* Nom fichier en rouge si fiche supprimée *}
					{$item_fichier.nom_file_adht}</span>
				{/if}</td>
			<td>{$item_fichier.designation_file_adht}</td>					{* Description fichier *}
			<td>{$item_fichier.date_file_adht}</td>							{* Date du dépôt du fichier *}
			<td>{$item_fichier.nom_adht} {$item_fichier.prenom_adht}</td>	{* Nom Prénom Adhérent *}
			<td class="centre-txt">
		{* les 3 Actions *}
			{if $priorite_adht >= 5 && $item_fichier.file_adht != '999'}
				{* Action : lien vers Gestion fichier N°... *}
				<a href="../adherent/remplir_fichier_adht.php?id_file_adht={$item_fichier.id_file_adht}{if $item_fichier.file_adht =='999'}&amp;archive_file_adht=1{/if}"><img src="../images/icones16/i_voir.png" width="16" height="16" alt="" title="{_LANG_LISTE_FICHIERS_ADHT_VISU_FILE_ICON_TITLE}"></a>&nbsp;
				{* Action : lien vers Télécharger le fichier ... *}
				<a href="../adherent/liste_fichiers_adht.php?fichier_adht=1&amp;id_file_adht={$item_fichier.id_file_adht}"><img src="../images/icones16/i_disquet.png" width="16" height="16" alt="" title="{_LANG_LISTE_FICHIERS_ADHT_DOWNLOAD_FILE_ICON_TITLE}"></a>&nbsp;
				{* Action : lien vers Supprimer fichier N°... *}
				<a href="../adherent/liste_fichiers_adht.php?supp_fichier_adht=1&amp;id_file_adht={$item_fichier.id_file_adht}" onclick="return confirm('{_LANG_LISTE_FICHIERS_ADHT_JS_CONFIRM_FILE}{$item_fichier.id_file_adht}')"><img src="../images/icones16/i_delete.png" width="16" height="16" alt="" title="{_LANG_LISTE_FICHIERS_ADHT_DEL_FILE_ICON_TITLE}"></a>

			{else}
				{* Action : lien vers Consultation Fichier supprimé *}
				<a href="../adherent/remplir_fichier_adht.php?id_file_adht={$item_fichier.id_file_adht}{if $item_fichier.file_adht =='999'}&amp;archive_file_adht=1{/if}"><img src="../images/icones16/i_ficharch.png" width="16" height="16" alt="" title="{_LANG_LISTE_FICHIERS_ADHT_VISU_FILE_ICON_TITLE}"></a>
			{/if}</td>
		</tr>
{foreachelse}
		{* La liste est vide *}
		<tr><td colspan="6">{_LANG_TPL_LISTE_VIDE}</td></tr>
{/foreach}
	</table>
{* FIN Affichage de la Table des adhérents *}

	{* Affichage NB pages *}
	<div class="aff_droite-txt">{_LANG_TPL_PAGES}<span class="NumPageGras">
			{section name = pageLoop start = 1 loop = $nb_pages}
				{if $smarty.section.pageLoop.index eq $numpage}
					{$smarty.section.pageLoop.index}
				{else}
					<a href="liste_fichiers_adht.php?numpage_affiche={$smarty.section.pageLoop.index}&amp;affiche_nb_fich={$affiche_nb_fich}&amp;filtrefichier={$filtrefichier_ou}&amp;filtre_nom={$filtre_adht_nom}" title="{_LANG_TPL_GO_PAGES}">{$smarty.section.pageLoop.index}</a>
				{/if}
			{/section}</span></div>


	</div>
{* FIN défini le contenu .. *}
