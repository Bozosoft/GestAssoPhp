{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2014 (c) JC Etiemble HTML5*}
{* Affichage du CONTENU avec AIDE Remplir cotisation adhérent*}
{*Auteur original : Jean-Claude Etiemble - Licence Creative Commons Paternité - Partage à l'Identique 2.0 France (CC BY-SA 2.0) France*}
	<header class="header_titre_aide"><a href='#' style="cursor:pointer;cursor:hand" onclick="javascript :window.open('../aide/a__remplir_cotisation.php','popup','height=450,toolbar=no,location=no,directories=no,status=yes,width=660,resizable=no,scrollbars=yes,top=10,left=10')" title="{language name=title_aide}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20"/>{language name=aide}</a></header> 

    <header class="header_titre">&nbsp;{language name=titre_admin_fiche_cotis_adht} {$affiche_message}</header>
	<div class="ligne_coul"></div> 	
	<div id="contenu"> {*défini le contenu .. *}
 	<br />
		
{if $erreur_saisie|@count != 0} 
		<div id="erreur-box"> {language name=tpl_texte_err_saisie}</div>	
{else}	
		<div>&nbsp;</div>
{/if}


{if $alert_saisie|@count != 0}
		<div id="erreur-box">
		{foreach from=$num_id_cotis item=item_num_id_cotis key=ordre} {*si il y a au moins 2 cotisations existantes*}
		{if $alert_saisie.id_adhtasso > 1}{language name=message_cotis_adht_alert_exist1}&nbsp;<a href="../adherent/remplir_cotisations_adht.php?id_cotis={$item_num_id_cotis.id_cotis}" target="_blank" title="{language name=message_cotis_adht_autre_fen}">{$item_num_id_cotis.id_cotis}</a>&nbsp;{language name=message_cotis_adht_alert_exist2}<br />
		{else} 
		{if $alert_saisie.id_adhtasso == 1}{language name=message_cotis_adht_alert_exist1}&nbsp;<a href="../adherent/remplir_cotisations_adht.php?id_cotis={$item_num_id_cotis.id_cotis}" target="_blank" title="{language name=message_cotis_adht_autre_fen}">{$item_num_id_cotis.id_cotis}</a>&nbsp;{language name=message_cotis_adht_alert_exist01}<br />{/if}		
		{/if} {/foreach} 
		</div>
		
{/if}
{if $required.modification_cotisation == 1 && $supprime_fiche !=1 && $archive_fiche !=1} 
<div id="alert-box">{language name=fiche_cotis_adht_montant_cotis_alert}</div> {/if}



{* Form .. *}
	<form method="post" name="maform" action="remplir_cotisations_adht.php">

			<label class="label_fc" title="{language name=fiche_cotis_adht_date_enr_title}"> {language name=fiche_cotis_adht_date_enr}</label>	{*Date d'enregistrement*}	
			<input type="text" name="date_enregist_cotis" id="date_enregist_cotis" title="{language name=fiche_cotis_adht_date_enr_title}" value="{if $data_cotis_adh.date_enregist_cotis}{$data_cotis_adh.date_enregist_cotis} {else}{$date_dujour}{/if}" size="12" maxlength="12" tabindex="1" {$disabled.date_enregist_cotis} />{if $erreur_saisie.d_enregist}<span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.d_enregist}</span>{/if}
<br />
			<label class="label_fc_Oblig">  {$adherent_bene} </label>{* Utilisateur*}	
			{if $modif_fiche == 1} {*||$data_cotis_adh.id_adhtasso *}
			{html_options name=id_adht_cotis options=$listnoms selected=$data_cotis_adh.id_adhtasso tabindex="2" disabled="disabled"}
			{else}
            {html_options name=id_adhtasso options=$listnoms selected=$data_cotis_adh.id_adhtasso tabindex="2"} {if $erreur_saisie.id_adhtasso}<span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.id_adhtasso}</span>{/if}
			{/if}
