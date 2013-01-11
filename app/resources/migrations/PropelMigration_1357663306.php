<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1357663306.
 * Generated on 2013-01-08 17:41:46 by m.brunot
 */
class PropelMigration_1357663306
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

ALTER TABLE `etablissement_activite` DROP FOREIGN KEY `etablissement_activite_FK_2`;

ALTER TABLE `etablissement_activite` ADD CONSTRAINT `etablissement_activite_FK_2`
    FOREIGN KEY (`activite_id`)
    REFERENCES `activite` (`id`)
    ON DELETE CASCADE;

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

ALTER TABLE `etablissement_activite` DROP FOREIGN KEY `etablissement_activite_FK_2`;

ALTER TABLE `etablissement_activite` ADD CONSTRAINT `etablissement_activite_FK_2`
    FOREIGN KEY (`activite_id`)
    REFERENCES `activite` (`id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}
