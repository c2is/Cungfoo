<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1360317622.
 * Generated on 2013-02-07 10:43:09 by m.brunot
 */
class PropelMigration_1360317622
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

ALTER TABLE `bon_plan_bon_plan_categorie` ADD CONSTRAINT `bon_plan_bon_plan_categorie_FK_1`
    FOREIGN KEY (`bon_plan_id`)
    REFERENCES `bon_plan` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `bon_plan_bon_plan_categorie` ADD CONSTRAINT `bon_plan_bon_plan_categorie_FK_2`
    FOREIGN KEY (`bon_plan_categorie_id`)
    REFERENCES `bon_plan_categorie` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `bon_plan_categorie_i18n` ADD CONSTRAINT `bon_plan_categorie_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `bon_plan_categorie` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `bon_plan_etablissement` ADD CONSTRAINT `bon_plan_etablissement_FK_1`
    FOREIGN KEY (`bon_plan_id`)
    REFERENCES `bon_plan` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `bon_plan_etablissement` ADD CONSTRAINT `bon_plan_etablissement_FK_2`
    FOREIGN KEY (`etablissement_id`)
    REFERENCES `etablissement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `bon_plan_i18n` ADD CONSTRAINT `bon_plan_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `bon_plan` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `bon_plan_region` ADD CONSTRAINT `bon_plan_region_FK_1`
    FOREIGN KEY (`bon_plan_id`)
    REFERENCES `bon_plan` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `bon_plan_region` ADD CONSTRAINT `bon_plan_region_FK_2`
    FOREIGN KEY (`region_id`)
    REFERENCES `region` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `categorie_i18n` ADD CONSTRAINT `categorie_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `categorie` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `category_type_hebergement_i18n` ADD CONSTRAINT `category_type_hebergement_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `category_type_hebergement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `demande_annulation` ADD CONSTRAINT `demande_annulation_FK_1`
    FOREIGN KEY (`camping_id`)
    REFERENCES `etablissement` (`id`);

