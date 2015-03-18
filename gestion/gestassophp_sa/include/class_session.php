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
 *  Directory :  /ROOT_DIR_GESTASSO/include/
 *   Fichier : class_session.php
 *   Classe session PHP 5
*/


   /**
        * PHP 5 uniquement
        * Classe de gestion  des sessions et accés pour GestAssoPhp
        *
        * @author inconu du web + JCE
        * @copyright  None -  modifiée par JCE 21/10/2009
        * @version 1.00
        * 
       */

	class Sessions { 
    /**
	 * Exemple : $masession = new sessions()  			
            * @access  public
            * @param  new sessions(
	 *			
	*/
	
	/**
	* Defini si l'object session est cree
	*/
		private static $instance;
		
    /**
	* Demarre la session utilisateur et fixe la variable statique
	*/
			public static function getInstance() 
			{
			if (!isset(self::$instance)) {
			self::$instance = new Sessions();
			}
			return self::$instance;
			}
	/**
	* Constructeur
	*/  		
			public function __construct() 
			{ 
			session_start(); 
			} 
    /**
            * Fonction - get_var_session() Obtenir une variable de session
	 * Insérer ce code avec le nom de la variable existante afin de récupéré la valeur de cette variable.
	 * Exemple : $valeur = $masession->get_var_session('nom_de_la_variable');	 
            * @access  public
            * @param $var_nom -  La variable à obtenir
	 *	.
            */	
			public function  get_var_session($key) 
			{ 
			return isset($_SESSION[$key]) ? $_SESSION[$key] : FALSE; 
			} 
    /**
            * Fonction - set_var_session() Instancier une varible de session
	 * Insérer ce code afin d'attribuer une valeur à une variable de session.
	 * Exemple : $masession->set_var_session('nom_de_la_variable','valeur');	 
            * @access  public
            * @param $var_nom - Nom de la variable
            * @paran $var_val  - Valeur de la variable $$var_nom
	 *	
           */	
			public function set_var_session($key, $value) 
			{ 
			$_SESSION[$key] = $value; 
			} 

    /**
            * Fonction - end_session()  Détruire la session 
	 * Insérer ce code afin de détruire la session en cours d'utilisation.
	 * Exemple : $masession->end_session(); 	 
            * @access  public
            * @param  Aucun
	 *		
            */	
			public function end_session() 
			{ 
			session_unset(); 
			session_destroy(); 
			} 


// AJOUT POUR CONTROLE 
    /**
            * Fonction - verifie_LogingPaswd_bd() Récupere le Login et pass de la base de donnée.
	 * Exemple : $logpass=$masession->verifie_LogingPaswd_bd($sessionadherent);			
            * @access  public
            * @param  $sessionadherent  -  Le nom de la sesion adhérent passé lors de l'authentification
	 * @return  $logpass=array($log,$pas);  --> $log = $logpass[0]; et 	$pas = $logpass[1];
            */	
			
			public function verifie_LogingPaswd_bd($sessionadherent)
            {
			global $db;
			$logpass=array(0,0);
			$req_verif_login = "SELECT login_adht,password_adht FROM  "
			.TABLE_ADHERENTS." WHERE id_adht= '$sessionadherent'";
			//$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
			$dbresult = $db->Execute($req_verif_login);
			$log = $dbresult->fields['login_adht'];
			$pas = $dbresult->fields['password_adht'];
			$dbresult->Close() ;
			return  $logpass=array($log,$pas);
            }
	
    /**
            * Fonction -write_log()  Add : 23/05/20007 écrit la requete
	 * Inscrit les logs dans la base de donnée
	 * Exemple : $ecritlog=$masession->write_log("Action_xx",$nom_adht." ".$prenom_adht);	 
            * @access  public
            * @param  $action_log - Login Déconnexion ErreurLogin - Creer xx -- Delete xx -- Modif xx
	 * @param  $nomprenom = $nom_adht  + $prenom_adht
	 *	
            */	
	
			public function write_log($action_log,$nomprenom)
			{
			global $db;
			$date_log = date('Y-m-d H:i:s');
			//  SI + logs IP
			$ip = ($_SERVER['REMOTE_ADDR']);
			$req_insert_log = "INSERT INTO ".TABLE_LOGS."( Date_log,Ip_log,Nom_Log,Action_Log)"
				. "VALUES('$date_log','$ip','$nomprenom','$action_log') ";		
			$dbresult = $db->Execute($req_insert_log);			
				
			}

			
	//--- FIN class sessions	
} 


?>