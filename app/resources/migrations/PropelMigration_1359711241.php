<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1359711241.
 * Generated on 2013-02-01 10:34:01 by vagrant
 */
class PropelMigration_1359711241
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

ALTER TABLE `activite_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `avantage_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `baignade_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `bon_plan_bon_plan_categorie` DROP FOREIGN KEY `bon_plan_bon_plan_categorie_FK_1`;

ALTER TABLE `bon_plan_bon_plan_categorie` DROP FOREIGN KEY `bon_plan_bon_plan_categorie_FK_2`;

ALTER TABLE `bon_plan_bon_plan_categorie` ADD CONSTRAINT `bon_plan_bon_plan_categorie_FK_1`
    FOREIGN KEY (`bon_plan_id`)
    REFERENCES `bon_plan` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `bon_plan_bon_plan_categorie` ADD CONSTRAINT `bon_plan_bon_plan_categorie_FK_2`
    FOREIGN KEY (`bon_plan_categorie_id`)
    REFERENCES `bon_plan_categorie` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `bon_plan_categorie_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `bon_plan_etablissement` DROP FOREIGN KEY `bon_plan_etablissement_FK_2`;

ALTER TABLE `bon_plan_etablissement` ADD CONSTRAINT `bon_plan_etablissement_FK_2`
    FOREIGN KEY (`etablissement_id`)
    REFERENCES `etablissement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `bon_plan_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `bon_plan_region` DROP FOREIGN KEY `bon_plan_region_FK_2`;

ALTER TABLE `bon_plan_region` ADD CONSTRAINT `bon_plan_region_FK_2`
    FOREIGN KEY (`region_id`)
    REFERENCES `region` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `categorie_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `category_type_hebergement_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `destination_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `edito_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `etablissement_baignade` DROP FOREIGN KEY `etablissement_baignade_FK_2`;

ALTER TABLE `etablissement_baignade` ADD CONSTRAINT `etablissement_baignade_FK_2`
    FOREIGN KEY (`baignade_id`)
    REFERENCES `baignade` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_destination` DROP FOREIGN KEY `etablissement_destination_FK_2`;

ALTER TABLE `etablissement_destination` ADD CONSTRAINT `etablissement_destination_FK_2`
    FOREIGN KEY (`destination_id`)
    REFERENCES `destination` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_event` DROP FOREIGN KEY `etablissement_event_FK_2`;

ALTER TABLE `etablissement_event` ADD CONSTRAINT `etablissement_event_FK_2`
    FOREIGN KEY (`event_id`)
    REFERENCES `event` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `etablissement_point_interet` DROP FOREIGN KEY `etablissement_point_interet_FK_2`;

ALTER TABLE `etablissement_point_interet` ADD CONSTRAINT `etablissement_point_interet_FK_2`
    FOREIGN KEY (`point_interet_id`)
    REFERENCES `point_interet` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_service_complementaire` DROP FOREIGN KEY `etablissement_service_complementaire_FK_2`;

ALTER TABLE `etablissement_service_complementaire` ADD CONSTRAINT `etablissement_service_complementaire_FK_2`
    FOREIGN KEY (`service_complementaire_id`)
    REFERENCES `service_complementaire` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_situation_geographique` DROP FOREIGN KEY `etablissement_situation_geographique_FK_2`;

ALTER TABLE `etablissement_situation_geographique` ADD CONSTRAINT `etablissement_situation_geographique_FK_2`
    FOREIGN KEY (`situation_geographique_id`)
    REFERENCES `situation_geographique` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_thematique` DROP FOREIGN KEY `etablissement_thematique_FK_2`;

ALTER TABLE `etablissement_thematique` ADD CONSTRAINT `etablissement_thematique_FK_2`
    FOREIGN KEY (`thematique_id`)
    REFERENCES `thematique` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `event_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `idee_weekend_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `mise_en_avant_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `multimedia_etablissement_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `multimedia_etablissement_tag` DROP FOREIGN KEY `multimedia_etablissement_tag_FK_2`;

ALTER TABLE `multimedia_etablissement_tag` ADD CONSTRAINT `multimedia_etablissement_tag_FK_2`
    FOREIGN KEY (`tag_id`)
    REFERENCES `tag` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `multimedia_type_hebergement_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `pays_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `personnage_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `point_interet_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `region_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `service_complementaire_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `situation_geographique_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `tag_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `thematique_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `theme_activite` DROP FOREIGN KEY `theme_activite_FK_1`;

ALTER TABLE `theme_activite` DROP FOREIGN KEY `theme_activite_FK_2`;

