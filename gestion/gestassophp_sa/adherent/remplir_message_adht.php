<?php
/**
 * Projet : gestassophp_sa [GestAssoPhp+Pg]
 * ---------------------------
 * Licence Creative Commons selon les termes du présent contrat appelé Contrat Public Creative Commons 
 * Auteur original : Jean-Claude Etiemble
 * @link :  http://creativecommons.org/licenses/by-sa/2.0/fr/  - Paternité - Partage à l'Identique 2.0 France (CC BY-SA 2.0)
 * ---------------------------
 *	
 * @author : JC Etiemble - http://jc.etiemble.free.fr
 * @version :  2014
 * @copyright 2007-2014  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */
 
/**
 *  Directory :  /ROOT_DIR_GESTASSO/adherent/
 *   Fichier :
 *   Faire un message pour envoi par mail
 *  Seul Priorité   >= 5  peut faire un message
*/

include_once '../config/connexion.php';
$masession = new sessions(); // -->la classe session 	//session_start();
	
// Si pas de session ...		
$sessionadherent=(empty($_SESSION['ses_id_adht'])) ? $sessionadherent='' :$sessionadherent = $_SESSION['ses_id_adht'];

// on récupère le email_adht et le password correspondant au numéro de session en cours	
$logpass=$masession->verifie_LogingPaswd_bd($sessionadherent);
$log = $logpass[0];
$pas = $logpass[1];
	
