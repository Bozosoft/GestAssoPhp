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
 * @version :  2018
 * @copyright 2007-2018  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */
 
/**
 *  Directory :  /ROOT_DIR_GESTASSO/adherent/
 *   Fichier :
 *   Modifier ou Créer les informations générales de l'adhérent
 *  Seul l'admin Priorité = 9 peut aussi modidier Login et Mot de passe 
*/

include_once '../config/connexion.php';
$masession = new sessions(); // -->la classe session 	//session_start();
	
// Si pas de session ...		
$sessionadherent=(empty($_SESSION['ses_id_adht'])) ? $sessionadherent='' :$sessionadherent = $_SESSION['ses_id_adht'];

// on récupère le login et le password correspondant au numéro de session en cours	
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
	
	$photo_adht = _LANG_MESSAGE_REMPLIR_NOPHOTO; // par défaut pas de photo	
	//$required ['non_visible_adht_creation_fiche'] = ''; // +  qui a enregistré la fiche 	
	$del_photo = '' ;
	$qui_enrg_adht ='' ;
	$affiche_message = '';
	//Tableau xpour affichage
	$adherent = array(); // Tableau $adherent[champ de la table]  passage des data vers TPL
	$required = array(); // Champs Obligatoires à saisir
	$erreur_saisie = array(); //Erreur si  Champs Obligatoires à saisir
	$disabled  = array();
	
	$disabled['prenom_adht'] ='';//RAZ
	$disabled['nom_adht'] ='';//RAZ
	$disabled['promotion_adht'] ='';//RAZ // Ajouté N° adhésion/Licence
	$required ['creation_adht'] = 0; //RAZ pour création Nouvel adhérent
	
	// initialisation
	$date_du_jour=date('Y-m-d');// la date du jour //Pour définir la différence entre 2  dates	
	

	/***** Si ADMINISTRATEUR donc $priorite_adht >4  DROIT DE CONSUTER ET MODIFIER   */
		if ($priorite_adht > 4 ) {
			$id_adht = get_post_variable_numeric('id_adht', '');// l'id de la personne de la fiche infogénérales
			$affiche_message =' -&nbsp;(<span class="Texterouge">'._LANG_MESSAGE_MODIF.'</span>)'; // Modification
			
			/***** SEUL L'admin = 9 a le droit de modifier les Noms et Prénoms */	
			if ($priorite_adht < 8 ) {
				$disabled = array (  //   pour afficher "disabled" les champs non modifiables du formulaire si admin =9
					'nom_adht' => 'disabled="disabled"',
					'prenom_adht' => 'disabled="disabled"',
					'promotion_adht' => 'disabled="disabled"',	//Ajouté N° adhésion/Licence		
				);			
				$required ['non_visible_adht_creation_fiche'] = '1'; // +  qui a enregistré la fiche 
							// déplacer ici $tpl->assign('non_
				$tpl->assign('non_visible_adht_creation_fiche',$required ['non_visible_adht_creation_fiche']); // +  qui a enregistré la fiche 	
			}
			if ( $id_adht=='') { //  On crée un nouvel adhérent
				$required ['creation_adht'] = 1; // il faut créer un Login et Mot de passe ++
				$affiche_message =' -&nbsp;(<span class="Texterouge">'._LANG_MESSAGE_CREATE.'</span>)';
				$disabled = array (  //   pour enlever "disabled" les champs Noms et Prénoms du formulaire pour la création 
					'nom_adht' => '',
					'prenom_adht' => ''
				);	
			} else {
				$required ['creation_adht'] = 0; //modification seulement // dessous déplacé
			}
		} else {
			$id_adht = $sessionadherent;
			$disabled = array (  //   pour afficher "disabled" les champs non modifiables du formulaire
				'nom_adht' => 'disabled="disabled"',
				'prenom_adht' => 'disabled="disabled"',
				//'antenne_adht' => 'disabled="disabled"',
				'antenne_adht' => '1',
				//'tranche_age' => 'disabled="disabled"',	
				'tranche_age' => '1',
				'promotion_adht' => 'disabled="disabled"',	//Ajouté N° adhésion/Licence
			);
			$required ['non_visible_adht_creation_fiche'] = '1'; //  qui a enregistré la fiche 			
			$tpl->assign('non_visible_adht_creation_fiche',$required ['non_visible_adht_creation_fiche']); //  qui a enregistré la fiche 	
		}
	

	
