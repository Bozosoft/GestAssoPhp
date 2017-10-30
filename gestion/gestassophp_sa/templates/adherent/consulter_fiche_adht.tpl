{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2017 (c) JC Etiemble HTML5*}
{* Affiche la fiche de l'adhérent Consulter fiche adhérent depuis consulter_fiche_adht.php ET consulter_fiche_adht_admin2.php*}
{* Affichage du CONTENU avec AIDE *}
	<header class="header_titre_aide"><a href='#' style="cursor:pointer;cursor:hand" onclick="javascript :window.open('../aide/a_adht_consulter_fiche_adht.php','popup','height=250,toolbar=no,location=no,directories=no,status=yes,width=660,resizable=no,scrollbars=yes,top=10,left=10')" title="{language name=title_aide}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20"/>{language name=aide}</a></header> 

    <header class="header_titre">{$vientde}&nbsp;{language name=titre_consult_fiche_adht}</header>
	<div class="ligne_coul"></div> 	
	<div id="contenu"> {*défini le contenu .. *}
{* -- si erreur -- *}
{if !empty($erreur_saisie)}	
	{if $erreur_saisie|@count != 0} 
		<div id="erreur-box">{language name=tpl_texte_err_saisie}
			{if $erreur_saisie.id_adht}<br /><span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.id_adht}</span>{/if}
		</div>
	{/if}
{/if}	
	
{* -- RECAPITULATF -- *}	
    	<table style="width:100%;">
		<tr> 
			<th class="LignegrisC" colspan ="2">{language name=visu_fiche_adht_recap}</th> 
		</tr>
		<tr>
			<td class="Lignegris_pad1">{language name=visu_fiche_adht_enr}&nbsp;{$id_adht}&nbsp;{language name=visu_fiche_adht_enrdu}&nbsp;:&nbsp;{$data_adherent.datecreationfiche_adht}</td>
			<td class="Lignegris_pad1">{language name=visu_fiche_adht_lastmod}&nbsp;:&nbsp;
			{if $data_adherent.datemodiffiche_adht == '00/00/0000' || $data_adherent.datemodiffiche_adht ==''} Aucune {else}{$data_adherent.datemodiffiche_adht}{/if}</td>
		</tr>
		 <tr> 
			<th class="Ligne_top" colspan="2">&nbsp;</th> 
		 </tr>		

     </table>
	<br />
{* -- FIN RECAPITULATF -- *}	
{* -- INFO PERSONNELLES -- *}	
	<table style="width:100%;">
		<tr> 
			<th class="LignegrisC" colspan ="3">{language name=gestion_fiche_adht}</th>
			 <td>&nbsp;</td>
		</tr>
		<tr> 
		    <td class="Lignegris_pad1" style="width:60%;" colspan="2">{$data_adherent.civilite_adht}<span class="TextenoirGras"> {$data_adherent.prenom_adht} {$data_adherent.nom_adht}</span><br />
					{$data_adherent.adresse_adht}<br />
					{$data_adherent.cp_adht}&nbsp;{$data_adherent.ville_adht}<br /></td>
		    <td  class="LignegrisC_Center" style="width:20%;" rowspan="2">{$photo_adht}</td>
		    <td  class="LignegrisC_Center" style="width:20%;" rowspan="2">{language name=fiche_adht_ant}&nbsp;:&nbsp;{$data_adherent.nom_type_antenne}
					<br /><br />{$data_adherent.tranche_age}&nbsp;<br />
					&nbsp;<br />{if $data_adherent.age}{language name=visu_fiche_adht_age}:&nbsp;{$data_adherent.age|string_format:"%d"}&nbsp;ans{/if}</td>
		  </tr>

		  <tr> 
		    <td class="Lignegris_pad1" style="width:25%;">{if $data_adherent.telephonef_adht}{language name=tpl_col_adht_teleph}{/if}<br /> 
			{if $data_adherent.telephonep_adht}{language name=tpl_col_adht_portable}<br />{/if}
			{if $data_adherent.telecopie_adht} {language name=fiche_adht_fax}<br />{/if}
			{if $data_adherent.email_adht} {language name=fiche_adht_mail}<br />{/if}
			{if $data_adherent.siteweb_adht} {language name=fiche_adht_web}<br />{/if} 
			{if $data_adherent.datenaisance_adht <> ''}{language name=tpl_adht_datenais}<br />{/if}
			</td>
		    <td class="Lignegris_pad1" style="width:35%;">{$data_adherent.telephonef_adht}<br />
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
