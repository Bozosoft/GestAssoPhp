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
 *   Modifier ou Créer les cotisations de l'adhérent
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
	$required ['creation_cotisation'] = 0; //RAZ pour création Nouvelle cotisation
	$required ['modification_cotisation'] = 0 ; //RAZ pour modification cotisation	
	$affiche_message = ''; // Raz message alerte	
	$indice = '' ;
	//Tableau xpour affichage
	$cotis_adh = array(); // Tableau $cotis_adht[champ de la table]  passage des data vers TPL
	$required = array(); // Champs Obligatoires à saisir
	$erreur_saisie = array(); //Erreur si  Champs Obligatoires à saisir
	$alert_saisie = array(); //message alerte
	$disabled = array ();
	// initialisation	
	$date_du_jour=date('Y-m-d');// la date du jour // aaa-mm-jj -->2007-08-08

	
	
//echo $priorite_adht;
	/***** Si ADMINISTRATEUR donc $priorite_adht >4  DROIT DE CONSUTER ET MODIFIER     (4 n'a PAS le droit)	*/
	if ($priorite_adht > 5 ) { // AUTORISATION
		$id_cotis_adht = get_post_variable_numeric('id_cotis', '');// l'id de la cotisation existante		
		if ( $id_cotis_adht !=='') { //  On  modifie la fiche cotisation
			$required ['modification_cotisation'] = 1; // 
			//   pour afficher "disabled" les champs non modifiables du formulaire
			$disabled = array ( 'date_enregist_cotis' => 'disabled="disabled"' ); //'nom_cotisant' => 'disabled="disabled"', // sur TPL
			$affiche_message =' N&deg; '
			.$id_cotis_adht.' -&nbsp;(<span class="Texterouge">'._LANG_MESSAGE_MODIF.'</span>)';	
// Vérifier si chevauchement de dates avant saisie
			// recupérer les données  ID adhérents et date Début Fin
			$req_lire_adhtasso = "SELECT id_adhtasso,date_debut_cotis, date_fin_cotis FROM "
			.TABLE_COTISATIONS." WHERE id_cotis ='$id_cotis_adht'" ;
			$dbresult_adhtasso = $db->Execute($req_lire_adhtasso);
			
			/***** Verifier si la date de Début est supérieure à 1 une date dans la BD  pour une Id_AdhtAsso */  //$dbresult_adhtasso->fields
			$req_lire_date_cotis = "SELECT id_cotis,date_debut_cotis, date_fin_cotis FROM "
			.TABLE_COTISATIONS." WHERE qui_cotis ='adh' "	
			." AND cotis='' AND	id_adhtasso='".$dbresult_adhtasso->fields['id_adhtasso']."' "
			." AND id_cotis != '$id_cotis_adht'"
			." AND ((date_debut_cotis >= '".$dbresult_adhtasso->fields['date_debut_cotis']
			."' AND date_debut_cotis < '".$dbresult_adhtasso->fields['date_fin_cotis']."') "
			." OR (date_fin_cotis > '".$dbresult_adhtasso->fields['date_debut_cotis']
			."' AND date_fin_cotis <= '".$dbresult_adhtasso->fields['date_fin_cotis']."'))";			

			$dbresult_date_cotis = $db->Execute($req_lire_date_cotis);
			$nb_date_cotiserreur = $dbresult_date_cotis->RecordCount() ;			
			
			if ($nb_date_cotiserreur >= 1){ // si 1 date au moins existe		
			$nuber_cotis =$dbresult_date_cotis->fields['id_cotis']; // le N° de la fiche qui donne Erreur	
			
			// si 1 date au moins existe		
				$alert_saisie['d_debut_cotis'] = _LANG_MESSAGE_COTIS_ADHT_ALERT_DEB_FIN
				.' '.switch_sqlFr_date($dbresult_adhtasso->fields['date_debut_cotis']).' '. _LANG_MESSAGE_COTIS_ADHT_ALERT_FICHE
				.' <a href="../adherent/remplir_cotisations_adht.php?id_cotis='
				.$nuber_cotis.'" target="_blank" title="!! Ouvrir la fiche dans une autre fenêtre !!">'.$nuber_cotis.'</a>';	
			}
// FIN -  Vérifier si chevauchement de dates

			
		} elseif ( $id_cotis_adht =='') { //  On crée une nouvelle fiche cotisation 
			// Eécupere l'Id pour le Nom prenom du Cotisant
			$cotis_adh['id_adhtasso'] = get_post_variable_numeric('id_adht_cotis', ''); 
			$required ['creation_cotisation'] = 1; // 	
			$required ['modification_cotisation'] = 0;
			$tpl->assign('data_cotis_adh', $cotis_adh); // si un nom est selectionné		Déplacé 	
			$disabled = array ('date_enregist_cotis' => ''); //   pour afficher le champ du formulaire					
			$affiche_message =' -&nbsp;(<span class="Texterouge">'._LANG_MESSAGE_CREATE.'</span>)';		
			/***** Verifier S'il n' y pas UNE AUTRE Cotis en cours dans la BD  pour une Id_AdhtAsso  */
			// counter le Nb de id_cotis avec  qui_cotis=adh	id_adhtasso=  Id du Cotisant
			$requete[1] = "SELECT id_cotis FROM "
			.TABLE_COTISATIONS." WHERE qui_cotis ='adh' "	
			." AND cotis='' AND	id_adhtasso='$cotis_adh[id_adhtasso]' ";
			
			// comptage des fiches
			$dbresult = $db->Execute($requete[1]); //Pour compter le NB d'enregistrements
//test si aucune cotisation de saisie
			if ($dbresult) {
				$nb_cotis = $dbresult->RecordCount() ; //Pour compter le NB d'enregistrements	
			}else {
				$nb_cotis = 0 ;
			}			
					
			if ($nb_cotis >= 1) {
				$alert_saisie['id_adhtasso'] = $nb_cotis ;
				// voir  les N°
					while ($dbresult && $row = $dbresult->FetchRow()) {					
					//affiche les variables de la ligne 
					$num_id_cotis[$indice]['id_cotis'] = $row['id_cotis']; //Nom 										
					$indice++;
				}
				$tpl->assign('num_id_cotis',$num_id_cotis); // tableau 
			}
// End afficher si déjà Cotis	


		}
	}else { // Pas d'AUTORISATION
		$id_adht = $sessionadherent; // Cas erreur
		// Message erreur PAS LE DROIT
		header('location: ../adherent/gerer_fiche_adht.php'); 
	} 
				


