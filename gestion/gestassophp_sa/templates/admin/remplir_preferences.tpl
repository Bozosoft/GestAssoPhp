{* Projet : gestassophp_sa [GestAssoPhp+Pg]*}
{* Affichage du CONTENU avec AIDE remplir Préférences et Antennes(sections)  *}
{*Auteur original : Jean-Claude Etiemble - Licence Creative Commons Paternité - Partage à l'Identique 2.0 France (CC BY-SA 2.0) France*}
	<div id="titre_aide"><a href='#' style="cursor:pointer;cursor:hand" onclick="javascript :window.open('../aide/a_admin_remplir_preferences.php','popup','height=450,toolbar=no,location=no,directories=no,status=yes,width=700,resizable=no,scrollbars=yes,top=10,left=10')"  title="{language name=title_aide}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20"/>{language name=aide}</a></div> 

    <div id="titre">&nbsp;{language name=titre_admin_preferences}</div>
	<div class="ligne_coul"></div> 	
	<div id="contenu"> {*défini le contenu .. *}

	<span class="TextenoirGras">&nbsp;</span>
	
	<ul id="tabnav">
	{if $tab eq 1} 
{* -------------------------------------- TAB 1 -------------------------- *}		
	<li class="active">{language name=titre_admin_preftab1}</li>
	<li><a href="remplir_preferences.php?tab=2">{language name=titre_admin_preftab2}</a></li>
	<li><a href="remplir_preferences.php?tab=3">{language name=titre_admin_preftab3}</a></li>	
	</ul>	
	<div id="tab1_table">
		<br />
{if $erreur_saisie.champ|@count != 0}
		<div id="erreur-box">{language name=tpl_texte_err_saisie} ...<span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.champ}</span>
		</div>	
{/if}
<form action="remplir_preferences.php" method="post" name="ma_form_tab2">			
	<table width="98%" cellspacing="0" cellpadding="1" summary="table2">
		<tr>
			<td width="26%">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<th class="LignegrisRight">{language name=pref_messagetitre}&nbsp;&nbsp; </th>		
			<td><input type="text" name="messagetitre" id="messagetitre" title="{language name=pref_messagetitre_title}" value="{$preference_asso.messagetitre}" size="50"  maxlength="75" tabindex="1" /></td>
		</tr>		
		<tr>
			<th class="LignegrisRight">{language name=pref_nom_asso_gestassophp}&nbsp;&nbsp; </th>		
			<td><input type="text" name="nom_asso_gestassophp" id="nom_asso_gestassophp" title="{language name=pref_nom_asso_gestassophp_title}" value="{$preference_asso.nom_asso_gestassophp}" size="50"  maxlength="75" tabindex="2" /></td>
		</tr>	
		<tr>
			<th class="LignegrisRight">{language name=pref_date_debannee_asso}&nbsp;&nbsp; </th>		
			<td><input type="text" name="date_debannee_asso" id="date_debannee_asso" title="{language name=pref_date_debannee_asso_title}" value="{$preference_asso.date_debannee_asso}" size="10"  maxlength="5" tabindex="3" /></td>
		</tr>
		<tr>
			<th class="LignegrisRight">{language name=pref_nb_lignes_page}&nbsp;&nbsp; </th>		
			<td><input type="text" name="nb_lignes_page" id="nb_lignes_page" title="{language name=pref_nb_lignes_page_title}" value="{$preference_asso.nb_lignes_page}" size="5"  maxlength="3" tabindex="4" /> 10, 20 ou 50</td>
		</tr>
		<tr>
			<th class="LignegrisRight">{language name=pref_email_adresse}&nbsp;&nbsp; </th>		
			<td><input type="text" name="email_adresse" id="email_adresse" title="{language name=pref_email_adresse_title}" value="{$preference_asso.email_adresse}" size="50"  maxlength="75" tabindex="5" />{if $erreur_saisie.email} <span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.email}</span> {/if}</td>
		</tr>	
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>		
		<tr>
			<td colspan="2">&nbsp;&nbsp;&nbsp;{language name=pref_adherent_bene_info}</td>
		</tr>
		<tr>
			<th class="LignegrisRight">{language name=pref_adherent_bene}&nbsp;&nbsp; </th>		
			<td><input type="text" name="adherent_bene" id="adherent_bene" title="{language name=pref_adherent_bene_title}" value="{$preference_asso.adherent_bene}" size="30"  maxlength="40" tabindex="5" /></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>			
		<tr>
			<td colspan="2">&nbsp;&nbsp;&nbsp;{language name=pref_lang_fiche_adht_ant_info}</td>
		</tr>		
		<tr>
			<th class="LignegrisRight">{language name=pref_lang_fiche_adht_ant}&nbsp;&nbsp; </th>		
			<td><input type="text" name="_lang_fiche_adht_ant" id="_lang_fiche_adht_ant" title="{language name=pref_lang_fiche_adht_ant_title}" value="{$preference_asso._lang_fiche_adht_ant}" size="30"  maxlength="40" tabindex="5" /></td>
		</tr>
