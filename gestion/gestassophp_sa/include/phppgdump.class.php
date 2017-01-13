<?php
/**
* Titre........... : PHPMyPostgreSQLBackup
* Description..... :  sauvegarde de la base de données PostgreSQL en PHP
* Description..... : faire une sauveagrde de base PostgreSQL en utilisant un script PHP. 
* version......... : 1.00.00  13 dec 2009 par JCE76350  jc _ point _ etiemble _ arobase _ gmail _ point _ com
* fichier/file.... :  phppgdump.class.php
*
*
* Modification du fichier original pgBackupRestore2.class.php  http://www.phpclasses.org/browse/package/4141.html
* Using the original file pgBackupRestore2.class.php  (http://www.phpclasses.org/browse/package/4141.html)  
* Add some details  ;) To be compatible with  
* PHPMySQLBackup (Auteur/author... : Pascal CASENOVE  phpdev@cawete.com  http://www.cawete.com/pascal/php/phpmysqldump/phpmysqldump.zip
* for using to GestAssoPhp http://gestassophp.co.cc/cms/gestassophp.html
* 
* ------------------------------------------ original file --------------------------
 * I would say thanks to the guy who wrote the script i found on:
 * http://www.weberdev.com/get_example-4282.html
 * The class can also restore a database from a previously generated backup by executing the SQL statements stored in a backup file.
 *  pgBackupRestore v2   (http://www.phpclasses.org/browse/package/4141.html)  
 *  Date: 30th November 2007
 * Author: Michele Brodoloni <michele.brodoloni@xtnet.it>
 * Changelog:
 * - Fixed issue with bytea fields
 * - Fixed issue with empty values in NOT NULL fields
 * - Added custom header
 * - Added 2 more options to backup data preserving database structure (dataonly, usetruncatetable)
 * - Added some default statements included in every backup file (~ line 227)
 * - Added encoding support 
 * - Improved error checking
* ------------------------------------------ / original file --------------------------


/////////////////////////////////

* Methodes........ : 
	$pg_sav->nettoyage(); // facultatif enleve les anciens fichiers de sauvegarde / empty the temp directory SI utilisation SAV avec fichier sur l'espace
*		**nettoyage() 
*					   permet de vider le repertoire temporaire dans lequel sont crees les sauvegardes
*					   si cette methode n'est pas utilisee les sauvegardes sont archivées.
*	 $pg_sav->backup();  // 	or  $pg_sav->backup( $sql_file); 
*                    **backup($fichier) 
*					   realise la sauvegarde dans le fichier $fichier
*					   si $fichier est ommis un nom de fichier est attribue (methode recomandee)
*					   le fichier est cree dans un sous repertoire temp du repertoire ou s'execute le script
*					   Si temp n'existe pas il est cree.verifiez bien si vous avez le droit d'ecrire. 
*					   Pour la sauvegarde a la volée ( $fly=1 ) rien n'est ecrit sur le disque.
*					   le nom du fichier est utilise pour le transfert HTTP
*		 **$fly 
*					  la sauvegarde n'est pas écrite sur le disque elle est directement téléchargée
*					  The backup is not write on the server, it send to the browser on fly.
*		 **$compress_ok
*					active la compression gz sauf si $fly
*					 Activate compression exept if $fly is on (=1)
*
* Parametres...... :     
*	$pg_sav = new phpmypostgresqldump ($db_host, $db_user, $db_pass, $source_db,$dbport,$dblangue);
		$host, $user, $password, $base, $port = '', $langue="fr"
		$db_host = 'localhost';
		$db_user = 'user';
		$db_pass = 'pass'; 
		$source_db='name_DBt';
		$dbport = '5432'; // Local  5432
		$dblangue = 'fr'  or 'en'
*		
*	$pg_sav->encoding = "UTF8"; // Encodoge Base   (Supported are: SQL_ASCII and UTF8. Unknown behaviour with others.)
*
*	 $pg_sav->backup();  // 	or  $pg_sav->backup( $sql_file); 								
*
*/
/////////////////////////////////
/*
* 29/12/2009 remplace var par  private ou public PHP5
* version......... : 1.01  pour gestassophp 2010
*/


