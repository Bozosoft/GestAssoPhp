<?php
/**
* Titre........... : PHPMySQLBackup
*
* Description..... : Fait la même chose que mysqldump mais en PHP sans utiliser le shell avec des +
*
* version......... : 0.60 -- Modification  par JCE
* date............ : 12 mai 2003 /  may 12 2003 -- Modification 07/08/2008 par JCE
* fichier/file.... : phpmysqldump.pclass.php
*
* Auteur/author... : Pascal CASENOVE  phpdev@cawete.com  http://www.cawete.com/pascal/php/phpmysqldump/phpmysqldump.zip
* English version. : Eve CASENOVE     eve@cawete.com
*
* licence......... : The GNU General Public License (GPL)
*					 http://www.opensource.org/licenses/gpl-license.html
*
* changements..... : fixe set_timeout automatique, separe ( merci à ADL )
*					 ajout de la sauvegarde au vol sans compression du fichier
*					 réécriture de la méthode backup pour en faciliter la lecture
*
* A faire......... : compression à la volée
*					 une autre class en préparation pour sauvegarder en une seule opreration
*					 les bases et le site dans un seul fichier compressé
*
* Todo	.......... : fly compress
*
* Suggestion...... : Pour toutes remarques, suggestions ... n'hésitez pas à me contacter
*					 pascal@cawete.com et gestassophp.free.fr pour les modifications
*
* Description .... : Pour faire une sauvegarde d'une base MySQL l'outil habituel est mysqldump
*					 fourni avec MySQL.
*					 Pour l'utiliser en PHP il faut avoir un accès au shell et qu'il soit dans le path.
*					 Cela n'est pas toujours le cas selon l’hébergeur, le système, Microsoft, Linux ...
*					 J'avais besoin d'un outil qui me génère une sauvegarde totale de base au format
*					 le plus courant et indépendant de la plateforme.
*					 Comme la sauvegarde doit pouvoir être faite par un utilisateur de base, le systeme
*					 doit être simple : j'ouvre la page web je télécharge le fichier, c'est fini.
*					 le fichier peut être compresse avec la gzlib de PHP, donc sans utiliser le shell et
*					 quelque soit le système d'exploitation.
*
*					 Pour la restoration je n'ai rien prévu, simplement parce que, pour reconstruire une base
*					 il vaut mieux savoir et vérifier ce que l'on fait. il vaut donc mieux utiliser un des
*					 nombreux outils prévus a cet effet qui travaillent en direct sur le port MySQL.
*					 Certain outils de traitement des fichier sql ne supportent pas les commentaires.
*					 en mettant $class->format_out = "no_comment" le problème est réglé.
*
* Remarques ...... : Le fichier de sauvegarde est créer dans le répertoire du script
* 					 vous devez donc avoir le droit d’écrire dans ce répertoire
*					 la sécurité n'est pas gérée par cette classe. Si vous ne le faite pas
*					 avec des htaccess ou du code n'importe quel visiteur peut avoir une copie de vos bases
*					 La compression est désactive pour la sauvegarde a la volée.
*
* Méthodes........ : **nettoyage()
*					   permet de vider le répertoire temporaire dans lequel sont crées les sauvegardes.
*					   Si cette méthode n'est pas utilisée les sauvegardes sont archivées.
*
*                    **backup($fichier)
*					   réalise la sauvegarde dans le fichier $fichier
*					   si $fichier est omis un nom de fichier est attribué (méthode recommandée)
*					   le fichier est crée dans un sous répertoire temp du répertoire ou s’exécute le script
*					   Si temp n'existe pas il est cree.verifiez bien si vous avez le droit d'écrire.
*					   Pour la sauvegarde a la volée ( $fly = 1 ) rien n'est écrit sur le disque.
*					   le nom du fichier est utilisé pour le transfert HTTP.
*
*					 **compress()
*					   compresse au format gzip le fichier crée avec backup et le renomme en .gz
*					   il vaut mieux utiliser le flag compress_ok pour activer ou désactiver l'utilisation de la méthode.
*
* Proprietes...... : **format_out
* Property			   si ="no_comment" la sauvegarde est faite sans commentaires
*					   utilisé pour certains outils de restoration. A n'utiliser que si votre outil de restoration
*					   ne lit pas correctement le fichier
*
*					 **$fly
*					   la sauvegarde n'est pas écrite sur le disque elle est directement telegargee
*					 **$compress_ok
*					   active la compression gz sauf si $fly on (= 1)
*
*
* Parametres...... : $sav = new phpmysqldump($link, $host, $user, $password, $base, $langue);
* Parameters
*					 **$link est un link vers une base déjà ouverte, les autres paramètres sont alors ""
*					 si $link est "" les autres paramètres sont utilisés et n'ont pas besoin de commentaires
*					 se sont les paramètres de la base à sauvegarder
*
*   				 **$langue par défaut "fr" et "en" supporté
*
* ******************************************************************
* 07/08/2008 par JCE- GestAssoPhp  Ajout - Modification
*  - Sauver ou non les tables
*  - Modification ajout espace après -- X dans les commentaire sinon cela provoque une erreur a l'import BD
* 27/10/2009 PHP 5.3  //
*  - supprimé -> //!!!!  Function mysql_list_tables() is deprecated  -
*  - On remplace par l'exemple sur  http://fr.php.net/manual/fr/function.mysql-list-tables.php
* 29/12/2009 remplace var par private ou public PHP5
* 16/01/2013 merci à Olivier Humez
*  - Ajout de la ligne : if(is_null($tbl)){return "NULL";} else if($tbl==""){return "''";};
*  - Correction OHV0.0 pour empêcher la sauvegarde de "" en NULL
* 21/09/2014  ajout sécurité sur "SHOW TABLES."
* 12/01/2017 MODIFICATION NE PASremplacer mysql par mysqli pour export PHP 5.6.x chez FREE.fr à cause de la base de données
*
*
* modifié par JCE - GestAssoPhp
* @package   GestAssoPhp+Pg 2020
* Directory :  /ROOT_DIR_GESTASSO/include/
* Fichier :	phpmysqldump.class.php.free.php a renommer en phpmysqldump.class.php pour utlisateur sur les pages perso FREE.FR
*/

