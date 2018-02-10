<?php
/**
 * Projet : gestassophp_sa [GestAssoPhp+Pg]
 * ---------------------------
 * Licence Creative Commons selon les termes du présent contrat appelé Contrat Public Creative Commons 
 * Auteur original : Jean-Claude Etiemble  Sauf spécification commentées
 * @link :  http://creativecommons.org/licenses/by-sa/2.0/fr/  - Paternité - Partage à l'Identique 2.0 France (CC BY-SA 2.0)
 * ---------------------------
 *	
 * @author : JC Etiemble - http://jc.etiemble.free.fr
 * @version :  2018
 * @copyright 2007-2018 (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */
 
/**
 *  Directory :  /ROOT_DIR_GESTASSO/include/
 *   Fichier :
 *   Les FONCTIONS  pour PHP > 5.x
*/



/**
 * Fonction Joins a path together using proper directory separators
 * Taken from: http://www.php.net/manual/en/ref.dir.php
**/
function join_path()
{
 	$num_args = func_num_args(); //Retourne le nombre d'arguments passés à la fonction
	$args = func_get_args(); // func_get_args — Retourne les arguments d'une fonction sous forme de tableau
	$path = $args[0];

	if( $num_args > 1 )	{
		for ($i = 1; $i < $num_args; $i++)
		{
			$path .= DIRECTORY_SEPARATOR.$args[$i];
		}
	}

	return $path;
}


/**   
*    Fonction récupere sur forum     passe du format 1972-02-09 au format francais et inversement
*	12/02/2006 --> 2006-02-12   	2006-02-12--> 12-02-2006  ou 2006/02/12-->12-02-2006
*    retourne "" si $date n'est pas defini
*  modifié par fonction  http://dotclear.placeoweb.com/post/PHP-5.3 le 15/10/2009  UNIQUEMENT 2009-07-14 => 14/07/2009
*/
function switch_date($date) 
{
    if ($date) {
	// Convertir date MySQL en date FR : 2009-07-14 => 14/07/2009
	return preg_replace('/(\d{1,2})\/(\d{1,2})\/(\d{1,4})/', '\3-\2-\1', $date);	
    } else {
        return '';
    }
}

 
/** 
 * Fonction   passe du format 2006-02-12 -->12/02/2006 pour affichage apres requete SQL Modif de JCE 	
 * echo switch1_date("12 02 2006") ;
 * echo switch_sqlFr_date("2006-02-12") ;
 *  modifié par fonction  http://dotclear.placeoweb.com/post/PHP-5.3 le 15/10/2009
*/ 
function switch_sqlFr_date($date) 
{
//echo ' voir1='.$date;
    if ($date) {
//echo ' Date->2='.$date;
	// Convertir date MySQL en date FR : 2009-07-14 => 14/07/2009
	return preg_replace('/(\d{2,4})-(\d{1,2})-(\d{1,2})/', '\3/\2/\1', $date);		
    } else {
        return '';
    }
}


/**  
* Fonction  passe du format 2006-08-16 11:48:22 --> 12/02/2006  11:48:22 ( format francais)  apres requete SQL Modif de JCE 	
 *  modifié par fonction  http://dotclear.placeoweb.com/post/PHP-5.3 le 15/10/2009
*/  
function switch_date_heure($date) 
{
    if ($date) {
	// Convertir date time MySQL en date FR : 2009-07-14 19:31:59 => 14/07/2009 à 19h31
	return preg_replace('/(\d{2,4})-(\d{1,2})-(\d{1,2}) (\d{2}):(\d{2}):(\d{2})/', '\3/\2/\1  \4h\5', $date);	
	} else {
        return '';
	}
}