/***** Si on SUPPRIME la fiche cotisaton	*/

	$supp_fiche_cotis = get_post_variable_numeric('supp_fiche_cotis', '');
	if ( ($supp_fiche_cotis == 1) && ($id_cotis_adht) ) {
	// Verifier si la cotisation est échue !!
		$req_lire_info_cotis = "SELECT date_fin_cotis FROM ".TABLE_COTISATIONS." WHERE id_cotis='$id_cotis_adht' ";
		$dbresult_cotis = $db->Execute($req_lire_info_cotis);	
		
		if ($dbresult_cotis->fields['date_fin_cotis'] > $date_du_jour) {
			//$erreur_saisie ['d_fin_cotis'] = _LANG_MESSAGE_COTIS_ADHT_ALERT_ARCHIV;
			$alert_saisie ['d_fin_cotis_alert'] = 1 ;	// Pour  suppression du bouton	 Archiver la fiche	 ////////////////////////		
		}
			
		$affiche_message =' N&deg; '.$id_cotis_adht.' -&nbsp;(<span class="Texterouge">'._LANG_MESSAGE_COTIS_ADHT_ARCHIV.'</span>)';
		$tpl->assign('supprime_fiche',$supp_fiche_cotis);// Pour supprimer la fiche affiche le bouton Supprimer
		$tpl->assign('data_cotis_adh',$cotis_adh); // Pour supprimer la fiche  id_cotis
		$disabled = array (  //   pour afficher "disabled" les champs non modifiables du formulaire
			'date_enregist_cotis' => 'disabled="disabled"',
			//'nom_cotisant' => 'disabled="disabled"', // sur TPL
			'montant_cotis' => 'disabled="disabled"',
			//'id_type_cotisation'  => 'disabled="disabled"', // sur TPL
			'date_debut_cotis' => 'disabled="disabled"',
			'date_fin_cotis' => 'disabled="disabled"',
			'info_cotis' => 'disabled="disabled"'
		);			
	}
		
	if (isset($_POST['supp_valid'])) {
		
	// verifier si le champ info_archiv_cotis est rempli
		$cotis_adh['info_archiv_cotis']=(get_post_variable('info_archiv_cotis',''));	
		if ($cotis_adh['info_archiv_cotis'] =='') {
			$erreur_saisie ['info_archiv_cotis'] = _LANG_MESSAGE_COTIS_ADHT_RAISON_ARCHIV;
		}

		if (count($erreur_saisie)==0) {	
		//on SUPPRIME  .... en fait on met 999  dans le champ  Cotis + Date du jour dans DateModifFiche_Cotis  +++ le montant reste+++ POUR ARCHIVAGE
			$req_supp_cotis=("UPDATE ".TABLE_COTISATIONS." SET cotis='999',"
			." datemodiffiche_cotis='$date_du_jour' , info_archiv_cotis='$cotis_adh[info_archiv_cotis]'" 
			." WHERE id_cotis='$id_cotis_adht'");	
			$dbresult = $db->Execute($req_supp_cotis);
			
			// On récupere Id adht qui vient de la ligne cotisation  supprimée		
			$req_lire_info_idadht = "SELECT id_adhtasso FROM ".TABLE_COTISATIONS
			." WHERE id_cotis='$id_cotis_adht'";
			$dbresult = $db->Execute($req_lire_info_idadht);
			
			while ($dbresult && $row = $dbresult->FetchRow()) {	
				$id_result = $row['id_adhtasso']; // 
			}	
//--			
// verifier si il y a une autre cotisation pour le même adhérent $id_result V 5.5.0 + 5.5.1 AND cotis <> '999'
			$compt_adht_cotis = "SELECT id_cotis, date_fin_cotis"
			." FROM ".TABLE_COTISATIONS
			." WHERE id_adhtasso ='$id_result' AND cotis <> '999'";
			// $result_compt_adht_cotis = mysql_query($compt_adht_cotis);
			$dbresult = $db->Execute($compt_adht_cotis);
			//$nb_compt_adht_cotis = mysql_num_rows($result_compt_adht_cotis); // on compte le Nb cotis pour $id_result
			$nb_compt_adht_cotis = $dbresult->RecordCount() ; // on compte le Nb cotis pour $id_result

			// vérfier si la fiche _adherent ne contient pas 999 donc serait déja archivée		
			$req_lire_soc_adht = "SELECT soc_adht"
			." FROM ".TABLE_ADHERENTS
			." WHERE id_adht ='$id_result' "; 			
			$dbresult_soc_adht = $db->Execute($req_lire_soc_adht);		
			//  - si "xx" toutes les cotisations "Bénévole" sont archivées,
			// - si "999" la fiche "Bénévole" a été supprimée (mais la fiche est réactivable).
			$check_soc_adht= $dbresult_soc_adht->fields['soc_adht']; // valeur de la  si fiche _adherent soit vide soit xx soit 999
			
			// si Nb cotis pour $id_result = 0 ET QUE la fiche _adherent n'EST PAS déja archivée
			If ($nb_compt_adht_cotis == 0 && $check_soc_adht <> '999'){		
				// Il faut aussi supprimer le 's'  de  soc_adht  et date_echeance_cotis =0  dans la table TABLE_ADHERENTS 
				$req_supp_cotis_adht=("UPDATE ".TABLE_ADHERENTS
				//." SET soc_adht='xx',  date_echeance_cotis='0000-00-00'" // Null Remplace pour postgresql
				." SET soc_adht='xx',  date_echeance_cotis=NULL "
				." WHERE id_adht='$id_result'");  // Id la suppression
				$dbresult = $db->Execute($req_supp_cotis_adht);
			} else { 			
			// si Nb cotis pour $id_result >= 1 on prends la date la cotis qui reste en triant
				$compt_last_cotis = "SELECT id_cotis, date_fin_cotis"
				." FROM ".TABLE_COTISATIONS
				." WHERE id_adhtasso ='$id_result' AND cotis <>'999' ORDER BY id_cotis ASC";
				//$result_req_lire_info_date = mysql_query($compt_last_cotis);
				$dbresult = $db->Execute($compt_last_cotis);
				//while ($row_req_lire_info_i_date = mysql_fetch_object($result_req_lire_info_date)) {
					//$date_result = $row_req_lire_info_i_date->date_fin_cotis; // 
				//}		
				while ($dbresult && $row = $dbresult->FetchRow()) {
					$date_result = ($row['date_fin_cotis']); 
				}

				// Il faut modifier la date_echeance_cotis dans table TABLE_ADHERENTS date_echeance_cotis
				$req_modif_date_echeance=("UPDATE ".TABLE_ADHERENTS
				." SET date_echeance_cotis='$date_result'"
				." WHERE id_adht='$id_result'");  // Id la suppression
				$dbresult = $db->Execute($req_modif_date_echeance);

			}		
//--			

			//ecrit qui a fait la manip		
			$ecritlog = $masession->write_log('Archive_Adht_Cotis : '
			.$id_cotis_adht, addslashes($nom_adht).' '.addslashes($prenom_adht));	
			// on retourne à la page générale  apres  SUPPRIME la fiche cotisaton
			header('location: liste_cotisations_adht.php?filtre_fiche=1&id_adht='.$id_result);
		
		}

	}
				
