{* Projet : gestassophp_sa [GestAssoPhp+Pg]*}
{* Affichage de la fiche de l'adhérent gestion *}
{* Affichage du CONTENU avec AIDE *}
	<div id="titre_aide"><a href='#' style="cursor:pointer;cursor:hand" onclick="javascript :window.open('../aide/a_adht_gerer_fiche_adht.php','popup','height=380,toolbar=no,location=no,directories=no,status=yes,width=660,resizable=no,scrollbars=yes,top=10,left=10')" title="{language name=title_aide}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20"/>{language name=aide}</a></div> 

    <div id="titre">&nbsp;{language name=titre_visu_fiche_adht}</div>
	<div class="ligne_coul"></div> 	
	<div id="contenu"> {*défini le contenu .. *}
{* -- RECAPITULATF -- *}	
    <table width="100%" summary="Bienvenue">
		<tr> 
			<th class="LignegrisC" colspan ="2">{language name=visu_fiche_adht_recap}  {$affiche_message}</th> 
		</tr>
		<tr>
			<td class="Lignegris_pad1" nowrap="nowrap" width="50%">{language name=visu_fiche_adht_enr}&nbsp;{$id_adht}&nbsp;{language name=visu_fiche_adht_enrdu}:&nbsp;{$data_adherent.datecreationfiche_adht}</td>
			<td class="Lignegris_pad1" nowrap="nowrap">{language name=visu_fiche_adht_lastmod}:&nbsp;{if $data_adherent.datemodiffiche_adht <> "00/00/0000"}{$data_adherent.datemodiffiche_adht}<br />{/if}</td>	
		</tr>
		<tr>
			<td class="Lignegris_pad1" nowrap="nowrap">{if $data_adherent.promotion_adht} {language name=fiche_adht_promotion} : {$data_adherent.promotion_adht}{/if}</td>	
			<td class="Lignegris_pad1" nowrap="nowrap">{language name=fiche_adht_fiche_enr}:&nbsp;{$pnom_creation_fiche_adht}</td>
		</tr>	
		<!-- Déplacer plus bas Affiche Cotisation dans table cotisation-->
		<!-- tr> {* Affiche Cotisation + + qui a enrregistré la fiche ...*}
			<td class="Lignegris_pad1" nowrap="nowrap">{*$affiche_cotisation*} 
			{if $data_adherent.date_echeance_cotis == '0000-00-00' || $data_adherent.date_echeance_cotis ==''}<span class="TexterougeGras">{language name=message_fiche_cot_nonok}</span>&nbsp;{if $priorite_adht >=7}<a href="../adherent/remplir_cotisations_adht.php?id_adht_cotis={$id_adht}" title="{language name=liste_cotis_adht_liste_title}"><span class="submit_ok" title="{language name=liste_cotis_adht_addcotis_button_title}">&nbsp;{language name=liste_cotis_adht_addcotis_button}&nbsp;</span></a>{/if}
			{else}
			<span class="TextenoirGras">&nbsp;&nbsp;&nbsp;{language name=liste_cotis_adht_cotiss} : 
			{if $priorite_adht > 5}{*Uniquement si 7ou9*}<a href="../adherent/liste_cotisations_adht.php?id_adht={$id_adht}&amp;filtre_fiche=1" title="{language name=liste_cotis_adht_liste_title}">{$data_adherent.prenom_adht} {$data_adherent.nom_adht}</a>{/if}</span>
			{/if}</td>		
			<td>&nbsp;</td>
		</tr -->	
	</table>
	<table width="50%" summary="cotisation"> 
		<!-- ICI déplacé Affiche Cotisation dans table cotisation-->	
	{* si Fiche supprimée ne pas afficher la suite *}
	{if $data_adherent.soc_adht !='999'}	
		<tr> 
			<td class="Lignegris_pad1" nowrap="nowrap" colspan="3">{*$affiche_cotisation *} 
			{*$data_adherent.date_echeance_cotis soit une date '2012-09-30'  soit '0000-00-00' mais ne sera jamais ''*}
			{if $data_adherent.date_echeance_cotis == '0000-00-00'}<span class="TexterougeGras">{language name=message_fiche_cot_nonok}</span>&nbsp;{if $priorite_adht >=7}<a href="../adherent/remplir_cotisations_adht.php?id_adht_cotis={$id_adht}" title="{language name=liste_cotis_adht_liste_title}"><span class="submit_ok" title="{language name=liste_cotis_adht_addcotis_button_title}">&nbsp;{language name=liste_cotis_adht_addcotis_button}&nbsp;</span></a>{/if}
			{else}
			<span class="TextenoirGras">&nbsp;&nbsp;&nbsp;{language name=liste_cotis_adht_cotiss} : 
			{if $priorite_adht > 5}{*Uniquement si 7ou9*}<a href="../adherent/liste_cotisations_adht.php?id_adht={$id_adht}&amp;filtre_fiche=1" title="{language name=liste_cotis_adht_liste_title}">{$data_adherent.prenom_adht} {$data_adherent.nom_adht}</a>{/if}</span>
			{/if}</td>		
		</tr>
		<!--Fin ICI Affiche déplacé + modification affichage -->
			{* si pas date cotis (soit '0000-00-00') ne pas afficher la suite *}
			{if $data_adherent.date_echeance_cotis !='0000-00-00'}
		<tr>
			<th class="LignegrisC" width="28%">{language name=fiche_cotis_adht_type}</th>
			<th class="LignegrisC" width="11%">{language name=liste_cotis_adht_col_d_deb}</th>
			<th class="LignegrisC" width="11%">{language name=liste_cotis_adht_col_d_fin}</th>
		</tr>
	 		{foreach from=$cotis_adht item=item_cotis_adht key=ordre}
		<tr class="Lignegris{$item_cotis_adht.coul}">
			<td>{$item_cotis_adht.nom_type_cotisation}</td>
			<td>{$item_cotis_adht.date_debut_cotis}</td>
			<td>{$item_cotis_adht.date_fin_cotis}</td>
		</tr>
			{/foreach}
			{/if}
			{* Fin si pas de date cotis ne pas afficher *}
	{else} {* si Fiche supprimée afficher ligne vide *}
		<tr> 
		<td >&nbsp;</td>
		</tr> 			
	{/if} {* Fin si Fiche supprimée *}	
	</table>	
	<br />
{* -- FIN RECAPITULATF -- *}	
{* -- INFO PERSONNELLES -- *}	
	<table width="100%" summary="Informations personnelles">
		<tr> 
			<th class="LignegrisC" colspan ="4">{language name=gestion_fiche_adht}&nbsp;&nbsp; 
			{if $data_adherent.soc_adht !=999}<a href="remplir_infogene_adht.php?id_adht={$id_adht}"><span class="submit_ok" title=" {language name=visu_fiche_adht_modif_button_title}">&nbsp; {language name=visu_fiche_adht_modif_button}&nbsp;</span>
			{else}
			{if $priorite_adht ==9}<a href="gerer_fiche_adht.php?reactiv_adht=1&amp;id_adht={$id_adht}"><span class="submit_del" title=" {language name=visu_fiche_adht_reactiv_button_title}">&nbsp; {language name=visu_fiche_adht_reactiv_button}&nbsp;</span>{/if}
			{/if}</a></th> 
		</tr>
	    <tr> 
		    <td class="Lignegris_pad1" width="60%" colspan="2">{$data_adherent.civilite_adht}<span class="TextenoirGras"> {$data_adherent.prenom_adht} {$data_adherent.nom_adht}</span><br />
					{$data_adherent.adresse_adht}<br />
					{$data_adherent.cp_adht}&nbsp;{$data_adherent.ville_adht}<br /></td>
		    <td  class="LignegrisC_Center" width="20%" rowspan="2">{$photo_adht}</td>
		    <td  class="LignegrisC_Center" width="20%" rowspan="2">{language name=fiche_adht_ant}&nbsp;:&nbsp;{$data_adherent.nom_type_antenne}
					<br /><br />{$data_adherent.tranche_age}&nbsp;<br />
					&nbsp;<br />{if $data_adherent.age}{language name=visu_fiche_adht_age}:&nbsp;{$data_adherent.age|string_format:"%d"}&nbsp;{language name=visu_fiche_adht_an}{/if}</td>
		</tr>
		<tr> 
		    <td class="Lignegris_pad1" width="30%">
			{if $data_adherent.telephonef_adht}{language name=tpl_col_adht_teleph}{/if}<br /> {* 25% -> 30*}
			{if $data_adherent.telephonep_adht} {language name=tpl_col_adht_portable}<br />{/if}
			{if $data_adherent.telecopie_adht} {language name=fiche_adht_fax}<br />{/if}
			{if $data_adherent.email_adht} {language name=fiche_adht_mail} 
				{if $priorite_adht > 4}  {* Ajout FONCTION MAIL*}
				<a href="remplir_message_adht.php?id_adht={$id_adht}"><img src="../images/icones16/i_mail.png" width="16" height="11" alt="" title="{language name=visu_fiche_adht_mail_title}"/></a> {$resultat_mail}
				{/if}
			{/if}<br />
			{if $data_adherent.siteweb_adht} {language name=fiche_adht_web}<br />{/if} 
			{if $data_adherent.datenaisance_adht <> ""}{language name=tpl_adht_datenais}<br />{/if}

			</td>
		    <td class="Lignegris_pad1" width="25%">{$data_adherent.telephonef_adht}<br /> {* 35% -> 25*}
			{if $data_adherent.telephonep_adht}{$data_adherent.telephonep_adht}<br />{/if}
			{if $data_adherent.telecopie_adht}{$data_adherent.telecopie_adht}<br />{/if}
			{if $data_adherent.email_adht}<a href="mailto:{$data_adherent.email_adht}">{$data_adherent.email_adht}</a> <br />{/if}
			{if $data_adherent.siteweb_adht}<a href="http://{$data_adherent.siteweb_adht}" target="_blank">http://{$data_adherent.siteweb_adht}</a><br />{/if}
			{if $data_adherent.datenaisance_adht <> ""}{$data_adherent.datenaisance_adht}<br />{/if}		
			</td>
		</tr>
	  
  
		<tr> {* Affiche Autorisation de consulter ...*}
			<td class="Lignegris_pad1" colspan="4">
		{if $data_adherent.visibl_adht=="Non"}	
			<span class="TexterougeGras">{$data_adherent.visibl_adht}</span>{language name=visu_fiche_adht_coord_no} {$adherent_bene}s {$nom_asso_gestassophp}<br/>
		{else}
          <span class="TextevertGras">{$data_adherent.visibl_adht}</span>{language name=visu_fiche_adht_coord_yes} {$adherent_bene}s {$nom_asso_gestassophp}<br/>		
		{/if}
			</td>			
		</tr>	

		<tr>
			<td class="LignegrisC" colspan="4">&nbsp;</td>
		</tr>		
		<tr> {* Ajout de la note ... disponib_adht*}		
			 <th class="Lignegris_pad1" width="10%">{language name=fiche_adht_compl}</th>

			<td class="Lignegris_pad1" colspan="3">
			{if $data_adherent.disponib_adht}{$data_adherent.disponib_adht}{/if}
			</td>				
		</tr>
		
		<tr>
			<td class="LignegrisC" colspan="4">&nbsp;</td>
		</tr>
		<tr>		
			<td align="center" colspan="4">
			{if $data_adherent.soc_adht =='999'}
			{* si soc_adht='999' pour afficher uniquement le bouton retour *}
			<a href="../adherent/liste_adht_admin.php?filtre_nom=&amp;filtre_membre=3&amp;affiche_nb_adht=20"><span class="submit_nul" title="{language name=tpl_retour_button_title}">{language name=tpl_retour_button}</span></a>
			{/if}
			</td>
		</tr>		
    </table>
{* -- FIN INFO PERSONNELLES -- *}	

{* Si l'adhérent est SUPPRIMEE soit soc_adht='999' NE PAS AFFICHER LES DONNEES SUIVANTES *}
{if $data_adherent.soc_adht !='999'}
	{* ----Feuille INFO_FICHIER_MISSIONS  ------- *}
	{if $info_fichiermission_adht == '1'}{include file='adherent/consulter_info_fichiermission_adht.tpl'}{/if}
{/if}
	
	</div> {* / défini le contenu .. *} 
