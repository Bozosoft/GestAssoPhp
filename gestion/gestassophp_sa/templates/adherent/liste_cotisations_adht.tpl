{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2023 (c) JC Etiemble HTML5 *}
{* Affichage du CONTENU avec AIDE Liste des cotisations adhérents *}
	<header class="header_titre_aide"><a href='#' style="cursor:pointer;" onclick="javascript :window.open('../aide/a_adht_liste_cotisation_adht.php','popup','height=700,toolbar=no,location=no,directories=no,status=yes,width=680,resizable=no,scrollbars=yes,top=10,left=10')" title="{_LANG_TITLE_AIDE}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20">{_LANG_AIDE}</a></header>

    <header class="header_titre">{_LANG_MENU_ADMIN_GESTION}&nbsp;-&nbsp;{_LANG_TITRE_ADMIN_LISTE_COTIS_ADHT}</header>
	<div class="ligne_coul"></div>
	<div id="contenu">
{* défini le contenu .. *}

{* Affichage  Recherche *}
{if !empty($erreur_saisie)}
	{if $erreur_saisie|@count != 0}
		<div id="erreur-box">{_LANG_TPL_TEXTE_ERR_SAISIE}
			{if $erreur_saisie.d_datedeb}<br><span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.d_datedeb}</span>{/if}
			{if $erreur_saisie.d_datefin}<br><span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.d_datefin}</span>{/if}
		</div>
	{/if}
{/if}
{* Form .. *}
	<form action="liste_cotisations_adht.php" method="get" name="filtre">
{* Filtrer les cotisations ... *}
		<div id="listfilter">
		<input type="submit" class="submit_ok" value="{_LANG_TPL_FILTER_BUTTON}" title="{_LANG_TPL_FILTER_BUTTON_TITLE} des dates">
			<label for="select_datedeb">&nbsp;{_LANG_LISTE_COTIS_ADHT_TEXT_LESCOTIS}</label>&nbsp;
				{* filtrer parmi les cotisations du (date de début) *}
			<input type="text" name="select_datedeb" id="select_datedeb" maxlength="10" size="11" value="{$filtre_datedeb}" title="{_LANG_LISTE_COTIS_ADHT_SELECT_DATE_D}">
			<label for="select_datefin">&nbsp;{_LANG_LISTE_COTIS_ADHT_TEXT_AU}</label>&nbsp;
				{* filtrer parmi les cotisations au (date de fin) *}
			<input type="text" name="select_datefin" id="select_datefin" maxlength="10" size="11" value="{$filtre_datefin}" title="{_LANG_LISTE_COTIS_ADHT_SELECT_DATE_F}">&nbsp;{_LANG_TPL_TEXTE_SELECT}&nbsp;
			<select name="filtre_fiche" onchange="form.submit()">
				{* Sélectionner le filtre : 0 = Les fiches actives, 1 = Toutes les fiches, 2 = Les fiches archivées *}
				{html_options options = $filtre_options selected = $filtre_fiche}
			</select>&nbsp;
			<input type="hidden" name="id_adht" id="id_adht" value="{$id_adht}">{* pour passer l'id_adht *}
		</div>

{* Affichage NB cotisations -  - NB pages *}
	<table style="width:100%;">
		<tr>
			<td>{$nb_lines}
			{if $nb_lines > 1}
				{_LANG_LISTE_COTIS_ADHT_COTISS}
			{else}
				{_LANG_LISTE_COTIS_ADHT_COTIS}
			{/if}&nbsp;&nbsp;
		{if $id_adht}<a href="../adherent/remplir_cotisations_adht.php?id_adht_cotis={$id_adht}">
			<span class="submit_ok" title="{_LANG_LISTE_COTIS_ADHT_ADDCOTIS_BUTTON_TITLE}">&nbsp;{_LANG_LISTE_COTIS_ADHT_ADDCOTIS_BUTTON}&nbsp;</span></a>
		{else}
			<a href="../adherent/remplir_cotisations_adht.php"><span class="submit_ok" title="{_LANG_LISTE_COTIS_ADHT_ADDCOTIS_BUTTON_TITLE}">&nbsp;{_LANG_LISTE_COTIS_ADHT_ADDCOTIS_BUTTON}&nbsp;</span></a>
		{/if}
		&nbsp;&nbsp;
		{* add v 7.3 Archiver en série des cotisations *}
{* si pas de cotisation ou que la fiche est archivée = la liste est vide = pas d'affichage Archiver en série des cotisations *}
		{if !empty($cotis_adht)}
			<a href="../adherent/archiverenserie_cotisations_adht.php?id_adht_cotis={$id_adht}">{_LANG_TITRE_ADMIN_LISTEARCHIV_COTIS_ADHT}</a>
		{/if}
{* FIN si liste est vide pas d'affichage Archiver en série des cotisations *}
			</td>
		{if $affiche_liste_complete =="1"}{* add v 7.3 *}
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
			{* Affichage NB pages *}
			<td class="aff_droite-txt">{_LANG_TPL_PAGES}<span class="NumPageGras">
				{section name = pageLoop start = 1 loop = $nb_pages}
					{if $smarty.section.pageLoop.index eq $numpage}
						{$smarty.section.pageLoop.index}
					{else}
						<a href="liste_cotisations_adht.php?numpage_affiche={$smarty.section.pageLoop.index}&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_fiche={$filtre_fiche}&amp;select_datedeb={$filtre_datedeb}&amp;select_datefin={$filtre_datefin}" title="{_LANG_TPL_GO_PAGES}">{$smarty.section.pageLoop.index}</a>
					{/if}
				{/section}</span>
			</td>
		</tr>
	</table>
{* FIN Affichage NB cotisations -  - NB pages *}
{* FIN Form .. *}
	</form>
{* FIN Affichage  Recherche *}

{* Affichage de la Table des cotisations *}

	<table style="width:100%;">
		<tr>
		{* # *}
			<th class="LignegrisTC" style="width:4%;">
				<a href="liste_cotisations_adht.php?tri=0&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_fiche={$filtre_fiche}&amp;select_datedeb={$filtre_datedeb}&amp;select_datefin={$filtre_datefin}&amp;id_adht={$id_adht}" title="{_LANG_TPL_TITLE_CLICTRI}">#</a>
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
				<a href="liste_cotisations_adht.php?tri=1&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_fiche={$filtre_fiche}&amp;select_datedeb={$filtre_datedeb}&amp;select_datefin={$filtre_datefin}&amp;id_adht={$id_adht}" title="{_LANG_TPL_TITLE_CLICTRI}"> {_LANG_LISTE_COTIS_ADHT_COL_D_ENR}</a>
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
			</th>
		{* Date fin cotisation *}
			<th class="LignegrisTC" style="width:11%;">
				<a href="liste_cotisations_adht.php?tri=3&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_fiche={$filtre_fiche}&amp;select_datedeb={$filtre_datedeb}&amp;select_datefin={$filtre_datefin}&amp;id_adht={$id_adht}" title="{_LANG_TPL_TITLE_CLICTRI}"> {_LANG_FICHE_COTIS_ADHT_DATE_FIN}</a>
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
				<a href="liste_cotisations_adht.php?tri=4&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_fiche={$filtre_fiche}&amp;select_datedeb={$filtre_datedeb}&amp;select_datefin={$filtre_datefin}&amp;id_adht={$id_adht}" title="{_LANG_TPL_TITLE_CLICTRI}">{_LANG_TPL_COL_NOMPRE}</a>
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
				<a href="liste_cotisations_adht.php?tri=5&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_fiche={$filtre_fiche}&amp;select_datedeb={$filtre_datedeb}&amp;select_datefin={$filtre_datefin}&amp;id_adht={$id_adht}" title="{_LANG_TPL_TITLE_CLICTRI}"> {_LANG_LISTE_COTIS_ADHT_COL_TYPE}</a>
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
				<a href="liste_cotisations_adht.php?tri=6&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_fiche={$filtre_fiche}&amp;select_datedeb={$filtre_datedeb}&amp;select_datefin={$filtre_datefin}&amp;id_adht={$id_adht}" title="{_LANG_TPL_TITLE_CLICTRI}"> {_LANG_LISTE_COTIS_ADHT_COL_MONTANT}</a>
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
		{* Statut : Archivée ou non *}
			<th class="LignegrisTC" style="width:8%;">
				<a href="liste_cotisations_adht.php?tri=7&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_fiche={$filtre_fiche}&amp;select_datedeb={$filtre_datedeb}&amp;select_datefin={$filtre_datefin}&amp;id_adht={$id_adht}" title="{_LANG_TPL_TITLE_CLICTRI}"> {_LANG_LISTE_COTIS_ADHT_COL_STATUT}</a>
				{if $smarty.session.tri eq 7}
					{if $smarty.session.tri_sens eq 0}
						<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_UP}">
					{else}
						<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{_LANG_TPL_TITLE_CLICTRI_DOWN}">
					{/if}
				{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt="">
				{/if}
			</th>
		{* Action *}
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
			<td >
			{if $item_cotis_adht.cotis != "999" && $affiche_liste_complete == "1"}
				{* Nom Prénom *}
				<a href="../adherent/liste_cotisations_adht.php?id_adht={$item_cotis_adht.id_adhtasso}" title="{_LANG_LISTE_COTIS_ADHT_LISTE_TITLE}">{$item_cotis_adht.nom_adht} {$item_cotis_adht.prenom_adht}</a>

			{elseif $affiche_liste_complete == "" && $item_cotis_adht.cotis != "999"}
				{* Nom Prénom si 1 seul adhérent sectionné avec lien vers fiche adht *}
				<a href="../adherent/gerer_fiche_adht.php?id_adht={$item_cotis_adht.id_adhtasso}" title="{_LANG_LISTE_COTIS_ADHT_VISU_FICHE_TITLE}">{$item_cotis_adht.nom_adht} {$item_cotis_adht.prenom_adht}</a>

			{else}
				{* Nom Prénom des fiches archivées ROUGE *}
				<span class="Texterouge">{$item_cotis_adht.nom_adht} {$item_cotis_adht.prenom_adht}</span>
			{/if}
			</td>
			<td>{$item_cotis_adht.nom_type_cotisation}</td>	{* Type cotisation *}
			<td>{$item_cotis_adht.montant_cotis}</td>		{* Montant cotisation *}
			<td class="centre-txt">
			{if !empty($item_cotis_adht.cotis_txt)}
				{$item_cotis_adht.cotis_txt}				{* Statut : Archivée ou non *}
			{/if}&nbsp;<span class="TextenoirR">
			{if !empty($item_cotis_adht.datemodiffiche_cotis)}
				{$item_cotis_adht.datemodiffiche_cotis}		{* Statut : date d'achivage *}
			{/if}</span>
			</td>
			<td class="centre-txt">
				{if $item_cotis_adht.cotis != "999"}
					{* Action : lien vers Modifier la fiche cotisation *}
					<a href="../adherent/remplir_cotisations_adht.php?id_cotis={$item_cotis_adht.id_cotis}"><img src="../images/icones16/i_modif.png" width="16" height="16" alt="" title="{_LANG_LISTE_COTIS_ADHT_MODIF_ICON_TITLE}"></a>
					{* Action : lien vers Archiver la fiche cotisation *}
					&nbsp;<a href="../adherent/remplir_cotisations_adht.php?id_cotis={$item_cotis_adht.id_cotis}&amp;supp_fiche_cotis=1"><img src="../images/icones16/i_archive.png" width="16" height="16" alt="" title="{_LANG_LISTE_COTIS_ADHT_ARCHIV_ICON_TITLE}"></a>
				{else}
					{* Action : lien vers Consulter la fiche cotisation archivé *}
					<a href="../adherent/remplir_cotisations_adht.php?id_cotis={$item_cotis_adht.id_cotis}&amp;archive_fiche=1"><img src="../images/icones16/i_ficharch.png" width="16" height="16" alt="" title="{_LANG_LISTE_COTIS_ADHT_CONSULT_ICON_TITLE}"></a>
				{/if}
			</td>

		</tr>

{/foreach}
{else}
{* si empty($cotis_adht) *}
		<tr>
			<td colspan="6">
			{* s'il n'existe pas de cotisation ET si {$id_adht} ou {$nom_prenom} existe *}
			{if !isset($id_adht) || !isset($nom_prenom)}
				{_LANG_TPL_LISTE_VIDE}&nbsp;				{* affiche La liste est vide *}
			{else}
				{_LANG_TPL_LISTE_VIDE_FOR}: {$nom_prenom} 	{* affiche La liste est vide pour $nom_prenom *}
			{/if}</td>
		</tr>
{/if}

	</table>
{* FIN Affichage de la Table des cotisations *}

	{* Affichage NB pages *}
	<div class="aff_droite-txt">{_LANG_TPL_PAGES}<span class="NumPageGras">
			{section name = pageLoop start = 1 loop = $nb_pages}
				{if $smarty.section.pageLoop.index eq $numpage}
					{$smarty.section.pageLoop.index}
				{else}
					<a href="liste_cotisations_adht.php?numpage_affiche={$smarty.section.pageLoop.index}&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_fiche={$filtre_fiche}&amp;select_datedeb={$filtre_datedeb}&amp;select_datefin={$filtre_datefin}" title="{_LANG_TPL_GO_PAGES}">{$smarty.section.pageLoop.index}</a>
				{/if}
			{/section}</span></div>

	</div>
{* FIN défini le contenu .. *}
