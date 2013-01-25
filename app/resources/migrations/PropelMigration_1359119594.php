<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1359119594.
 * Generated on 2013-01-25 14:13:14 by vagrant
 */
class PropelMigration_1359119594
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

ALTER TABLE `destination`
    ADD `image_detail_1` VARCHAR(255) AFTER `code`,
    ADD `image_detail_2` VARCHAR(255) AFTER `image_detail_1`;

ALTER TABLE `destination_i18n`
    ADD `slug` VARCHAR(255) NOT NULL AFTER `locale`,
    ADD `introduction` VARCHAR(255) AFTER `name`,
    ADD `description` TEXT AFTER `introduction`;

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

ALTER TABLE `destination` DROP `image_detail_1`;

ALTER TABLE `destination` DROP `image_detail_2`;

ALTER TABLE `destination_i18n` DROP `slug`;

ALTER TABLE `destination_i18n` DROP `introduction`;

ALTER TABLE `destination_i18n` DROP `description`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}