class phpmypostgresqldump {  //  basée sur  phpmysqldump 

//**** variables *********************************************
	private $link;				// lien vers la base a sauvegarder 
	private $base;				// nom de la base		
	private $connected = false;	// connexion
	private $host;				// nom ou ip du serveur de MySQL	
	private $port; 				//$port = 5432  tu devrais autoriser postgresql à utiliserle support tcp/ip   regarde dans /var/lib/pgsql/data/postgresql.conf  // By default PostgreSQLt listen on TCP port 5432
	private $filename; 			// nom du fichier de sauvegarde	
	private $fp;
	private $sousdir='';	// sous repertoire dans lequel s'effectue la sauvegarde avec le / final  exemple  sousdir='temp/';
	private $version = '1.0.1';
	public $fly;				// flag si oui=1 sauvegarde au vol SINON 0
	public $compress_ok;		// flag pour la compression	 		// juste verifier que la GZLIB de PHP est bien active		// if you have an erroz verify if your PHP hve the GZLIB
	public $data_yes = 1;		//1 = données  0 pas de données 											
	public $struct_yes = 1;		// 1 = structure  0 pas de stucture
	public $encoding = 'SQL_ASCII'; 	//   Database Encoding  (Supported are: SQL_ASCII and UTF8. Unknown behaviour with others.)
	//---[ Database related variables   
	private $query_id;
	private $record = array();
	private $tables = array();
	private $backuponlytables = array();
	private $excludetables = array();
	private $row = 0;
   //---[ Error Handling
   	public $errr;				// remontees d'erreurs	   
	private $gotsqlerror = false;
	private $lastsqlerror = '';
	private $language;			// pret pour d'autres langues defaut "fr" sinon "en" "sp" "ge" 	// language
	private $pkeywords = array('desc');  //---[ Protected keywords
	private $usecompleteinsert = false;    // Include table names into INSERT statement
	private $usedroptable = true;    // Drop the table before re-creating it
	private $usetruncatetable = false;    // Adds TRUNCATE TABLE statement (for data only dump)
	private $ignorefatalerrors = false;   // Script keeps running after encountering a fatal error


	
//**** constructeur *********************************************

//	function phpmypostgresqldump ($host, $user, $password, $base,$langue, $port,) {
	function __construct ($host, $user, $password, $base, $langue, $port) {
		$this->language=$langue;
		//Établit une connexion PostgreSQL
		$this->link = pg_pconnect("host=${host} port=${port} dbname=${base} user=${user} password=${password}");
			if(!$this->link){$this->errr=$this->message('err_pg_sql'); return false;} //("Impossible de se connecter à la base");
		$this->base = $base;
		$this->host = $host;		
		$this->connected = ($this->link) ? true : false;
		pg_set_client_encoding($this->link, $this->encoding ); // Choisit l'encodage du client PostgreSQL
	}
   

	function _fixoptions() {
      // Checks and fix for incompatible options
		if ($this->struct_yes) {
	//		$this->data_yes = false;
			$this->usedroptable = true;
			$this->usetruncatetable = false;
		}

		if ($this->data_yes) {
	//		$this->struct_yes = false;
			$this->usedroptable = false;
			$this->usetruncatetable = true;
		}
	}
   
	function query($uisql) {
		if (!$this->connected) return (false);
		$this->row = 0;
		$this->query_id = @pg_query($this->link, $uisql);
		$this->lastsqlerror = trim(str_replace("ERROR:", "", pg_last_error($this->link)));
		$this->gotsqlerror = ($this->lastsqlerror) ? true : false; 
		return $this->query_id;
	}