ALTER TABLE `destination_i18n` ADD CONSTRAINT `destination_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `destination` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `edito_i18n` ADD CONSTRAINT `edito_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `edito` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement` ADD CONSTRAINT `etablissement_FK_1`
    FOREIGN KEY (`ville_id`)
    REFERENCES `ville` (`id`)
    ON DELETE SET NULL;

ALTER TABLE `etablissement` ADD CONSTRAINT `etablissement_FK_2`
    FOREIGN KEY (`categorie_id`)
    REFERENCES `categorie` (`id`)
    ON DELETE SET NULL;

ALTER TABLE `etablissement_activite` ADD CONSTRAINT `etablissement_activite_FK_1`
    FOREIGN KEY (`etablissement_id`)
    REFERENCES `etablissement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_activite` ADD CONSTRAINT `etablissement_activite_FK_2`
    FOREIGN KEY (`activite_id`)
    REFERENCES `activite` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_baignade` ADD CONSTRAINT `etablissement_baignade_FK_1`
    FOREIGN KEY (`etablissement_id`)
    REFERENCES `etablissement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_baignade` ADD CONSTRAINT `etablissement_baignade_FK_2`
    FOREIGN KEY (`baignade_id`)
    REFERENCES `baignade` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_destination` ADD CONSTRAINT `etablissement_destination_FK_1`
    FOREIGN KEY (`etablissement_id`)
    REFERENCES `etablissement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_destination` ADD CONSTRAINT `etablissement_destination_FK_2`
    FOREIGN KEY (`destination_id`)
    REFERENCES `destination` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_event` ADD CONSTRAINT `etablissement_event_FK_1`
    FOREIGN KEY (`etablissement_id`)
    REFERENCES `etablissement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_event` ADD CONSTRAINT `etablissement_event_FK_2`
    FOREIGN KEY (`event_id`)
    REFERENCES `event` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_i18n` ADD CONSTRAINT `etablissement_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `etablissement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_point_interet` ADD CONSTRAINT `etablissement_point_interet_FK_1`
    FOREIGN KEY (`etablissement_id`)
    REFERENCES `etablissement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_point_interet` ADD CONSTRAINT `etablissement_point_interet_FK_2`
    FOREIGN KEY (`point_interet_id`)
    REFERENCES `point_interet` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_service_complementaire` ADD CONSTRAINT `etablissement_service_complementaire_FK_1`
    FOREIGN KEY (`etablissement_id`)
    REFERENCES `etablissement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_service_complementaire` ADD CONSTRAINT `etablissement_service_complementaire_FK_2`
    FOREIGN KEY (`service_complementaire_id`)
    REFERENCES `service_complementaire` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_situation_geographique` ADD CONSTRAINT `etablissement_situation_geographique_FK_1`
    FOREIGN KEY (`etablissement_id`)
    REFERENCES `etablissement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_situation_geographique` ADD CONSTRAINT `etablissement_situation_geographique_FK_2`
    FOREIGN KEY (`situation_geographique_id`)
    REFERENCES `situation_geographique` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_thematique` ADD CONSTRAINT `etablissement_thematique_FK_1`
    FOREIGN KEY (`etablissement_id`)
    REFERENCES `etablissement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_thematique` ADD CONSTRAINT `etablissement_thematique_FK_2`
    FOREIGN KEY (`thematique_id`)
    REFERENCES `thematique` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_type_hebergement` ADD CONSTRAINT `etablissement_type_hebergement_FK_1`
    FOREIGN KEY (`etablissement_id`)
    REFERENCES `etablissement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_type_hebergement` ADD CONSTRAINT `etablissement_type_hebergement_FK_2`
    FOREIGN KEY (`type_hebergement_id`)
    REFERENCES `type_hebergement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `event_i18n` ADD CONSTRAINT `event_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `event` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `idee_weekend_i18n` ADD CONSTRAINT `idee_weekend_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `idee_weekend` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `job_log` ADD CONSTRAINT `job_log_FK_1`
    FOREIGN KEY (`job_id`)
    REFERENCES `job` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `mise_en_avant_i18n` ADD CONSTRAINT `mise_en_avant_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `mise_en_avant` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `multimedia_etablissement` ADD CONSTRAINT `multimedia_etablissement_FK_1`
    FOREIGN KEY (`etablissement_id`)
    REFERENCES `etablissement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `multimedia_etablissement_i18n` ADD CONSTRAINT `multimedia_etablissement_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `multimedia_etablissement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `multimedia_etablissement_tag` ADD CONSTRAINT `multimedia_etablissement_tag_FK_1`
    FOREIGN KEY (`multimedia_etablissement_id`)
    REFERENCES `multimedia_etablissement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `multimedia_etablissement_tag` ADD CONSTRAINT `multimedia_etablissement_tag_FK_2`
    FOREIGN KEY (`tag_id`)
    REFERENCES `tag` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `multimedia_type_hebergement` ADD CONSTRAINT `multimedia_type_hebergement_FK_1`
    FOREIGN KEY (`type_hebergement_id`)
    REFERENCES `type_hebergement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `multimedia_type_hebergement_i18n` ADD CONSTRAINT `multimedia_type_hebergement_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `multimedia_type_hebergement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `pays_i18n` ADD CONSTRAINT `pays_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `pays` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `personnage` ADD CONSTRAINT `personnage_FK_1`
    FOREIGN KEY (`etablissement_id`)
    REFERENCES `etablissement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `personnage_i18n` ADD CONSTRAINT `personnage_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `personnage` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `point_interet_i18n` ADD CONSTRAINT `point_interet_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `point_interet` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `region` ADD CONSTRAINT `region_FK_1`
    FOREIGN KEY (`pays_id`)
    REFERENCES `pays` (`id`)
    ON DELETE SET NULL;

ALTER TABLE `region` ADD CONSTRAINT `region_FK_2`
    FOREIGN KEY (`destination_id`)
    REFERENCES `destination` (`id`);

ALTER TABLE `region_i18n` ADD CONSTRAINT `region_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `region` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `service_complementaire_i18n` ADD CONSTRAINT `service_complementaire_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `service_complementaire` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `situation_geographique_i18n` ADD CONSTRAINT `situation_geographique_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `situation_geographique` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `tag_i18n` ADD CONSTRAINT `tag_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `tag` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `thematique_i18n` ADD CONSTRAINT `thematique_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `thematique` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `theme_activite` ADD CONSTRAINT `theme_activite_FK_1`
    FOREIGN KEY (`theme_id`)
    REFERENCES `theme` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `theme_activite` ADD CONSTRAINT `theme_activite_FK_2`
    FOREIGN KEY (`activite_id`)
    REFERENCES `activite` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `theme_baignade` ADD CONSTRAINT `theme_baignade_FK_1`
    FOREIGN KEY (`theme_id`)
    REFERENCES `theme` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `theme_baignade` ADD CONSTRAINT `theme_baignade_FK_2`
    FOREIGN KEY (`baignade_id`)
    REFERENCES `baignade` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `theme_i18n` ADD CONSTRAINT `theme_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `theme` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `theme_personnage` ADD CONSTRAINT `theme_personnage_FK_1`
    FOREIGN KEY (`theme_id`)
    REFERENCES `theme` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `theme_personnage` ADD CONSTRAINT `theme_personnage_FK_2`
    FOREIGN KEY (`personnage_id`)
    REFERENCES `personnage` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `theme_service_complementaire` ADD CONSTRAINT `theme_service_complementaire_FK_1`
    FOREIGN KEY (`theme_id`)
    REFERENCES `theme` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `theme_service_complementaire` ADD CONSTRAINT `theme_service_complementaire_FK_2`
    FOREIGN KEY (`service_complementaire_id`)
    REFERENCES `service_complementaire` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `top_camping` ADD CONSTRAINT `top_camping_FK_1`
    FOREIGN KEY (`etablissement_id`)
    REFERENCES `etablissement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `type_hebergement` ADD CONSTRAINT `type_hebergement_FK_1`
    FOREIGN KEY (`category_type_hebergement_id`)
    REFERENCES `category_type_hebergement` (`id`)
    ON DELETE SET NULL;