// vérification de l'authenticité du visiteur	
if (($sessionadherent) && $log == ($_SESSION['ses_login_adht']) && $pas == ($_SESSION['ses_paswd_adht'])) {
/***** ici commence le code en cas d'authentification */

	$priorite_adht = $_SESSION['ses_priorite_adht'];
	$prenom_adht = $_SESSION['ses_prenom_adht']; //  pour affichage
	$nom_adht = $_SESSION['ses_nom_adht'] ; //  pour affichage

	// Raz de variables
	$id_adht = ''; //RAZ
	//Tableau xpour affichage
	$adherent = array(); // Tableau $adherent[champ de la table]  passage des data vers TPL
	$emmeteur = array();
	$required = array(); // Champs Obligatoires à saisir
	$erreur_saisie = array(); //Erreur si  Champs Obligatoires à saisir
	// initialisation
	$dateh_du_jour=date('Y-m-d H:i');// la date du jour 
	

	/***** Si ADMINISTRATEUR donc $priorite_adht >4  DROIT DE CONSUTER ET MODIFIER   */
		if ($priorite_adht >= 5 ) { // AUTORISATION		
			$id_adht = get_post_variable_numeric('id_adht', '');// l'id de la personne destinataire
			$affiche_message =' -&nbsp;(<span class="Texterouge">'._LANG_MESSAGE_MODIF.'</span>)'; // ENVOI  Message
			$disabled = array (  //   pour afficher "disabled" les champs non modifiables du formulaire
				'email_adht' => 'disabled="disabled"',
				'email_emmet'=> 'disabled="disabled"'
			);
			
		}else { // Pas d'AUTORISATION
		$id_adht = $sessionadherent; // Cas erreur
		// Message erreur PAS LE DROIT
		header('location: ../adherent/gerer_fiche_adht.php'); 
		}	
		

/***** Si on validé le Formulaire  par le bouton Valider  */
	if (isset($_POST['valid'])) {

		// -- Récuprération des variable du formulaire ---
		$adherent['email_adht'] = get_post_variable ('email_adht','');// enléve les parasites		
		$email_emmet  = get_post_variable ('email_emmet','');
		$email_sujet = get_post_variablehtml ('email_sujet',''); // htmlspecialchars($_GET[$nom_var], ENT_QUOTES);
		$email_message  =  (get_post_variablehtml ('email_message',''));
		$pnom_admin = get_post_variable ('pnom_admin','');
		$id_adht = get_post_variable ('id_adht','');
//echo "id_adht=".$id_adht."<br />";	
//echo "email_adht=".$adherent[email_adht]."<br />email_emmet=".$email_emmet."<br />email_sujet=".$email_sujet."<br />email_message=".$email_message."<br />pnom_admin=".$pnom_admin;
		
		if 	($email_sujet =='') {
				$erreur_saisie ['email_sujet'] = _LANG_MESSAGE_REMPLIR_ERR_SUJET_MAIL ;
		}
		
		if 	($email_message =='') {
				$erreur_saisie ['email_message'] = _LANG_MESSAGE_REMPLIR_ERR_MESSAGE_MAIL ;
		}		
		
			if (count($erreur_saisie)==0) {
			// Si Aucune erreur de saisie ON Valide le 
/*
http://www.vulgarisation-informatique.com/mail.php
Cc: : cet en-tête permet de spécifier les autres destinataires qui recevront le mail en Cc (Carbon copy), c'est à dire que tous les destinataires pourront voir à qui le message a été transmis.
On l'utilise comme ceci : Cc: email1,email2,email3...
Bcc: : cet en-tête permet de spécifier les autres destinataires qui recevront le mail en Bcc (Blind carbon copy), c'est à dire que les destinataires ne pourront pas voir à qui le message a été transmis, il s'agit d'une copie cachée.
On l'utilise comme ceci : Bcc: email1,email2,email3...
Content-Type : cet en-tête permet de spécifier le type mime du mail et son charset (jeu de caractères).
Content-Transfer-Encoding : cet en-tête permet de spécifier l'encodage du mail ou de l'une de ses parties (utile dans le cas d'un envoi texte+html par exemple). Il peut par exemple prendre les valeurs 7 et 8 bit (l'encodage 7 bit étant utilisé dans les pays anglophones n'ayant pas besoin de gérer les lettres accentuées).
*/
				// -- Mail headers
				 $headers = 'From: '.$pnom_admin."<".$email_emmet.">\r\n";
				 $headers .= 'Bcc: '.$email_emmet . "\r\n"; //  Cc ou Bcc copie envoyer à l'emetteur du message pour information 
			     $headers .= 'Reply-To:'. $email_emmet. "\r\n";
			     $headers .= 'Content-Type: text/plain; charset="'._LANG_CHARSET.'"'."\n"; 
			     $headers .= 'Content-Transfer-Encoding: 8bit';
	 
				// -------- To			
				$to =$adherent['email_adht'] ; //destinataire
				// -------------------------- SUJET --------------	
				//http://de3.php.net/manual/fr/function.htmlspecialchars-decode.php
				$subject =  htmlspecialchars_decode($email_sujet , ENT_QUOTES);  // ENT_QUOTES	Convertira les guillemets et les apostrophe
				// -------- Message
				$email_message =  htmlspecialchars_decode($email_message, ENT_QUOTES);				
				
					if (@mail($to, $subject, $email_message. " \n\n GestAssoPhp Emis le : "
					.($dateh_du_jour)." par IP : ".$_SERVER["REMOTE_ADDR"] . " Navigateur : ".$_SERVER["HTTP_USER_AGENT"], $headers)) {

				// si mail  OK	
					$ecritlog = $masession->write_log('Mailto_Adht : '.$id_adht, addslashes($nom_adht).' '.addslashes($prenom_adht));					
					// on retourne à la page générale
					header('location: gerer_fiche_adht.php?id_adht='.$id_adht."&mail=Ok"); 	//mail envoyé			

				} else { // si mail NON OK
		
				//message 'erreur			
					header('location: gerer_fiche_adht.php?id_adht='.$id_adht."&mail=0"); 			
			
				}
			
			}
		//header('location: remplir_message_adht.php?id_adht='.$id_adht); 		
	//renvoi champs	Si ERREUR
		$tpl->assign('email_sujet',$email_sujet);
		$tpl->assign('email_message',$email_message);
		
/***** FIN Si on validé le Formulaire  par le bouton Valider  */
	} 
/***** Sinon on affiche les données du destinataire*/	

		// préparation des données pour affichage
		$req_lire_infogene_adht = "SELECT civilite_adht,nom_adht, prenom_adht, email_adht"
		." FROM  ".TABLE_ADHERENTS." WHERE "
		." id_adht='$id_adht' ";
		$dbresult_adht = $db->Execute($req_lire_infogene_adht);
		
		// On récupere les données de la requette sous forme de tableau  $adherent["Nom_du_Champs_Table"]
		$adherent = $dbresult_adht->FetchRow();
		$tpl->assign('data_adherent',$adherent);

		//Qui est l'emmeteur du message
		$req_lire_nom_emmeteur = "SELECT prenom_adht,nom_adht, email_adht"
		." From ".TABLE_ADHERENTS." WHERE id_adht='$sessionadherent'";	
//echo $req_lire_nom_emmeteur ;
		$dbresult_emmeteur = $db->Execute($req_lire_nom_emmeteur);		
		$tpl->assign('email_emmet',$dbresult_emmeteur->fields['email_adht']);
		$tpl->assign('pnom_admin',$dbresult_emmeteur->fields['prenom_adht']." ".$dbresult_emmeteur->fields['nom_adht']);		
		
/***** FIN Sinon on affiche la fiche la première fois avant modifications */		
			
	
	
/***** ---------------------------------------------------------------------- */		
	// Préparation pour Affichage partie Fixe VERS TEMPLATE	 	
	$tpl->assign('version',VERSION); // Version de Gestasso
	$tpl->assign('nom_asso_gestassophp',NOM_ASSO_GESTASSOPHP); // le Nom de l'association				
	$tpl->assign('messagetitre',MESSAGETITRE); // Titre Bandeau haut
	$tpl->assign('priorite_adht',$priorite_adht); //  priorite_adht du connecté
	$tpl->assign('nomprenom_adht',$prenom_adht.' '.$nom_adht);
	// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE		
	$tpl->assign('id_adht',$id_adht);			
	$tpl->assign('required',$required); // Variables Obligatoires
	$tpl->assign('erreur_saisie',$erreur_saisie); // Erreur de saisie sur champs Obligatoires		
	$tpl->assign('disabled',$disabled); // pour afficher "disabled" les zones non modifiables du formulaire
	$tpl->assign('affiche_message',$affiche_message); // pour afficher	
	//POUR  AFFICHAGE VERS TEMPLATE			
	$content = $tpl->fetch('adherent/remplir_message_adht.tpl'); // On affiche ...	
	$tpl->assign('content',$content);		
	$tpl->display('page_index.tpl');	


} else { /***** il y a une erreur ... Si erreur  on envoie vers la page de login ... avec message */	
	header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR);  
}

?>
    
