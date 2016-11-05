{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2014 (c) JC Etiemble HTML5*}
{* Affichage CONTENU Consulter Info complémentaires *}
<table style="width:100%;">
	<tr> 
		<th class="LignegrisTC" colspan="2">{language name=titre_fichier_missions}</th> 
	</tr>
	<tr> 
	<td class="LignegrisTC " style="width:40%;">
	{language name=liste_fichiers_col_nomfichier}
	</td>
	<td class="LignegrisTC "> 
	&nbsp;&nbsp;&nbsp;{language name=tpl_col_description}
	</td> 
	</tr> 
		{foreach from=$fichier item=item_fichier key=ordre}
		{if $priorite_adht > 4} {*envoi vers liste fichiers pour niveau > 4*}
			<tr class="Lignegris{$item_fichier.coul}">
			<td style="width:40%;">
			<a href="../adherent/liste_fichiers_adht.php?filtre_nom={$adherent_nomfiltre}" title="{language name=titre_admin_liste_fichiers_adht}">{$item_fichier.nom_file_adht}</a></td>
			<td>&nbsp;&nbsp;&nbsp;{$item_fichier.design_file_adht}</td>
			</tr>	
		{else if $priorite_adht == 1 || $priorite_adht == 4}{*possibilité de télécharger un fichier pour niveau 1 ou 4*}
			<tr class="Lignegris{$item_fichier.coul}">
			<td style="width:40%;">
			<a href="../adherent/liste_fichiers_adht.php?fichier_adht=1&amp;id_file_adht={$item_fichier.id_file_adht}" title="{language name=liste_fichiers_adht_download_file_icon_title}">{$item_fichier.nom_file_adht}</a> </td>
			<td>&nbsp;&nbsp;&nbsp;{$item_fichier.design_file_adht}</td>
			</tr>
		{/if}	
{foreachelse}
		<tr class="Lignegris{$item_fichier.coul}">
		<td colspan="2">
		&nbsp;&nbsp;{language name=tpl_liste_vide} ...
		</td>
		</tr>
{/foreach}
	<tr>
		<td class="LignegrisC" colspan="2">&nbsp;</td>
	</tr>
	</table>
	
{* /  Affichage CONTENU Info complémentaires *} 