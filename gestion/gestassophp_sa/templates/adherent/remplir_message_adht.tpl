{* Projet : gestassophp_sa [GestAssoPhp+Pg] copyright 2007-2017 (c) JC Etiemble HTML5*}
{* Affichage du CONTENU avec AIDE Rempir information générale *}
	<header class="header_titre_aide"><a href='#' style="cursor:pointer;cursor:hand" onclick="javascript :window.open('../aide/a_adht_remplir_message_adht.php','popup','height=200,toolbar=no,location=no,directories=no,status=yes,width=660,resizable=no,scrollbars=yes,top=10,left=10')" title="{language name=title_aide}"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20"/>{language name=aide}</a></header> 

    <header class="header_titre">&nbsp;{language name=titre_mailto_adht}</header>
	<div class="ligne_coul"></div> 	
	<div id="contenu"> {*défini le contenu .. *}
 	<br />
{if !empty($erreur_saisie)}
	{if $erreur_saisie|@count != 0}
		<div id="erreur-box"> {language name=tpl_texte_err_saisie}
		</div>	
	{/if}	
{/if}		
{* Form .. *}
	    <form method="post" name="maform" action="remplir_message_adht.php">
    	<table style="width:98%;">
		<tr>		
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>		
		<tr>
			<th class="LignegrisRight"> {language name=mailto_dest_adht} &nbsp;&nbsp; </th>		
			<td><input type="text" name="email_adht" id="email_adht" title="{language name=fiche_adht_mail_title}" value="{$data_adherent.email_adht}" size="65"  maxlength="50" tabindex="1" {$disabled.email_adht} /></td>
		</tr>
		<tr>
			<th class="LignegrisRight"> {language name=mailto_emmet_adht} &nbsp;&nbsp;</th>		
			<td><input type="text" name="email_emmet" id="email_emmet" title="{language name=fiche_adht_web_title}" value="{$email_emmet}" size="65"  maxlength="50" tabindex="2" {$disabled.email_emmet} /></td>
		</tr>
		<tr>
			<th class="LignegrisRight_Oblig"> {language name=mailto_sujet_adht} &nbsp;&nbsp;</th>		
			<td><input type="text" name="email_sujet" id="email_sujet" title="{language name=message_remplir_err_sujet_mail}" value="{$email_sujet}" size="65"  maxlength="50" tabindex="3" />{if $erreur_saisie.email_sujet} <span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.email_sujet}</span> {/if}</td>
		</tr>
			<tr> 
			<th class="LignegrisRight_Oblig">{language name=mailto_message_adht} &nbsp;&nbsp;</th>  
		<td><textarea cols="80" rows="10" name="email_message" id="email_message" title="{language name=message_remplir_err_message_mail}"  tabindex="4">{$email_message}</textarea>{if $erreur_saisie.email_message}<br /> <span class="erreur-Jaunerouge">&nbsp;{$erreur_saisie.email_message}</span> {/if}</td>
		</tr>	
		<tr>		
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>		
			<td class="TexterougeR">&nbsp;&nbsp;&nbsp;{language name=tpl_texte_oblig}</td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<th colspan="2">
			<input type="submit" class="submit_ok" name="Valider" value="{language name=language name=tpl_enoyermail_button}" title="{language name=language name=tpl_enoyermail_button_title}"/>
			
			<input type="hidden" name="valid" value="valid"/>
			<input type="hidden" name="id_adht" value="{$id_adht}"/>
			<input type="hidden" name="email_adht" value="{$data_adherent.email_adht}"/>	
			<input type="hidden" name="email_emmet" value="{$email_emmet}"/>				
			<input type="hidden" name="pnom_admin" value="{$pnom_admin}"/>			
			<a href="../adherent/gerer_fiche_adht.php?id_adht={$id_adht}"><span class="submit_nul" title="{language name=tpl_cancel_button_title}">{language name=tpl_cancel_button}</span></a>			
			</th>
		</tr>
     </table></form>
{* Fin Form .. *}		 
	 

		
	 
	</div> {* / défini le contenu .. *} 
