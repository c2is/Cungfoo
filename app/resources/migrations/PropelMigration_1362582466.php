<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1362582466.
 * Generated on 2013-03-06 16:07:46 by m.brunot
 */
class PropelMigration_1362582466
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

DROP TABLE IF EXISTS `multimedia_etablissement`;

DROP TABLE IF EXISTS `multimedia_etablissement_i18n`;

DROP TABLE IF EXISTS `multimedia_etablissement_tag`;

ALTER TABLE `activite` DROP `image_path`;

ALTER TABLE `activite` DROP `vignette`;

ALTER TABLE `avantage` DROP `image_path`;

ALTER TABLE `baignade` DROP `image_path`;

ALTER TABLE `baignade` DROP `vignette`;

ALTER TABLE `bon_plan` DROP `image_menu`;

ALTER TABLE `bon_plan` DROP `image_page`;

ALTER TABLE `bon_plan` DROP `image_liste`;

ALTER TABLE `category_type_hebergement` DROP `image_menu`;

ALTER TABLE `category_type_hebergement` DROP `image_page`;

ALTER TABLE `demande_annulation` DROP `file_1`;

ALTER TABLE `demande_annulation` DROP `file_2`;

ALTER TABLE `demande_annulation` DROP `file_3`;

ALTER TABLE `demande_annulation` DROP `file_4`;

ALTER TABLE `departement` DROP `image_detail_1`;

ALTER TABLE `departement` DROP `image_detail_2`;

ALTER TABLE `destination` DROP `image_detail_1`;

ALTER TABLE `destination` DROP `image_detail_2`;

ALTER TABLE `etablissement` DROP `plan_path`;

ALTER TABLE `etablissement` DROP `vignette`;

ALTER TABLE `idee_weekend` DROP `image_path`;

ALTER TABLE `metadata` DROP `visuel`;

ALTER TABLE `mise_en_avant` DROP `image_fond_path`;

ALTER TABLE `mise_en_avant` DROP `illustration_path`;

ALTER TABLE `multimedia_type_hebergement` DROP `image_path`;

ALTER TABLE `pays` DROP `image_detail_1`;

ALTER TABLE `pays` DROP `image_detail_2`;

ALTER TABLE `personnage` DROP `image_path`;

ALTER TABLE `portfolio_usage`
    ADD `sortable_rank` INTEGER AFTER `element_id`;

ALTER TABLE `region` DROP `image_path`;

ALTER TABLE `region` DROP `image_encart_path`;

ALTER TABLE `region` DROP `image_encart_petite_path`;

ALTER TABLE `region` DROP `image_detail_1`;

ALTER TABLE `region` DROP `image_detail_2`;

ALTER TABLE `region_ref` DROP `image_detail_1`;

ALTER TABLE `region_ref` DROP `image_detail_2`;

ALTER TABLE `service_complementaire` DROP `image_path`;

ALTER TABLE `service_complementaire` DROP `vignette`;

ALTER TABLE `thematique` DROP `image_path`;

ALTER TABLE `theme` DROP `image_path`;

ALTER TABLE `type_hebergement` DROP `image_hebergement_path`;

ALTER TABLE `type_hebergement` DROP `image_composition_path`;

ALTER TABLE `type_hebergement_capacite` DROP `image_menu`;

ALTER TABLE `type_hebergement_capacite` DROP `image_page`;

ALTER TABLE `ville` DROP `image_detail_1`;

ALTER TABLE `ville` DROP `image_detail_2`;

ALTER TABLE `vos_vacances` DROP `image_path`;

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

ALTER TABLE `activite`
    ADD `image_path` VARCHAR(255) AFTER `code`,
    ADD `vignette` VARCHAR(255) AFTER `image_path`;

ALTER TABLE `avantage`
    ADD `image_path` VARCHAR(255) AFTER `personnage_id`;

ALTER TABLE `baignade`
    ADD `image_path` VARCHAR(255) AFTER `code`,
    ADD `vignette` VARCHAR(255) AFTER `image_path`;

ALTER TABLE `bon_plan`
    ADD `image_menu` VARCHAR(255) AFTER `prix_barre`,
    ADD `image_page` VARCHAR(255) AFTER `image_menu`,
    ADD `image_liste` VARCHAR(255) AFTER `image_page`;

ALTER TABLE `category_type_hebergement`
    ADD `image_menu` VARCHAR(255) AFTER `minimum_price`,
    ADD `image_page` VARCHAR(255) AFTER `image_menu`;

ALTER TABLE `demande_annulation`
    ADD `file_1` VARCHAR(255) AFTER `sinistre_resume`,
    ADD `file_2` VARCHAR(255) AFTER `file_1`,
    ADD `file_3` VARCHAR(255) AFTER `file_2`,
    ADD `file_4` VARCHAR(255) AFTER `file_3`;

