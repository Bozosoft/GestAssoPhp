{* Projet : gestassophp_sa [GestAssoPhp+Pg]*}
{* Affichage du CONTENU avec AIDE Rempir information générale *}
	<div id="titre_aide"><a href='#' style="cursor:pointer;cursor:hand" onclick="javascript :window.open('../aide/a_adht_remplir_infogene_adht.php','popup','height=450,toolbar=no,location=no,directories=no,status=yes,width=660,resizable=no,scrollbars=yes,top=10,left=10')" title="{language name=title_aide}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20"/>{language name=aide}</a></div> 
<script type="text/javascript" src="../js/comptemots.js"></script>
    <div id="titre">&nbsp;{language name=gestion_fiche_adht}{$affiche_message}</div>
	<div class="ligne_coul"></div> 	
	<div id="contenu"> {*défini le contenu .. *}
 	<br />

 {if $erreur_saisie|@count != 0}
		<div id="erreur-box"> {language name=tpl_texte_err_saisie}
		</div>	
{/if}		
{* Form .. *}
	    <form method="post" name="maform" action="remplir_infogene_adht.php" enctype="multipart/form-data">
    	<table width="98%" summary="informations générales">
		<tr> 
			<th class="LignegrisRight" width="26%">{language name=fiche_adht_civil} &nbsp;&nbsp;</th> 
			<td>{html_options name="civilite" options=$list_civilite selected=$data_adherent.civilite_adht tabindex="1"} </td> 
		</tr> 
		<tr>
			<th class="LignegrisRight_Oblig"> {language name=tpl_col_adht_nom} &nbsp;&nbsp; </th>		
			<td><input type="text" name="nom_adht" id="nom_adht" title="{language name=fiche_adht_nom_title}" value="{$data_adherent.nom_adht}" size="32"  maxlength="50" tabindex="2" {$disabled.nom_adht} /> {if $erreur_saisie.nom != ""} <span class="erreur-Jaunerouge">{$erreur_saisie.nom}</span>{/if}</td>
		</tr>
		<tr>
			<th class="LignegrisRight_Oblig"> {language name=fiche_adht_prenom} &nbsp;&nbsp; </th>		
			<td><input type="text" name="prenom_adht" id="prenom_adht" title="{language name=fiche_adht_prenom_title}" value="{$data_adherent.prenom_adht}" size="32"  maxlength="50" tabindex="3" {$disabled.prenom_adht} /> {if $erreur_saisie.pnom != ""} <span class="erreur-Jaunerouge">{$erreur_saisie.pnom}</span>{/if}</td>
		</tr>		
		<tr>
			<th class="LignegrisRight"> {language name=tpl_adht_datenais} &nbsp;&nbsp; </th>		
			<td><input type="text" name="datenaisance_adht" id="datenaisance_adht" title="{language name=fiche_adht_datenais_title}" value="{if $data_adherent.datenaisance_adht !== '00/00/0000'}{$data_adherent.datenaisance_adht}{/if}" size="12"  maxlength="12" tabindex="4" {$disabled.datenaisance_adht} />{if $erreur_saisie.d_nais}<span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.d_nais}</span>{/if}</td>
		</tr>
		<tr>
			<th class="LignegrisRight"> {language name=fiche_adht_adress} &nbsp;&nbsp; </th>		
			<td><input type="text" name="adresse_adht" id="adresse_adht" title=" {language name=fiche_adht_adress_title}" value="{$data_adherent.adresse_adht}" size="50"  maxlength="80" tabindex="5" {$disabled.adresse_adht} /></td>
		</tr>
		<tr>
			<th class="LignegrisRight_Oblig">  {language name=fiche_adht_cp} - {language name=tpl_col_adht_ville} &nbsp;&nbsp; </th>		
			<td><input type="text" name="cp_adht" id="cp_adht" title="{language name=fiche_adht_cp_title}" value="{$data_adherent.cp_adht}" size="6"  maxlength="50" tabindex="6" {$disabled.cp_adht} />&nbsp;-&nbsp;<input type="text" name="ville_adht" id="ville_adht" title="{language name=tpl_col_adht_ville_title}" value="{$data_adherent.ville_adht}" size="35"  maxlength="50" tabindex="7" {$disabled.ville_adht} />{if $erreur_saisie.cp} <span class="erreur-Jaunerouge">{$erreur_saisie.cp}</span>{/if} {if $erreur_saisie.ville} <span class="erreur-Jaunerouge">{$erreur_saisie.ville}</span>{/if}</td>
		</tr>
		<tr>
			<th class="LignegrisRight"> {language name=tpl_col_adht_teleph} &nbsp;&nbsp; </th>		
			<td><input type="text" name="telephonef_adht" id="telephonef_adht" title="{language name=tpl_col_adht_teleph_title}" value="{$data_adherent.telephonef_adht}" size="18"  maxlength="16" tabindex="8" {$disabled.telephonef_adht} /></td>
		</tr>		
		<tr>
			<th class="LignegrisRight"> {language name=tpl_col_adht_portable}  &nbsp;&nbsp; </th>		
			<td><input type="text" name="telephonep_adht" id="telephonep_adht" title="{language name=tpl_col_adht_portable_title}" value="{$data_adherent.telephonep_adht}" size="18"  maxlength="16" tabindex="8" {$disabled.telephonep_adht} /></td>
		</tr>
		<tr>
			<th class="LignegrisRight"> {language name=fiche_adht_fax} &nbsp;&nbsp; </th>
			<td><input type="text" name="telecopie_adht" id="telecopie_adht" title="{language name=fiche_adht_fax_title}" value="{$data_adherent.telecopie_adht}" size="18" maxlength="16" tabindex="10" {$disabled.telecopie_adht} /></td>
		</tr>
		<tr>
			<th class="LignegrisRight"> {language name=fiche_adht_mail} &nbsp;&nbsp; </th>		
			<td><input type="text" name="email_adht" id="email_adht" title="{language name=fiche_adht_mail_title}" value="{$data_adherent.email_adht}" size="65"  maxlength="50" tabindex="11" {$disabled.email_adht} />{if $erreur_saisie.email} <span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.email}</span> {/if}</td>
		</tr>
		<tr>
			<th class="LignegrisRight"> {language name=fiche_adht_web} &nbsp;&nbsp;<span class="TextenoirR">http://</span></th>		
			<td><input type="text" name="siteweb_adht" id="siteweb_adht" title="{language name=fiche_adht_web_title}" value="{$data_adherent.siteweb_adht}" size="65"  maxlength="50" tabindex="12" {$disabled.siteweb_adht} /></td>
		</tr>
{* Affichage  Antenne - 25/05/2008 ajout antenne_adht  *}	
		<tr> 
			<th class="LignegrisRight" width="20%"> {language name=fiche_adht_ant}&nbsp;&nbsp;</th> 
			<td> {if $disabled.antenne_adht == 1} {$data_adherent.nom_type_antenne}{else} {html_options name="id_type_antenne_adht" options=$list_antenne_adht selected=$data_adherent.id_type_antenne tabindex="13"}{/if}</td> 
		</tr>
{* Affichage  Tranche âge *}
{* essai html_options name="tranche_age_adht" *}
		
		<tr>
		<th class="LignegrisRight"> {language name=fiche_adht_tage} &nbsp;&nbsp; </th>
		<td> 
		{if $disabled.tranche_age == 1} {$data_adherent.tranche_age}
		{else} 
		{html_options name="tranche_age_adht" options=$list_tranche_age_adht selected=$data_adherent.tranche_age tabindex="14"}
		{/if}
		</td>
		</tr>
		
