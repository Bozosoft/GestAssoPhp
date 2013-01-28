{* Projet : gestassophp_sa [GestAssoPhp+Pg]*}
{* Affiche Pour sauvegarde BD *}
{* Affichage du CONTENU avec AIDE *}
	<div id="titre_aide"><a href='#' style="cursor:pointer;cursor:hand" onclick="javascript :window.open('../aide/a_admin_maint_bd.php','popup','height=350,toolbar=no,location=no,directories=no,status=yes,width=700,resizable=no,scrollbars=yes,top=10,left=10')" title="{language name=title_aide}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20"/>{language name=aide}</a></div> 

    <div id="titre">&nbsp;{language name=titre_admin_maint_bd}</div>
	<div class="ligne_coul"></div> 	
	<div id="contenu"> {*défini le contenu .. *}
 	<br /><br/>
<br/>
	
    <table width="100%" summary="affiche optimisation">
		<tr> 
			<th  class="Lignegris_pad2" colspan ="4">{language name=stitre_admin_maint_bd}</th> 
		</tr>
		<tr> {* *}		
			<td colspan="2">{language name=admin_maint_bd_optim}<a href="maint_bd.php?opt_bd=Ok"><span class="submit_ok" title="{language name=admin_maint_bd_optim_button}">&nbsp;{language name=admin_maint_bd_optim_button}&nbsp;</span></a></td>
		</tr>
		<tr>
			<td colspan="2">{$optimisation}</td>
		</tr>		
	</table>		
<br/>
<br/><br/>

	
<form action="export_bd.php" method="post" name="maint_form">		
    <table width="100%" summary="affiche sauvegarde">
		<tr> 
			<th  class="Lignegris_pad2" colspan ="4">{language name=admin_maint_bd_typebd}</th> 
		</tr>
		<tr> {* MODIF 05/10/2008 *}
			<td>
				{html_options name="struct" options=$list_structbd_on selected='Non'}	
				<span class="Textenoir">&nbsp;{language name=admin_maint_bd_sav_struct}</span>
			</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>		
		<tr>
			<td>
				{html_options name="data" options=$list_structbd_on selected='Oui'}
				<span class="TextenoirGras">&nbsp;{language name=admin_maint_bd_sav_data}</span>
			</td>
		</tr>
		<tr>
			<td align="center" colspan="2">
			<input type="submit" class="submit_ok" name="Valider" value="{language name=tpl_sav_button}" title="{language name=admin_maint_bd_button_title}"/><br/>
			<input type="hidden" name="valid_sav" value="savbdok"/>			
			</td>
		</tr>			
	</table>
</form>	

						
	<br /><br /> 
	</div> {* / défini le contenu .. *} 
