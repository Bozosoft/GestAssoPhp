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
 * @version :  2017
 * @copyright 2007-2017  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */
 
/**
 *  Directory :  /ROOT_DIR_GESTASSO/adherent/
 *   Fichier :
 *   Affiche les détails des fichiers 
 *   PAGE étant une SOUS-PAGE de Visualisation et Gestion de mes informations
*/

// Si pas de session ...		
$sessionadherent=(empty($_SESSION['ses_id_adht'])) ? $sessionadherent='' :$sessionadherent = $_SESSION['ses_id_adht'];

// vérification de l'authenticité du visiteur	
if (($sessionadherent) && $log == ($_SESSION['ses_login_adht']) && $pas == ($_SESSION['ses_paswd_adht'])) {
/***** ici commence le code en cas d'authentification */
	
	// Raz de variables
	
	//Tableau xpour affichage
	$adherent_visu = array(); // On passe par un Tableau pour affichage du nom prénom adhérent
	$fichier = array(); // On passe par un Tableau pour affichage des fichiers
	// initialisation
	//$date_du_jour=date("Y-m-d");//Pour définir la différence entre 2  dates
	$indice ='';
	

	
/***** Pour affichage de la fiche */
// Récupère  Prénom Nom du possesseur de la fiche pour afficher Liste des fichiers adhérents
    $req_lire_nom_adht = "SELECT prenom_adht,nom_adht FROM ".TABLE_ADHERENTS." WHERE id_adht='".$id_adht."'";
	$dbresult_nom = $db->Execute($req_lire_nom_adht);	
	$adherent_nomfiltre = $dbresult_nom->fields['nom_adht'];//." ".$dbresult_nom->fields['prenom_adht'];
	
	// On lit la table des fichiers relative à l'adhérent sur la Fiche en cours
	$req_lire_info_fichier = "SELECT id_file_adht, nom_file_adht, design_file_adht From ".TABLE_FICHIER_ADHERENTS
	." WHERE id_adht_file='$id_adht' AND file_adht =''";
	$dbresult = $db->Execute($req_lire_info_fichier);	
	
	while ($dbresult && $row = $dbresult->FetchRow()) {	
		//affiche les variables de la ligne 
		$fichier[$indice]['nom_file_adht'] = $row['nom_file_adht']; //Nom fichier
		$fichier[$indice]['id_file_adht'] = $row['id_file_adht']; //++ ajout pour téléchargement
		$fichier[$indice]['design_file_adht'] = $row['design_file_adht']; //++ ajout désignation pour téléchargement
		$fichier[$indice]['coul'] =  abs($indice) % 2; //12/01/17 // Pour afficher 1 ligne sur 2  classs= Lignegris0  / Lignegris1	
		$indice++;
	}


	
/***** FIN Pour affichage de la fiche */

		
/***** ---------------------------------------------------------------------- */	
	// Préparation pour Affichage partie Fixe VERS TEMPLATE	 
	// Préparation pour Affichage partie variable en fonction des données VERS TEMPLATE	
	$tpl->assign('fichier',$fichier); // tableau $fichier[$indice]['xx_xx']	
	$tpl->assign('adherent_nomfiltre',$adherent_nomfiltre); //  Nom du possesseur de la fiche	
	//POUR  AFFICHAGE VERS TEMPLATE			
	$tpl->assign('nb_mission_adht',($indice)); // NB missions

} else { /***** il y a une erreur ... Si erreur  on envoie vers la page de login ... avec message */		
	header('location: ../index.php?texterreur='._LANG_MESSAGE_TEXTERREUR);  
}

?>
    
