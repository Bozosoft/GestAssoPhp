{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2022 (c) JC Etiemble HTML5 *}
{* Affichage du CONTENU avec AIDE Liste fichiers des adhérents *}
	<header class="header_titre_aide"><a href='#' style="cursor:pointer;" onclick="javascript :window.open('../aide/a_adht_liste_fichiers_adht.php','popup','height=620,toolbar=no,location=no,directories=no,status=yes,width=660,resizable=no,scrollbars=yes,top=10,left=10')" title="{language name = title_aide}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20">{language name = aide}</a></header>

    <header class="header_titre">{language name = menu_admin_gestion}&nbsp;-&nbsp;{language name = titre_admin_liste_fichiers_adht}
    {if !empty($affiche_message)}{$affiche_message}{/if}</header>
	<div class="ligne_coul"></div>
	<div id="contenu">
{* défini le contenu .. *}

{* Affichage  Recherche *}
	<form action="liste_fichiers_adht.php" method="get" name="filtre">
		<div id="listfilter">
			<input type="submit" class="submit_ok" value="{language name = tpl_filter_button}" title="{language name = tpl_filter_button_title}">
			<label for="filtre_nom">{language name = liste_fichiers_adht_parmi}</label>
				{* filtrer parmi les noms/prénoms *}
			<input type="text" name="filtre_nom" id="filtre_nom" value="{$filtre_adht_nom}" title="{language name = tpl_liste_adht_parmi_title}">&nbsp;
		 	{language name = tpl_texte_select}
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
				{language name = liste_fichiers_adht_files} 
			{else}
				{language name = liste_fichiers_adht_file} 
			{/if}
			 &nbsp;&nbsp;<a href="../adherent/remplir_fichier_adht.php"><span class="submit_ok" title="{language name = liste_fichiers_adht_adfile_button_title}">&nbsp; {language name = liste_fichiers_adht_adfile_button}&nbsp;</span></a></td>
			<td class="centre-txt">{language name = tpl_select_affichepar}
				<select name="affiche_nb_fich" onchange="form.submit()">
					{html_options options = $affichenb_adht_options selected = $affiche_nb_fich}
				</select>
			</td>
			{* Affichage NB pages *}
			<td class="aff_droite-txt">{language name = tpl_pages}<span class="NumPageGras">
				{section name = pageLoop start = 1 loop = $nb_pages}
					{if $smarty.section.pageLoop.index eq $numpage}
						{$smarty.section.pageLoop.index}
					{else}
						<a href="liste_fichiers_adht.php?numpage_affiche={$smarty.section.pageLoop.index}&amp;affiche_nb_fich={$affiche_nb_fich}&amp;filtrefichier={$filtrefichier_ou}&amp;filtre_nom={$filtre_adht_nom}" title="{language name = tpl_go_pages}">{$smarty.section.pageLoop.index}</a>
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
				<a href="liste_fichiers_adht.php?tri=0&amp;affiche_nb_fich={$affiche_nb_fich}&amp;filtrefichier={$filtrefichier_ou}&amp;filtre_nom={$filtre_adht_nom}" title="{language name = tpl_title_clictri}">#</a>
				{if $smarty.session.tri eq 0}
					{if $smarty.session.tri_sens eq 0}
						<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name = tpl_title_clictri_up}">
					{else}
						<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{language name = tpl_title_clictri_down}">
					{/if}
				{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt="">
				{/if}
			</th>
		{* Nom fichier *}
			<th class="LignegrisTC" style="width:25%;">
				<a href="liste_fichiers_adht.php?tri=1&amp;affiche_nb_fich={$affiche_nb_fich}&amp;filtrefichier={$filtrefichier_ou}&amp;filtre_nom={$filtre_adht_nom}" title="{language name = tpl_title_clictri}">{language name = liste_fichiers_col_nomfichier}</a>
				{if $smarty.session.tri eq 1}
					{if $smarty.session.tri_sens eq 0}
						<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name = tpl_title_clictri_up}">
					{else}
						<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{language name = tpl_title_clictri_down}">
					{/if}
				{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt="">
				{/if}
			</th>
		{* Description fichier *}
			<th class="LignegrisTC" style="width:24%;">
				<a href="liste_fichiers_adht.php?tri=2&amp;affiche_nb_fich={$affiche_nb_fich}&amp;filtrefichier={$filtrefichier_ou}&amp;filtre_nom={$filtre_adht_nom}" title="{language name = tpl_title_clictri}">{language name = tpl_col_description}</a>
				{if $smarty.session.tri eq 2}
					{if $smarty.session.tri_sens eq 0}
						<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name = tpl_title_clictri_up}">
					{else}
						<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{language name = tpl_title_clictri_down}">
					{/if}
				{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt="">
				{/if}
			</th>
		{* Date du dépôt du fichier *}
			<th class="LignegrisTC" style="width:12%;">
				<a href="liste_fichiers_adht.php?tri=3&amp;affiche_nb_fich={$affiche_nb_fich}&amp;filtrefichier={$filtrefichier_ou}&amp;filtre_nom={$filtre_adht_nom}" title="{language name = tpl_title_clictri}">{language name = tpl_col_date}</a>
				{if $smarty.session.tri eq 3}
					{if $smarty.session.tri_sens eq 0}
						<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name = tpl_title_clictri_up}">
					{else}
						<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{language name = tpl_title_clictri_down}">
					{/if}
				{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt="">
				{/if}
			</th>
		{* Nom Prénom Adhérent *}
			<th class="LignegrisTC" style="width:23%;">
				<a href="liste_fichiers_adht.php?tri=4&amp;affiche_nb_fich={$affiche_nb_fich}&amp;filtrefichier={$filtrefichier_ou}&amp;filtre_nom={$filtre_adht_nom}" title="{language name = tpl_title_clictri}">{language name = tpl_col_adht_nom} {$adherent_bene}</a>
				{if $smarty.session.tri eq 4}
					{if $smarty.session.tri_sens eq 0}
						<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name = tpl_title_clictri_up}">
					{else}
						<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{language name = tpl_title_clictri_down}">
					{/if}
				{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt="">
				{/if}
			</th>
		{* Actions *}
			<th class="LignegrisTC" style="width:12%;">{language name = tpl_col_actions}
			</th>

		</tr>
{foreach from = $fichier item = item_fichier key = ordre}
		<tr class="Lignegris{$item_fichier.coul}">
			<td>{$item_fichier.id_file_adht}</td>
			<td>{if $item_fichier.file_adht != '999'} 						{* Nom fichier lien vers Gestion fichier N°.. *}
					<a href="../adherent/remplir_fichier_adht.php?id_file_adht={$item_fichier.id_file_adht}" title="{language name = liste_fichiers_adht_visu_file_icon_title}Visualisation des informations fichier">{$item_fichier.nom_file_adht}</a>
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
				<a href="../adherent/remplir_fichier_adht.php?id_file_adht={$item_fichier.id_file_adht}{if $item_fichier.file_adht =='999'}&amp;archive_file_adht=1{/if}"><img src="../images/icones16/i_voir.png" width="16" height="16" alt="" title="{language name = liste_fichiers_adht_visu_file_icon_title}"></a>&nbsp;
				{* Action : lien vers Télécharger le fichier ... *}
				<a href="../adherent/liste_fichiers_adht.php?fichier_adht=1&amp;id_file_adht={$item_fichier.id_file_adht}"><img src="../images/icones16/i_disquet.png" width="16" height="16" alt="" title="{language name = liste_fichiers_adht_download_file_icon_title}"></a>&nbsp;
				{* Action : lien vers Supprimer fichier N°... *}
				<a href="../adherent/liste_fichiers_adht.php?supp_fichier_adht=1&amp;id_file_adht={$item_fichier.id_file_adht}" onclick="return confirm('{language name = liste_fichiers_adht_js_confirm_file}{$item_fichier.id_file_adht}')"><img src="../images/icones16/i_delete.png" width="16" height="16" alt="" title="{language name = liste_fichiers_adht_del_file_icon_title}"></a>

			{else}
				{* Action : lien vers Consultation Fichier supprimé *}
				<a href="../adherent/remplir_fichier_adht.php?id_file_adht={$item_fichier.id_file_adht}{if $item_fichier.file_adht =='999'}&amp;archive_file_adht=1{/if}"><img src="../images/icones16/i_ficharch.png" width="16" height="16" alt="" title="{language name = liste_fichiers_adht_visu_file_icon_title}"></a>
			{/if}</td>
		</tr>
{foreachelse}
		{* La liste est vide *}
		<tr><td colspan="6">{language name = tpl_liste_vide}</td></tr>
{/foreach}
	</table>
{* FIN Affichage de la Table des adhérents *}

	{* Affichage NB pages *}
	<div class="aff_droite-txt">{language name = tpl_pages}<span class="NumPageGras">
			{section name = pageLoop start = 1 loop = $nb_pages}
				{if $smarty.section.pageLoop.index eq $numpage}
					{$smarty.section.pageLoop.index}
				{else}
					<a href="liste_fichiers_adht.php?numpage_affiche={$smarty.section.pageLoop.index}&amp;affiche_nb_fich={$affiche_nb_fich}&amp;filtrefichier={$filtrefichier_ou}&amp;filtre_nom={$filtre_adht_nom}" title="{language name = tpl_go_pages}">{$smarty.section.pageLoop.index}</a>
				{/if}
			{/section}</span></div>


	</div>
{* FIN défini le contenu .. *}
