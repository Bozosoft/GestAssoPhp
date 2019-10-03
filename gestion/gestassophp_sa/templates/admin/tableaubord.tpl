{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2019 (c) JC Etiemble HTML5*}
{* Affiche Tableau de bord *}
{* Affichage du CONTENU avec AIDE *}
	<header class="header_titre_aide"><a href='#' style="cursor:pointer;" onclick="javascript :window.open('../aide/a_admin_tableaubord.php','popup','height=600,toolbar=no,location=no,directories=no,status=yes,width=700,resizable=no,scrollbars=yes,top=10,left=10')" title="{language name=title_aide}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20"/>{language name=aide}</a></header> 

    <header class="header_titre">&nbsp;{language name=titre_admin_tableaubord}</header>
	<div class="ligne_coul"></div> 	
	<div id="contenu"> {*défini le contenu .. *}
 	<br /><br />
    <table style="width:90%;">
		<tr> 
			<th class="LignegrisTC" colspan ="4">{language name=tableaubord_recap}</th> 
		</tr>
		<tr> {* Affiche Tableau de bord Adhérents pour Membre du CA+Secrétaire+Trésorier+Admin *}
			<td style="width:25%;" class="Lignegris_pad2"><span class="TextenoirGras">{$adherent_bene}s</span></td>
			<td style="width:30%;" class="Lignegris_pad2">{language name=tableaubord_inscrit} {$date_debannee_asso} :&nbsp;<span class="TextenoirGras">{if $priorite_adht > 4}<a href='../adherent/liste_adht_admin.php?filtre_nom=&amp;filtre_membre=4' title="{language name=tableaubord_nbadhts_title}">{$nb_adherent}</a>{else}{$nb_adherent}{/if}</span></td>
			<td style="width:30%;" class="Lignegris_pad2">{language name=tableaubord_cotisants}&nbsp;<span class="TextenoirGras">{if $priorite_adht > 4}<a href='../adherent/liste_adht_admin.php?filtre_nom=&amp;filtre_membre=1' title="{language name=tableaubord_nbcotisadhts_title}">{$nb_adherent_soc}</a>{else}{$nb_adherent_soc}{/if}</span></td>
				
{if $priorite_adht > 4} 	{* Donc Secrétaire Trésorier Admin Seulement *}
			<td style="width:5%;">&nbsp;<a href='../adherent/export_tadhts.php'  title="{language name=tableaubord_tadhts_icon_title}"><img src="../images/icones/disque32.png" alt="tadhts XLS" width="32" height="30" /></a></td>
{else}	
			<td style="width:10%;">&nbsp;</td> 
{/if}	{* Sinon pour 4 = Membre du CA Seulement *}
		</tr>
		<tr>{* Affiche Tableau de bord Adhérents cotisants + modif 12/08/08 pour Membre du CA+Secrétaire+Trésorier+Admin *}
			<td style="width:25%;" class="Lignegris_pad1"><span class="TextenoirGras">{language name=tableaubord_cotisation} {$adherent_bene}s</span></td>
			<td style="width:30%;" class="Lignegris_pad1">&nbsp;&nbsp;{language name=tableaubord_depuis} {$date_debannee_asso} : {$montant_cotisation_adh} &euro;</td>
			<td style="width:30%;" class="Lignegris_pad1"><span class="TextenoirGras">&nbsp;&nbsp; {$montant_cotisation_adh_encours} &euro;</span></td>
				
{if $priorite_adht > 4} 	{* Donc Secrétaire Trésorier Admin Seulement *}
			<td style="width:5%;">&nbsp;<a href='../adherent/export_tcotis.php' title="{language name=tableaubord_tcotis_icon_title}"><img src="../images/icones/disque32.png" alt="tcotis XLS" width="32" height="30" /></a></td>
{else}	
			<td style="width:10%;">&nbsp;</td> 
{/if}	
		</tr>

		<tr> 
			<th class="LignegrisTC" colspan ="4">&nbsp;</th> 
		</tr>
{* Ajout Oct 2018  Affiche sur Tableau de bord igne télécharger un fichier des adhérents dont la cotisation est échue ou non réglée *}
{if $priorite_adht > 4} 	{* Donc Secrétaire Trésorier Admin Seulement *}
		<tr>
			<td style="width:25%;" class="Lignegris_pad1"><span class="TextenoirGras">
			{language name=liste_fichiers_adht_download_file_icon_title} {$adherent_bene}s</span>  {* Télécharger le fichier' *}
			</td>	
			<td style="width:25%;" class="Lignegris_pad1">
			{language name=message_fiche_cot_echue} {$date_du_jour}
			</td>	
			<td style="width:25%;" class="Lignegris_pad1">	
			Ou {language name=message_fiche_cot_nonok} au {$date_du_jour}
			</td>
			<td style="width:5%;">&nbsp;<a href='../adherent/export_tadhts_cotisechue.php'  title="{language name=message_fiche_cot_echue} {$date_du_jour} et {language name=message_fiche_cot_nonok} "><img src="../images/icones/disque32.png" alt="tadhts_cotisechue XLS" width="32" height="30" /></a>
			</td>
		</tr>	

{/if}
		

	</table>
	<br /><br /> 
	</div> {* / défini le contenu .. *} 
