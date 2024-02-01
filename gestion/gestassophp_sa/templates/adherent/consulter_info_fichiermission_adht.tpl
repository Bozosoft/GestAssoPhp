{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2023 (c) JC Etiemble HTML5 *}
{* Affichage CONTENU Consulter Info complémentaires *}
<table style="width:100%;">
	<tr>
{* Informations sur mes fichiers
		<th class="LignegrisTC" colspan="2">{_LANG_TITRE_FICHIER_MISSIONS}</th>
	</tr>
	<tr>
	{* Nom fichier *}
	<td class="LignegrisTC " style="width:40%;">
	{_LANG_LISTE_FICHIERS_COL_NOMFICHIER}
	</td>
	{* Description  *}
	<td class="LignegrisTC ">
	&nbsp;&nbsp;&nbsp;{_LANG_TPL_COL_DESCRIPTION}
	</td>
	</tr>

{foreach from = $fichier item = item_fichier key = ordre}
		{if $priorite_adht > 4}
			<tr class="Lignegris{$item_fichier.coul}">
			<td style="width:40%;">
			{* Lien vers liste fichiers pour Adhérents niveau > 4 *}
			<a href="../adherent/liste_fichiers_adht.php?filtre_nom={$adherent_nomfiltre}" title="{_LANG_TITRE_ADMIN_LISTE_FICHIERS_ADHT}">{$item_fichier.nom_file_adht}</a></td>
			<td>&nbsp;&nbsp;&nbsp;{$item_fichier.design_file_adht}</td>
			</tr>
		{else if $priorite_adht == 1 || $priorite_adht == 4}
			<tr class="Lignegris{$item_fichier.coul}">
			<td style="width:40%;">
			{* Seulemnt la possibilité de télécharger un fichier pour niveau 1 ou 4 *}
			<a href="../adherent/liste_fichiers_adht.php?fichier_adht=1&amp;id_file_adht={$item_fichier.id_file_adht}" title="{_LANG_LISTE_FICHIERS_ADHT_DOWNLOAD_FILE_ICON_TITLE}">{$item_fichier.nom_file_adht}</a> </td>
			<td>&nbsp;&nbsp;&nbsp;{$item_fichier.design_file_adht}</td>
			</tr>
		{/if}
{foreachelse}
		<tr class="Lignegris{$item_fichier.coul}">
		{* La liste est vide *}
		<td colspan="2">
		&nbsp;&nbsp;{_LANG_TPL_LISTE_VIDE} ...
		</td>
		</tr>
{/foreach}
	<tr>
		<td class="LignegrisC" colspan="2">&nbsp;</td>
	</tr>
	</table>
{* FIN Affichage CONTENU Info complémentaires *}