<!-- +  -->		
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>	
		<tr>
			<td colspan="2">&nbsp;&nbsp;&nbsp;{language name=pref_lang_jma_fin_cotis_info}</td>
		</tr>		
		<tr>
			<th class="LignegrisRight">{language name=fiche_cotis_adht_date_fin}&nbsp;&nbsp; </th>		
			<td><input type="text" name="jma_fin_cotis" id="jm_fin_cotis" title="{language name=pref_lang_jma_fin_cotis_info}" value="{$preference_asso.jma_fin_cotis}" size="12" maxlength="12" tabindex="6" />{if $erreur_saisie.date} <span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.date}</span> {/if}</td>
		</tr>
		
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>		
		<tr>
			<td>&nbsp;</td>
		</tr>		
		<tr>
			<td align="center" colspan="2">
			<input type="submit" class="submit_ok" name="Valider" value="{language name=tpl_valid_button}" title="{language name=tpl_valid_button_title}"/>
			<input type="hidden" name="valid_tab1" value="validation_tab1"/>
			<a href="../admin/tableau_bord.php"><span class="submit_nul" title="{language name=tpl_cancel_button_title}	">{language name=tpl_cancel_button}</span></a>
			</td>
		</tr>		
	</table>
</form>
	
	</div>
	
	{elseif $tab eq 2}
{* -------------------------------------- TAB 2 -------------------------- *}		
     <li><a href="remplir_preferences.php">{language name=titre_admin_preftab1}</a></li>
     <li class="active">{language name=titre_admin_preftab2}</li>
	<li><a href="remplir_preferences.php?tab=3">{language name=titre_admin_preftab3}</a></li>	 
	 </ul>
	 <div id="tab2_table">
		<br />
	<div id="entour_select">		
<form action="remplir_preferences.php" method="post" name="ma_form_tab2">	
    	<table width="100%" summary="activités">
		<tr> 
            <td>&nbsp;</td>
			<td>&nbsp;</td>				
        </tr>		
		<tr>
			<th class="LigneRight" width="35%">{language name=pref_new_designation}&nbsp;&nbsp; </th>		
			<td><input type="text" name="new_nom_type_antenne" id="new_nom_type_antenne" title="{language name=pref_new_designation_title}" value="{$new_antenne.nom_type_antenne}" size="40"  maxlength="30" tabindex="1" />{if $erreur_saisie.nom_antenne != ""} <span class="erreur-Jaunerouge">{$erreur_saisie.nom_antenne}</span>{/if}</td>
		</tr>	
		<tr> 
            <td>&nbsp;</td>
			<td>&nbsp;</td>				
        </tr>		
		<tr>
			<td align="center" colspan="2">
			<input type="submit" class="submit_ok" name="Valider" value="{language name=tpl_valid_button}" title="{language name=tpl_valid_button_title}"/>
			<input type="hidden" name="valid_tab2" value="validation_tab2"/>
			<input type="hidden" name="id_ant" value="{$new_antenne.id_type_antenne}"/>			
			<input type="hidden" name="tab" value="2"/>	
			</td>
		</tr>
     </table>
</form>
	</div>
