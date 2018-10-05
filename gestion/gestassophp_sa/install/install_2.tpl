 {* Installation de GestAssoPhp+Pg page 2 copyright 2007-2018  (c) JC Etiemble HTML5*}

    <div id="titre">&nbsp;{$messagetitre}</div>
	<div class="ligne_coul"></div> 	
	<div id="contenu">  {*défini le contenu .. *}
	<br />
 {if $erreur_saisie|@count != 0}
		<div id="erreur-box"> Erreur de saisie
			{if $erreur_saisie.serveur_bd} <br /><span class='erreur-Jaunerouge'>{$erreur_saisie.serveur_bd}</span>{/if}
			{if $erreur_saisie.nom_bd} <br /><span class='erreur-Jaunerouge'>{$erreur_saisie.nom_bd}</span>{/if}				
			{if $erreur_saisie.utilis_bd} <br /><span class='erreur-Jaunerouge'>{$erreur_saisie.utilis_bd}</span>{/if}	
			{if $erreur_saisie.motpas_bd} <br /><span class='erreur-Jaunerouge'>{$erreur_saisie.motpas_bd}</span>{/if}	
			{if $erreur_saisie.prefix_bd} <br /><span class='erreur-Jaunerouge'>{$erreur_saisie.prefix_bd}</span>{/if}	
			{if $erreur_saisie.connexion} <br /><span class='erreur-Jaunerouge'>{$erreur_saisie.connexion}</span>{/if}
			{if $erreur_saisie.connexionb} <br /><span class='erreur-Jaunerouge'>{$erreur_saisie.connexionb}</span>{/if}				
		</div>	
 {/if}	
	<br />
	<span class='TextenoirGras'>Cr&eacute;er les tables dans la base de donn&eacute;es.</span><br />
	<span class='TextenoirGras'>Vous disposez du support de base de donn&eacute;es :<br />
	- {$mysql_bd}<br />
    - {$pgsql_bd}</span><br /><br />
	<span class='TextenoirGras'>Assurez vous que la base de donn&eacute;es existe bien  !!!</span> <br />
	<span class='erreur-Jaunerouge'>(Si vous r&eacute;installez, sauvegarder vos anciennes donn&eacute;es !)</span><br />puis,
	<br />
	compl&eacute;ter les champs suivants :
	<br /><br />
	<form method="post" name="installation" action="install_2.php">	
	<table style="width:98%;">
	
		<tr>
			<th class="LignegrisRight" style="width:45%;">Type de base de donn&eacute;es :</th>		
			<td>
			{html_options name="type_bd" options=$list_type_bd selected=$config_bd.type_bd title="Choix MySQLi, ou PostgreSQL "}	
			</td>
		</tr>
		<tr>
			<th class="LignegrisRight">Addresse du serveur de base de donn&eacute;es :</th>		
			<td><input type="text" name="serveur_bd" id="serveur_bd" title="Exemple localhost " value="{$config_bd.serveur_bd}" size="32"  maxlength="50" tabindex="2"/></td>
		</tr>
		<tr>
			<th class="LignegrisRight">Nom de la base de donn&eacute;es :</th>		
			<td><input type="text" name="nom_bd" id="nom_bd" title="Exemple ma_bdase" value="{$config_bd.nom_bd}" size="32"  maxlength="50" tabindex="3"/></td>
		</tr>
		<tr>
			<th class="LignegrisRight">Nom d'utilisateur :</th>		
			<td><input type="text" name="utilis_bd" id="utilis_bd" title="Exemple root" value="{$config_bd.utilis_bd}" size="32"  maxlength="50" tabindex="4"/></td>
		</tr>
		<tr>
			<th class="LignegrisRight">Mot de passe :</th>		
			<td><input type="password" name="motpas_bd" id="motpas_bd" title="Exemple ******" value="{$config_bd.motpas_bd}" size="32"  maxlength="50" tabindex="5"/></td>
		</tr>		
		<tr>
			<th class="LignegrisRight">Pr&eacute;fix des tables :</th>		
			<td><input type="text" name="prefix_bd" id="prefix_bd" title="Exemple g1_" value="{$config_bd.prefix_bd}" size="32"  maxlength="50" tabindex="6"/></td>
		</tr>		
		
		<tr>	
			<th class="LignegrisRight">Attention si coch&eacute; <span class='erreur-Jaunerouge'>Effacement des tables et données</span> :</th>				
			<!--td><input type="checkbox" name="drop_bd" id="drop_bd" {if $config_bd.drop_bd == 'on'} checked="checked" {/if} title="Attention!" />
			</td --> 
				<td><input type="checkbox" name="drop_bd" id="drop_bd"  {if $config_bd.drop_bd == 'on'}  checked="$config_bd.drop_bd" {/if} title="Attention!" />
			</td>		
		</tr>		
		<tr>		
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<th colspan="2">
			<input type="submit" class="submit_ok" name="Continuer" value="Continuer" title="Continuer"/>				
			<input type="hidden" name="valid2" value="valid2"/>
		</th>
		</tr>
     </table></form>

</div>{* Fin défini le contenu .. *}

    
