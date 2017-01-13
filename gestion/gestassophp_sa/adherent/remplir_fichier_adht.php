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
 * @version :  2016
 * @copyright 2007-2016  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */
 
/**
 *  Directory :  /ROOT_DIR_GESTASSO/adherent/
 *   Fichier :
 *   Modifier la désignation ou l'adhérent d'un fichier - ou - Uploader un nouveau Fichier
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
	$id_adht = '' ;
	$required = '' ;
	$disabled = '' ;
	$modification_fichier = ''; 
	$upload_fichier = '';
	//Tableau xpour affichage		
	$erreur_saisie = array(); //Erreur si  Champs Obligatoires à saisir
	// initialisation
	$date_du_jour=date("Y-m-d");// la date du jour	//Pour définir la différence entre 2  dates
	
	
	/***** Si ADMINISTRATEUR donc $priorite_adht >4  DROIT DE CONSUTER ET MODIFIER     (4 n'a PAS le droit)	*/
	if ($priorite_adht >= 5 ) { // AUTORISATION
		$id_file_adht = get_post_variable_numeric('id_file_adht', '');// Vérifie l'id du fichier
			
		if ( $id_file_adht =='') { //  On va uploder un nouveau Fichier
			$upload_fichier = 1; // 				
			$affiche_message =' -&nbsp;(<span class="Texterouge">'._LANG_MESSAGE_FILE_UPLOAD.'</span>)';
			// si on vient de la liste adhérents
			$id_adht_file = get_post_variable_numeric('id_adht_file', '');// l'id du Nom adhérent
				$tpl->assign('id_adht_file',$id_adht_file);	// id de l'adhérent pour la sélection du nom dans la liste déroulante					
		} else { // on modifie seulement
			$modification_fichier = 1; // On autorise la modification
			$affiche_message =' N&deg; '
			.$id_file_adht.' -&nbsp;(<span class="Texterouge">'._LANG_MESSAGE_MODIF.'</span>)';
				
			// préparation des données pour affichage la première fois avant modifications
			$req_lire_info_fichier= "SELECT id_adht_file,nom_file_adht,design_file_adht,date_file_adht,qui_file_adht From "
			.TABLE_FICHIER_ADHERENTS." WHERE id_file_adht='$id_file_adht'";	
			$dbresult_fichier = $db->Execute($req_lire_info_fichier);	
			
	        //affiche les variables de la ligne 
	        $id_adht_file = $dbresult_fichier->fields['id_adht_file'];			
	        $nom_fichier = ($dbresult_fichier->fields['nom_file_adht']);	
	        $descript_fichier = stripslashes($dbresult_fichier->fields['design_file_adht']);
			$date_file_adht = switch_sqlFr_date($dbresult_fichier->fields['date_file_adht']);
			$qui_file_adht = $dbresult_fichier->fields['qui_file_adht'];	
			
			// qui a déposé le fichier +++++
			$req_lire_nom_deposant = "SELECT prenom_adht,nom_adht"
			." From ".TABLE_ADHERENTS." WHERE id_adht='$qui_file_adht'";			
			$dbresult_nom = $db->Execute($req_lire_nom_deposant);				
			// Préparation pour Affichage partie variable en fonction des données
			$tpl->assign('id_adht_file',$id_adht_file);	// id de l'adhérent pour la sélection du nom dans la liste déroulante		
			$tpl->assign('nom_fichier',$nom_fichier); // Le nom du fichier
			$tpl->assign('descript_fichier',$descript_fichier); // Description du fichier			
			$tpl->assign('date_file_adht',$date_file_adht);	// Date  de 1er upload 	
			$tpl->assign('id_file_adht',$id_file_adht); // Id du fichier	
			$tpl->assign('nom_qui_file_adht',$dbresult_nom->fields['prenom_adht']." ".$dbresult_nom->fields['nom_adht']); // Nom du déposant du fichier				
		}
					
	}else { // Pas d'AUTORISATION
		$id_adht = $sessionadherent; // Cas erreur
		// Message erreur PAS LE DROIT
		header('location: ../adherent/gerer_fiche_adht.php'); 
	} 

/***** Si on CONSULTE le fichier  supprimé  */	/*--------------------------------------*/

	$archive_file_adht = get_post_variable_numeric('archive_file_adht', '');
	if ( ($archive_file_adht == 1) && ($id_file_adht) ) {
		$disabled = array (  //   pour afficher "disabled" les champs non modifiables du formulaire		
			'nom_adht' => 'disabled="disabled"',
			//'Bénévole			
		);
		$affiche_message =' N&deg; '.$id_file_adht.
		' -&nbsp;(<span class="Texterouge">'._LANG_MESSAGE_FILE_CONSULT.'</span>)';
		$tpl->assign('archive_fiche',$archive_file_adht);// Pour consulter la fiche affiche le bouton Retour uniquement //****************
	}		