ALTER TABLE `departement`
    ADD `image_detail_1` VARCHAR(255) AFTER `region_ref_id`,
    ADD `image_detail_2` VARCHAR(255) AFTER `image_detail_1`;

ALTER TABLE `destination`
    ADD `image_detail_1` VARCHAR(255) AFTER `code`,
    ADD `image_detail_2` VARCHAR(255) AFTER `image_detail_1`;

ALTER TABLE `etablissement`
    ADD `plan_path` VARCHAR(255) AFTER `capacite`,
    ADD `vignette` VARCHAR(255) AFTER `plan_path`;

ALTER TABLE `idee_weekend`
    ADD `image_path` VARCHAR(255) AFTER `home`;

ALTER TABLE `metadata`
    ADD `visuel` VARCHAR(255) AFTER `table_ref`;

ALTER TABLE `mise_en_avant`
    ADD `image_fond_path` VARCHAR(255) AFTER `id`,
    ADD `illustration_path` VARCHAR(255) AFTER `prix`;

ALTER TABLE `multimedia_type_hebergement`
    ADD `image_path` VARCHAR(255) AFTER `type_hebergement_id`;

ALTER TABLE `pays`
    ADD `image_detail_1` VARCHAR(255) AFTER `code`,
    ADD `image_detail_2` VARCHAR(255) AFTER `image_detail_1`;

ALTER TABLE `personnage`
    ADD `image_path` VARCHAR(255) AFTER `age`;

ALTER TABLE `portfolio_usage` DROP `sortable_rank`;

ALTER TABLE `region`
    ADD `image_path` VARCHAR(255) AFTER `code`,
    ADD `image_encart_path` VARCHAR(255) AFTER `image_path`,
    ADD `image_encart_petite_path` VARCHAR(255) AFTER `image_encart_path`,
    ADD `image_detail_1` VARCHAR(255) AFTER `mea_home`,
    ADD `image_detail_2` VARCHAR(255) AFTER `image_detail_1`;

ALTER TABLE `region_ref`
    ADD `image_detail_1` VARCHAR(255) AFTER `pays_id`,
    ADD `image_detail_2` VARCHAR(255) AFTER `image_detail_1`;

ALTER TABLE `service_complementaire`
    ADD `image_path` VARCHAR(255) AFTER `code`,
    ADD `vignette` VARCHAR(255) AFTER `image_path`;

ALTER TABLE `thematique`
    ADD `image_path` VARCHAR(255) AFTER `code`;

ALTER TABLE `theme`
    ADD `image_path` VARCHAR(255) AFTER `id`;

ALTER TABLE `type_hebergement`
    ADD `image_hebergement_path` VARCHAR(255) AFTER `nombre_place`,
    ADD `image_composition_path` VARCHAR(255) AFTER `image_hebergement_path`;

ALTER TABLE `type_hebergement_capacite`
    ADD `image_menu` VARCHAR(255) AFTER `id`,
    ADD `image_page` VARCHAR(255) AFTER `image_menu`;

ALTER TABLE `ville`
    ADD `image_detail_1` VARCHAR(255) AFTER `region_id`,
    ADD `image_detail_2` VARCHAR(255) AFTER `image_detail_1`;

ALTER TABLE `vos_vacances`
    ADD `image_path` VARCHAR(255) AFTER `age`;

CREATE TABLE `multimedia_etablissement`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `etablissement_id` INTEGER,
    `image_path` VARCHAR(255),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    INDEX `multimedia_etablissement_FI_1` (`etablissement_id`),
    CONSTRAINT `multimedia_etablissement_FK_1`
        FOREIGN KEY (`etablissement_id`)
        REFERENCES `etablissement` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `multimedia_etablissement_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL,
    `titre` VARCHAR(255) NOT NULL,
    `seo_title` VARCHAR(255),
    `seo_description` TEXT,
    `seo_h1` VARCHAR(255),
    `seo_keywords` TEXT,
    `active_locale` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `multimedia_etablissement_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `multimedia_etablissement` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `multimedia_etablissement_tag`
(
    `multimedia_etablissement_id` INTEGER NOT NULL,
    `tag_id` INTEGER NOT NULL,
    PRIMARY KEY (`multimedia_etablissement_id`,`tag_id`),
    INDEX `multimedia_etablissement_tag_FI_2` (`tag_id`),
    CONSTRAINT `multimedia_etablissement_tag_FK_1`
        FOREIGN KEY (`multimedia_etablissement_id`)
        REFERENCES `multimedia_etablissement` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `multimedia_etablissement_tag_FK_2`
        FOREIGN KEY (`tag_id`)
        REFERENCES `tag` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}