{* essai ajout champ + *}		
		<tr>
			<th class="LignegrisRight"> {language name=fiche_adht_promotion} &nbsp;&nbsp; </th>		
			<td><input type="text" name="promotion_adht" id="promotion_adht" title="{language name=fiche_adht_promotion_title}" value="{$data_adherent.promotion_adht}" size="32"  maxlength="25" tabindex="15" {$disabled.promotion_adht} /></td>
		</tr>			
{* / essai ajout champ + *}		
	
		<tr>
			<th class="LignegrisRight" title="{language name=fiche_adht_coord_title}{$nom_asso_gestassophp}">{language name=fiche_adht_coord} &nbsp;&nbsp;</th>		
			<td>
				{html_options name="visible_adht" options=$list_oui_non selected=$data_adherent.visibl_adht  tabindex="16"}
				<span class="TextenoirR">&nbsp;[{language name=fiche_adht_coord_title} {$nom_asso_gestassophp}]</span>
			</td>
		</tr>		
{* Ajout de la note ... disponib_adht*}
		<tr>
			<td class="LignegrisRight"> <span class="TextenoirGras">{language name=fiche_adht_compl}</span> &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br /><br />
			<span class="TextenoirR">{language name=fiche_adht_compl_nbc}</span>&nbsp;<input readonly="readonly" type="text" name="compte" size="3" maxlength="3" value="200" title="{language name=fiche_adht_compl_nbc_title}"/> </td>	
			<td>            <!-- zone Txt -->
            <textarea cols="60" rows="3" name="disponib_adht" onkeydown="Compteur_Texte(this,this.form.compte,200);" onkeyup="Compteur_Texte(this,this.form.compte,200);" tabindex="17">{$data_adherent.disponib_adht}</textarea></td>
			
		</tr>
		
				
{if $required.creation_adht == 1} {* Affichage si Création *}	
		<tr>
			<th class="LignegrisRight_Oblig"> {language name=fiche_adht_d_inscript}&nbsp;&nbsp; </th>		
			<td><input type="text" name="date_inscription_adht" id="date_inscription_adht" title="{language name=tpl_texte_date_title}" value="{if $data_adherent.date_inscription_adht}{$data_adherent.date_inscription_adht} {else}{$date_dujour}{/if}" size="12" maxlength="12" tabindex="18" {$disabled.date_inscription} />{if $erreur_saisie.d_inscript}<span class="erreur-Jaunerouge">{$erreur_saisie.d_inscript}</span>{/if}</td>
		</tr>			
		<tr>		
			<td>&nbsp;</td>
		</tr>		
		<tr>
			<th class="LignegrisC" colspan="2"> {language name=fiche_adht_create_loginpass}</th>
		</tr>
		<tr>
			<th class="LignegrisRight_Oblig"> {language name=login_user}&nbsp; </th>			
		<td><input type="text" name="login_adht" id="login_adht" title="{language name=fiche_adht_login}" value="{$data_adherent.login_adht}" size="22"  maxlength="22" tabindex="19" />{if $erreur_saisie.login} <span class="erreur-Jaunerouge">{$erreur_saisie.login}</span>{/if}</td>
		</tr>
	
		<tr>		
			<td colspan ="2"><span class="TextenoirR">&nbsp;&nbsp;&nbsp;&nbsp;{language name=fiche_adht_login_upper}<<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;{language name=fiche_adht_passwd410}</span></td>
		</tr>		
		<tr>		
			<td colspan="2" class="LignegrisC_Oblig">&nbsp;&nbsp;{language name=login_my_passwd}&nbsp; <input type="password" name="pass_adht1" id="pass_adht1" title="{language name=fiche_adht_passwd_title}" value="{$data_adherent.pass_adht1}" size="16"  maxlength="12" tabindex="20" {$disabled.pass_adht1} />&nbsp;&nbsp;{language name=fiche_adht_confirm}&nbsp; <input type="password" name="pass_adht2" id="pass_adht2" title="{language name=fiche_adht_passwd_confirm_title}" value="{$data_adherent.pass_adht2}" size="16"  maxlength="12" tabindex="21" {$disabled.pass_adht2} />{if $erreur_saisie.mdp} <span class="erreur-Jaunerouge">{$erreur_saisie.mdp}</span>{/if}<span class="TextenoirR"></span></td>
		</tr>
		