/***** FIN Si on CONSULTEle fichier  supprimé */		
						
/***** Si on validé le Formulaire  par le bouton Valider  */
	if (isset($_POST['valid'])) {

/***** SI Modification de la désignation ou de la destination fichier  d'un Fichier existant*/	
		if ($modification_fichier == 1) {
			$id_adht_modif = get_post_variable_numeric('id_adht_modif', '');// Id du nouvel adhérent selectionne si modification
			$id_adht_file = get_post_variable_numeric('id_adht_file', '');// l'id de l'adhérent initial qui avait le fichier

		    if (($modification_fichier == 1) && $id_adht_modif ) {
				$descript_fichier = addslashes(get_post_variablehtml('descript_fichier', ''));//+ addslashes 22/02 +get...html 03/03
		        $req_ecrit_modif_fichier = ("UPDATE ".TABLE_FICHIER_ADHERENTS
				." SET id_adht_file='$id_adht_modif',"
				." design_file_adht='$descript_fichier',datemodif_file_adht ='$date_du_jour' "
				." WHERE id_file_adht='$id_file_adht'");
				$dbresult = $db->Execute($req_ecrit_modif_fichier);
				
				//ecrit qui a fait la manip		
				$ecritlog = $masession->write_log("Modifie_Fichier_Adht : ".$id_adht_file."->"
				.$id_adht_modif, addslashes($nom_adht).' '.addslashes($prenom_adht));
			
			    if ($id_adht_file<>$id_adht_modif) {
					$affiche_message = '-&nbsp;(<span class="Texterouge">'
					._LANG_MESSAGE_FILE_ADHT_MOVE.' '.$id_adht_modif.'</span>)' ; //++++++++++++++++
					echo "<meta http-equiv='refresh' content='1;URL=liste_fichiers_adht.php'>";	
				} else {
				header('location: liste_fichiers_adht.php'); 
				}
			}
		}
/***** FIN Modification de la désignation ou de la destination fichier*/		

	
/***** AJOUT d'un nouveau fichier*/ // http://de3.php.net/manual/fr/features.file-upload.php

		if($upload_fichier == 1 ) {
	
			$id_adht_new = get_post_variable_numeric('id_adht_modif', '');// l'id du Nom adhérent
				if ($id_adht_new =='') {
					$erreur_saisie ['id_adht'] = _LANG_MESSAGE_FILE_ADHT_NAME; //++++++++++++
				}			
			$descript_fichier = stripslashes(get_post_variablehtml('descript_fichier', ''));// elnlève \ si on a fait une erreur			
			// on repsse les données pour REAFFICHAGE si ERREUR
			$tpl->assign('id_adht_file',$id_adht_new);// id de l'adhérent pour sélection  nom dans la liste déroulante	
			$tpl->assign('descript_fichier',$descript_fichier);//  Description du fichier		

			//  Test de validation pour les extentions Fichiers -  http://fr2.php.net/is_uploaded_file
			// Le "i" après le délimiteur du pattern indique que la recherche ne sera pas sensible à la casse
			if(preg_match("/\\.(exe|com|bat|js|php|php3|php4|php5|phtml|pl|cgi)$/i", $_FILES['monfichier']['name'])){
				$erreur_saisie ['pas_fichier'] = _LANG_MESSAGE_FILE_FILE_NOADMIT_ERROR;
			} 
			if (is_uploaded_file ($_FILES['monfichier']['tmp_name'])) {		
				// début test il y a un fichier -  on teste si le nom du fichier existe
				$lefile = ($_FILES['monfichier']['name']);				
				if (validname("$lefile")) {	// test si caractéres spéciaux					
					//on verifie la longeur du fichier
		
					if (strlen($lefile) < NB_CARRACT_FILE + 4) //25 + 4 extension Définit dans lang_fr.php					
					{
					
						//echo "test si le nom existe dans la base"; 
						$req_verif_fichier = "SELECT nom_file_adht FROM "
						.TABLE_FICHIER_ADHERENTS."  WHERE nom_file_adht='$lefile'";
						$dbresult_fichier = $db->Execute($req_verif_fichier);			
						//s'il n'y a pas de corespondance entre le nom du fichier et le nom prévu en Upload alors
						if ($nombre = ! $dbresult_fichier->RecordCount()) {
							// On insère ... dans la table ...     
							if (count($erreur_saisie)==0) {
							// Si Aucune erreur de saisie ON Valide 							
								$descript_fichier= addslashes($descript_fichier); // ajoute \ si on a fait une erreur							
								$req_ecrit_nouveau_fichier = "INSERT INTO " .TABLE_FICHIER_ADHERENTS
								." (nom_file_adht,id_adht_file,date_file_adht,design_file_adht,qui_file_adht )"
								. "VALUES ('{$_FILES['monfichier']['name']}','$id_adht_new',"
								."'$date_du_jour','$descript_fichier','$sessionadherent') ";								
								$dbresult = $db->Execute($req_ecrit_nouveau_fichier);								
								// Copie du fichier dans le répertoire ad Hoc le nom du fichier avec son extension
								copy($_FILES['monfichier']['tmp_name'], DIR_FILES_ADHTS.$_FILES['monfichier']['name']);  
								// on a transferé ET alors ... ecrit qui a fait la manip							
								$ecritlog = $masession->write_log("Creation_Adht_Fichier : ".$id_adht_new."->"
								.($_FILES['monfichier']['name']),$masession->get_var_session('ses_nom_adht')." "
								.$masession->get_var_session('ses_prenom_adht'));							
							}	
                                                       
						} else { //le  nom existe dans la base  erreur
						//echo "Erreur le fichier existe déja";
							$erreur_saisie ['fichier_existant'] = _LANG_MESSAGE_FILE_FILE_ERROR.' '
							. $lefile.' '._LANG_MESSAGE_FILE_FILE_EXIST_ERROR;
						}					
					} else { //fin test si le non est SUP à x carracteres          
						$erreur_saisie ['caract_sup_x'] = _LANG_MESSAGE_FILE_FILE_ERROR.' '. $lefile.' est trop long';
					}
				} else { //echo "<br/>carractéres Non valides";
					$erreur_saisie ['nonvalide_caract'] = _LANG_MESSAGE_FILE_FILE_ERROR.' '. $lefile.' contient
					des caractères NON valides ';
				}
				
				
			} else { // fin test test il y a un fichier				
				if ($_FILES['monfichier']['name']=="") {
					$erreur_saisie ['pas_fichier'] = _LANG_MESSAGE_FILE_NOFILE_ERROR;
				} elseif($_FILES['monfichier']['size']==0) {
					$erreur_saisie ['taille_fichier'] = _LANG_MESSAGE_FILE_FILE_TAILLE_ERROR
					. $_FILES['monfichier']['name']._LANG_MESSAGE_FILE_FILE_MAX_ERROR;
				}     
			}

				// Si Aucune erreur de saisie ON Valide --> Requette enregistrement nouvelle cotisation	
			if (count($erreur_saisie) == 0) {
				// on retourne à la page générale
				header('location: liste_fichiers_adht.php');
			}
						

		} 
			
/***** FIN  AJOUT d'un nouveau fichier*/			
	}
