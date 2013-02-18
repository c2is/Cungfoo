<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1361182254.
 * Generated on 2013-02-18 11:10:54 by vagrant
 */
class PropelMigration_1361182254
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

CREATE TABLE `region_point_interet`
(
    `region_id` INTEGER NOT NULL,
    `point_interet_id` INTEGER NOT NULL,
    PRIMARY KEY (`region_id`,`point_interet_id`),
    INDEX `region_point_interet_FI_2` (`point_interet_id`),
    CONSTRAINT `region_point_interet_FK_1`
        FOREIGN KEY (`region_id`)
        REFERENCES `region` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `region_point_interet_FK_2`
        FOREIGN KEY (`point_interet_id`)
        REFERENCES `point_interet` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `region_event`
(
    `region_id` INTEGER NOT NULL,
    `event_id` INTEGER NOT NULL,
    PRIMARY KEY (`region_id`,`event_id`),
    INDEX `region_event_FI_2` (`event_id`),
    CONSTRAINT `region_event_FK_1`
        FOREIGN KEY (`region_id`)
        REFERENCES `region` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `region_event_FK_2`
        FOREIGN KEY (`event_id`)
        REFERENCES `event` (`id`)
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

DROP TABLE IF EXISTS `region_point_interet`;

DROP TABLE IF EXISTS `region_event`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}