	function next_record() {
		if (!$this->query_id) return (false);
		$this->record = @pg_fetch_array($this->query_id, $this->row++);
		if (is_array($this->record)) 
			return(true);
		else {      
			pg_free_result($this->query_id);
			$this->query_id = 0;
			return(false);
		}
	}

	function get($uifield) {
		if (is_array($this->record) && array_key_exists($uifield, $this->record))
			return $this->record[$uifield];
		else
			return (NULL);
	}

	function field_names() {
		if (!$this->query_id) return(false);
		$n = @pg_num_fields($this->query_id);
		$columns = Array();

		for ($i=0; $i<$n ; $i++ )
			$columns[] = @pg_field_name($this->query_id, $i);

		return $columns;
	}

    function escape_keyword($uiKeyword) {
		if (in_array($uiKeyword, $this->pkeywords))
			return('"'.$uiKeyword.'"');
		else
			return($uiKeyword);
	}
 
   
 //**** fin du constructeur **************************************
 
	// dirige la sortie du dump navigateur client ou fichier
	function ecrire($val){
		if($this->fly){echo $val;}else{fwrite($this->fp, $val);}
	}

//***************************************************************
	// si envoi vers le navigateur entete HTTP							// HTTP header for on fly backup
	function entete($filename){
		header( "Content-type: application/force-download");  
    	header( "Content-Disposition: inline; filename=\"" . $filename . "\"");
		header( "Expires: Mon, 1 Jul 1999 01:00:00 GMT"); 
    	header( "Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0");
	}
	
//*******************************************	
// Start  backup
//*******************************************	
	function backup($fichier='') { // si $fichier null ignoré sinon utilise comme nom de fichier de sauvegarde
							 // $fichier is optional If is used is the name of the backup file
		$fp ='';// add PHP5 .3	Undefined variable
		if($this->fly){$this->sousdir='';}
		if($this->errr) {
			return false;
		} else { 
			
			if($fichier){ 				// *** si un nom de fichier en parametre on l'utilise // *** if you provide a file name we use it									
				$this->filename=$this->sousdir.$fichier;
			} else {						// *** sinon on en genere un // else automatic name
				$this->filename = $this->sousdir.'backup_'.$this->base.'_'.date('Y_m_d__G_i').'.sql';
			}
			
			if($this->fly){  			// sauvegarde a la volee  // on fly backup
		   		$this->entete($this->filename);
			} else {
		   		@mkdir($this->sousdir,700);	// creation du repertoire s'il n'existe pas  // tmp directory creation
		   		$fp = @fopen($this->filename,'w');
					if (!$fp){$this->errr=$this->message('err_fichier'); return false;}
			}
			$this->fp=$fp;
			$this->backup_suite($fichier);
				if(!$this->fly){fclose($fp);}
		}
		if($this->compress_ok && !$this->fly){$this->compress();}
	}
	
//*********
//	 backup
//*********
	function backup_suite($fichier='') {		// construction du backup  // build backup	
		
		$this->ecrire("-- \n-- PostgreSQL database dump \n-- \n");
		$this->ecrire("-- PHPMyPostgreSQLBackup $this->version \n");
		$tt=$this->spe();			// voir remarques à la fin  // see remark at the end  :)
		$this->ecrire("$tt \n");
		$this->ecrire("--\n");
		$this->ecrire("-- Host : $this->host     Database :  $this->base \n");
		// http://www.php.net/manual/en/function.pg-version.php
//		$server_info = pg_version($this->link);
//		$server_info = $server_info ['client'];
		//
//		$this->ecrire("-- Server version            $server_info \n");
		$this->ecrire("--\n");
		$this->ecrire("-- Date : ".date("r")."    \n");
		$this->ecrire("-- ---------------------------------------------\n");
		$this->ecrire("\n");

		$this->ecrire("-- Default options\n");
		$this->ecrire("SET client_encoding = '{$this->encoding }';\n");
		$this->ecrire("SET standard_conforming_strings = off;\n");
		$this->ecrire("SET check_function_bodies = false;\n");
		$this->ecrire("SET client_min_messages = warning;\n");
		$this->ecrire("SET escape_string_warning = off;\n");
		$this->ecrire("\n");

  
		if (empty($this->tables)) {
			$sql = "SELECT relname AS tablename\n".
                "FROM pg_class WHERE relkind IN ('r')\n".
                "AND relname NOT LIKE 'pg_%' AND relname NOT LIKE 'sql_%' ORDER BY tablename\n";
			$this->query($sql);
     
         // Checks if the current table is in the exclude array. 
				while ($this->next_record()) {
					$table = $this->get('tablename');
						if (!in_array($table, $this->excludetables))
				$this->tables[] = $this->escape_keyword($table);
				}
		} 
 
 
//*******************************************	
// TABLES Only
//*******************************************	
      //---[ PASS 3: Generating structure for each table
		foreach($this->tables as $table) { // foreach 1
		$strsql =''; // php5.3 
		
//*******************************************		  
//Structure for table
//*******************************************	
			if($this->struct_yes==1) {

				$_sequences = array();
				$this->ecrire("\n-- \n-- Structure for table '${table}' \n-- \n"); 

	         // Use DROP TABLE statement before INSERT ?
				if ($this->usedroptable)
					$this->ecrire("\n DROP TABLE ${table} CASCADE;\n");  //  cas 1  structureonly  backup_test_2009_12_11__14_50.sql
				elseif ($this->usetruncatetable)
					$this->ecrire("TRUNCATE TABLE ${table};\n");		

	            $strsql .= "CREATE TABLE ${table} ( \n";  //+ \n  
	         
	            $sql = "SELECT attnum, attname, typname, atttypmod-4 AS atttypmod, attnotnull, atthasdef, adsrc AS def\n".
	                   "FROM pg_attribute, pg_class, pg_type, pg_attrdef\n".
	                   "WHERE pg_class.oid=attrelid\n".
	                   "AND pg_type.oid=atttypid AND attnum>0 AND pg_class.oid=adrelid AND adnum=attnum\n".
	                   "AND atthasdef='t' AND lower(relname)='${table}' UNION\n".
	                   "SELECT attnum, attname, typname, atttypmod-4 AS atttypmod, attnotnull, atthasdef, '' AS def\n".
	                   "FROM pg_attribute, pg_class, pg_type WHERE pg_class.oid=attrelid\n".
	                   "AND pg_type.oid=atttypid AND attnum>0 AND atthasdef='f' AND lower(relname)='${table}'\n";
	            $this->query($sql);
	            while ( $this->next_record() ) {
					$_attnum     = $this->get('attnum');
					$_attname    = $this->escape_keyword( $this->get('attname') );
					$_typname    = $this->get('typname');
					$_atttypmod  = $this->get('atttypmod'); 
					$_attnotnull = $this->get('attnotnull');
					$_atthasdef  = $this->get('atthasdef');
					$_def        = $this->get('def');     

						if (preg_match("/^nextval/", $_def)) {
							$_t = explode("'", $_def);
							$_sequences[] = $_t[1];
						}

					$strsql .= "${_attname} ${_typname}";
						if ($_typname == "varchar") $strsql .= "(${_atttypmod})";
						if ($_attnotnull == "t")    $strsql .= " NOT NULL";
						if ($_atthasdef == "t")     $strsql .= " DEFAULT ${_def}";
					$strsql .= ", \n"; //+ \n
	            }
	            $strsql  = rtrim($strsql, ",");
	            $strsql .= ");\n";

	            //--[ PASS 3.1: Creating sequences
	            if ($_sequences) {
					foreach($_sequences as $_seq_name) {
						$sql = "SELECT * FROM ${_seq_name}\n";
						$this->query($sql);
						$this->next_record();
	               
						$_incrementby = $this->get('increment_by');
						$_minvalue    = $this->get('min_value');
						$_maxvalue    = $this->get('max_value');
						$_lastvalue   = $this->get('last_value');
						$_cachevalue  = $this->get('cache_value');

						$this->ecrire("CREATE SEQUENCE ${_seq_name} INCREMENT ${_incrementby} MINVALUE ${_minvalue} ".
	                                  "MAXVALUE ${_maxvalue} START ${_lastvalue} CACHE ${_cachevalue};\n");
	              }	
	            }
	            $this->ecrire($strsql);
				

	           //---[ PASS 5: Generating data indexes (Primary)
	            $this->ecrire("\n-- Indexes for table '${table}' \n");			

	            $sql = "SELECT pg_index.indisprimary, pg_catalog.pg_get_indexdef(pg_index.indexrelid)\n".
	                   "FROM pg_catalog.pg_class c, pg_catalog.pg_class c2, pg_catalog.pg_index AS pg_index\n".
	                   "WHERE c.relname = '${table}'\n".
	                   "AND c.oid = pg_index.indrelid\n".
	                   "AND pg_index.indexrelid = c2.oid\n";

	            $this->query($sql);
	            while ( $this->next_record()) {
					$_pggetindexdef = $this->get('pg_get_indexdef');
					$_indisprimary = $this->get('indisprimary');

				//              if (eregi("^CREATE UNIQUE INDEX", $_pggetindexdef))  // php5.3
					if (preg_replace('/^CREATE UNIQUE INDEX/','', $_pggetindexdef)) {
						$_keyword = ($_indisprimary == 't') ? 'PRIMARY KEY' : 'UNIQUE';
						$strsql = str_replace("CREATE UNIQUE INDEX", "" , $this->get('pg_get_indexdef'));
						$strsql = str_replace("USING btree", "|", $strsql);				  
						$strsql = str_replace("ON", "|", $strsql);
						//  $strsql = str_replace("\x20"," ", $strsql);  // http://www.iamcal.com/publish/articles/php/parsing_email/  $space = '[\\x20]';

	 
						list( $_pkey, $_tablename, $_fieldname) = explode("|", $strsql);
						$this->ecrire("ALTER TABLE ONLY ${_tablename} \n ADD CONSTRAINT ${_pkey} ${_keyword} ${_fieldname}; \n"); // + \n  .au milieu
						unset($strsql);  
					} 
					else $this->ecrire("${_pggetindexdef};\n");
	            }
				
	        } //  Fin   if($this->struct_yes==1)
		
		} // End  foreach 1

//*******************************************	
//  Generating relationships tables
//*******************************************	
		if($this->struct_yes==1) {
         	  
            //---[ PASS 6: Generating relationships
			$this->ecrire("\n-- Relationships for tables \n");
         
            $sql = "SELECT cl.relname AS table, ct.conname, pg_get_constraintdef(ct.oid)\n".
                   "FROM pg_catalog.pg_attribute a\n".
                   "JOIN pg_catalog.pg_class cl ON (a.attrelid = cl.oid AND cl.relkind = 'r')\n".
                   "JOIN pg_catalog.pg_namespace n ON (n.oid = cl.relnamespace)\n".
                   "JOIN pg_catalog.pg_constraint ct ON (a.attrelid = ct.conrelid AND ct.confrelid != 0 AND ct.conkey[1] = a.attnum)\n".
                   "JOIN pg_catalog.pg_class clf ON (ct.confrelid = clf.oid AND clf.relkind = 'r')\n".
                   "JOIN pg_catalog.pg_namespace nf ON (nf.oid = clf.relnamespace)\n".
                   "JOIN pg_catalog.pg_attribute af ON (af.attrelid = ct.confrelid AND af.attnum = ct.confkey[1]) order by cl.relname\n";
            $this->query($sql);
            while ( $this->next_record() ) {
               $_table   = $this->get('table');
               $_conname = $this->get('conname');
               $_constraintdef = $this->get('pg_get_constraintdef');
			$this->ecrire("\n-- Name : '${_conname}' \n"); //+
			$this->ecrire("ALTER TABLE ONLY ${_table} \n ADD CONSTRAINT ${_conname} ${_constraintdef}; \n"); // + \n au miileu
            }
			
		} //  End  if   Generating relationships tables	
//*******************************************	
// END TABLES Only
//*******************************************	

		
//*******************************************	
// DATAS Only
//*******************************************		

		if($this->data_yes == 1) {  
	        $this->ecrire("\n-- -------- \n-- DONNEES DES TABLES \n-- -------- ");		
			foreach($this->tables as $table) { // foreach  2  For DATAS
				$strsql =''; // php5.3 
				
	            $field_attribs = array();
	            //---[ PASS 4: Generating INSERTs for data
	            $this->ecrire("\n-- \n-- Data for table '${table}' \n-- \n");
				$this->ecrire("TRUNCATE TABLE ${table};\n");
				 
	            //---[ PASS 4.1: Get field attributes to check if it's null or bytea (to be escaped)
	            $sql = "SELECT * FROM ${table} LIMIT 0;\n";
	            $this->query($sql);
	            $fields = $this->field_names();

	            foreach ($fields as $field)
	               $field_attribs[$field] = $this->getfieldinfo($table, $field);
	            //---| END PASS 4.1

	            $sql = "SELECT * FROM ${table}\n";
	            $this->query($sql);

	            while ( $this->next_record() ) {
	               $record = array();
					foreach($fields as $f) {
						$data = $this->get($f);
						if ($field_attribs[$f]['is_binary']) {  // Binary Data
	                     $record[$f] = addcslashes(pg_escape_bytea($data),"\$");
						} else	{  // Strings
	                     $data = preg_replace('/\x0a/', '', $data);
	                     $data = preg_replace('/\x0d/', '\r', $data);
	                     $record[$f] = pg_escape_string(trim($data));
						}
					}
					$fieldnames = ($this->usecompleteinsert) ?  "(".implode(",",$fields).")" : "";
	               
					$strsql = "INSERT INTO ${table}${fieldnames} VALUES({". (implode("},{",$fields))."});";
					foreach($fields as $f) {
						if ($record[$f] != '')
							$str = sprintf("'%s'", $record[$f]);
						else
							$str = ($field_attribs[$f]['not_null']) ? "''" : "NULL";
	                     
						$strsql = preg_replace('/{'.$f.'}/', $str, $strsql);
					}
					$this->ecrire($strsql."\n");
					unset($strsql);
	            }
	        		
			} // End  foreach 2
		} // End  if($this->data_yes==1)

//*******************************************	
// End DATAS Only
//*******************************************		

	     $this->ecrire("\n-- \n-- PostgreSQL database dump complete \n-- \n"); // End of page
		
	} // fin function backup_suite
//*******************************************	
// End backup
//*******************************************	



