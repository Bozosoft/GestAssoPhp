{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2022 (c) JC Etiemble HTML5 *}
{* Affichage du CONTENU avec AIDE  Liste des adhérents *}

	<header class="header_titre_aide"><a href='#' style="cursor:pointer;" onclick="javascript :window.open('../aide/a_adht_liste_admin.php','popup','height=650,toolbar=no,location=no,directories=no,status=yes,width=660,resizable=no,scrollbars=yes,top=10,left=10')" title="{language name = title_aide}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20">{language name = aide}</a></header>

    <header class="header_titre">{language name = menu_admin_gestion}&nbsp;-&nbsp;{language name = titre_admin_liste_adht}</header>
	<div class="ligne_coul"></div>
	<div id="contenu">
{* défini le contenu .. *}

{* Alerte si supression fiche avec cotisation(s) existante(s) non archivée(s) - affiche la date la plus tardive si X cotisations *}
	{if !empty($erreur_suppression_fiche) && $erreur_suppression_fiche == 1}
		<div id="erreur-box">  {language name=admin_liste_adht_att} {$erreur_suppression_id}{* ID adhérent+Nom prénom *} !! <br>
		{language name = liste_cotis_adht_archiv_alert} - {language name=admin_liste_adht_date_f_cotis}{$erreur_suppression_date}
		{* Date de fin de cotisation : xx/xx/xx - il est obligatoire d'archiver la fiche cotisation *}
		</div>
	{/if}

{* Alerte si supression fiche avec niveau priorité > 0 *}
	{if !empty($erreur1_suppression_fiche) && $erreur1_suppression_fiche == 1}
		<div id="erreur-box">  {language name=admin_liste_adht_att} {$erreur1_suppression_id}{* ID adhérent+Nom prénom *} !! <br> - {language name=admin_liste_adht_alert_priorite}{$erreur1_suppression_priorite} {* niveau priorité *} <br>
		{* lien vers Priorité Accès *}
		<a href="../admin/remplir_priorite.php" title="{language name = titre_admin_gerer_priorite_adherents}">{language name=admin_liste_adht_alert_priorite_0} </a>
		</div>
	{/if}

{* Affichage  Recherche *}
	<form action="liste_adht_admin.php" method="get" name="filtre">
{* Filtrer les fiches ... *}
		<div id="listfilter">
			<input type="submit" class="submit_ok" value="{language name = tpl_filter_button}" title="{language name = tpl_filter_button_title}">
			<label for="filtre_nom">{language name = liste_adht_parmi}</label>
				{* filtrer parmi les noms/prénoms *}
			<input type="text" name="filtre_nom" id="filtre_nom" value="{$filtre_adht_nom}" title="{language name = tpl_liste_adht_parmi_title}">&nbsp;
		 	{language name = tpl_texte_select}
			<select name="filtre_membre" onchange="form.submit()">
				{* Sélectionner le filtre_membre : 0 = actifs, 1 = à jour, 2 = en retard, 3 = fiches supprimées,4 = Toutes les fiches *}
				{html_options options = $filtre_options selected = $filtremembre_adht}
			</select>

		</div>

{* Affichage NB adhérents -  - NB pages *}
	<table style="width:100%;">
		<tr>
			<td>{$nb_lines}
			{if $nb_lines > 1}
				{$adherent_bene}s
			{else}
				{$adherent_bene}
			{/if}
			&nbsp;&nbsp;<a href="../adherent/remplir_infogene_adht.php"><span class="submit_ok" title="{language name=admin_liste_adht_addadht_button_title}">&nbsp;{language name=admin_liste_adht_addadht_button_title}&nbsp;</span></a></td>
			<td class="centre-txt">{language name = tpl_select_affichepar}
				<select name="affiche_nb_adht" onchange="form.submit()">
					{* Afficher par Nb de lignes par page *}
					{html_options options = $affichenb_adht_options selected = $affiche_nb_adht}
				</select>
			</td>
			{* Affichage NB pages *}
			<td class="aff_droite-txt">{language name = tpl_pages}<span class="NumPageGras">
				{section name = pageLoop start=1 loop = $nb_pages}
					{if $smarty.section.pageLoop.index eq $numpage}
						{$smarty.section.pageLoop.index}
					{else}
						<a href="liste_adht_admin.php?numpage_affiche={$smarty.section.pageLoop.index}&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{language name = tpl_go_pages}">{$smarty.section.pageLoop.index}</a>
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
				<!-- a href="liste_adht_admin.php?tri=0&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={$filtremembre_adht}&amp;filtre_nom={$filtre_adht_nom}" title="{language name = tpl_title_clictri}">#</a -->
				<a href="liste_adht_admin.php?tri=0&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{language name = tpl_title_clictri}">#</a>
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
		{* Nom Prénom *}
			<th class="LignegrisTC" style="width:20%;">
				<a href="liste_adht_admin.php?tri=1&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{language name = tpl_title_clictri}">{language name = tpl_col_nompre}</a>
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
		{* Ville *}
			<th class="LignegrisTC" style="width:20%;">
				<a href="liste_adht_admin.php?tri=2&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{language name = tpl_title_clictri}">{language name = tpl_col_adht_ville}</a>
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
		{* Date Inscription *}
			<th class="LignegrisTC" style="width:12%;">
				<a href="liste_adht_admin.php?tri=3&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{language name = tpl_title_clictri}">{language name=admin_liste_adht_col_inscript}</a>
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
		{* Echéance Cotisation *}
			<th class="LignegrisTC" style="width:11%;">
				<a href="liste_adht_admin.php?tri=4&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{language name = tpl_title_clictri}">{language name=admin_liste_adht_col_ech}</a>
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
		{* qui a enrregistré la fiche *}
			<th class="LignegrisTC" style="width:5%;">
				<a href="liste_adht_admin.php?tri=5&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{language name = tpl_title_clictri}">{language name=admin_liste_adht_col_enr}</a>
				{if $smarty.session.tri eq 5}
					{if $smarty.session.tri_sens eq 0}
						<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name = tpl_title_clictri_up}">
					{else}
						<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{language name = tpl_title_clictri_down}">
					{/if}
				{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt="">
				{/if}
			</th>
		{* sections ou secteurs d'activité *}
			<th class="LignegrisTC" style="width:16%;">
				<a href="liste_adht_admin.php?tri=6&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{language name = tpl_title_clictri}">{language name = fiche_adht_ant}</a>
				{if $smarty.session.tri eq 6}
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

{foreach from = $membres item = item_membres key = ordre}
		<tr class="Lignegris{$item_membres.coul}">
			<td>{$item_membres.id_adht}</td>				{* # *}
			<td>
			{if $filtremembre_adht != '3'}
				{* Toutes les fiches sauf 3 = 'Les fiches supprimées' *}
				<a href="../adherent/gerer_fiche_adht.php?id_adht={$item_membres.id_adht}" title="{language name = liste_adht_visu_icon_title}">{$item_membres.nom_adht} {$item_membres.prenom_adht}</a>	{* Nom Prénom lien vers Visualisation et Gestion de mes informations *}
				{if $item_membres.soc_adht == '999'} {* Si fiche supprimée ajout icône delete *}
					<img src="../images/icones16/i_delete.png" width="16" height="16" alt="" title="{language name=admin_liste_adht_fiche_del_icon_title}">
				{/if}
			{else}<span class="Texterouge">{$item_membres.nom_adht} {$item_membres.prenom_adht} {* Nom Prénom en rouge si fiche supprimée *}
				{if $item_membres.soc_adht == '999'} {* Si fiche supprimée ajout icône delete *}
					<img src="../images/icones16/i_delete.png" width="16" height="16" alt="" title="{language name=admin_liste_adht_fiche_del_icon_title}">
				{/if}</span>
			{/if}</td>
			<td>{$item_membres.ville_adht}</td>				{* Ville *}
			<td>{$item_membres.date_adht}</td>				{* Date Inscription *}
			<td>&nbsp;{$item_membres.fin_cotisation}</td> 	{* Echéance Cotisation *}

			<td>
			{if $item_membres.qui_enrg_adht != 0}			{* qui a enrregistré la fiche avec lien vers sa fiche *}
				&nbsp;<a href="../adherent/consulter_fiche_adht_admin2.php?id_adht={$item_membres.qui_enrg_adht}" title="{language name=admin_liste_adht_enr_title} {$item_membres.pnom_creation_fiche_adht}">{$item_membres.qui_enrg_adht}</a>
			{/if}
			</td>

			<td>&nbsp;{$item_membres.nom_type_antenne}</td>	{* sections ou secteurs d'activité *}

			<td class="centre-txt">
		{* les 4 Actions *}
		{if $item_membres.soc_adht <> '999'}
			{if $priorite_adht >= 7}
				{* Action = Visualisation et Gestion informations *}
				<a href="../adherent/gerer_fiche_adht.php?id_adht={$item_membres.id_adht}"><img src="../images/icones16/i_voir.png" width="16" height="16" alt="" title="{language name = liste_adht_visu_icon_title}"></a>&nbsp;
				{* Action = Joindre un fichier *}
				<a href="../adherent/remplir_fichier_adht.php?id_adht_file={$item_membres.id_adht}"><img src="../images/icones16/i_folder.png" width="16" height="16" alt="" title="{language name=admin_liste_adht_addfile_title}"></a>&nbsp;
				{* Action = Gérer les cotisations *}
				<a href="../adherent/liste_cotisations_adht.php?id_adht={$item_membres.id_adht}"><img src="../images/icones16/i_euro.png" width="16" height="16" alt="" title="{language name=admin_liste_adht_cotis_icon_title}"></a>
				{* Supprimer la fiche *}
				<a href="../adherent/liste_adht_admin.php?supp_fiche_adht=1&amp;id_adht={$item_membres.id_adht}" onclick="return confirm(' {language name=admin_liste_adht_js_confirm_delfiche} {$item_membres.id_adht}')"><img src="../images/icones16/i_delete.png" width="16" height="16" alt="" title="{language name=admin_liste_adht_del_fiche_icon_title}"></a>
			{else if $priorite_adht >= 5}
				{* Action = Visualisation et Gestion informations *}
				<a href="../adherent/gerer_fiche_adht.php?id_adht={$item_membres.id_adht}"><img src="../images/icones16/i_voir.png" width="16" height="16" alt="" title="{language name = liste_adht_visu_icon_title}"></a>&nbsp;
				{* Action = Joindre un fichier *}
				<a href="../adherent/remplir_fichier_adht.php?id_adht_file={$item_membres.id_adht}"><img src="../images/icones16/i_folder.png" width="16" height="16" alt="" title="{language name=admin_liste_adht_addfile_title}"></a>
			{/if}
			{else if $priorite_adht >= 7 && $item_membres.soc_adht == '999'}
				{* Action = Visualisation et Gestion informations avec possibilté de réactiver la fiche *}
				<a href="../adherent/gerer_fiche_adht.php?id_adht={$item_membres.id_adht}"><img src="../images/icones16/i_ficharch.png" width="16" height="16" alt="" title="{language name = liste_adht_visu_icon_title}"></a>
			{/if}
			</td>
		</tr>
{foreachelse}
		{* La liste est vide *}
		<tr><td colspan="8">{language name = tpl_liste_vide}</td></tr>
{/foreach}
	</table>
{* FIN Affichage de la Table des adhérents *}

	{* Affichage NB pages *}
	<div class="aff_droite-txt">{language name = tpl_pages}<span class="NumPageGras">
			{section name = pageLoop start = 1 loop = $nb_pages}
				{if $smarty.section.pageLoop.index eq $numpage}
					{$smarty.section.pageLoop.index}
				{else}
					<a href="liste_adht_admin.php?numpage_affiche={$smarty.section.pageLoop.index}&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{language name = tpl_go_pages}">{$smarty.section.pageLoop.index}</a>
				{/if}
			{/section}</span></div>

	</div>
{* FIN défini le contenu .. *}
