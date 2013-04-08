<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1365157267.
 * Generated on 2013-04-05 12:21:07 by m.brunot
 */
class PropelMigration_1365157267
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

CREATE TABLE `bon_plan_type_hebergement`
(
    `bon_plan_id` INTEGER NOT NULL,
    `type_hebergement_id` INTEGER NOT NULL,
    PRIMARY KEY (`bon_plan_id`,`type_hebergement_id`),
    INDEX `bon_plan_type_hebergement_FI_2` (`type_hebergement_id`),
    CONSTRAINT `bon_plan_type_hebergement_FK_1`
        FOREIGN KEY (`bon_plan_id`)
        REFERENCES `bon_plan` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `bon_plan_type_hebergement_FK_2`
        FOREIGN KEY (`type_hebergement_id`)
        REFERENCES `type_hebergement` (`id`)
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

DROP TABLE IF EXISTS `bon_plan_type_hebergement`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}