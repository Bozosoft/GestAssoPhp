{* Projet : gestassophp_sa [GestAssoPhp+Pg]*}
{* Affiche la fiche de l'adhérent Consukter fiche adhérent *}
{* Affichage du CONTENU avec AIDE *}
	<div id="titre_aide"><a href='#' style="cursor:pointer;cursor:hand" onclick="javascript :window.open('../aide/a_adht_consulter_fiche_adht.php','popup','height=250,toolbar=no,location=no,directories=no,status=yes,width=660,resizable=no,scrollbars=yes,top=10,left=10')" title="{language name=title_aide}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20"/>{language name=aide}</a></div> 

    <div id="titre">&nbsp;{language name=titre_consult_fiche_adht}</div>
	<div class="ligne_coul"></div> 	
	<div id="contenu"> {*défini le contenu .. *}
{* -- RECAPITULATF -- *}	
    	<table width="100%" summary="Bienvenue">
		<tr> 
			<th class="LignegrisC" colspan ="2">{language name=visu_fiche_adht_recap}</th> 
		</tr>
		<tr>
			<td class="Lignegris_pad1" nowrap="nowrap">{language name=visu_fiche_adht_enr}&nbsp;{$id_adht}&nbsp;{language name=visu_fiche_adht_enrdu}&nbsp;:&nbsp;{$data_adherent.datecreationfiche_adht}</td>
			<td class="Lignegris_pad1" nowrap="nowrap">{language name=visu_fiche_adht_lastmod}&nbsp;:&nbsp;{$data_adherent.datemodiffiche_adht}</td>
		</tr>		

     </table>
	<br />
{* -- FIN RECAPITULATF -- *}	
{* -- INFO PERSONNELLES -- *}	
	<table width="100%" summary="Informations personnelles">
		<tr> 
			<th class="LignegrisC" colspan ="4">{language name=gestion_fiche_adht}</th> 
		</tr>
		<tr> 
		    <td class="Lignegris_pad1" width="60%" colspan="2">{$data_adherent.civilite_adht}<span class="TextenoirGras"> {$data_adherent.prenom_adht} {$data_adherent.nom_adht}</span><br />
					{$data_adherent.adresse_adht}<br />
					{$data_adherent.cp_adht}&nbsp;{$data_adherent.ville_adht}<br /></td>
		    <td  class="LignegrisC_Center" width="20%" rowspan="2">{$photo_adht}</td>
		    <td  class="LignegrisC_Center" width="20%" rowspan="2">{language name=fiche_adht_ant}&nbsp;:&nbsp;{$data_adherent.nom_type_antenne}
					<br /><br />{$data_adherent.tranche_age}&nbsp;<br />
					&nbsp;<br />{if $data_adherent.age}{language name=visu_fiche_adht_age}:&nbsp;{$data_adherent.age|string_format:"%d"}&nbsp;ans{/if}</td>
		  </tr>
		  <tr> 
		    <td class="Lignegris_pad1"width="25%">{if $data_adherent.telephonef_adht}{language name=tpl_col_adht_teleph}{/if}<br /> 
			{if $data_adherent.telephonep_adht}{language name=tpl_col_adht_portable}<br />{/if}
			{if $data_adherent.telecopie_adht} {language name=fiche_adht_fax}<br />{/if}
			{if $data_adherent.email_adht} {language name=fiche_adht_mail}<br />{/if}
			{if $data_adherent.siteweb_adht} {language name=fiche_adht_web}<br />{/if} 
			{if $data_adherent.datenaisance_adht <> ''}{language name=tpl_adht_datenais}<br />{/if}
			</td>
		    <td class="Lignegris_pad1"width="35%">{$data_adherent.telephonef_adht}<br />
			{if $data_adherent.telephonep_adht}{$data_adherent.telephonep_adht}<br />{/if}
			{if $data_adherent.telecopie_adht}{$data_adherent.telecopie_adht}<br />{/if}
			{if $data_adherent.email_adht}<a href="mailto:{$data_adherent.email_adht}">{$data_adherent.email_adht}</a><br />{/if}
			{if $data_adherent.siteweb_adht}<a href="http://{$data_adherent.siteweb_adht}" target="_blank">http://{$data_adherent.siteweb_adht}</a><br />{/if}
			{if $data_adherent.datenaisance_adht <> ''}{$data_adherent.datenaisance_adht}<br />{/if}
			</td>
		 </tr>

  
		<tr>
			<td class="LignegrisC" colspan="4">&nbsp;</td>
		</tr>		
    </table>
{* -- FIN INFO PERSONNELLES -- *}	

{* ----------- *}
{* ----------- *}	
	
	</div> {* FIN défini le contenu .. *} 