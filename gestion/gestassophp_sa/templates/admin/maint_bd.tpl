{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2023 (c) JC Etiemble HTML5 *}
{* Affiche pour sauvegarde BD *}
{* Affichage du CONTENU avec AIDE *}
	<header class="header_titre_aide"><a href='#' style="cursor:pointer;" onclick="javascript :window.open('../aide/a_admin_maint_bd.php','popup','height=350,toolbar=no,location=no,directories=no,status=yes,width=700,resizable=no,scrollbars=yes,top=10,left=10')" title="{_LANG_TITLE_AIDE}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20">{_LANG_AIDE}</a></header>

    <header class="header_titre">&nbsp;{_LANG_TITRE_ADMIN_MAINT_BD}</header>
	<div class="ligne_coul"></div>

{* défini le contenu .. *}
	<div id="contenu">
 	<br><br><br>
 	{* Optimiser toutes les tables *}
		<div class="Lignegris_pad2_Center_Gras">{_LANG_STITRE_ADMIN_MAINT_BD}</div>
		<div>{_LANG_ADMIN_MAINT_BD_OPTIM}<a href="maint_bd.php?opt_bd=Ok"><span class="submit_ok" title="{_LANG_ADMIN_MAINT_BD_OPTIM_BUTTON}">&nbsp;{_LANG_ADMIN_MAINT_BD_OPTIM_BUTTON}&nbsp;</span></a></div>
		<div>{if !empty($optimisation)}{$optimisation}{/if}</div>

	<br>
	<br><br>
{* Sauvegarder les données les données des tables et/ou structure de la base de données *}
	{if $typebdmysql == mysqli || $typebdmysql == postgres}
	{* si la BD est de type mysqli ou postgres *}
		<form action="export_bd.php" method="post" name="maint_form">
			<div class="Lignegris_pad2_Center_Gras">{_LANG_ADMIN_MAINT_BD_TYPEBD}</div>
			<div>
				{if $typebdmysql == mysqli} {* Ne PAS proposer de sauver la structure si base postgres *}	
			{html_options name = "struct" options = $list_structbd_on selected = 'Non'} 	{* la structure par défaut Non *}		
				<span class="Textenoir">&nbsp;{_LANG_ADMIN_MAINT_BD_SAV_STRUCT}</span>
				{/if}
			</div>
			<div>{html_options name = "data" options = $list_structbd_on selected = 'Oui'}    	{* les données par défaut Oui *}
				<span class="TextenoirGras">&nbsp;{_LANG_ADMIN_MAINT_BD_SAV_DATA}</span></div>
			<br>
			<div class="centre-txt">
			<input type="submit" class="submit_ok" name="Valider" value="{_LANG_TPL_SAV_BUTTON}" title="{_LANG_ADMIN_MAINT_BD_BUTTON_TITLE}"><br>
			<input type="hidden" name="valid_sav" value="savbdok">
			</div>
		</form>
	{/if}
	<br><br>

	</div>
{* FIN défini le contenu .. *}
