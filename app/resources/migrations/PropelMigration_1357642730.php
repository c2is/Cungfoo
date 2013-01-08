<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1357642730.
 * Generated on 2013-01-08 11:58:50 by vagrant
 */
class PropelMigration_1357642730
{

    public $dernieresMinutes = array();

    public function preUp($manager)
    {
        $sql = "SELECT * FROM dernieres_minutes";
        $pdo = $manager->getPdoConnection('cungfoo');
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        foreach ($results as $key => $result)
        {
            $result['etablissements'] = array();

            $sql = "SELECT etablissement_id FROM dernieres_minutes_etablissement WHERE dernieres_minutes_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($result['id']));
            
            $etablissements = $stmt->fetchAll();
            foreach ($etablissements as $etablissement)
            {
                $result['etablissements'][] = $etablissement['etablissement_id'];
            }

            $result['destinations'] = array();

            $sql = "SELECT destination_id FROM dernieres_minutes_destination WHERE dernieres_minutes_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($result['id']));
            
            $destinations = $stmt->fetchAll();
            foreach ($destinations as $destination)
            {
                $result['destinations'][] = $destination['destination_id'];
            }

            $results[$key] = $result;
        }

        $this->dernieresMinutes = $results;
    }

    public function postUp($manager)
    {
        $pdo = $manager->getPdoConnection('cungfoo');

        foreach ($this->dernieresMinutes as $derniereMinute)
        {
            // Ajout de la catégorie Dernières Minutes
            $sql = 'INSERT INTO bon_plan_categorie (active, sortable_rank) VALUES (:active, :sortable_rank)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':active' => 1,
                ':sortable_rank' => 1,
            ));

            $categorieDernieresMinutesId = $pdo->lastInsertId();

