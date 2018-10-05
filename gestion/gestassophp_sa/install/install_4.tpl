 {* Installation de GestAssoPhp+Pg page 4 copyright 2007-2018  (c) JC Etiemble HTML5*}

    <div id="titre">&nbsp;{$messagetitre}</div>
	<div class="ligne_coul"></div> 	
	<div id="contenu">  {*défini le contenu .. *}
	
	<br />
 {if $erreur_saisie|@count != 0}   {* message erreur *}
		<div id="erreur-box"> Erreur de saisie

		</div>	
 {/if}	
 	<br />

Choisissez le Login, l'adresse email et le mot de passe pour votre compte d'administration.<br />Veuillez vous assurer que vous enregistrez ces donn&eacute;es &quot;quelque part",<br /> car il sont indispensables pour l'acc&egrave;s &agrave; votre syst&egrave;me d'administration...<br />
<span class="TextenoirR">(Vous pourrez modifier ces informations apr&eacute;s votre connexion &agrave; GestAssoPhp)</span>
	<br /><br />
	<form method="post" name="installation" action="install_4.php">
	<table  style="width:98%;">

		<tr>
			<th class="LignegrisRight"  style="width:25%;">Login :</th>		
			<td><input type="text" name="login_adht" id="login_adht" title=" Le Login (entre 4 et 20 caractères autorisés A à Z, 0 à 9 et _ - ) sera créé en Majuscules automatiquement - Attention -" value="{$data_adherent.login_adht}"  size="32"  maxlength="50" tabindex="1"/>{if $erreur_saisie.login} <span class="erreur-Jaunerouge">{$erreur_saisie.login}</span>{/if}</td>
		</tr>
		<tr>		
			<td colspan ="2"><span class="TexterougeR">Le Login (entre 4 et 20 caract&egrave;res autoris&eacute;s A &agrave; Z, 0 &agrave; 9 et _ - ) sera cr&eacute;&eacute; en Majuscules automatiquement')</span></td>
		</tr>
		<tr>
			<th class="LignegrisRight">Adresse email :</th>		
			<td><input type="text" name="email_adht" id="email_adht" title="Votre adresse email " value="{$data_adherent.email_adht}" size="32"  maxlength="50" tabindex="2"/> {if $erreur_saisie.email} <span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.email}</span>{/if}</td>
		</tr>
		<tr>
			<th class="LignegrisRight">Mot de passe :</th>		
			<td><input type="password" name="pass_adht1" id="pass_adht1" title="Mot de passe entre 4 et 16 caractères autorisés a/A à z/Z, 0 à 9 et _ - " value="{$data_adherent.pass_adht1}" size="32"  maxlength="50" tabindex="3"/>{if $erreur_saisie.mdp} <span class="erreur-Jaunerouge">{$erreur_saisie.mdp}</span>{/if}</td>
		</tr>
		<tr>
			<th class="LignegrisRight">Mot de passe encore :</th>		
			<td><input type="password" name="pass_adht2" id="pass_adht2" title="Mot de passe entre 4 et 16 caractères autorisés a/A à z/Z, 0 à 9 et _ -" value="{$data_adherent.pass_adht2}" size="32"  maxlength="50" tabindex="4"/></td>
		</tr>
		<tr>		
			<td colspan ="2"><span class="TexterougeR">Mot de passe entre 4 et 16 caract&egrave;res autoris&eacute;s a/A &agrave; z/Z, 0 &agrave; 9 et _ -</span></td>
		</tr>		
		<tr>		
			<td colspan ="2">&nbsp;</td>
		</tr>	
		<tr>
			<th class="LignegrisRight">Nom :</th>		
			<td><input type="text" name="nom_adht" id="nom_adht" title="Votre Nom" value="{$data_adherent.nom_adht}" size="32"  maxlength="50" tabindex="5" /> {if $erreur_saisie.nom != ""} <span class="erreur-Jaunerouge">{$erreur_saisie.nom}</span>{/if}</td>
		</tr>
		<tr>
			<th class="LignegrisRight">Pr&eacute;nom :</th>		
			<td><input type="text" name="prenom_adht" id="prenom_adht" title="Votre Prénon" value="{$data_adherent.prenom_adht}" size="32"  maxlength="50" tabindex="6"/> {if $erreur_saisie.pnom != ""} <span class="erreur-Jaunerouge">{$erreur_saisie.pnom}</span>{/if}</td>
		</tr>		
		<tr>		
			<td colspan="2">&nbsp;</td>
		</tr>
	
		<tr>
			<th colspan="2">
			<input type='submit' class='submit_ok' name='Continuer' value='Continuer' title='Continuer'/>
			<input type='hidden' name='valid4' value='valid4'/>		
		</th>
		</tr>
     </table></form>

</div>{* Fin défini le contenu .. *}

    
