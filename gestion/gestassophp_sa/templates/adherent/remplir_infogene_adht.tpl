{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2018 (c) JC Etiemble HTML5*}
{* Affichage du CONTENU avec AIDE Rempir information générale *}
	<header class="header_titre_aide"><a href='#' style="cursor:pointer;cursor:hand" onclick="javascript :window.open('../aide/a_adht_remplir_infogene_adht.php','popup','height=450,toolbar=no,location=no,directories=no,status=yes,width=660,resizable=no,scrollbars=yes,top=10,left=10')" title="{language name=title_aide}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20"/>{language name=aide}</a></header> 
<script type="text/javascript" src="../js/comptemots.js"></script>
    <header class="header_titre">&nbsp;{language name=gestion_fiche_adht}{$affiche_message}</header>
	<div class="ligne_coul"></div> 	
	<div id="contenu"> {*défini le contenu .. *}
 	<br />
{if !empty($erreur_saisie)}
	{if $erreur_saisie|@count != 0}
		<div id="erreur-box"> {language name=tpl_texte_err_saisie}
		</div>	
	{/if}
{/if}			
{* Form .. *}
	<form method="post" name="maform" action="remplir_infogene_adht.php" enctype="multipart/form-data">
    
		{*Civilité*}
			<label class="label_fc">{language name=fiche_adht_civil} &nbsp;&nbsp;</label> 
			{html_options name="civilite" options=$list_civilite selected=$data_adherent.civilite_adht tabindex="1"}
		<br />
		{*Nom*}
			<label class="label_fc_Oblig"> {language name=tpl_col_adht_nom} &nbsp;&nbsp; </label>		
			<input type="text" name="nom_adht" id="nom_adht" title="{language name=fiche_adht_nom_title}" value="{$data_adherent.nom_adht}" size="32"  maxlength="50" tabindex="2" placeholder="{language name=fiche_adht_nom_placeholder}" {$disabled.nom_adht} /> {if $erreur_saisie.nom != ""} <span class="erreur-Jaunerouge">{$erreur_saisie.nom}</span>{/if}
		<br />
		{*Prénom*}
			<label class="label_fc_Oblig"> {language name=fiche_adht_prenom} &nbsp;&nbsp; </label>		
			<input type="text" name="prenom_adht" id="prenom_adht" title="{language name=fiche_adht_prenom_title}" value="{$data_adherent.prenom_adht}" size="32"  maxlength="50" tabindex="3" placeholder="{language name=fiche_adht_prenom_placeholder}" {$disabled.prenom_adht} /> {if $erreur_saisie.pnom != ""} <span class="erreur-Jaunerouge">{$erreur_saisie.pnom}</span>{/if}
		<br />
		{*Date de naissance*}
			<label class="label_fc">{language name=tpl_adht_datenais} &nbsp;&nbsp; </label>		
			<input type="text" name="datenaisance_adht" id="datenaisance_adht" title="{language name=fiche_adht_datenais_title}" value="{if $data_adherent.datenaisance_adht !== '00/00/0000'}{$data_adherent.datenaisance_adht}{/if}" size="12"  maxlength="12" tabindex="4" placeholder="{language name=fiche_adht_datenais_placeholder}" {$disabled.datenaisance_adht} />{if $erreur_saisie.d_nais}<span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.d_nais}</span>{/if}
		<br />
		{*Tranche âge*}
		<label class="label_fc"> {language name=fiche_adht_tage} &nbsp;&nbsp; </label>
		{if $disabled.tranche_age == 1} {if $data_adherent.tranche_age}{$data_adherent.tranche_age} {else} NC {/if}
		{else} 
		{html_options name="tranche_age_adht" options=$list_tranche_age_adht selected=$data_adherent.tranche_age tabindex="5"}
		{/if}		
		<br /><br />		
		{*Adresse*}
			<label class="label_fc"> {language name=fiche_adht_adress} &nbsp;&nbsp; </label>		
			<input type="text" name="adresse_adht" id="adresse_adht" title=" {language name=fiche_adht_adress_title}" value="{$data_adherent.adresse_adht}" size="65"  maxlength="98" tabindex="6" placeholder="{language name=fiche_adht_adress_placeholder}" {$disabled.adresse_adht} />
		<br />
		{*Code Postal - Ville *}
			<label class="label_fc_Oblig">  {language name=fiche_adht_cp} - {language name=tpl_col_adht_ville} &nbsp;&nbsp; </label>		
			<input type="text" name="cp_adht" id="cp_adht" title="{language name=fiche_adht_cp_title}" value="{$data_adherent.cp_adht}" size="6"  maxlength="50" tabindex="7" placeholder="{language name=fiche_adht_cp_placeholder}" {$disabled.cp_adht} />&nbsp;-&nbsp;<input type="text" name="ville_adht" id="ville_adht" title="{language name=tpl_col_adht_ville_title}" value="{$data_adherent.ville_adht}" size="35"  maxlength="50" tabindex="8" placeholder="{language name=tpl_col_adht_ville_placeholder}" {$disabled.ville_adht} />{if $erreur_saisie.cp} <span class="erreur-Jaunerouge">{$erreur_saisie.cp}</span>{/if} {if $erreur_saisie.ville} <span class="erreur-Jaunerouge">{$erreur_saisie.ville}</span>{/if}
		<br />
		{*Téléphone*}
			<label class="label_fc">{language name=tpl_col_adht_teleph} &nbsp;&nbsp; </label>		
			<input type="text" name="telephonef_adht" id="telephonef_adht" title="{language name=tpl_col_adht_teleph_title}" value="{$data_adherent.telephonef_adht}" size="18"  maxlength="16" tabindex="9" placeholder="{language name=tpl_col_adht_teleph_placeholder}" {$disabled.telephonef_adht} />
		<br />
		{*Portable*}
			<label class="label_fc"> {language name=tpl_col_adht_portable}  &nbsp;&nbsp; </label>		
			<input type="text" name="telephonep_adht" id="telephonep_adht" title="{language name=tpl_col_adht_portable_title}" value="{$data_adherent.telephonep_adht}" size="18"  maxlength="16" tabindex="10" placeholder="{language name=tpl_col_adht_portable_placeholder}" {$disabled.telephonep_adht} />
		<br />
		{*Fax devient tel Professionnel*}
			<label class="label_fc"> {language name=fiche_adht_fax} &nbsp;&nbsp; </label>
			<input type="text" name="telecopie_adht" id="telecopie_adht" title="{language name=fiche_adht_fax_title}" value="{$data_adherent.telecopie_adht}" size="18" maxlength="16" tabindex="11" placeholder="{language name=fiche_adht_fax_placeholder}" {$disabled.telecopie_adht} />
		<br />
		{*ajout de Profession*}
			<label class="label_fc"> {language name=fiche_adht_profession}&nbsp;&nbsp; </label>
			<input type="text" name="profession_adht" id="profession_adht" title="{language name=fiche_adht_profession_title}" value="{$data_adherent.profession_adht}" size="32" maxlength="50" tabindex="12" placeholder="{language name=fiche_adht_profession_placeholder}" {$disabled.telecopie_adht} />		
		<br />
		{*Email*}
			<label class="label_fc">{language name=fiche_adht_mail} &nbsp;&nbsp; </label>		
			<input type="text" name="email_adht" id="email_adht" title="{language name=fiche_adht_mail_title}" value="{$data_adherent.email_adht}" size="65"  maxlength="70" tabindex="13" placeholder="{language name=fiche_adht_mail_placeholder}"  {$disabled.email_adht} />{if $erreur_saisie.email} <span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.email}</span> {/if}
		<br />
		{*Site WEB   http://*}
			<label class="label_fc">{language name=fiche_adht_web} &nbsp;&nbsp;<span class="TextenoirR">http://</span></label>		
			<input type="text" name="siteweb_adht" id="siteweb_adht" title="{language name=fiche_adht_web_title}" value="{$data_adherent.siteweb_adht}" size="65"  maxlength="50" tabindex="14" placeholder="{language name=fiche_adht_web_placeholder}"  {$disabled.siteweb_adht} />
		<br />
		{*si ajout de Autres informations*} 
			<label class="label_fc"> {language name=fiche_adht_autres_info}&nbsp;&nbsp; </label>
			<input type="text" name="autres_info_adht" id="autres_info_adht" title="{language name=fiche_adht_autres_info_title}" value="{$data_adherent.autres_info_adht}" size="65" maxlength="980" tabindex="15" placeholder="{language name=fiche_adht_autres_info_placeholder}" {$disabled.telecopie_adht} />		
		<br />
		{*Afficher mes coordonnées OUI/Non visible par les autres*} 
			<label class="label_fc" title="{language name=fiche_adht_coord_title}{$nom_asso_gestassophp}">{language name=fiche_adht_coord} &nbsp;&nbsp;</label>	
			{html_options name="visible_adht" options=$list_oui_non selected=$data_adherent.visibl_adht  tabindex="16"}		
			<p class="TextenoirR">&nbsp;[{language name=fiche_adht_coord_title} {$nom_asso_gestassophp}]</p>	
		{*Observations zone texte*}
			<label class="label_fc">{language name=fiche_adht_compl} 
		<br />	
			<span class="TextenoirR">{language name=fiche_adht_compl_nbc}</span> {*caractère(s) restants*}
			<input readonly="readonly" type="text" name="compte" size="3" maxlength="3" value="200" title="{language name=fiche_adht_compl_nbc_title}"/></label>
            <textarea cols="60" rows="3" name="disponib_adht" onkeydown="Compteur_Texte(this,this.form.compte,200);" onkeyup="Compteur_Texte(this,this.form.compte,200);" placeholder="{language name=fiche_adht_compl_placeholder}" tabindex="17">{$data_adherent.disponib_adht}</textarea>
		<br /><br />
		{*N° adhésion*}	
			<label class="label_fc"> {language name=fiche_adht_promotion} &nbsp;&nbsp; </label>	
				<input type="text" name="promotion_adht" id="promotion_adht" title="{language name=fiche_adht_promotion_title}" value="{$data_adherent.promotion_adht}" size="32"  maxlength="25" tabindex="18" placeholder="{language name=fiche_adht_promotion_placeholder}" {$disabled.promotion_adht} />
		<br />	
		{*Section=désignation des activités  Préférences/Onglet 2*}		
			<label class="label_fc"> {language name=fiche_adht_ant}&nbsp;&nbsp;</label> 
			{if $disabled.antenne_adht == 1} {$data_adherent.nom_type_antenne}{else} {html_options name="id_type_antenne_adht" options=$list_antenne_adht selected=$data_adherent.id_type_antenne tabindex="19"}{/if}
		<br />
				
	{if $required.creation_adht == 1} {* UNIQUEMENT Si Création de la fiche *}	
		{*Date d'inscription pour la création de la fiche*}
			<label class="label_fc_Oblig"> {language name=fiche_adht_d_inscript}&nbsp;&nbsp; </label>		
			<input type="text" name="date_inscription_adht" id="date_inscription_adht" title="{language name=tpl_texte_date_title}" value="{if $data_adherent.date_inscription_adht}{$data_adherent.date_inscription_adht} {else}{$date_dujour}{/if}" size="12" maxlength="12" tabindex="20" {$disabled.date_inscription} />{if $erreur_saisie.d_inscript}<span class="erreur-Jaunerouge">{$erreur_saisie.d_inscript}</span>{/if}
		<br />
		{*Création du Login et du Mot de passe*}
		<fieldset> 
		<legend>{language name=fiche_adht_create_loginpass}</legend> 
		<br />
			<label class="label_fc_Oblig"> {language name=login_user}&nbsp; </label>			
		<input type="text" name="login_adht" id="login_adht" title="{language name=fiche_adht_login}" value="{$data_adherent.login_adht}" size="22"  maxlength="22" tabindex="21"  placeholder="{language name=fiche_adht_login_placeholder}" />{if $erreur_saisie.login} <span class="erreur-Jaunerouge">{$erreur_saisie.login}</span>{/if}
		<br />	
		 {*Login utilisateur*}		
			<span class="TexterougeR">&nbsp;&nbsp;&nbsp;&nbsp;{language name=fiche_adht_login_upper}<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;{language name=fiche_adht_passwd410}</span>
		<br /><br />		
		 {*Mot de passe*}
			<label class="label_fc_Oblig">&nbsp;&nbsp;{language name=login_my_passwd}&nbsp; </label>
				<input type="password" name="pass_adht1" id="pass_adht1" title="{language name=fiche_adht_passwd_title}" value="{$data_adherent.pass_adht1}" size="16"  maxlength="18" tabindex="22" placeholder="{language name=fiche_adht_passwd410_placeholder}" {$disabled.pass_adht1} />
			<span class="TexterougeGras ">&nbsp;&nbsp;{language name=fiche_adht_confirm}&nbsp;</span> 
				<input type="password" name="pass_adht2" id="pass_adht2" title="{language name=fiche_adht_passwd_confirm_title}" value="{$data_adherent.pass_adht2}" size="16"  maxlength="18" tabindex="23" placeholder="{language name=fiche_adht_passwd410_placeholder}" {$disabled.pass_adht2} />{if $erreur_saisie.mdp} <span class="erreur-Jaunerouge">{$erreur_saisie.mdp}</span>{/if}<span class="TextenoirR"></span>
		</fieldset> 
		
	{else} {* Si modification de la fiche *}
		<br />
		{*Fiche enregistrée par*}
		{* MODIFICATION qui a enrregistré la fiche; SI Admin =9, SINON Modification disabled *} 
			<label class="label_fc"> {language name=fiche_adht_fiche_enr}&nbsp;&nbsp; </label>		
			{if $non_visible_adht_creation_fiche == 1} {$pnom_creation_fiche_adht}<br />
			{else}
			{html_options name=id_adht_modif_creation_fiche options=$listnoms selected=$data_adherent.qui_enrg_adht tabindex="19"}<br />
			{/if}
		<br />		
		{* MODIFICATION Mot de passe SI Admin =9 Ou si id_adht=$sessionadherent *}	
		{if ($id_adht == $smarty.session.ses_id_adht) || ($priorite_adht == 9)}
		{*Login utilisateur / Modification du Mot de passe*}
		<fieldset> 
		<legend>{language name=login_user}&nbsp;/&nbsp;{language name=fiche_adht_modif_passwd}</legend>		
			{* MODIFICATION Login utilisateur si Admin=9 *}
			{if $priorite_adht == 9}
				<br />
				{*Login utilisateur*}
				<label class="label_fc_Oblig">{language name=login_user}&nbsp; </label>	
					<input type="text" name="login_adht" id="login_adht" title="{language name=fiche_adht_login}" value="{$data_adherent.login_adht}" size="22"  maxlength="22" tabindex="20" />{if $erreur_saisie.login}<span class="erreur-Jaunerouge">{$erreur_saisie.login}</span>{/if}
				<br />	
					<span class="TexterougeR">&nbsp;&nbsp;&nbsp;&nbsp;{language name=fiche_adht_login_upper}</span>{*Le Login (entre 4 et 20 caract...*}
				<br />
			{/if} {* Fin Modification Login utilisateur si Admin=9 *} 
			{* Possible de modifier Mot de passe SI Admin=9 Ou si id_adht=$sessionadherent *}
			<p class="TexterougeR">{language name=fiche_adht_modif_passwd}&nbsp;&nbsp;({language name=fiche_adht_passwd410})</p>	
			<span class="TextenoirGras">{language name=fiche_adht_modif_passwd}&nbsp;</span> 
				<input type="password" name="pass_adht1" id="pass_adht1" title="{language name=fiche_adht_newpasswd_title}" value="{$data_adherent.pass_adht1}" size="16"  maxlength="18" tabindex="20" {$disabled.pass_adht1} />
			<span class="TextenoirGras">&nbsp;&nbsp;{language name=fiche_adht_confirm}&nbsp;</span> 
				<input type="password" name="pass_adht2" id="pass_adht2" title="{language name=fiche_adht_passwd_confirm_title}" value="{$data_adherent.pass_adht2}" size="16"  maxlength="18" tabindex="21" {$disabled.pass_adht2} />{if $erreur_saisie.mdp}<span class="erreur-Jaunerouge">{$erreur_saisie.mdp}</span>{/if}
		{/if}
		</fieldset>
	{/if} {*  Fin Affichage si Création ou modification de la fiche*}

			{*Champs obligatoires*}
			<span class="TexterougeR">&nbsp;&nbsp;&nbsp;{language name=tpl_texte_oblig}</span>
	
		{* Photo *}
		{if $required.creation_adht !== 1}
		<div class="centre-txt">
			 {if $photo_adht!=="[ Pas de photo ]"}{$photo_adht}<br />
				<input type="submit" name="del_photo" value="{language name=fiche_adht_del_photo}" onclick="return confirm('{language name=fiche_adht_confirm_del_photo}')"  title="{language name=fiche_adht_del_photo_title}" class="submit_del" tabindex="22"/>
			{else} {language name=fiche_adht_upload_photo}<br /> {if $erreur_saisie.photo} <span class="erreur-Jaunerouge">{$erreur_saisie.photo}</span><br />{/if}
				<input type="file" name="photo" title="{language name=fiche_adht_add_photo_title}" />
			{/if}
		</div>
		{/if}	
		{* Fin Photo *}		

		<div class="centre-txt"><br />
			<input type="submit" class="submit_ok" name="Valider" value="{language name=tpl_valid_button}" title="{language name=tpl_valid_button_title}"/>
			<input type="hidden" name="valid" value="valid"/>
			<input type="hidden" name="id_adht" value="{$id_adht}"/>		
			{if $required.creation_adht == 1}<a href="../adherent/liste_adht_admin.php"><span class="submit_nul" title="{language name=tpl_cancel_button_title}">{language name=tpl_cancel_button}</span></a>{else}
			<a href="../adherent/gerer_fiche_adht.php?id_adht={$id_adht}"><span class="submit_nul" title="{language name=tpl_cancel_button_title}">{language name=tpl_cancel_button}</span></a>{/if}			
		</div>

	</form>
{* Fin Form .. *}		 
	 

		
	 
	</div> {* / défini le contenu .. *} 
