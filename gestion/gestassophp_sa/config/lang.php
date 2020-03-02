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
 * @version :  2020
 * @copyright 2007-2020 (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */
 
/**
 *  Directory :  /ROOT_DIR_GESTASSO/lang/
 *   Fichier : lang.php
 *   Fichier de langue
 *   ENCODAGE entitiées pour UTF8  é = &eacute; à = &agrave; è = &egrave;  î = &icirc; ê = &ecirc;
 
 
*  Textes et messages pour affichage
*  	define('_LANG_VIDE', 'le texte de votre langue ici');
*	Inscrivez votre texte entre les guillemets simples  ,'.....'
*	define('_LANG_VIDE', 'texte vide de texte');    sur template {language name=vide}  affiche => texte vide de texte
*  Voir le fichier /lang/infoasso.php qui définit les informations de l'association
* --------------------------------------------------------------------
* LES MENUS
* Localisation sur   /templates/pageindex.tpl  +  /templates/login.tpl
* --------------------------------------------------------------------
*/	
//Gestion Membres
	define('_LANG_MENU_ADHT_MEMBRES', 'Gestion Membres'); // Gestion Membres  
	define('_LANG_MENU_ADHT_INFORMATION', 'Mes informations'); // Mes informations  	
	define('_LANG_MENU_ADHT_LISTE', 'Liste '.ADHERENT_BENE.'s');  // liste Bénévoles 
//Administration	
	define('_LANG_MENU_ADMIN_GESTION', 'Administration');  // Administration	
	define('_LANG_MENU_ADMIN_GESTION_TB', 'Tableau bord');// Tableau bord 
	define('_LANG_MENU_ADMIN_GESTION_PA', 'Priorité Accés');// Priorité Accès 
	define('_LANG_MENU_ADMIN_GESTION_LOG', 'Logs');// Logs 
	define('_LANG_MENU_ADMIN_GESTION_PREF', 'Préférences');// Préférences et Antennes(sections)  // ++ 24/10/08
	define('_LANG_MENU_ADMIN_GESTION_MAINT_BD', 'Maintenance BD');// Maintenance base données//+07/08/08
//Adhérents		
	define('_LANG_MENU_ADHERENT_BENE',  ADHERENT_BENE.'s');// Bénévoles  
	define('_LANG_MENU_ADHERENT_GESTION', 'Gestion '.ADHERENT_BENE.'s');// Gestion Bénévoles
	//+ Liste des adhérents en partie admin pour affichage simplifié des données  v 5.4.0 dec 2011
	define('_LANG_TITRE_ADMIN_LISTE_ADHT2', 'Liste des '.ADHERENT_BENE.'s');
	define('_LANG_MENU__GESTION_COTIS', 'Gestion Cotisations');// Gestion Cotisations
	define('_LANG_MENU__GESTIONE_FILE','Gestion fichiers');// Gestion fichiers
//sortie	
	define('_LANG_MENU_EXIT','Déconnexion');//  Déconnexion 	 
	define('_LANG_MENU_EXIT_TITLE','Se Déconnecter'); //title="Se Déconnecter"
	
/**
* --------------------------------------------------------------------
* Localisation sur /templates   parties communes à toutes les templates
* --------------------------------------------------------------------
*/
	define('_LANG_CHARSET', 'UTF-8');  // charset=> iso-8859-1  ou utf-8  // charset dans /templates/*.tpl et dans fichiers /aide/*.php   echo _LANG_CHARSET   ATTENTION SI utf-8 Gérer les accents en base de données
/*
l'ISO-8859-1 (parfois appelé latin1), qui permet d'enregistrer presque tous les caractères du français ;
l'ISO-8859-15 (parfois appelé latin9), une variation de l'ISO-8859-1, qui rajoute le symbole « euro » et le « l'o dans l'e» ;
l'UTF-8, qui permet théoriquement d'encoder toutes les langues, du français au japonais en passant par l'arabe.
*/		
	define('_LANG_AIDE', 'Aide'); // {language name=aide} 
	define('_LANG_TITLE_AIDE', 'Un peu d\'aide'); // NOTA  = l ' doit être echapée
	define('_LANG_TPL_PAGES', 'Pages :');// donne le Numéro des pages  {language name=tpl_pages}
	define('_LANG_TPL_GO_PAGES', 'Allez à la page');// title= ...  {language name=tpl_go_pages}
//Tri dans les listes
	define('_LANG_TPL_TITLE_CLICTRI', 'Cliquer pour trier');//title= ...  {language name=tpl_title_clictri}
	define('_LANG_TPL_TITLE_CLICTRI_DOWN', 'Tri Décroissant');//title= ... {language name=tpl_title_clictri_down}
	define('_LANG_TPL_TITLE_CLICTRI_UP', 'Tri Croissant');//title= ... {language name=tpl_title_clictri_up}
	define('_LANG_TPL_LISTE_VIDE', 'La liste est vide'); // {language name=tpl_liste_vide}
	define('_LANG_TPL_LISTE_VIDE_FOR', 'La liste est vide pour '); //{ language name=tpl_liste_vide_for}	
	define('_LANG_TPL_SELECT_AFFICHEPAR', 'Afficher par :'); // {language name=tpl_select_affichepar}
	define('_LANG_TPL_COL_ACTION', 'Action');//  {language name=tpl_col_action} 
	define('_LANG_TPL_COL_ACTIONS', 'Actions');//  {language name=tpl_col_actions}
	define('_LANG_TPL_COL_NUM', 'N°');//  {language name=tpl_col_num}
	define('_LANG_TPL_COL_NOMPRE', 'Nom Prénom');//  {language name=tpl_col_nompre}  
	define('_LANG_TPL_COL_ADHT_VILLE', 'Ville'); // Ville       {language name=tpl_col_adht_ville}  
    define('_LANG_TPL_COL_ADHT_TELEPH', 'Téléphone'); //Téléphone      {language name=tpl_col_adht_teleph}  
	define('_LANG_TPL_COL_ADHT_PORTABLE', 'Tel Portable'); //Portable   rempacer en V7 par Tel Portable
	define('_LANG_TPL_COL_DATE', 'Date'); // {language name=tpl_col_date}
	define('_LANG_TPL_COL_DESCRIPTION', 'Description'); // {language name=tpl_col_description}
	define('_LANG_TPL_COL_ADHT_NOM', 'Nom'); // {language name=tpl_col_adht_nom}
    define('_LANG_TPL_FILTER_BUTTON', 'Filtrer'); // value="Filtrer"   // {language name=tpl_filter_button} 
    define('_LANG_TPL_FILTER_BUTTON_TITLE', 'Valider la sélection');	 //title="Valider la sélection"  {language name=tpl_filter_button_title}  
	define('_LANG_TPL_TEXTE_SELECT', 'Sélectionner');//Sélectionner    {language name=tpl_texte_select} 
	define('_LANG_TPL_LISTE_ADHT_PARMI_TITLE', 'Entrer les caractères du nom ou prénom');//title="  {language name=tpl_liste_adht_parmi_title}
//  Boutons
    define('_LANG_TPL_SAV_BUTTON', 'Sauvegarder'); // {language name=tpl_sav_button}
	define('_LANG_TPL_RETOUR_BUTTON_TITLE', 'Retour'); //title=  ... à la page précédente  {language name=tpl_retour_button_title}
	define('_LANG_TPL_RETOUR_BUTTON', 'Retour');	 // {language name=tpl_retour_button}
	define('_LANG_TPL_VALID_BUTTON', 'Valider'); //value="Valider"   {language name=tpl_valid_button}
	define('_LANG_TPL_VALID_BUTTON_TITLE', 'Valider la saisie'); //title=   {language name=tpl_valid_button_title}
	define('_LANG_TPL_CANCEL_BUTTON', 'Annuler'); //value="Annuler"   {language name=tpl_cancel_button}
	define('_LANG_TPL_CANCEL_BUTTON_TITLE', 'Annuler'); //title="Annuler"    {language name=tpl_cancel_button_title}	
// texte
	define('_LANG_TPL_TEXTE_OBLIG', 'Champs obligatoires');//  {language name=tpl_texte_oblig}
	define('_LANG_TPL_TEXTE_ERR_SAISIE', 'Erreur de saisie ');// {language name=tpl_texte_err_saisie}
	define('_LANG_TPL_ADHT_DATENAIS', 'Date de naissance'); // {language name=tpl_adht_datenais}	
	define('_LANG_TPL_TEXTE_DATE_TITLE', 'La date au format jj/mm/aaaa');	//title=...    {language name=tpl_texte_date_title}
/**  Messages PHP  /index.php */ /* <?php echo _LANG_TPL_TEXTE_SELECT  ;?>*/
	define('_LANG_MESSAGE_TEXTERREUR', 'Erreur... Identifiez-vous de nouveau ... !!'); 
	define('_LANG_ARRAY_SELECTIONNEZ_NOM' , 'Sélectionnez le Nom');  //array('' => ('Sélectionnez le Nom'));
	define('_LANG_MESSAGE_CREATE', 'Création');
	define('_LANG_MESSAGE_MODIF', 'Modification');
	
/** ---------------------------------------------------------------------- */
/**
*  Nombre de caractères des fichiers téléchargeables    Number of characters for upload files 25/01/2009 passe en avant
*/
	define('NB_CARRACT_FILE', '25');  // Nombre de caractères X du fichier  NON compris extension  File = X + 1+3)
/* --------------------------------------------------------------------*/	

/**
* Localisation sur /templates/login.tpl + /templates/page_index.tpl ET /index.php + /admin/index.php + /adherent/index.php 
*/	
	define('_LANG_LOGIN_ADHERENT', 'Identification'); // Page LOGIN  
	define('_LANG_LOGIN_ADHERENT_TITLE', 'Identification de connexion'); 	//title=
	define('_LANG_LOGIN_USER', 'Login utilisateur');  //   {language name=login_user} 
	define('_LANG_LOGIN_INTERDIT', 'Accès Non autorisé');
	define('_LANG_LOGIN_MY_LOGIN', 'Login ');   //Login :  {language name=login_my_login}
	define('_LANG_LOGIN_ENTER_LOGIN', 'Veuillez saisir votre Login'); 
	define('_LANG_LOGIN_MY_PASSWD', 'Mot de passe '); //  {language name=login_my_passwd}
	define('_LANG_LOGIN_ENTER_PASSWD', 'Veuillez saisir votre mot de passe'); 
	define('_LANG_LOGIN_BUTTON', 'Connexion'); //Bouton value="Entrer" 
	define('_LANG_LOGIN_BUTTON_TITLE', 'Se connecter à votre espace membres'); //title=
// J'ai oublié mon mot de passe !
	define('_LANG_MAIL_CONTACTER', 'Contacter l\''); 	//Contacter l'Admin....
	define('_LANG_MAIL_MAIL', 'par mail');
// NON TRADUIT  {mailto address="$email_adresse" text="Administrateur" subject="Autorisation_Espace_membres" encode="javascript"} 
// NON TRADUIT  {mailto address="$email_adresse" text="J\'ai oubli&eacute; mon mot de passe !" subject="Oubli_mot_de_passe_Espace_membres" encode="javascript"}	
	
/**  Messages PHP  /index.php */
	define('_LANG_TEXTERREURLOGIN1' , 'Attention Vous n\'avez pas l\'autorisation pour vous connecter !<br/>');
	define('_LANG_TEXTERREURLOGIN2' , 'Attention ! Login ou Mot de Passe Invalide !<br/>');
		
/** ---------------------------------------------------------------------- */	
	

/** --- Gestion Membres ------------------------------------------------------------------- */		
/**
* Localisation sur      /templates/adherent/gerer_fiche_adht.tpl ET /adherent/gerer_fiche_adht.php 
*/
	define('_LANG_TITRE_VISU_FICHE_ADHT', 'Visualisation et Gestion de mes informations');
	define('_LANG_VISU_FICHE_ADHT_RECAP', 'Récapitulatif');
	define('_LANG_GESTION_FICHE_ADHT', 'Informations personnelles');
	define('_LANG_VISU_FICHE_ADHT_ENR', 'Enregistrement N°'); 
	define('_LANG_VISU_FICHE_ADHT_ENRDU', 'du '); 	
	define('_LANG_VISU_FICHE_ADHT_LASTMOD', 'Dernière modification ');
	define('_LANG_VISU_FICHE_ADHT_MODIF_BUTTON_TITLE', 'Modifier les données'); //title=
	define('_LANG_VISU_FICHE_ADHT_MODIF_BUTTON', 'Modifier');
	define('_LANG_VISU_FICHE_ADHT_REACTIV_BUTTON_TITLE', 'Réactiver la fiche'); //title=
	define('_LANG_VISU_FICHE_ADHT_REACTIV_BUTTON', 'Réactiver la fiche'); 
	define('_LANG_VISU_FICHE_ADHT_AGE', 'Age ');  
	define('_LANG_VISU_FICHE_ADHT_AN', 'ans'); 
	define('_LANG_VISU_FICHE_ADHT_COORD_NO', ', je ne souhaite pas afficher mes coordonnées consultables par les'); 
	define('_LANG_VISU_FICHE_ADHT_COORD_YES', ', je souhaite afficher mes coordonnées consultables par les');
	//** Ajout 15/04/09 FONCTION MAIL
	define('_LANG_VISU_FICHE_ADHT_MAIL_TITLE', 'Envoyer un message par le formulaire');
	
/**  Messages PHP   */
	define('_LANG_MESSAGE_FICHE_REACT', 'Fiche Réactivée');  // 
	define('_LANG_MESSAGE_FICHE_COT_OKAU', 'Cotisation réglée jusqu\'au : '); 
	define('_LANG_MESSAGE_FICHE_COT_NONOK', 'Cotisation NON réglée');
	define('_LANG_MESSAGE_FICHE_COT_ECHUE', 'Cotisation échue depuis le :'); 
	define('_LANG_MESSAGE_FICHE_SUPP', 'Fiche supprimée le : '); 
	define('_LANG_MESSAGE_FICHE_AGRANDIR_PHOTO', 'Cliquez pour agrandir dans une autre fenêtre');
	//** Ajout 15/04/09 FONCTION MAIL
	define('_LANG_MESSAGE_FICHE_MAIL_OK', 'Message envoyé'); 
	define('_LANG_MESSAGE_FICHE_MAIL_NONOK', 'Erreur Message NON envoyé'); 

	
/**	
* Informations sur mes fichiers et mes missions  OPTION  -> Module  INFO_FICHIER_MISSIONS Affiche si un adhérent a des fichiers 
* Informations complémentaires OPTION  -> Module  INFO_COMPLEMENTAIRES 
* INFO_FICHIER_MISSIONS Affiche si un adhérent a des fichiers  -- Possibilité de supprimer la gestion des fichiers
* MODIFIER LE FICHIER    \adherent\gerer_fiche_adht.php
* fichier /adherent/consulter_info_fichiermission_adht.php 
*/
	define('INFO_FICHIER_MISSIONS', '1'); //MODIFICATION possible  1 visible 0 Non visible
	define('_LANG_TITRE_FICHIER_MISSIONS', 'Informations sur mes fichiers'); // {language name=titre_fichier_missions}	
	define('_LANG_FICHIER_MISSIONS_MYFILES', 'Mes fichiers');
	
/** Commun à adherent/gerer_fiche_adht ET remplir_infogene_adht */
    define('_LANG_FICHE_ADHT_CIVIL', 'Civilité'); //  {language name=fiche_adht_civil}	 
	define('_LANG_FICHE_ADHT_NOM_TITLE', 'Indiquer le nom Sans accent'); 
	define('_LANG_FICHE_ADHT_NOM_PLACEHOLDER', 'Ici entrer le Nom Sans accent');
    define('_LANG_FICHE_ADHT_PRENOM', 'Prénom'); //   {language name=fiche_adht_prenom}	
    define('_LANG_FICHE_ADHT_PRENOM_TITLE', 'Indiquer le Prénom'); 		
	define('_LANG_FICHE_ADHT_PRENOM_PLACEHOLDER', 'Ici entrer le Prénom');
    define('_LANG_FICHE_ADHT_DATENAIS_TITLE', 'Ma date de naissance au format jj/mm/aaaa'); 
	define('_LANG_FICHE_ADHT_DATENAIS_PLACEHOLDER', 'jj/mm/aaaa'); 
    define('_LANG_FICHE_ADHT_ADRESS', 'Adresse'); //  {language name=fiche_adht_adress}	
	define('_LANG_FICHE_ADHT_ADRESS_TITLE', 'Indiquer Adresse');
	define('_LANG_FICHE_ADHT_ADRESS_PLACEHOLDER', 'Ici entrer la Rue, avenue, batiment,...');
    define('_LANG_FICHE_ADHT_CP', 'Code Postal'); //  {language name=fiche_adht_cp}	
	define('_LANG_FICHE_ADHT_CP_TITLE', 'Indiquer Code Postal');
	define('_LANG_FICHE_ADHT_CP_PLACEHOLDER', 'Code P.');	
	define('_LANG_TPL_COL_ADHT_VILLE_TITLE', 'Ma Ville');
	define('_LANG_TPL_COL_ADHT_VILLE_PLACEHOLDER', 'Ici entrer la Ville');	
    define('_LANG_TPL_COL_ADHT_TELEPH_TITLE', 'Indiquer N° de téléphone fixe - Entrez les chiffres sans espace ni point'); 
	 define('_LANG_TPL_COL_ADHT_TELEPH_PLACEHOLDER', 'sans espace ni point'); 
	define('_LANG_TPL_COL_ADHT_PORTABLE_TITLE', 'Indiquer N° de téléphone portable - Entrez les chiffres sans espace ni point'); 
	define('_LANG_TPL_COL_ADHT_PORTABLE_PLACEHOLDER', 'sans espace ni point'); 
	//Modification V 7
	define('_LANG_FICHE_ADHT_FAX', 'Tel Professionnel');  // ancien fax
	define('_LANG_FICHE_ADHT_FAX_TITLE', 'Indiquer téléphone professionnel - Entrez les chiffres sans espace ni point'); 
	//ajout V 7
	define('_LANG_FICHE_ADHT_PROFESSION', 'Profession'); 
	define('_LANG_FICHE_ADHT_PROFESSION_TITLE', 'Indiquer la profession'); 
	define('_LANG_FICHE_ADHT_PROFESSION_PLACEHOLDER', 'Ici entrer la profession'); 
	define('_LANG_FICHE_ADHT_AUTRES_INFO', 'Autres informations'); 
	define('_LANG_FICHE_ADHT_AUTRES_INFO_TITLE', 'Indiquer les autres informations '); 
	define('_LANG_FICHE_ADHT_AUTRES_INFO_PLACEHOLDER', 'Ici entrer vos informations complémentaires');	
	// fin ajout V7
	define('_LANG_FICHE_ADHT_FAX_PLACEHOLDER', 'sans espace ni point'); 
	define('_LANG_FICHE_ADHT_MAIL', 'Email'); 
	define('_LANG_FICHE_ADHT_MAIL_TITLE', 'Indiquer adresse email');
	define('_LANG_FICHE_ADHT_MAIL_PLACEHOLDER', 'adresse mail xxx.xxx@xxx.xx');
	define('_LANG_FICHE_ADHT_WEB', 'Site WEB'); 
	define('_LANG_FICHE_ADHT_WEB_TITLE', 'Indiquer site web'); 
	define('_LANG_FICHE_ADHT_WEB_PLACEHOLDER', 'URL (adresse) sans http://'); 
    define('_LANG_FICHE_ADHT_TAGE', 'Tranche âge'); //  {language name=fiche_adht_tage}	
    define('_LANG_FICHE_ADHT_COORD', 'Afficher mes coordonnées'); //  {language name=fiche_adht_coord}	
	define('_LANG_FICHE_ADHT_COORD_TITLE', 'Afficher ou NON mes coordonnées consultables par TOUS les '.ADHERENT_BENE.'s de ');//title=
	define('_LANG_FICHE_ADHT_D_INSCRIPT', 'Date d\'inscription');//   {language name=fiche_adht_}	
	define('_LANG_FICHE_ADHT_CREATE_LOGINPASS', 'Création du Login et du Mot de passe');
	define('_LANG_FICHE_ADHT_LOGIN', 'Login '.ADHERENT_BENE);//title="
	define('_LANG_FICHE_ADHT_LOGIN_UPPER', 'Le Login (entre 4 et 20 caractères autorisés A à Z, 0 à 9 et _ - ) sera créé en Majuscules automatiquement');
	define('_LANG_FICHE_ADHT_LOGIN_PLACEHOLDER', '4 à 20 caractères');
	define('_LANG_FICHE_ADHT_PASSWD410', 'Mot de passe entre 4 et 16 caractères autorisés a/A à z/Z, 0 à 9 et _ -');
	define('_LANG_FICHE_ADHT_PASSWD410_PLACEHOLDER', '4 à 16 caractères');	
	define('_LANG_FICHE_ADHT_PASSWD_TITLE', 'Mot de passe');//title=   {language name=fiche_adht_}
	define('_LANG_FICHE_ADHT_PASSWD_CONFIRM_TITLE', 'Confirmation du mot de passe');//title=
	define('_LANG_FICHE_ADHT_FICHE_ENR', 'Fiche enregistrée par ');
	define('_LANG_FICHE_ADHT_MODIF_PASSWD', 'Modification du Mot de passe');
	define('_LANG_FICHE_ADHT_NEWPASSWD', 'Nouveau Mot de passe');
	define('_LANG_FICHE_ADHT_NEWPASSWD_TITLE', 'Nouveau Mot de passe, Sinon laisser vide');//title="
	define('_LANG_FICHE_ADHT_CONFIRM', 'Confirmation');
//NON TRADUIT  define('_LANG_FICHE_ADHT_NO_PHOTO', '[ Pas de photo ]');//[ Pas de photo ] 
	define('_LANG_FICHE_ADHT_DEL_PHOTO', 'Supprimer la photo');
	define('_LANG_FICHE_ADHT_CONFIRM_DEL_PHOTO', 'Êtes vous sûr de vouloir supprimer la photo ?');
	define('_LANG_FICHE_ADHT_DEL_PHOTO_TITLE', 'Supprimer la photo');//title=
	define('_LANG_FICHE_ADHT_UPLOAD_PHOTO', 'Possibilité d\'envoyer une photo depuis votre ordinateur');
	define('_LANG_FICHE_ADHT_ADD_PHOTO_TITLE', 'Cliquer ici pour ajouter une photo au format jpg ou gif');//title=
// Ajouter Chp +	
    define('_LANG_FICHE_ADHT_PROMOTION', 'N° adhésion'); 
    define('_LANG_FICHE_ADHT_PROMOTION_TITLE', 'Indiquer le N° adhésion asso'); 	
	define('_LANG_FICHE_ADHT_PROMOTION_PLACEHOLDER', 'Ici entrer un N° une référence, ...'); 
	
/**  Messages PHP   */
	define('_LANG_MESSAGE_REMPLIR_NOPHOTO', '[ Pas de photo ]'); 
	define('_LANG_MESSAGE_REMPLIR_ERR_PHOTO', 'La photo semble ne pas avoir été transmise correctement'); 
	define('_LANG_MESSAGE_REMPLIR_ERR_FICH_PHOTO', 'Le fichier transmis n\'est pas une image valide (GIF,  JPEG)');
	define('_LANG_MESSAGE_REMPLIR_NOM', 'Indiquez le Nom'); 
	define('_LANG_MESSAGE_REMPLIR_PRENOM', 'Indiquez le Prénom'); 
	define('_LANG_MESSAGE_REMPLIR_ERR_DATENAIS', ' Date de naissance Non valide - Format jj/mm/aaaa');
	define('_LANG_MESSAGE_REMPLIR_CP', ' Indiquez le Code Postal');  
	define('_LANG_MESSAGE_REMPLIR_VILLE', 'Indiquez la Ville'); 
	define('_LANG_MESSAGE_REMPLIR_ERR_MAIL', 'Attention adresse email Non valide'); 
	define('_LANG_MESSAGE_REMPLIR_LOGIN', 'Indiquez un login');
	define('_LANG_MESSAGE_REMPLIR_ERR_LOGIN', 'Login entre 4 et 20 caractères ou caractères invalides ! ');
	define('_LANG_MESSAGE_REMPLIR_ERR_PASSW', 'Mot de passe entre 4 et 16 caractères ou caractères invalides !');  
	define('_LANG_MESSAGE_REMPLIR_ERR_2PASSW', 'Les 2 mots de passe ne sont pas identiques');  
	define('_LANG_MESSAGE_REMPLIR_ERR_DATEINSCRIP', 'Date d\'inscription Non valide - Format jj/mm/aaaa');
	define('_LANG_MESSAGE_REMPLIR_ERR_LOGINPASSWD', 'Il existe déjà un couple login/mot de passe identique');  
	
/** ---------------------------------------------------------------------- */		
/**	
* MODIFICATION Version 4.1 AJOUT
*  ajout d'une zone .... Note
* MODIFIER LE FICHIER    \adherent\gerer_fiche_adht.php +tpl
*  MODIFIER LE FICHIER    \adherent\ remplir_infogene_adh.php  + tpl
* Modifier la BD ajout de :    disponib_adht	varchar(250)  // compatibilité avec GesassoPhp spécial FB
*/	
	define('_LANG_FICHE_ADHT_COMPL', 'Observations'); //Note, Commentaire, observation  ...  {language name=fiche_adht_compl}	
	define('_LANG_FICHE_ADHT_COMPL_PLACEHOLDER', 'Ici entrer : Note, Commentaire, observation, ...');
	define('_LANG_FICHE_ADHT_COMPL_NBC', 'caractère(s) restants');
	define('_LANG_FICHE_ADHT_COMPL_NBC_TITLE', 'Le nombre de caractère(s) restants encore dans la zone texte');
	


/** ---------------------------------------------------------------------- */	

/**
* Localisation sur      /templates/adherent/liste_adht.tpl    ET   /adherent/liste_adht.php 
*/	
    define('_LANG_TITRE_LISTE_ADHT', 'Liste des '.ADHERENT_BENE.'s souhaitant afficher leurs coordonnées');	
	define('_LANG_LISTE_ADHT_INSCRIT', 'inscrits');  //{language name=liste_adht_inscrit}
/**  Messages PHP   */

/** ---------------------------------------------------------------------- */		


/**
* Localisation sur      /templates/adherent/consulter_fiche_adht.tpl    ET   /adherent/consulter_fiche_adht.php 
*/	
	define('_LANG_TITRE_CONSULT_FICHE_ADHT', 'Visualisation des informations '.ADHERENT_BENE); // consultation  Gestion si OK pour consulter fiche
/**  Messages PHP   */

/**
* Localisation sur      /templates/adherent/remplir_message_adht.tpl    ET   /adherent/remplir_message_adht.php  //** Ajout 15/04/09 FONCTION MAIL
*/	
	define('_LANG_TITRE_MAILTO_ADHT', 'Envoyer un message depuis le formulaire'); 
	define('_LANG_MAILTO_DEST_ADHT', 'Email destinataire'); //Formulaire    	
	define('_LANG_MAILTO_EMMET_ADHT', 'Email émetteur'); //Formulaire 
	define('_LANG_MAILTO_SUJET_ADHT', 'Sujet'); //Formulaire 
	define('_LANG_MAILTO_MESSAGE_ADHT', 'Votre message'); //Formulaire 
	
	define('_LANG_TPL_ENOYERMAIL_BUTTON', 'Envoyer le message'); //value="Annuler"   {language name=tpl_enoyermail_button}
	define('_LANG_TPL_ENOYERMAIL_BUTTON_TITLE', 'Envoyer le message'); //title="Annuler"    {language name=tpl_enoyermail_button_title}	
	
/**  Messages PHP   */
	define('_LANG_MESSAGE_REMPLIR_ERR_SUJET_MAIL', 'Merci d\'indiquer un sujet');
	define('_LANG_MESSAGE_REMPLIR_ERR_MESSAGE_MAIL', 'Merci de compléter le message');	
	
/** --- FIN Gestion Membres ----------------------------------------------------------- */	
	
	
	
/** --- Administration ------------------------------------------------------------------- */	
	
/**
* Localisation sur /templates/admin/tableaubord.tpl ET /admin/tableau_bord.php
*  + /adherent/export_tadhts.php  + /adherent/export_tcotis.php 
*  + /adherent/export_tadhts.php  + /adherent/export_tcotis.php 
*/
	define('_LANG_TITRE_ADMIN_TABLEAUBORD', 'Administration - Tableau de bord'); 
	define('_LANG_TABLEAUBORD_RECAP', 'Récapitulatif '.ADHERENT_BENE.'s'); 
	define('_LANG_TABLEAUBORD_INSCRIT', 'inscrits depuis');
	define('_LANG_TABLEAUBORD_NBADHTS_TITLE', 'Nombre '.ADHERENT_BENE.'s inscrits');//title=
	define('_LANG_TABLEAUBORD_COTISANTS', 'Cotisants :'); 
	define('_LANG_TABLEAUBORD_NBCOTISADHTS_TITLE', 'Nombre '.ADHERENT_BENE.'s cotisants');//title=
	define('_LANG_TABLEAUBORD_TADHTS_ICON_TITLE', 'Télécharger la table Complète Adhérents au format XLS');//title=
	define('_LANG_TABLEAUBORD_COTISATION', 'Cotisations');
	define('_LANG_TABLEAUBORD_DEPUIS', 'depuis');
	define('_LANG_TABLEAUBORD_TCOTIS_ICON_TITLE', 'Télécharger la table Complète Cotisations '.ADHERENT_BENE.'s au format XLS');// title="
	define('_LANG_EXTRAIT_TABLE' , 'Extrait de la table : '); //$title = 
	
/** ---------------------------------------------------------------------- */	
	
	
/**
* Localisation sur      /templates/admin/remplir_priorite.tpl    ET   /admin/remplir_priorite.php
*/
	define('_LANG_TITRE_ADMIN_GERER_PRIORITE_ADHERENTS', 'Gestion des priorités d\'accès '.ADHERENT_BENE.'s'); 
	define('_LANG_ADMIN_PRIORITE_CODE_PRIORITE', 'Code priorité accès'); // Code priorité accès
	define('_LANG_ADMIN_PRIORITE_CODE_PRIORITE_TITLE', '0=accès interdit, 1=Membre, 4=Membre du CA , 5=Secrétaire idem 4, 7= résorier idem 5, 9=Admin Tous les droits');
	define('_LANG_ADMIN_PRIORITE_COL_PRIORITE', 'Priorité');//admin_priorite_col_priorite
/**  Messages PHP   */
	define('_LANG_MESSAGE_SELECTIONNEZ_NOM' , 'Sélectionnez un Nom !!');
	define('_LANG_MESSAGE_PRIORITE_OK' , ' Priorité enregistrée *');
	
/** ---------------------------------------------------------------------- */		


/**
* Localisation sur      /templates/admin/liste_logs.tpl    ET   /admin/liste_logs.php 
*/
	define('_LANG_TITRE_ADMIN_LOGS', 'Historique des connexions');
	define('_LANG_ADMIN_LOGS_ENR_S', 'Enregistrements'); //au pluriel
	define('_LANG_ADMIN_LOGS_ENR', 'Enregistrement'); //au singulier
	define('_LANG_ADMIN_LOGS_EXPORT', 'Exporter les logs ?');
	define('_LANG_ADMIN_LOGS_TITLE_EXPORT', 'Exporter les logs ?');//title=
	define('_LANG_ADMIN_LOGS_CLEAR_LOGS', 'Effacer les logs ?');
	define('_LANG_ADMIN_LOGS_JS_CLEAR_LOGS', 'Êtes vous sûr(e) de vouloir supprimer les TOUS logs');//
	define('_LANG_ADMIN_LOGS_TITLE_CLEAR_LOGS', 'Effacer TOUS les logs ?');//title=
	define('_LANG_ADMIN_LOGS_COL_UTILISATEUR', 'Utilisateur'); 

/** ---------------------------------------------------------------------- */		


/**
* Localisation sur /templates/admin/maint_bd.tpl ET /admin/maint_bd.php 
*/	
	define('_LANG_TITRE_ADMIN_MAINT_BD', 'Maintenance de la Base de données');
	define('_LANG_STITRE_ADMIN_MAINT_BD', 'Maintenance Générale');
	define('_LANG_ADMIN_MAINT_BD_OPTIM', 'Optimiser toutes les tables pour une meilleure performance. ');//
	define('_LANG_ADMIN_MAINT_BD_OPTIM_BUTTON', 'Optimisation');
	define('_LANG_ADMIN_MAINT_BD_TYPEBD', 'Sélectionner le type de sauvegarde de la base de données');//
	define('_LANG_ADMIN_MAINT_BD_SAV_STRUCT', 'Sauvegarder la structure');
	define('_LANG_ADMIN_MAINT_BD_SAV_DATA', 'Sauvegarder les données des tables. (le contenu important)'); 
	define('_LANG_ADMIN_MAINT_BD_BUTTON_TITLE', 'Sauvegarder le fichier au format sql'); // title=
/**  Messages PHP   */
	define('_LANG_MESSAGE_TABLES_OPT', 'Tables optimisées');
	
/** ---------------------------------------------------------------------- */		
	
	
/**
* Localisation sur /templates/admin/remplir_preferences.tpl ET /admin/remplir_preferences.php
*/	 
	define('_LANG_TITRE_ADMIN_PREFERENCES', 'Préférences administration - Modification des informations ...');
	define('_LANG_PREF_MESSAGETITRE', 'Nom de l\'espace');	 // Indiquez le le nom de l'espace :  Exemple  'Espace Mon association .....'   {language name=pref_messagetitre}
	define('_LANG_PREF_MESSAGETITRE_TITLE', 'Exemple : Espace Mon association ');	 // '   {language name=pref_messagetitre_title}	
	define('_LANG_PREF_NOM_ASSO_GESTASSOPHP', 'Nom de Association');
	define('_LANG_PREF_NOM_ASSO_GESTASSOPHP_TITLE', 'Indiquez le Nom de l\'association');	
	define('_LANG_PREF_DATE_DEBANNEE_ASSO', 'Année de début');
	define('_LANG_PREF_DATE_DEBANNEE_ASSO_TITLE', 'Année de début de l\'Association  pour le tableau de bord');	
	define('_LANG_PREF_NB_LIGNES_PAGE', 'Nb de lignes par page');
	define('_LANG_PREF_NB_LIGNES_PAGE_TITLE', 'Nb de lignes pour l\'affichage de la page : 20 (NE PAS modifier cela convient en général)');	
	define('_LANG_PREF_EMAIL_ADRESSE', 'Adresse mail Administrateur');
	define('_LANG_PREF_EMAIL_ADRESSE_TITLE', 'Adresse mail de contact de l\'administrateur pour tout problème de l\'espace');	
	define('_LANG_PREF_ADHERENT_BENE', 'Nom définissant les membres');	
	define('_LANG_PREF_ADHERENT_BENE_TITLE', '(Ex adhérent, sociétaire, bénévole, ou ...)  mettre au singulier');	
	define('_LANG_PREF_ADHERENT_BENE_INFO', 'Désignation, au singulier, du nom des membres de l\'espace, qui apparaîtra dans les menus et pages (Ex adhérent, sociétaire, bénévole, ou ...)');
	define('_LANG_PREF_LANG_FICHE_ADHT_ANT_INFO', 'Désignation en fonction de l\'association : Antennes, Sections, Secteurs d\'activité, ou ...');	//  en fonction de l'association les antennes ou sections ou secteurs d'activité
	define('_LANG_PREF_LANG_FICHE_ADHT_ANT', 'Nom définissant les activités');
	define('_LANG_PREF_LANG_FICHE_ADHT_ANT_TITLE', 'En fonction de l\'association : Antennes, Sections, Secteurs d\'activité');	
// nom des onglets des pages
	define('_LANG_TITRE_ADMIN_PREFTAB1', 'Préférence Association');// titre de l'onglet 1  						preference_asso
	define('_LANG_TITRE_ADMIN_PREFTAB2', 'Détail des désignation des activités');	// titre de l'onglet 2  	types_antennes
	define('_LANG_TITRE_ADMIN_PREFTAB3', 'Détail des types de cotisations');	// titre de l'onglet 3  	types_cotisations
	define('_LANG_PREF_COL_DESIGNATION_ACTIV', 'Nom des activités'); // {language name=pref_col_designation_activ}
	define('_LANG_PREF_NEW_DESIGNATION', 'Indiquer le nouveau nom'); // {language name=pref_nex_designation}
	define('_LANG_PREF_NEW_DESIGNATION_TITLE', 'Indiquer le nouveau nom de la liste'); // {language name=pref_new_designation}
	define('_LANG_PREF_NEW_DESIGNATION_PLACEHOLDER', 'Ici entrer la désignation activité');
	define('_LANG_PREF_COL_DESIGNATION_MODIF_ICON_TITLE', 'Modifier le nom'); // 	{language name=pref_col_designation_modif_icon_title}
	define('_LANG_PREF_COL_DESIGNATION_COTIS', 'Nom des types de cotisation'); // {language name=pref_col_designation_cotis}
	//+ ajout montant cotisation dans préférences
	define('_LANG_PREF_NEW_MONT_COTISATION', 'Montant de la cotisation'); // {language name=pref_new_mont_cotisation}
	define('_LANG_PREF_NEW_MONT_COTISATION_TITLE', 'Indiquer le montant de la cotisation en chiffres (Ex 10.50 - 10 Point 50) qui définie sera par défaut');
	define('_LANG_PREF_COL_DESIGNATION_COTIS_PLACEHOLDER', 'Ici entrer la désignation cotisation');
	define('_LANG_PREF_NEW_MONT_COTISATION_PLACEHOLDER', 'Ici entrer le montant cotisation en chiffres');
	define('_LANG_PREF_COL_MONT_COTISATION', 'Montant cotisation'); // {language name=pref_col_mont_cotisation}
	// + la date de "Date fin cotisation" affiché par défaut
	define('_LANG_PREF_LANG_JMA_FIN_COTIS_INFO', 'Indiquer le jour/mois/année de fin de cotisation au format jj/jj/aaaa. Exemple 31/12/2011 ou 30/09/2011 pour le menu '. _LANG_MENU__GESTION_COTIS);	

	
/**  Messages PHP   */
	define('_LANG_MESSAGE_REMPLIR_CHAMP', 'Champ Vide'); 
			
/** --- FIN Administration -------------------------------------------------------- */	


/** --- Adhérents ------------------------------------------------------------------- */	

/**
* Localisation sur      /templates/adherent/liste_adht_admin.tpl    ET   /adherent/liste_adht_admin.php 
*/		
	define('_LANG_TITRE_ADMIN_LISTE_ADHT', 'Gestion des '.ADHERENT_BENE.'s');	
	define('_LANG_ADMIN_LISTE_ADHT_ATT', 'ATTENTION Suppression impossible de la fiche N°');
	define('_LANG_ADMIN_LISTE_ADHT_DATE_F_COTIS', 'Date de fin de cotisation : ');
	define('_LANG_LISTE_ADHT_PARMI', 'parmi les noms/prénoms');
	define('_LANG_ADMIN_LISTE_ADHT_ADDADHT_BUTTON_TITLE', 'Ajouter un '.ADHERENT_BENE);//title=
	define('_LANG_ADMIN_LISTE_ADHT_ADDADHT_BUTTON', 'Ajouter '.ADHERENT_BENE);
	define('_LANG_ADMIN_LISTE_ADHT_COL_INSCRIPT', 'Inscription');
	define('_LANG_ADMIN_LISTE_ADHT_COL_ECH', 'Ech. Cotis ');
	define('_LANG_ADMIN_LISTE_ADHT_COL_ENR', 'Enr');
	define('_LANG_LISTE_ADHT_VISU_ICON_TITLE', 'Visualisation des informations '.ADHERENT_BENE);//title="
	define('_LANG_ADMIN_LISTE_ADHT_FICHE_DEL_ICON_TITLE', 'Fiche supprimée');//title=
	define('_LANG_ADMIN_LISTE_ADHT_ENR_TITLE', 'Fiche enrgistrée par : ');//title="
	define('_LANG_ADMIN_LISTE_ADHT_ADDFILE_TITLE', 'Joindre un fichier');
	define('_LANG_ADMIN_LISTE_ADHT_COTIS_ICON_TITLE', 'Gérer les cotisations');//title=
	define('_LANG_ADMIN_LISTE_ADHT_JS_CONFIRM_DELFICHE', 'Êtes vous sûr(e) de vouloir supprimer la fiche N°');
	define('_LANG_ADMIN_LISTE_ADHT_DEL_FICHE_ICON_TITLE', 'Supprimer la fiche');//title="
	// ajout messages si suppression
	define('_LANG_LISTE_COTIS_ADHT_ARCHIV_ALERT', 'Impossible d\'archiver la fiche cotisation');
	define('_LANG_ADMIN_LISTE_ADHT_ALERT_PRIORITE', 'Niveau de priorité : ');
	define('_LANG_ADMIN_LISTE_ADHT_ALERT_PRIORITE_0', 'Impossible d\'archiver la fiche il faut changer le niveau de priorité à 0');
	
/**  Messages PHP   */
	define('_LANG_MESSAGE_ADMIN_LISTE_ADHT_', 'NON règlée'); 
	
/** ---------------------------------------------------------------------- */	


/**
* Localisation sur      /templates/adherent/liste_cotisations_adht.tpl    ET   /adherent/liste_cotisations_adht.php 
*/		
	define('_LANG_TITRE_ADMIN_LISTE_COTIS_ADHT', 'Gestion des cotisations '.ADHERENT_BENE.'s'); 
	define('_LANG_LISTE_COTIS_ADHT_TEXT_LESCOTIS', 'les cotisations du');//les cotisations du
	define('_LANG_LISTE_COTIS_ADHT_TEXT_AU', 'au');//au 
	define('_LANG_LISTE_COTIS_ADHT_SELECT_DATE_D', 'Sélectionner la date de début au format jj/mm/aaaa');
	define('_LANG_LISTE_COTIS_ADHT_SELECT_DATE_F', 'Sélectionner la date de fin au format jj/mm/aaaa');
	define('_LANG_LISTE_COTIS_ADHT_COTIS', 'Cotisation');
	define('_LANG_LISTE_COTIS_ADHT_COTISS', 'Cotisations');
	define('_LANG_LISTE_COTIS_ADHT_ADDCOTIS_BUTTON', 'Ajouter une cotisation');//title=
	define('_LANG_LISTE_COTIS_ADHT_ADDCOTIS_BUTTON_TITLE', 'Ajouter une cotisation');//Bouton 
	define('_LANG_LISTE_COTIS_ADHT_COL_D_ENR', 'Date Enr');
	define('_LANG_LISTE_COTIS_ADHT_COL_D_DEB', 'Début');
	define('_LANG_LISTE_COTIS_ADHT_COL_D_FIN', 'Fin');
	define('_LANG_LISTE_COTIS_ADHT_COL_TYPE', 'Type');
	define('_LANG_LISTE_COTIS_ADHT_COL_MONTANT', 'Montant');
	define('_LANG_LISTE_COTIS_ADHT_COL_STATUT', 'Statut');
	define('_LANG_LISTE_COTIS_ADHT_LISTE_TITLE', 'Liste des cotisations '.ADHERENT_BENE);//title=
	define('_LANG_LISTE_COTIS_ADHT_VISU_FICHE_TITLE', 'Visualisation fiche détail '.ADHERENT_BENE);//title=
	define('_LANG_LISTE_COTIS_ADHT_MODIF_ICON_TITLE', 'Modifier la fiche cotisation');//title=
	define('_LANG_LISTE_COTIS_ADHT_ARCHIV_ICON_TITLE', 'Archiver la fiche cotisation');//title=
	define('_LANG_LISTE_COTIS_ADHT_CONSULT_ICON_TITLE', 'Consulter la fiche cotisation archivée');//title=		
/**  Messages PHP   */
	define('_LANG_MESSAGE_LISTE_COTIS_ADHT_ARCHIV', 'Archivée'); //Archivée
	define('_LANG_MESSAGE_LISTE_COTIS_ADHT_DATE_DEB', 'Date de début Non valide - Format jj/mm/aaaa');
	define('_LANG_MESSAGE_LISTE_COTIS_ADHT_DATE_FIN', 'Date de fin Non valide - Format jj/mm/aaaa'); 
	
/** ---------------------------------------------------------------------- */	

/**
* Depuis  V 7.3
* Localisation sur /templates/adherent/archiverenserie_cotisations_adht.tpl ET/adherent/archiverenserie_cotisations_adht.php 
*/	
	define('_LANG_TITRE_ADMIN_LISTEARCHIV_COTIS_ADHT', 'Archiver en série des cotisations'); 
	define('_LANG_LISTE_LISTEARCHIV_ADHT_COTIS', 'avant le');
	define('_LANG_MESSAGE_LISTEARCHIV_ADHT_ARCHIV', 'Archivée-Série'); //Archivée--Série
	

/**  Messages PHP   */	
	define('_LANG_MESSAGE_LISTEARCHIV_ADHT_ERREUR', 'ERREUR sur cotisation N&deg;');

/** ---------------------------------------------------------------------- */	
	
	
/**
* Localisation sur      /templates/adherent/remplir_cotisations_adht.tpl    ET   /adherent/remplir_cotisations_adht.php 
*/	
	define('_LANG_TITRE_ADMIN_FICHE_COTIS_ADHT', ADHERENT_BENE.'s - Fiche cotisation '); 	//    {language name=titre_admin_fiche_cotis_adht}
	define('_LANG_TITRE_ADMIN_FICHE_COTIS', 'Gestion des cotisations '); 
	define('_LANG_FICHE_COTIS_ADHT_DATE_ENR', 'Date d\'enregistrement');
	define('_LANG_FICHE_COTIS_ADHT_DATE_ENR_TITLE', 'date enregistrement de la fiche au format jj/mm/aaaa');//title=
	define('_LANG_FICHE_COTIS_ADHT_MONTANT', 'Montant cotisation');
	define('_LANG_FICHE_COTIS_ADHT_MONTANT_TITLE', 'Somme en Euros (séparateur décimal point)');//title=
	define('_LANG_FICHE_COTIS_ADHT_TYPE', 'Type cotisation');
	define('_LANG_FICHE_COTIS_ADHT_DATE_DEB', 'Date début cotisation');
	define('_LANG_FICHE_COTIS_ADHT_DATE_FIN', 'Date fin cotisation');
	define('_LANG_FICHE_COTIS_ADHT_COMM', 'Commentaire');
	define('_LANG_FICHE_COTIS_ADHT_MPAIE', 'Moyen de paiement'); //+ Ajout Zone PAIEMENT Gestion Cotisations
	define('_LANG_FICHE_COTIS_ADHT_COMM_TITLE', 'Information sur la cotisation');//title=
	define('_LANG_FICHE_COTIS_ADHT_COMM_PLACEHOLDER', 'Ici entrer vos information cotisation ');
	define('_LANG_FICHE_COTIS_ADHT_RAISON', 'Raison de l\'archivage');
	define('_LANG_FICHE_COTIS_ADHT_RAISON_TITLE', 'Information sur archivage');// title=
	define('_LANG_FICHE_COTIS_ADHT_RAISON_PLACEHOLDER', 'Ici entrer votre Information OBLIGATOIRE');
	define('_LANG_FICHE_COTIS_ADHT_JS_CONFIRM_ARCHIV', 'Êtes vous sûr(e) de vouloir archiver la fiche N° '); // +(e)
	define('_LANG_FICHE_COTIS_ADHT_ARCHIV_BUTTON_TITLE', 'Archiver la fiche');
	
	// Add pour Visulisation avant impression  Ajout le 27/01/2009
	define('_LANG_FICHE_COTIS_ADHT_VISU_BUTTON', 'Visualiser');	
	define('_LANG_FICHE_COTIS_ADHT_VISU_BUTTON_TITLE', 'Pour impression éventuelle');
	define('_LANG_TITRE_ADMIN_FICHE_VISU_COTIS_ADHT', 'Reçu cotisation ');
	define('_LANG_FICHE_COTIS_ADHT_EURO', 'Euros');
	define('_LANG_FICHE_COTIS_VISU_FAITLE', 'Fait le ');	
	//+ ajout montant cotisation si création fiche
	define('_LANG_FICHE_COTIS_ADHT_MONTANT_COTIS', 'Le "Montant cotisation" sera validé en fonction du "Type cotisation" défini dans "'._LANG_MENU_ADMIN_GESTION_PREF.'"');
	define('_LANG_FICHE_COTIS_ADHT_MONTANT_COTIS_ALERT', 'Attention si vous modifiez le "Type cotisation", vous devez aussi modifier le "Montant cotisation"');
	
	 //{language name=fiche_cotis_adht_montant_cotis}
	
/**  Messages PHP   */
    define('_LANG_MESSAGE_COTIS_ADHT_ALERT_ARCHIV', 'ATTENTION !! - Date de fin cotisation Non échue');
    define('_LANG_MESSAGE_COTIS_ADHT_ARCHIV', 'ARCHIVAGE');
    define('_LANG_MESSAGE_COTIS_ADHT_RAISON_ARCHIV', 'Indiquez la raison de l\'archivage');
    define('_LANG_MESSAGE_COTIS_ADHT_CONSULT_ARCHIV', 'Consultation Fiche archivée');
    define('_LANG_MESSAGE_COTIS_ADHT_ALERT_MONTANT', 'Indiquez le montant en chiffres (Ex 10.50 - 10 Point 50)'); // modif 27/10/11
    define('_LANG_MESSAGE_COTIS_ADHT_ALERT_TYPE', 'Indiquez le type de la cotisation');
    define('_LANG_MESSAGE_COTIS_ADHT_ALERT', 'Date de Fin Inférieure ou égale à date de début '); 
    define('_LANG_MESSAGE_COTIS_ADHT_ALERT_DATE_ENR', 'Date d\'enregistrement Non valide');
    define('_LANG_MESSAGE_COTIS_ADHT_ALERT_NOM', 'Indiquez le nom du ');
    define('_LANG_MESSAGE_COTIS_ADHT_ALERT_NOCREATION', 'Création IMPOSSIBLE une fiche existante déjà - Procéder à l\'archivage de cette fiche avant d\'en créer une nouvelle'); 
	define('_LANG_MESSAGE_COTIS_ADHT_ALERT_EXIST1', 'la fiche');  //{language name=message_cotis_adht_alert_exist1}
	define('_LANG_MESSAGE_COTIS_ADHT_ALERT_EXIST2', 'existe déjà - Vous pouvez procéder à l\'archivage de cette fiche avant d\'en créer une nouvelle');
	define('_LANG_MESSAGE_COTIS_ADHT_ALERT_EXIST01', 'existe déjà - Voulez vous en créer une nouvelle');
	define('_LANG_MESSAGE_COTIS_ADHT_AUTRE_FEN', '!! Ouvrir la fiche dans une autre fenêtre !!'); 
    define('_LANG_MESSAGE_COTIS_ADHT_ALERT_DEB_FIN', 'La période d\'adhésion chevauche la période commençant le ');
    define('_LANG_MESSAGE_COTIS_ADHT_ALERT_FICHE', 'sur la fiche ');
    define('_LANG_ARRAY_SELECTIONNEZ_TYPE', 'Sélectionnez le type');//$tab_nomcotis = array('' => ('Sélectionnez le type'))

/** ---------------------------------------------------------------------- */	


/**
* Localisation sur      /templates/adherent/liste_fichiers_adht.tpl    ET   /adherent/liste_fichiers_adht.php  // voir Module  la gestion des fichiers   
*/			
	define('_LANG_TITRE_ADMIN_LISTE_FICHIERS_ADHT', 'Gestion des fichiers '.ADHERENT_BENE.'s');
	define('_LANG_LISTE_FICHIERS_ADHT_PARMI', 'parmi les noms '.ADHERENT_BENE.'s');//  {language name=liste_fichiers_adht_}
	define('_LANG_LISTE_FICHIERS_ADHT_FILES', 'Fichiers');
	define('_LANG_LISTE_FICHIERS_ADHT_FILE', 'Fichier');	
	define('_LANG_LISTE_FICHIERS_ADHT_ADFILE_BUTTON', 'Ajouter fichier');
	define('_LANG_LISTE_FICHIERS_ADHT_ADFILE_BUTTON_TITLE', 'Pour ajouter fichier');//title="
	define('_LANG_LISTE_FICHIERS_ADHT_VISU_FILE_ICON_TITLE', 'Visualisation des informations fichier');//title=
	define('_LANG_LISTE_FICHIERS_ADHT_DOWNLOAD_FILE_ICON_TITLE', 'Télécharger le fichier');//title=
	define('_LANG_LISTE_FICHIERS_ADHT_JS_CONFIRM_FILE', 'Êtes vous sûr(e) de vouloir supprimer le fichier N° ');
	define('_LANG_LISTE_FICHIERS_ADHT_DEL_FILE_ICON_TITLE', 'Supprimer le fichier');//title=
	define('_LANG_LISTE_FICHIERS_COL_NOMFICHIER', 'Nom fichier'); //   {language name=liste_fichiers_col_nomfichier}
/**  Messages PHP   */
    define('_LANG_MESSAGE_LISTE_FICHIERS_ADH_FILE', 'Le fichier'); 
    define('_LANG_MESSAGE_LISTE_FICHIERS_ADH_NOTEXIST', 'n\'existe pas');

/** ---------------------------------------------------------------------- */	
	
	
/**
* Localisation sur      /templates/adherent/remplir_fichier_adht.tpl    ET   /adherent/remplir_fichier_adht.php  // voir Module  la gestion des fichiers
*/	
	define('_LANG_TITRE_ADMIN_FILE_ADHT', ''.ADHERENT_BENE.'s - Gestion fichier '); //   {language name=titre_admin_file_adht}
	define('_LANG_FILE_ADHT_UPLOAD', 'Upload depuis Votre ordinateur vers le serveur');
	define('_LANG_FILE_ADHT_MAX', 'Le fichier (maxi 100 Ko)');
	define('_LANG_FILE_ADHT_TITLEMAX', NB_CARRACT_FILE.' caractères maximum');//title=
	define('_LANG_FILE_ADHT_MODIF', 'Modifier la description ou le destinataire');
	define('_LANG_FILE_ADHT_DATEI', 'Date d\'inscription');
	define('_LANG_FILE_ADHT_NAME', 'Le nom du fichier');
	define('_LANG_FILE_ADHT_NAME_TITLE', 'Le nom du fichier'.NB_CARRACT_FILE.'caractères maxi');
	define('_LANG_FILE_ADHT_DESCRIPT', 'Description du fichier');
	define('_LANG_FILE_ADHT_DESCRIPT_TITLE', 'Description en 50 caractères');
	define('_LANG_FILE_ADHT_DESCRIPT_PLACEHOLDER', 'Ici 50 caractères maxi');	
	define('_LANG_FILE_ADHT_TO', 'destinataire');
	define('_LANG_FILE_ADHT_BY', 'Fichier déposé par');
/**  Messages PHP   */
    define('_LANG_MESSAGE_FILE_UPLOAD', 'Upload Fichier');
    define('_LANG_MESSAGE_FILE_CONSULT', 'Consultation Fichier supprimé');
    define('_LANG_MESSAGE_FILE_ADHT_MOVE', 'Fichier déplacé vers '.ADHERENT_BENE);
    define('_LANG_MESSAGE_FILE_ADHT_NAME', 'Indiquez le nom '.ADHERENT_BENE.' destinataire');
    define('_LANG_MESSAGE_FILE_FILE_NOADMIT_ERROR', 'Fichier NON autorisé sur le serveur');
    define('_LANG_MESSAGE_FILE_FILE_ERROR', 'Erreur le fichier');
    define('_LANG_MESSAGE_FILE_FILE_EXIST_ERROR', 'existe déjà dans la base ');
    define('_LANG_MESSAGE_FILE_FILE_NAME_ERROR', 'Erreur le nom du fichier : ');
    define('_LANG_MESSAGE_FILE_LONGFILE_ERROR', 'est trop long ');
    define('_LANG_MESSAGE_FILE_NOVALIDFILE_ERROR', 'contient des caractères NON valides');
    define('_LANG_MESSAGE_FILE_NOFILE_ERROR', 'Vous avez omis de transmettre le fichier');
    define('_LANG_MESSAGE_FILE_FILE_TAILLE_ERROR', 'Vérifier la taille du fichier :');
    define('_LANG_MESSAGE_FILE_FILE_MAX_ERROR', '!! Elle doit être inférieure a 300 Ko');

/** ---------------------------------------------------------------------- */	

	
	
/** --- FIN Adhérents ----------------------------------------------- */	
/** ---------------------------------------------------------------------- */	

/**
* ------------------------------------------------------------------
* LES TABLEAUX ET LISTES DEROULANTES
* ------------------------------------------------------------------
*/		
	$T_CIVILITE = array( 'Monsieur'=>'Monsieur','Madame'=>'Madame', 'Mademoiselle'=>'Mademoiselle');
	// Priorités
	$T_PRIORITE_ACCESS = array('1'=>'1-Membre normal', '4'=>'4-Membre CA', '5'=>'5-Secrétaire', '7'=>'7-Trésorier', '9'=>'9-Administrateur', '0'=>'0-Accès INTERDIT');	
	// Nb de lignes par page
	$T_AFFICHE_NB_PAGE = array(	10 => '10',	20 => '20',	50 => '50',	0 => 'Tous '); 		
	// pour afficher le filtrage des membres dans Admin / liste des membres 
	$T_AFFICHE_FILTRE_MEMBRES = array(0 => 'Les membres actifs', 1 => 'Les membres à jour', 2 => 'Les membres en retard',3 => 'Les fiches supprimées',4 => 'Toutes les fiches');
	// pour afficher le filtrage des cotisation  adhérents dans Admin 
	$T_AFFICHE_FILTRE_COTISATIONS = array(0 => 'Les fiches actives', 1 => 'Toutes les fiches', 2 => 'Les fiches archivées');

// voir Module  la gestion des fichiers		
	// pour afficher le filtrage des fichiers  dans Admin / liste des fichiers 
	$T_AFFICHE_FILTRE_FICHIERS = array(0 => 'Les fichiers actifs', 1 => 'Tous les fichiers', 2 => 'Les fichiers supprimés');

//   html_options name="tranche_age_adht"   remplir_infogene_adht 
	$T_TRANCHE_AGE = array( ''=>'', 'Moins de 25 ans'=>'Moins de 25 ans','de 25 a 55 ans'=>'de 25 a 55 ans', 'Plus de 55 ans'=>'Plus de 55 ans');
	$T_OUI_NON = array ('Non'=>'Non','Oui'=>'Oui',); 
	// Attention  Only modify  the text after  =>   eg.  $T_OUI_NON = array ('Non'=>'No','Oui'=>'Yes', );

// Ajout Zone PAIEMENT Gestion Cotisations	 html_options name="paiement_cotis"  remplir_cotisations_adht //+21/02/2016 Paypal
	$T_PAIEMENT_COTIS = array('chq'=>'Chèque','esp'=>'Espèces', 'c_b'=>'Carte bancaire', 'pay'=>'Paypal','aut'=>'Autre');	

/** ---------------------------------------------------------------------- */	
	

?>
