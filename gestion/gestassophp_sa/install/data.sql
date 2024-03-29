#--
#-- Directory :  /ROOT_DIR_GESTASSO/install/
#-- Fichier :   data.sql
#-- Installation du système
#-- données des tables   * ENCODAGE UTF-8 sans BOM
#-- version : 2024
#--

#--
#-- Contenu de la table gs_types_cotisations depuis V 7.6.3
#--
INSERT INTO gs_types_cotisations (nom_type_cotisation, montant_cotisation) VALUES
( 'Annuelle normale', '0.00'),
( 'Annuelle reduite', '0.00');


#--
#-- Contenu de la table gs_preference_asso
#--
INSERT INTO gs_preference_asso (id_pref, design_pref, val_pref) VALUES
(1, 'messagetitre', '- SITE DE TEST POUR DEMONSTRATION -'),
(2, 'nom_asso_gestassophp', 'Mon Asso simple sur le WEB'),
(3, 'date_debannee_asso', '2024'),
(4, 'nb_lignes_page', '20'),
(5, 'email_adresse', 'jc.e@cmoi.com'),
(6, 'adherent_bene', 'Utilisateur'),
(7, '_lang_fiche_adht_ant', 'Section'),
#-- 8, réservé
(9, 'jma_fin_cotis','31/12/2024');


#--
#-- Contenu de la table gs_types_antennes
#--
INSERT INTO gs_types_antennes (nom_type_antenne) VALUES
( 'sans');

