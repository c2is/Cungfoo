<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1358265018.
 * Generated on 2013-01-15 16:50:18 by m.brunot
 */
class PropelMigration_1358265018
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

ALTER TABLE `region`
    ADD `destination_id` INTEGER AFTER `pays_id`;

CREATE INDEX `region_FI_2` ON `region` (`destination_id`);

ALTER TABLE `region` ADD CONSTRAINT `region_FK_2`
    FOREIGN KEY (`destination_id`)
    REFERENCES `destination` (`id`);

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

ALTER TABLE `region` DROP FOREIGN KEY `region_FK_2`;

DROP INDEX `region_FI_2` ON `region`;

ALTER TABLE `region` DROP `destination_id`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}
