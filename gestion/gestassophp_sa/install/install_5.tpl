 {* Installation de GestAssoPhp+Pg page 5 copyright 2007-2014  (c) JC Etiemble HTML5*}

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
 	<br /><br /><br />

	
	 {if $confing_fin == "nonok"} { $message}
	 <br /><br /><br /><br />
	 <div class='login-box'><a href='index.php'><span class='submit_nul' title='Annuler'>Annuler</span></a></div>
	 {else}
		L'installation est termin&eacute;e..	
		<br /><br /><br /> 
		Changez les permissions<br /> 
		- &agrave; 755 sur le r&eacute;pertoire {$configuration_rep},<br />
		- &agrave; 644 ou 444 sur le fichier {$configuration},<br /><span class='TextenoirGras'>pour des raisons de s&eacute;curit&eacute;</span> <br />
		<br /><br /> 
		<span class='TextenoirGras'>Les pr&eacute;f&eacute;rences association : 	<br />
		*  Pr&eacute;f&eacute;rence Association     * D&eacute;tail des d&eacute;signation des activit&eacute;s  * D&eacute;tail des types de cotisations<br />
		sont modifiables dans le menu Administration / Pr&eacute;f&eacute;rences</span><br />
		<span class='TexterougeGras'>par s&eacute;curit&eacute;, avant votre premi&egrave;re connexion &agrave; l'espace, supprimer ou renommer le r&eacute;pertoire /install.</span>

		<br /><br /> 
		Vous pouvez vous connectez &agrave; <a href="../index.php" title="Connexion">GestAssoPhp</a>, et mettre votre fiche personnelle &agrave; jour (Gestion Membres / Mes informations)
	<br /><br />	 

	 {/if}
	
	
</div>{* Fin défini le contenu .. *}

    