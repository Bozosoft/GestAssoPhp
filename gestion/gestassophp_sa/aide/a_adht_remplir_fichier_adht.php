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
 include_once '../config/connexion.php';  
?>  
<!doctype html>
<html lang='fr' dir='ltr'>
<head>
	<meta charset="UTF-8">
	<meta name="author" content="JCE">
	<meta name="Description" content="GestAssoPhp+Pg">
	<meta name="ROBOTS" content="noindex, nofollow">
	<meta name="keywords" lang="fr" content="GestAssoPhp">
	<link rel="stylesheet" type="text/css" media="screen"  href="../js/style_screen.css"/>
	<link rel="stylesheet" type="text/css" media="print"  href="../js/style_print.css"/>
	<title>GestAssoPhp Aide - <?php echo _LANG_TITRE_ADMIN_FILE_ADHT ;?></title>
</head>
<body>

<p class="AfficheTitre"><img src='../images/icones/help.gif' alt="Aide" width="20" height="20" title="Aidez-moi"/>
<span class="AfficheTitre14"><?php echo _LANG_TITRE_ADMIN_FILE_ADHT ;?></span><br />
</p>
<div id="contenu"> 
  <p class="Textenoir">&nbsp;<br />
    Cette page permet de :<br/>
    <br/>
    - d'ajouter depuis votre ordinateur vers le serveur (Upload) un nouveau fichier 
    (maxi 100 Ko) : <span class="TextenoirGras">mode <?php echo _LANG_MESSAGE_FILE_UPLOAD ;?></span> (Certains 
    champs sont <span class="Texterouge">obligatoires</span>)
	<br/>
	Les fichiers avec les extensions (php*, pl, js) sont interdits.  <br/>
	Utiliser de préférences les fichiers avec des <a href="http://fr.wikipedia.org/wiki/Format_ouvert" target="_blank">formats ouverts</a> et lisibles par tous.
	<br/>
    <span class="TextenoirGras">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="TexterougeGras">Note 
    importante</span> : Attention &agrave; la charte de nommage des fichiers.<br/>
    &nbsp;&nbsp;&nbsp;&nbsp;le nom du fichier doit &ecirc;tre de <span class="Texterouge"><?php echo _LANG_FILE_ADHT_TITLEMAX ;?></span><br />
    &nbsp;&nbsp;&nbsp;&nbsp;Ne comporter aucun accent &quot;&eacute; &egrave; 
    &agrave;&quot; ni espaces, ni caract&egrave;res sp&eacute;ciaux tel que % 
    &sect; / | # } ....<br />
    &nbsp;&nbsp;&nbsp;&nbsp;Les noms de fichiers doivent &ecirc;tre diff&eacute;rents 
    de ceux d&eacute;j&agrave; existant dans la base de donn&eacute;es (sinon 
    message d'erreur). <br/>
    &nbsp;&nbsp;&nbsp;&nbsp;<span class="TextenoirGras">CHARTRE DE NOMMAGE DES 
    FICHIER</span> : <br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tous les fichiers commencent par 
    le <?php echo _LANG_TPL_COL_ADHT_NOM.' '.ADHERENT_BENE ;?><br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (avec l'initial du pr&eacute;nom &eacute;v&eacute;ntuellement) 
    suivi de &quot;_&quot; date au format AAmmjj<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Exemple : blais_070502 ou moreaua_070421 
    - <?php echo _LANG_FILE_ADHT_TITLEMAX ;?><br/>
    <br/>
    - Modifier la description ou le destinataire du fichier : <span class="TextenoirGras">mode 
    <?php echo _LANG_MESSAGE_MODIF ;?></span> (Les zones non modifiables sont gris&eacute;es )<br/>
    - consulter une fiche supprim&eacute;e : <span class="TextenoirGras">mode 
    <?php echo _LANG_MESSAGE_FILE_CONSULT ;?></span> (Toutes les zones sont gris&eacute;es 
    ) </p>
  <p><span class="TextenoirGras">Messages d'erreur</span> :<br />
    <span class="Texterouge"><?php echo _LANG_MESSAGE_FILE_NOFILE_ERROR ;?></span> : 
    vous avez valid&eacute; alors que le fichier n'a pas &eacute;t&eacute; s&eacute;lectionn&eacute; 
    <br />
    <span class="Texterouge"><?php echo _LANG_MESSAGE_FILE_FILE_ERROR.' xxx '._LANG_MESSAGE_FILE_FILE_EXIST_ERROR ;?>
    </span>: le nom du fichier est identique &agrave; un nom d&eacute;j&agrave; 
    existant<br />
    <span class="Texterouge"><?php echo  _LANG_MESSAGE_FILE_FILE_ERROR.' xxx '._LANG_MESSAGE_FILE_LONGFILE_ERROR;?></span> : le nom 
    du fichier sup&eacute;rieur &agrave; 25 caract&egrave;res<br />
    <span class="Texterouge"><?php echo _LANG_MESSAGE_FILE_FILE_ERROR.' xxx '._LANG_MESSAGE_FILE_NOVALIDFILE_ERROR  ;?></span> : le nom du fichier comporte un accent ou espace, ou des caract&egrave;res sp&eacute;ciaux tel que % &sect; / ....&gt;<br />
    <span class="Texterouge"><?php echo _LANG_MESSAGE_FILE_FILE_TAILLE_ERROR ;?></span> : la 
    taille du fichier est sup&eacute;rieure &agrave; la taille maximale OU la 
    taille est z&eacute;ro.</p>

<span class="TextenoirR">&nbsp;&nbsp;<a href="#" onclick="self.close();">Fermer cette fen&ecirc;tre</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:window.print()">Imprimer cette page</a></span>
</div>
</body>
</html>