<br /><br />			
   				
			<label class="label_fc_Oblig"> {language name=fiche_cotis_adht_montant}</label >{*Montant cotisation*}		
		{if $modif_fiche == 1}
			<input type="text" name="montant_cotis" id="montant_cotis" title="{language name=fiche_cotis_adht_montant_title}" value="{$data_cotis_adh.montant_cotis}" size="10"  maxlength="10" tabindex="3" {$disabled.montant_cotis} /> {if $erreur_saisie.montant != ""}<span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.montant}</span>{else}Euros{/if}
		{else}	
			{language name=fiche_cotis_adht_montant_cotis}
		{/if}
<br />
		
			<label class="label_fc_Oblig"> {language name=fiche_cotis_adht_type}</label >{* *}			
			{if $archive_fiche == "1" || $supprime_fiche =="1"}{html_options name=id_type_cotisation options=$listnomtypecotisation selected=$data_cotis_adh.id_type_cotisation tabindex="4" disabled="disabled"}
			{else}
			{html_options name=id_type_cotisation options=$listnomtypecotisation selected=$data_cotis_adh.id_type_cotisation tabindex="4"}{if $erreur_saisie.type_cotisation}<span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.type_cotisation}</span>{/if}
			{/if}
<br /><br />			

			<label class="label_fc_Oblig" title="{language name=tpl_texte_date_title}"> {language name=fiche_cotis_adht_date_deb}</label >{*Date début cotisation*}			
			<input type="text" name="date_debut_cotis" id="date_debut_cotis" title="{language name=tpl_texte_date_title}" value="{if $data_cotis_adh.date_debut_cotis}{$data_cotis_adh.date_debut_cotis}{else}{$date_dujour}{/if}" size="12" maxlength="12" tabindex="5" {$disabled.date_debut_cotis} />{if $erreur_saisie.d_debut_cotis}<span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.d_debut_cotis}</span>{/if}{if $alert_saisie.d_debut_cotis && $archive_fiche != 1 && $supprime_fiche !=1}<br /><span class="erreur-Jaunerouge">&nbsp;{$alert_saisie.d_debut_cotis}</span>{/if}
<br />
			
			<label class="label_fc_Oblig" title="{language name=tpl_texte_date_title}"> {language name=fiche_cotis_adht_date_fin}</label >{*Date fin cotisation*}			
			<input type="text" name="date_fin_cotis" id="date_fin_cotis" title="{language name=tpl_texte_date_title}" value="{if $data_cotis_adh.date_fin_cotis}{$data_cotis_adh.date_fin_cotis}{else}{$date_3112}{/if}" size="12" maxlength="12" tabindex="6" {$disabled.date_fin_cotis} />{if $alert_saisie.d_fin_cotis_alert}<span class="erreur-Jaunerouge">&nbsp;{language name=message_cotis_adht_alert_archiv}</span>{/if} {if $erreur_saisie.d_fin_cotis}<span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.d_fin_cotis}</span>{/if}
<br /><br />
<!-- Ajout Zone PAIEMENT Gestion Cotisations -->
			<label class="label_fc" title="{language name=fiche_cotis_adht_mpaie}"> {language name=fiche_cotis_adht_mpaie}</label>{*PAIEMENT*}
			{if $archive_fiche == "1" || $supprime_fiche =="1"}{html_options name="paiement_cotis" options=$list_paiement_cotis selected=$data_cotis_adh.paiement_cotis tabindex="8" disabled="disabled"}
			{else}
			{html_options name="paiement_cotis" options=$list_paiement_cotis selected=$data_cotis_adh.paiement_cotis tabindex="8"}
			{/if}	
<br /><br />				
<!-- / Ajout Zone PAIEMENT Gestion Cotisations -->
			<label class="label_fc" title="{language name=fiche_cotis_adht_comm_title}"> {language name=fiche_cotis_adht_comm}</label>{*Commentaire*}			
			<input type="text" name="info_cotis" id="info_cotis" title="{language name=fiche_cotis_adht_comm_title}" value="{$data_cotis_adh.info_cotis}" size="72"  maxlength="80" tabindex="7" placeholder="   {language name=fiche_cotis_adht_comm_placeholder}" {$disabled.info_cotis} />
