
/*JC Etiemble pour CAP 25 Dec 2004*/
/*Ajout du 16/11/2004 controle du nombre de caractéres restant dans une textarea */
/*Compte les mots d'un texte */
function Compteur_Texte(nTexte, nCompteur, nLimite) {
if (nTexte.value.length > nLimite) { nTexte.value = nTexte.value.substring(0, nLimite); alert('Vous ne pouvez insérer que '+nLimite+ ' caractères maximum');}
else{nCompteur.value = nLimite - nTexte.value.length;}}