/***** FIN Si on validé le Formulaire  par le bouton Valider  */
		
	// Requette Pour affichage de la liste  Nom Prénom
	$req_list_benevol = "SELECT id_adht,nom_adht,prenom_adht FROM "
	.TABLE_ADHERENTS."  WHERE soc_adht <> '999' ORDER BY  nom_adht asc ";	//AND priorite_adht > '4'  ????
	$dbresult = $db->Execute($req_list_benevol);	
    $tab_benevol = array('' => ( _LANG_ARRAY_SELECTIONNEZ_NOM));// ligne affichée si vide
	while ($dbresult && $row = $dbresult->FetchRow()) {
		$tab_benevol[$row['id_adht']] =	htmlentities(stripslashes(strtoupper($row['nom_adht']).' '.$row['prenom_adht']),ENT_QUOTES, 'UTF-8');
    }	
	// FINPour affichage de la liste  Nom Prénom
				
		
/***** ---------------------------------------------------------------------- */	
	// Préparation pour Affichage partie Fixe VERS TEMPLATE
	$tpl->assign('version',VERSION); // Version de Gestasso
	$tpl->assign('nom_asso_gestassophp',NOM_ASSO_GESTASSOPHP); // le Nom de l'association				
	$tpl->assign('messagetitre',MESSAGETITRE); // Titre Bandeau haut	
	$tpl->assign('priorite_adht',$priorite_adht);
	$tpl->assign('nomprenom_adht',$prenom_adht.' '.$nom_adht);	
	$tpl->assign('id_adht',$id_adht);	
	// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE
	$tpl->assign('listnoms',$tab_benevol); // la liste des noms des adhérents	
	$tpl->assign('required',$required); // Variables Obligatoires
	$tpl->assign('erreur_saisie',$erreur_saisie); // Erreur de saisie sur champs Obligatoires		
	$tpl->assign('disabled',$disabled); // pour afficher "disabled" les zones non modifiables du formulaire
	$tpl->assign('affiche_message',$affiche_message); // pour afficher	
	//POUR  AFFICHAGE VERS TEMPLATE			
	$content = $tpl->fetch('adherent/remplir_fichier_adht.tpl'); // On affiche ...
	$tpl->assign('content',$content);
	$tpl->display('page_index.tpl');	

		
} else { /***** il y a une erreur ... Si erreur  on envoie vers la page de login ... avec message */		
	header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR);  
}
	
?>
    
