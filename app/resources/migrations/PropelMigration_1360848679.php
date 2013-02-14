<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1360848679.
 * Generated on 2013-02-14 14:31:19 by vagrant
 */
class PropelMigration_1360848679
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

ALTER TABLE `destination_i18n`
    ADD `seo_h1` VARCHAR(255) DEFAULT \'\' AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `metadata_i18n`
    ADD `seo_h1` VARCHAR(255) DEFAULT \'\' AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

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

ALTER TABLE `destination_i18n` DROP `seo_h1`;

ALTER TABLE `destination_i18n` DROP `seo_keywords`;

ALTER TABLE `metadata_i18n` DROP `seo_h1`;

ALTER TABLE `metadata_i18n` DROP `seo_keywords`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}