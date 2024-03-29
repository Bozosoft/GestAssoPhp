{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2023 (c) JC Etiemble HTML5 *}
{* Affichage Remplir Préférence Association, des désignation des activités,des types de cotisations Et Information version *}
{* Affichage du CONTENU avec AIDE *}
{* Auteur original : Jean-Claude Etiemble - Licence Creative Commons Paternité - Partage à l'Identique 2.0 France (CC BY-SA 2.0) France *}
	<header class="header_titre_aide"><a href='#' style="cursor:pointer;" onclick="javascript :window.open('../aide/a_admin_remplir_preferences.php','popup','height=450,toolbar=no,location=no,directories=no,status=yes,width=700,resizable=no,scrollbars=yes,top=10,left=10')"  title="{_LANG_TITLE_AIDE}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20">{_LANG_AIDE}</a></header>

    <header class="header_titre">&nbsp;{_LANG_TITRE_ADMIN_PREFERENCES}</header>
	<div class="ligne_coul"></div>
	<div id="contenu">
{* défini le contenu .. *}

	<span class="TextenoirGras">&nbsp;</span>

	<ul id="tabnav">
	{if $tab eq 1}
{* -------------------------------------- TAB 1 Préférence Association -------------------------- *}
	<li class="active">{_LANG_TITRE_ADMIN_PREFTAB1}</li>
	<li><a href="remplir_preferences.php?tab=2">{_LANG_TITRE_ADMIN_PREFTAB2}</a></li>
	<li><a href="remplir_preferences.php?tab=3">{_LANG_TITRE_ADMIN_PREFTAB3}</a></li>
	<li><a href="remplir_preferences.php?tab=4">Information version</a></li>
	</ul>
	<div id="tab1_table">
		<br>
	{if !empty($erreur_saisie.champ)}
		{* if $erreur_saisie.champ|@count != 0 *}
			<div id="erreur-box">{_LANG_TPL_TEXTE_ERR_SAISIE} ...<span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.champ}</span>
			</div>
		{* /if *}
	{/if}
<form action="remplir_preferences.php" method="post" name="ma_form_tab1">
{* Nom de l'espace *}
	<label class="label_pref">{_LANG_PREF_MESSAGETITRE}</label>
		<input type="text" name="messagetitre" id="messagetitre" title="{_LANG_PREF_MESSAGETITRE_TITLE}" value="{$preference_asso.messagetitre}" size="50"  maxlength="75" tabindex="1"><br>
{* Nom de Association *}
	<label class="label_pref">{_LANG_PREF_NOM_ASSO_GESTASSOPHP}</label>
		<input type="text" name="nom_asso_gestassophp" id="nom_asso_gestassophp" title="{_LANG_PREF_NOM_ASSO_GESTASSOPHP_TITLE}" value="{$preference_asso.nom_asso_gestassophp}" size="50"  maxlength="75" tabindex="2"><br>
{* Année de début *}
	<label class="label_pref">{_LANG_PREF_DATE_DEBANNEE_ASSO}</label>
		<input type="text" name="date_debannee_asso" id="date_debannee_asso" title="{_LANG_PREF_DATE_DEBANNEE_ASSO_TITLE}" value="{$preference_asso.date_debannee_asso}" size="10"  maxlength="5" tabindex="3"><br>
{* Nb de lignes par page 10, 20 ou 50 *}
	<label class="label_pref">{_LANG_PREF_NB_LIGNES_PAGE}</label>
		<input type="text" name="nb_lignes_page" id="nb_lignes_page" title="{_LANG_PREF_NB_LIGNES_PAGE_TITLE}" value="{$preference_asso.nb_lignes_page}" size="5"  maxlength="3" tabindex="4"> 10, 20 ou 50<br>
{* Adresse mail Administrateur *}
	<label class="label_pref">{_LANG_PREF_EMAIL_ADRESSE}</label>
		<input type="text" name="email_adresse" id="email_adresse" title="{_LANG_PREF_EMAIL_ADRESSE_TITLE}" value="{$preference_asso.email_adresse}" size="50"  maxlength="75" tabindex="5">
		{if !empty($erreur_saisie.email)} {* if $erreur_saisie.email *}
			<span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.email}</span>
		{/if}
		<br><br>

	<div>&nbsp;&nbsp;&nbsp;{_LANG_PREF_ADHERENT_BENE_INFO}</div>
{* Nom définissant les membres Ex : Adhérent *}
	<label class="label_pref">{_LANG_PREF_ADHERENT_BENE}</label>
		<input type="text" name="adherent_bene" id="adherent_bene" title="{_LANG_PREF_ADHERENT_BENE_TITLE}" value="{$preference_asso.adherent_bene}" size="30"  maxlength="40" tabindex="5"><br><br>

	<div>&nbsp;&nbsp;&nbsp;{_LANG_PREF_LANG_FICHE_ADHT_ANT_INFO}</div>
{* Nom définissant les activité Ex : Section *}
	<label class="label_pref">{_LANG_PREF_LANG_FICHE_ADHT_ANT}</label>
		<input type="text" name="_lang_fiche_adht_ant" id="_lang_fiche_adht_ant" title="{_LANG_PREF_LANG_FICHE_ADHT_ANT_TITLE}" value="{$preference_asso._lang_fiche_adht_ant}" size="30"  maxlength="40" tabindex="5"><br><br>

	<div>&nbsp;&nbsp;&nbsp;{_LANG_PREF_LANG_JMA_FIN_COTIS_INFO}</div>
{* Date fin cotisation EX : 31/12/2021 *}
	<label class="label_pref">{_LANG_FICHE_COTIS_ADHT_DATE_FIN}</label>
		<input type="text" name="jma_fin_cotis" id="jm_fin_cotis" title="{_LANG_PREF_LANG_JMA_FIN_COTIS_INFO}" value="{$preference_asso.jma_fin_cotis}" size="12" maxlength="12" tabindex="6">
		{if !empty($erreur_saisie.date)}{* if $erreur_saisie.date *}
			<span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.date}</span>
		{/if}
		<br>

