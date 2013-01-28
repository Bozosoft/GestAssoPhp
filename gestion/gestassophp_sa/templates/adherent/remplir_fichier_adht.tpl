{* Projet : gestassophp_sa [GestAssoPhp+Pg]*}
{* Affichage du CONTENU avec AIDE remplir fichier adhérent*}
	<div id="titre_aide"><a href='#' style="cursor:pointer;cursor:hand" onclick="javascript :window.open('../aide/a_adht_remplir_fichier_adht.php','popup','height=500,toolbar=no,location=no,directories=no,status=yes,width=700,resizable=no,scrollbars=yes,top=10,left=10')" title="{language name=title_aide}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20"/>{language name=aide}</a></div> 

    <div id="titre">&nbsp;{language name=titre_admin_file_adht}{$affiche_message}</div>
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
    	<table width="100%" summary="upload fichiers">
		

		{if $id_file_adht ==''} {* si on upload un nouveau fichier*}
		<tr> 
			<th class="LignegrisC" colspan="2">{language name=file_adht_upload}</th>
        </tr>
		<tr> 
			<td colspan="2">&nbsp;</td>
        </tr>		
		<tr> 
			<th class="LignegrisC_Oblig" width="30%" title="{language name=file_adht_titlemax}">{language name=file_adht_max}</th>
			<td width="70%"><input type="hidden" name="MAX_FILE_SIZE" value="300000" />
			<input type="file" size="30" name="monfichier" title="{language name=file_adht_titlemax}"/></td>
		</tr>	
		{else} {* si on modifie la designation fichier*}
		<tr> 
			<th class="LignegrisC" colspan="2">{if $archive_fiche != "1"}{language name=file_adht_modif}{/if}&nbsp;</th>
			<td>&nbsp;</td>
        </tr>
		<tr> 
			<td colspan="2">&nbsp;</td>
        </tr>
		<tr>
			<th class="LignegrisC"> {language name=file_adht_datei}</th>		
			<td><input type="text" name="date_file_adht" id="date_file_adht" title="{language name=tpl_texte_date_title}" value="{$date_file_adht}" size="12" maxlength="12" tabindex="16" disabled="disabled" /></td>
		</tr>
		<tr>		
			<th class="LignegrisC" width="30%"> {language name=file_adht_name}</th>
			<td><input type="text" name="mon_fichier" id="mon_fichier" title="{language name=file_adht_name_title}" value="{$nom_fichier}" size="70"  maxlength="50" tabindex="2" disabled="disabled" /></td>
		</tr> 

			
		{/if} {* Fin si on upload ou  modifie *}			
		
		<tr>
			<th class="LignegrisC"> {language name=file_adht_descript}</th>		
			<td><input type="text" name="descript_fichier" id="descript_fichier" title="{language name=file_adht_descript_title}" value="{$descript_fichier}" size="70"  maxlength="50" tabindex="2" {*$disabled.nom_adht*} /> {if $erreur_saisie.nom != ""} <span class="erreur-Jaunerouge">{$erreur_saisie.nom}</span>{/if}</td>
		</tr>
		<tr> 
			<th class="LignegrisC_Oblig">  {$adherent_bene} {language name=file_adht_to}</th>
            <td>
			{if $archive_fiche == "1"}{html_options name=id_adht_modif options=$listnoms selected=$id_adht_file tabindex="4" disabled="disabled"}
			{else}
			{html_options name=id_adht_modif options=$listnoms selected=$id_adht_file tabindex="4"}
			{/if}
			</td>		
        </tr>
{if $id_file_adht !=''}{* Nom du déposant du fichier*}		
		<tr>
			<th class="LignegrisC"> {language name=file_adht_by}</th>		
			<td>&nbsp;{$nom_qui_file_adht}</td>
		</tr>
{/if}
		<tr>		
			<td class="TexterougeR">&nbsp;&nbsp;&nbsp;{language name=tpl_texte_oblig}</td>
		</tr>
		<tr> 
			<td colspan="2">&nbsp;</td>
        </tr>		
		<tr>
			<td align="center" colspan="2">
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
			</td>
		</tr>
     </table></form>
	 
	</div> {* / défini le contenu .. *} 