/***** SI SUPPRESSION DE LA PHOTO */	
	if ( isset($_REQUEST['del_photo']))  $del_photo=$_REQUEST['del_photo'] ;

	if($del_photo)
	{
 		@unlink(DIR_PHOTOS . "/" . $id_adht . ".jpg");
 		@unlink(DIR_PHOTOS . "/" . $id_adht . ".gif");
 		@unlink(DIR_PHOTOS . "/tn_" . $id_adht . ".jpg");
 		@unlink(DIR_PHOTOS . "/tn_" . $id_adht . ".gif");	
	}	
	
/***** SI SUPPRESSION DE LA PHOTO */

/***** Si on validé le Formulaire  par le bouton Valider  */
	if (isset($_POST['valid'])) {
		
		/***** on enregistre la photo */
		if (isset($_FILES['photo'])) 
		if ($_FILES['photo']['tmp_name'] !='')
		if (is_uploaded_file($_FILES['photo']['tmp_name'])) { 
			if ($_FILES['photo']['type']=="image/jpeg" || $_FILES['photo']['type']=="image/pjpeg"||
			    (function_exists("ImageCreateFromGif") && $_FILES['photo']['type']=="image/gif")) {
				//$tmp_name = $HTTP_POST_FILES["photo"]["tmp_name"];  // 30/05/2008  $HTTP_POST_FILES -> $_FILES
				$tmp_name = $_FILES['photo']['tmp_name'];		
				// extension du fichier (en fonction du type mime)  ////////// pjpeg POUR IE 7 sait as lire les jpeg !!!!!!
				if ($_FILES['photo']['type']=="image/jpeg"  || $_FILES['photo']['type']=="image/pjpeg") {
					$ext_image = ".jpg";
				}	
				if ($_FILES['photo']['type']=="image/gif") {
					$ext_image = ".gif";
				}
				
				// suppression ancienne photo au cas ou !!!!
				@unlink(DIR_PHOTOS . "/".$id_adht.".jpg");
				@unlink(DIR_PHOTOS . "/".$id_adht.".gif");
				@unlink(DIR_PHOTOS . "/tn_".$id_adht.".jpg");
				@unlink(DIR_PHOTOS . "/tn_".$id_adht.".gif");
						
				// copie fichier temporaire			 		
				if (!@move_uploaded_file($tmp_name,DIR_PHOTOS."/".$id_adht.$ext_image)) {
					$photo_adht = _LANG_MESSAGE_REMPLIR_NOPHOTO;					
					$erreur_saisie ['photo'] = _LANG_MESSAGE_REMPLIR_ERR_PHOTO;
			 	} else {
					resizeimage(DIR_PHOTOS."/".$id_adht.$ext_image,DIR_PHOTOS . "/tn_".$id_adht.$ext_image,66,94);// rétaillée  a 66 de larg et/ou 94 de haut
					}	
		 	} else {			
				//if (function_exists("imagegif")) {	
					$photo_adht = _LANG_MESSAGE_REMPLIR_NOPHOTO ;
					$erreur_saisie ['photo'] = _LANG_MESSAGE_REMPLIR_ERR_FICH_PHOTO ; 
					//}	
			}
		} /*****FIN on enregistre la photo */

	
		// -- Récupération des variables du formulaire ---
		//htmlspecialchars / htmlentities
		$adherent['civilite_adht']= get_post_variable('civilite','');
		$adherent['datenaisance_adht']= (get_post_variable('datenaisance_adht',''));	// jj/mm/aaaa
		$adherent['adresse_adht']= stripslashes(get_post_variablehtml('adresse_adht','')); // elnlève \  si on a fait une erreur
		$adherent['cp_adht']= get_post_variablehtml('cp_adht','');
		$adherent['ville_adht']= stripslashes(get_post_variablehtml('ville_adht','')); // enlève \ si on a fait une erreur
		$adherent['telephonef_adht'] = NumTel(get_post_variable ('telephonef_adht','')); //03 81 5 1 45 78
		$adherent['telephonep_adht'] =  NumTel(get_post_variable ('telephonep_adht','')); //03 81 5 1 45 78
		$adherent['telecopie_adht'] =  NumTel(get_post_variable ('telecopie_adht','')); //03 81 5 1 45 78
		$adherent['email_adht'] = strtolower(trim(get_post_variable ('email_adht','')));// enléve les parasites		
		$adherent['siteweb_adht'] = get_post_variablehtml('siteweb_adht',''); // ****
		$adherent['disponib_adht']= stripslashes(get_post_variablehtml('disponib_adht','')); // enlève \ si on a fait une erreur

		$adherent['profession_adht']= stripslashes(get_post_variablehtml('profession_adht',''));		// ajout V 7
		$adherent['autres_info_adht']= stripslashes(get_post_variablehtml('autres_info_adht',''));		// ajout V 7
		
		// Suivant  $priorite_adht  Modifiable ou NON
		$adherent['nom_adht']= strtoupper(stripslashes(get_post_variablehtml('nom_adht','')));	// - stripslashes
		$adherent['prenom_adht']= stripslashes(get_post_variablehtml('prenom_adht',''));	 // + stripslashes		
		$adherent['id_type_antenne'] = get_post_variable_numeric('id_type_antenne_adht',''); //---->RECUPERE ID  id_type_antenne
		//$adherent[tranche_age] = get_post_variable ('tranche_age','');		
		$adherent['tranche_age'] = get_post_variable ('tranche_age_adht',''); // ESSAI  html_options name="tranche_age_adht"
		$adherent['visible_adht'] = get_post_variable ('visible_adht','');
		$adherent['qui_enrg_adht'] = get_post_variable_numeric('id_adht_modif_creation_fiche', '');// Id du nouvel adhérent modificateur de la fiche
		$adherent['promotion_adht']= stripslashes(get_post_variablehtml('promotion_adht',''));

		// si autorisation de modifier ET saisi obligatoire on controle
		if ($disabled['prenom_adht'] !=='disabled="disabled"' && $disabled['nom_adht'] !=='disabled="disabled"'){
			if ($adherent['nom_adht'] =='') {
				$erreur_saisie ['nom'] = _LANG_MESSAGE_REMPLIR_PRENOM;
			}
			if ($adherent['prenom_adht'] =='') {
				$erreur_saisie ['pnom'] = _LANG_MESSAGE_REMPLIR_PRENOM ;
			}	
		}
					
		if 	($adherent['datenaisance_adht'] !=='') {
			if (( check_madateFR($adherent['datenaisance_adht']) )== TRUE) {
				$adherent['datenaisance_adht_sql']= switch_date($adherent['datenaisance_adht']) ; // --> 1948-02-21
			} else {
			$adherent['datenaisance_adht_sql'] = 'null';
				$erreur_saisie ['d_nais'] = _LANG_MESSAGE_REMPLIR_ERR_DATENAIS ;
			}
		}				
		if ($adherent['cp_adht'] =='') {
			$erreur_saisie ['cp'] = _LANG_MESSAGE_REMPLIR_CP ;
		}
		if ($adherent['ville_adht'] =='') {
			$erreur_saisie ['ville'] = _LANG_MESSAGE_REMPLIR_VILLE;
		}
		// Contrôlle email  NE PAS FAIRE  TOUT LE MONDE n'a pas d'adresse  mail
/*		
		if 	($adherent[email_adht] == '') {
				$erreur_saisie [email] = _LANG_MESSAGE_REMPLIR_ERR_MAIL ;
		}		
*/		
		if 	($adherent['email_adht'] !=='') {
			if (!is_valid_email($adherent['email_adht'])) {
				$erreur_saisie ['email'] = _LANG_MESSAGE_REMPLIR_ERR_MAIL ;
			}	
		}
		
		// cas si Admin =9 possible modifier LOGIN
		if ($priorite_adht == 9  && $required ['creation_adht'] ==''){	
			$adherent['login_adht'] = (get_post_variable ('login_adht',''));				
			if ($adherent['login_adht'] =='') {
				$erreur_saisie ['login'] = _LANG_MESSAGE_REMPLIR_LOGIN; 
			} else {
				if (is_valid_mylogin($adherent['login_adht']) ==  false) {		
				// vérification lettre-chiffre ET Nb caractéres suivant fonction.php				
					$erreur_saisie ['login'] = _LANG_MESSAGE_REMPLIR_ERR_LOGIN;
				} else {
					$adherent['login_adht'] = strtoupper(get_post_variable ('login_adht',''));// MAJUSCULES	 ou Majuscules+Minuscules
				}		
			}					
		}			
	
		// Si Non vide on modifiera le mot de passe - modification 10 à 16 caractères 09/02/18
		$adherent['pass_adht1'] = get_post_variable ('pass_adht1','');
		$adherent['pass_adht2'] = get_post_variable ('pass_adht2','');
		$pass =''; // le password	
	    if ( ($adherent['pass_adht1'] !='' && $adherent['pass_adht2'] !='') || ($required ['creation_adht'] == 1) ) {
			if ($adherent['pass_adht1'] == $adherent['pass_adht2']) { // si les 2 mots de passe sont identiques
				if (is_valid_mypasswd($adherent['pass_adht2']) ==  false) {			
					$erreur_saisie ['mdp'] = _LANG_MESSAGE_REMPLIR_ERR_PASSW ;
				// vérification lettre-chiffre ET Nb caractéres suivant fonction.php				
				} else {
				$pass_adht= md5($adherent['pass_adht1']);// on code en MD5 
				// modif si Salt
					if (defined('SITEMASK')) { // Retourne TRUE si le nom de la constante fournie a été définie
						$pass_adht = md5(SITEMASK.$adherent['pass_adht1']);
					} 
				$pass ='OK'; //++
				}
			} else { //	si les 2 mots sont différents 
			  $erreur_saisie ['mdp'] = _LANG_MESSAGE_REMPLIR_ERR_2PASSW ; 
			}
		}
		// si mdp 2 est vide pas d'erreur !!!

		
		/*****  On crée un  nouvel adhérent */
		if ( $required ['creation_adht'] == 1) {	
			$adherent['tranche_age'] = get_post_variable ('tranche_age_adht',''); // ESSAI  html_options name="tranche_age_adht"			
			$adherent['login_adht'] = (get_post_variable ('login_adht',''));				
			if ($adherent['login_adht'] == '') {
				$erreur_saisie ['login'] = _LANG_MESSAGE_REMPLIR_LOGIN; 
			} else {	
				if (is_valid_mylogin($adherent['login_adht']) ==  false) {		
				// verification lettre-chiffre ET Nb caractéres suivant fonction.php	
					$erreur_saisie ['login'] = _LANG_MESSAGE_REMPLIR_ERR_LOGIN;
				} else {
					$adherent['login_adht'] = strtoupper(get_post_variable ('login_adht',''));// MAJUSCULES	ou Majuscules+Minuscules
				}		
			}	
				
	//  validation si login+pass n’existe pas
			if ( !(!empty($erreur_saisie ['login'])) && !(!empty($erreur_saisie ['mdp'])) ) {
				if (! loginpass_unique ($adherent['login_adht'], $pass_adht)) {
					$erreur_saisie ['login'] = _LANG_MESSAGE_REMPLIR_ERR_LOGINPASSWD ;
				}
			}	
	//   Fin validation si login+pass n’existe pas	
			
			$adherent['date_inscription_adht'] = (get_post_variable ('date_inscription_adht',''));//26/07/2007
			// Vérifie la date entrée  si OK passe de jj/mm/aaaa  au format aaaa-mm-jj Sinon ERREUR
				if (( check_madateFR($adherent['date_inscription_adht']) )== TRUE) {
					$adherent['date_inscription_adht_sql']= switch_date($adherent['date_inscription_adht']) ;
				} else {
					$erreur_saisie ['d_inscript'] = _LANG_MESSAGE_REMPLIR_ERR_DATEINSCRIP ;
				}
			
			if (count($erreur_saisie)==0) {
			// Si Aucune erreur de saisie ON Valide le Nouvel adhérent
				// ajoute \ si on a fait une erreur
				$adherent['adresse_adht'] = addslashes($adherent['adresse_adht']); 
				$adherent['ville_adht']= addslashes($adherent['ville_adht']); // ajoute \ si on a fait une erreur
				$adherent['nom_adht']= addslashes($adherent['nom_adht']); // ajoute \ si on a fait une erreur
				$adherent['prenom_adht']= addslashes($adherent['prenom_adht']); // ajoute \ si on a fait une erreur ++
				$adherent['disponib_adht']= addslashes($adherent['disponib_adht']); // ajoute \ si on a fait une erreur ++	
				$adherent['profession_adht']= addslashes($adherent['profession_adht']); // ajout V 7
				$adherent['autres_info_adht']= addslashes($adherent['autres_info_adht']); // ajout V 7
				$adherent['promotion_adht']= addslashes($adherent['promotion_adht']);	// Ajouté N° adhésion/Licence	
				//requete				
				$req_ecrit_nouvel_adht= "INSERT INTO ".TABLE_ADHERENTS." (civilite_adht,"
				." prenom_adht,nom_adht,datenaisance_adht,"
				." adresse_adht,"
				." cp_adht,ville_adht,"
				." telephonef_adht,telephonep_adht,"
				." telecopie_adht,email_adht,siteweb_adht,"
				." datecreationfiche_adht,antenne_adht,tranche_age,visibl_adht,"
				." disponib_adht," 
				." promotion_adht,"
				." profession_adht, autres_info_adht," // ajout V 7
				." login_adht,password_adht,qui_enrg_adht)" // +  qui a enregistré la fiche  qui_enrg_adht ' lors du 1er enregistrement  		
		
				." VALUES('$adherent[civilite_adht]',"
				." '$adherent[prenom_adht]','$adherent[nom_adht]'" ;
				//NULL values pour dates vide = NUL	
				if 	($adherent['datenaisance_adht'] =='') { 
					$req_ecrit_nouvel_adht.=" ,NULL" ;
				} else {
					$req_ecrit_nouvel_adht.=" ,'$adherent[datenaisance_adht_sql]'" ;
				}					
				$req_ecrit_nouvel_adht.=", '$adherent[adresse_adht]',"
				." '$adherent[cp_adht]','$adherent[ville_adht]',"
				." '$adherent[telephonef_adht]','$adherent[telephonep_adht]',"
				." '$adherent[telecopie_adht]','$adherent[email_adht]','$adherent[siteweb_adht]',"
				." '$adherent[date_inscription_adht_sql]','$adherent[id_type_antenne]',"
				." '$adherent[tranche_age]','$adherent[visible_adht]',"
				." '$adherent[disponib_adht]',"	
				." '$adherent[promotion_adht]',"
				." '$adherent[profession_adht]','$adherent[autres_info_adht]'," // ajout V 7
				." '$adherent[login_adht]','$pass_adht','$sessionadherent')"; //   qui a enregistré = '$sessionadherent' lors du 1er enregistrement	
				$dbresult = $db->Execute($req_ecrit_nouvel_adht);					
//echo 'rq='.$req_ecrit_nouvel_adht;					
	
				$id_adht = my_last_id('id_adht',TABLE_ADHERENTS);// on récupere le N° de la derniere Insertion
				//ecrit qui a fait la manip			
				$ecritlog = $masession->write_log('Creation_Adht : '.$id_adht, addslashes($nom_adht).' '.addslashes($prenom_adht));										
				// on retourne à la page générale
				header('location: gerer_fiche_adht.php?id_adht='.$id_adht); 
			}
			/***** FIN On crée un  nouvel adhérent */	

		} else {  /*****   adhérent existant on Update simplement */			
			if (count($erreur_saisie)==0) {	  
			// Si Aucune erreur de saisie Udpate 
		
				$adherent['adresse_adht'] = addslashes($adherent['adresse_adht']); 
				$adherent['ville_adht']= addslashes($adherent['ville_adht']); // ajoute \ si on a fait une erreur
				$adherent['nom_adht']= addslashes($adherent['nom_adht']); // ajoute \ si on a fait une erreur
				$adherent['disponib_adht']= addslashes($adherent['disponib_adht']); // ajoute \ si on a fait une erreur ++	
				$adherent['profession_adht']= addslashes($adherent['profession_adht']); // ajout V 7
				$adherent['autres_info_adht']= addslashes($adherent['autres_info_adht']); // ajout V 7
				
				$req_ecrit_modif_adht="UPDATE ".TABLE_ADHERENTS
				." SET civilite_adht='$adherent[civilite_adht]',"
				." adresse_adht='$adherent[adresse_adht]', cp_adht='$adherent[cp_adht]',"
				." ville_adht='$adherent[ville_adht]', telephonef_adht='$adherent[telephonef_adht]',"
				." telephonep_adht='$adherent[telephonep_adht]',"
				." telecopie_adht='$adherent[telecopie_adht]', email_adht='$adherent[email_adht]', "
				."siteweb_adht='$adherent[siteweb_adht]',"
				." visibl_adht='$adherent[visible_adht]',"
				." disponib_adht='$adherent[disponib_adht]',"
				." profession_adht='$adherent[profession_adht]', autres_info_adht='$adherent[autres_info_adht]', " // ajout V 7
				." datemodiffiche_adht='$date_du_jour'";
				//NULL values pour dates vide = NUL					
				if 	($adherent['datenaisance_adht'] =='') { 
					$req_ecrit_modif_adht.=" , datenaisance_adht = NULL" ;
				} else {
					$req_ecrit_modif_adht.=" , datenaisance_adht='$adherent[datenaisance_adht_sql]'" ;
				}

				if ($priorite_adht >= 5 ){
				$req_ecrit_modif_adht.= ", antenne_adht='$adherent[id_type_antenne]', tranche_age='$adherent[tranche_age]'";
				}
				
				// Modification ou création du mot de passe si NON VIDE
				if ((!$adherent['pass_adht1']) == '' && (!$adherent['pass_adht2']) == '' && ($pass == 'OK')) {  //++
					$req_ecrit_modif_adht.= ", password_adht='$pass_adht'" ;
				}				
				// si admin =9 modification possible Login   // +  qui a enregistré la fiche 
				if ($priorite_adht == 9 ){
					$req_ecrit_modif_adht.= ", prenom_adht='$adherent[prenom_adht]', nom_adht='$adherent[nom_adht]'";
					$req_ecrit_modif_adht.= ",login_adht = '$adherent[login_adht]'";
					$req_ecrit_modif_adht.= ",qui_enrg_adht = '$adherent[qui_enrg_adht]'";// +  qui a enregistré la fiche 
					$req_ecrit_modif_adht.= ",promotion_adht = '$adherent[promotion_adht]'"; //  Ajouté N° adhésion/Licence
					
				}
				// +++++
				$req_ecrit_modif_adht.= " WHERE id_adht='$id_adht'"; 				
				$dbresult = $db->Execute($req_ecrit_modif_adht);						
//echo 'rq='.$req_ecrit_modif_adht;

				//ecrit qui a fait la manip			
				$ecritlog = $masession->write_log('Modifie_Adht : '
				.$id_adht, addslashes($nom_adht).' '.addslashes($prenom_adht));	
			
				// on retourne à la page générale
				header('location: gerer_fiche_adht.php?id_adht='.$id_adht); 
			}
			} /*****  FIN adhérent existant on Update simplement */
			
		// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE				
		$tpl->assign('data_adherent',$adherent);// on réaffiche les informations dans le formulaire de saisie
		$tpl->assign('erreur_saisie',$erreur_saisie);// on affiche les erreurs de saisie dans le formulaire de saisie
		
/***** FIN Si on validé le Formulaire  par le bouton Valider  */
	} 
	
