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
 *  Directory :  /ROOT_DIR_GESTASSO/install/
 *   Fichier :
 *   Installation du système
 * ENCODAGE UTF-8 sans BOM
*/


	include '../config/connexion.cfg.php'; // fichier de configuration
	include 'include_install.php';  // les variables + les définitions de répertoires
	
	$erreur_saisie = array();// tableau
	
// On modifie le repertoire de Smarty pour .....	
	define('TEMPLATES_LOCATION_INSTAL', join_path(ROOT_DIR_GESTASSO,'install' ) ); // repertoire Fichiers des templates Installation
	$tpl = new Smarty; //instance de Smarty pour scripts PHP	
//	$tpl->compile_dir = TMP_TEMPLATES_C_LOCATION ;// répertoire par défaut de compilation = templates_c 
//	$tpl->template_dir = TEMPLATES_LOCATION; // répertoire par défaut des templates = templates
//  verson 3.x
	$tpl->setCompileDir (TMP_TEMPLATES_C_LOCATION) ;// répertoire par défaut de compilation = templates_c // Smarty version 3.x
	$tpl->setTemplateDir (TEMPLATES_LOCATION); // répertoire par défaut des templates = templates // Smarty version 3.x
//echo TEMPLATES_LOCATION_INSTAL;
// OPTIONS	
	$tpl->error_reporting = E_ALL & ~E_NOTICE;

	if (isset($_POST['valid3'])) {	 // on arrive de la page 3 .tpl en direct
		$ok_valid=(get_post_variable('valid3','')); // vérifie que c'et bien la page 3 qui a été envoyée		
		if ($ok_valid != 'valid3') {
			header('location: index.php');		
		}
		
	}

	$masession = new sessions(); // -->la classe session
		//Gestion erreur retour arrière depuis page 5
		if ( isset($_SESSION['id_install2']) && $_SESSION['id_install2'] == '1') {
			$texterreurretour_ar = 'Op&eacute;ration retour arri&egrave;re INTERDITE !';
			header('location: install_5.php?id_adht=1&e_rar='.$texterreurretour_ar);
					exit;
		}