    // Checks if a field can be null, in order to replace it with '' or NULL
    // when building backup sql statements
	function getfieldinfo($uitable, $uifield) {

      if (!$this->connected) return(false);
      $response = array();

      $sql = "SELECT typname, attnotnull \n".
             "FROM pg_attribute, pg_class, pg_type WHERE pg_class.oid=attrelid \n".
             "AND pg_type.oid=atttypid AND attnum>0 AND lower(relname)='${uitable}' and attname = '${uifield}';\n";

      $this->query($sql);
      $this->next_record();
      
      $not_null   = $this->get('attnotnull');
      $field_type = $this->get('typname');
      
      $response['not_null']  = ($not_null == 't') ? true : false;
      $response['is_binary'] = ($field_type == 'bytea') ? true : false;

      return $response;
	}

 

   // Use this method when you don't need to backup
   // some specific tables. The passed value can
   // be a string or an array.
   //
	function excludetables($uitables) {
		if (empty($uitables)) return(false);

		if (is_array($uitables))
			foreach ($uitables as $item)
				$this->excludetables[] = $item;
		else
        $this->excludetables[] = $uitables; 
	} 

   // Use this methon when you need to backup
   // ONLY some specific tables. The passed value
   // can be a string or an array.
   //
	function backuponlytables($uitables) {
		if (empty($uitables)) return(false);

		if (is_array($uitables))
			foreach ($uitables as $item)
				$this->tables[] = $item;
		else
        $this->tables[] = $uitables;
	}

