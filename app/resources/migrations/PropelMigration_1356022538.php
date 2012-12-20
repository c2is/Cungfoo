<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1356022538.
 * Generated on 2012-12-20 17:55:38 by m.brunot
 */
class PropelMigration_1356022538
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

CREATE TABLE `bon_plan_categorie`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `order` INTEGER,
    `active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `bon_plan`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `bon_plan_categorie_id` INTEGER NOT NULL,
    `date_debut` DATE,
    `date_fin` DATE,
    `prix` INTEGER,
    `prix_barre` INTEGER,
    `image_menu` VARCHAR(255),
    `active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    INDEX `bon_plan_FI_1` (`bon_plan_categorie_id`),
    CONSTRAINT `bon_plan_FK_1`
        FOREIGN KEY (`bon_plan_categorie_id`)
        REFERENCES `bon_plan_categorie` (`id`)
) ENGINE=InnoDB;

CREATE TABLE `bon_plan_categorie_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL,
    `name` VARCHAR(255),
    `slug` VARCHAR(255),
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `bon_plan_categorie_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `bon_plan_categorie` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `bon_plan_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL,
    `name` VARCHAR(255),
    `slug` VARCHAR(255),
    `introduction` VARCHAR(255),
    `description` VARCHAR(255),
    `indice` VARCHAR(255),
    `image_page` VARCHAR(255),
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `bon_plan_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `bon_plan` (`id`)
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

DROP TABLE IF EXISTS `bon_plan_categorie`;

DROP TABLE IF EXISTS `bon_plan`;

DROP TABLE IF EXISTS `bon_plan_categorie_i18n`;

DROP TABLE IF EXISTS `bon_plan_i18n`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}