<br />
	 
	<table width="45%" align="center" summary="table2">
		<tr>
			<td width="5%">&nbsp;</td>
			<td width="35%">&nbsp;</td>
			<td width="5%">&nbsp;</td>
		</tr>
		<tr>
			<th class="LignegrisC">
					<a href="remplir_preferences.php?tab=2&amp;tri=0" title="{language name=tpl_title_clictri}">{language name=tpl_col_num}</a>
					{if $smarty.session.tri eq 0}
					{if $smarty.session.tri_sens eq 0}
					<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_up}"/>
					{else}
					<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_down}"/>
					{/if}
					{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt=""/>
					{/if}
			</th>	

			<th class="LignegrisC">
					<a href="remplir_preferences.php?tab=2&amp;tri=1" title="{language name=tpl_title_clictri}">{language name=pref_col_designation_activ}</a>
					{if $smarty.session.tri eq 1}
					{if $smarty.session.tri_sens eq 0}
					<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_up}"/>
					{else}
					<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_down}"/>
					{/if}
					{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt=""/>
					{/if}
			</th>
			<th class="LignegrisC">{language name=tpl_col_actions}
			</th>
		</tr>
{foreach from=$antenne item=item_antenne key=ordre}
			<tr class="Lignegris{$item_antenne.coul}">
				<td>{$item_antenne.id_type_antenne}</td>						
				<td>{$item_antenne.nom_type_antenne}</td>
				
				<td align="center">
				<a href="../admin/remplir_preferences.php?tab=2&amp;modifant=1&amp;id_ant={$item_antenne.id_type_antenne}"><img src="../images/icones16/i_modif.png" width="16" height="16" alt="" title="{language name=pref_col_designation_modif_icon_title}"/></a></td>		
			</tr>
{foreachelse}
			<tr>
				<td colspan="3">{language name=tpl_liste_vide}</td>
			</tr>
{/foreach}
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>		
		<tr>
			<td align="center" colspan="3">
			<a href="../admin/remplir_preferences.php?tab=1"><span class="submit_nul" title="{language name=tpl_retour_button_title}"> {language name=tpl_retour_button}</span></a>
			</td>
		</tr>		
	</table>
	
	</div>	

{else}
{* -------------------------------------- TAB 3 -------------------------- *}		
	<li><a href="remplir_preferences.php?tab=1">{language name=titre_admin_preftab1}</a></li>
	<li><a href="remplir_preferences.php?tab=2">{language name=titre_admin_preftab2}</a></li> 
     <li class="active">{language name=titre_admin_preftab3}</li>
	 </ul>		
	<div id="tab3_table">
		<br />
	<div id="entour_select">			
<form action="remplir_preferences.php" method="post" name="ma_form_tab3">			
    <table width="100%" summary="type cotisation">
		<tr> 
            <td>&nbsp;</td>
			<td>&nbsp;</td>				
        </tr>		
		<tr>
			<th class="LigneRight" width="35%">{language name=pref_new_designation}&nbsp;&nbsp; </th>		
			<td><input type="text" name="new_nom_type_cotisation" id="new_nom_type_cotisation" title="{language name=pref_new_designation_title}" value="{$new_type_cotisation.nom_type_cotisation}" size="60"  maxlength="60" tabindex="1" />{if $erreur_saisie.nom_type_cotisation != ""} <span class="erreur-Jaunerouge">{$erreur_saisie.nom_type_cotisation}</span>{/if}</td>
		</tr>
<!-- ajout montant cotisation dans préférences  VOIR SI = 0-->		
		<tr>
			<th class="LigneRight" width="35%">{language name=pref_new_mont_cotisation}&nbsp;&nbsp; </th>		
			<td><input type="text" name="new_montant_cotisation" id="new_montant_cotisation" title="{language name=pref_new_mont_cotisation_title}" value="{$new_type_cotisation.montant_cotisation}" size="8"  maxlength="10" tabindex="2" />{if $erreur_saisie.montant_cotisation != ""} <span class="erreur-Jaunerouge">{$erreur_saisie.montant_cotisation}</span>{/if}</td>
		</tr>	
		
		<tr> 
            <td>&nbsp;</td>
			<td>&nbsp;</td>				
        </tr>		
		<tr>
			<td align="center" colspan="2">
			<input type="submit" class="submit_ok" name="Valider" value="{language name=tpl_valid_button}" title="{language name=tpl_valid_button_title}"/>
			<input type="hidden" name="valid_tab3" value="validation_tab3"/> 
			<input type="hidden" name="id_typecotis" value="{$new_type_cotisation.id_type_cotisation}"/>			
			<input type="hidden" name="tab" value="3"/>	
			</td>
		</tr>
     </table>
</form>
	</div>		
<br />
	<table width="60%" align="center" summary="table3">
		<tr>
			<td width="5%">&nbsp;</td>
			<td width="35%">&nbsp;</td>
			<td width="15%">&nbsp;</td>
			<td width="5%">&nbsp;</td>
		</tr>
		<tr>
			<th class="LignegrisC">
					<a href="remplir_preferences.php?tab=3&amp;tri=0" title="{language name=tpl_title_clictri}">{language name=tpl_col_num}</a>
					{if $smarty.session.tri eq 0}
					{if $smarty.session.tri_sens eq 0}
					<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_up}"/>
					{else}
					<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_down}"/>
					{/if}
					{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt=""/>
					{/if}
			</th>	

			<th class="LignegrisC">
					<a href="remplir_preferences.php?tab=3&amp;tri=1" title="{language name=tpl_title_clictri}">{language name=pref_col_designation_cotis}</a>
					{if $smarty.session.tri eq 1}
					{if $smarty.session.tri_sens eq 0}
					<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_up}"/>
					{else}
					<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_down}"/>
					{/if}
					{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt=""/>
					{/if}
			</th>
			<th class="LignegrisC">{language name=pref_col_mont_cotisation}
			</th>
			<th class="LignegrisC">{language name=tpl_col_actions}
			</th>
		</tr>

{foreach from=$type_cotisation item=item_cotisation key=ordre}
		<tr class="Lignegris{$item_cotisation.coul}">
			<td>{$item_cotisation.id_type_cotisation}</td>						
			<td>{$item_cotisation.nom_type_cotisation}</td>
			<td>{$item_cotisation.montant_cotisation}</td>
			<td align="center">
				<a href="../admin/remplir_preferences.php?tab=3&amp;modifc=1&amp;id_typecotis={$item_cotisation.id_type_cotisation}"><img src="../images/icones16/i_modif.png" width="16" height="16" alt="" title="{language name=pref_col_designation_modif_icon_title}"/></a></td>	
		</tr>
{foreachelse}
		<tr>
			<td colspan="4">{language name=tpl_liste_vide}</td>
		</tr>
{/foreach}
		<tr>
			<td align="center" colspan="4">	
			<a href="../admin/remplir_preferences.php?tab=1"><span class="submit_nul" title="{language name=tpl_retour_button_title}"> {language name=tpl_retour_button}</span></a>
			</td>
		</tr>		
	</table>
	
	</div>	


{/if}
 
	</div> {* / défini le contenu .. *} 