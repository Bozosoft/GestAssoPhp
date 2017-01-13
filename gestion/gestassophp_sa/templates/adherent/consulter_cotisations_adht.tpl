{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2014 (c) JC Etiemble HTML5*}
{* Affichage du CONTENU Visualisation cotisation adhérent*}
	<!--header class="header_titre_aide"><a href='#' style="cursor:pointer;cursor:hand" onclick="javascript :window.open('../aide/a__remplir_cotisation.php','popup','height=300,toolbar=no,location=no,directories=no,status=yes,width=660,resizable=no,scrollbars=yes,top=10,left=10')" title="{language name=title_aide}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20"/>{language name=aide}</a></div --> 

    <header class="header_titre">&nbsp;{language name=titre_admin_fiche_visu_cotis_adht} {$affiche_message}</header>
	<div class="ligne_coul"></div> 	
	<div id="contenu"> {*défini le contenu .. *}
 	<br />
	<table style="width:100%;">
		<tr>		
			<td>&nbsp;</td><td>&nbsp;</td>
		</tr>
		<tr> 	
			<th class="LignegrisRight" style="width:25%;"> {language name=fiche_cotis_adht_date_enr} :</th>		
			<td>{$data_cotis_adh.date_enregist_cotis}</td>
		</tr>
		<tr>		
			<td>&nbsp;</td><td>&nbsp;</td>
		</tr>
		<tr> 
			<th class="LignegrisRight">  {$adherent_bene} {language name=tpl_col_num} :</th>
			<td>{$data_cotis_adh.id_adhtasso}<br/>
			</td>	
        </tr>		
		<tr> 
			<th class="LignegrisRight">&nbsp;</th>
			<td>{$data_cotis_adh.np_adht}<br/>
			{$data_cotis_adh.adr_adht}<br/>
			{$data_cotis_adh.cpv_adht}
			</td>	
        </tr>
		<tr>		
			<td>&nbsp;</td><td>&nbsp;</td>
		</tr>		
		<tr>
			<th class="LignegrisRight"> {language name=fiche_cotis_adht_montant} :</th>		
			<td>{$data_cotis_adh.montant_cotis} {language name=fiche_cotis_adht_euro}</td>
		</tr>		
		<tr>		
			<td>&nbsp;</td><td>&nbsp;</td>
		</tr>
		<tr>
			<th class="LignegrisRight"> {language name=fiche_cotis_adht_type} :</th>		
			<td>{*$data_cotis_adh.id_type_cotisation*}{$data_cotis_adh.nom_type_cotisation}</td>
		</tr>	
		<tr>		
			<td>&nbsp;</td><td>&nbsp;</td>
		</tr>		
		<tr>
			<th class="LignegrisRight"> {language name=fiche_cotis_adht_date_deb} :</th>		
			<td>{$data_cotis_adh.date_debut_cotis}</td>
		</tr>		
		<tr>
			<th class="LignegrisRight"> {language name=fiche_cotis_adht_date_fin} :</th>		
			<td>{$data_cotis_adh.date_fin_cotis}</td>
		</tr>			
		<tr>		
			<td>&nbsp;</td><td>&nbsp;</td>
		</tr>
		<tr><!-- Ajout Zone PAIEMENT Gestion Cotisations -->
			<th class="LignegrisRight"> {language name=fiche_cotis_adht_mpaie} :</th>		
			<td>{$data_cotis_adh.paiement_cotis}</td>
		</tr>		
		<tr>
			<th class="LignegrisRight"> {language name=fiche_cotis_adht_comm} :</th>		
			<td>{$data_cotis_adh.info_cotis}</td>
		</tr>
		<tr>		
			<td>&nbsp;</td><td>&nbsp;</td>
		</tr>
		<tr>		
			<td>&nbsp;</td><td>&nbsp;</td>
		</tr>		
		<tr>		
			<th class="LignegrisRight">{language name=fiche_cotis_visu_faitle} : </th><td>{$date_dujour}</td>
		</tr>	
		<tr>		
			<td>&nbsp;</td><td>&nbsp;</td>
		</tr>		
		<tr>		
			<td>&nbsp;</td><td><a href="../adherent/liste_cotisations_adht.php?filtre_fiche=1&amp;id_adht={$data_cotis_adh.id_adhtasso}"><span class="submit_nul" title="{language name=tpl_retour_button_title}">{language name=tpl_retour_button}</span></a></td>
		</tr>		
     </table>		
	</div> {* Fin défini le contenu .. *} 
