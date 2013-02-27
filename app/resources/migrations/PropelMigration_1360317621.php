<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1360317621.
 * Generated on 2013-02-08 11:00:21 by vagrant
 */
class PropelMigration_1360317621
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

ALTER TABLE `etablissement`
    ADD `related_1` INTEGER AFTER `vignette`,
    ADD `related_2` INTEGER AFTER `related_1`;

CREATE INDEX `etablissement_FI_3` ON `etablissement` (`related_1`);

CREATE INDEX `etablissement_FI_4` ON `etablissement` (`related_2`);

ALTER TABLE `etablissement` ADD CONSTRAINT `etablissement_FK_3`
    FOREIGN KEY (`related_1`)
    REFERENCES `etablissement` (`id`)
    ON DELETE SET NULL;

ALTER TABLE `etablissement` ADD CONSTRAINT `etablissement_FK_4`
    FOREIGN KEY (`related_2`)
    REFERENCES `etablissement` (`id`)
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

ALTER TABLE `etablissement` DROP FOREIGN KEY `etablissement_FK_3`;

ALTER TABLE `etablissement` DROP FOREIGN KEY `etablissement_FK_4`;

DROP INDEX `etablissement_FI_3` ON `etablissement`;

DROP INDEX `etablissement_FI_4` ON `etablissement`;

ALTER TABLE `etablissement` DROP `related_1`;

ALTER TABLE `etablissement` DROP `related_2`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}