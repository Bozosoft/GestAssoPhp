{* Projet : gestassophp_sa [GestAssoPhp+Pg]*}
{* Affichage CONTENU Consulter Info complémentaires *}
<table width="100%" summary="informations fichier et mission">
	<tr> 
			<th class="LignegrisC" colspan ="3">{language name=titre_fichier_missions}</th> 
	</tr>
	<tr> 
		<th class="Lignegris_pad1" width="25%">{language name=fichier_missions_myfiles}</th>
		<td class="LignegrisC" width="75%" colspan="2">
		{foreach from=$fichier item=item_fichier key=ordre}
		{if $priorite_adht > 4}<a href="../adherent/liste_fichiers_adht.php?filtre_nom={$adherent_nomfiltre}" >{$item_fichier.nom_file_adht}</a>&nbsp;&nbsp;:&nbsp;{$item_fichier.design_file_adht}
		{else if $priorite_adht =1}	<a href="../adherent/liste_fichiers_adht.php?fichier_adht=1&amp;id_file_adht={$item_fichier.id_file_adht}" title="{language name=liste_fichiers_adht_download_file_icon_title}">{$item_fichier.nom_file_adht}</a>&nbsp;&nbsp;:&nbsp;{$item_fichier.design_file_adht}
		{else}{$item_fichier.nom_file_adht}{/if}<br /> 
{foreachelse}
		&nbsp;&nbsp;{language name=tpl_liste_vide} ...
{/foreach}
		</td>
	</tr>


	


	<tr>
		<td class="LignegrisC" colspan="3">&nbsp;</td>
	</tr>
	
	</table>
	
{* /  Affichage CONTENU Info complémentaires *} 