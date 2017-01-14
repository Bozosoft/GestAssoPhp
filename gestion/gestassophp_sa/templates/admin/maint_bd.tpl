{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2014 (c) JC Etiemble HTML5*}
{* Affiche Pour sauvegarde BD *}
{* Affichage du CONTENU avec AIDE *}
	<header class="header_titre_aide"><a href='#' style="cursor:pointer;cursor:hand" onclick="javascript :window.open('../aide/a_admin_maint_bd.php','popup','height=350,toolbar=no,location=no,directories=no,status=yes,width=700,resizable=no,scrollbars=yes,top=10,left=10')" title="{language name=title_aide}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20"/>{language name=aide}</a></header> 

    <header class="header_titre">&nbsp;{language name=titre_admin_maint_bd}</header>
	<div class="ligne_coul"></div> 	
	<div id="contenu"> {*défini le contenu .. *}
 	<br /><br/><br/>
		<div class="Lignegris_pad2_Center_Gras">{language name=stitre_admin_maint_bd}</div> 
		<div>{language name=admin_maint_bd_optim}<a href="maint_bd.php?opt_bd=Ok"><span class="submit_ok" title="{language name=admin_maint_bd_optim_button}">&nbsp;{language name=admin_maint_bd_optim_button}&nbsp;</span></a></div>
		<div>{$optimisation}</div>
		
	<br/>
	<br/><br/>
	{if $typebdmysql==mysqli || $typebdmysql==postgres} {* si la BD est de type mysqli ou postgres *}	
		<form action="export_bd.php" method="post" name="maint_form">		
			<div class="Lignegris_pad2_Center_Gras">{language name=admin_maint_bd_typebd}</div> 
			<div>{html_options name="struct" options=$list_structbd_on selected='Non'}	
				<span class="Textenoir">&nbsp;{language name=admin_maint_bd_sav_struct}</span></div>
			<div>{html_options name="data" options=$list_structbd_on selected='Oui'}
				<span class="TextenoirGras">&nbsp;{language name=admin_maint_bd_sav_data}</span></div>
			<br />
			<div class="centre-txt">
			<input type="submit" class="submit_ok" name="Valider" value="{language name=tpl_sav_button}" title="{language name=admin_maint_bd_button_title}"/><br/>
			<input type="hidden" name="valid_sav" value="savbdok"/>			
			</div>
		</form>	
	{/if}				
	<br /><br /> 
	</div> {* / défini le contenu .. *} 
