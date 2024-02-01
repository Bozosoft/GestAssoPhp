{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2023 (c) JC Etiemble HTML5 *}
{* Affiche la fiche de l'adhérent Consulter fiche adhérent depuis consulter_fiche_adht.php ET consulter_fiche_adht_admin2.php *}
{* Affichage du CONTENU avec AIDE *}
	<header class="header_titre_aide"><a href='#' style="cursor:pointer;" onclick="javascript :window.open('../aide/a_adht_consulter_fiche_adht.php','popup','height=250,toolbar=no,location=no,directories=no,status=yes,width=660,resizable=no,scrollbars=yes,top=10,left=10')" title="{_LANG_TITLE_AIDE}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20">{_LANG_AIDE}</a></header>

    <header class="header_titre">{$vientde}&nbsp;{_LANG_TITRE_CONSULT_FICHE_ADHT}</header>
	<div class="ligne_coul"></div>
	<div id="contenu"> {* défini le contenu .. *}
{* -- si erreur -- *}
{if !empty($erreur_saisie)}
	{if $erreur_saisie|@count != 0}
		<div id="erreur-box">{_LANG_TPL_TEXTE_ERR_SAISIE}
			{if $erreur_saisie.id_adht}<br><span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.id_adht}</span>{/if}
		</div>
	{/if}
{/if}

{* -- RECAPITULATF -- *}
    	<table style="width:100%;">
		<tr>
		{* affiche Récapitulatif *}
			<th class="LignegrisC" colspan ="2">{_LANG_VISU_FICHE_ADHT_RECAP}</th>
		</tr>
		<tr>
			{* Enregistrement N° ... du xx/xx/xxxx *}
			<td class="Lignegris_pad1">{_LANG_VISU_FICHE_ADHT_ENR}&nbsp;{$id_adht}&nbsp;{_LANG_VISU_FICHE_ADHT_ENRDU}{$data_adherent.datecreationfiche_adht}</td>
			{* Dernière modification de la fiche *}
			<td class="Lignegris_pad1">{_LANG_VISU_FICHE_ADHT_LASTMOD}&nbsp;:&nbsp;
				{if $data_adherent.datemodiffiche_adht == '00/00/0000' || $data_adherent.datemodiffiche_adht == ''}
					Aucune
				{else}
					{* affiche si elle existe la Date Dernière modification *}
					{$data_adherent.datemodiffiche_adht}
				{/if}</td>
		</tr>
		 <tr>
			<th class="Ligne_top" colspan="2">&nbsp;</th>
		 </tr>

     </table>
	<br>
{* -- FIN RECAPITULATF -- *}

{* -- INFO PERSONNELLES -- *}
	<table style="width:100%;">
		<tr>
			<th class="LignegrisC" colspan ="3">{_LANG_GESTION_FICHE_ADHT}</th>
			 <td>&nbsp;</td>
		</tr>
		<tr>
		{* Colonne gauche civilité, nom, adresse *}
		    <td class="Lignegris_pad1" style="width:60%;" colspan="2">{$data_adherent.civilite_adht}<span class="TextenoirGras"> {$data_adherent.prenom_adht} {$data_adherent.nom_adht}</span><br>
			{$data_adherent.adresse_adht}<br>
			{$data_adherent.cp_adht}&nbsp;{$data_adherent.ville_adht}<br></td>
		{* Colonne droite photo, section, tranche d'âge, âge *}
		    <td  class="LignegrisC_Center" style="width:20%;" rowspan="2">{$photo_adht}</td>
		    <td  class="LignegrisC_Center" style="width:20%;" rowspan="2">{_LANG_PREF_LANG_FICHE_ADHT_ANT}&nbsp;:&nbsp;{$data_adherent.nom_type_antenne}
			<br><br>{$data_adherent.tranche_age}&nbsp;<br>
			&nbsp;<br>
				{if $data_adherent.age}
					{_LANG_VISU_FICHE_ADHT_AGE}:&nbsp;{$data_adherent.age|string_format:"%d"}&nbsp;ans
				{/if}
			</td>
		</tr>

		<tr>
		{* Colonne libellé Téléphone, ... , Date de naissance,*}
		    <td class="Lignegris_pad1" style="width:25%;">{if $data_adherent.telephonef_adht}{_LANG_TPL_COL_ADHT_TELEPH}{/if}<br>
			{if $data_adherent.telephonep_adht}
				{_LANG_TPL_COL_ADHT_PORTABLE}<br>
			{/if}
			{if $data_adherent.telecopie_adht}
				{_LANG_FICHE_ADHT_FAX}<br>
			{/if}
			{if $data_adherent.email_adht}
				{_LANG_FICHE_ADHT_MAIL}<br>
			{/if}
			{if $data_adherent.siteweb_adht}
				{_LANG_FICHE_ADHT_WEB}<br>
			{/if}
			{if $data_adherent.datenaisance_adht <> ''}
				{_LANG_TPL_ADHT_DATENAIS}<br>
			{/if}
			</td>
			{* Colonne données 00 00 00 00 00, ..., xx/xx/1900 *}
		    <td class="Lignegris_pad1" style="width:35%;">{$data_adherent.telephonef_adht}<br>
			{if $data_adherent.telephonep_adht}
				{$data_adherent.telephonep_adht}<br>
			{/if}
			{if $data_adherent.telecopie_adht}
				{$data_adherent.telecopie_adht}<br>
			{/if}
			{if $data_adherent.email_adht}
				<a href="mailto:{$data_adherent.email_adht}">{$data_adherent.email_adht}</a><br>
			{/if}
			{if $data_adherent.siteweb_adht}
				<a href="http://{$data_adherent.siteweb_adht}" target="_blank">http://{$data_adherent.siteweb_adht}</a><br>{/if}
			{if $data_adherent.datenaisance_adht <> ''}
				{$data_adherent.datenaisance_adht}<br>
			{/if}
			</td>
		</tr>
		{* ligne vide *}
		<tr>
			<td class="LignegrisC" colspan="4">&nbsp;</td>
		</tr>
    </table>
{* -- FIN INFO PERSONNELLES -- *}


	</div> {* FIN défini le contenu .. *}