ALTER TABLE `type_hebergement` ADD CONSTRAINT `type_hebergement_FK_2`
    FOREIGN KEY (`type_hebergement_capacite_id`)
    REFERENCES `type_hebergement_capacite` (`id`)
    ON DELETE SET NULL;

ALTER TABLE `type_hebergement_capacite_i18n` ADD CONSTRAINT `type_hebergement_capacite_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `type_hebergement_capacite` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `type_hebergement_i18n` ADD CONSTRAINT `type_hebergement_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `type_hebergement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `ville` ADD CONSTRAINT `ville_FK_1`
    FOREIGN KEY (`region_id`)
    REFERENCES `region` (`id`)
    ON DELETE SET NULL;

ALTER TABLE `ville_i18n` ADD CONSTRAINT `ville_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `ville` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `vos_vacances_i18n` ADD CONSTRAINT `vos_vacances_i18n_FK_1`
    FOREIGN KEY (`id`)
    REFERENCES `vos_vacances` (`id`)
    ON DELETE CASCADE;

CREATE TABLE `region_ref`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(255) NOT NULL,
    `pays_id` INTEGER,
    `image_detail_1` VARCHAR(255),
    `image_detail_2` VARCHAR(255),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    INDEX `region_ref_FI_1` (`pays_id`),
    CONSTRAINT `region_ref_FK_1`
        FOREIGN KEY (`pays_id`)
        REFERENCES `pays` (`id`)
        ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE `departement`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(255) NOT NULL,
    `region_ref_id` INTEGER,
    `image_detail_1` VARCHAR(255),
    `image_detail_2` VARCHAR(255),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    INDEX `departement_FI_1` (`region_ref_id`),
    CONSTRAINT `departement_FK_1`
        FOREIGN KEY (`region_ref_id`)
        REFERENCES `region_ref` (`id`)
        ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE `region_ref_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `introduction` VARCHAR(255),
    `description` TEXT,
    `active_locale` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `region_ref_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `region_ref` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `departement_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `introduction` VARCHAR(255),
    `description` TEXT,
    `active_locale` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `departement_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `departement` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

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

DROP TABLE IF EXISTS `region_ref`;

DROP TABLE IF EXISTS `departement`;

DROP TABLE IF EXISTS `region_ref_i18n`;

DROP TABLE IF EXISTS `departement_i18n`;

ALTER TABLE `bon_plan_bon_plan_categorie` DROP FOREIGN KEY `bon_plan_bon_plan_categorie_FK_1`;