// Uniquement si on modifie donc si Nouvelle fiche On passe
		if ( $required ['creation_adht'] == 0) {
		/***** Sinon on affiche la fiche la première fois avant modifications */	
				// préparation des données pour affichage
				$req_lire_infogene_adht = "SELECT civilite_adht,nom_adht, prenom_adht, adresse_adht, cp_adht, ville_adht,"
				." telephonef_adht, telephonep_adht, telecopie_adht, email_adht, datecreationfiche_adht,"
				." antenne_adht, datenaisance_adht, visibl_adht, siteweb_adht,"
				." disponib_adht, " 
				." login_adht,priorite_adht, tranche_age, " 
				." profession_adht, autres_info_adht," // ajout V 7
				." qui_enrg_adht, id_type_antenne, nom_type_antenne, promotion_adht" 
				." FROM  ".TABLE_ADHERENTS.", ".TABLE_ANTENNE." WHERE " // + TABLE_ANTENNE
				." id_adht='$id_adht' AND antenne_adht=id_type_antenne "; //  ++ AND antenne_adht=id_type_antenne
		//	    $result_req_lire_infogene_adht = mysql_query($req_lire_infogene_adht );
				$dbresult = $db->Execute($req_lire_infogene_adht);	
				
				// On récupere les données de la requête sous forme de tableau  $adherent["Nom_du_Champs_Table"]	
				while (($adherent = $dbresult->FetchRow())) {
					// modifiaction affichage dates
					$adherent['datenaisance_adht'] = switch_sqlFr_date($adherent['datenaisance_adht']); 
					// Préparation pour Affichage partie variable en fonction des données
					$adherent['ville_adht'] = stripslashes($adherent['ville_adht']);
					$adherent['adresse_adht'] = stripslashes($adherent['adresse_adht']);
					$adherent['disponib_adht'] = stripslashes($adherent['disponib_adht']);
					$qui_enrg_adht = $adherent['qui_enrg_adht'] ; //+ qui a enrregistré la fiche
					// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE			
					$tpl->assign('data_adherent',$adherent);
				}

				//+  qui a enregistré la fiche
				$req_lire_nom_enregistrant = "SELECT prenom_adht,nom_adht"
				." From ".TABLE_ADHERENTS." WHERE id_adht='$qui_enrg_adht'";	
				$dbresult_enr = $db->Execute($req_lire_nom_enregistrant);	
				$tpl->assign('pnom_creation_fiche_adht', $dbresult_enr->fields['prenom_adht']." ".$dbresult_enr->fields['nom_adht']);			
				// fin +  qui a enregistré
				
				//-- Ajout de la Photo -- UNIQUEMENT JPG ou GIF
				$image_adht = '';
				if (file_exists(DIR_PHOTOS . "/tn_" . $id_adht . ".jpg")) { // F:\Sites\Test\fb\gestassophp\photos\tn_53.jpg
					$image_adht = "../photos/tn_" . $id_adht . ".jpg"; 
					//  http://localhost/Test/fb/gestassophp/photos/tn_53.jpg
					$image_adht_full = "../photos/" . $id_adht . ".jpg";
				}	
				elseif (file_exists(DIR_PHOTOS . "/tn_" . $id_adht . ".gif")) {
					$image_adht = "../photos/tn_" . $id_adht . ".gif";
					$image_adht_full = "../photos/" . $id_adht . ".gif";
				}

				if ($image_adht != "") { 
					if (function_exists("ImageCreateFromString")) { 
						$imagedata = getimagesize($image_adht); 
					} else {
						$imagedata = array("66","");
					}
					$photo_adht ="<img src=\"".$image_adht."?nocache".time()."\" alt=\""
					.("Photo")."\" width=\"".$imagedata[0]."\" height=\"".$imagedata[1]."\" />";                         
				} else {
					$photo_adht = _LANG_MESSAGE_REMPLIR_NOPHOTO;
				}
					//-- FIN Ajout de la Photo  --
	}
