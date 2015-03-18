{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2014 (c) JC Etiemble HTML5*}
{* Affichage du CONTENU avec AIDE remplir fichier adhérent*}
	<header class="header_titre_aide"><a href='#' style="cursor:pointer;cursor:hand" onclick="javascript :window.open('../aide/a_adht_remplir_fichier_adht.php','popup','height=500,toolbar=no,location=no,directories=no,status=yes,width=700,resizable=no,scrollbars=yes,top=10,left=10')" title="{language name=title_aide}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20"/>{language name=aide}</a></header> 

    <header class="header_titre">&nbsp;{language name=titre_admin_file_adht}{$affiche_message}</header>
	<div class="ligne_coul"></div> 	
	<div id="contenu"> {*défini le contenu .. *}
 	<br />

{if $erreur_saisie|@count != 0} 
		<div id="erreur-box"> {language name=tpl_texte_err_saisie} :<br /> 
		{if $erreur_saisie.pas_fichier}<span class="erreur-Jaunerouge">{$erreur_saisie.pas_fichier}<br /></span>{/if}
		{if $erreur_saisie.taille_fichier}<span class="erreur-Jaunerouge">{$erreur_saisie.taille_fichier}<br /></span>{/if}
		{if $erreur_saisie.nonvalide_caract}<span class="erreur-Jaunerouge">{$erreur_saisie.nonvalide_caract}<br /></span>{/if}
		{if $erreur_saisie.caract_sup_x}<span class="erreur-Jaunerouge">{$erreur_saisie.caract_sup_x}</span><br />{/if}
		{if $erreur_saisie.fichier_existant}<span class="erreur-Jaunerouge">{$erreur_saisie.fichier_existant}<br /></span>{/if}
		{if $erreur_saisie.id_adht}<span class="erreur-Jaunerouge">{$erreur_saisie.id_adht}</span>{/if}		
		</div>
{else}
		<div id="erreur-box-vide">&nbsp;</div>
{/if}
{* Form .. *}

	<form method="post" name="maform" action="remplir_fichier_adht.php" enctype="multipart/form-data">
		{if $id_file_adht ==''} {* si on upload un nouveau fichier*}
	 
		<fieldset> 
		<legend>{language name=file_adht_upload}</legend>
		<br />

		<label class="label_fc_Oblig" title="{language name=file_adht_name_title}">{language name=file_adht_max}</label>{*Le nom du fichier Oblig*}
			<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
			<input type="file" name="monfichier" title="{language name=file_adht_titlemax}"/>
		<br />
	
		{else} {* si on modifie la designation fichier*} {*	*}
		
		{if $archive_fiche != "1"}<fieldset> {*	si fichier Non archivé - Modifier la description ou le destinataire*}
		<legend>{language name=file_adht_modif}</legend>{/if}
		<br />

		<label class="label_fc" title="{language name=tpl_texte_date_title}"> {language name=file_adht_datei}</label>{*Date d'inscription*}
			<input type="text" name="date_file_adht" id="date_file_adht" title="{language name=tpl_texte_date_title}" value="{$date_file_adht}" size="12" maxlength="12" tabindex="16" disabled="disabled" />
		<br /><br />
		<label class="label_fc_Oblig" title="{language name=file_adht_name_title}"> {language name=file_adht_name}</label> {*Le nom du fichier Oblig*}
			<input type="text" name="mon_fichier" id="mon_fichier" title="{language name=file_adht_name_title}"  value="{$nom_fichier}" size="70"  maxlength="50" tabindex="2" disabled="disabled" />
		<br />	
		{/if} {* Fin si on upload ou  modifie *}			

		<label class="label_fc" title="{language name=file_adht_descript_title}"> {language name=file_adht_descript}</label>{*Description du fichier*}			
			<input type="text" name="descript_fichier" id="descript_fichier" title="{language name=file_adht_descript_title}" value="{$descript_fichier}" size="60"  maxlength="50" tabindex="2" placeholder="{language name=file_adht_descript_placeholder}" /> {if $erreur_saisie.nom != ""} <span class="erreur-Jaunerouge">{$erreur_saisie.nom}</span>{/if}
		<br />
		<label class="label_fc_Oblig"> {$adherent_bene} {language name=file_adht_to}</label> {*Utilisateur destinataire Oblig*}
			{if $archive_fiche == "1"}{html_options name=id_adht_modif options=$listnoms selected=$id_adht_file tabindex="4" disabled="disabled"}
			{else}
			{html_options name=id_adht_modif options=$listnoms selected=$id_adht_file tabindex="4"}
			{/if}
		<br /><br />
{if $id_file_adht !=''}{* Nom du déposant du fichier*}		
		<label class="label_fc"> {language name=file_adht_by}</label>{*Fichier déposé par*}
			{$nom_qui_file_adht}
{/if}
		<p class="TexterougeR">&nbsp;&nbsp;&nbsp;{language name=tpl_texte_oblig}</p>
		<div class="centre-txt"><br />
			{if $archive_fiche == "1"}
			{* pour afficher uniquement le bouton retour *}
			<a href="../adherent/liste_fichiers_adht.php"><span class="submit_nul" title="{language name=tpl_retour_button_title}">{language name=tpl_retour_button}</span></a>
			{else}			
			<input type="submit" class="submit_ok" name="Valider" value="{language name=tpl_valid_button}" title="{language name=tpl_valid_button_title}"/>
			<input type="hidden" name="valid" value="validation"/>
			<input type="hidden" name="id_file_adht" value="{$id_file_adht}"/>{*Id du Fichier *}
			<input type="hidden" name="id_adht_file" value="{$id_adht_file}"/>{*Id du Nom initial*} 			
			<a href="../adherent/liste_fichiers_adht.php"><span class="submit_nul" title=" {language name=tpl_cancel_button_title}"> {language name=tpl_cancel_button}</span></a>
			{/if}
		</div>
	</fieldset>	
    </form>
	 
	</div> {* / défini le contenu .. *} 
