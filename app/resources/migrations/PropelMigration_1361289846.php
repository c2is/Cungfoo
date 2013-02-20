<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1361289846.
 * Generated on 2013-02-19 17:04:06 by m.brunot
 */
class PropelMigration_1361289846
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

ALTER TABLE `etablissement_type_hebergement` DROP FOREIGN KEY `etablissement_type_hebergement_FK_1`;

ALTER TABLE `etablissement_type_hebergement` DROP FOREIGN KEY `etablissement_type_hebergement_FK_2`;

ALTER TABLE `etablissement_type_hebergement` DROP PRIMARY KEY;

ALTER TABLE `etablissement_type_hebergement` CHANGE `etablissement_id` `etablissement_id` INTEGER;

ALTER TABLE `etablissement_type_hebergement` CHANGE `type_hebergement_id` `type_hebergement_id` INTEGER;

ALTER TABLE `etablissement_type_hebergement`
    ADD `id` INTEGER NOT NULL AUTO_INCREMENT FIRST;

ALTER TABLE `etablissement_type_hebergement` DROP `minimum_price`;

ALTER TABLE `etablissement_type_hebergement` DROP `minimum_price_discount_label`;

ALTER TABLE `etablissement_type_hebergement` DROP `minimum_price_start_date`;

ALTER TABLE `etablissement_type_hebergement` DROP `minimum_price_end_date`;

ALTER TABLE `etablissement_type_hebergement` ADD PRIMARY KEY (`id`);

CREATE INDEX `etablissement_type_hebergement_FI_1` ON `etablissement_type_hebergement` (`etablissement_id`);

CREATE TABLE `etablissement_type_hebergement_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL,
    `minimum_price` VARCHAR(255),
    `minimum_price_discount_label` VARCHAR(255),
    `minimum_price_start_date` DATE,
    `minimum_price_end_date` DATE,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `etablissement_type_hebergement_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `etablissement_type_hebergement` (`id`)
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

DROP TABLE IF EXISTS `etablissement_type_hebergement_i18n`;

ALTER TABLE `etablissement_type_hebergement` DROP PRIMARY KEY;

DROP INDEX `etablissement_type_hebergement_FI_1` ON `etablissement_type_hebergement`;

ALTER TABLE `etablissement_type_hebergement` CHANGE `etablissement_id` `etablissement_id` INTEGER NOT NULL;

ALTER TABLE `etablissement_type_hebergement` CHANGE `type_hebergement_id` `type_hebergement_id` INTEGER NOT NULL;

ALTER TABLE `etablissement_type_hebergement`
    ADD `minimum_price` VARCHAR(255) AFTER `type_hebergement_id`,
    ADD `minimum_price_discount_label` VARCHAR(255) AFTER `minimum_price`,
    ADD `minimum_price_start_date` DATE AFTER `minimum_price_discount_label`,
    ADD `minimum_price_end_date` DATE AFTER `minimum_price_start_date`;

ALTER TABLE `etablissement_type_hebergement` DROP `id`;

ALTER TABLE `etablissement_type_hebergement` ADD PRIMARY KEY (`etablissement_id`,`type_hebergement_id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}
