<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */
 
 /**
 * Smarty language} function plugin
 *
 * Type:     function<br>
 * Name:    language<br>
 * Date:     august  22, 2008<br>
 * @author   JCE 
 * @version  1.0
 * @param array
 * @param Smarty
  * file lang -> *.php
  * define('_LANG_DEFINENAME', 'This is a language define'); 
 * @return string output from  {language name=definename}
 *  
 */
 
 
function smarty_function_language($params, &$smarty) 
{ 

	return constant('_LANG_'.  strtoupper($params['name'])); 

} 


?>
