<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1381238161.
 * Generated on 2013-10-08 15:16:01 by gmanen
 */
class PropelMigration_1381238161
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

ALTER TABLE `activite` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `activite_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `avantage` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `avantage_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `baignade` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `baignade_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `bon_plan` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `bon_plan_categorie` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `bon_plan_categorie_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `bon_plan_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `cache_generator` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `cache_generator_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `categorie` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `categorie_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `category_type_hebergement` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `category_type_hebergement_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `demande_annulation` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `demande_annulation_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `demande_identifiant` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `demande_identifiant_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `departement` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `departement_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `destination` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `destination_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `edito` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `edito_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `etablissement` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `etablissement_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `event` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `event_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `idee_weekend` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `idee_weekend_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `mise_en_avant` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `mise_en_avant_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `navigation` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `navigation_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `navigation_item` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `navigation_item_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `pays` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `pays_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `personnage` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `personnage_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `point_interet` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `point_interet_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `portfolio_media` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `portfolio_media_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `portfolio_tag` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `portfolio_tag_category` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `portfolio_tag_category_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `portfolio_tag_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `portfolio_usage` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `region` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `region_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `region_ref` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `region_ref_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `service_complementaire` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `service_complementaire_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `situation_geographique` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `situation_geographique_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `tag` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `tag_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `thematique` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `thematique_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `theme` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `theme_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `top_camping` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `top_camping_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `type_hebergement` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `type_hebergement_capacite` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `type_hebergement_capacite_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `type_hebergement_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `ville` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `ville_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

ALTER TABLE `vos_vacances` CHANGE `active` `active` TINYINT(1) DEFAULT 0;

ALTER TABLE `vos_vacances_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 0;

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

ALTER TABLE `activite` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `activite_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `avantage` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `avantage_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `baignade` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `baignade_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `bon_plan` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `bon_plan_categorie` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `bon_plan_categorie_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `bon_plan_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `cache_generator` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `cache_generator_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `categorie` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `categorie_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `category_type_hebergement` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `category_type_hebergement_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `demande_annulation` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `demande_annulation_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `demande_identifiant` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `demande_identifiant_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `departement` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `departement_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `destination` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `destination_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `edito` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `edito_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `etablissement` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `etablissement_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `event` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `event_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `idee_weekend` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `idee_weekend_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `mise_en_avant` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `mise_en_avant_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `navigation` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `navigation_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `navigation_item` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `navigation_item_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `pays` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `pays_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `personnage` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `personnage_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `point_interet` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `point_interet_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `portfolio_media` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `portfolio_media_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `portfolio_tag` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `portfolio_tag_category` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `portfolio_tag_category_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `portfolio_tag_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `portfolio_usage` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `region` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `region_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `region_ref` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `region_ref_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `service_complementaire` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `service_complementaire_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `situation_geographique` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `situation_geographique_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `tag` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `tag_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `thematique` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `thematique_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `theme` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `theme_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `top_camping` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `top_camping_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `type_hebergement` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `type_hebergement_capacite` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `type_hebergement_capacite_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `type_hebergement_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `ville` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `ville_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

ALTER TABLE `vos_vacances` CHANGE `active` `active` TINYINT(1) DEFAULT 1;

ALTER TABLE `vos_vacances_i18n` CHANGE `active_locale` `active_locale` TINYINT(1) DEFAULT 1;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}