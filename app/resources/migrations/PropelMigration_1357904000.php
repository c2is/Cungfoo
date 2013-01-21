<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1357904000.
 * Generated on 2013-01-11 12:17:15 by vagrant
 */
class PropelMigration_1357904000
{

    public function preUp($manager)
    {
        // add the pre-migration code here
    }

    public function postUp($manager)
    {
        // add the post-migration code here
    }

    public function preDown($manager)
    {
        // add the pre-migration code here
    }

    public function postDown($manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'cungfoo' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

INSERT INTO `type_hebergement_capacite` (`id`, `image_menu`, `image_page`, `created_at`, `updated_at`, `active`, `sortable_rank`) VALUES
(1, "uploads/type_hebergement_capacites/50ed4358842e6.png", "uploads/type_hebergement_capacites/50f02aeb81673.jpeg", "2013-01-11 15:40:20", "2013-01-11 16:08:27", 1, 1),
(2, "uploads/type_hebergement_capacites/50f42111653ae.png", "uploads/type_hebergement_capacites/50f02bc456e6d.jpeg", "2013-01-11 15:40:20", "2013-01-14 16:15:29", 1, 3),
(3, "uploads/type_hebergement_capacites/50ed4363f1dad.png", "uploads/type_hebergement_capacites/50f02b11caf35.jpeg", "2013-01-11 15:40:20", "2013-01-14 16:15:13", 1, 2),
(4, "uploads/type_hebergement_capacites/50f4212b2a0ca.png", "uploads/type_hebergement_capacites/50f02b21bd6ec.jpeg", "2013-01-11 15:40:20", "2013-01-14 16:15:55", 1, 4);

INSERT INTO `type_hebergement_capacite_i18n` (`id`, `locale`, `name`, `slug`, `accroche`, `description`) VALUES
(1, "fr", "2 adultes", "2-adultes", "Partez à deux !", "Que vous recherchiez plutôt la simplicité, le grand confort, l\'originalité ou l\'authenticité, retrouvez tous nos hébergements pour vos vacances en couple."),
(2, "fr", "2 adultes + 3 enfants", "2-adultes-3-enfants", "Du bonheur pour toute la famille !", "Adaptés à tous les portefeuilles, aux familles plus ou moins grandes et à votre mode de vacances favori, nos hébergements vous attendent pour des vacances en famille, l\'esprit libre."),
(3, "fr", "2 adultes + 2 enfants", "2-adultes-2-enfants", "Les joies des vacances en famille", "Nos hébergements bien équipés et adaptés à vos attentes vous permettront de passer des vacances réussies en famille."),
(4, "fr", "4 adultes", "4-adultes", "Entre amis", "Retrouvez-vous entre amis et profitez de nos hébergements pour vivre des bons moments de détente et de franche rigolade.");

UPDATE `type_hebergement` SET `id` = 44,`type_hebergement_capacite_id` = 1 WHERE `type_hebergement`.`id` = 44;
UPDATE `type_hebergement` SET `id` = 57,`type_hebergement_capacite_id` = 1 WHERE `type_hebergement`.`id` = 57;
UPDATE `type_hebergement` SET `id` = 9,`type_hebergement_capacite_id` = 2 WHERE `type_hebergement`.`id` = 9;
UPDATE `type_hebergement` SET `id` = 53,`type_hebergement_capacite_id` = 2 WHERE `type_hebergement`.`id` = 53;
UPDATE `type_hebergement` SET `id` = 10,`type_hebergement_capacite_id` = 3 WHERE `type_hebergement`.`id` = 10;
UPDATE `type_hebergement` SET `id` = 12,`type_hebergement_capacite_id` = 3 WHERE `type_hebergement`.`id` = 12;
UPDATE `type_hebergement` SET `id` = 14,`type_hebergement_capacite_id` = 3 WHERE `type_hebergement`.`id` = 14;
UPDATE `type_hebergement` SET `id` = 16,`type_hebergement_capacite_id` = 3 WHERE `type_hebergement`.`id` = 16;
UPDATE `type_hebergement` SET `id` = 17,`type_hebergement_capacite_id` = 3 WHERE `type_hebergement`.`id` = 17;
UPDATE `type_hebergement` SET `id` = 24,`type_hebergement_capacite_id` = 3 WHERE `type_hebergement`.`id` = 24;
UPDATE `type_hebergement` SET `id` = 30,`type_hebergement_capacite_id` = 3 WHERE `type_hebergement`.`id` = 30;
UPDATE `type_hebergement` SET `id` = 32,`type_hebergement_capacite_id` = 3 WHERE `type_hebergement`.`id` = 32;
UPDATE `type_hebergement` SET `id` = 33,`type_hebergement_capacite_id` = 3 WHERE `type_hebergement`.`id` = 33;
UPDATE `type_hebergement` SET `id` = 36,`type_hebergement_capacite_id` = 3 WHERE `type_hebergement`.`id` = 36;
UPDATE `type_hebergement` SET `id` = 37,`type_hebergement_capacite_id` = 3 WHERE `type_hebergement`.`id` = 37;
UPDATE `type_hebergement` SET `id` = 45,`type_hebergement_capacite_id` = 3 WHERE `type_hebergement`.`id` = 45;
UPDATE `type_hebergement` SET `id` = 58,`type_hebergement_capacite_id` = 3 WHERE `type_hebergement`.`id` = 58;
UPDATE `type_hebergement` SET `id` = 59,`type_hebergement_capacite_id` = 3 WHERE `type_hebergement`.`id` = 59;
UPDATE `type_hebergement` SET `id` = 60,`type_hebergement_capacite_id` = 3 WHERE `type_hebergement`.`id` = 60;
UPDATE `type_hebergement` SET `id` = 1,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 1;
UPDATE `type_hebergement` SET `id` = 2,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 2;
UPDATE `type_hebergement` SET `id` = 3,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 3;
UPDATE `type_hebergement` SET `id` = 4,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 4;
UPDATE `type_hebergement` SET `id` = 5,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 5;
UPDATE `type_hebergement` SET `id` = 6,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 6;
UPDATE `type_hebergement` SET `id` = 7,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 7;
UPDATE `type_hebergement` SET `id` = 8,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 8;
UPDATE `type_hebergement` SET `id` = 11,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 11;
UPDATE `type_hebergement` SET `id` = 13,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 13;
UPDATE `type_hebergement` SET `id` = 15,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 15;
UPDATE `type_hebergement` SET `id` = 18,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 18;
UPDATE `type_hebergement` SET `id` = 19,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 19;
UPDATE `type_hebergement` SET `id` = 20,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 20;
UPDATE `type_hebergement` SET `id` = 21,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 21;
UPDATE `type_hebergement` SET `id` = 22,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 22;
UPDATE `type_hebergement` SET `id` = 23,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 23;
UPDATE `type_hebergement` SET `id` = 25,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 25;
UPDATE `type_hebergement` SET `id` = 26,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 26;
UPDATE `type_hebergement` SET `id` = 27,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 27;
UPDATE `type_hebergement` SET `id` = 28,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 28;
UPDATE `type_hebergement` SET `id` = 29,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 29;
UPDATE `type_hebergement` SET `id` = 31,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 31;
UPDATE `type_hebergement` SET `id` = 34,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 34;
UPDATE `type_hebergement` SET `id` = 35,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 35;
UPDATE `type_hebergement` SET `id` = 38,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 38;
UPDATE `type_hebergement` SET `id` = 39,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 39;
UPDATE `type_hebergement` SET `id` = 40,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 40;
UPDATE `type_hebergement` SET `id` = 41,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 41;
UPDATE `type_hebergement` SET `id` = 42,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 42;
UPDATE `type_hebergement` SET `id` = 43,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 43;
UPDATE `type_hebergement` SET `id` = 46,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 46;
UPDATE `type_hebergement` SET `id` = 47,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 47;
UPDATE `type_hebergement` SET `id` = 48,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 48;
UPDATE `type_hebergement` SET `id` = 49,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 49;
UPDATE `type_hebergement` SET `id` = 50,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 50;
UPDATE `type_hebergement` SET `id` = 51,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 51;
UPDATE `type_hebergement` SET `id` = 52,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 52;
UPDATE `type_hebergement` SET `id` = 54,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 54;
UPDATE `type_hebergement` SET `id` = 55,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 55;
UPDATE `type_hebergement` SET `id` = 56,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 56;
UPDATE `type_hebergement` SET `id` = 61,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 61;
UPDATE `type_hebergement` SET `id` = 62,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 62;
UPDATE `type_hebergement` SET `id` = 63,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 63;
UPDATE `type_hebergement` SET `id` = 64,`type_hebergement_capacite_id` = 4 WHERE `type_hebergement`.`id` = 64;

UPDATE `type_hebergement_i18n` SET `id` = 1,`indice` = "Avec Sanitaires" WHERE `type_hebergement_i18n`.`id` = 1;
UPDATE `type_hebergement_i18n` SET `id` = 2,`indice` = "Avec Sanitaires" WHERE `type_hebergement_i18n`.`id` = 2;
UPDATE `type_hebergement_i18n` SET `id` = 3,`indice` = "Avec Sanitaires" WHERE `type_hebergement_i18n`.`id` = 3;
UPDATE `type_hebergement_i18n` SET `id` = 4,`indice` = "Avec Sanitaires" WHERE `type_hebergement_i18n`.`id` = 4;
UPDATE `type_hebergement_i18n` SET `id` = 5,`indice` = "Avec Sanitaires" WHERE `type_hebergement_i18n`.`id` = 5;
UPDATE `type_hebergement_i18n` SET `id` = 6,`indice` = "Avec Sanitaires" WHERE `type_hebergement_i18n`.`id` = 6;
UPDATE `type_hebergement_i18n` SET `id` = 7,`indice` = "Avec Sanitaires" WHERE `type_hebergement_i18n`.`id` = 7;
UPDATE `type_hebergement_i18n` SET `id` = 8,`indice` = "Avec Sanitaires" WHERE `type_hebergement_i18n`.`id` = 8;
UPDATE `type_hebergement_i18n` SET `id` = 9,`indice` = "Avec 2 chambres" WHERE `type_hebergement_i18n`.`id` = 9;
UPDATE `type_hebergement_i18n` SET `id` = 10,`indice` = "Avec Sanitaires" WHERE `type_hebergement_i18n`.`id` = 10;
UPDATE `type_hebergement_i18n` SET `id` = 11,`indice` = "Avec Sanitaires" WHERE `type_hebergement_i18n`.`id` = 11;
UPDATE `type_hebergement_i18n` SET `id` = 12,`indice` = "Avec 2 chambres" WHERE `type_hebergement_i18n`.`id` = 12;
UPDATE `type_hebergement_i18n` SET `id` = 13,`indice` = "Avec terrasse couverte intégrée" WHERE `type_hebergement_i18n`.`id` = 13;
UPDATE `type_hebergement_i18n` SET `id` = 14,`indice` = "Avec terrasse couverte intégrée" WHERE `type_hebergement_i18n`.`id` = 14;
UPDATE `type_hebergement_i18n` SET `id` = 15,`indice` = "Avec terrasse couverte intégrée" WHERE `type_hebergement_i18n`.`id` = 15;
UPDATE `type_hebergement_i18n` SET `id` = 16,`indice` = "Avec sanitaires" WHERE `type_hebergement_i18n`.`id` = 16;
UPDATE `type_hebergement_i18n` SET `id` = 17,`indice` = "Avec Sanitaires" WHERE `type_hebergement_i18n`.`id` = 17;
UPDATE `type_hebergement_i18n` SET `id` = 18,`indice` = "Avec 2 chambres et banquette convertible" WHERE `type_hebergement_i18n`.`id` = 18;
UPDATE `type_hebergement_i18n` SET `id` = 19,`indice` = "Avec grand espace de vie" WHERE `type_hebergement_i18n`.`id` = 19;
UPDATE `type_hebergement_i18n` SET `id` = 20,`indice` = "Avec grand espace de vie" WHERE `type_hebergement_i18n`.`id` = 20;
UPDATE `type_hebergement_i18n` SET `id` = 21,`indice` = "Avec vaste salon" WHERE `type_hebergement_i18n`.`id` = 21;
UPDATE `type_hebergement_i18n` SET `id` = 22,`indice` = "Au bord de la mer" WHERE `type_hebergement_i18n`.`id` = 22;
UPDATE `type_hebergement_i18n` SET `id` = 23,`indice` = "Avec électricité" WHERE `type_hebergement_i18n`.`id` = 23;
UPDATE `type_hebergement_i18n` SET `id` = 24,`indice` = "Sans sanitaires" WHERE `type_hebergement_i18n`.`id` = 24;
UPDATE `type_hebergement_i18n` SET `id` = 25,`indice` = "Avec 2 chambres" WHERE `type_hebergement_i18n`.`id` = 25;
UPDATE `type_hebergement_i18n` SET `id` = 26,`indice` = "Avec 2 chambres et banquette convertible" WHERE `type_hebergement_i18n`.`id` = 26;
UPDATE `type_hebergement_i18n` SET `id` = 27,`indice` = "Avec 2 chambres et banquette convertible" WHERE `type_hebergement_i18n`.`id` = 27;
UPDATE `type_hebergement_i18n` SET `id` = 28,`indice` = "Avec Sanitaires" WHERE `type_hebergement_i18n`.`id` = 28;
UPDATE `type_hebergement_i18n` SET `id` = 29,`indice` = "Accès handicapé" WHERE `type_hebergement_i18n`.`id` = 29;
UPDATE `type_hebergement_i18n` SET `id` = 30,`indice` = "Avec terrasse couverte intégrée" WHERE `type_hebergement_i18n`.`id` = 30;
UPDATE `type_hebergement_i18n` SET `id` = 31,`indice` = "Avec terrasse" WHERE `type_hebergement_i18n`.`id` = 31;
UPDATE `type_hebergement_i18n` SET `id` = 32,`indice` = "Avec terrasse" WHERE `type_hebergement_i18n`.`id` = 32;
UPDATE `type_hebergement_i18n` SET `id` = 33,`indice` = "Avec Sanitaires" WHERE `type_hebergement_i18n`.`id` = 33;
UPDATE `type_hebergement_i18n` SET `id` = 34,`indice` = "Avec Sanitaires" WHERE `type_hebergement_i18n`.`id` = 34;
UPDATE `type_hebergement_i18n` SET `id` = 35,`indice` = "Avec sanitaires" WHERE `type_hebergement_i18n`.`id` = 35;
UPDATE `type_hebergement_i18n` SET `id` = 36,`indice` = "Avec terrasse couverte intégrée" WHERE `type_hebergement_i18n`.`id` = 36;
UPDATE `type_hebergement_i18n` SET `id` = 37,`indice` = "Avec terrasse couverte intégrée" WHERE `type_hebergement_i18n`.`id` = 37;
UPDATE `type_hebergement_i18n` SET `id` = 38,`indice` = "Avec Sanitaires" WHERE `type_hebergement_i18n`.`id` = 38;
UPDATE `type_hebergement_i18n` SET `id` = 39,`indice` = "Avec 3 chambres" WHERE `type_hebergement_i18n`.`id` = 39;
UPDATE `type_hebergement_i18n` SET `id` = 40,`indice` = "Avec 3 chambres et banquette transformable" WHERE `type_hebergement_i18n`.`id` = 40;
UPDATE `type_hebergement_i18n` SET `id` = 41,`indice` = "Avec Sanitaires" WHERE `type_hebergement_i18n`.`id` = 41;
UPDATE `type_hebergement_i18n` SET `id` = 42,`indice` = "Avec 3 chambres et banquette transformable" WHERE `type_hebergement_i18n`.`id` = 42;
UPDATE `type_hebergement_i18n` SET `id` = 43,`indice` = "Avec Sanitaires" WHERE `type_hebergement_i18n`.`id` = 43;
UPDATE `type_hebergement_i18n` SET `id` = 44,`indice` = "Avec terrasse" WHERE `type_hebergement_i18n`.`id` = 44;
UPDATE `type_hebergement_i18n` SET `id` = 45,`indice` = "Avec terrasse" WHERE `type_hebergement_i18n`.`id` = 45;
UPDATE `type_hebergement_i18n` SET `id` = 46,`indice` = "Intérieur tout en bois" WHERE `type_hebergement_i18n`.`id` = 46;
UPDATE `type_hebergement_i18n` SET `id` = 47,`indice` = "Chambre avec salle de bain privative" WHERE `type_hebergement_i18n`.`id` = 47;
UPDATE `type_hebergement_i18n` SET `id` = 48,`indice` = "Avec véritable cheminée à l\'ancienne" WHERE `type_hebergement_i18n`.`id` = 48;
UPDATE `type_hebergement_i18n` SET `id` = 49,`indice` = "Avec terrasse donnant sur un point d\'eau" WHERE `type_hebergement_i18n`.`id` = 49;
UPDATE `type_hebergement_i18n` SET `id` = 50,`indice` = "Avec cheminée décorative à l\'ancienne" WHERE `type_hebergement_i18n`.`id` = 50;
UPDATE `type_hebergement_i18n` SET `id` = 51,`indice` = "Avec grand salon" WHERE `type_hebergement_i18n`.`id` = 51;
UPDATE `type_hebergement_i18n` SET `id` = 52,`indice` = "Avec Sanitaires" WHERE `type_hebergement_i18n`.`id` = 52;
UPDATE `type_hebergement_i18n` SET `id` = 53,`indice` = "Avec terrasse couverte" WHERE `type_hebergement_i18n`.`id` = 53;
UPDATE `type_hebergement_i18n` SET `id` = 54,`indice` = "Avec 2 chambres" WHERE `type_hebergement_i18n`.`id` = 54;
UPDATE `type_hebergement_i18n` SET `id` = 55,`indice` = "Avec lave-vaisselle" WHERE `type_hebergement_i18n`.`id` = 55;
UPDATE `type_hebergement_i18n` SET `id` = 56,`indice` = "Avec cour privative fermée et 3 chambres" WHERE `type_hebergement_i18n`.`id` = 56;
UPDATE `type_hebergement_i18n` SET `id` = 57,`indice` = "Avec Mezzanine" WHERE `type_hebergement_i18n`.`id` = 57;
UPDATE `type_hebergement_i18n` SET `id` = 58,`indice` = "Sans sanitaires" WHERE `type_hebergement_i18n`.`id` = 58;
UPDATE `type_hebergement_i18n` SET `id` = 59,`indice` = "Sans sanitaires" WHERE `type_hebergement_i18n`.`id` = 59;
UPDATE `type_hebergement_i18n` SET `id` = 60,`indice` = "Tente traditionnelle mongole" WHERE `type_hebergement_i18n`.`id` = 60;
UPDATE `type_hebergement_i18n` SET `id` = 61,`indice` = "Avec électricité" WHERE `type_hebergement_i18n`.`id` = 61;
UPDATE `type_hebergement_i18n` SET `id` = 62,`indice` = "Avec Sanitaires" WHERE `type_hebergement_i18n`.`id` = 62;
UPDATE `type_hebergement_i18n` SET `id` = 63,`indice` = "Avec électricité" WHERE `type_hebergement_i18n`.`id` = 63;
UPDATE `type_hebergement_i18n` SET `id` = 64,`indice` = "Avec Sanitaires" WHERE `type_hebergement_i18n`.`id` = 64;

UPDATE `category_type_hebergement` SET `id` = 1,`minimum_price` = NULL,`image_menu` = NULL,`image_page` = NULL WHERE `category_type_hebergement`.`id` = 1;
UPDATE `category_type_hebergement` SET `id` = 2,`minimum_price` = "23",`image_menu` = "uploads/category_type_hebergements/50f027b099c3f.jpeg",`image_page` = "uploads/category_type_hebergements/50f027b09a625.jpeg" WHERE `category_type_hebergement`.`id` = 2;
UPDATE `category_type_hebergement` SET `id` = 3,`minimum_price` = "29",`image_menu` = "uploads/category_type_hebergements/50f027e7a891b.jpeg",`image_page` = "uploads/category_type_hebergements/50f027e7a9130.jpeg" WHERE `category_type_hebergement`.`id` = 3;
UPDATE `category_type_hebergement` SET `id` = 4,`minimum_price` = "36",`image_menu` = "uploads/category_type_hebergements/50f027f6dd0e6.jpeg",`image_page` = "uploads/category_type_hebergements/50f027f6dd567.jpeg" WHERE `category_type_hebergement`.`id` = 4;
UPDATE `category_type_hebergement` SET `id` = 5,`minimum_price` = "24",`image_menu` = "uploads/category_type_hebergements/50f028054f09a.jpeg",`image_page` = "uploads/category_type_hebergements/50f028054f57f.jpeg" WHERE `category_type_hebergement`.`id` = 5;
UPDATE `category_type_hebergement` SET `id` = 6,`minimum_price` = "36",`image_menu` = "uploads/category_type_hebergements/50f028115ee34.jpeg",`image_page` = "uploads/category_type_hebergements/50f028115f2b5.jpeg" WHERE `category_type_hebergement`.`id` = 6;
UPDATE `category_type_hebergement` SET `id` = 7,`minimum_price` = "17",`image_menu` = "uploads/category_type_hebergements/50f0282a35a72.jpeg",`image_page` = "uploads/category_type_hebergements/50f0282a35f99.jpeg" WHERE `category_type_hebergement`.`id` = 7;
UPDATE `category_type_hebergement` SET `id` = 8,`minimum_price` = "21",`image_menu` = "uploads/category_type_hebergements/50f02841b567b.jpeg",`image_page` = "uploads/category_type_hebergements/50f02841b5f36.jpeg" WHERE `category_type_hebergement`.`id` = 8;

UPDATE `category_type_hebergement_i18n` SET `id` = 1,`accroche` = "Au camping comme à la maison",`description` = "Découvrez ici les hébergements proposé par Vacances directes : mobil-homes jusqu\'à 8 places, caravanes, gîtes, chalets, bungalows sur des campins de qualité en France, en Espagne et en Italie. Pour un séjour réussi en famille ou entre amis, retrouvez le confort d\'un hébergement de qualité.\nNos hébergements sont régulièrement entretenus et renouvelés afin de vous proposer un confort maximum." WHERE `category_type_hebergement_i18n`.`id` = 1;
UPDATE `category_type_hebergement_i18n` SET `id` = 2,`accroche` = "Au camping comme à la maison",`description` = "Pour des vacances en famille ou entre amis, profitez de nos mobil-homes tout confort. Choisissez celui qui vous ressemble et vivez vos vacances à votre rythme." WHERE `category_type_hebergement_i18n`.`id` = 2;
UPDATE `category_type_hebergement_i18n` SET `id` = 3,`accroche` = "Changez d’air !",`description` = "Parfaitement intégrés à l\'environnement, nos chalets vous attendent pour un séjour original et dépaysant. Vous apprécierez la terrasse couverte et l\'équipement confortable de cet hébergement atypique." WHERE `category_type_hebergement_i18n`.`id` = 3;
UPDATE `category_type_hebergement_i18n` SET `id` = 4,`accroche` = "Un séjour haut en couleur",`description` = "Découvrez le charme des bungalows sur le Domaine d\'Anghione en Corse et leur terrasse nature à l’ombre de la pinède. Ces hébergements tout confort vous attendent pour des vacances inoubliables sur l’ile de Beauté." WHERE `category_type_hebergement_i18n`.`id` = 4;
UPDATE `category_type_hebergement_i18n` SET `id` = 5,`accroche` = "Les plaisirs simples",`description` = "Vous souhaitez allier confort et simplicité ? Nos caravanes avec ou sans sanitaires vous permettront de passer des vacances sous le signe de la liberté et de l\'authenticité." WHERE `category_type_hebergement_i18n`.`id` = 5;
UPDATE `category_type_hebergement_i18n` SET `id` = 6,`accroche` = "Le charme de la Bretagne",`description` = "De 2 à 9 places, les gîtes du Domaine de Kermario offrent un cachet incroyable pour un séjour dépaysant. Découverte et détente vous attendent au pays des menhirs." WHERE `category_type_hebergement_i18n`.`id` = 6;
UPDATE `category_type_hebergement_i18n` SET `id` = 7,`accroche` = "La liberté à l\'état pur",`description` = "Passez quelques jours ou plus en tente, en caravane ou en camping-car sur l\'un de nos 3 000 emplacements et profitez des joies du plein-air." WHERE `category_type_hebergement_i18n`.`id` = 7;
UPDATE `category_type_hebergement_i18n` SET `id` = 8,`accroche` = "Gardez l\'esprit campeur !",`description` = "Pour ceux qui veulent garder l\'esprit campeur, Vacances directes vous propose ses tentes équipées. Jusqu\'à 5 places, avec ou sans sanitaire, vous pourrez vivre des moments de détente et de convivialité." WHERE `category_type_hebergement_i18n`.`id` = 8;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'cungfoo' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}
