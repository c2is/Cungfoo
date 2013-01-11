<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1357903035.
 * Generated on 2013-01-11 12:17:15 by vagrant
 */
class PropelMigration_1357903035
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

DROP TABLE IF EXISTS `bon_plan_destination`;

CREATE TABLE `bon_plan_region`
(
    `bon_plan_id` INTEGER NOT NULL,
    `region_id` INTEGER NOT NULL,
    PRIMARY KEY (`bon_plan_id`,`region_id`),
    INDEX `bon_plan_region_FI_2` (`region_id`),
    CONSTRAINT `bon_plan_region_FK_1`
        FOREIGN KEY (`bon_plan_id`)
        REFERENCES `bon_plan` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `bon_plan_region_FK_2`
        FOREIGN KEY (`region_id`)
        REFERENCES `region` (`id`)
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

DROP TABLE IF EXISTS `bon_plan_region`;

CREATE TABLE `bon_plan_destination`
(
    `bon_plan_id` INTEGER NOT NULL,
    `destination_id` INTEGER NOT NULL,
    PRIMARY KEY (`bon_plan_id`,`destination_id`),
    INDEX `bon_plan_destination_FI_2` (`destination_id`),
    CONSTRAINT `bon_plan_destination_FK_1`
        FOREIGN KEY (`bon_plan_id`)
        REFERENCES `bon_plan` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `bon_plan_destination_FK_2`
        FOREIGN KEY (`destination_id`)
        REFERENCES `destination` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}