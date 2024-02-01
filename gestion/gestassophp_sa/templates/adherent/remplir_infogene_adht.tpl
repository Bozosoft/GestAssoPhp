{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2023 (c) JC Etiemble HTML5 *}
{* Affichage du CONTENU avec AIDE Rempir information générale *}
	<header class="header_titre_aide"><a href='#' style="cursor:pointer;" onclick="javascript :window.open('../aide/a_adht_remplir_infogene_adht.php','popup','height=450,toolbar=no,location=no,directories=no,status=yes,width=660,resizable=no,scrollbars=yes,top=10,left=10')" title="{_LANG_TITLE_AIDE}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20">{_LANG_AIDE}</a></header>
<script src="../js/comptemots.js"></script>
    <header class="header_titre">&nbsp;{_LANG_GESTION_FICHE_ADHT}{$affiche_message}</header>
	<div class="ligne_coul"></div>
	<div id="contenu"> {*défini le contenu .. *}
 	<br>
{if !empty($erreur_saisie)}
	{if $erreur_saisie|@count != 0}
		<div id="erreur-box"> {_LANG_TPL_TEXTE_ERR_SAISIE}
		</div>
	{/if}
{/if}
{* Form .. *}
	<form method="post" name="maform" action="remplir_infogene_adht.php" enctype="multipart/form-data">

		{* Civilité *}
			<label class="label_fc">{_LANG_FICHE_ADHT_CIVIL} &nbsp;&nbsp;</label>
			{html_options name = "civilite" options = $list_civilite selected = {$data_adherent.civilite_adht} tabindex = "1"}
		<br>
		{* Nom Obligatoire *}
			<label class="label_fc_Oblig"> {_LANG_TPL_COL_ADHT_NOM} &nbsp;&nbsp; </label>
			<input type="text" name="nom_adht" id="nom_adht" title="{_LANG_FICHE_ADHT_NOM_TITLE}" value="{if !empty($data_adherent.nom_adht)}{$data_adherent.nom_adht}{/if}"  size="32"  maxlength="50" tabindex="2" placeholder="{_LANG_FICHE_ADHT_NOM_PLACEHOLDER}" {$disabled.nom_adht}>
			{if !empty($erreur_saisie.nom) && $erreur_saisie.nom}
				<span class="erreur-Jaunerouge">{$erreur_saisie.nom}</span>
			{/if}
		<br>
		{* Prénom Obligatoire *}
			<label class="label_fc_Oblig"> {_LANG_FICHE_ADHT_PRENOM} &nbsp;&nbsp; </label>
			<input type="text" name="prenom_adht" id="prenom_adht" title="{_LANG_FICHE_ADHT_PRENOM_TITLE}" value="{if !empty($data_adherent.prenom_adht)}{$data_adherent.prenom_adht}{/if}"  size="32"  maxlength="50" tabindex="3" placeholder="{_LANG_FICHE_ADHT_PRENOM_PLACEHOLDER}" {$disabled.prenom_adht}>
			{if !empty($erreur_saisie.pnom) && $erreur_saisie.pnom}
				<span class="erreur-Jaunerouge">{$erreur_saisie.pnom}</span>
			{/if}
		<br>
		{* Date de naissance *}
			<label class="label_fc">{_LANG_TPL_ADHT_DATENAIS} &nbsp;&nbsp; </label>
			<input type="text" name="datenaisance_adht" id="datenaisance_adht" title="{_LANG_FICHE_ADHT_DATENAIS_TITLE}" value="{if !empty($data_adherent.datenaisance_adht) && ($data_adherent.datenaisance_adht !== '00/00/0000')}{$data_adherent.datenaisance_adht}{/if}" size="12"  maxlength="12" tabindex="4" placeholder="{_LANG_FICHE_ADHT_DATENAIS_PLACEHOLDER}" {if !empty($disabled.datenaisance_adht)}{$disabled.datenaisance_adht}{/if}>
			{if !empty($erreur_saisie.d_nais) && $erreur_saisie.d_nais}
				<span class="erreur-Jaunerouge">{$erreur_saisie.d_nais}</span>.
			{/if}
		<br>
		{* Tranche âge *}
		<label class="label_fc">{_LANG_FICHE_ADHT_TAGE} &nbsp;&nbsp;</label>
		{if !empty($disabled.tranche_age) && $disabled.tranche_age == 1}
			{if !empty($data_adherent.tranche_age)}
				{$data_adherent.tranche_age}
			{else}
				NC
			 {/if}
		{else}
			{html_options name = "tranche_age_adht" options = $list_tranche_age_adht selected = {$data_adherent.tranche_age} tabindex = "5"}
		{/if}
		<br><br>
		{* Adresse *}
			<label class="label_fc"> {_LANG_FICHE_ADHT_ADRESS} &nbsp;&nbsp; </label>
			<input type="text" name="adresse_adht" id="adresse_adht" title=" {_LANG_FICHE_ADHT_ADRESS_TITLE}" value="{if !empty($data_adherent.adresse_adht)}{$data_adherent.adresse_adht}{/if}" size="65"  maxlength="98" tabindex="6" placeholder="{_LANG_FICHE_ADHT_ADRESS_PLACEHOLDER}" {if !empty($disabled.adresse_adht)}{$disabled.adresse_adht}{/if}>
		<br>
		{* Code Postal - Ville Obligatoire *}
			<label class="label_fc_Oblig">  {_LANG_FICHE_ADHT_CP} - {_LANG_TPL_COL_ADHT_VILLE} &nbsp;&nbsp; </label>
			<input type="text" name="cp_adht" id="cp_adht" title="{_LANG_FICHE_ADHT_CP_TITLE}" value="{if !empty($data_adherent.cp_adht)}{$data_adherent.cp_adht}{/if}"  size="6"  maxlength="50" tabindex="7" placeholder="{_LANG_FICHE_ADHT_CP_PLACEHOLDER}" {if !empty($disabled.cp_adht)}{$disabled.cp_adht}{/if}>
			&nbsp;-&nbsp;
			<input type="text" name="ville_adht" id="ville_adht" title="{_LANG_TPL_COL_ADHT_VILLE_TITLE}" value="{if !empty($data_adherent.ville_adht)}{$data_adherent.ville_adht}{/if}"  size="35"  maxlength="50" tabindex="8" placeholder="{_LANG_TPL_COL_ADHT_VILLE_PLACEHOLDER}" {if !empty($disabled.ville_adht)}{$disabled.ville_adht}{/if}>{if !empty($erreur_saisie.cp) && $erreur_saisie.cp}<span class="erreur-Jaunerouge">{$erreur_saisie.cp}</span>
			{/if} {if !empty($erreur_saisie.ville) && $erreur_saisie.ville}
				<span class="erreur-Jaunerouge">{$erreur_saisie.ville}</span>
			{/if}
		<br>
		{* Téléphone *}
			<label class="label_fc">{_LANG_TPL_COL_ADHT_TELEPH} &nbsp;&nbsp; </label>
			<input type="text" name="telephonef_adht" id="telephonef_adht" title="{_LANG_TPL_COL_ADHT_TELEPH_TITLE}" value="{if !empty($data_adherent.telephonef_adht)}{$data_adherent.telephonef_adht}{/if}" size="18"  maxlength="16" tabindex="9" placeholder="{_LANG_TPL_COL_ADHT_TELEPH_PLACEHOLDER}" {if !empty($disabled.telephonef_adht)}{$disabled.telephonef_adht}{/if}>
		<br>
		{* Portable *}
			<label class="label_fc"> {_LANG_TPL_COL_ADHT_PORTABLE}  &nbsp;&nbsp; </label>
			<input type="text" name="telephonep_adht" id="telephonep_adht" title="{_LANG_TPL_COL_ADHT_PORTABLE_TITLE}" value="{if !empty($data_adherent.telephonep_adht)}{$data_adherent.telephonep_adht}{/if}" size="18"  maxlength="16" tabindex="10" placeholder="{_LANG_TPL_COL_ADHT_PORTABLE_PLACEHOLDER}" {if !empty($disabled.telephonep_adht)}{$disabled.telephonep_adht}{/if}>
		<br>
		{* Fax devient tel Professionnel *}
			<label class="label_fc"> {_LANG_FICHE_ADHT_FAX} &nbsp;&nbsp; </label>
			<input type="text" name="telecopie_adht" id="telecopie_adht" title="{_LANG_FICHE_ADHT_FAX_TITLE}" value="{if !empty($data_adherent.telecopie_adht)}{$data_adherent.telecopie_adht}{/if}" size="18" maxlength="16" tabindex="11" placeholder="{_LANG_FICHE_ADHT_FAX_PLACEHOLDER}" {if !empty($disabled.telecopie_adht)}{$disabled.telecopie_adht}{/if}>
		<br>
		{* Ajout de Profession *}
			<label class="label_fc"> {_LANG_FICHE_ADHT_PROFESSION}&nbsp;&nbsp; </label>
			<input type="text" name="profession_adht" id="profession_adht" title="{_LANG_FICHE_ADHT_PROFESSION_TITLE}" value="{if !empty($data_adherent.profession_adht)}{$data_adherent.profession_adht}{/if}" size="32" maxlength="50" tabindex="12" placeholder="{_LANG_FICHE_ADHT_PROFESSION_PLACEHOLDER}" {if !empty($disabled.profession_adht)}{$disabled.profession_adht}{/if}{*$disabled.telecopie_adht*}>
		<br>
		{* Email *}
			<label class="label_fc">{_LANG_FICHE_ADHT_MAIL} &nbsp;&nbsp; </label>
			<input type="text" name="email_adht" id="email_adht" title="{_LANG_FICHE_ADHT_MAIL_TITLE}" value="{if !empty($data_adherent.email_adht)}{$data_adherent.email_adht}{/if}" size="65"  maxlength="70" tabindex="13" placeholder="{_LANG_FICHE_ADHT_MAIL_PLACEHOLDER}"  {if !empty($disabled.email_adht)}{$disabled.email_adht}{/if}>
			{if !empty($erreur_saisie.email) && $erreur_saisie.email}
				<span class="erreur-Jaunerouge">{$erreur_saisie.email}</span>
			{/if}
		<br>
		{* Site WEB   http:// *}
			<label class="label_fc">{_LANG_FICHE_ADHT_WEB} &nbsp;&nbsp;<span class="TextenoirR">http://</span></label>
			<input type="text" name="siteweb_adht" id="siteweb_adht" title="{_LANG_FICHE_ADHT_WEB_TITLE}" value="{if !empty($data_adherent.siteweb_adht)}{$data_adherent.siteweb_adht}{/if}" size="65"  maxlength="50" tabindex="14" placeholder="{_LANG_FICHE_ADHT_WEB_PLACEHOLDER}" {if !empty($disabled.siteweb_adht)}{$disabled.siteweb_adht}{/if}>
		<br>
		{* Si ajout de Autres informations *}
			<label class="label_fc"> {_LANG_FICHE_ADHT_AUTRES_INFO}&nbsp;&nbsp; </label>
			<input type="text" name="autres_info_adht" id="autres_info_adht" title="{_LANG_FICHE_ADHT_AUTRES_INFO_TITLE}" value="{if !empty($data_adherent.autres_info_adht)}{$data_adherent.autres_info_adht}{/if}" size="65" maxlength="980" tabindex="15" placeholder="{_LANG_FICHE_ADHT_AUTRES_INFO_PLACEHOLDER}" {if !empty($disabled.autres_info_adht)}{$disabled.autres_info_adht}{/if}{*$disabled.telecopie_adht*}>
		<br>
		{* Afficher mes coordonnées OUI/Non visible par les autres sur la page "Liste des Utilisateurs" *}
			<label class="label_fc" title="{_LANG_FICHE_ADHT_COORD_TITLE}{$nom_asso_gestassophp}">{_LANG_FICHE_ADHT_COORD} &nbsp;&nbsp;</label>
			{html_options name = "visible_adht" options = $list_oui_non selected = {$data_adherent.visibl_adht} tabindex = "16"}
		<br>
		<span class="TextenoirR">&nbsp;[{_LANG_FICHE_ADHT_COORD_TITLE} {$nom_asso_gestassophp}]</span>
		<br><br>
		{* Observations zone texte *}
			<label class="label_fc">{_LANG_FICHE_ADHT_COMPL}
		<br>
			<span class="TextenoirR">{_LANG_FICHE_ADHT_COMPL_NBC}</span> {*caractère(s) restants*}
			<input readonly="readonly" type="text" name="compte" size="3" maxlength="3" value="200" title="{_LANG_FICHE_ADHT_COMPL_NBC_TITLE}"></label>
            <textarea cols="60" rows="3" name="disponib_adht" onkeydown="Compteur_Texte(this,this.form.compte,200);" onkeyup="Compteur_Texte(this,this.form.compte,200);" placeholder="{_LANG_FICHE_ADHT_COMPL_PLACEHOLDER}" tabindex="17">{if !empty($data_adherent.disponib_adht)}{$data_adherent.disponib_adht}{/if}</textarea>
		<br><br>
		{* N° adhésion *}
			<label class="label_fc"> {_LANG_FICHE_ADHT_PROMOTION} &nbsp;&nbsp; </label>
				<input type="text" name="promotion_adht" id="promotion_adht" title="{_LANG_FICHE_ADHT_PROMOTION_TITLE}" value="{if !empty($data_adherent.promotion_adht)}{$data_adherent.promotion_adht}{/if}" size="32"  maxlength="25" tabindex="18" placeholder="{_LANG_FICHE_ADHT_PROMOTION_PLACEHOLDER}" {if !empty($disabled.promotion_adht)}{$disabled.promotion_adht}{/if}>
		<br>
		{* Section = désignation des activités  voir Préférences/Onglet 2 *}
			<label class="label_fc"> {_LANG_FICHE_ADHT_ANT}&nbsp;&nbsp;</label>
			{if !empty($disabled.antenne_adht) && $disabled.antenne_adht == 1} {$data_adherent.nom_type_antenne}{else} {html_options name="id_type_antenne_adht" options = $list_antenne_adht selected = {$data_adherent.id_type_antenne} tabindex = "19"}{/if}
		<br>

	{if $required.creation_adht == 1}
{* UNIQUEMENT Si Création de la fiche *}
		{* Date d'inscription pour la création de la fiche Obligatoire*}
			<label class="label_fc_Oblig"> {_LANG_FICHE_ADHT_D_INSCRIPT}&nbsp;&nbsp; </label>
			<input type="text" name="date_inscription_adht" id="date_inscription_adht" title="{_LANG_TPL_TEXTE_DATE_TITLE}" value="{if !empty($data_adherent.date_inscription_adht)}{$data_adherent.date_inscription_adht} {else}{$date_dujour}{/if}" size="12" maxlength="12" tabindex="20" {if !empty($disabled.date_inscription)}{$date_inscription}{/if}>
			{if !empty($erreur_saisie.d_inscript) && $erreur_saisie.d_inscript}
				<span class="erreur-Jaunerouge">{$erreur_saisie.d_inscript}</span>
			{/if}
		<br>
		{* Création du Login et du Mot de passe *}
		<fieldset>
		<legend>{_LANG_FICHE_ADHT_CREATE_LOGINPASS}</legend>
		<br>
		{* Login utilisateur Obligatoire *}
			<label class="label_fc_Oblig"> {_LANG_LOGIN_USER}&nbsp; </label>
		<input type="text" name="login_adht" id="login_adht" title="{_LANG_FICHE_ADHT_LOGIN}" value="{if !empty($data_adherent.login_adht)}{$data_adherent.login_adht}{/if}" size="22"  maxlength="22" tabindex="21"  placeholder="{_LANG_FICHE_ADHT_LOGIN_PLACEHOLDER}">
		{if !empty($erreur_saisie.login) && $erreur_saisie.login}
			<span class="erreur-Jaunerouge">{$erreur_saisie.login}</span>
		{/if}
		<br>
		{* Info longeur Login Mot de passe *}
			<span class="TexterougeR">&nbsp;&nbsp;&nbsp;&nbsp;{_LANG_FICHE_ADHT_LOGIN_UPPER}<br>
			&nbsp;&nbsp;&nbsp;&nbsp;{_LANG_FICHE_ADHT_PASSWD410}</span>
		<br><br>
		 {* Mot de passe1 Obligatoire *}
			<label class="label_fc_Oblig">&nbsp;&nbsp;{_LANG_LOGIN_MY_PASSWD}&nbsp; </label>
				<input type="password" name="pass_adht1" id="pass_adht1" title="{_LANG_FICHE_ADHT_PASSWD_TITLE}" value="{if !empty($data_adherent.pass_adht1)}{$data_adherent.pass_adht1}{/if}" size="16"  maxlength="18" tabindex="22" placeholder="{_LANG_FICHE_ADHT_PASSWD410_PLACEHOLDER}" {if !empty($disabled.pass_adht1)}{$disabled.pass_adht1}{/if}>
		{* Mot de passe2 Obligatoire *}
			<span class="TexterougeGras ">&nbsp;&nbsp;{_LANG_FICHE_ADHT_CONFIRM}&nbsp;</span>
				<input type="password" name="pass_adht2" id="pass_adht2" title="{_LANG_FICHE_ADHT_PASSWD_CONFIRM_TITLE}" value="{if !empty($data_adherent.pass_adht2)}{$data_adherent.pass_adht1}{/if}" size="16"  maxlength="18" tabindex="23" placeholder="{_LANG_FICHE_ADHT_PASSWD410_PLACEHOLDER}" {if !empty($disabled.pass_adht2)}{$disabled.pass_adht2}{/if}>
				{if !empty($erreur_saisie.mdp) && $erreur_saisie.mdp}
					<span class="erreur-Jaunerouge">{$erreur_saisie.mdp}</span>
				{/if}
		</fieldset>

	{else}
{* Si modification de la fiche *}
		<br>
		{* Fiche enregistrée par *}
		{* MODIFICATION qui a enrregistré la fiche; SI Admin = 9, SINON Modification disabled *}
			<label class="label_fc"> {_LANG_FICHE_ADHT_FICHE_ENR}&nbsp;&nbsp; </label>
			{if !empty($non_visible_adht_creation_fiche) && $non_visible_adht_creation_fiche == 1} {$pnom_creation_fiche_adht}<br>
			{else}
			{html_options name = id_adht_modif_creation_fiche options = $listnoms selected = {$data_adherent.qui_enrg_adht} tabindex = "19"}<br>
			{/if}
		<br>
		{* MODIFICATION Mot de passe SI Admin = 9 Ou si id_adht = $sessionadherent *}
		{if ($id_adht == $smarty.session.ses_id_adht) || ($priorite_adht == 9)}
		{* Login utilisateur / Modification du Mot de passe *}
		<fieldset>
		<legend>{_LANG_LOGIN_USER}&nbsp;/&nbsp;{_LANG_FICHE_ADHT_MODIF_PASSWD}</legend>
			{* MODIFICATION Login utilisateur si Admin = 9 *}
			{if $priorite_adht == 9}
				<br>
				{* Login utilisateur Obligatoire *}
				<label class="label_fc_Oblig">{_LANG_LOGIN_USER}&nbsp; </label>
					<input type="text" name="login_adht" id="login_adht" title="{_LANG_FICHE_ADHT_LOGIN}" value="{if !empty($data_adherent.login_adht)}{$data_adherent.login_adht}{/if}" size="22"  maxlength="22" tabindex="20">
					{if !empty($erreur_saisie.login) && $erreur_saisie.login}
						<span class="erreur-Jaunerouge">{$erreur_saisie.login}</span>
					{/if}
				<br>
					<span class="TexterougeR">&nbsp;&nbsp;&nbsp;&nbsp;{_LANG_FICHE_ADHT_LOGIN_UPPER}</span>{* Le Login (entre 4 et 20 caract... *}
				<br>
			{/if}
			{* Fin Modification Login utilisateur si Admin = 9 *}
			{* Possible de modifier Mot de passe SI Admin = 9 Ou si id_adht = $sessionadherent *}
			<p class="TexterougeR">{_LANG_FICHE_ADHT_MODIF_PASSWD}&nbsp;&nbsp;({_LANG_FICHE_ADHT_PASSWD410})</p>
			{* Mot de passe1 Obligatoire *}
			<span class="TextenoirGras">{_LANG_FICHE_ADHT_MODIF_PASSWD}&nbsp;</span>
				<input type="password" name="pass_adht1" id="pass_adht1" title="{_LANG_FICHE_ADHT_NEWPASSWD_TITLE}" value="{if !empty($data_adherent.pass_adht1)}{$data_adherent.pass_adht1}{/if}" size="16"  maxlength="18" tabindex="20" {if !empty($disabled.pass_adht1)}{$disabled.pass_adht1}{/if}>
			{* Mot de passe2 Obligatoire *}
			<span class="TextenoirGras">&nbsp;&nbsp;{_LANG_FICHE_ADHT_CONFIRM}&nbsp;</span>
				<input type="password" name="pass_adht2" id="pass_adht2" title="{_LANG_FICHE_ADHT_PASSWD_CONFIRM_TITLE}" value="{if !empty($data_adherent.pass_adht2)}{$data_adherent.pass_adht2}{/if}" size="16"  maxlength="18" tabindex="21" {if !empty($disabled.pass_adht2)}{$disabled.pass_adht2}{/if}>
				{if !empty($erreur_saisie.mdp) && $erreur_saisie.mdp}
					<span class="erreur-Jaunerouge">{$erreur_saisie.mdp}</span>
				{/if}
		{/if}
		</fieldset>
{* FIN Affichage si Création ou modification de la fiche *}
	{/if}

			{* Affichage du texte : Champs obligatoires *}
			<span class="TexterougeR">&nbsp;&nbsp;&nbsp;{_LANG_TPL_TEXTE_OBLIG}</span>

{* Photo *}
		{if $required.creation_adht !== 1}
			<div class="centre-txt">

				  {if $photo_adht !== "[ Pas de photo ]"}{$photo_adht}<br>
					<input type="submit" name="del_photo" value="{_LANG_FICHE_ADHT_DEL_PHOTO}" onclick="return confirm('{_LANG_FICHE_ADHT_CONFIRM_DEL_PHOTO}')"  title="{_LANG_FICHE_ADHT_DEL_PHOTO_TITLE}" class="submit_del" tabindex="22">
				{else}
					{_LANG_FICHE_ADHT_UPLOAD_PHOTO}<br>
						{if !empty($erreur_saisie.photo) && $erreur_saisie.photo}
							<span class="erreur-Jaunerouge">{$erreur_saisie.photo}</span>
						{/if}
					<input type="file" name="photo" title="{_LANG_FICHE_ADHT_ADD_PHOTO_TITLE}">
				{/if}
			</div>
		{/if}
{* FIN Photo *}

		<div class="centre-txt"><br>
		{* boutons Valider  Annuler*}
			<input type="submit" class="submit_ok" name="Valider" value="{_LANG_TPL_VALID_BUTTON}" title="{_LANG_TPL_VALID_BUTTON_TITLE}">
			<input type="hidden" name="valid" value="valid">
			<input type="hidden" name="id_adht" value="{$id_adht}">
			{if $required.creation_adht == 1}
				<a href="../adherent/liste_adht_admin.php"><span class="submit_nul" title="{_LANG_TPL_CANCEL_BUTTON_TITLE}">{_LANG_TPL_CANCEL_BUTTON}</span></a>
			{else}
				<a href="../adherent/gerer_fiche_adht.php?id_adht={$id_adht}"><span class="submit_nul" title="{_LANG_TPL_CANCEL_BUTTON_TITLE}">{_LANG_TPL_CANCEL_BUTTON}</span></a>
			{/if}
		</div>

	</form>
{* FIN Form .. *}


	</div>
{* FIN défini le contenu .. *}
