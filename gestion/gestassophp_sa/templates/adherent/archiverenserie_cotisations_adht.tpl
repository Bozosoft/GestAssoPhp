{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2023 (c) JC Etiemble HTML5 *}
{* Affichage du CONTENU avec AIDE + Archiver en série les fiches Cotisations adhérents depuis V 7.3 *}
	<header class="header_titre_aide"><a href='#' style="cursor:pointer;" onclick="javascript :window.open('../aide/a_archiverenserie_cotisations_adht.php','popup','height=660,toolbar=no,location=no,directories=no,status=yes,width=680,resizable=no,scrollbars=yes,top=10,left=10')" title="{_LANG_TITLE_AIDE}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20">{_LANG_AIDE}</a></header>

    <header class="header_titre">{_LANG_MENU_ADMIN_GESTION}&nbsp;-&nbsp;{_LANG_TITRE_ADMIN_LISTEARCHIV_COTIS_ADHT}</header>
	<div class="ligne_coul"></div>
	<div id="contenu">
{* défini le contenu .. *}

{* Affichage  Recherche *}
{if !empty($erreur_saisie)}
	{if $erreur_saisie|@count != 0}
		<div id="erreur-box">{_LANG_TPL_TEXTE_ERR_SAISIE}
			{if !empty($erreur_saisie.d_datedeb) && $erreur_saisie.d_datedeb}<br><span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.d_datedeb}</span>{/if}
			{if !empty($erreur_saisie.d_datefin) && $erreur_saisie.d_datefin}<br><span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.d_datefin}</span>{/if}
			{if !empty($erreur_saisie.bd) && $erreur_saisie.bd}<br><span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.bd}</span>{/if}
		</div>
	{/if}
{/if}
{* Form .. *}
	<form action="archiverenserie_cotisations_adht.php" method="get" name="filtre">
{* Filtrer les cotisations ... *}
		<div id="listfilter">
		<input type="submit" class="submit_ok" value="{_LANG_TPL_FILTER_BUTTON}" title="{_LANG_TPL_FILTER_BUTTON_TITLE} des dates">
			<label for="select_datedeb">&nbsp;{_LANG_LISTE_COTIS_ADHT_TEXT_LESCOTIS}</label>&nbsp;
				{* filtrer parmi les cotisations du (date de début) *}
			<input type="text" name="select_datedeb" id="select_datedeb" maxlength="10" size="11" value="{$filtre_datedeb}" title="{_LANG_LISTE_COTIS_ADHT_SELECT_DATE_D}">
			<label for="select_datefin">&nbsp;{_LANG_LISTE_COTIS_ADHT_TEXT_AU}</label>&nbsp;
				{* filtrer parmi les cotisations au (date de fin) *}
			<input type="text" name="select_datefin" id="select_datefin" maxlength="10" size="11" value="{$filtre_datefin}" title="{_LANG_LISTE_COTIS_ADHT_SELECT_DATE_F}">&nbsp;
			<input type="hidden" name="id_adht" id="id_adht" value="{$id_adht}">{* pour passer l'id_adht *}
		</div>

{* Affichage NB cotisations -  - NB pages *}
	<table style="width:100%;">
		<tr>
			<td>{$nb_lines}&nbsp;
			{if $nb_lines > 1}
				{_LANG_LISTE_COTIS_ADHT_COTISS}
			{else}
				{_LANG_LISTE_COTIS_ADHT_COTIS}
			{/if}&nbsp;&nbsp;<a href="../admin/remplir_preferences.php" title="{_LANG_ADMIN_LISTE_ADHT_DATE_F_COTIS} {_LANG_TITRE_ADMIN_PREFERENCES}">{_LANG_LISTE_LISTEARCHIV_ADHT_COTIS}&nbsp;{$date_3112}</a>{* Avant le "Date fin cotisation" *}
			</td>
			{if $affiche_liste_complete =="1"}
				<td class="centre-txt">{_LANG_TPL_SELECT_AFFICHEPAR}
				<select name="affiche_nb_adht" onchange="form.submit()">
					{* Afficher par Nb de lignes par page *}
					{html_options options = $affichenb_adht_options selected = $affiche_nb_adht}
				</select>
				</td>
			{else}
				<td class="centre-txt">&nbsp;
				</td>
			{/if}

			<td class="aff_droite-txt">{_LANG_TPL_PAGES}<span class="NumPageGras">
				{section name = pageLoop start = 1 loop = $nb_pages}
					{if $smarty.section.pageLoop.index eq $numpage}
						{$smarty.section.pageLoop.index}
					{else}
						<a href="archiverenserie_cotisations_adht.php?numpage_affiche={$smarty.section.pageLoop.index}&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_fiche={$filtre_fiche}&amp;select_datedeb={$filtre_datedeb}&amp;select_datefin={$filtre_datefin}" title="{_LANG_TPL_GO_PAGES}">{$smarty.section.pageLoop.index}</a>
					{/if}
				{/section}</span>
			</td>
		</tr>
	</table>
{* FIN Affichage NB cotisations -  - NB pages *}
{* Fin Form .. *}
</form>
{* FIN Affichage  Recherche *}

{* Affichage de la Table des cotisations *}

	<table style="width:100%;">
		<tr>
		{* # *}
			<th class="LignegrisTC" style="width:4%;">
				<a href="archiverenserie_cotisations_adht.php?tri=0&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_fiche={$filtre_fiche}&amp;select_datedeb={$filtre_datedeb}&amp;select_datefin={$filtre_datefin}&amp;id_adht={$id_adht}" title="{_LANG_TPL_TITLE_CLICTRI}">#</a>
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
		{* Date d'enregistrement cotisation *}
			<th class="LignegrisTC" style="width:11%;">
				<a href="archiverenserie_cotisations_adht.php?tri=1&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_fiche={$filtre_fiche}&amp;select_datedeb={$filtre_datedeb}&amp;select_datefin={$filtre_datefin}&amp;id_adht={$id_adht}" title="{_LANG_TPL_TITLE_CLICTRI}"> {_LANG_LISTE_COTIS_ADHT_COL_D_ENR}</a>
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
		{* Date début cotisation *}
			<th class="LignegrisTC" style="width:11%;"> {_LANG_FICHE_COTIS_ADHT_DATE_DEB}
			{* Colonne 3 Date Début sans tri *}
			</th>
		{* Date fin cotisation *}
			<th class="LignegrisTC" style="width:11%;">
				<a href="archiverenserie_cotisations_adht.php?tri=3&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_fiche={$filtre_fiche}&amp;select_datedeb={$filtre_datedeb}&amp;select_datefin={$filtre_datefin}&amp;id_adht={$id_adht}" title="{_LANG_TPL_TITLE_CLICTRI}"> {_LANG_FICHE_COTIS_ADHT_DATE_FIN}</a>
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
		{* Nom Prénom *}
			<th class="LignegrisTC" style="width:24%;">
				<a href="archiverenserie_cotisations_adht.php?tri=4&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_fiche={$filtre_fiche}&amp;select_datedeb={$filtre_datedeb}&amp;select_datefin={$filtre_datefin}&amp;id_adht={$id_adht}" title="{_LANG_TPL_TITLE_CLICTRI}">{_LANG_TPL_COL_NOMPRE}</a>
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
		{* Type cotisation *}
			<th class="LignegrisTC" style="width:16%;">
				<a href="archiverenserie_cotisations_adht.php?tri=5&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_fiche={$filtre_fiche}&amp;select_datedeb={$filtre_datedeb}&amp;select_datefin={$filtre_datefin}&amp;id_adht={$id_adht}" title="{_LANG_TPL_TITLE_CLICTRI}"> {_LANG_LISTE_COTIS_ADHT_COL_TYPE}</a>
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
		{* Montant cotisation *}
			<th class="LignegrisTC" style="width:10%;">
				<a href="archiverenserie_cotisations_adht.php?tri=6&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_fiche={$filtre_fiche}&amp;select_datedeb={$filtre_datedeb}&amp;select_datefin={$filtre_datefin}&amp;id_adht={$id_adht}" title="{_LANG_TPL_TITLE_CLICTRI}"> {_LANG_LISTE_COTIS_ADHT_COL_MONTANT}</a>
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
		{* Statut *}
			<th class="LignegrisTC" style="width:5%;">{_LANG_TPL_COL_ACTIONS}
			</th>

		</tr>
{if !empty($cotis_adht)} {* s'il existe bien une cotisation *}
{foreach from = $cotis_adht item = item_cotis_adht key = ordre}
		<tr class="Lignegris{$item_cotis_adht.coul}">
			<td>{$item_cotis_adht.id_cotis}</td>			{* # *}
			<td>{$item_cotis_adht.date_enregist_cotis}</td>	{* Date d'enregistrement cotisation *}
			<td>{$item_cotis_adht.date_debut_cotis}</td>	{* Date début cotisation *}
			<td>{$item_cotis_adht.date_fin_cotis}</td>		{* Date fin cotisation *}
			<td >											{* Nom Prénom *}
			<a href="../adherent/liste_cotisations_adht.php?id_adht={$item_cotis_adht.id_adhtasso}" title="{_LANG_LISTE_COTIS_ADHT_LISTE_TITLE}"-->{$item_cotis_adht.nom_adht} {$item_cotis_adht.prenom_adht}</a>
			</td>
			<td>{$item_cotis_adht.nom_type_cotisation}</td> {* Type cotisation *}
			<td>{$item_cotis_adht.montant_cotis}</td> 		{* Montant cotisation *}
			<td class="centre-txt">
															{* Statut : lien vers Modifier la fiche cotisation *}
			<a href="../adherent/remplir_cotisations_adht.php?id_cotis={$item_cotis_adht.id_cotis}"><img src="../images/icones16/i_modif.png" width="16" height="16" alt="" title="{_LANG_LISTE_COTIS_ADHT_MODIF_ICON_TITLE}"></a>&nbsp;
															{* Action : lien vers Archiver la fiche cotisation *}
			<a href="../adherent/archiverenserie_cotisations_adht.php?id_cotis={$item_cotis_adht.id_cotis}&amp;supp_fiche_cotis=1" onclick="return confirm(' {_LANG_FICHE_COTIS_ADHT_JS_CONFIRM_ARCHIV} {$item_cotis_adht.id_cotis}')"><img src="../images/icones16/i_delete.png" width="16" height="16" alt="" title="{_LANG_LISTE_COTIS_ADHT_ARCHIV_ICON_TITLE}"></a>
			</td>
		</tr>
{/foreach}

{else}
{* si empty($cotis_adht) *}
		<tr>
			<td colspan="8">
			{* affiche La liste est vide .... si {$id_adht} ou {$nom_prenom} Sinon vide pour  $nom_prenom *}
			{if !isset($id_adht) || !isset($nom_prenom)}
				{_LANG_TPL_LISTE_VIDE}&nbsp;{else}{_LANG_TPL_LISTE_VIDE_FOR}: {$nom_prenom}
			{/if}</td>
		</tr>
{/if}

	</table>
{* FIN Affichage de la Table des cotisations *}

	{* Affichage NB pages *}
	<div class="aff_droite-txt">{_LANG_TPL_PAGES}<span class="NumPageGras">
			{section name = pageLoop start=1 loop = $nb_pages}
				{if $smarty.section.pageLoop.index eq $numpage}
					{$smarty.section.pageLoop.index}
				{else}
					<a href="archiverenserie_cotisations_adht.php?numpage_affiche={$smarty.section.pageLoop.index}&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_fiche={$filtre_fiche}&amp;select_datedeb={$filtre_datedeb}&amp;select_datefin={$filtre_datefin}" title="{_LANG_TPL_GO_PAGES}">{$smarty.section.pageLoop.index}</a>
				{/if}
			{/section}</span></div>
	</div>
{* FIN défini le contenu .. *}