{* Bouton Valider + Annuler *}
	<div class="centre-txt">
		<input type="submit" class="submit_ok" name="Valider" value="{_LANG_TPL_VALID_BUTTON}" title="{_LANG_TPL_VALID_BUTTON_TITLE}">
			<input type="hidden" name="valid_tab1" value="validation_tab1">
			<a href="../admin/tableau_bord.php"><span class="submit_nul" title="{_LANG_TPL_CANCEL_BUTTON_TITLE}	">{_LANG_TPL_CANCEL_BUTTON}</span></a>
	</div>

</form>

	</div>
{* -------------------------------------- FIN TAB 1 Préférence Association ---------------------- *}

	{elseif $tab eq 2}
{* -------------------------------------- TAB 2 Détail des désignation des activités ------------ *}
    <li><a href="remplir_preferences.php">{_LANG_TITRE_ADMIN_PREFTAB1}</a></li>
    <li class="active">{_LANG_TITRE_ADMIN_PREFTAB2}</li>
	<li><a href="remplir_preferences.php?tab=3">{_LANG_TITRE_ADMIN_PREFTAB3}</a></li>
	<li><a href="remplir_preferences.php?tab=4">Information version</a></li>
	 </ul>
	 <div id="tab2_table">

	<div class="login-box_pripref">
		<form action="remplir_preferences.php" method="post" name="ma_form_tab2">
			<br>
			<label class="label_pripref">{_LANG_PREF_NEW_DESIGNATION}&nbsp;&nbsp; </label>
{* Ici entrer la désignation activité *}
				<input type="text" name="new_nom_type_antenne" id="new_nom_type_antenne" title="{_LANG_PREF_NEW_DESIGNATION_TITLE}" value=
				"{if !empty($new_antenne.nom_type_antenne)}{$new_antenne.nom_type_antenne}{/if}"
				size="40"  maxlength="30" tabindex="1" placeholder="{_LANG_PREF_NEW_DESIGNATION_PLACEHOLDER}">
				{if !empty($erreur_saisie.nom_antenne)}{* if $erreur_saisie.nom_antenne != "" *}
					<br> <span class="erreur-Jaunerouge">{$erreur_saisie.nom_antenne}</span>
				{/if}

			<div class="centre-txt"><br>
				<input type="submit" class="submit_ok" name="Valider" value="{_LANG_TPL_VALID_BUTTON}" title="{_LANG_TPL_VALID_BUTTON_TITLE}">
				<input type="hidden" name="valid_tab2" value="validation_tab2">
				<input type="hidden" name="id_ant" value=
				"{if !empty($new_antenne.id_type_antenne)}{$new_antenne.id_type_antenne}{/if}"
				>
				<input type="hidden" name="tab" value="2">
			</div>

		</form>
	</div>
