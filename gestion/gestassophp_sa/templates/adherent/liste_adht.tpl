{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2014 (c) JC Etiemble HTML5*}
{* Affichage du CONTENU avec AIDE  Liste des adhérents  + trombi 04/12*}
	<header class="header_titre_aide"><a href='#' style="cursor:pointer;cursor:hand" onclick="javascript :window.open('../aide/a_adht_liste_adht.php','popup','height=320,toolbar=no,location=no,directories=no,status=yes,width=660,resizable=no,scrollbars=yes,top=10,left=10')" title="{language name=title_aide}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20"/>{language name=aide}</a></header> 

    <header class="header_titre">&nbsp;{language name=titre_liste_adht}</header>
	<div class="ligne_coul"></div> 	
	<div id="contenu"> {*défini le contenu .. *}
	
{* Affichage  Recherche *}	
	<form action="liste_adht.php" method="get" name="filtre">
 	
		<div id="listfilter">
			<input type="submit" class="submit_ok" value="{language name=tpl_filter_button}" title=" {language name=tpl_filter_button_title}"/>
			<label for="filtre_nom">{language name=liste_adht_parmi}</label>
			<input type="text" name="filtre_nom" id="filtre_nom" value="{$filtre_adht_nom}" title="{language name=tpl_liste_adht_parmi_title}"/>
		</div>
		
{* Affichage NB adherents -  - NB pages *}	
		<table style="width:100%;">
			<tr>
				<td style="width:25%;">{$nb_lines} {if $nb_lines > 1}{$adherent_bene}s / {$affiche_nb_inscrits} {language name=liste_adht_inscrit}. {else}{$adherent_bene} {/if}</td>
				<td class="centre-txt" style="width:25%;">{language name=tpl_select_affichepar}
					<select name="affiche_nb_adht" onchange="form.submit()">
						{html_options options=$affichenb_adht_options selected=$affiche_nb_adht} 
					</select>
				</td>
				<td class="aff_droite-txt">{language name=tpl_pages}<span class="NumPageGras">
					{section name=pageLoop start=1 loop=$nb_pages}
					{if $smarty.section.pageLoop.index eq $numpage}{$smarty.section.pageLoop.index}
					{else}<a href="liste_adht.php?numpage_affiche={$smarty.section.pageLoop.index}&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={$filtremembre_adht}&amp;filtre_nom={$filtre_adht_nom}" title="{language name=tpl_go_pages}">{$smarty.section.pageLoop.index}</a>
					{/if}
					{/section}</span>
				</td>
			</tr>					
		</table>
{* FIN Affichage NB adherents -  - NB pages *}			
	</form>
{* FIN Affichage  Recherche *}	
		
