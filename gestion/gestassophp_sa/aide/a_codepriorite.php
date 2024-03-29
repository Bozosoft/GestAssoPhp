<?php
/**
 * Projet : gestassophp_sa [GestAssoPhp+Pg]
 * ---------------------------
 * Licence Creative Commons selon les termes du présent contrat appelé Contrat Public Creative Commons
 * Auteur original : Jean-Claude Etiemble
 * @link :  http://creativecommons.org/licenses/by-sa/2.0/fr/  - Paternité - Partage à l'Identique 2.0 France (CC BY-SA 2.0)
 * ---------------------------
 *
 * @author :  JC Etiemble - http://jc.etiemble.free.fr
 * @version : 2022
 * @copyright 2007-2022  (c) JC Etiemble
 * @package   GestAssoPhp+Pg
 */

/**
 *  Directory :  /ROOT_DIR_GESTASSO/aide/
 *  Fichier :	a_codepriorite.php
 *  Affiche l'aide pour les priorités - inclus dans les fichiers /aide/a_login.php et /aide/a_priorite.php
*/

	//include_once '../config/connexion.php';
?>

 <span class="TextenoirGras">0 = accès interdit</span>, <br>
<span class="TextenoirGras">1 = Membre</span> accès à <?php echo _LANG_MENU_ADHT_MEMBRES.' : '._LANG_MENU_ADHT_INFORMATION.', '._LANG_MENU_ADHT_LISTE ;?>
 - C'est la valeur par défaut<br>
<span class="TextenoirGras">4 = Membre du CA idem 1 + </span><?php echo _LANG_MENU_ADMIN_GESTION.' : '. _LANG_MENU_ADMIN_GESTION_TB ;?><br>
<span class="TextenoirGras">5 = Secrétaire idem 4 + </span><?php echo _LANG_MENU_ADHERENT_BENE.' :  '. _LANG_MENU_ADHERENT_GESTION . ', '. _LANG_TITRE_ADMIN_LISTE_ADHT2 . ', '. _LANG_MENU__GESTIONE_FILE;?>  <br>
<span class="TextenoirGras">7 = Trésorier  idem 5 + </span><?php echo _LANG_MENU__GESTION_COTIS ;?><br>
<span class="TextenoirGras">9 = Admin</span> Tous les droits