/***** FIN Si on SUPPRIME la fiche cotisaton  */	

/***** Si on CONSULTE la fiche cotisaton archivée  */	

	$archive_fiche = get_post_variable_numeric('archive_fiche', '');
	if ( ($archive_fiche == 1) && ($id_cotis_adht) ) {
		$disabled = array (  //   pour afficher "disabled" les champs non modifiables du formulaire
			'date_enregist_cotis' => 'disabled="disabled"',
			//'nom_cotisant' => 'disabled="disabled"', // sur TPL
			'montant_cotis' => 'disabled="disabled"',
			//'id_type_cotisation'  => 'disabled="disabled"', // sur TPL
			'date_debut_cotis' => 'disabled="disabled"',
			'date_fin_cotis' => 'disabled="disabled"',
			'info_cotis' => 'disabled="disabled"',
			'info_archiv_cotis' => 'disabled="disabled"'				
		);
		$affiche_message =' N&deg; '.$id_cotis_adht.
		' -&nbsp;(<span class="Texterouge">'._LANG_MESSAGE_COTIS_ADHT_CONSULT_ARCHIV.'</span>)';
		$tpl->assign('archive_fiche',$archive_fiche);// Pour consulter la fiche affiche le bouton Retour uniquement
	}		

/***** FIN Si on CONSULTE la fiche cotisaton archivée */	

		
/***** Si on validé le Formulaire  par le bouton Valider  */
	if (isset($_POST['valid'])) {	
		// -- Récuprération des variable du formulaire ---
		
		// Id pour le Type de cotisation	 				
		$cotis_adh['id_type_cotisation']=(get_post_variable_numeric('id_type_cotisation',''));
		if ($cotis_adh['id_type_cotisation'] =='') {
			$erreur_saisie ['type_cotisation'] = _LANG_MESSAGE_COTIS_ADHT_ALERT_TYPE;
		}	
//++
		// si création le montant cotisation est affecté automatiquement 
		if  (isset( $required ['creation_cotisation']) and $required ['creation_cotisation'] == 1) {
		//if  ($required ['creation_cotisation'] == 1)  {
			// Requette Pour affichage de la liste  montant_cotisation
			$req_list = "SELECT id_type_cotisation,montant_cotisation FROM ".TABLE_TYPE_COTISATIONS;	
//*********			
			//$result_req_list = mysql_query($req_list);
			$dbresult = $db->Execute($req_list);	
			while ($dbresult && $row = $dbresult->FetchRow()) {
				// on construit le tableau des Montant des cotis
				$tab_montant_cotisation[$row['id_type_cotisation']] = ($row['montant_cotisation']);		
			}
//***************		
			$id_listemontant_cotisation =(get_post_variable_numeric('id_type_cotisation',''));
			if ($id_listemontant_cotisation >=1) {
			$cotis_adh['montant_cotis'] = $tab_montant_cotisation[$id_listemontant_cotisation];
			}
//++	
			} else { // Montant cotisation
			$cotis_adh['montant_cotis']=(get_post_variable('montant_cotis',''));
			if ( ($cotis_adh['montant_cotis'] =='') || (!is_numeric($cotis_adh['montant_cotis'])) ) {
				$erreur_saisie ['montant'] = _LANG_MESSAGE_COTIS_ADHT_ALERT_MONTANT;
			}	
		}
		
		// Date début cotisation
		$cotis_adh['date_debut_cotis']=(get_post_variable('date_debut_cotis',''));	// jj/mm/aaaa
		if 	($cotis_adh['date_debut_cotis'] !=='') {
			if (( check_madateFR($cotis_adh['date_debut_cotis']) )== TRUE) {
				$cotis_adh['date_debut_cotis_sql']= switch_date($cotis_adh['date_debut_cotis']) ; // --> 1948-02-21
			} else {
				$erreur_saisie ['d_debut_cotis'] = _LANG_MESSAGE_LISTE_COTIS_ADHT_DATE_DEB;
			}
		}			
		// Date fin cotisation
		$cotis_adh['date_fin_cotis']=(get_post_variable('date_fin_cotis',''));	// jj/mm/aaaa
		if 	($cotis_adh['date_fin_cotis'] !=='') {
			if (( check_madateFR($cotis_adh['date_fin_cotis']) )== TRUE) {
				$cotis_adh['date_fin_cotis_sql']= switch_date($cotis_adh['date_fin_cotis']) ; // --> 1948-02-21
				// Verifier si la date de FIN est supérieure à la date du début  
				if (( compare_date($cotis_adh['date_debut_cotis_sql'] , $cotis_adh['date_fin_cotis_sql']) ) == FALSE) {
					$erreur_saisie ['d_fin_cotis'] = _LANG_MESSAGE_COTIS_ADHT_ALERT;	
				}				
			} else {
				$erreur_saisie ['d_fin_cotis'] = _LANG_MESSAGE_LISTE_COTIS_ADHT_DATE_FIN;
			}
		} else { // si date vide
			$erreur_saisie ['d_fin_cotis'] = _LANG_MESSAGE_LISTE_COTIS_ADHT_DATE_FIN;
		}
		// Ajout Zone PAIEMENT
		$cotis_adh['paiement_cotis']=((get_post_variablehtml('paiement_cotis','')));
		
		// Commentaire de cotisation
		$cotis_adh['info_cotis']= stripslashes((get_post_variablehtml('info_cotis',''))); // elnlève \  si on a fait une erreur
	
	
		/*****  On crée une nouvelle cotisation */
		if  (isset( $required ['creation_cotisation']) and $required ['creation_cotisation'] == 1) {
		//if ( $required ['creation_cotisation'] == 1) {		
			$tpl->assign('data_cotis_adh', $cotis_adh); // si un nom est selectionné		Déplacé 
			// date enregistrement
			$cotis_adh['date_enregist_cotis']=(get_post_variable('date_enregist_cotis',''));	// jj/mm/aaaa
			if 	($cotis_adh['date_enregist_cotis'] !=='') {
				if (( check_madateFR($cotis_adh['date_enregist_cotis']) )== TRUE) {
					$cotis_adh['date_enregist_cotis_sql']= switch_date($cotis_adh['date_enregist_cotis']) ; // --> 1948-02-21
				} else {
					$erreur_saisie ['d_enregist'] = _LANG_MESSAGE_COTIS_ADHT_ALERT_DATE_ENR
					.' - '._LANG_TPL_TEXTE_DATE_TITLE ;
				}
			}
				
			$cotis_adh['id_adhtasso']=(get_post_variable_numeric('id_adhtasso',''));	// Id  du Cotisant Pour le nom
			if ($cotis_adh['id_adhtasso'] =='') {
				$erreur_saisie ['id_adhtasso'] = _LANG_MESSAGE_COTIS_ADHT_ALERT_NOM.' '.ADHERENT_BENE;
			}
	
			// Si Aucune erreur de saisie ON Valide --> Requette enregistrement nouvelle cotisation	
			if (count($erreur_saisie) == 0) {
				$cotis_adh['info_cotis'] = addslashes($cotis_adh['info_cotis']); // ajoute \ si on a fait une erreur
				$req_ecrit_nouvelle_cotis = "INSERT INTO ".TABLE_COTISATIONS
				." (id_adhtasso, qui_cotis, id_type_cotis, montant_cotis, info_cotis," 
				." paiement_cotis," //+ Ajout Zone PAIEMENT
				." date_enregist_cotis, date_debut_cotis, date_fin_cotis)" 					
				." VALUES('$cotis_adh[id_adhtasso]','adh','$cotis_adh[id_type_cotisation]',"
				."'$cotis_adh[montant_cotis]','$cotis_adh[info_cotis]',"
				."'$cotis_adh[paiement_cotis]',"  //+ Ajout Zone PAIEMENT
				." '$cotis_adh[date_enregist_cotis_sql]','$cotis_adh[date_debut_cotis_sql]',"
				."'$cotis_adh[date_fin_cotis_sql]')";
				$dbresult = $db->Execute($req_ecrit_nouvelle_cotis);				
					
				//Récupere Id de l'adhérent dont la diche cotisation a été modifiée	
			/***** mise A JOUR DE la table adherent  Date_Echeance_Cotis  */
				$req_ecrit_nouvelle_cotis_adht =("UPDATE ".TABLE_ADHERENTS
				." SET date_echeance_cotis='$cotis_adh[date_fin_cotis_sql]'"
				." WHERE id_adht='$cotis_adh[id_adhtasso]'");  // Id pour le Nom prenom du Cotisant
				$dbresult = $db->Execute($req_ecrit_nouvelle_cotis_adht);		
				
			/*****  */
				
				//ecrit qui a fait la manip			
				$ecritlog = $masession->write_log('Creation_Cotis_PourAdht : '
				.$cotis_adh['id_adhtasso'], addslashes($nom_adht).' '.addslashes($prenom_adht));				
				// on retourne à la page générale aprés Requette enregistrement nouvelle cotisation
				header('location: liste_cotisations_adht.php?id_adht='.$cotis_adh['id_adhtasso']);
			
			}
				
			/*****  FIN On crée une nouvelle cotisation */
		} 
			
		/*****   adhérent existant --> on modifie une cotisation donc Update simplement */
		if ( ($required ['modification_cotisation'] == 1) && ($id_cotis_adht)) {
			$cotis_adh['id_cotis'] = $id_cotis_adht; // récupère  id_cotis_adht pour réafficher les modifications éventelles si ERREUR			
			//Récupere Id de l'adhérent dont la fiche cotisation a été modifiée
			$cotis_adh['id_adhtasso'] = get_post_variable_numeric('id_adht_cotis', '');
			
			// Si Aucune erreur de saisie Udpate --> Requette enregistrement update cotisation				
			if (count($erreur_saisie)==0) {	  
				$cotis_adh[info_cotis] = addslashes($cotis_adh[info_cotis]); // ajoute \ si on a fait une erreur
				$req_ecrit_modif_cotis =("UPDATE ".TABLE_COTISATIONS
				." SET id_type_cotis='$cotis_adh[id_type_cotisation]',"
				." montant_cotis= '$cotis_adh[montant_cotis]', "
				." info_cotis='$cotis_adh[info_cotis]',"
				." paiement_cotis='$cotis_adh[paiement_cotis]'," // + Ajout Zone PAIEMENT
				." date_debut_cotis='$cotis_adh[date_debut_cotis_sql]',"	
				." date_fin_cotis='$cotis_adh[date_fin_cotis_sql]',"
				." datemodiffiche_cotis='$date_du_jour'"
				." WHERE id_cotis='$id_cotis_adht'"); 
				$dbresult = $db->Execute($req_ecrit_modif_cotis);	
				
				/***** mise A JOUR DE la table adherent  Date_Echeance_Cotis  */
				$req_ecrit_nouvelle_cotis_adht =("UPDATE ".TABLE_ADHERENTS
				." SET date_echeance_cotis='$cotis_adh[date_fin_cotis_sql]'"
				." WHERE id_adht='$cotis_adh[id_adhtasso]'");  // Id pour le Nom prenom du Cotisant	
				$dbresult = $db->Execute($req_ecrit_nouvelle_cotis_adht);					
				/*****  */
				
				//ecrit qui a fait la manip			
				$ecritlog = $masession->write_log('Modifie_Adht_Cotis : '
				.$id_cotis_adht, addslashes($nom_adht).' '.addslashes($prenom_adht));	
				
				$tpl->assign('modif_fiche',$required ['modification_cotisation']);// réafiche disabled=true pour le nom adhérent
				// on retourne à la page générale  suite Requette enregistrement update cotisation	
				header('location: liste_cotisations_adht.php?id_adht='.$cotis_adh[id_adhtasso]);	
					
			}


		} /*****  FIN on modifie une cotisation donc Update simplement */
		//$tpl->assign('modif_fiche',$required ['modification_cotisation']);// réafiche disabled=true pour le nom adhérent
		$tpl->assign('data_cotis_adh',$cotis_adh);// on réaffiche les informations dans le formulaire de saisie
		$tpl->assign('erreur_saisie',$erreur_saisie);// on affiche les erreurs de saisie dans le formulaire de saisie
			
/***** FIN Si on validé le Formulaire  par le bouton Valider  */			
	} else { 
/***** Sinon on affiche la fiche la première fois avant modifications */
	
	// préparation des données pour affichage si une cotisation existe déja
		if ($required ['modification_cotisation'] == 1) {
			$req_lire_info_cotis = "SELECT id_cotis,qui_cotis,id_adhtasso,"
			."id_type_cotis,montant_cotis,info_cotis,date_enregist_cotis,"
			."paiement_cotis,"  //+ Ajout Zone PAIEMENT
			."date_debut_cotis,date_fin_cotis,info_archiv_cotis,datemodiffiche_cotis,"
			." id_type_cotisation,nom_type_cotisation" // TABLE_TYPE_COTISATIONS
			." FROM ".TABLE_COTISATIONS.", ".TABLE_TYPE_COTISATIONS 
			." WHERE id_cotis='$id_cotis_adht' "			
			." AND ".TABLE_TYPE_COTISATIONS.".id_type_cotisation=".TABLE_COTISATIONS.".id_type_cotis";	
			$dbresult = $db->Execute($req_lire_info_cotis);				  
			
			// On récupere les données de la requette sous forme de tableau  $cotis_adh["Nom_du_Champs_Table"]
			while (($cotis_adh = $dbresult->FetchRow())) {
				// modification affichage dates
				$cotis_adh['date_enregist_cotis'] = switch_sqlFr_date($cotis_adh['date_enregist_cotis']);
				$cotis_adh['date_debut_cotis'] = switch_sqlFr_date($cotis_adh['date_debut_cotis']);
				$cotis_adh['date_fin_cotis'] = switch_sqlFr_date($cotis_adh['date_fin_cotis']);			
				// Préparation pour Affichage partie variable en fonction des données
				$tpl->assign('data_cotis_adh',$cotis_adh);
				$tpl->assign('modif_fiche',$required ['modification_cotisation']);			
			}
		} 
			
	} 
