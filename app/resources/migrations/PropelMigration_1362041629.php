<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1362041629.
 * Generated on 2013-02-28 09:53:49 by m.brunot
 */
class PropelMigration_1362041629
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

ALTER TABLE `portfolio_media` CHANGE `file` `file` VARCHAR(255);

ALTER TABLE `portfolio_media` CHANGE `width` `width` VARCHAR(255);

ALTER TABLE `portfolio_media` CHANGE `height` `height` VARCHAR(255);

ALTER TABLE `portfolio_media` CHANGE `size` `size` VARCHAR(255);

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

ALTER TABLE `portfolio_media` CHANGE `file` `file` VARCHAR(255) NOT NULL;

ALTER TABLE `portfolio_media` CHANGE `width` `width` TEXT;

ALTER TABLE `portfolio_media` CHANGE `height` `height` TEXT;

ALTER TABLE `portfolio_media` CHANGE `size` `size` TEXT;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}