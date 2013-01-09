<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1357635200.
 * Generated on 2013-01-08 09:53:20 by vagrant
 */
class PropelMigration_1357635200
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

ALTER TABLE `event`
    ADD `tel` VARCHAR(255) AFTER `priority`,
    ADD `fax` VARCHAR(255) AFTER `tel`,
    ADD `email` VARCHAR(255) AFTER `fax`,
    ADD `website` VARCHAR(255) AFTER `email`;

ALTER TABLE `event_i18n`
    ADD `description` TEXT AFTER `subtitle`,
    ADD `transport` TEXT AFTER `description`,
    ADD `slug` VARCHAR(255) AFTER `transport`;

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

ALTER TABLE `event` DROP `tel`;

ALTER TABLE `event` DROP `fax`;

ALTER TABLE `event` DROP `email`;

ALTER TABLE `event` DROP `website`;

ALTER TABLE `event_i18n` DROP `description`;

ALTER TABLE `event_i18n` DROP `transport`;

ALTER TABLE `event_i18n` DROP `slug`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}