            // Ajout du bon plan Dernières Minutes
            $sql = 'INSERT INTO bon_plan (date_start, day_start, day_range, nb_adultes, nb_enfants, push_home, active) VALUES (:date_start, :day_start, :day_range, :nb_adultes, :nb_enfants, :push_home, :active)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':date_start' => $derniereMinute['date_start'],
                ':day_start' => $derniereMinute['day_start'],
                ':day_range' => $derniereMinute['day_range'],
                ':nb_adultes' => 1,
                ':nb_enfants' => 0,
                ':push_home' => 1,
                ':active' => $derniereMinute['active'],
            ));

            $dernieresMinutesId = $pdo->lastInsertId();

            // Ajout de la catégorie Dernières Minutes (i18n)
            $sql = 'INSERT INTO bon_plan_categorie_i18n (id, locale, name, slug) VALUES (:id, :locale, :name, :slug)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':id' => $categorieDernieresMinutesId,
                ':locale' => 'fr',
                ':name' => 'Dernières Minutes',
                ':slug' => 'dernieres-minutes',
            ));

            // Ajout du bon plan Dernières Minutes (i18n)
            $sql = 'INSERT INTO bon_plan_i18n (id, locale, name, slug) VALUES (:id, :locale, :name, :slug)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':id' => $dernieresMinutesId,
                ':locale' => 'fr',
                ':name' => 'Early Booking',
                ':slug' => 'early-booking',
            ));

            // Ajout de l'association bon plan => catégorie
            $sql = 'INSERT INTO bon_plan_bon_plan_categorie (bon_plan_id, bon_plan_categorie_id) VALUES (:bon_plan_id, :bon_plan_categorie_id)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':bon_plan_id' => $dernieresMinutesId,
                ':bon_plan_categorie_id' => $categorieDernieresMinutesId,
            ));

            foreach ($derniereMinute['etablissements'] as $etablissement)
            {
                $sql = 'INSERT INTO bon_plan_etablissement (bon_plan_id, etablissement_id) VALUES (:bon_plan_id, :etablissement_id)';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':bon_plan_id' => $dernieresMinutesId,
                    ':etablissement_id' => $etablissement,
                ));
            }

            foreach ($derniereMinute['destinations'] as $destination)
            {
                $sql = 'INSERT INTO bon_plan_destination (bon_plan_id, destination_id) VALUES (:bon_plan_id, :destination_id)';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':bon_plan_id' => $dernieresMinutesId,
                    ':destination_id' => $destination,
                ));
            }
        }
    }

    public function preDown($manager)
    {
        $sql = "SELECT bon_plan.* FROM bon_plan INNER JOIN bon_plan_bon_plan_categorie ON bon_plan_id = id WHERE bon_plan_categorie_id = 1";
        $pdo = $manager->getPdoConnection('cungfoo');
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        foreach ($results as $key => $result)
        {
            $result['etablissements'] = array();

            $sql = "SELECT etablissement_id FROM bon_plan_etablissement WHERE bon_plan_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($result['id']));
            
            $etablissements = $stmt->fetchAll();
            foreach ($etablissements as $etablissement)
            {
                $result['etablissements'][] = $etablissement['etablissement_id'];
            }

            $result['destinations'] = array();

            $sql = "SELECT destination_id FROM bon_plan_destination WHERE bon_plan_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($result['id']));
            
            $destinations = $stmt->fetchAll();
            foreach ($destinations as $destination)
            {
                $result['destinations'][] = $destination['destination_id'];
            }

            $results[$key] = $result;
        }

        $this->dernieresMinutes = $results;
    }

    public function postDown($manager)
    {
        $pdo = $manager->getPdoConnection('cungfoo');

        foreach ($this->dernieresMinutes as $derniereMinute)
        {
            // Ajout des Dernières Minutes
            $sql = 'INSERT INTO dernieres_minutes (date_start, day_start, day_range, active) VALUES (:date_start, :day_start, :day_range, :active)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':date_start' => $derniereMinute['date_start'],
                ':day_start' => $derniereMinute['day_start'],
                ':day_range' => $derniereMinute['day_range'],
                ':active' => $derniereMinute['active'],
            ));

            $dernieresMinutesId = $pdo->lastInsertId();

            foreach ($derniereMinute['etablissements'] as $etablissement)
            {
                $sql = 'INSERT INTO dernieres_minutes_etablissement (dernieres_minutes_id, etablissement_id) VALUES (:dernieres_minutes_id, :etablissement_id)';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':dernieres_minutes_id' => $dernieresMinutesId,
                    ':etablissement_id' => $etablissement,
                ));
            }

            foreach ($derniereMinute['destinations'] as $destination)
            {
                $sql = 'INSERT INTO dernieres_minutes_destination (dernieres_minutes_id, destination_id) VALUES (:dernieres_minutes_id, :destination_id)';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':dernieres_minutes_id' => $dernieresMinutesId,
                    ':destination_id' => $destination,
                ));
            }
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

CREATE TABLE `bon_plan_categorie`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `active` TINYINT(1) DEFAULT 1,
    `sortable_rank` INTEGER,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `bon_plan_bon_plan_categorie`
(
    `bon_plan_id` INTEGER NOT NULL,
    `bon_plan_categorie_id` INTEGER NOT NULL,
    `sortable_rank` INTEGER,
    PRIMARY KEY (`bon_plan_id`,`bon_plan_categorie_id`),
    INDEX `bon_plan_bon_plan_categorie_FI_2` (`bon_plan_categorie_id`),
    CONSTRAINT `bon_plan_bon_plan_categorie_FK_1`
        FOREIGN KEY (`bon_plan_id`)
        REFERENCES `bon_plan` (`id`),
    CONSTRAINT `bon_plan_bon_plan_categorie_FK_2`
        FOREIGN KEY (`bon_plan_categorie_id`)
        REFERENCES `bon_plan_categorie` (`id`)
) ENGINE=InnoDB;