ALTER TABLE `bon_plan_bon_plan_categorie` DROP FOREIGN KEY `bon_plan_bon_plan_categorie_FK_2`;

ALTER TABLE `bon_plan_categorie_i18n` DROP FOREIGN KEY `bon_plan_categorie_i18n_FK_1`;

ALTER TABLE `bon_plan_etablissement` DROP FOREIGN KEY `bon_plan_etablissement_FK_1`;

ALTER TABLE `bon_plan_etablissement` DROP FOREIGN KEY `bon_plan_etablissement_FK_2`;

ALTER TABLE `bon_plan_i18n` DROP FOREIGN KEY `bon_plan_i18n_FK_1`;

ALTER TABLE `bon_plan_region` DROP FOREIGN KEY `bon_plan_region_FK_1`;

ALTER TABLE `bon_plan_region` DROP FOREIGN KEY `bon_plan_region_FK_2`;

ALTER TABLE `categorie_i18n` DROP FOREIGN KEY `categorie_i18n_FK_1`;

ALTER TABLE `category_type_hebergement_i18n` DROP FOREIGN KEY `category_type_hebergement_i18n_FK_1`;

ALTER TABLE `demande_annulation` DROP FOREIGN KEY `demande_annulation_FK_1`;

ALTER TABLE `destination_i18n` DROP FOREIGN KEY `destination_i18n_FK_1`;

ALTER TABLE `edito_i18n` DROP FOREIGN KEY `edito_i18n_FK_1`;

ALTER TABLE `etablissement` DROP FOREIGN KEY `etablissement_FK_1`;

ALTER TABLE `etablissement` DROP FOREIGN KEY `etablissement_FK_2`;

ALTER TABLE `etablissement_activite` DROP FOREIGN KEY `etablissement_activite_FK_1`;

ALTER TABLE `etablissement_activite` DROP FOREIGN KEY `etablissement_activite_FK_2`;

ALTER TABLE `etablissement_baignade` DROP FOREIGN KEY `etablissement_baignade_FK_1`;

ALTER TABLE `etablissement_baignade` DROP FOREIGN KEY `etablissement_baignade_FK_2`;

ALTER TABLE `etablissement_destination` DROP FOREIGN KEY `etablissement_destination_FK_1`;

ALTER TABLE `etablissement_destination` DROP FOREIGN KEY `etablissement_destination_FK_2`;

ALTER TABLE `etablissement_event` DROP FOREIGN KEY `etablissement_event_FK_1`;

ALTER TABLE `etablissement_event` DROP FOREIGN KEY `etablissement_event_FK_2`;

ALTER TABLE `etablissement_i18n` DROP FOREIGN KEY `etablissement_i18n_FK_1`;

ALTER TABLE `etablissement_point_interet` DROP FOREIGN KEY `etablissement_point_interet_FK_1`;

ALTER TABLE `etablissement_point_interet` DROP FOREIGN KEY `etablissement_point_interet_FK_2`;

ALTER TABLE `etablissement_service_complementaire` DROP FOREIGN KEY `etablissement_service_complementaire_FK_1`;

ALTER TABLE `etablissement_service_complementaire` DROP FOREIGN KEY `etablissement_service_complementaire_FK_2`;

ALTER TABLE `etablissement_situation_geographique` DROP FOREIGN KEY `etablissement_situation_geographique_FK_1`;

ALTER TABLE `etablissement_situation_geographique` DROP FOREIGN KEY `etablissement_situation_geographique_FK_2`;

ALTER TABLE `etablissement_thematique` DROP FOREIGN KEY `etablissement_thematique_FK_1`;

ALTER TABLE `etablissement_thematique` DROP FOREIGN KEY `etablissement_thematique_FK_2`;

ALTER TABLE `etablissement_type_hebergement` DROP FOREIGN KEY `etablissement_type_hebergement_FK_1`;

ALTER TABLE `etablissement_type_hebergement` DROP FOREIGN KEY `etablissement_type_hebergement_FK_2`;

ALTER TABLE `event_i18n` DROP FOREIGN KEY `event_i18n_FK_1`;

ALTER TABLE `idee_weekend_i18n` DROP FOREIGN KEY `idee_weekend_i18n_FK_1`;

