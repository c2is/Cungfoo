<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1359967350.
 * Generated on 2013-02-04 09:42:30 by m.brunot
 */
class PropelMigration_1359967350
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

ALTER TABLE `type_hebergement` DROP FOREIGN KEY `type_hebergement_FK_1`;

ALTER TABLE `type_hebergement` DROP FOREIGN KEY `type_hebergement_FK_2`;

ALTER TABLE `type_hebergement` ADD CONSTRAINT `type_hebergement_FK_1`
    FOREIGN KEY (`category_type_hebergement_id`)
    REFERENCES `category_type_hebergement` (`id`)
    ON DELETE SET NULL;

ALTER TABLE `type_hebergement` ADD CONSTRAINT `type_hebergement_FK_2`
    FOREIGN KEY (`type_hebergement_capacite_id`)
    REFERENCES `type_hebergement_capacite` (`id`)
    ON DELETE SET NULL;

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

ALTER TABLE `type_hebergement` DROP FOREIGN KEY `type_hebergement_FK_1`;

ALTER TABLE `type_hebergement` DROP FOREIGN KEY `type_hebergement_FK_2`;

ALTER TABLE `type_hebergement` ADD CONSTRAINT `type_hebergement_FK_1`
    FOREIGN KEY (`category_type_hebergement_id`)
    REFERENCES `category_type_hebergement` (`id`);

ALTER TABLE `type_hebergement` ADD CONSTRAINT `type_hebergement_FK_2`
    FOREIGN KEY (`type_hebergement_capacite_id`)
    REFERENCES `type_hebergement_capacite` (`id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}