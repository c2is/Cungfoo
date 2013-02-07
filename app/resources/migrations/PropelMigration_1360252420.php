<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1360252420.
 * Generated on 2013-02-07 16:53:40 by m.brunot
 */
class PropelMigration_1360252420
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

CREATE TABLE `metadata`
(
    `id` INTEGER(5) NOT NULL AUTO_INCREMENT,
    `table_ref` VARCHAR(255) NOT NULL,
    `visuel` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `metadata_i18n`
(
    `id` INTEGER(5) NOT NULL,
    `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL,
    `title` VARCHAR(255),
    `subtitle` VARCHAR(255),
    `accroche` VARCHAR(255),
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `metadata_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `metadata` (`id`)
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

DROP TABLE IF EXISTS `metadata`;

DROP TABLE IF EXISTS `metadata_i18n`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}