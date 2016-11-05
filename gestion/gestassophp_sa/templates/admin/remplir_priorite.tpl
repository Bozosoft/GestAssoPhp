{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2014 (c) JC Etiemble HTML5*}
{* Affichage du CONTENU avec AIDE *}
	<header class="header_titre_aide"><a href='#' style="cursor:pointer;cursor:hand" onclick="javascript :window.open('../aide/a_priorite.php','popup','height=380,toolbar=no,location=no,directories=no,status=yes,width=660,resizable=no,scrollbars=yes,top=10,left=10')" title="{language name=title_aide}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20"/>{language name=aide}</a></header> 

    <header class="header_titre">&nbsp;{language name=titre_admin_gerer_priorite_adherents}</header>
	<div class="ligne_coul"></div> 	
	<div id="contenu"> {*défini le contenu .. *}
 	
{* Ajout adherent avec priorité *}	

	<div class="login-box_pripref">		
		<form method="post" name="maform" action="remplir_priorite.php">
		<br />
		<div class="centre-txt">{$message}</div>
		<label class="label_pripref">{$adherent_bene}</label>
            <span class="align_pripref">&nbsp;{html_options name=id_adht_priorite options=$listnoms selected=$id_adht_priorite}</span>	
		<br /><br />
		<label class="label_pripref" title="{language name=admin_priorite_code_priorite_title}">{language name=admin_priorite_code_priorite}</label>
			<span class="align_pripref">&nbsp;{html_options name=code_priorite options=$list_priorite_adht selected=$code_priorite}</span>
		<br /><br />
		<div class="centre-txt">
			<input type="submit" class="submit_ok" name="Valider" value="{language name=tpl_valid_button}"  title="{language name=tpl_valid_button_title}"/>
			<input type="hidden" name="valid" value="validation"/></div>
	
		</form>
		
	</div>


{* Fin Ajout*}	 

{* Affichage - NB pages *}
	<div class="aff_droite-txt">{language name=tpl_pages}<span class="NumPageGras">
					{section name=pageLoop start=1 loop=$nb_pages}
					{if $smarty.section.pageLoop.index eq $numpage}{$smarty.section.pageLoop.index}
					{else}<a href="remplir_priorite.php?numpage_affiche={$smarty.section.pageLoop.index}" title="{language name=tpl_go_pages}">{$smarty.section.pageLoop.index}</a>
					{/if}
					{/section}</span>
	</div>	
{* FIN Affichage - NB pages *}	
{* Affichage de la liste *}	
	 		<table style="width:60%;" class="centre-txt">
			
			<tr>
				<th class="LignegrisTC" style="width:10%;">
					<a href="remplir_priorite.php?tri=0" title="{language name=tpl_title_clictri}">{language name=tpl_col_num}</a>
					{if $smarty.session.tri eq 0}
					{if $smarty.session.tri_sens eq 0}
					<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_up}"/>
					{else}
					<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_down}"/>
					{/if}
					{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt=""/>
					{/if}
				</th>
				
				<th class="LignegrisTC" style="width:40%;">
					<a href="remplir_priorite.php?tri=1" title="{language name=tpl_title_clictri}">{language name=tpl_col_nompre}</a>
					{if $smarty.session.tri eq 1}
					{if $smarty.session.tri_sens eq 0}
					<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_up}"/>
					{else}
					<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_down}"/>
					{/if}
					{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt=""/>
					{/if}
				</th>
				<th class="LignegrisTC" style="width:10%;">[0-4,5,7,9] 
					<a href="remplir_priorite.php?tri=2" title="{language name=tpl_title_clictri}">{language name=admin_priorite_col_priorite} </a>
					{if $smarty.session.tri eq 2}
					{if $smarty.session.tri_sens eq 0}
					<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_up}"/>
					{else}
					<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_down}"/>
					{/if}
					{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt=""/>
					{/if}
				</th>

			</tr>
{foreach from=$priorite item=item_priorite key=ordre}
			<tr class="Lignegris{$item_priorite.coul}">
				<td>{$item_priorite.id_adht}</td>						
				<td>{$item_priorite.nom_prenom_adht}</td>
				<td class="centre-txt">{$item_priorite.priorite_adht}</td>
			</tr>
{foreachelse}
			<tr><td colspan="6">{language name=tpl_liste_vide}</td></tr>
{/foreach}
		</table>

{* Affichage - NB pages *}
	<div class="aff_droite-txt">{language name=tpl_pages}<span class="NumPageGras">
					{section name=pageLoop start=1 loop=$nb_pages}
					{if $smarty.section.pageLoop.index eq $numpage}{$smarty.section.pageLoop.index}
					{else}<a href="remplir_priorite.php?numpage_affiche={$smarty.section.pageLoop.index}" title="{language name=tpl_go_pages}">{$smarty.section.pageLoop.index}</a>
					{/if}
					{/section}</span>
	</div>	
{* FIN Affichage - NB pages *}	
		
	</div> {* / défini le contenu .. *} 