/***** FIN Sinon on affiche la fiche la première fois avant modifications */
	
//***** pour Affichage des Nom-Prénoms bénévoles et types de cotisation		
	// Requette Pour affichage de la liste  Nom Prénom
	$req_list_benevol = "SELECT id_adht,nom_adht,prenom_adht FROM "
	.TABLE_ADHERENTS."  WHERE soc_adht <>'999' ORDER BY  nom_adht asc ";	
	$dbresult = $db->Execute($req_list_benevol);	
    $tab_benevol = array('' => (_LANG_ARRAY_SELECTIONNEZ_NOM));// ligne affichée si vide
	
	while ($dbresult && $row = $dbresult->FetchRow()) {
		// on construit le tableau ID=Nom Prénom 
		$tab_benevol[$row['id_adht']] =	htmlentities(stripslashes(strtoupper($row['nom_adht']).' '.$row['prenom_adht']),ENT_QUOTES,'UTF-8');	
	}

	// Requette Pour affichage de la liste  types de cotisation
	$req_list_typecotis = "SELECT id_type_cotisation,nom_type_cotisation,montant_cotisation FROM ".TABLE_TYPE_COTISATIONS;	
	$dbresult = $db->Execute($req_list_typecotis);	
    $tab_nomcotis = array('' => (_LANG_ARRAY_SELECTIONNEZ_TYPE));// ligne affichée si vide

	while ($dbresult && $row = $dbresult->FetchRow()) {
		// on construit le tableau ID=nom_type_cotisation
		$tab_nomcotis[$row['id_type_cotisation']] =	htmlentities(stripslashes($row['nom_type_cotisation']),ENT_QUOTES, 'UTF-8').' - '.$row['montant_cotisation'];	
    }

