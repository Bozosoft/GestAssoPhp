{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2023 (c) JC Etiemble HTML5 *}
{* Affichage du CONTENU Visualisation cotisation adhérent pour le Reçu cotisation ... *}

    <header class="header_titre">&nbsp;{_LANG_TITRE_ADMIN_FICHE_VISU_COTIS_ADHT} {$affiche_message}</header>
	<div class="ligne_coul"></div>
	<div id="contenu">
{* défini le contenu .. *}
 	<br>
	<table style="width:100%;">
		<tr>
			<td>&nbsp;</td><td>&nbsp;</td>
		</tr>
		<tr>
		{* Date d'enregistrement *}
			<th class="LignegrisRight" style="width:25%;"> {_LANG_FICHE_COTIS_ADHT_DATE_ENR} :</th>
			<td>{$data_cotis_adh.date_enregist_cotis}</td>
		</tr>
		<tr>
			<td>&nbsp;</td><td>&nbsp;</td>
		</tr>
		<tr>
		{* Adhérent N° *}
			<th class="LignegrisRight">  {$adherent_bene} {_LANG_TPL_COL_NUM} :</th>
			<td>{$data_cotis_adh.id_adhtasso}<br>
			</td>
        </tr>
		<tr>
			<th class="LignegrisRight">&nbsp;</th>
			<td>{$data_cotis_adh.np_adht}<br>
			{$data_cotis_adh.adr_adht}<br>
			{$data_cotis_adh.cpv_adht}
			</td>
        </tr>
		<tr>
			<td>&nbsp;</td><td>&nbsp;</td>
		</tr>
		<tr>
		{* Montant cotisation *}
			<th class="LignegrisRight"> {_LANG_FICHE_COTIS_ADHT_MONTANT} :</th>
			<td>{$data_cotis_adh.montant_cotis} {_LANG_FICHE_COTIS_ADHT_EURO}</td>
		</tr>
		<tr>
			<td>&nbsp;</td><td>&nbsp;</td>
		</tr>
		<tr>
		{* Type cotisation *}
			<th class="LignegrisRight"> {_LANG_FICHE_COTIS_ADHT_TYPE} :</th>
			<td>{*$data_cotis_adh.id_type_cotisation*}{$data_cotis_adh.nom_type_cotisation}</td>
		</tr>
		<tr>
			<td>&nbsp;</td><td>&nbsp;</td>
		</tr>
		<tr>
		{* Date début cotisation *}
			<th class="LignegrisRight"> {_LANG_FICHE_COTIS_ADHT_DATE_DEB} :</th>
			<td>{$data_cotis_adh.date_debut_cotis}</td>
		</tr>
		<tr>
		{* Date fin cotisation *}
			<th class="LignegrisRight"> {_LANG_FICHE_COTIS_ADHT_DATE_FIN} :</th>
			<td>{$data_cotis_adh.date_fin_cotis}</td>
		</tr>
		<tr>
			<td>&nbsp;</td><td>&nbsp;</td>
		</tr>
		{* Moyen de paiement *}
		<tr>
			<th class="LignegrisRight"> {_LANG_FICHE_COTIS_ADHT_MPAIE} :</th>
			<td>{$data_cotis_adh.paiement_cotis}</td>
		</tr>
		<tr>
		{* Commentaire *}
			<th class="LignegrisRight"> {_LANG_FICHE_COTIS_ADHT_COMM} :</th>
			<td>{$data_cotis_adh.info_cotis}</td>
		</tr>
		<tr>
			<td>&nbsp;</td><td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td><td>&nbsp;</td>
		</tr>
		<tr>
		{* Fait le *}
			<th class="LignegrisRight">{_LANG_FICHE_COTIS_VISU_FAITLE} : </th><td>{$date_dujour}</td>
		</tr>
		<tr>
			<td>&nbsp;</td><td>&nbsp;</td>
		</tr>
		<tr>
		{* bouton retour *}
			<td>&nbsp;</td><td><a href="../adherent/liste_cotisations_adht.php?filtre_fiche=1&amp;id_adht={$data_cotis_adh.id_adhtasso}"><span class="submit_nul" title="{_LANG_TPL_RETOUR_BUTTON}">{_LANG_TPL_RETOUR_BUTTON}</span></a></td>
		</tr>
    </table>

	</div>
{* Fin défini le contenu .. *}