ALTER TABLE `theme_activite` ADD CONSTRAINT `theme_activite_FK_1`
    FOREIGN KEY (`theme_id`)
    REFERENCES `theme` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `theme_activite` ADD CONSTRAINT `theme_activite_FK_2`
    FOREIGN KEY (`activite_id`)
    REFERENCES `activite` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `theme_baignade` DROP FOREIGN KEY `theme_baignade_FK_1`;

ALTER TABLE `theme_baignade` DROP FOREIGN KEY `theme_baignade_FK_2`;

ALTER TABLE `theme_baignade` ADD CONSTRAINT `theme_baignade_FK_1`
    FOREIGN KEY (`theme_id`)
    REFERENCES `theme` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `theme_baignade` ADD CONSTRAINT `theme_baignade_FK_2`
    FOREIGN KEY (`baignade_id`)
    REFERENCES `baignade` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `theme_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `theme_personnage` DROP FOREIGN KEY `theme_personnage_FK_1`;

ALTER TABLE `theme_personnage` DROP FOREIGN KEY `theme_personnage_FK_2`;

ALTER TABLE `theme_personnage` ADD CONSTRAINT `theme_personnage_FK_1`
    FOREIGN KEY (`theme_id`)
    REFERENCES `theme` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `theme_personnage` ADD CONSTRAINT `theme_personnage_FK_2`
    FOREIGN KEY (`personnage_id`)
    REFERENCES `personnage` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `theme_service_complementaire` DROP FOREIGN KEY `theme_service_complementaire_FK_1`;

ALTER TABLE `theme_service_complementaire` DROP FOREIGN KEY `theme_service_complementaire_FK_2`;

ALTER TABLE `theme_service_complementaire` ADD CONSTRAINT `theme_service_complementaire_FK_1`
    FOREIGN KEY (`theme_id`)
    REFERENCES `theme` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `theme_service_complementaire` ADD CONSTRAINT `theme_service_complementaire_FK_2`
    FOREIGN KEY (`service_complementaire_id`)
    REFERENCES `service_complementaire` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `type_hebergement_capacite_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `type_hebergement_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `ville_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

ALTER TABLE `vos_vacances_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL;

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

ALTER TABLE `activite_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `avantage_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `baignade_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `bon_plan_bon_plan_categorie` DROP FOREIGN KEY `bon_plan_bon_plan_categorie_FK_1`;

ALTER TABLE `bon_plan_bon_plan_categorie` DROP FOREIGN KEY `bon_plan_bon_plan_categorie_FK_2`;

ALTER TABLE `bon_plan_bon_plan_categorie` ADD CONSTRAINT `bon_plan_bon_plan_categorie_FK_1`
    FOREIGN KEY (`bon_plan_id`)
    REFERENCES `bon_plan` (`id`);

ALTER TABLE `bon_plan_bon_plan_categorie` ADD CONSTRAINT `bon_plan_bon_plan_categorie_FK_2`
    FOREIGN KEY (`bon_plan_categorie_id`)
    REFERENCES `bon_plan_categorie` (`id`);

ALTER TABLE `bon_plan_categorie_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `bon_plan_etablissement` DROP FOREIGN KEY `bon_plan_etablissement_FK_2`;

ALTER TABLE `bon_plan_etablissement` ADD CONSTRAINT `bon_plan_etablissement_FK_2`
    FOREIGN KEY (`etablissement_id`)
    REFERENCES `etablissement` (`id`);

ALTER TABLE `bon_plan_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `bon_plan_region` DROP FOREIGN KEY `bon_plan_region_FK_2`;

ALTER TABLE `bon_plan_region` ADD CONSTRAINT `bon_plan_region_FK_2`
    FOREIGN KEY (`region_id`)
    REFERENCES `region` (`id`);

ALTER TABLE `categorie_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `category_type_hebergement_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `destination_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `edito_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `etablissement_baignade` DROP FOREIGN KEY `etablissement_baignade_FK_2`;

ALTER TABLE `etablissement_baignade` ADD CONSTRAINT `etablissement_baignade_FK_2`
    FOREIGN KEY (`baignade_id`)
    REFERENCES `baignade` (`id`);

ALTER TABLE `etablissement_destination` DROP FOREIGN KEY `etablissement_destination_FK_2`;

ALTER TABLE `etablissement_destination` ADD CONSTRAINT `etablissement_destination_FK_2`
    FOREIGN KEY (`destination_id`)
    REFERENCES `destination` (`id`);

ALTER TABLE `etablissement_event` DROP FOREIGN KEY `etablissement_event_FK_2`;

ALTER TABLE `etablissement_event` ADD CONSTRAINT `etablissement_event_FK_2`
    FOREIGN KEY (`event_id`)
    REFERENCES `event` (`id`);

