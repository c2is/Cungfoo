<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1363165475.
 * Generated on 2013-03-13 10:04:35 by vagrant
 */
class PropelMigration_1363165475
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

ALTER TABLE `etablissement_type_hebergement` ADD CONSTRAINT `etablissement_type_hebergement_FK_1`
    FOREIGN KEY (`etablissement_id`)
    REFERENCES `etablissement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_type_hebergement` ADD CONSTRAINT `etablissement_type_hebergement_FK_2`
    FOREIGN KEY (`type_hebergement_id`)
    REFERENCES `type_hebergement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `portfolio_media` DROP `title`;

ALTER TABLE `portfolio_media` DROP `description`;

ALTER TABLE `portfolio_media_i18n`
    ADD `title` VARCHAR(255) NOT NULL AFTER `locale`,
    ADD `description` TEXT AFTER `title`;

ALTER TABLE `portfolio_tag`
    ADD `category_id` INTEGER AFTER `id`;

ALTER TABLE `portfolio_tag` DROP `name`;

ALTER TABLE `portfolio_tag` DROP `description`;

CREATE INDEX `portfolio_tag_FI_1` ON `portfolio_tag` (`category_id`);

ALTER TABLE `portfolio_tag` ADD CONSTRAINT `portfolio_tag_FK_1`
    FOREIGN KEY (`category_id`)
    REFERENCES `portfolio_tag_category` (`id`)
    ON DELETE SET NULL;

ALTER TABLE `portfolio_tag_i18n`
    ADD `name` VARCHAR(255) AFTER `locale`,
    ADD `slug` VARCHAR(255) AFTER `name`,
    ADD `description` TEXT AFTER `slug`;

CREATE TABLE `portfolio_tag_category`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `slug` VARCHAR(255),
    PRIMARY KEY (`id`)
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

DROP TABLE IF EXISTS `portfolio_tag_category`;

ALTER TABLE `etablissement_type_hebergement` DROP FOREIGN KEY `etablissement_type_hebergement_FK_1`;

ALTER TABLE `etablissement_type_hebergement` DROP FOREIGN KEY `etablissement_type_hebergement_FK_2`;

ALTER TABLE `portfolio_media`
    ADD `title` VARCHAR(255) NOT NULL AFTER `file`,
    ADD `description` TEXT AFTER `title`;

ALTER TABLE `portfolio_media_i18n` DROP `title`;

ALTER TABLE `portfolio_media_i18n` DROP `description`;

ALTER TABLE `portfolio_tag` DROP FOREIGN KEY `portfolio_tag_FK_1`;

DROP INDEX `portfolio_tag_FI_1` ON `portfolio_tag`;

ALTER TABLE `portfolio_tag`
    ADD `name` VARCHAR(255) NOT NULL AFTER `id`,
    ADD `description` TEXT AFTER `name`;

ALTER TABLE `portfolio_tag` DROP `category_id`;

ALTER TABLE `portfolio_tag_i18n` DROP `name`;

ALTER TABLE `portfolio_tag_i18n` DROP `slug`;

ALTER TABLE `portfolio_tag_i18n` DROP `description`;

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
    CONSTRAINT `multimedia_etablissement_tag_FK_2`
        FOREIGN KEY (`tag_id`)
        REFERENCES `tag` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `multimedia_etablissement_tag_FK_1`
        FOREIGN KEY (`multimedia_etablissement_id`)
        REFERENCES `multimedia_etablissement` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}