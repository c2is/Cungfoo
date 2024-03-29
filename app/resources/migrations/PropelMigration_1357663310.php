<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1357663310.
 * Generated on 2013-01-08 09:24:43 by m.brunot
 */
class PropelMigration_1357663310
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

CREATE TABLE `multimedia_type_hebergement`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `type_hebergement_id` INTEGER,
    `image_path` VARCHAR(255),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    INDEX `multimedia_type_hebergement_FI_1` (`type_hebergement_id`),
    CONSTRAINT `multimedia_type_hebergement_FK_1`
        FOREIGN KEY (`type_hebergement_id`)
        REFERENCES `type_hebergement` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `multimedia_type_hebergement_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL,
    `titre` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `multimedia_type_hebergement_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `multimedia_type_hebergement` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

ALTER TABLE `type_hebergement_i18n`
    ADD `slug` VARCHAR(255) AFTER `name`,
    ADD `indice` VARCHAR(255) AFTER `slug`;

ALTER TABLE `category_type_hebergement`
    ADD `minimum_price` VARCHAR(255) AFTER `code`,
    ADD `image_menu` VARCHAR(255) AFTER `minimum_price`,
    ADD `image_page` VARCHAR(255) AFTER `image_menu`,
    ADD `sortable_rank` INTEGER AFTER `active`;

ALTER TABLE `category_type_hebergement_i18n`
    ADD `slug` VARCHAR(255) AFTER `name`,
    ADD `accroche` VARCHAR(255) AFTER `slug`,
    ADD `description` TEXT AFTER `accroche`;

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

DROP TABLE IF EXISTS `multimedia_type_hebergement`;

DROP TABLE IF EXISTS `multimedia_type_hebergement_i18n`;

ALTER TABLE `type_hebergement_i18n` DROP `indice`;

ALTER TABLE `type_hebergement_i18n` DROP `slug`;

ALTER TABLE `category_type_hebergement` DROP `minimum_price`;

ALTER TABLE `category_type_hebergement` DROP `image_menu`;

ALTER TABLE `category_type_hebergement` DROP `image_page`;

ALTER TABLE `category_type_hebergement` DROP `sortable_rank`;

ALTER TABLE `category_type_hebergement_i18n` DROP `description`;

ALTER TABLE `category_type_hebergement_i18n` DROP `accroche`;

ALTER TABLE `category_type_hebergement_i18n` DROP `slug`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}
