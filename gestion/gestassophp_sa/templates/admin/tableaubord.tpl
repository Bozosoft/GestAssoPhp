{* Projet : gestassophp_sa [GestAssoPhp+Pg]*}
{* Affiche Tableau de bord *}
{* Affichage du CONTENU avec AIDE *}
	<div id="titre_aide"><a href='#' style="cursor:pointer;cursor:hand" onclick="javascript :window.open('../aide/a_admin_tableaubord.php','popup','height=500,toolbar=no,location=no,directories=no,status=yes,width=700,resizable=no,scrollbars=yes,top=10,left=10')" title="{language name=title_aide}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20"/>{language name=aide}</a></div> 

    <div id="titre">&nbsp;{language name=titre_admin_tableaubord}</div>
	<div class="ligne_coul"></div> 	
	<div id="contenu"> {*défini le contenu .. *}
 	<br /><br />
    <table width="100%" summary="affiche tableau bord">
		<tr> 
			<th class="LignegrisC" colspan ="4">{language name=tableaubord_recap}</th> 
		</tr>
		<tr> {* Affiche Tableau de bord Adhérents*}
			<td width="100" class="Lignegris_pad2" nowrap="nowrap">{$adherent_bene}s</td>
			<td width="200" class="Lignegris_pad2" nowrap="nowrap">{language name=tableaubord_inscrit} {$date_debannee_asso} :&nbsp;<span class="TextenoirGras">{if $priorite_adht > 4}<a href='../adherent/liste_adht_admin.php?filtre_nom=&amp;filtre_membre=4' title="{language name=tableaubord_nbadhts_title}">{$nb_adherent}</a>{else}{$nb_adherent}{/if}</span></td>
			<td width="200" class="Lignegris_pad2">{language name=tableaubord_cotisants}&nbsp;<span class="TextenoirGras">{if $priorite_adht > 4}<a href='../adherent/liste_adht_admin.php?filtre_nom=&amp;filtre_membre=1' title="{language name=tableaubord_nbcotisadhts_title}">{$nb_adherent_soc}</a>{else}{$nb_adherent_soc}{/if}</span></td>
				
{if $priorite_adht > 4} 	
			<td width="30" class="Lignegris_pad2"><a href='../adherent/export_tadhts.php'  title="{language name=tableaubord_tadhts_icon_title}"><img src="../images/icones/i_disquet.gif" alt="tadhts XLS" width="24" height="22" /></a></td>
{/if}	
		</tr>
		<tr>{* Affiche Tableau de bord Adhérents cotisants + modif 12/08/08*}
			<td width="100" class="Lignegris_pad2">{language name=tableaubord_cotisation} {$adherent_bene}s</td>
			<td width="200" class="Lignegris_pad2">{language name=tableaubord_depuis} {$date_debannee_asso} : {$montant_cotisation_adh} &euro;</td>
			<td width="150" class="Lignegris_pad2"><span class="TextenoirGras">{$montant_cotisation_adh_encours} &euro;</span></td>
				
{if $priorite_adht > 4} 	
			<td width="80" class="Lignegris_pad2"><a href='../adherent/export_tcotis.php'  title="{language name=tableaubord_tcotis_icon_title}"><img src="../images/icones/i_disquet.gif" alt="tcotis XLS" width="24" height="22" /></a></td>
{/if}	
		</tr>
		

	</table>
	<br /><br /> 
	</div> {* / défini le contenu .. *} 