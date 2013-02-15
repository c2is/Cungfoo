<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1360934590.
 * Generated on 2013-02-15 14:23:10 by vagrant
 */
class PropelMigration_1360934590
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

ALTER TABLE `destination_i18n`
    ADD `seo_title` VARCHAR(255) DEFAULT \'\' AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`;

ALTER TABLE `metadata_i18n`
    ADD `seo_title` VARCHAR(255) DEFAULT \'\' AFTER `accroche`,
    ADD `seo_description` TEXT AFTER `seo_title`;

ALTER TABLE `destination_i18n`
    ADD `seo_h1` VARCHAR(255) DEFAULT \'\' AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `metadata_i18n`
    ADD `seo_h1` VARCHAR(255) DEFAULT \'\' AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `destination_i18n` CHANGE `seo_title` `seo_title` VARCHAR(255);

ALTER TABLE `destination_i18n` CHANGE `seo_h1` `seo_h1` VARCHAR(255);

ALTER TABLE `metadata_i18n` CHANGE `seo_title` `seo_title` VARCHAR(255);

ALTER TABLE `metadata_i18n` CHANGE `seo_h1` `seo_h1` VARCHAR(255);

CREATE TABLE `seo`
(
    `id` INTEGER(5) NOT NULL AUTO_INCREMENT,
    `table_ref` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `seo_i18n`
(
    `id` INTEGER(5) NOT NULL,
    `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL,
    `seo_title` VARCHAR(255),
    `seo_description` TEXT,
    `seo_h1` VARCHAR(255),
    `seo_keywords` TEXT,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `seo_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `seo` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

ALTER TABLE `activite_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `avantage_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `baignade_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `bon_plan_categorie_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `bon_plan_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `categorie_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `category_type_hebergement_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `departement_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `edito_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `etablissement_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `event_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `idee_weekend_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `mise_en_avant_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `multimedia_etablissement_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `multimedia_type_hebergement_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `pays_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `personnage_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `point_interet_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `region_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `region_ref_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `service_complementaire_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `situation_geographique_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `tag_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `thematique_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `theme_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `type_hebergement_capacite_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `type_hebergement_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `ville_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

ALTER TABLE `vos_vacances_i18n`
    ADD `seo_title` VARCHAR(255) AFTER `active_locale`,
    ADD `seo_description` TEXT AFTER `seo_title`,
    ADD `seo_h1` VARCHAR(255) AFTER `seo_description`,
    ADD `seo_keywords` TEXT AFTER `seo_h1`;

CREATE TABLE `demande_identifiant_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL,
    `seo_title` VARCHAR(255),
    `seo_description` TEXT,
    `seo_h1` VARCHAR(255),
    `seo_keywords` TEXT,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `demande_identifiant_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `demande_identifiant` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `top_camping_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL,
    `seo_title` VARCHAR(255),
    `seo_description` TEXT,
    `seo_h1` VARCHAR(255),
    `seo_keywords` TEXT,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `top_camping_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `top_camping` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `demande_annulation_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT \'fr\' NOT NULL,
    `seo_title` VARCHAR(255),
    `seo_description` TEXT,
    `seo_h1` VARCHAR(255),
    `seo_keywords` TEXT,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `demande_annulation_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `demande_annulation` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO seo (id, table_ref) VALUES (1, \'pays\');
INSERT INTO seo (id, table_ref) VALUES (2, \'region\');
INSERT INTO seo (id, table_ref) VALUES (3, \'departement\');
INSERT INTO seo (id, table_ref) VALUES (4, \'ville\');
INSERT INTO seo (id, table_ref) VALUES (5, \'destination\');
INSERT INTO seo (id, table_ref) VALUES (6, \'etablissement\');
INSERT INTO seo (id, table_ref) VALUES (7, \'bon_plan\');
INSERT INTO seo (id, table_ref) VALUES (8, \'top_camping\');
INSERT INTO seo (id, table_ref) VALUES (9, \'poi\');
INSERT INTO seo (id, table_ref) VALUES (10, \'event\');
INSERT INTO seo (id, table_ref) VALUES (11, \'bon_plan_categorie\');
INSERT INTO seo (id, table_ref) VALUES (12, \'category_type_hebergement\');
INSERT INTO seo (id, table_ref) VALUES (13, \'type_hebergement_capacite\');
INSERT INTO seo (id, table_ref) VALUES (14, \'type_hebergement\');
INSERT INTO seo (id, table_ref) VALUES (15, \'region_ref\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (1, \'fr\', \'Camping %pays% pas cher\', \'Vacances directes : découvrez nos offres de location de mobil home pas cher en %pays% pour des vacances ensoleillés en camping et réserver en ligne.\', \'Camping en %item% pas cher\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (1, \'de\', \'günstiger Campingplatz %pays%\', \'Vacances Directes: Entdecken Sie unsere günstigen Angebote für die Vermietung von Wohnwagen in %pays% für einen sonnigen Urlaub auf dem Campingplatz und buchen Sie online.\', \'Günstig campen in %item%\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (2, \'fr\', \'Location mobil home %region% pas cher, camping %region%\', \'Réserver en ligne vos futures vacances dans la région %region% en %pays% avec Vacances directes (location de mobil-homes pas cher en camping).\', \'Location mobil home %item%\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (2, \'de\', \'Günstige Vermietung von Wohnwagen %region%, Campingplatz %region%\', \'Buchen Sie Ihren künftigen Urlaub in der Region %region% in %pays% mit Vacances Directes online (günstige Vermietung von Wohnwagen auf dem Campingplatz).\', \'Vermietung Wohnwagen %item%\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (3, \'fr\', \'Location mobil home %departement% pas cher, camping %departement%\', \'Réserver en ligne vos futures vacances dans le département %departement% en %pays% avec Vacances directes (location de mobil-homes pas cher en camping).\', \'Location mobil home %item%\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (3, \'de\', \'Vermietung von günstigen Mobilhomes %departement%, Camping %departement%\', \'Reservieren Sie Ihren nächsten Urlaub online im Departement %departement% in %pays% mit Vacanes directes (Vermietung von günstigen Camping-Mobilhomes).\', \'Vermietungsangebot Mobilhome %item%\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (4, \'fr\', \'Camping %ville% pas cher, location mobil home %ville% pas cher\', \'Découvrez l\'\'ensemble des campings à %ville% (%region%) proposés par Vacances Directes (location de mobil home pas cher) et réserver votre séjour en ligne.\', \'Camping %item% pas cher (location mobil home)\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (4, \'de\', \'Günstiger Campingplatz %ville%, günstige Vermietung von Wohnwagen %ville%\', \'Entdecken Sie alle von Vacances Directes (günstige Vermietung von Wohnwagen) angebotenen Campingplätze in %ville% (%region%) und buchen Sie Ihren Aufenthalt online.\', \'Günstig campen %item% (Vermietung Wohnwagen)\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (5, \'fr\', \'Camping en %destination% pas cher\', \'Vacances directes : découvrez nos offres de location de mobil home pas cher en %pays% pour des vacances ensoleillés en camping et réserver en ligne.\', \'Camping en %item% pas cher\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (5, \'de\', \'Günstiger Campingplatz in %destination%\', \'Vacances Directes: Entdecken Sie alle unsere Angebote für die günstige Vermietung von Wohnwagen in %pays% für einen sonnigen Urlaub auf dem Campingplatz und buchen Sie online.\', \'Günstiger Campingplatz in %item%\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (6, \'fr\', \'Camping %nom%, camping %ville%\', \'Avec Vacances Directes, réserver en ligne votre futur séjour dans le camping %nom% : un camping %nbEtoiles% avec piscine à %ville%.\', \'Camping %ville%\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (6, \'de\', \'Campingplatz %nom%, Campingplatz %ville%\', \'Buchen Sie Ihren künftigen Urlaub auf dem Campingplatz %nom% mit Vacances Directes online: ein %nbEtoiles% Campingplatz mit Swimmingpool in %ville%.\', \'Campingplatz %ville%\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (7, \'fr\', \'Camping %bonPlan%, location mobil-homes %bonPlan%\', \'Découvrez toutes nos offres de camping : "%bonPlan%" et réservez en ligne vos futures vacances sur le site Vacances Directes.\', \'\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (7, \'de\', \'Campingplatz %bonPlan%, Vermietung Wohnwagen %bonPlan%\', \'Entdecken Sie alle unsere Campingangebote: "%bonPlan%" und buchen Sie Ihren künftigen Urlaub auf der Internetseite Vacances Directes online.\', \'\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (8, \'fr\', \'Top camping France, top destination vacances\', \'Découvrez notre top 10 des destinations pour des vacances en campings réussies avec Vacances Directes, le spécialiste de la location de mobil-home.\', \'\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (8, \'de\', \'Top Campingplätze Frankreich, beste Urlaubsziele\', \'Entdecken Sie unsere 10 besten Reiseziele für einen perfekten Campingurlaub mit Vacances Directes, der Spezialist für die Vermietung von Wohnwagen.\', \'\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (9, \'fr\', \'Visiter %poi% : %ville%\', \'%poi% à %ville%, venez visiter ce lieu et passez vos vacances dans nos campings à proximité avec Vacances Directes.\', \'\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (9, \'de\', \'%poi% besichtigen: %ville%\', \'%poi% in %ville%, besichtigen Sie diesen Ort und verbringen Sie Ihren Urlaub mit Vacances Directes auf unseren nahegelegenen Campingplätzen.\', \'\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (10, \'fr\', \'%event% : %ville%\', \'%event% à %ville%. Ne rater pas cet événement et passez vos vacances dans nos campings à proximité avec Vacances Directes.\', \'\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (10, \'de\', \'%event% : %ville%\', \'%event% in %ville%. Verpassen Sie nicht dieses Event und verbringen Sie Ihren Urlaub mit Vacances Directes auf unseren nahegelegenen Campingplätzen.\', \'\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (11, \'fr\', \'Camping %bonPlan%, location mobil-homes %bonPlan%\', \'Découvrez toutes nos offres de camping : "%bonPlan%" et réservez en ligne vos futures vacances sur le site Vacances Directes.\', \'\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (11, \'de\', \'Campingplatz %bonPlan%, Vermietung Wohnwagen %bonPlan%\', \'Entdecken Sie alle unsere Campingangebote: "%bonPlan%" und buchen Sie Ihren künftigen Urlaub auf der Internetseite Vacances Directes online.\', \'\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (12, \'fr\', \'Location %type% camping France, Italie, Espagne\', \'Vous souhaitez louer un(e) %type% pour vos futures vacances ? Découvrez tous nos campings proposant cet hébergement en France, en Espagne et en Italie.\', \'\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (12, \'de\', \'Vermietung %type% Campingplatz Frankreich, Italien, Spanien\', \'Sie möchten für Ihren künftigen Urlaub eine(n) %type% mieten? Entdecken Sie alle unsere Campingplätze, die diese Art Unterkunft in Frankreich, Spanien und Italien anbieten.\', \'\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (13, \'fr\', \'Location camping %type% France, Italie, Espagne\', \'Location de vacances pour %type% dans de nombreux campings de qualité en France, en Espagne et en Italie avec Vacances Directes.\', \'\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (13, \'de\', \'Vermietung Campingplatz %type% Frankreich, Italien, Spanien\', \'Urlaubsvermietung für  %type% auf zahlreichen erstklassigen Campingplätzen in Frankreich, Spanien und Italien mit Vacances Directes.\', \'\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (14, \'fr\', \'Location %type% %personnes% personnes camping : %name%\', \'Passez vos prochaines vacances en %type% %name% dans de nombreux campings de qualité avec Vacances Directes.\', \'\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (14, \'de\', \'Vermietung %type% %personnes% Personen Campingplatz: %name%\', \'Verbringen Sie Ihren nächsten Urlaub mit Vacances Directes im %type% %name% auf zahlreichen erstklassigen Campingplätzen.\', \'\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (15, \'fr\', \'Location mobil home %region% pas cher, camping %region%\', \'Réserver en ligne vos futures vacances dans la région %region% en %pays% avec Vacances directes (location de mobil-homes pas cher en camping).\', \'Location mobil home %item%\', \'\');
INSERT INTO seo_i18n (id, locale, seo_title, seo_description, seo_h1, seo_keywords) VALUES (15, \'de\', \'Location mobil home %region% pas cher, camping %region%\', \'Réserver en ligne vos futures vacances dans la région %region% en %pays% avec Vacances directes (location de mobil-homes pas cher en camping).\', \'Location mobil home %item%\', \'\');

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

DROP TABLE IF EXISTS `demande_identifiant_i18n`;

DROP TABLE IF EXISTS `top_camping_i18n`;

DROP TABLE IF EXISTS `demande_annulation_i18n`;

ALTER TABLE `activite_i18n` DROP `seo_title`;

ALTER TABLE `activite_i18n` DROP `seo_description`;

ALTER TABLE `activite_i18n` DROP `seo_h1`;

ALTER TABLE `activite_i18n` DROP `seo_keywords`;

ALTER TABLE `avantage_i18n` DROP `seo_title`;

ALTER TABLE `avantage_i18n` DROP `seo_description`;

ALTER TABLE `avantage_i18n` DROP `seo_h1`;

ALTER TABLE `avantage_i18n` DROP `seo_keywords`;

ALTER TABLE `baignade_i18n` DROP `seo_title`;

ALTER TABLE `baignade_i18n` DROP `seo_description`;

ALTER TABLE `baignade_i18n` DROP `seo_h1`;

ALTER TABLE `baignade_i18n` DROP `seo_keywords`;

ALTER TABLE `bon_plan_categorie_i18n` DROP `seo_title`;

ALTER TABLE `bon_plan_categorie_i18n` DROP `seo_description`;

ALTER TABLE `bon_plan_categorie_i18n` DROP `seo_h1`;

ALTER TABLE `bon_plan_categorie_i18n` DROP `seo_keywords`;

ALTER TABLE `bon_plan_i18n` DROP `seo_title`;

ALTER TABLE `bon_plan_i18n` DROP `seo_description`;

ALTER TABLE `bon_plan_i18n` DROP `seo_h1`;

ALTER TABLE `bon_plan_i18n` DROP `seo_keywords`;

ALTER TABLE `categorie_i18n` DROP `seo_title`;

ALTER TABLE `categorie_i18n` DROP `seo_description`;

ALTER TABLE `categorie_i18n` DROP `seo_h1`;

ALTER TABLE `categorie_i18n` DROP `seo_keywords`;

ALTER TABLE `category_type_hebergement_i18n` DROP `seo_title`;

ALTER TABLE `category_type_hebergement_i18n` DROP `seo_description`;

ALTER TABLE `category_type_hebergement_i18n` DROP `seo_h1`;

ALTER TABLE `category_type_hebergement_i18n` DROP `seo_keywords`;

ALTER TABLE `departement_i18n` DROP `seo_title`;

ALTER TABLE `departement_i18n` DROP `seo_description`;

ALTER TABLE `departement_i18n` DROP `seo_h1`;

ALTER TABLE `departement_i18n` DROP `seo_keywords`;

ALTER TABLE `edito_i18n` DROP `seo_title`;

ALTER TABLE `edito_i18n` DROP `seo_description`;

ALTER TABLE `edito_i18n` DROP `seo_h1`;

ALTER TABLE `edito_i18n` DROP `seo_keywords`;

ALTER TABLE `etablissement_i18n` DROP `seo_title`;

ALTER TABLE `etablissement_i18n` DROP `seo_description`;

ALTER TABLE `etablissement_i18n` DROP `seo_h1`;

ALTER TABLE `etablissement_i18n` DROP `seo_keywords`;

ALTER TABLE `event_i18n` DROP `seo_title`;

ALTER TABLE `event_i18n` DROP `seo_description`;

ALTER TABLE `event_i18n` DROP `seo_h1`;

ALTER TABLE `event_i18n` DROP `seo_keywords`;

ALTER TABLE `idee_weekend_i18n` DROP `seo_title`;

ALTER TABLE `idee_weekend_i18n` DROP `seo_description`;

ALTER TABLE `idee_weekend_i18n` DROP `seo_h1`;

ALTER TABLE `idee_weekend_i18n` DROP `seo_keywords`;

ALTER TABLE `mise_en_avant_i18n` DROP `seo_title`;

ALTER TABLE `mise_en_avant_i18n` DROP `seo_description`;

ALTER TABLE `mise_en_avant_i18n` DROP `seo_h1`;

ALTER TABLE `mise_en_avant_i18n` DROP `seo_keywords`;

ALTER TABLE `multimedia_etablissement_i18n` DROP `seo_title`;

ALTER TABLE `multimedia_etablissement_i18n` DROP `seo_description`;

ALTER TABLE `multimedia_etablissement_i18n` DROP `seo_h1`;

ALTER TABLE `multimedia_etablissement_i18n` DROP `seo_keywords`;

ALTER TABLE `multimedia_type_hebergement_i18n` DROP `seo_title`;

ALTER TABLE `multimedia_type_hebergement_i18n` DROP `seo_description`;

ALTER TABLE `multimedia_type_hebergement_i18n` DROP `seo_h1`;

ALTER TABLE `multimedia_type_hebergement_i18n` DROP `seo_keywords`;

ALTER TABLE `pays_i18n` DROP `seo_title`;

ALTER TABLE `pays_i18n` DROP `seo_description`;

ALTER TABLE `pays_i18n` DROP `seo_h1`;

ALTER TABLE `pays_i18n` DROP `seo_keywords`;

ALTER TABLE `personnage_i18n` DROP `seo_title`;

ALTER TABLE `personnage_i18n` DROP `seo_description`;

ALTER TABLE `personnage_i18n` DROP `seo_h1`;

ALTER TABLE `personnage_i18n` DROP `seo_keywords`;

ALTER TABLE `point_interet_i18n` DROP `seo_title`;

ALTER TABLE `point_interet_i18n` DROP `seo_description`;

ALTER TABLE `point_interet_i18n` DROP `seo_h1`;

ALTER TABLE `point_interet_i18n` DROP `seo_keywords`;

ALTER TABLE `region_i18n` DROP `seo_title`;

ALTER TABLE `region_i18n` DROP `seo_description`;

ALTER TABLE `region_i18n` DROP `seo_h1`;

ALTER TABLE `region_i18n` DROP `seo_keywords`;

ALTER TABLE `region_ref_i18n` DROP `seo_title`;

ALTER TABLE `region_ref_i18n` DROP `seo_description`;

ALTER TABLE `region_ref_i18n` DROP `seo_h1`;

ALTER TABLE `region_ref_i18n` DROP `seo_keywords`;

ALTER TABLE `service_complementaire_i18n` DROP `seo_title`;

ALTER TABLE `service_complementaire_i18n` DROP `seo_description`;

ALTER TABLE `service_complementaire_i18n` DROP `seo_h1`;

ALTER TABLE `service_complementaire_i18n` DROP `seo_keywords`;

ALTER TABLE `situation_geographique_i18n` DROP `seo_title`;

ALTER TABLE `situation_geographique_i18n` DROP `seo_description`;

ALTER TABLE `situation_geographique_i18n` DROP `seo_h1`;

ALTER TABLE `situation_geographique_i18n` DROP `seo_keywords`;

ALTER TABLE `tag_i18n` DROP `seo_title`;

ALTER TABLE `tag_i18n` DROP `seo_description`;

ALTER TABLE `tag_i18n` DROP `seo_h1`;

ALTER TABLE `tag_i18n` DROP `seo_keywords`;

ALTER TABLE `thematique_i18n` DROP `seo_title`;

ALTER TABLE `thematique_i18n` DROP `seo_description`;

ALTER TABLE `thematique_i18n` DROP `seo_h1`;

ALTER TABLE `thematique_i18n` DROP `seo_keywords`;

ALTER TABLE `theme_i18n` DROP `seo_title`;

ALTER TABLE `theme_i18n` DROP `seo_description`;

ALTER TABLE `theme_i18n` DROP `seo_h1`;

ALTER TABLE `theme_i18n` DROP `seo_keywords`;

ALTER TABLE `type_hebergement_capacite_i18n` DROP `seo_title`;

ALTER TABLE `type_hebergement_capacite_i18n` DROP `seo_description`;

ALTER TABLE `type_hebergement_capacite_i18n` DROP `seo_h1`;

ALTER TABLE `type_hebergement_capacite_i18n` DROP `seo_keywords`;

ALTER TABLE `type_hebergement_i18n` DROP `seo_title`;

ALTER TABLE `type_hebergement_i18n` DROP `seo_description`;

ALTER TABLE `type_hebergement_i18n` DROP `seo_h1`;

ALTER TABLE `type_hebergement_i18n` DROP `seo_keywords`;

ALTER TABLE `ville_i18n` DROP `seo_title`;

ALTER TABLE `ville_i18n` DROP `seo_description`;

ALTER TABLE `ville_i18n` DROP `seo_h1`;

ALTER TABLE `ville_i18n` DROP `seo_keywords`;

ALTER TABLE `vos_vacances_i18n` DROP `seo_title`;

ALTER TABLE `vos_vacances_i18n` DROP `seo_description`;

ALTER TABLE `vos_vacances_i18n` DROP `seo_h1`;

ALTER TABLE `vos_vacances_i18n` DROP `seo_keywords`;

DROP TABLE IF EXISTS `seo`;

DROP TABLE IF EXISTS `seo_i18n`;

ALTER TABLE `destination_i18n` CHANGE `seo_title` `seo_title` VARCHAR(255) DEFAULT \'\';

ALTER TABLE `destination_i18n` CHANGE `seo_h1` `seo_h1` VARCHAR(255) DEFAULT \'\';

ALTER TABLE `metadata_i18n` CHANGE `seo_title` `seo_title` VARCHAR(255) DEFAULT \'\';

ALTER TABLE `metadata_i18n` CHANGE `seo_h1` `seo_h1` VARCHAR(255) DEFAULT \'\';

ALTER TABLE `destination_i18n` DROP `seo_h1`;

ALTER TABLE `destination_i18n` DROP `seo_keywords`;

ALTER TABLE `metadata_i18n` DROP `seo_h1`;

ALTER TABLE `metadata_i18n` DROP `seo_keywords`;

ALTER TABLE `metadata_i18n` DROP `seo_title`;

ALTER TABLE `metadata_i18n` DROP `seo_description`;

ALTER TABLE `destination_i18n` DROP `seo_title`;

ALTER TABLE `destination_i18n` DROP `seo_description`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}