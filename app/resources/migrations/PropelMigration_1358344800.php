<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1358344800.
 * Generated on 2013-01-16 14:58:20 by m.brunot
 */
class PropelMigration_1358344800
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

UPDATE bon_plan SET date_debut = \'2013-01-01\', date_fin = \'2013-01-31\', prix_barre = \'137\', image_page = \'uploads/bon_plans/50feaa9d501ce.jpeg\', active_compteur = 0, mise_en_avant = 1, push_home = 1, date_start ) \'2013-04-13\', day_start = 5, nb_adultes = 2, nb_enfants = 0, active = 1;
INSERT INTO `bon_plan` (`date_debut`, `date_fin`, `prix`, `prix_barre`, `image_menu`, `image_page`, `image_liste`, `active_compteur`, `mise_en_avant`, `push_home`, `date_start`, `day_start`, `day_range`, `nb_adultes`, `nb_enfants`, `period_categories`, `active`) VALUES(\'2013-01-01\', \'2013-01-31\', NULL, NULL, \'uploads/bon_plans/50fec19945bb3.jpeg\', \'uploads/bon_plans/50fea8e18bf47.jpeg\', NULL, 0, 0, 0, \'2013-04-20\', 5, 0, 2, 0, NULL, 1);

INSERT INTO bon_plan_bon_plan_categorie (bon_plan_id, bon_plan_categorie_id, sortable_rank) VALUES (2, 1, 2);

UPDATE bon_plan_categorie_i18n SET name = \'Early booking\', slug = \'early-booking\', subtitle = \'Réserveztôt et profitez des promos\' WHERE locale = \'fr\';

TRUNCATE TABLE `bon_plan_etablissement`;
INSERT INTO `bon_plan_etablissement` (`bon_plan_id`, `etablissement_id`) VALUES
(2, 21),
(2, 23),
(1, 30),
(2, 37),
(2, 61),
(1, 72),
(1, 106),
(1, 110),
(1, 139),
(1, 166),
(2, 177),
(1, 180),
(1, 184),
(1, 185),
(2, 188),
(1, 197),
(1, 201),
(2, 206),
(2, 217),
(1, 234),
(1, 237),
(2, 242),
(2, 244);

UPDATE bon_plan_i18n SET name = \'Early booking\', slug = \'early-booking-20-avril\', indice_prix = \'10% de réduction\', description = \'Profitez de notre promo early booking sur votre séjour en basse saison : -10% pour une réservation avant le 31/01/2013. 
N\'\'attendez plus!\' WHERE locale = \'fr\';

INSERT INTO `bon_plan_i18n` (`id`, `locale`, `name`, `slug`, `introduction`, `description`, `indice`, `indice_prix`) VALUES
(2, \'de\', NULL, NULL, NULL, NULL, NULL, NULL),
(2, \'fr\', \'Early booking\', \'early-booking-27-avril\', NULL, \'Profitez de notre promo early booking sur votre séjour en basse saison : -10% pour une réservation avant le 31/01/2013. \r\nN\'\'attendez plus!\', NULL, \'10% de réduction\');

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
  'cungfoo' => '',
);
    }

}