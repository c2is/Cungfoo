<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1355923806.
 * Generated on 2012-12-19 14:28:26 by m.brunot
 */
class PropelMigration_1355923806
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

DROP TABLE IF EXISTS `demande_annulation`;
CREATE TABLE `demande_annulation`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `assure_nom` VARCHAR(255) NOT NULL,
    `assure_prenom` VARCHAR(255) NOT NULL,
    `assure_adresse` TEXT NOT NULL,
    `assure_code_postal` VARCHAR(255) NOT NULL,
    `assure_ville` VARCHAR(255) NOT NULL,
    `assure_pays` VARCHAR(255) NOT NULL,
    `assure_mail` VARCHAR(255) NOT NULL,
    `assure_telephone` VARCHAR(255) NOT NULL,
    `camping_id` INTEGER NOT NULL,
    `camping_num_resa` VARCHAR(255) NOT NULL,
    `camping_montant_sejour` VARCHAR(255) NOT NULL,
    `camping_montant_verse` VARCHAR(255) NOT NULL,
    `sinistre_nature` TINYINT NOT NULL,
    `sinistre_suite` TINYINT NOT NULL,
    `sinistre_date` VARCHAR(255) NOT NULL,
    `sinistre_resume` TEXT NOT NULL,
    `file_1` VARCHAR(255),
    `file_2` VARCHAR(255),
    `file_3` VARCHAR(255),
    `file_4` VARCHAR(255),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    INDEX `demande_annulation_FI_1` (`camping_id`),
    CONSTRAINT `demande_annulation_FK_1`
        FOREIGN KEY (`camping_id`)
        REFERENCES `etablissement` (`id`)
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

DROP TABLE IF EXISTS `demande_annulation`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}