CREATE TABLE `bon_plan`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `date_debut` DATE,
    `date_fin` DATE,
    `prix` INTEGER,
    `prix_barre` INTEGER,
    `image_menu` VARCHAR(255),
    `image_page` VARCHAR(255),
    `image_liste` VARCHAR(255),
    `active_compteur` TINYINT(1),
    `mise_en_avant` TINYINT(1),
    `push_home` TINYINT(1),
    `date_start` DATE,
    `day_start` TINYINT NOT NULL,
    `day_range` TINYINT NOT NULL,
    `nb_adultes` INTEGER,
    `nb_enfants` INTEGER,
    `active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `bon_plan_etablissement`
(
    `bon_plan_id` INTEGER NOT NULL,
    `etablissement_id` INTEGER NOT NULL,
    PRIMARY KEY (`bon_plan_id`,`etablissement_id`),
    INDEX `bon_plan_etablissement_FI_2` (`etablissement_id`),
    CONSTRAINT `bon_plan_etablissement_FK_1`
        FOREIGN KEY (`bon_plan_id`)
        REFERENCES `bon_plan` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `bon_plan_etablissement_FK_2`
        FOREIGN KEY (`etablissement_id`)
        REFERENCES `etablissement` (`id`)
) ENGINE=InnoDB;

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

CREATE TABLE `bon_plan_categorie_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL,
    `name` VARCHAR(255),
    `slug` VARCHAR(255),
    `subtitle` VARCHAR(255),
    `description` TEXT,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `bon_plan_categorie_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `bon_plan_categorie` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `bon_plan_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL,
    `name` VARCHAR(255),
    `slug` VARCHAR(255),
    `introduction` VARCHAR(255),
    `description` TEXT,
    `indice` VARCHAR(255),
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `bon_plan_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `bon_plan` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `dernieres_minutes`;

DROP TABLE IF EXISTS `dernieres_minutes_destination`;

DROP TABLE IF EXISTS `dernieres_minutes_etablissement`;

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

DROP TABLE IF EXISTS `bon_plan_categorie`;

DROP TABLE IF EXISTS `bon_plan_bon_plan_categorie`;

DROP TABLE IF EXISTS `bon_plan`;

DROP TABLE IF EXISTS `bon_plan_etablissement`;

DROP TABLE IF EXISTS `bon_plan_destination`;

DROP TABLE IF EXISTS `bon_plan_categorie_i18n`;

DROP TABLE IF EXISTS `bon_plan_i18n`;

CREATE TABLE `dernieres_minutes`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `date_start` DATE,
    `day_start` TINYINT NOT NULL,
    `day_range` TINYINT NOT NULL,
    `active` TINYINT(1),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `dernieres_minutes_destination`
(
    `dernieres_minutes_id` INTEGER NOT NULL,
    `destination_id` INTEGER NOT NULL,
    PRIMARY KEY (`dernieres_minutes_id`,`destination_id`),
    INDEX `dernieres_minutes_destination_FI_2` (`destination_id`),
    CONSTRAINT `dernieres_minutes_destination_FK_1`
        FOREIGN KEY (`dernieres_minutes_id`)
        REFERENCES `dernieres_minutes` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `dernieres_minutes_destination_FK_2`
        FOREIGN KEY (`destination_id`)
        REFERENCES `destination` (`id`)
) ENGINE=InnoDB;

CREATE TABLE `dernieres_minutes_etablissement`
(
    `dernieres_minutes_id` INTEGER NOT NULL,
    `etablissement_id` INTEGER NOT NULL,
    PRIMARY KEY (`dernieres_minutes_id`,`etablissement_id`),
    INDEX `dernieres_minutes_etablissement_FI_2` (`etablissement_id`),
    CONSTRAINT `dernieres_minutes_etablissement_FK_1`
        FOREIGN KEY (`dernieres_minutes_id`)
        REFERENCES `dernieres_minutes` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `dernieres_minutes_etablissement_FK_2`
        FOREIGN KEY (`etablissement_id`)
        REFERENCES `etablissement` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}