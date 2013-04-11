<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1365067882.
 * Generated on 2013-04-04 11:31:22 by m.brunot
 */
class PropelMigration_1365067882
{
    private $capaciteByTypeHebergement = array();

    public function preUp($manager)
    {
        try
        {
            $pdo  = $manager->getPdoConnection('cungfoo');
            $sql  = "SELECT * FROM type_hebergement";
            $stmt = $pdo->prepare($sql);

            $stmt->execute();
            $results = $stmt->fetchAll();

            foreach ($results as $key => $result) {
                $this->capaciteByTypeHebergement[$result['id']] = $result['type_hebergement_capacite_id'];
            }
        }
        catch (\Exception $e)
        {
            $this->capaciteByTypeHebergement = array();
        }
    }

    public function postUp($manager)
    {
        try
        {
            $pdo = $manager->getPdoConnection('cungfoo');

            foreach ($this->capaciteByTypeHebergement as $typeHebergement => $capacite) {
                $sql = 'INSERT INTO type_hebergement_type_hebergement_capacite (type_hebergement_id, type_hebergement_capacite_id) VALUES (:type_hebergement_id, :type_hebergement_capacite_id)';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':type_hebergement_id' => $typeHebergement,
                    ':type_hebergement_capacite_id' => $capacite,
                ));
            }
        }
        catch (\Exception $e)
        {
            $this->capaciteByTypeHebergement = array();
        }
    }

    public function preDown($manager)
    {
        try
        {
            $pdo  = $manager->getPdoConnection('cungfoo');
            $sql  = "SELECT * FROM type_hebergement_type_hebergement_capacite";
            $stmt = $pdo->prepare($sql);

            $stmt->execute();
            $results = $stmt->fetchAll();

            foreach ($results as $key => $result) {
                $this->capaciteByTypeHebergement[$result['type_hebergement_id']] = $result['type_hebergement_capacite_id'];
            }
        }
        catch (\Exception $e)
        {
            $this->capaciteByTypeHebergement = array();
        }
    }

    public function postDown($manager)
    {
        try
        {
            $pdo = $manager->getPdoConnection('cungfoo');

            foreach ($this->capaciteByTypeHebergement as $typeHebergement => $capacite) {
                $sql = 'UPDATE type_hebergement SET type_hebergement_capacite_id = :type_hebergement_capacite_id WHERE type_hebergement_id = :type_hebergement_id';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':type_hebergement_id' => $typeHebergement,
                    ':type_hebergement_capacite_id' => $capacite,
                ));
            }
        }
        catch (\Exception $e)
        {
            $this->capaciteByTypeHebergement = array();
        }
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

DROP TABLE IF EXISTS `multimedia_type_hebergement`;

DROP TABLE IF EXISTS `multimedia_type_hebergement_i18n`;

ALTER TABLE `baignade` DROP `image_path`;

ALTER TABLE `etablissement_type_hebergement` ADD CONSTRAINT `etablissement_type_hebergement_FK_1`
    FOREIGN KEY (`etablissement_id`)
    REFERENCES `etablissement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `etablissement_type_hebergement` ADD CONSTRAINT `etablissement_type_hebergement_FK_2`
    FOREIGN KEY (`type_hebergement_id`)
    REFERENCES `type_hebergement` (`id`)
    ON DELETE CASCADE;

ALTER TABLE `type_hebergement` DROP FOREIGN KEY `type_hebergement_FK_2`;

DROP INDEX `type_hebergement_FI_2` ON `type_hebergement`;

ALTER TABLE `type_hebergement` DROP `type_hebergement_capacite_id`;

CREATE TABLE `type_hebergement_type_hebergement_capacite`
(
    `type_hebergement_id` INTEGER NOT NULL,
    `type_hebergement_capacite_id` INTEGER NOT NULL,
    PRIMARY KEY (`type_hebergement_id`,`type_hebergement_capacite_id`),
    INDEX `type_hebergement_type_hebergement_capacite_FI_2` (`type_hebergement_capacite_id`),
    CONSTRAINT `type_hebergement_type_hebergement_capacite_FK_1`
        FOREIGN KEY (`type_hebergement_id`)
        REFERENCES `type_hebergement` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `type_hebergement_type_hebergement_capacite_FK_2`
        FOREIGN KEY (`type_hebergement_capacite_id`)
        REFERENCES `type_hebergement_capacite` (`id`)
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

DROP TABLE IF EXISTS `type_hebergement_type_hebergement_capacite`;

ALTER TABLE `baignade`
    ADD `image_path` VARCHAR(255) AFTER `code`;

ALTER TABLE `etablissement_type_hebergement` DROP FOREIGN KEY `etablissement_type_hebergement_FK_1`;

ALTER TABLE `etablissement_type_hebergement` DROP FOREIGN KEY `etablissement_type_hebergement_FK_2`;

ALTER TABLE `type_hebergement`
    ADD `type_hebergement_capacite_id` INTEGER AFTER `code`;

CREATE INDEX `type_hebergement_FI_2` ON `type_hebergement` (`type_hebergement_capacite_id`);

ALTER TABLE `type_hebergement` ADD CONSTRAINT `type_hebergement_FK_2`
    FOREIGN KEY (`type_hebergement_capacite_id`)
    REFERENCES `type_hebergement_capacite` (`id`)
    ON DELETE SET NULL;

CREATE TABLE `multimedia_type_hebergement`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `type_hebergement_id` INTEGER,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    INDEX `multimedia_type_hebergement_FI_1` (`type_hebergement_id`),
    CONSTRAINT `multimedia_type_hebergement_FK_1`
        FOREIGN KEY (`type_hebergement_id`)
        REFERENCES `type_hebergement` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `multimedia_type_hebergement_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL,
    `titre` VARCHAR(255) NOT NULL,
    `active_locale` TINYINT(1) DEFAULT 1,
    `seo_title` VARCHAR(255),
    `seo_description` TEXT,
    `seo_h1` VARCHAR(255),
    `seo_keywords` TEXT,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `multimedia_type_hebergement_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `multimedia_type_hebergement` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}
