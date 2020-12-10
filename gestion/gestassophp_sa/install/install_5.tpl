 {* Installation de GestAssoPhp+Pg page 5 @copyright 2007-2020  (c) JC Etiemble HTML5 *}

    <div id="titre">&nbsp;{$messagetitre}</div>
	<div class="ligne_coul"></div>
	<div id="contenu">  {*défini le contenu .. *}

		<br />
 {* message erreur *}
 		{if $texterreurretour_ar}
		<div id="erreur-box">
			<br /><span class='erreur-Jaunerouge'>{$texterreurretour_ar}</span>
		</div>
		{/if}
 	<br /><br />


	 {if $confing_fin == "nonok"} {$message}
	 <br /><br /><br /><br />
	 <div class='login-box'><a href='index.php'><span class='submit_nul' title='Annuler'>Annuler</span></a></div>
	 {else}
		<span class='TextevertGras'>L'installation est termin&eacute;e..</span>
		<br /><br /><br />
		<span class='TextenoirGras'>Changez les permissions </span>(suivant hébergement par exemple)<br />
		- &agrave; 755 sur le r&eacute;pertoire <span class='TextenoirGras'>{$configuration_rep}</span>,<br />
		- &agrave; 644 ou 444 sur le fichier <span class='TextenoirGras'>{$configuration}</span>,<br />
		Consulter &eacute;ventuellement votre h&eacute;bergeur pour ces permissions
		<span class='TextenoirGras'>pour des raisons de s&eacute;curit&eacute;.</span> <br />
		<br /><br />
		<span class='TextenoirGras'>Les pr&eacute;f&eacute;rences association :</span><br />
		*  Pr&eacute;f&eacute;rence Association     <br />* D&eacute;tail des d&eacute;signations des activit&eacute;s  <br />* D&eacute;tail des types de cotisations<br />
		<span class='TextenoirGras'>sont configurables</span> <a href="http://gestassophp.free.fr/cms/index.php/gestassophp/administration/preferences.html" target="_blank" title="Site Web - Préférences de l'association (ouverture dans un nouvel onglet)">dans le menu Administration/Pr&eacute;f&eacute;rences</a> information sur la page Web.
		<br /><br />
		<span class='TextenoirGras'>Lisez attentivement les aides des différentes pages ou consulter le site Web  <a href="http://gestassophp.free.fr/" target="_blank" title="Site Web - Connexion (ouverture dans un nouvel onglet)">gestassophp</a></span><br /><br />
		<span class='TexterougeGras'>Par s&eacute;curit&eacute;, avant votre premi&egrave;re connexion &agrave; l'espace, renommer  ou supprimer le r&eacute;pertoire /install.</span>

		<br /><br />
		Vous pouvez vous connectez &agrave; votre espace <a href="../index.php" title="Connexion">GestAssoPhp</a>, et mettre votre fiche personnelle &agrave; jour (Gestion Membres / Mes informations)
	<br /><br /><br /><br />

	 {/if}
	<br /><br />

</div>{* Fin défini le contenu .. *}


