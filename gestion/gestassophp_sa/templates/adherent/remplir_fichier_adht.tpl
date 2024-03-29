{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2023 (c) JC Etiemble HTML5 * }
{* Affichage du CONTENU avec AIDE remplir fichier adhérent *}
	<header class="header_titre_aide"><a href='#' style="cursor:pointer;" onclick="javascript :window.open('../aide/a_adht_remplir_fichier_adht.php','popup','height=500,toolbar=no,location=no,directories=no,status=yes,width=700,resizable=no,scrollbars=yes,top=10,left=10')" title="{_LANG_TITLE_AIDE}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20">{_LANG_AIDE}</a></header>

    <header class="header_titre">&nbsp;{_LANG_TITRE_ADMIN_FILE_ADHT}{$affiche_message}</header>
	<div class="ligne_coul"></div>
	<div id="contenu">
{* défini le contenu .. *}
 	<br>

{if $erreur_saisie|@count != 0}
		<div id="erreur-box"> {_LANG_TPL_TEXTE_ERR_SAISIE} :<br>
		{if !empty($erreur_saisie.pas_fichier)}
			{* erreur pas de fichier *}
			<span class="erreur-Jaunerouge">{$erreur_saisie.pas_fichier}<br></span>
		{/if}
		{if !empty($erreur_saisie.taille_fichier)}
			{* erreur taille du fichier *}
			<span class="erreur-Jaunerouge">{$erreur_saisie.taille_fichier}<br></span>
		{/if}
		{if !empty($erreur_saisie.nonvalide_caract)}
			{* erreur caractères non valides *}
			<span class="erreur-Jaunerouge">{$erreur_saisie.nonvalide_caract}<br></span>
		{/if}
		{if !empty($erreur_saisie.caract_sup_x)}
			{* erreur Nb de caractères supérieurs à x *}
			<span class="erreur-Jaunerouge">{$erreur_saisie.caract_sup_x}</span><br>
		{/if}
		{if !empty($erreur_saisie.fichier_existant)}
			{* erreur fichier existant *}
			<span class="erreur-Jaunerouge">{$erreur_saisie.fichier_existant}<br></span>
		{/if}
		{if !empty($erreur_saisie.id_adht)}
			{* erreur Adhérent destinataire *}
			<span class="erreur-Jaunerouge">{$erreur_saisie.id_adht}</span>
		{/if}
		</div>
{else}
		<div id="erreur-box-vide">&nbsp;</div>
{/if}
{* Form Upload depuis Votre ordinateur vers le serveur *}

	<form method="post" name="maform" action="remplir_fichier_adht.php" enctype="multipart/form-data">
	{if empty($id_file_adht)}
		{* si on upload un nouveau fichier *} 
			<fieldset>
			<legend>{_LANG_FILE_ADHT_UPLOAD}</legend>
			<br>
		{* Sélection du fichier maxi 100 Ko *}
			<label class="label_fc_Oblig" title="{_LANG_FILE_ADHT_NAME_TITLE}">{_LANG_FILE_ADHT_MAX}</label>{*Le nom du fichier Oblig*}
				<input type="hidden" name="MAX_FILE_SIZE" value="300000">
				<input type="file" name="monfichier" title="{_LANG_FILE_ADHT_TITLEMAX}">
			<br>
	{else}
		{* si on modifie la designation fichier *}
		{if empty($archive_fiche)}
			{* si fichier Non archivé - Modifier la description ou le destinataire *}
			<fieldset>
			<legend>{_LANG_FILE_ADHT_MODIF}</legend>
		{/if}
			<br>
		{* Date du dépôt du fichier *}
			<label class="label_fc" title="{_LANG_TPL_TEXTE_DATE_TITLE}"> {_LANG_FILE_ADHT_DATEI}</label>
				<input type="text" name="date_file_adht" id="date_file_adht" title="{_LANG_TPL_TEXTE_DATE_TITLE}" value="{if !empty($date_file_adht)}{$date_file_adht}{/if}" size="12" maxlength="12" tabindex="1" disabled="disabled">
			<br><br>
		{* Le nom du fichier Oblig *}
			<label class="label_fc_Oblig" title="{_LANG_FILE_ADHT_NAME_TITLE}"> {_LANG_FILE_ADHT_NAME}</label>
				<input type="text" name="mon_fichier" id="mon_fichier" title="{_LANG_FILE_ADHT_NAME_TITLE}"  value="{if !empty($nom_fichier)}{$nom_fichier}{/if}" size="55" maxlength="50" tabindex="2" disabled="disabled">
			<br>
	{/if}
	{* FIN si on upload ou  modifie *}

		<label class="label_fc" title="{_LANG_FILE_ADHT_DESCRIPT_TITLE}"> {_LANG_FILE_ADHT_DESCRIPT}</label>{*Description du fichier*}
			<input type="text" name="descript_fichier" id="descript_fichier" title="{_LANG_FILE_ADHT_DESCRIPT_TITLE}" value="{if !empty($descript_fichier)}{$descript_fichier}{/if}" size="60" maxlength="50" tabindex="2" placeholder="{_LANG_FILE_ADHT_DESCRIPT_PLACEHOLDER}">
			{if !empty($erreur_saisie.nom)}
				<span class="erreur-Jaunerouge">{$erreur_saisie.nom}</span>
			{/if}
		<br>
	{* Utilisateur destinataire Oblig *}
		<label class="label_fc_Oblig"> {$adherent_bene} {_LANG_FILE_ADHT_TO}</label>
			{if !empty($archive_fiche) && $archive_fiche == 1}
				{html_options name = id_adht_modif options = $listnoms selected = $id_adht_file tabindex = "4" disabled = "disabled"}
			{else}
				{html_options name = id_adht_modif options = $listnoms selected = $id_adht_file tabindex = "4"}
			{/if}
		<br><br>

	{if !empty($id_file_adht)}
	{* Nom du déposant du fichier *}
		<label class="label_fc"> {_LANG_FILE_ADHT_BY}</label>{* Fichier déposé par *}
			{$nom_qui_file_adht}
	{/if}

		<p class="TexterougeR">&nbsp;&nbsp;&nbsp;{_LANG_TPL_TEXTE_OBLIG}</p>

		<div class="centre-txt"><br>
			{if !empty($archive_fiche) && $archive_fiche == 1}
				{* pour afficher uniquement le bouton retour *}
				<a href="../adherent/liste_fichiers_adht.php"><span class="submit_nul" title="{_LANG_TPL_RETOUR_BUTTON}">{_LANG_TPL_RETOUR_BUTTON}</span></a>
			{else}
				<input type="submit" class="submit_ok" name="Valider" value="{_LANG_TPL_VALID_BUTTON}" title="{_LANG_TPL_VALID_BUTTON_TITLE}">
				<input type="hidden" name="valid" value="validation">
				<input type="hidden" name="id_file_adht" value="{if !empty($id_file_adht)}{$id_file_adht}{/if}">{* Id du Fichier *}
				<input type="hidden" name="id_adht_file" value="{if !empty($id_adht_file)}{$id_adht_file}{/if}">{* Id du Nom initial *}
				<a href="../adherent/liste_fichiers_adht.php"><span class="submit_nul" title=" {_LANG_TPL_CANCEL_BUTTON_TITLE}"> {_LANG_TPL_CANCEL_BUTTON}</span></a>

			{/if}
		</div>
		{if !isset($archive_fiche)}{* pour validation HTML Consultation Fichier supprimé *}
		</fieldset>	
		{/if}
    </form>


	</div>
{* / défini le contenu .. *}
