{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2023 (c) JC Etiemble HTML5 *}
{* Affichage du CONTENU avec AIDE Rempir information générale *}
	<header class="header_titre_aide"><a href='#' style="cursor:pointer;" onclick="javascript :window.open('../aide/a_adht_remplir_message_adht.php','popup','height=200,toolbar=no,location=no,directories=no,status=yes,width=660,resizable=no,scrollbars=yes,top=10,left=10')" title="{_LANG_TITLE_AIDE}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20">{_LANG_AIDE}</a></header>

    <header class="header_titre">&nbsp;{_LANG_TITRE_MAILTO_ADHT}</header>
	<div class="ligne_coul"></div>
	<div id="contenu">
{* défini le contenu .. *}
 	<br>
{if !empty($erreur_saisie)}
	{if $erreur_saisie|@count != 0}
		<div id="erreur-box"> {_LANG_TPL_TEXTE_ERR_SAISIE}
		</div>
	{/if}
{/if}

{* Form .. *}
<form method="post" name="maform" action="remplir_message_adht.php">
    <table style="width:98%;">
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
		{* Email destinataire *}
			<th class="LignegrisRight"> {_LANG_MAILTO_DEST_ADHT} &nbsp;&nbsp; </th>
			<td><input type="text" name="email_adht" id="email_adht" title="{_LANG_FICHE_ADHT_MAIL_TITLE}" value="{$data_adherent.email_adht}" size="65"  maxlength="50" tabindex="1" {$disabled.email_adht}></td>
		</tr>
		<tr>
		{* Email émetteur *}
			<th class="LignegrisRight"> {_LANG_MAILTO_EMMET_ADHT} &nbsp;&nbsp;</th>
			<td><input type="text" name="email_emmet" id="email_emmet" title="{_LANG_FICHE_ADHT_WEB_TITLE}" value="{$email_emmet}" size="65"  maxlength="50" tabindex="2" {$disabled.email_emmet}></td>
		</tr>
		<tr>
		{* Sujet *}
			<th class="LignegrisRight_Oblig"> {_LANG_MAILTO_SUJET_ADHT} &nbsp;&nbsp;</th>
			<td><input type="text" name="email_sujet" id="email_sujet" title="{_LANG_MESSAGE_REMPLIR_ERR_SUJET_MAIL}" value="{if !empty($email_sujet)}{$email_sujet}{/if}" size="65"  maxlength="50" tabindex="3">
			{if !empty($erreur_saisie.email_sujet) && $erreur_saisie.email_sujet}
				<span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.email_sujet}</span> 
			{/if}</td>
		</tr>
		<tr>
		{* Votre message *}
			<th class="LignegrisRight_Oblig">{_LANG_MAILTO_MESSAGE_ADHT} &nbsp;&nbsp;</th>
		<td><textarea cols="80" rows="10" name="email_message" id="email_message" title="{_LANG_MESSAGE_REMPLIR_ERR_MESSAGE_MAIL}"  tabindex="4">{if !empty($email_message)}{$email_message}{/if}</textarea>
			{if !empty($erreur_saisie.email_message) && $erreur_saisie.email_message}
				<br><span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.email_message}</span> 
			{/if}</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
		{* Champs obligatoires *}
			<td class="TexterougeR">&nbsp;&nbsp;&nbsp;{_LANG_TPL_TEXTE_OBLIG}</td>
			<td>&nbsp;</td>
		</tr>

		<tr>
		{* boutons Envoyer et Annuler *}
			<th colspan="2">
			<input type="submit" class="submit_ok" name="Valider" value="{_LANG_TPL_ENOYERMAIL_BUTTON}" title="{_LANG_TPL_ENOYERMAIL_BUTTON_TITLE}">
			<input type="hidden" name="valid" value="valid">
			<input type="hidden" name="id_adht" value="{$id_adht}">
			<input type="hidden" name="email_adht" value="{$data_adherent.email_adht}">
			<input type="hidden" name="email_emmet" value="{$email_emmet}">
			<input type="hidden" name="pnom_admin" value="{$pnom_admin}">
			<a href="../adherent/gerer_fiche_adht.php?id_adht={$id_adht}"><span class="submit_nul" title="{_LANG_TPL_CANCEL_BUTTON_TITLE}">{_LANG_TPL_CANCEL_BUTTON}</span></a>
			</th>
		</tr>
    </table>
</form>
{* FIN Form .. *}

	</div>
{* FIN défini le contenu .. *}
