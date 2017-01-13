{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2014 (c) JC Etiemble HTML5*}
{* Affiche les logs des adhérents *}
{* Affichage du CONTENU avec AIDE *}
	<header class="header_titre_aide"><a href='#' style="cursor:pointer;cursor:hand" onclick="javascript :window.open('../aide/a_logs.php','popup','height=250,toolbar=no,location=no,directories=no,status=yes,width=660,resizable=no,scrollbars=yes,top=10,left=10')" title="{language name=title_aide}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20"/>{language name=aide}</a></header> 

    <header class="header_titre">&nbsp;{language name=titre_admin_logs}</header>
	<div class="ligne_coul"></div> 	
	<div id="contenu"> {*défini le contenu .. *}
 	
{* =Affichage - NB pages *}		
	<form action="liste_logs.php" method="get" name="filtre">	
		<table  style="width:100%;">
			<tr>
				<td><span class="TextenoirR">{$nb_lines} {if $nb_lines != 1}{language name=admin_logs_enr_s} {else}{language name=admin_logs_enr} {/if}&nbsp;&nbsp;<a href="../admin/export_tlogs.php?export_ok=1" title="{language name=admin_logs_title_export}">{language name=admin_logs_export}</a></span>&nbsp;<br /><img src="../images/icones/exclam.png" alt="clear" width="16" height="16" /><span class="TexterougeR">{language name=admin_logs_clear_logs}<a href="liste_logs.php?reset=1" onclick="return confirm('{language name=admin_logs_js_clear_logs}')"> <img src="../images/icones/i_poubelle.gif" alt="clear" width="10" height="11" title="{language name=admin_logs_title_clear_logs}" /></a></span></td>
				<td class="centre-txt">{language name=tpl_select_affichepar}
					<select name="affiche_nb_fich" onchange="form.submit()">
						{html_options options=$affichenb_log_options selected=$affiche_nb_fich} 
					</select>
				</td>
				<td class="aff_droite-txt" >{language name=tpl_pages}<span class="NumPageGras">
	{section name=pageLoop start=1 loop=$nb_pages}
	{if $smarty.section.pageLoop.index eq $numpage}{$smarty.section.pageLoop.index}
	{else}
		<a href="liste_logs.php?numpage_affiche={$smarty.section.pageLoop.index}&amp;affiche_nb_fich={$affiche_nb_fich}" title="{language name=tpl_go_pages}">{$smarty.section.pageLoop.index} </a>
	{/if}
	{/section}</span>
				</td>
			</tr>					
		</table>
	</form>
	
{* FIN Affichage - NB pages *}								
		<table style="width:100%;"> 
			<tr>
				<th class="LignegrisTC" style="width:6%;">
					<a href="liste_logs.php?tri=0&amp;affiche_nb_fich={$affiche_nb_fich}" title="{language name=tpl_title_clictri}">#</a>
					{if $smarty.session.tri eq 0}
					{if $smarty.session.tri_sens eq 1}
					<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_up}"/>
					{else}
					<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_down}"/>
					{/if}
					{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt=""/>
					{/if}
				</th>				
				<th class="LignegrisTC" style="width:22%;">
					<a href="liste_logs.php?tri=1&amp;affiche_nb_fich={$affiche_nb_fich}" title="{language name=tpl_title_clictri}">{language name=tpl_col_date}</a>
					{if $smarty.session.tri eq 1}
					{if $smarty.session.tri_sens eq 1}
					<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_up}"/>
					{else}
					<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_down}"/>
					{/if}
					{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt=""/>
					{/if}
				</th>
				<th class="LignegrisTC" style="width:15%;">
					<a href="liste_logs.php?tri=2&amp;affiche_nb_fich={$affiche_nb_fich}" title="{language name=tpl_title_clictri}">"IP"</a>
					{if $smarty.session.tri eq 2}
					{if $smarty.session.tri_sens eq 1}
					<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_up}"/>
					{else}
					<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_down}"/>
					{/if}
					{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt=""/>
					{/if}
				</th>
				<th class="LignegrisTC" style="width:22%;">
					<a href="liste_logs.php?tri=3&amp;affiche_nb_fich={$affiche_nb_fich}" title="{language name=tpl_title_clictri}">{language name=admin_logs_col_utilisateur}</a>
					{if $smarty.session.tri eq 3}
					{if $smarty.session.tri_sens eq 1}
					<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_up}"/>
					{else}
					<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_down}"/>
					{/if}
					{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt=""/>
					{/if}
				</th>
				<th class="LignegrisTC" style="width:35%;">
					<a href="liste_logs.php?tri=4&amp;affiche_nb_fich={$affiche_nb_fich}" title="{language name=tpl_title_clictri}">{language name=tpl_col_description}</a>
					{if $smarty.session.tri eq 4}
					{if $smarty.session.tri_sens eq 1}
					<img src="../images/symboles/s_asc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_up}"/>
					{else}
					<img src="../images/symboles/s_desc.png" width="11" height="9" alt="" title="{language name=tpl_title_clictri_down}"/>
					{/if}
					{else}
					<img src="../images/symboles/empty.png" width="7" height="7" alt=""/>
					{/if}
				</th>

			</tr>
{foreach from=$logs item=log key=ordre}
			<tr class="Lignegris{$log.coul}">
				<td>{$log.id}</td>				
				<td>{$log.date}</td>
				<td>{$log.ip}</td>
				<td>{$log.adh}</td>
				<td>{$log.action}</td>
			</tr>
{foreachelse}
			<tr><td colspan="6">{language name=tpl_liste_vide}</td></tr>
{/foreach}
		</table>
{* Affichage - NB pages *}		
	<div class="aff_droite-txt">{language name=tpl_pages}<span class="NumPageGras">
	{section name=pageLoop start=1 loop=$nb_pages}
	{if $smarty.section.pageLoop.index eq $numpage}{$smarty.section.pageLoop.index}
	{else}
		<a href="liste_logs.php?numpage_affiche={$smarty.section.pageLoop.index}" title="{language name=tpl_go_pages}">{$smarty.section.pageLoop.index} </a>
	{/if}
	{/section}</span></div>
{* FIN Affichage - NB pages *}	

	</div> {* / défini le contenu .. *} 