/**
* Fonction Comparer 2 dates  Description : Retourne vrai si la date 1 est inférieure ou égale à la date 2, sinon retourne faux. <br /> <br /> Format des dates : aaaa-mm-jj
www.nexen.net/index.php?option=com_nexen_v2&Itemid=119&lang=FR&nexen_url_type=intern&nexen_path=%252Fscripts%252Fdetails.php%253Fscripts%253D1133
 *  modifié par fonction  explode  le 15/10/2009 ->date1= 2009-10-15 date2= 2009-12-31  date1explode $a1.'#'. $m1.'#'.  $j1  = 2009#10#15 date2ex= 2009#12#31
*/  
function compare_date($d1 , $d2) 
{
//echo 'd1='.$d1 .' d2='. $d2 ;
if ($d1 == '') $d1 = '0000-00-00' ; // évite date NULL
if ($d2 == '') $d2 = '0000-00-00' ; // évite date NULL
//echo 'date1= '. $d1 .' date2= '.$d2 ;
	if (!$d1 || !$d2 == "") { // si une date est vide // idem v5.2
		list ($a1, $m1, $j1) = explode('-', $d1); 
		list ($a2, $m2, $j2) = explode('-', $d2); 
	//echo 'date1ex= '.  $a1.'#'. $m1.'#'.  $j1 .' date2ex= '. $a2. '#'. $m2.'#'.  $j2 ;
		if($a1 < $a2) 
		return true; 
		elseif($a1 > $a2) 
		return false; 
		elseif($a1 == $a2) 
			{ 
			if($m1 < $m2) 
			return true; 
			elseif($m1 > $m2) 
			return false; 
			elseif($m1 == $m2) 
				{ 
				if($j1 < $j2) //if($j1 <= $j2)  si la date arrivant au leur dernier jour de cotisation //Sinon  pour faire si la date 1 est inférieure seulement à la date 2
				return true; 
				elseif($j1 > $j2) 
				return false; 
				} 
			}
	}
}

/**
* Fonction Verifie si une date est bien entre au format jj/mm/aaaa
 * check_madateFR($date)    bool checkdate ( int $month , int $day , int $year )
 * $date = date au format 26/07/2007
 * http://de3.php.net/manual/fr/function.checkdate.php
 * Modif JCE avec ereg()
  *  modifié par fonction explode le 15/10/2009  preg_match("/^(\d{2})\/(\d{2})\/(\d{4})$/"  NOTA \/  pour /


  if (( check_madateFR("32/03/2008") )== TRUE) {
				echo 'OK';
			} else {
				echo 'ERREUR';
			}
*/ 
function check_madateFR($date)
{
	$date = (trim($date));
	if (!isset($date) || $date=="00/00/0000"){
	    return true; // évite les erreur si date vide
	}
//echo $date ;
	if (preg_match("/^(\d{2})\/(\d{2})\/(\d{4})$/" , $date, $regs)) {
//echo '** '.$regs[2].$regs[1].$regs[3] ;		
		return (checkdate($regs[2],$regs[1],$regs[3])) ;		
	} else {
		return false;
	}
}

	
/**
*  3 Fonctions Basées sur  functions.inc.php
 * - Fonctions utilitaires Gallette
 *  Copyright (c) 2003 Frédéric Jaqcuot 

 *  Récupère la variable passée en Post ou get
 * 	$var= get_post_variable("var","$defaut");
 * 	 $Var = variable récupérée
 * 	 var  valeur passée en Post ou get
 * 	 $defaut = valeur par défaut si necessaire si,on ""
*/  	
function get_post_variable($nom_var, $par_defaut)
{
	$valeur = $par_defaut;
	if (isset($_GET[$nom_var])) {
		$valeur = $_GET[$nom_var]; 
	} elseif (isset($_POST[$nom_var])) {
		$valeur = $_POST[$nom_var];	
	}	
	return $valeur;
}


/**
 *  Récupère  la variable passée en Post ou get
 *  Modification JCE  + htmlentities($_GET['msg'], ENT_QUOTES)	   http://fr.php.net/htmlentities   Tous les caractères qui ont des équivalents en entités HTML sont effectivement traduits
 *  Modification JCE  + ou http://fr.php.net/manual/fr/function.htmlspecialchars.php   pour éviter que des données fournies par les utilisateurs contiennent des balises HTML
 * <script>alert("Je t'ai eu !");</script>
*/  
function get_post_variablehtml($nom_var, $par_defaut)
{
	$valeur = $par_defaut;
	if (isset($_GET[$nom_var])) {
		$valeur= htmlspecialchars($_GET[$nom_var], ENT_QUOTES, 'UTF-8');
	} elseif (isset($_POST[$nom_var])) {
		$valeur= htmlspecialchars($_POST[$nom_var], ENT_QUOTES, 'UTF-8');		
	}	
	return $valeur;
}