   // Error printing function.
   // When outputting a fatal error it will exit the script.
   // php-cli coloured output included ;)
   //
   function Error($uiErrStr, $uiFatal = false) {
		$_error = "";
		$_error_type = ($uiFatal) ? "Fatal Error" : "Error";
      
		if ($_SERVER['TERM']) // we're using php-cli
			printf("%c[%d;%d;%dm%s: %c[%dm%s\n", 0x1B, 1, 31, 40, $_error_type, 0x1B, 0, $uiErrStr);
		else
			printf("<font face='tahoma' size='2'><b>%s:</b>&nbsp;%s</font><br>\n", $_error_type, $uiErrStr);

		if ($uiFatal && !$this->ignorefatalerrors) exit;
    }

   
	//************************************
	function compress()
	{	// compresse un fichier sans utiliser le shell				// compress file without shell
		// pour ne pas se preocuper de la plateforme sur laquelle tourne le script
		// juste verifier que la GZLIB de PHP est bien active		// if you have an erroz verify if your PHP hve the GZLIB
		if($this->filename and !$this->errr){
			$fp = @fopen($this->filename,"rb");
			$zp = @gzopen($this->filename.".gz", "wb9");
			if(!$zp or !$fp){$this->errr =$this->message("err_compress"); return false; }
			while(!feof($fp)){
				$data=fgets($fp, 8192);			// taille du buffer php  // 8192 buffer PHP
				gzwrite($zp,$data);
			}
			fclose($fp);
			gzclose($zp);
			unlink($this->filename);
			$this->filename=$this->filename.".gz";
		}
		
	}
	//***********************************
	function nettoyage() { // pour suprimer les fichiers de sauvegardes du serveur  // destroy old backup files
	 	if(!$this->errr){
			if ($dir = @opendir($this->sousdir)) {
				while($file = @readdir($dir)) {
					@unlink($this->sousdir.$file);
				}
				@closedir($dir);
			}
		}
	}
	//*****************************************
	function spe() { // juste pour vous faire consulter la doc de PHP  // just to read the PHP doc :) see also http://www.tools4noobs.com/online_php_functions/base64_encode/
		return base64_decode('LS0gTWljaGVsZSBCcm9kb2xvbmkgIG1vZGlmaWNhdGlvbiBKZWFuLUNsYXVkZSBFdGllbWJsZQ==');
	}
	
	//****************************
	function message($numero){ // messages d'erreur  // errors messages
	
		$lang=$this->language;
		if(!$lang){$lang="fr";}
		
		$message['err_compress']['fr']='Erreur de compression de fichier';
		$message['err_compress']['en']='Error when compress file';
	
		$message['err_fichier']['fr']='Erreur d\'ouverture de fichier';
		$message['err_fichier']['en']='Error when open file';
				
		$message['err_base']['fr']='base PostgresSql inexistante';
		$message['err_base']['en']='PostgresSql database not exist';
		
		$message['err_pg_sql']['fr']='Impossible de se connecter à la base de données PostgresSql';
		$message['err_pg_sql']['en']='Can\'t connect to the Postgres Database';
		
		return $message[$numero][$lang];
	}	
	
} //end  class




?>