// FIN Uniquement si on modifie donc si Nouvelle fiche On passe	
	
	
	// Requête Pour affichage de la liste  Nom Prénom  Qui ont  priorite_adht > '4' //  qui a enregistré la fiche 
	$req_list_benevol = "SELECT id_adht,nom_adht,prenom_adht FROM "
	.TABLE_ADHERENTS."  WHERE soc_adht <> '999' AND priorite_adht > '4' ORDER BY  nom_adht asc ";	
	$dbresult = $db->Execute($req_list_benevol);	
    $tab_benevol = array('' => ( _LANG_ARRAY_SELECTIONNEZ_NOM));// ligne affichée si vide

	while ($dbresult && $row = $dbresult->FetchRow()) {
		// on construit le tableau ID=Nom Prénom 
		$tab_benevol[$row['id_adht']] =	htmlentities(stripslashes(strtoupper($row['nom_adht']).' '.$row['prenom_adht']),ENT_QUOTES,'UTF-8');
    }		
	// FINPour affichage de la liste  Nom Prénom  //   qui a enregistré la fiche 
	
	// Requête Pour affichage de la liste  nom_type_antenne
	$req_list_antenne = "SELECT id_type_antenne,nom_type_antenne FROM ".TABLE_ANTENNE;	
	$dbresult = $db->Execute($req_list_antenne);		
	while ($dbresult && $row = $dbresult->FetchRow()) {
		// on construit le tableau ID=nom_type_antenne
		$tab_antenne[$row['id_type_antenne']] =	htmlentities(stripslashes($row['nom_type_antenne']),ENT_NOQUOTES,'UTF-8');
    }		
 
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
	$tpl->assign('list_civilite',$T_CIVILITE);// tableau des civilités	
	//$tpl->assign('list_antenne_adht',$T_ANTENNE_ADHT);// antenne_adht  + 25/05/208
	$tpl->assign('list_antenne_adht',$tab_antenne);
	$tpl->assign('list_tranche_age_adht',$T_TRANCHE_AGE);// ESSAI  html_options name="tranche_age_adht"	
	$tpl->assign('list_oui_non',$T_OUI_NON); // selection Oui / Non
	$tpl->assign('date_dujour',switch_sqlFr_date($date_du_jour));// date du jour pour  Date d'inscription 		
	$tpl->assign('required',$required); // Variables Obligatoires
	$tpl->assign('erreur_saisie',$erreur_saisie); // Erreur de saisie sur champs Obligatoires		
	$tpl->assign('disabled',$disabled); // pour afficher "disabled" les zones non modifiables du formulaire
	$tpl->assign('photo_adht',$photo_adht); // Pour affichage de la Photo		
	$tpl->assign('listnoms',$tab_benevol); // la liste des noms des adhérents	 //   qui a enregistré la fiche 
	$tpl->assign('affiche_message',$affiche_message); // pour afficher	
	//POUR  AFFICHAGE VERS TEMPLATE			
	$content = $tpl->fetch('adherent/remplir_infogene_adht.tpl'); // On affiche ...	
	$tpl->assign('content',$content);		
	$tpl->display('page_index.tpl');	


} else { /***** il y a une erreur ... Si erreur  on envoie vers la page de login ... avec message */	
	header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR);  
}

?>
    
