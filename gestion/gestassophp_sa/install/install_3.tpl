 {* Installation de GestAssoPhp+Pg page 3 copyright 2007-2014  (c) JC Etiemble HTML5*}

    <div id="titre">&nbsp;{$messagetitre}</div>
	<div class="ligne_coul"></div> 	
	<div id="contenu">  {*défini le contenu .. *}
	<br /><br />
  
   {* message erreur création config *}
	{if $valid_file_config == "non"}<span class='erreur-Jaunerouge'> {$message_file_config} </span>
  	<br /><br /><br />
	{/if}
   {* Fin message erreur création config  STOP *}	
 
   	{if $valid_file_config == "oui"}
	<span class='TextenoirGras'>{$message_file_config}</span> {* message OK création config *}
	<br /><br /><br />
	{/if}	
 

	{if $valid_bd_config == "non"}
	 &nbsp;&nbsp;&nbsp;&nbsp;Installation tables <br />
	<span class='erreur-Jaunerouge'> {$message_bd_config} </span>	
	<br /><br /><br />
	<div class='login-box'><a href='index.php'><span class='submit_nul' title='Annuler'>Annuler</span></a></div>
	{/if}
   {* Fin message erreur création BD STOP *}

	{if $valid_bd_sql == "non"}<span class='erreur-Jaunerouge'>{$message_bd_config}</span><br />
		{foreach from=$message_bd item=item_message_bd key=ordre}
		{$item_message_bd}
		{/foreach}
	<br /><br /><br />	
	<div class="centre-txt"><br /><a href='index.php'><span class='submit_nul' title='Annuler'>Annuler</span></a><br /><br /></div>			
	{/if}	
   {* Fin message erreur création BD STOP *}	


	{if $valid_bd_sql =='oui'}  {* message OK création BD *}
		&nbsp;&nbsp;&nbsp;&nbsp;Installation tables <br />
		{foreach from=$message_bd item=item_message_bd key=ordre}
		{$item_message_bd}
		{/foreach}
  	<br /><span class='TextenoirGras'>{$message_bd_config}</span><br /><br />
	{/if}	
	
  	{if $valid_file_config == "oui" && $valid_bd_sql =='oui'}
		<br /><div class="centre-txt"><br /><form method="post" name="installation" action="install_4.php">{* passe à la page 4 direct *}
		<input type="submit" class="submit_ok" name="Continuer" value="Continuer" title="Continuer"/>
			<input type='hidden' name='valid3' value='valid3'/>	
		</form><br /></div> 
	{/if}	 

</div>{* Fin défini le contenu .. *}

    