<br>

	<table style="width:50%;" class="centre-txt">
		<tr>
			<td style="width:5%;">&nbsp;</td>
			<td style="width:35%;">&nbsp;</td>
			<td style="width:10%;">&nbsp;</td>
		</tr>
		<tr>
		{* # *}
			<th class="LignegrisTC">
				<a href="remplir_preferences.php?tab=2&amp;tri=0" title="{_LANG_TPL_TITLE_CLICTRI}">{_LANG_TPL_COL_NUM}</a>
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
		{* Nom des activités *}
			<th class="LignegrisTC">
				<a href="remplir_preferences.php?tab=2&amp;tri=1" title="{_LANG_TPL_TITLE_CLICTRI}">{_LANG_PREF_COL_DESIGNATION_ACTIV}</a>
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
		{* Actions *}
			<th class="LignegrisTC">{_LANG_TPL_COL_ACTIONS}
			</th>
		</tr>
{foreach from = $antenne item = item_antenne key = ordre}
			<tr class="Lignegris{$item_antenne.coul}">
				<td>{$item_antenne.id_type_antenne}</td> 	{* N° *}
				<td>{$item_antenne.nom_type_antenne}</td>	{* Nom activité *}

				<td class="centre-txt">
				<a href="../admin/remplir_preferences.php?tab=2&amp;modifant=1&amp;id_ant={$item_antenne.id_type_antenne}"><img src="../images/icones16/i_modif.png" width="16" height="16" alt="" title="{_LANG_PREF_COL_DESIGNATION_MODIF_ICON_TITLE}"></a></td>
			</tr>
{foreachelse}
			<tr>
				{* La liste est vide *}
				<td colspan="3">{_LANG_TPL_LISTE_VIDE}</td>
			</tr>
{/foreach}
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
		{* Bouton retour *}
			<td class="centre-txt" colspan="3">
			<a href="../admin/remplir_preferences.php?tab=1"><span class="submit_nul" title="{_LANG_TPL_RETOUR_BUTTON}"> {_LANG_TPL_RETOUR_BUTTON}</span></a>
			</td>
		</tr>
	</table>

	</div>
{* -------------------------------------- FIN TAB 2 Détail des désignation des activités ---------- *}

{elseif $tab eq 3}
{* -------------------------------------- TAB 3 Détail des types de cotisations ------------------- *}
	<li><a href="remplir_preferences.php?tab=1">{_LANG_TITRE_ADMIN_PREFTAB1}</a></li>
	<li><a href="remplir_preferences.php?tab=2">{_LANG_TITRE_ADMIN_PREFTAB2}</a></li>
    <li class="active">{_LANG_TITRE_ADMIN_PREFTAB3}</li>
	<li><a href="remplir_preferences.php?tab=4">Information version</a></li>
	</ul>
	<div id="tab3_table">

	<div class="login-box_pripref">
	<br>
	<form action="remplir_preferences.php" method="post" name="ma_form_tab3">
		<label class="label_pripref">{_LANG_PREF_NEW_DESIGNATION}&nbsp;&nbsp; </label>
{* Ici entrer la désignation cotisation *}
			<input type="text" name="new_nom_type_cotisation" id="new_nom_type_cotisation" title="{_LANG_PREF_COL_DESIGNATION_COTIS_PLACEHOLDER}" value=
			"{if !empty($new_type_cotisation.nom_type_cotisation)}{$new_type_cotisation.nom_type_cotisation}{/if}"
			size="40"  maxlength="60" tabindex="1" placeholder="{_LANG_PREF_COL_DESIGNATION_COTIS_PLACEHOLDER}">
			{if !empty($erreur_saisie.nom_type_cotisation)}{* if $erreur_saisie.nom_type_cotisation != "" *}
				<br> <span class="erreur-Jaunerouge">{$erreur_saisie.nom_type_cotisation}</span>
			{/if}
			<br>
		<label class="label_pripref">{_LANG_PREF_NEW_MONT_COTISATION}&nbsp;&nbsp; </label>
{* Ici entrer le montant cotisation en chiffres *}
			<input type="text" name="new_montant_cotisation" id="new_montant_cotisation" title="{_LANG_PREF_NEW_MONT_COTISATION_TITLE}" value=
			"{if !empty($new_type_cotisation.montant_cotisation)}{$new_type_cotisation.montant_cotisation}{/if}"
			size="35"  maxlength="10" tabindex="2" placeholder="{_LANG_PREF_NEW_MONT_COTISATION_PLACEHOLDER}">
			{if !empty($erreur_saisie.montant_cotisation)}{* if $erreur_saisie.montant_cotisation != "" *}
				<br> <span class="erreur-Jaunerouge">{$erreur_saisie.montant_cotisation}</span>
			{/if}
		<div class="centre-txt"><br>
	{* Bouton Valider *}
			<input type="submit" class="submit_ok" name="Valider" value="{_LANG_TPL_VALID_BUTTON}" title="{_LANG_TPL_VALID_BUTTON_TITLE}">
			<input type="hidden" name="valid_tab3" value="validation_tab3">
			<input type="hidden" name="id_typecotis" value=
			"{if !empty($new_type_cotisation.id_type_cotisation)}{$new_type_cotisation.id_type_cotisation}{/if}"
			>
			<input type="hidden" name="tab" value="3">
		</div>
	</form>
	</div>
<br>
	<table style="width:60%;" class="centre-txt">
		<tr>
			<td style="width:5%;">&nbsp;</td>
			<td style="width:35%;">&nbsp;</td>
			<td style="width:15%;">&nbsp;</td>
			<td style="width:5%;">&nbsp;</td>
		</tr>
		<tr>
			<th class="LignegrisTC">
			{* N° *}
				<a href="remplir_preferences.php?tab=3&amp;tri=0" title="{_LANG_TPL_TITLE_CLICTRI}">{_LANG_TPL_COL_NUM}</a>
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

			<th class="LignegrisTC">
			{* Nom des types de cotisation *}
				<a href="remplir_preferences.php?tab=3&amp;tri=1" title="{_LANG_TPL_TITLE_CLICTRI}">{_LANG_PREF_COL_DESIGNATION_COTIS}</a>
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
			<th class="LignegrisTC">{_LANG_PREF_COL_MONT_COTISATION}
			{* Montant cotisation *}
			</th>
			<th class="LignegrisTC">{_LANG_TPL_COL_ACTIONS}
			{* Actions  *}
			</th>
		</tr>

{foreach from = $type_cotisation item = item_cotisation key = ordre}
		<tr class="Lignegris{$item_cotisation.coul}">
			<td>{$item_cotisation.id_type_cotisation}</td>	{* N° *}
			<td>{$item_cotisation.nom_type_cotisation}</td>	{* Nom des types de cotisation *}
			<td>{$item_cotisation.montant_cotisation}</td>	{* Montant cotisation *}
			<td class="centre-txt">
				<a href="../admin/remplir_preferences.php?tab=3&amp;modifc=1&amp;id_typecotis={$item_cotisation.id_type_cotisation}"><img src="../images/icones16/i_modif.png" width="16" height="16" alt="" title="{_LANG_PREF_COL_DESIGNATION_MODIF_ICON_TITLE}"></a>
			</td>
		</tr>
{foreachelse}
		<tr>
			{* La liste est vide *}
			<td colspan="4">{_LANG_TPL_LISTE_VIDE}</td>
		</tr>
{/foreach}
		<tr>
			{* Bouton retour *}
			<td class="centre-txt" colspan="4">
			<a href="../admin/remplir_preferences.php?tab=1"><span class="submit_nul" title="{_LANG_TPL_RETOUR_BUTTON}"> {_LANG_TPL_RETOUR_BUTTON}</span></a>
			</td>
		</tr>
	</table>

	</div>
{* -------------------------------------- FIN TAB 3 Détail des types de cotisations ---------------- *}

{else}
{* -------------------------------------- TAB 4  Affichage Changelog ------------------------------- *}
	<li><a href="remplir_preferences.php?tab=1">{_LANG_TITRE_ADMIN_PREFTAB1}</a></li>
	<li><a href="remplir_preferences.php?tab=2">{_LANG_TITRE_ADMIN_PREFTAB2}</a></li>
	<li><a href="remplir_preferences.php?tab=2">{_LANG_TITRE_ADMIN_PREFTAB3}</a></li>
    <li class="active">Information version</li>
	</ul>
		<div class="centre-txt">
		<br>
			<a href="../admin/remplir_preferences.php?tab=1"><span class="submit_nul" title="{_LANG_TPL_RETOUR_BUTTON}"> {_LANG_TPL_RETOUR_BUTTON}</span></a>
		<br><br>Votre version PHP : {$PHPVersion}<br>
		</div>
	<div id="tab4_table">

	<div class="version">
	<h4> Version : {$version}</h4>
	</div>
    <div class="changelog">
        {$changelog}
    </div>
		{* Bouton retour *}
		<div class="centre-txt">
			<a href="../admin/remplir_preferences.php?tab=1"><span class="submit_nul" title="{_LANG_TPL_RETOUR_BUTTON}"> {_LANG_TPL_RETOUR_BUTTON}</span></a>
		</div>
	</div>
{* -------------------------------------- FIN TAB 4 Affichage Changelog ----------------------------- *}

{/if}

	</div>
{* FIN défini le contenu .. *}