{* Affichage de la Table des adhérents *}	

		<table style="width:100%;"> 
			<tr>
				<th class="LignegrisTC" style="width:4%;">
					<a href="liste_adht.php?tri=0&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={$filtremembre_adht}&amp;filtre_nom={$filtre_adht_nom}" title="{language name=tpl_title_clictri}">#</a>
					{if $smarty.session.tri eq 0}
					{if $smarty.session.tri_sens eq 0}
					<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_up}"/>
					{else}
					<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="Tri D&eacute;croissant"/>
					{/if}
					{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt=""/>
					{/if}
				</th>				
				<th class="LignegrisTC" style="width:23%;">
					<a href="liste_adht.php?tri=1&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={$filtremembre_adht}&amp;filtre_nom={$filtre_adht_nom}" title="{language name=tpl_title_clictri}">{language name=tpl_col_nompre}</a>
					{if $smarty.session.tri eq 1}
					{if $smarty.session.tri_sens eq 0}
					<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_up}"/>
					{else}
					<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="Tri D&eacute;croissant"/>
					{/if}
					{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt=""/>
					{/if}
				</th>
<!--  ajout photo -->				
				<th class="LignegrisTC" style="width:10%;">Photo
				</th>				

				<th class="LignegrisTC" style="width:23%;">
					<a href="liste_adht.php?tri=2&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={$filtremembre_adht}&amp;filtre_nom={$filtre_adht_nom}" title="{language name=tpl_title_clictri}">{language name=tpl_col_adht_ville}</a>
					{if $smarty.session.tri eq 2}
					{if $smarty.session.tri_sens eq 0}
					<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_up}"/>
					{else}
					<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="Tri D&eacute;croissant"/>
					{/if}
					{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt=""/>
					{/if}
				</th>		
				
				<th class="LignegrisTC" style="width:12%;">
					<a href="liste_adht.php?tri=3&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={$filtremembre_adht}&amp;filtre_nom={$filtre_adht_nom}" title="{language name=tpl_title_clictri}">{language name=tpl_col_adht_teleph}  </a>
					{if $smarty.session.tri eq 3}
					{if $smarty.session.tri_sens eq 0}
					<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_up}"/>
					{else}
					<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="Tri D&eacute;croissant"/>
					{/if}
					{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt=""/>
					{/if}
				</th>
				<th class="LignegrisTC" style="width:12%;">
					<a href="liste_adht.php?tri=4&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={$filtremembre_adht}&amp;filtre_nom={$filtre_adht_nom}" title="{language name=tpl_title_clictri}"> {language name=tpl_col_adht_portable}  </a>
					{if $smarty.session.tri eq 4}
					{if $smarty.session.tri_sens eq 0}
					<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_up}"/>
					{else}
					<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="Tri D&eacute;croissant"/>
					{/if}
					{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt=""/>
					{/if}
				</th>		

				{* + Section critères "sections ou secteurs d'activité" propre à l'association *}
				<th class="LignegrisTC" style="width:10%;">
					<a href="liste_adht.php?tri=5&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={$filtremembre_adht}&amp;filtre_nom={$filtre_adht_nom}" title="{language name=tpl_title_clictri}"> {language name=fiche_adht_ant}</a>
					{if $smarty.session.tri eq 5}
					{if $smarty.session.tri_sens eq 0}
					<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_up}"/>
					{else}
					<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_down}"/>
					{/if}
					{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt=""/>
					{/if}
				</th>	
				
				<th class="LignegrisTC" style="width:6%;">{language name=tpl_col_action}
				</th>
				
			</tr>
{foreach from=$membres item=item_membres key=ordre}
			<tr class="Lignegris{$item_membres.coul}">
				<td>{$item_membres.id_adht}</td>
				<td><a href="../adherent/consulter_fiche_adht.php?id_adht={$item_membres.id_adht}" title="{language name=liste_adht_visu_icon_title}">{$item_membres.nom_adht} {$item_membres.prenom_adht}</a></td>
				<!--  ajout photo --><td class="centre-txt">{if $item_membres.image_adht} <a href="../adherent/consulter_fiche_adht.php?id_adht={$item_membres.id_adht}" title="{language name=liste_adht_visu_icon_title}"><img src="{$item_membres.image_adht}" alt="" /></a>{/if}</td><!--  ajout photo -->				
				<td>{$item_membres.ville_adht}</td>
				<td>{$item_membres.telephonef_adht}</td>
				<td>&nbsp;{$item_membres.telephonep_adht}</td>
				
				<td>&nbsp;{$item_membres.nom_type_antenne}</td>{* + "sections ou secteurs d'activité" propre à l'association *}				
				<td class="centre-txt"><a href="../adherent/consulter_fiche_adht.php?id_adht={$item_membres.id_adht}"><img src="../images/icones16/i_voir.png" width="16" height="16" alt="Visu" title="{language name=liste_adht_visu_icon_title}"/></a></td>				
			</tr>
{foreachelse}
			<tr><td colspan="8">{language name=tpl_liste_vide}</td></tr>
{/foreach}
		</table>
{* Fin  Affichage de la Table des adhérents *}
	
	<div class="aff_droite-txt">{language name=tpl_pages}<span class="NumPageGras">
					{section name=pageLoop start=1 loop=$nb_pages}
					{if $smarty.section.pageLoop.index eq $numpage}{$smarty.section.pageLoop.index}
					{else}<a href="liste_adht.php?numpage_affiche={$smarty.section.pageLoop.index}&amp;affiche_nb_adht={$affiche_nb_adht}&amp;filtre_membre={$filtremembre_adht}&amp;filtre_nom={$filtre_adht_nom}" title="{language name=tpl_go_pages}">{$smarty.section.pageLoop.index}</a>
					{/if}
					{/section}</span></div>

	
	 
	</div> {* Fin défini le contenu .. *} 
