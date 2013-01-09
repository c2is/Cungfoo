<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1357725008.
 * Generated on 2013-01-09 10:50:08 by m.brunot
 */
class PropelMigration_1357725008
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

ALTER TABLE `type_hebergement`
    ADD `type_hebergement_capacite_id` INTEGER AFTER `code`;

CREATE INDEX `type_hebergement_FI_2` ON `type_hebergement` (`type_hebergement_capacite_id`);

ALTER TABLE `type_hebergement` ADD CONSTRAINT `type_hebergement_FK_2`
    FOREIGN KEY (`type_hebergement_capacite_id`)
    REFERENCES `type_hebergement_capacite` (`id`);

CREATE TABLE `type_hebergement_capacite`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `image_menu` VARCHAR(255),
    `image_page` VARCHAR(255),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `active` TINYINT(1) DEFAULT 1,
    `sortable_rank` INTEGER,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `type_hebergement_capacite_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255),
    `description` TEXT,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `type_hebergement_capacite_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `type_hebergement_capacite` (`id`)
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

DROP TABLE IF EXISTS `type_hebergement_capacite`;

DROP TABLE IF EXISTS `type_hebergement_capacite_i18n`;

ALTER TABLE `type_hebergement` DROP FOREIGN KEY `type_hebergement_FK_2`;

DROP INDEX `type_hebergement_FI_2` ON `type_hebergement`;

ALTER TABLE `type_hebergement` DROP `type_hebergement_capacite_id`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}
