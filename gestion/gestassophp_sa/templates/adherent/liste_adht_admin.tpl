{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2023 (c) JC Etiemble HTML5 *}
{* Affichage du CONTENU avec AIDE  Liste des adhérents *}

	<header class="header_titre_aide"><a href='#' style="cursor:pointer;" onclick="javascript :window.open('../aide/a_adht_liste_admin.php','popup','height=650,toolbar=no,location=no,directories=no,status=yes,width=660,resizable=no,scrollbars=yes,top=10,left=10')" title="{_LANG_TITLE_AIDE}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20">{_LANG_AIDE}</a></header>

    <header class="header_titre">{_LANG_MENU_ADMIN_GESTION}&nbsp;-&nbsp;{_LANG_TITRE_ADMIN_LISTE_ADHT}</header>
	<div class="ligne_coul"></div>
	<div id="contenu">
{* défini le contenu .. *}

{* Alerte si supression fiche avec cotisation(s) existante(s) non archivée(s) - affiche la date la plus tardive si X cotisations *}
	{if !empty($erreur_suppression_fiche) && $erreur_suppression_fiche == 1}
		<div id="erreur-box">  {_LANG_ADMIN_LISTE_ADHT_ATT} {$erreur_suppression_id}{* ID adhérent+Nom prénom *} !! <br>
		{_LANG_LISTE_COTIS_ADHT_ARCHIV_ALERT} - {_LANG_ADMIN_LISTE_ADHT_DATE_F_COTIS}{$erreur_suppression_date}
		{* Date de fin de cotisation : xx/xx/xx - il est obligatoire d'archiver la fiche cotisation *}
		</div>
	{/if}

{* Alerte si supression fiche avec niveau priorité > 0 *}
	{if !empty($erreur1_suppression_fiche) && $erreur1_suppression_fiche == 1}
		<div id="erreur-box">  {_LANG_ADMIN_LISTE_ADHT_ATT} {$erreur1_suppression_id}{* ID adhérent+Nom prénom *} !! <br> - {_LANG_ADMIN_LISTE_ADHT_ALERT_PRIORITE}{$erreur1_suppression_priorite} {* niveau priorité *} <br>
		{* lien vers Priorité Accès *}
		<a href="../admin/remplir_priorite.php" title="{_LANG_TITRE_ADMIN_GERER_PRIORITE_ADHERENTS}">{_LANG_ADMIN_LISTE_ADHT_ALERT_PRIORITE_0} </a>
		</div>
	{/if}

{* Affichage  Recherche *}
	<form action="liste_adht_admin.php" method="get" name="filtre">
{* Filtrer les fiches ... *}
		<div id="listfilter">
			<input type="submit" class="submit_ok" value="{_LANG_TPL_FILTER_BUTTON}" title="{_LANG_TPL_FILTER_BUTTON_TITLE}">
			<label for="filtre_nom">{_LANG_LISTE_ADHT_PARMI}</label>
				{* filtrer parmi les noms/prénoms *}
			<input type="text" name="filtre_nom" id="filtre_nom" value="{$filtre_adht_nom}" title="{_LANG_TPL_LISTE_ADHT_PARMI_TITLE}">&nbsp;
		 	{_LANG_TPL_TEXTE_SELECT}
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
			&nbsp;&nbsp;<a href="../adherent/remplir_infogene_adht.php"><span class="submit_ok" title="{_LANG_ADMIN_LISTE_ADHT_ADDADHT_BUTTON_TITLE}">&nbsp;{_LANG_ADMIN_LISTE_ADHT_ADDADHT_BUTTON_TITLE}&nbsp;</span></a></td>
			<td class="centre-txt">{_LANG_TPL_SELECT_AFFICHEPAR}
				<select name="affiche_nb_adht" onchange="form.submit()">
					{* Afficher par Nb de lignes par page *}
					{html_options options = $affichenb_adht_options selected = $affiche_nb_adht}
				</select>
			</td>
			{* Affichage NB pages *}
			<td class="aff_droite-txt">{_LANG_TPL_PAGES}<span class="NumPageGras">
				{section name = pageLoop start=1 loop = $nb_pages}
					{if $smarty.section.pageLoop.index eq $numpage}
						{$smarty.section.pageLoop.index}
					{else}
						<a href="liste_adht_admin.php?numpage_affiche={$smarty.section.pageLoop.index}&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{_LANG_TPL_GO_PAGES}">{$smarty.section.pageLoop.index}</a>
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
				<!-- a href="liste_adht_admin.php?tri=0&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={$filtremembre_adht}&amp;filtre_nom={$filtre_adht_nom}" title="{_LANG_TPL_TITLE_CLICTRI}">#</a -->
				<a href="liste_adht_admin.php?tri=0&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{_LANG_TPL_TITLE_CLICTRI}">#</a>
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
		{* Nom Prénom *}
			<th class="LignegrisTC" style="width:20%;">
				<a href="liste_adht_admin.php?tri=1&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{_LANG_TPL_TITLE_CLICTRI}">{_LANG_TPL_COL_NOMPRE}</a>
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
		{* Ville *}
			<th class="LignegrisTC" style="width:20%;">
				<a href="liste_adht_admin.php?tri=2&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{_LANG_TPL_TITLE_CLICTRI}">{_LANG_TPL_COL_ADHT_VILLE}</a>
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
		{* Date Inscription *}
			<th class="LignegrisTC" style="width:12%;">
				<a href="liste_adht_admin.php?tri=3&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{_LANG_TPL_TITLE_CLICTRI}">{_LANG_ADMIN_LISTE_ADHT_COL_INSCRIPT}</a>
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
		{* Echéance Cotisation *}
			<th class="LignegrisTC" style="width:11%;">
				<a href="liste_adht_admin.php?tri=4&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{_LANG_TPL_TITLE_CLICTRI}">{_LANG_ADMIN_LISTE_ADHT_COL_ECH}</a>
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
		{* qui a enrregistré la fiche *}
			<th class="LignegrisTC" style="width:5%;">
				<a href="liste_adht_admin.php?tri=5&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{_LANG_TPL_TITLE_CLICTRI}">{_LANG_ADMIN_LISTE_ADHT_COL_ENR}</a>
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
		{* sections ou secteurs d'activité *}
			<th class="LignegrisTC" style="width:16%;">
				<a href="liste_adht_admin.php?tri=6&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{_LANG_TPL_TITLE_CLICTRI}">{_LANG_PREF_LANG_FICHE_ADHT_ANT}</a>
				{if $smarty.session.tri eq 6}
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

{foreach from = $membres item = item_membres key = ordre}
		<tr class="Lignegris{$item_membres.coul}">
			<td>{$item_membres.id_adht}</td>				{* # *}
			<td>
			{if $filtremembre_adht != '3'}
				{* Toutes les fiches sauf 3 = 'Les fiches supprimées' *}
				<a href="../adherent/gerer_fiche_adht.php?id_adht={$item_membres.id_adht}" title="{_LANG_LISTE_ADHT_VISU_ICON_TITLE}">{$item_membres.nom_adht} {$item_membres.prenom_adht}</a>	{* Nom Prénom lien vers Visualisation et Gestion de mes informations *}
				{if $item_membres.soc_adht == '999'} {* Si fiche supprimée ajout icône delete *}
					<img src="../images/icones16/i_delete.png" width="16" height="16" alt="" title="{_LANG_ADMIN_LISTE_ADHT_FICHE_DEL_ICON_TITLE}">
				{/if}
			{else}<span class="Texterouge">{$item_membres.nom_adht} {$item_membres.prenom_adht} {* Nom Prénom en rouge si fiche supprimée *}
				{if $item_membres.soc_adht == '999'} {* Si fiche supprimée ajout icône delete *}
					<img src="../images/icones16/i_delete.png" width="16" height="16" alt="" title="{_LANG_ADMIN_LISTE_ADHT_FICHE_DEL_ICON_TITLE}">
				{/if}</span>
			{/if}</td>
			<td>{$item_membres.ville_adht}</td>				{* Ville *}
			<td>{$item_membres.date_adht}</td>				{* Date Inscription *}
			<td>&nbsp;{$item_membres.fin_cotisation}</td> 	{* Echéance Cotisation *}

			<td>
			{if $item_membres.qui_enrg_adht != 0}			{* qui a enrregistré la fiche avec lien vers sa fiche *}
				&nbsp;<a href="../adherent/consulter_fiche_adht_admin2.php?id_adht={$item_membres.qui_enrg_adht}" title="{_LANG_ADMIN_LISTE_ADHT_ENR_TITLE} {$item_membres.pnom_creation_fiche_adht}">{$item_membres.qui_enrg_adht}</a>
			{/if}
			</td>

			<td>&nbsp;{$item_membres.nom_type_antenne}</td>	{* sections ou secteurs d'activité *}

			<td class="centre-txt">
		{* les 4 Actions *}
		{if $item_membres.soc_adht <> '999'}
			{if $priorite_adht >= 7}
				{* Action = Visualisation et Gestion informations *}
				<a href="../adherent/gerer_fiche_adht.php?id_adht={$item_membres.id_adht}"><img src="../images/icones16/i_voir.png" width="16" height="16" alt="" title="{_LANG_LISTE_ADHT_VISU_ICON_TITLE}"></a>&nbsp;
				{* Action = Joindre un fichier *}
				<a href="../adherent/remplir_fichier_adht.php?id_adht_file={$item_membres.id_adht}"><img src="../images/icones16/i_folder.png" width="16" height="16" alt="" title="{_LANG_ADMIN_LISTE_ADHT_ADDFILE_TITLE}"></a>&nbsp;
				{* Action = Gérer les cotisations *}
				<a href="../adherent/liste_cotisations_adht.php?id_adht={$item_membres.id_adht}"><img src="../images/icones16/i_euro.png" width="16" height="16" alt="" title="{_LANG_ADMIN_LISTE_ADHT_COTIS_ICON_TITLE}"></a>
				{* Supprimer la fiche *}
				<a href="../adherent/liste_adht_admin.php?supp_fiche_adht=1&amp;id_adht={$item_membres.id_adht}" onclick="return confirm(' {_LANG_ADMIN_LISTE_ADHT_JS_CONFIRM_DELFICHE} {$item_membres.id_adht}')"><img src="../images/icones16/i_delete.png" width="16" height="16" alt="" title="{_LANG_ADMIN_LISTE_ADHT_DEL_FICHE_ICON_TITLE}"></a>
			{else if $priorite_adht >= 5}
				{* Action = Visualisation et Gestion informations *}
				<a href="../adherent/gerer_fiche_adht.php?id_adht={$item_membres.id_adht}"><img src="../images/icones16/i_voir.png" width="16" height="16" alt="" title="{_LANG_LISTE_ADHT_VISU_ICON_TITLE}"></a>&nbsp;
				{* Action = Joindre un fichier *}
				<a href="../adherent/remplir_fichier_adht.php?id_adht_file={$item_membres.id_adht}"><img src="../images/icones16/i_folder.png" width="16" height="16" alt="" title="{_LANG_ADMIN_LISTE_ADHT_ADDFILE_TITLE}"></a>
			{/if}
			{else if $priorite_adht >= 7 && $item_membres.soc_adht == '999'}
				{* Action = Visualisation et Gestion informations avec possibilté de réactiver la fiche *}
				<a href="../adherent/gerer_fiche_adht.php?id_adht={$item_membres.id_adht}"><img src="../images/icones16/i_ficharch.png" width="16" height="16" alt="" title="{_LANG_LISTE_ADHT_VISU_ICON_TITLE}"></a>
			{/if}
			</td>
		</tr>
{foreachelse}
		{* La liste est vide *}
		<tr><td colspan="8">{_LANG_TPL_LISTE_VIDE}</td></tr>
{/foreach}
	</table>
{* FIN Affichage de la Table des adhérents *}

	{* Affichage NB pages *}
	<div class="aff_droite-txt">{_LANG_TPL_PAGES}<span class="NumPageGras">
			{section name = pageLoop start = 1 loop = $nb_pages}
				{if $smarty.section.pageLoop.index eq $numpage}
					{$smarty.section.pageLoop.index}
				{else}
					<a href="liste_adht_admin.php?numpage_affiche={$smarty.section.pageLoop.index}&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={if !empty($filtremembre_adht)}{$filtremembre_adht}{/if}&amp;filtre_nom={if !empty($filtre_adht_nom)}{$filtre_adht_nom}{/if}" title="{_LANG_TPL_GO_PAGES}">{$smarty.section.pageLoop.index}</a>
				{/if}
			{/section}</span></div>

	</div>
{* FIN défini le contenu .. *}
