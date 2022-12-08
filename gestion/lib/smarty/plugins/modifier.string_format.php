<?php
/**
* Smarty plugin
* 
* @package Smarty
* @subpackage PluginsModifier
*/

/**
* Smarty string_format modifier plugin
* 
* Type:     modifier<br>
* Name:     string_format<br>
* Purpose:  format strings via sprintf
* Origine version 2.x (dernière version 2.6.33)
* 
* @link  https://smarty-php.github.io/smarty/designers/language-modifiers/language-modifier-string-format.html
* @author Monte Ohrt <monte at ohrt dot com> 
* @param string $string input string 
* @param string $format format string 
* @return string formatted string
*/
    function smarty_modifier_string_format($string, $format)
    {
        return sprintf($format, $string);
    } 

?>