//***** FIN pour Affichage des Nom-Prénoms bénévoles et types de cotisation		

			
		
/***** ---------------------------------------------------------------------- */		
	// Préparation pour Affichage partie Fixe VERS TEMPLATE	 	
	$tpl->assign('version',VERSION); // Version de Gestasso
	$tpl->assign('nom_asso_gestassophp',NOM_ASSO_GESTASSOPHP); // le Nom de l'association				
	$tpl->assign('messagetitre',MESSAGETITRE); // Titre Bandeau haut
	$tpl->assign('priorite_adht',$priorite_adht);
	$tpl->assign('nomprenom_adht',$prenom_adht.' '.$nom_adht);
	// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE		
	$tpl->assign('listnoms',$tab_benevol); // la liste des noms des adhérents
	$tpl->assign('listnomtypecotisation',$tab_nomcotis); // la liste des noms des adhérents
	$tpl->assign('date_dujour',switch_sqlFr_date($date_du_jour));// date du jour pour  Date d'inscription 
	$tpl->assign('date_3112',JMA_FIN_COTIS);// date  pour fin de cotisation	V 5.5.0		
	$tpl->assign('required',$required); // Variables Obligatoires
	$tpl->assign('erreur_saisie',$erreur_saisie); // Erreur de saisie sur champs Obligatoires
	$tpl->assign('alert_saisie',$alert_saisie); // Message alerte	
	$tpl->assign('list_paiement_cotis',$T_PAIEMENT_COTIS);//+  Ajout Zone PAIEMENT Gestion Cotisations	
	
	$tpl->assign('disabled',$disabled); // pour afficher "disabled" les zones non modifiables du formulaire
	$tpl->assign('affiche_message',$affiche_message); // pour afficher
	//POUR  AFFICHAGE VERS TEMPLATE			
	$content = $tpl->fetch('adherent/remplir_cotisations_adht.tpl'); // On affiche ...	
	$tpl->assign('content',$content);		
	$tpl->display('page_index.tpl');	

/***** il y a une erreur ... Si erreur  on envoie vers la page de login ... avec message */	
	} else {
		header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR);  
	}
	

?>
    