<br />
		{if $supprime_fiche == "1" || $archive_fiche == 1}	
			<label class="label_fc_Oblig" title="{language name=fiche_cotis_adht_raison_title} 30 caract&egrave;res maxi" > {language name=fiche_cotis_adht_raison}</label>{* *}			
			<input type="text" name="info_archiv_cotis" id="info_archiv_cotis" title="{language name=fiche_cotis_adht_raison_title} 30 caract&egrave;res maxi" value="{$data_cotis_adh.info_archiv_cotis}" size="40"  maxlength="30" tabindex="8" placeholder="{language name=fiche_cotis_adht_raison_placeholder}" {$disabled.info_archiv_cotis} />{if $erreur_saisie.info_archiv_cotis}<span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.info_archiv_cotis}</span>{/if}
		{else}
			<div class="centre-txt"><br /></div>
		{/if}

	

	
		<p class="TexterougeR">&nbsp;&nbsp;&nbsp;{language name=tpl_texte_oblig}</p>
		<div class="centre-txt"><br />
		{if $archive_fiche == "1"}
		{* pour afficher uniquement le bouton retour *}
			<a href="../adherent/liste_cotisations_adht.php?filtre_fiche=1&amp;id_adht={$data_cotis_adh.id_adhtasso}"><span class="submit_nul" title="{language name=tpl_retour_button_title}">{language name=tpl_retour_button_title}</span></a>			
		{else}
			{if $supprime_fiche == "1"}
			{*$erreur_saisie ['d_fin_cotis_alert'] = 1  ne pas afficher le bouton Archiver la fiche	*}
			{if $erreur_saisie.d_fin_cotis_alert != 1}	
			<input type="submit" name="del_fiche" value="{language name=fiche_cotis_adht_archiv_button_title}" onclick="return confirm('{language name=fiche_cotis_adht_js_confirm_archiv} {$data_cotis_adh.id_cotis}  ? ')" title="{language name=liste_cotis_adht_archiv_icon_title}" class="submit_del" />
			<input type="hidden" name="supp_valid" value="supp_valid"/>	
			<input type="hidden" name="id_cotis" value="{$data_cotis_adh.id_cotis}"/>
			<input type="hidden" name="supp_fiche_cotis" value="{$supprime_fiche}"/>
			{/if}			
			<a href="../adherent/liste_cotisations_adht.php?id_adht={$data_cotis_adh.id_adhtasso}"><span class="submit_nul" title="{language name=tpl_cancel_button_title}">{language name=tpl_cancel_button}</span></a>			
		{else}

			<input type="submit" class="submit_ok" name="Valider" value="{language name=tpl_valid_button}" title="{language name=tpl_valid_button_title}"/>
			<input type="hidden" name="valid" value="valid"/>
			<input type="hidden" name="id_adht_cotis" value="{$data_cotis_adh.id_adhtasso}"/>
			<input type="hidden" name="id_cotis" value="{$data_cotis_adh.id_cotis}"/>
			<a href="../adherent/liste_cotisations_adht.php?filtre_fiche=1&amp;id_adht={$data_cotis_adh.id_adhtasso}"><span class="submit_nul" title="{language name=tpl_cancel_button_title}">{language name=tpl_cancel_button}</span></a>
			
			{if $required.modification_cotisation == "1"}<a href="consulter_cotisations_adht.php?id_cotis={$data_cotis_adh.id_cotis}"><span class="submit_ok" title="{language name=fiche_cotis_adht_visu_button_title}">&nbsp;{language name=fiche_cotis_adht_visu_button}&nbsp;</span></a> <br />{/if}
			{/if}
			
		{/if}
			</div>
	</form>
{* Fin Form .. *}		 
	 

		
	 
	</div> {* Fin défini le contenu .. *} 