ALTER TABLE `job_log` DROP FOREIGN KEY `job_log_FK_1`;

ALTER TABLE `mise_en_avant_i18n` DROP FOREIGN KEY `mise_en_avant_i18n_FK_1`;

ALTER TABLE `multimedia_etablissement` DROP FOREIGN KEY `multimedia_etablissement_FK_1`;

ALTER TABLE `multimedia_etablissement_i18n` DROP FOREIGN KEY `multimedia_etablissement_i18n_FK_1`;

ALTER TABLE `multimedia_etablissement_tag` DROP FOREIGN KEY `multimedia_etablissement_tag_FK_1`;

ALTER TABLE `multimedia_etablissement_tag` DROP FOREIGN KEY `multimedia_etablissement_tag_FK_2`;

ALTER TABLE `multimedia_type_hebergement` DROP FOREIGN KEY `multimedia_type_hebergement_FK_1`;

ALTER TABLE `multimedia_type_hebergement_i18n` DROP FOREIGN KEY `multimedia_type_hebergement_i18n_FK_1`;

ALTER TABLE `pays_i18n` DROP FOREIGN KEY `pays_i18n_FK_1`;

ALTER TABLE `personnage` DROP FOREIGN KEY `personnage_FK_1`;

ALTER TABLE `personnage_i18n` DROP FOREIGN KEY `personnage_i18n_FK_1`;

ALTER TABLE `point_interet_i18n` DROP FOREIGN KEY `point_interet_i18n_FK_1`;

ALTER TABLE `region` DROP FOREIGN KEY `region_FK_1`;

ALTER TABLE `region` DROP FOREIGN KEY `region_FK_2`;

ALTER TABLE `region_i18n` DROP FOREIGN KEY `region_i18n_FK_1`;

ALTER TABLE `service_complementaire_i18n` DROP FOREIGN KEY `service_complementaire_i18n_FK_1`;

ALTER TABLE `situation_geographique_i18n` DROP FOREIGN KEY `situation_geographique_i18n_FK_1`;

ALTER TABLE `tag_i18n` DROP FOREIGN KEY `tag_i18n_FK_1`;

ALTER TABLE `thematique_i18n` DROP FOREIGN KEY `thematique_i18n_FK_1`;

ALTER TABLE `theme_activite` DROP FOREIGN KEY `theme_activite_FK_1`;

ALTER TABLE `theme_activite` DROP FOREIGN KEY `theme_activite_FK_2`;

ALTER TABLE `theme_baignade` DROP FOREIGN KEY `theme_baignade_FK_1`;

ALTER TABLE `theme_baignade` DROP FOREIGN KEY `theme_baignade_FK_2`;

ALTER TABLE `theme_i18n` DROP FOREIGN KEY `theme_i18n_FK_1`;

ALTER TABLE `theme_personnage` DROP FOREIGN KEY `theme_personnage_FK_1`;

ALTER TABLE `theme_personnage` DROP FOREIGN KEY `theme_personnage_FK_2`;

ALTER TABLE `theme_service_complementaire` DROP FOREIGN KEY `theme_service_complementaire_FK_1`;

ALTER TABLE `theme_service_complementaire` DROP FOREIGN KEY `theme_service_complementaire_FK_2`;

ALTER TABLE `top_camping` DROP FOREIGN KEY `top_camping_FK_1`;

ALTER TABLE `type_hebergement` DROP FOREIGN KEY `type_hebergement_FK_1`;

ALTER TABLE `type_hebergement` DROP FOREIGN KEY `type_hebergement_FK_2`;

ALTER TABLE `type_hebergement_capacite_i18n` DROP FOREIGN KEY `type_hebergement_capacite_i18n_FK_1`;

ALTER TABLE `type_hebergement_i18n` DROP FOREIGN KEY `type_hebergement_i18n_FK_1`;

ALTER TABLE `ville` DROP FOREIGN KEY `ville_FK_1`;

ALTER TABLE `ville_i18n` DROP FOREIGN KEY `ville_i18n_FK_1`;

ALTER TABLE `vos_vacances_i18n` DROP FOREIGN KEY `vos_vacances_i18n_FK_1`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}
