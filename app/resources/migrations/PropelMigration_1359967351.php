<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1359967351.
 * Generated on 2013-02-01 09:27:40 by m.brunot
 */
class PropelMigration_1359967351
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

ALTER TABLE `activite_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `keywords`;

ALTER TABLE `avantage_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `description`;

ALTER TABLE `baignade_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `keywords`;

ALTER TABLE `bon_plan_categorie_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `description`;

ALTER TABLE `bon_plan_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `indice_prix`;

ALTER TABLE `categorie_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `name`;

ALTER TABLE `category_type_hebergement_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `description`;

ALTER TABLE `destination_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `description`;

ALTER TABLE `edito_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `description`;

ALTER TABLE `etablissement_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `description`;

ALTER TABLE `event_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `slug`;

ALTER TABLE `idee_weekend_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `lien`;

ALTER TABLE `mise_en_avant_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `titre_lien`;

ALTER TABLE `multimedia_etablissement_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `titre`;

ALTER TABLE `multimedia_type_hebergement_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `titre`;

ALTER TABLE `pays_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `description`;

ALTER TABLE `personnage_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `prenom`;

ALTER TABLE `point_interet_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `slug`;

ALTER TABLE `region_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `description`;

ALTER TABLE `service_complementaire_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `keywords`;

ALTER TABLE `situation_geographique_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `keywords`;

ALTER TABLE `tag_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `name`;

ALTER TABLE `thematique_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `keywords`;

ALTER TABLE `theme_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `description`;

ALTER TABLE `type_hebergement_capacite_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `description`;

ALTER TABLE `type_hebergement_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `remarque_4`;

ALTER TABLE `ville_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `description`;

ALTER TABLE `vos_vacances_i18n`
    ADD `active_locale` TINYINT(1) DEFAULT 1 AFTER `prenom`;

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

ALTER TABLE `activite_i18n` DROP `active_locale`;

ALTER TABLE `avantage_i18n` DROP `active_locale`;

ALTER TABLE `baignade_i18n` DROP `active_locale`;

ALTER TABLE `bon_plan_categorie_i18n` DROP `active_locale`;

ALTER TABLE `bon_plan_i18n` DROP `active_locale`;

ALTER TABLE `categorie_i18n` DROP `active_locale`;

ALTER TABLE `category_type_hebergement_i18n` DROP `active_locale`;

ALTER TABLE `destination_i18n` DROP `active_locale`;

ALTER TABLE `edito_i18n` DROP `active_locale`;

ALTER TABLE `etablissement_i18n` DROP `active_locale`;

ALTER TABLE `event_i18n` DROP `active_locale`;

ALTER TABLE `idee_weekend_i18n` DROP `active_locale`;

ALTER TABLE `mise_en_avant_i18n` DROP `active_locale`;

ALTER TABLE `multimedia_etablissement_i18n` DROP `active_locale`;

ALTER TABLE `multimedia_type_hebergement_i18n` DROP `active_locale`;

ALTER TABLE `pays_i18n` DROP `active_locale`;

ALTER TABLE `personnage_i18n` DROP `active_locale`;

ALTER TABLE `point_interet_i18n` DROP `active_locale`;

ALTER TABLE `region_i18n` DROP `active_locale`;

ALTER TABLE `service_complementaire_i18n` DROP `active_locale`;

ALTER TABLE `situation_geographique_i18n` DROP `active_locale`;

ALTER TABLE `tag_i18n` DROP `active_locale`;

ALTER TABLE `thematique_i18n` DROP `active_locale`;

ALTER TABLE `theme_i18n` DROP `active_locale`;

ALTER TABLE `type_hebergement_capacite_i18n` DROP `active_locale`;

ALTER TABLE `type_hebergement_i18n` DROP `active_locale`;

ALTER TABLE `ville_i18n` DROP `active_locale`;

ALTER TABLE `vos_vacances_i18n` DROP `active_locale`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}