{else} {* Affichage si modification *}
		
		<!-- tr>		
			<td>&nbsp;</td>
		</tr -->

{* ++  qui a enrregistré la fiche  -1 si Admin>=9  Modification Ok sinon Modification disabled  *} 
		<tr>
			<th class="LignegrisRight"> {language name=fiche_adht_fiche_enr}&nbsp;&nbsp; </th>		
            <td>
			{if $non_visible_adht_creation_fiche == 1} {$pnom_creation_fiche_adht}
			{else}
			{html_options name=id_adht_modif_creation_fiche options=$listnoms selected=$data_adherent.qui_enrg_adht tabindex="18"}
			{/if}
			</td>
		</tr>		
{* ++ qui a enrregistré la fiche si Admin=9 *}	
		
	{* Modification Mot de passe si Admin=9*}
	{if $priorite_adht == 9}
		<tr>
			<th class="LignegrisRight_Oblig">{language name=login_user}&nbsp; </th>		
			<td><input type="text" name="login_adht" id="login_adht" title="{language name=fiche_adht_login}" value="{$data_adherent.login_adht}" size="22"  maxlength="22" tabindex="19" />{if $erreur_saisie.login}<span class="erreur-Jaunerouge">{$erreur_saisie.login}</span>{/if}</td>
		</tr>			
		<tr>		
			<td colspan ="2"><span class="TexterougeR">&nbsp;&nbsp;&nbsp;&nbsp;{language name=fiche_adht_login_upper}</span></td>
		</tr>
		
	{/if}		
{* Fin Modification Mot de passe si Admin=9 *} 
{* + Possible de modifier SI Admin=9 Ou si id_adht=$sessionadherent*}	
		{if ($id_adht == $smarty.session.ses_id_adht) || ($priorite_adht == 9)}
		<tr>
			<th class="LignegrisC" colspan="2">{language name=fiche_adht_modif_passwd}&nbsp;&nbsp;<span class="TextenoirR">({language name=fiche_adht_passwd410})</span></th>
		</tr>
		<tr>			
			<td colspan="2" class="LignegrisC">&nbsp;&nbsp;{language name=fiche_adht_modif_passwd}&nbsp; <input type="password" name="pass_adht1" id="pass_adht1" title="{language name=fiche_adht_newpasswd_title}" value="{$data_adherent.pass_adht1}" size="16"  maxlength="12" tabindex="20" {$disabled.pass_adht1} />&nbsp;&nbsp;{language name=fiche_adht_confirm}&nbsp; <input type="password" name="pass_adht2" id="pass_adht2" title="{language name=fiche_adht_passwd_confirm_title}" value="{$data_adherent.pass_adht2}" size="16"  maxlength="12" tabindex="21" {$disabled.pass_adht2} />{if $erreur_saisie.mdp}<span class="erreur-Jaunerouge">{$erreur_saisie.mdp}</span>{/if}</td>
		</tr>
		{/if}
{/if}{*  Fin Affichage si Création ou modification *}
		<tr>		
			<td>&nbsp;</td>
		</tr>
		<tr>		
			<td class="TexterougeR">&nbsp;&nbsp;&nbsp;{language name=tpl_texte_oblig}</td>
		</tr>
{*  Photo *}
	{if $required.creation_adht !== 1}
		<tr>
			<td class="LignegrisC_Center" colspan="2">
		 {if $photo_adht!=="[ Pas de photo ]"}{$photo_adht}<br />
		<input type="submit" name="del_photo" value="{language name=fiche_adht_del_photo}" onclick="return confirm('{language name=fiche_adht_confirm_del_photo}')"  title="{language name=fiche_adht_del_photo_title}" class="submit_del" tabindex="22"/>
		{else} {language name=fiche_adht_upload_photo}<br /> {if $erreur_saisie.photo} <span class="erreur-Jaunerouge">{$erreur_saisie.photo}</span><br />{/if}
		<input type="file" name="photo" title="{language name=fiche_adht_add_photo_title}" />
		{/if}
			</td>
        </tr>
	{/if}	
{*  Fin Photo *}		
		<tr>
			<th colspan="2">
			<input type="submit" class="submit_ok" name="Valider" value="{language name=tpl_valid_button}" title="{language name=tpl_valid_button_title}"/>
			<input type="hidden" name="valid" value="valid"/>
			<input type="hidden" name="id_adht" value="{$id_adht}"/>		
			{if $required.creation_adht == 1}<a href="../adherent/liste_adht_admin.php"><span class="submit_nul" title="{language name=tpl_cancel_button_title}">{language name=tpl_cancel_button}</span></a>{else}
			<a href="../adherent/gerer_fiche_adht.php?id_adht={$id_adht}"><span class="submit_nul" title="{language name=tpl_cancel_button_title}">{language name=tpl_cancel_button}</span></a>{/if}			
			</th>
		</tr>
     </table></form>
{* Fin Form .. *}		 
	 

		
	 
	</div> {* / défini le contenu .. *} 