//-----------------------------
function get_variable($nom_var, $par_defaut)
{
	$valeur = $par_defaut;
	if (isset($_GET[$nom_var])) {
		$valeur = $_GET[$nom_var];
	}
	return $valeur;
}

function post_variable($nom_var, $par_defaut)
{
	$valeur = $par_defaut;
	if (isset($_POST[$nom_var])) {
		$valeur = $_POST[$nom_var];		
	}	
	return $valeur;
}
//-----------------------------


/**
*  Fonction Vérifie si la variable donnée est de type numérique
*/
function get_post_variable_numeric($nom_var, $par_defaut)
{
	$valeur = get_post_variable($nom_var, $par_defaut);
	if (!is_numeric($valeur)) {
		$valeur = $par_defaut; // $valeur = ''; // renvoi la valeur par défaut Modif Jce
	}	
	return $valeur;
}	


/**
*  Fonction Retourne le dernier identifiant généré par un champ de type AUTO_INCREMENT  généré par la table MySQL
* // http://fr3.php.net/manual/fr/function.mysql-insert-id.php By rudolflai at gmail dot com  et  Ben AT alfreido.com
* $id = Identifiant champ de la table
*  $table= Nom de la table	
*/
function my_last_id($id,$table)
{
	global $db;
	if ($id && $table) {
//	    	$dbresult = $db->Execute("SELECT '.$id.' FROM ".$table);
//		SELECT id_adht FROM gs0_adherent  Attention ne pas supprimer de ligne
//		return $dbresult->RecordCount();
        $res = $db->Execute('SELECT max('.$id.') AS maxid FROM '.$table);
        $max = ($row = $res->FetchRow()) ? $row['maxid'] : NULL;
		return $max ;
	} else {
		return false;
	}	
}	


/** 
*   http://www.zend.com/code/codex.php?id=285&single=1
* 
*  is_valid_email(): an e-mail validation utility routine 
*  Version 1.1.1 -- September 10, 2000 
*  
*  Written by Michael A. Alderete 
*  Please send bug reports and improvements to: <michael@aldosoft.com> 
*  
*  You should clean up the input e-mail address in your code before you 
*  validate it, with trim() and strtolower(), if you're planning to save 
*  it into a database or otherwise preserve it beyond the one-time use. 
*  The validator doesn't depend on it, but you'll want to save clean data! 
*   
*  Example of usage: (assumes the user entry form variable is $f_email) 
*  
*     $f_email = strtolower(trim($f_email)); 
*     if (is_valid_email($f_email)) { 
*            // Do database save here 
*            // Or send them a confirmation e-mail 
*     } 
* 
*/
 function is_valid_email ($address) {
  return (preg_match(
                     '/^[-!#$%&\'*+\\.\/0-9=?A-Z^_`{|}~]+'.   // the user name
                     '@'.                                     // the ubiquitous at-sign
                     '([-0-9A-Z]+\.)+' .                      // host, sub-, and domain names
                     '([0-9A-Z]){2,4}$/i',                    // top-level domain (TLD)
                     trim($address)));
}


/** 
*  Fonction servant à transformer le résultat d'une variable $tel au format d'un numéro de téléphone à 10 chiffres
*  Variable au format numéro téléphone 
*  http://www.phpinfo.net/page/archives/astuces/variable-au-format-numero-telephone/
*  Proposée le 29-05-2002 | Par Christian Remy |  http://www.phpinfo.net/mailto.php?christian:karatel.fr
*  modifié par fonction  explode  le 15/10/2009   par  preg_replace
* http://www.php.net/manual/fr/function.preg-replace.php  mixed preg_replace ( mixed $pattern , mixed $replacement , mixed $subject [, int $limit= -1 [, int &$count ]] )
*/
function NumTel($tel) 
{ 
    $ch = 10;                               // Numéro à 10 chiffres 
	    $tel = preg_replace('/[^0-9]/',"",$tel); // supression sauf chiffres 
    $tel = trim($tel);                      // suppression espaces avant et après 
    if (strlen($tel) > $ch) { 
        $d = strlen($tel) - $ch; // retrouve la position pour ne garder 
                                 // que les $ch derniers 
    } else { 
        $d = 0; 
    } 
    $tel = substr($tel,$d,$ch); // récupération des $ch derniers chiffres 
	$regex = '/([0-9]{1,2})([0-9]{1,2})([0-9]{1,2})([0-9]{1,2})([0-9]{1,2})$/'; 
    $newtel = preg_replace($regex, 
        '\\1 \\2 \\3 \\4 \\5',$tel); // mise en forme  Modif JCE remplace - par espace
    return $newtel; /* Exemple : 03-81-51-45-78  --> 03 81 5 1 45 78 */ 
} 

