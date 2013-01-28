 {* Installation de GestAssoPhp_s p5 version :  2010  copyright 2007-2010  (c) JC Etiemble *}

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
		L'installation est terminée..	
		<br /><br /><br /> 
		Changez les permissions<br /> 
		- à 755 sur le repertoire {$configuration_rep},<br />
		- à 644 ou 444 sur le fichier {$configuration},<br /><span class='TextenoirGras'>pour des raisons de sécurité</span> <br />
		<br /><br /> 
		<span class='TextenoirGras'>Les préférences association : 	<br />
		*  Préférence Association     * Détail des désignation des activités  * Détail des types de cotisations<br />
		sont modifiables dans le menu Administration / Préférences</span><br />
		<span class='TexterougeGras'>par sécurité, avant votre première connexion à l'espace, supprimer ou renommer le répertoire /install.</span>

		<br /><br /> 
		Vous pouvez vous connectez à <a href="../index.php" title="Connexion">GestAssoPhp</a>, et mettre votre fiche personnelle à jour (Gestion Membres / Mes informations)
	<br /><br />	 

	 {/if}
	
	
</div>{* Fin défini le contenu .. *}

    