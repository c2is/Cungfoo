<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1356089151.
 * Generated on 2012-12-21 12:25:51 by vagrant
 */
class PropelMigration_1356089151
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

ALTER TABLE `point_interet`
    ADD `tel` VARCHAR(255) AFTER `city`,
    ADD `fax` VARCHAR(255) AFTER `tel`,
    ADD `email` VARCHAR(255) AFTER `fax`,
    ADD `website` VARCHAR(255) AFTER `email`;

ALTER TABLE `point_interet_i18n`
    ADD `transport` TEXT AFTER `presentation`,
    ADD `categorie` VARCHAR(255) AFTER `transport`,
    ADD `type` VARCHAR(255) AFTER `categorie`;
    ADD `slug` VARCHAR(255) AFTER `type`;

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

ALTER TABLE `point_interet` DROP `tel`;

ALTER TABLE `point_interet` DROP `fax`;

ALTER TABLE `point_interet` DROP `email`;

ALTER TABLE `point_interet` DROP `website`;

ALTER TABLE `point_interet_i18n` DROP `transport`;

ALTER TABLE `point_interet_i18n` DROP `categorie`;

ALTER TABLE `point_interet_i18n` DROP `type`;

ALTER TABLE `point_interet_i18n` DROP `slug`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}