ALTER TABLE `etablissement_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `etablissement_point_interet` DROP FOREIGN KEY `etablissement_point_interet_FK_2`;

ALTER TABLE `etablissement_point_interet` ADD CONSTRAINT `etablissement_point_interet_FK_2`
    FOREIGN KEY (`point_interet_id`)
    REFERENCES `point_interet` (`id`);

ALTER TABLE `etablissement_service_complementaire` DROP FOREIGN KEY `etablissement_service_complementaire_FK_2`;

ALTER TABLE `etablissement_service_complementaire` ADD CONSTRAINT `etablissement_service_complementaire_FK_2`
    FOREIGN KEY (`service_complementaire_id`)
    REFERENCES `service_complementaire` (`id`);

ALTER TABLE `etablissement_situation_geographique` DROP FOREIGN KEY `etablissement_situation_geographique_FK_2`;

ALTER TABLE `etablissement_situation_geographique` ADD CONSTRAINT `etablissement_situation_geographique_FK_2`
    FOREIGN KEY (`situation_geographique_id`)
    REFERENCES `situation_geographique` (`id`);

ALTER TABLE `etablissement_thematique` DROP FOREIGN KEY `etablissement_thematique_FK_2`;

ALTER TABLE `etablissement_thematique` ADD CONSTRAINT `etablissement_thematique_FK_2`
    FOREIGN KEY (`thematique_id`)
    REFERENCES `thematique` (`id`);

ALTER TABLE `event_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `idee_weekend_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `mise_en_avant_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `multimedia_etablissement_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `multimedia_etablissement_tag` DROP FOREIGN KEY `multimedia_etablissement_tag_FK_2`;

ALTER TABLE `multimedia_etablissement_tag` ADD CONSTRAINT `multimedia_etablissement_tag_FK_2`
    FOREIGN KEY (`tag_id`)
    REFERENCES `tag` (`id`);

ALTER TABLE `multimedia_type_hebergement_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `pays_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `personnage_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `point_interet_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `region_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `service_complementaire_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `situation_geographique_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `tag_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `thematique_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `theme_activite` DROP FOREIGN KEY `theme_activite_FK_1`;

ALTER TABLE `theme_activite` DROP FOREIGN KEY `theme_activite_FK_2`;

ALTER TABLE `theme_activite` ADD CONSTRAINT `theme_activite_FK_1`
    FOREIGN KEY (`theme_id`)
    REFERENCES `theme` (`id`);

ALTER TABLE `theme_activite` ADD CONSTRAINT `theme_activite_FK_2`
    FOREIGN KEY (`activite_id`)
    REFERENCES `activite` (`id`);

ALTER TABLE `theme_baignade` DROP FOREIGN KEY `theme_baignade_FK_1`;

ALTER TABLE `theme_baignade` DROP FOREIGN KEY `theme_baignade_FK_2`;

ALTER TABLE `theme_baignade` ADD CONSTRAINT `theme_baignade_FK_1`
    FOREIGN KEY (`theme_id`)
    REFERENCES `theme` (`id`);

ALTER TABLE `theme_baignade` ADD CONSTRAINT `theme_baignade_FK_2`
    FOREIGN KEY (`baignade_id`)
    REFERENCES `baignade` (`id`);

ALTER TABLE `theme_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `theme_personnage` DROP FOREIGN KEY `theme_personnage_FK_1`;

ALTER TABLE `theme_personnage` DROP FOREIGN KEY `theme_personnage_FK_2`;

ALTER TABLE `theme_personnage` ADD CONSTRAINT `theme_personnage_FK_1`
    FOREIGN KEY (`theme_id`)
    REFERENCES `theme` (`id`);

ALTER TABLE `theme_personnage` ADD CONSTRAINT `theme_personnage_FK_2`
    FOREIGN KEY (`personnage_id`)
    REFERENCES `personnage` (`id`);

ALTER TABLE `theme_service_complementaire` DROP FOREIGN KEY `theme_service_complementaire_FK_1`;

ALTER TABLE `theme_service_complementaire` DROP FOREIGN KEY `theme_service_complementaire_FK_2`;

ALTER TABLE `theme_service_complementaire` ADD CONSTRAINT `theme_service_complementaire_FK_1`
    FOREIGN KEY (`theme_id`)
    REFERENCES `theme` (`id`);

ALTER TABLE `theme_service_complementaire` ADD CONSTRAINT `theme_service_complementaire_FK_2`
    FOREIGN KEY (`service_complementaire_id`)
    REFERENCES `service_complementaire` (`id`);

ALTER TABLE `type_hebergement_capacite_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `type_hebergement_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `ville_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

ALTER TABLE `vos_vacances_i18n` CHANGE `locale` `locale` VARCHAR(5) DEFAULT \'en_US\' NOT NULL;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}