/**
* Fonctions utilitaires  --> Galette
* Copyright (c) 2003 Frédéric Jaqcuot
*/ 
function resizeimage($img,$img2,$w,$h)
{
//echo $img.$img2.$w.'--'.$h;
	if (function_exists("imagecreate")) {
		$ext = substr($img,-4);
		$imagedata = getimagesize($img);
		$ratio = $imagedata[0]/$imagedata[1];
		if ($imagedata[0]>$imagedata[1]){
			$h = $w/$ratio;
	} else {
			$w = $h*$ratio;
	}		
		$thumb = imagecreate ($w, $h); // modif
			switch($ext)
			{
				case ".jpg":			
					$image = ImageCreateFromJpeg($img);
					imagecopyresized ($thumb, $image, 0, 0, 0, 0, $w, $h, $imagedata[0], $imagedata[1]);
					imagejpeg($thumb, $img2);
					break;
				case ".png":
					$image = ImageCreateFromPng($img);
					imagecopyresized ($thumb, $image, 0, 0, 0, 0, $w, $h, $imagedata[0], $imagedata[1]);
					imagepng($thumb, $img2);
					break;
				case ".gif":
					if (function_exists("imagegif"))
					{
						$image = ImageCreateFromGif($img);
						imagecopyresized ($thumb, $image, 0, 0, 0, 0, $w, $h, $imagedata[0], $imagedata[1]);
						imagegif($thumb, $img2);
					}
			break;					
			}
	}
}	   

 
 
/**
 * Fonction pour tester le nom du fichier sans caractéres spéciaux et sans espace // (^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*$)
*/ 
function validname($string) 
{
   // modification ajout  A-Z passage  à preg_match SINON majuscules = caractères NON valides
	if (preg_match ("(^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*$)", $string)) {
         return true;
    } else {
        return false;
    }
}
    	

/**
 * Fonction pour verifier si le Login + Mot de passe est unique
*/ 
function loginpass_unique($check_login,$check_pass) 
{
	global $db;
    $req_verif_loginunique = "SELECT login_adht, password_adht FROM ".TABLE_ADHERENTS ;
    $req_verif_loginunique .= " WHERE login_adht = '$check_login' AND password_adht = '$check_pass'"; 
	$dbresult = $db->Execute($req_verif_loginunique);	
	$nombre_adht = $dbresult->RecordCount() ;
		// si le couple  ogin_adht, password_adht est unique  -> OK
	    if ($nombre_adht == 0 ) {
	        return true;
	    } else {
	        return false;
	    }
}		




/**
 * Fonction pour verifier si le Login ou Mot de passe contiennent les  bons caractères !!
 * si les caractères sont OK renvoie TRUE
*/ 

function is_valid_mylogin($my_variable)
{
	return preg_match("/^[a-zA-Z0-9_-]{4,20}+$/", trim($my_variable));
}

function is_valid_mypasswd($my_variable)
{
	return preg_match("/^[a-zA-Z0-9_-]{4,16}+$/", trim($my_variable)); // passe de 10 à 16 caractères
}
	
	
/**
 * Fonction renvoie l'age en fonctionde la date 2010-25-01
 * age(1974-01-31')
 *  http://blog.jaysalvat.com/articles/snippet-php-calculer-un-age-a-partir-date-de-naissance.php
*/ 
	
function age($date) 
{ 
	if ($date) {
		$age = date('Y') - date('Y', strtotime($date)); // 12/01/17 // correction non well formed numeric value
			if (date('md') < date('md', strtotime($date))) { 
				return $age - 1; 
			} 
		return $age; 
	} else {
        return '';
    }
} 

/**
 * Fonctions Fin 
*/ 

?>