/*******************************************************************
*    class
********************************************************************/

class phpmysqldump
{
	private $link;				// lien vers la base à sauvegarder
	private $base;				// nom de la base
	private $host;				// nom ou ip du serveur de MySQL
	public $filename; 			// nom du fichier de sauvegarde
	private $sousdir = "temp/";	// sous répertoire dans lequel s'effectue la sauvegarde avec le / final
	private $version = "0.6";  	// "0.53" -> .06 par JCE
	private $format_out;		// format de sortie null : mysql(i) pour un dump "no_comment" idem sans commentaires
	private $language;			// pret pour d'autres langues défaut "fr" sinon "en"
	public $fly;				// flag si oui sauvegarde au vol
	public $compress_ok;		// flag pour la compression
	public $data_yes = 1;			// 1 = données  0 = pas de données
	public $errr;				// remontees d'erreurs

// Ajout - Modification 07/08/2008 par JCE
	public $struct_yes = 1;		// 1 = structure  0 pas de stucture

	private $no_time_limit = TRUE; // si la fonction set_time_limit() est désactivée devient FALSE
								 // time limit for big database

	private $fp = ''; // add PHP5.3 27/10/2009

/***** constructeur */

	//function phpmysqldump( $host, $user, $password, $base, $langue = "fr", $link = NULL)
	function __construct ($host, $user, $password, $base, $langue = "fr", $link = NULL)
	{
		$this->language = $langue;
		// recherche si set_time_limit() est désactivée
		if(get_cfg_var("safe_mode")){
			$this->no_time_limit = FALSE;
		}
		//

		//ouverture de la base
		if($link){ 			// si un lien ouvert vers la base est fourni
			$this->link = $link;
		}else{				// sinon login password ...
			$this->link = @mysql_connect($host, $user, $password);

			if(!$this->link ){$this->errr = $this->message("err_mysql"); return false;}
		}

		if(!mysql_select_db($base)){$this->errr = $this->message("err_base"); return false;}

		$this->base = $base;
		$this->host = $host;
	}
/***** FIN du constructeur */


/***** dirige la sortie du dump navigateur client ou fichier */
	function ecrire($val){
// ATTENTION les accents sont sauvegardé comme : Adhérents, Chèque reçu Sté Générale
		//if($this->fly){echo $val;}else{fwrite($this->fp, $val);} // Sauvegarde prévue pour BD en utf8_general_ci

// ATTENTION les accents sont sauvegardé comme : AdhÃ©rents  ChÃ¨que reÃ§u  StÃ© GÃ©nÃ©rale)
		if($this->fly){echo utf8_encode($val);}else{fwrite($this->fp, utf8_encode($val));} // Sauvegarde prévue
	}

/***** ------------------------------------------------------------ */
// si envoi vers le navigateur entete HTTP
	function entete($filename){
		header("Content-type: application/force-download");
    	header("Content-Disposition: inline; filename=\"" . $filename . "\"");
		header("Expires: Mon, 1 Jul 1999 01:00:00 GMT");
    	header("Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0");
	}

/***** dump de la base */
// si $fichier null ignoré sinon utilise comme nom de fichier de sauvegarde
	function backup($fichier = "")
	{
		$fp = ''; // ajout PHP 5.x Undefined variable
		if($this->fly){$this->sousdir = "";}
		if($this->errr)
		{
			return false;
		}else{

			if($fichier){ 					// si un nom de fichier en paramètre on l'utilise
				$this->filename = $this->sousdir.$fichier;
			}else{							// sinon on en genere un
				$this->filename = $this->sousdir."backup_".$this->base."_".date("Y_m_d__G_i").".sql";
			}
		   if($this->fly){  				// sauvegarde a la volée
		   		$this->entete($this->filename);
		   }else{
		   		@mkdir($this->sousdir,700);	// création du répertoire s'il n'existe pas
		   		$fp = @fopen($this->filename,"w");
				if (!$fp){$this->errr = $this->message("err_fichier"); return false;}
		   }

			$this->fp = $fp;
			$this->backup_suite($fichier);
			if(!$this->fly){fclose($fp);}
		}
		if($this->compress_ok && !$this->fly){$this->compress();}
	}

/***** construction du backup */
	function backup_suite($fichier = "")
	{
			$this->backup_comment("debut");
			$sql = "SHOW TABLES FROM ".($this->base);
			$result = mysql_query($sql);

			// Check $result // ++ 21/09
				if (!$result) {
					{$this->errr = $this->message("err_mysql_table"); return false;}
				}
			while ($row = mysql_fetch_row($result))

			{ $tablename = $row[0] ;


// si on veut  sauver les tables	 ..CREATE TABLE ...   Ajout - Modification 07/08/2008 par JCE
				if($this->struct_yes == 1){
					$this->backup_comment("debut_table", $tablename);
					// début du query on supprime la table si elle existe déjà
					$this->ecrire("DROP TABLE IF EXISTS `$tablename`;\n");

					// création des tables
					$query = "SHOW CREATE TABLE $tablename";
					$tbcreate = mysql_query($query);

					$row = mysql_fetch_array($tbcreate);

					$create = $row[1].";";
					$this->ecrire("$create\n\n");
				}
// si on veut ne pas sauver les tables	 ..CREATE TABLE ...  Modification 07/08/2008 par JCE

				// récupération des data
				if($this->data_yes == 1){

					$query = "SELECT * FROM $tablename";
					$datacreate = mysql_query($query);

					if (mysql_num_rows($datacreate) > 0) 	// *** si la table n'est pas vide

					{
						$this->backup_comment("debut_dump", $tablename);
						// sauvegarde des données
						$qinsert = "TRUNCATE TABLE ".$tablename." ; \n";	//TRUNCATE TABLE   Modification 07/08/2008 par JCE
						$qinsert .= "LOCK TABLES $tablename WRITE; \n";
						$qinsert .= "INSERT INTO `$tablename` values \n  ";

						while($row12 = mysql_fetch_assoc($datacreate))

						{
							   if($this->no_time_limit){set_time_limit(30);}
							   $row12 = array_map(array($this, 'separe'), $row12);	// mise en forme des data dans le tableau

							   $data = implode(",",$row12);							// tableau -> chaine unique
							   $data = "$qinsert($data)";							// assemblage pour value() pour 1er enregistrement
							   $this->ecrire("$data\n");
							   $qinsert = ", ";										// pour les enregistrements suivant une virgule suffit

						}
						$this->ecrire(";\n");
						$this->ecrire("UNLOCK TABLES; \n");
						$this->ecrire("\n");
					}else{								// *** si la table est vide
						$this->backup_comment("empty", $tablename);
				  }
			  }
		  //$i++;  // supprimé -> modification !!!!  Function mysql_list_tables() is deprecated
		  }
	}

/*****  en tete du fichier dump */
	function backup_comment($section, $tablename = ""){
		if($this->format_out == "no_comment"){return;}

// en-tête du fichier dump Modification ajout espace après le 2 premiers -- dans les commentaires, cela provoque une erreur à l'import BD
		if($section == "debut"){
			$this->ecrire("-- PHPMySQLDump $this->version \n");
			$this->ecrire("--  phpdev@cawete.com   - http://jc.etiemble.free.fr \n");
			$tt = $this->spe();			// voir la remarque à la fin
			$this->ecrire("$tt \n");
			$this->ecrire("--\n");
			$this->ecrire("-- Host : $this->host     Database :  $this->base\n");
			$this->ecrire("--\n");
			$this->ecrire("-- Date : ".date("r")."    \n");
			$this->ecrire("-- ---------------------------------------------\n");
			$server_info = mysql_get_server_info($this->link);

			$this->ecrire("-- Server version            $server_info \n");
			$this->ecrire("\n");
		}
		// commentaires de début de table

		if($section == "debut_table"){
			$this->ecrire("\n");
			$this->ecrire("\n");
			$this->ecrire("--\n");
			$this->ecrire("-- Table structure for table '$tablename' \n");
			$this->ecrire("--\n");
			$this->ecrire("\n");
		}

		// commentaires de début de data
		if($section == "debut_dump"){
			$this->ecrire("--\n");
			$this->ecrire("-- Dumping data for table '$tablename' \n");
			$this->ecrire("--\n");
			$this->ecrire("\n");
		}
		// commentaires pour tables vides
		if($section == "empty"){
			$this->ecrire("--\n");
			$this->ecrire("-- table '$tablename' is empty \n");
			$this->ecrire("--\n");
			$this->ecrire("\n");
		}

	}

/***** fonction utilisée pour séparer les data */
// utilisée dans array_map dans backup pour formater la récupération du query
	function separe($tbl)
	{
		if(is_null($tbl)){return "NULL";} else if($tbl == ""){return "''";};	// Correction OHV0.0 15/01/2013 pour empêcher la sauvegarde de "" en NULL
		//$tbl  =mysql_escape_string($tbl); 	// prépare les data pour être injectées dans mysql

		$tbl = mysql_real_escape_string($tbl); // mysql_escape_string remplacer par  mysql_real_escape_string function is deprecated PHP 5.x
		if(is_numeric($tbl)){ return $tbl;}	// si un chiffre, c'est bon
		if(!$tbl){return "NULL";}			// si c'est null on le dit
		return "'".$tbl."'";				// pour le reste entre guillemets simple
	}

/***** ------------------------------------------------------------ */
// compresse un fichier sans utiliser le shell
// pour ne pas se préocuper de la plateforme sur laquelle tourne le script
// juste vérifier que la GZLIB de PHP est bien active
	function compress()
	{
		if($this->filename and !$this->errr){
			$fp = @fopen($this->filename,"rb");
			$zp = @gzopen($this->filename.".gz", "wb9");
			if(!$zp or !$fp){$this->errr = $this->message("err_compress"); return false; }
			while(!feof($fp)){
				$data = fgets($fp, 8192);			// taille du buffer php = 8192
				gzwrite($zp, $data);
			}
			fclose($fp);
			gzclose($zp);
			unlink($this->filename);
			$this->filename = $this->filename.".gz";
		}

	}

/***** ------------------------------------------------------------ */
// pour suprimer les fichiers de sauvegarde du serveur
	function nettoyage()
	{ 	if(!$this->errr){
			if ($dir = @opendir($this->sousdir))
			{
				while($file = @readdir($dir))
				{
					@unlink($this->sousdir.$file);
				}
				@closedir($dir);
			}
		}
	}

/***** juste pour vous faire consulter la doc de PHP */
// Remarque
// http://www.tools4noobs.com/online_php_functions/base64_encode/
	function spe()
	{
		return base64_decode("LS0gUGFzY2FsIENBU0VOT1ZFICAtIE1vZGlmaWNhdGlvbiBKZWFuLWNsYXVkZSBFdGllbWJsZQ==");
	}

/***** messages d'erreur */
	function message($numero){

		$lang = $this->language;
		if(!$lang){$lang = "fr";}

		$message['err_compress']['fr'] = 'Erreur de compression de fichier';
		$message['err_compress']['en'] = 'Error when compress file';

		$message['err_fichier']['fr'] = 'Erreur d\'ouverture de fichier';
		$message['err_fichier']['en'] = 'Error when open file';

		$message['err_base']['fr'] = 'base mysql inexistante';
		$message['err_base']['en'] = 'mysql database not exist';

		$message['err_mysql']['fr'] = 'Erreur d\'ouverture de mysql';
		$message['err_mysql']['en'] = 'mysql server not found';

		$message['err_mysql_table']['fr'] = 'Erreur mysql SHOW TABLES'; // ++ 21/09
		$message['err_mysql_table']['en'] = 'mysql server error SHOW TABLES';	 // ++ 21/09

		return $message[$numero][$lang];
	}
}
?>