/***** Si on validé le Formulaire  par le bouton Valider  */
	if (isset($_POST['valid4'] )) { // on a validé la page 4 .tpl

		$ok_valid4=(get_post_variable('valid4',''));		
		// -- Récuprération des variable du formulaire ---
		$adherent['login_adht'] = (get_post_variable ('login_adht',''));				
			if ($adherent['login_adht'] =='') {
				$erreur_saisie ['login'] = 'Indiquez un login';
			} else {
				if (is_valid_mylogin($adherent['login_adht']) ==  false) {	
					$erreur_saisie ['login'] ='Login entre 4 et 20 caract&egrave;res ou caract&egrave;res invalides !';
				} else {
					$adherent['login_adht'] = strtoupper(get_post_variable ('login_adht',''));// MAJUSCULES	ou Majuscules+Minuscules
				}		
			}				
			
		$adherent['email_adht'] = strtolower(trim(get_post_variable ('email_adht','')));// enléve les parasites	
		if 	($adherent['email_adht'] !=='') {
			if (!is_valid_email($adherent['email_adht'])) {
				$erreur_saisie ['email'] = 'Attention adresse email Non valide';
			}	
		}
		// Si Non vide on modifiera le mot de passe
		$adherent['pass_adht1'] = get_post_variable ('pass_adht1','');
		$adherent['pass_adht2'] = get_post_variable ('pass_adht2','');			
		$pass=''; // le password				
	    if ( ($adherent['pass_adht1'] !='' && $adherent['pass_adht2'] !='')  ) {
			if ($adherent['pass_adht1'] == $adherent['pass_adht2']) { // si les 2 mots de psse sont identiques
				if (is_valid_mypasswd($adherent['pass_adht2']) ==  false) {						
					$erreur_saisie ['mdp'] = 'Mot de passe entre 4 et 16 caract&egrave;res ou caract&egrave;res invalides !';
					// vérification lettre-chiffre ET  Nb caractéres ente 4 et 10->16 
				} else {
					// Modif POUR adminsalt Nouvelle installation à compter de la 5.2.0
					$salt = substr(str_shuffle("23456789ABCDEFGHJKMNPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz@#$%^&*"),0,16);// + 5.2.0		
					$pass_adht= md5($salt.$adherent['pass_adht1']);// on code en MD5
				}
			} else { //	si les 2 mots sont différents 
			  $erreur_saisie ['mdp'] = 'Les 2 mots de passe ne sont pas identiques'; 
			}
		} else {
			$erreur_saisie ['mdp'] = 'Indiquez un mot de passe'; 
		}
		
		$adherent['nom_adht']= (strtoupper(stripslashes(get_post_variable('nom_adht',''))));	//
			if ($adherent['nom_adht'] =='') {
				$erreur_saisie ['nom'] = 'Indiquez le Nom';
			}		
		$adherent['prenom_adht']= stripslashes(get_post_variable('prenom_adht',''));
			if ($adherent['prenom_adht'] =='') {
				$erreur_saisie ['pnom'] = 'Indiquez le Pr&eacute;nom';
			}			
					
		// TABLES définir les noms	
		define('TABLE_ADHERENTS', DB_PREFIX.'adherent');	
		define('TABLE_LOGS', DB_PREFIX.'logs');			//
		define("TABLE_PREFERENCES", DB_PREFIX.'preference_asso'); // Table  Pour lire les preference_asso + 5.2.0		
		
		if (count($erreur_saisie)== 0  && $ok_valid4 == 'valid4') { // si pas erreur Et  on a validé la page 4 .tpl	
			$date_du_jour=date('Y-m-d');// la date du jour
		// Si Aucune erreur de saisie ON Valide lesdonnées
				$adherent['nom_adht']= addslashes($adherent['nom_adht']); // ajoute \ si on a fait une erreur	
				$adherent['prenom_adht']= addslashes($adherent['prenom_adht']); // ajoute \ si on a fait une erreur					
		// Connexion à la  base données			
			$db = ADONewConnection(TYPE_BD); //crée une connexion  Strict Standards: Only variables should be assigned by reference SUPRESSION de & devant &ADONewConnection
				if(!@$db->Connect(SERVEUR_BD, NOMUTILISATEUR_BD, MOTPASSE_BD, NOM_BD)) die("S&eacute;lection de la base de donn&eacute;es impossible !!!");				


			//Modif POUR admin salt Nouvelle installation à compter de la 5.2.0
			$req_ecrit_salt= "INSERT INTO ".TABLE_PREFERENCES." (id_pref, design_pref, val_pref)"
			." VALUES('8','sitemask','$salt')";
			$dbresult = $db->Execute($req_ecrit_salt);
			// (9, 'jma_fin_cotis','31/12/2011');  V 5.5.0	
			$req_ecrit_nouvel_adht= "INSERT INTO ".TABLE_ADHERENTS." (prenom_adht,nom_adht,email_adht,"
			." datecreationfiche_adht,"
			." login_adht,password_adht,priorite_adht,antenne_adht,qui_enrg_adht)" //V3  + antenne + qui_enrg_adht

			." VALUES( '$adherent[prenom_adht]','$adherent[nom_adht]','$adherent[email_adht]',"
			." '$date_du_jour',"
			." '$adherent[login_adht]','$pass_adht','9','1','1')";	// V3 + antenne + qui_enrg_adht				
			$dbresult = $db->Execute($req_ecrit_nouvel_adht);				
				
			$id_adht = my_last_id('id_adht',TABLE_ADHERENTS);// on récupere le N° de la derniere Insertion		
		//ecrit qui a fait la manip			
			$ecritlog = $masession->write_log('Creation_Admin : '.$id_adht,$adherent['nom_adht'].' '.$adherent['prenom_adht']);	
			$_SESSION['id_install2'] = $id_adht;	
					
		// on passe à la page suivante
			header('location: install_5.php?id_adht='.$id_adht); 
		}
			
		// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE				
		$tpl->assign('data_adherent',$adherent);// on réaffiche les informations dans le formulaire de saisie
		$tpl->assign('erreur_saisie',$erreur_saisie);// on affiche les erreurs de saisie dans le formulaire de saisie
		
/***** FIN Si on validé le Formulaire  par le bouton Valider  */
	} 
	

/***** ---------------------------------------------------------------------- */		
	// Préparation pour Affichage partie Fixe VERS TEMPLATE	 	
	$tpl->assign('version_i',VERSION_I); // version installateur	
    $tpl->assign('style_i',STYLE_I); //  Feuille de syle  style_screen.css ou m_style_screen.css
	$tpl->assign('messagetitre','Cr&eacute;ation des information de connexion'); // titre de la  page
	$tpl->assign('Etape1','Etape 1 - OK'); // menu	
	$tpl->assign('Etape2','Etape 2 - OK'); // menu	
	$tpl->assign('Etape3','Etape 3 - OK'); // menu	
	$tpl->assign('Etape4','<span class="TextenoirGras">Etape 4</span>'); // menu	
	$tpl->assign('titre','Etape 4'); // Titre de la page	
	$tpl->assign('Etape5','<span class="TextenoirR">Etape 5</span>'); // menu
	$tpl->assign('erreur_saisie',$erreur_saisie); // Erreur de saisie			
		
	$content = $tpl->fetch('install_4.tpl'); // On affiche ...	
	$tpl->assign('content',$content);		
	$tpl->display('index_instal.tpl');	

?>	
