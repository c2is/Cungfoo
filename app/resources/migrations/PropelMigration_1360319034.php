<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1360319034.
 * Generated on 2013-02-08 11:23:54 by m.brunot
 */
class PropelMigration_1360319034
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

ALTER TABLE `etablissement` DROP FOREIGN KEY `etablissement_FK_2`;

DROP INDEX `etablissement_FI_2` ON `etablissement`;

ALTER TABLE `etablissement`
    ADD `departement_id` INTEGER AFTER `ville_id`;

CREATE INDEX `etablissement_FI_2` ON `etablissement` (`departement_id`);

CREATE INDEX `etablissement_FI_3` ON `etablissement` (`categorie_id`);

ALTER TABLE `etablissement` ADD CONSTRAINT `etablissement_FK_2`
    FOREIGN KEY (`departement_id`)
    REFERENCES `departement` (`id`)
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

ALTER TABLE `etablissement` DROP FOREIGN KEY `etablissement_FK_2`;

DROP INDEX `etablissement_FI_3` ON `etablissement`;

DROP INDEX `etablissement_FI_2` ON `etablissement`;

ALTER TABLE `etablissement` DROP `departement_id`;

CREATE INDEX `etablissement_FI_2` ON `etablissement` (`categorie_id`);

ALTER TABLE `etablissement` ADD CONSTRAINT `etablissement_FK_2`
    FOREIGN KEY (`categorie_id`)
    REFERENCES `categorie` (`id`)
    ON DELETE SET NULL;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}
