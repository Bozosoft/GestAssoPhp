{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2023 (c) JC Etiemble HTML5 *}
{* Affiche Tableau de bord *}
{* Affichage du CONTENU avec AIDE *}
	<header class="header_titre_aide"><a href='#' style="cursor:pointer;" onclick="javascript :window.open('../aide/a_admin_tableaubord.php','popup','height=600,toolbar=no,location=no,directories=no,status=yes,width=700,resizable=no,scrollbars=yes,top=10,left=10')" title="{_LANG_TITLE_AIDE}"><img src='../images/icones/help.gif' alt="_LANG_AIDE" width="20" height="20">{_LANG_AIDE}</a></header>

    <header class="header_titre">&nbsp;{_LANG_TITRE_ADMIN_TABLEAUBORD}</header>
	<div class="ligne_coul"></div>
	<div id="contenu">
{* défini le contenu .. *}
 	<br><br>
    <table style="width:90%;">
		<tr>
			<th class="LignegrisTC" colspan ="4">{_LANG_TABLEAUBORD_RECAP}</th>
		</tr>
		<tr>
{* Adhérents *}
			<td style="width:25%;" class="Lignegris_pad2"><span class="TextenoirGras">{$adherent_bene}s</span></td>
	{if $priorite_adht > 4}
{* Affiche Tableau de bord Adhérents pour Secrétaire+Trésorier+Admin *}
			{* inscrits depuis le début *}
			<td style="width:30%;" class="Lignegris_pad2">{_LANG_TABLEAUBORD_INSCRIT} {$date_debannee_asso} :&nbsp;
			<span class="TextenoirGras"><a href='../adherent/liste_adht_admin.php?filtre_nom=&amp;filtre_membre=4' title="{_LANG_TABLEAUBORD_NBADHTS_TITLE}">{$nb_adherent}</a></span></td>
			{* Nb Cotisants *}
			<td style="width:30%;" class="Lignegris_pad2">{_LANG_TABLEAUBORD_COTISANTS}&nbsp;<span class="TextenoirGras"><a href='../adherent/liste_adht_admin.php?filtre_nom=&amp;filtre_membre=1' title="{_LANG_TABLEAUBORD_NBCOTISADHTS_TITLE}">{$nb_adherent_soc}</a></span></td>
			{* lien téléchargement *}
			<td style="width:5%;">&nbsp;<a href='../adherent/export_tadhts.php'  title="{_LANG_TABLEAUBORD_TADHTS_ICON_TITLE}"><img src="../images/icones/disque32.png" alt="tadhts XLS" width="32" height="30"></a></td>
		</tr>
		<tr>
{* Cotisations *}
			<td style="width:25%;" class="Lignegris_pad1"><span class="TextenoirGras">{_LANG_TABLEAUBORD_COTISATION} {$adherent_bene}s</span></td>
			{* Cotisations Adhérents depuis le début *}
			<td style="width:30%;" class="Lignegris_pad1">&nbsp;&nbsp;{_LANG_TABLEAUBORD_DEPUIS} {$date_debannee_asso} : {$montant_cotisation_adh} &euro;</td>
			{* Cotisations Adhérents en cours *}
			<td style="width:30%;" class="Lignegris_pad1"><span class="TextenoirGras">&nbsp;&nbsp; {$montant_cotisation_adh_encours} &euro;</span></td>
			{* lien téléchargement *}
			<td style="width:5%;">&nbsp;<a href='../adherent/export_tcotis.php' title="{_LANG_TABLEAUBORD_TCOTIS_ICON_TITLE}"><img src="../images/icones/disque32.png" alt="tcotis XLS" width="32" height="30"></a></td>
		</tr>
		<tr>
			<th class="LignegrisTC" colspan ="4">&nbsp;</th>
		</tr>
		{* Ajout Oct 2018  Affiche sur Tableau de bord ligne télécharger un fichier des adhérents dont la cotisation est échue ou non réglée *}
		<tr>
			{* Télécharger le fichier Adhérents des Cotisations *}
			<td style="width:25%;" class="Lignegris_pad1"><span class="TextenoirGras">
			{_LANG_LISTE_FICHIERS_ADHT_DOWNLOAD_FILE_ICON_TITLE} {$adherent_bene}s</span>  {* Télécharger le fichier' *}</td>
			{* Cotisation échue depuis date du jour *}
			<td style="width:25%;" class="Lignegris_pad1">
			{_LANG_MESSAGE_FICHE_COT_ECHUE} {$date_du_jour}</td>
			{* Cotisation NON réglée date du jour *}
			<td style="width:25%;" class="Lignegris_pad1">
			Ou {_LANG_MESSAGE_FICHE_COT_NONOK} au {$date_du_jour}</td>
			{* lien téléchargement *}
			<td style="width:5%;">&nbsp;<a href='../adherent/export_tadhts_cotisechue.php'  title="{_LANG_MESSAGE_FICHE_COT_ECHUE} {$date_du_jour} et {_LANG_MESSAGE_FICHE_COT_NONOK} "><img src="../images/icones/disque32.png" alt="tadhts_cotisechue XLS" width="32" height="30"></a></td>

	{else if $priorite_adht == 4}
{* Sinon pour 4 = Membre du CA Seulement *}
			<td style="width:30%;" class="Lignegris_pad2">{_LANG_TABLEAUBORD_INSCRIT} {$date_debannee_asso} :&nbsp;
			<span class="TextenoirGras">{$nb_adherent}</span></td>
			<td style="width:30%;" class="Lignegris_pad2">{_LANG_TABLEAUBORD_COTISANTS}&nbsp;<span class="TextenoirGras">{$nb_adherent_soc}</span></td>
			<td style="width:10%;">&nbsp;</td>
		</tr>
		<tr>
			<td style="width:25%;" class="Lignegris_pad1"><span class="TextenoirGras">{_LANG_TABLEAUBORD_COTISATION} {$adherent_bene}s</span></td>
			<td style="width:30%;" class="Lignegris_pad1">&nbsp;&nbsp;{_LANG_TABLEAUBORD_DEPUIS} {$date_debannee_asso} : {$montant_cotisation_adh} &euro;</td>
			<td style="width:30%;" class="Lignegris_pad1"><span class="TextenoirGras">&nbsp;&nbsp; {$montant_cotisation_adh_encours} &euro;</span></td>
			<td style="width:10%;">&nbsp;</td>
		</tr>
		<tr>
			<th class="LignegrisTC" colspan ="4">&nbsp;</th>
	{else}
{* sécurité *}
		<td  colspan ="4"><span class="TexterougeGras">INTERDIT</span></td>
	{/if}
		</tr>
	</table>
	<br><br>

	</div>
{* FIN défini le contenu .. *}
