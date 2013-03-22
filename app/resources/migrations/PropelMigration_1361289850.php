<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1361289850.
 * Generated on 2013-02-18 11:10:54 by vagrant
 */
class PropelMigration_1361289850
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
  'cungfoo' => <<<EOF
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

/* Foreign Keys must be dropped in the target to ensure that requires changes can be done*/

ALTER TABLE `avantage` DROP FOREIGN KEY `avantage_FK_1` ;

ALTER TABLE `demande_annulation` DROP FOREIGN KEY `demande_annulation_FK_1` ;

ALTER TABLE `departement` DROP FOREIGN KEY `departement_FK_1` ;

ALTER TABLE `etablissement` DROP FOREIGN KEY `etablissement_FK_1` ;

ALTER TABLE `etablissement` DROP FOREIGN KEY `etablissement_FK_2` ;

ALTER TABLE `etablissement` DROP FOREIGN KEY `etablissement_FK_3` ;

ALTER TABLE `etablissement` DROP FOREIGN KEY `etablissement_FK_4` ;

ALTER TABLE `etablissement` DROP FOREIGN KEY `etablissement_FK_5` ;

ALTER TABLE `multimedia_type_hebergement` DROP FOREIGN KEY `multimedia_type_hebergement_FK_1` ;

ALTER TABLE `personnage` DROP FOREIGN KEY `personnage_FK_1` ;

ALTER TABLE `region` DROP FOREIGN KEY `region_FK_1` ;

ALTER TABLE `region` DROP FOREIGN KEY `region_FK_2` ;

ALTER TABLE `region_ref` DROP FOREIGN KEY `region_ref_FK_1` ;

ALTER TABLE `type_hebergement` DROP FOREIGN KEY `type_hebergement_FK_1` ;

ALTER TABLE `type_hebergement` DROP FOREIGN KEY `type_hebergement_FK_2` ;

ALTER TABLE `ville` DROP FOREIGN KEY `ville_FK_1` ;


/* Alter table in target */
ALTER TABLE `activite`
    CHANGE `created_at` `created_at` datetime   NULL after `code`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`,
    DROP COLUMN `image_path`,
    DROP COLUMN `vignette`;

/* Alter table in target */
ALTER TABLE `avantage`
    CHANGE `created_at` `created_at` datetime   NULL after `personnage_id`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`,
    DROP COLUMN `image_path`;

/* Alter table in target */
ALTER TABLE `baignade`
    CHANGE `created_at` `created_at` datetime   NULL after `code`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`,
    DROP COLUMN `image_path`,
    DROP COLUMN `vignette`;

/* Alter table in target */
ALTER TABLE `bon_plan`
    CHANGE `active_compteur` `active_compteur` tinyint(1)   NULL after `prix_barre`,
    CHANGE `mise_en_avant` `mise_en_avant` tinyint(1)   NULL after `active_compteur`,
    CHANGE `push_home` `push_home` tinyint(1)   NULL after `mise_en_avant`,
    CHANGE `date_start` `date_start` date   NULL after `push_home`,
    CHANGE `day_start` `day_start` tinyint(4)   NOT NULL after `date_start`,
    CHANGE `day_range` `day_range` tinyint(4)   NOT NULL after `day_start`,
    CHANGE `nb_adultes` `nb_adultes` int(11)   NULL DEFAULT '1' after `day_range`,
    CHANGE `nb_enfants` `nb_enfants` int(11)   NULL DEFAULT '0' after `nb_adultes`,
    CHANGE `period_categories` `period_categories` varchar(255)  COLLATE utf8_general_ci NULL after `nb_enfants`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `period_categories`,
    DROP COLUMN `image_menu`,
    DROP COLUMN `image_page`,
    DROP COLUMN `image_liste`;

/* Alter table in target */
ALTER TABLE `category_type_hebergement`
    CHANGE `created_at` `created_at` datetime   NULL after `minimum_price`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `sortable_rank` `sortable_rank` int(11)   NULL after `updated_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `sortable_rank`,
    DROP COLUMN `image_menu`,
    DROP COLUMN `image_page`;

/* Alter table in target */
ALTER TABLE `demande_annulation`
    CHANGE `created_at` `created_at` datetime   NULL after `sinistre_resume`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`,
    DROP COLUMN `file_1`,
    DROP COLUMN `file_2`,
    DROP COLUMN `file_3`,
    DROP COLUMN `file_4`;

/* Alter table in target */
ALTER TABLE `departement`
    CHANGE `created_at` `created_at` datetime   NULL after `region_ref_id`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`,
    DROP COLUMN `image_detail_1`,
    DROP COLUMN `image_detail_2`;

/* Alter table in target */
ALTER TABLE `destination`
    CHANGE `created_at` `created_at` datetime   NULL after `code`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `sortable_rank` `sortable_rank` int(11)   NULL after `updated_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `sortable_rank`,
    DROP COLUMN `image_detail_1`,
    DROP COLUMN `image_detail_2`;

/* Alter table in target */
ALTER TABLE `etablissement`
    CHANGE `related_1` `related_1` int(11)   NULL after `capacite`,
    CHANGE `related_2` `related_2` int(11)   NULL after `related_1`,
    CHANGE `created_at` `created_at` datetime   NULL after `related_2`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`,
    DROP COLUMN `plan_path`,
    DROP COLUMN `vignette`;

/* Alter table in target */
ALTER TABLE `idee_weekend`
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `home`,
    DROP COLUMN `image_path`;

/* Alter table in target */
ALTER TABLE `metadata`
    DROP COLUMN `visuel`;

/* Alter table in target */
ALTER TABLE `mise_en_avant`
    CHANGE `prix` `prix` varchar(255)  COLLATE utf8_general_ci NULL after `id`,
    CHANGE `date_fin_validite` `date_fin_validite` date   NULL after `prix`,
    CHANGE `sortable_rank` `sortable_rank` int(11)   NULL after `date_fin_validite`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `sortable_rank`,
    DROP COLUMN `image_fond_path`,
    DROP COLUMN `illustration_path`;

/* Alter table in target */
ALTER TABLE `multimedia_type_hebergement`
    CHANGE `created_at` `created_at` datetime   NULL after `type_hebergement_id`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`,
    DROP COLUMN `image_path`;

/* Alter table in target */
ALTER TABLE `pays`
    CHANGE `created_at` `created_at` datetime   NULL after `code`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`,
    DROP COLUMN `image_detail_1`,
    DROP COLUMN `image_detail_2`;

/* Alter table in target */
ALTER TABLE `personnage`
    CHANGE `created_at` `created_at` datetime   NULL after `age`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`,
    DROP COLUMN `image_path`;

/* Alter table in target */
ALTER TABLE `region`
    CHANGE `pays_id` `pays_id` int(11)   NULL after `code`,
    CHANGE `destination_id` `destination_id` int(11)   NULL after `pays_id`,
    CHANGE `mea_home` `mea_home` tinyint(1)   NULL after `destination_id`,
    CHANGE `created_at` `created_at` datetime   NULL after `mea_home`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`,
    DROP COLUMN `image_path`,
    DROP COLUMN `image_encart_path`,
    DROP COLUMN `image_encart_petite_path`,
    DROP COLUMN `image_detail_1`,
    DROP COLUMN `image_detail_2`;

/* Alter table in target */
ALTER TABLE `region_ref`
    CHANGE `created_at` `created_at` datetime   NULL after `pays_id`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`,
    DROP COLUMN `image_detail_1`,
    DROP COLUMN `image_detail_2`;

/* Alter table in target */
ALTER TABLE `service_complementaire`
    CHANGE `created_at` `created_at` datetime   NULL after `code`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`,
    DROP COLUMN `image_path`,
    DROP COLUMN `vignette`;

/* Alter table in target */
ALTER TABLE `thematique`
    CHANGE `created_at` `created_at` datetime   NULL after `code`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`,
    DROP COLUMN `image_path`;

/* Alter table in target */
ALTER TABLE `theme`
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `id`,
    DROP COLUMN `image_path`;

/* Alter table in target */
ALTER TABLE `type_hebergement`
    CHANGE `created_at` `created_at` datetime   NULL after `nombre_place`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`,
    DROP COLUMN `image_hebergement_path`,
    DROP COLUMN `image_composition_path`;

/* Alter table in target */
ALTER TABLE `type_hebergement_capacite`
    CHANGE `created_at` `created_at` datetime   NULL after `id`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `sortable_rank` `sortable_rank` int(11)   NULL after `updated_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `sortable_rank`,
    DROP COLUMN `image_menu`,
    DROP COLUMN `image_page`;

/* Alter table in target */
ALTER TABLE `ville`
    CHANGE `created_at` `created_at` datetime   NULL after `region_id`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`,
    DROP COLUMN `image_detail_1`,
    DROP COLUMN `image_detail_2`;

/* Alter table in target */
ALTER TABLE `vos_vacances`
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `age`,
    DROP COLUMN `image_path`;
/* Create ForeignKey(s) in Second database */

ALTER TABLE `portfolio_media_i18n`
ADD CONSTRAINT `portfolio_media_i18n_FK_1`
FOREIGN KEY (`id`) REFERENCES `portfolio_media` (`id`) ON DELETE CASCADE;

/* Create ForeignKey(s) in Second database */

ALTER TABLE `portfolio_media_tag`
ADD CONSTRAINT `portfolio_media_tag_FK_1`
FOREIGN KEY (`media_id`) REFERENCES `portfolio_media` (`id`) ON DELETE CASCADE;

ALTER TABLE `portfolio_media_tag`
ADD CONSTRAINT `portfolio_media_tag_FK_2`
FOREIGN KEY (`tag_id`) REFERENCES `portfolio_tag` (`id`) ON DELETE CASCADE;

/* Create ForeignKey(s) in Second database */

ALTER TABLE `portfolio_tag_i18n`
ADD CONSTRAINT `portfolio_tag_i18n_FK_1`
FOREIGN KEY (`id`) REFERENCES `portfolio_tag` (`id`) ON DELETE CASCADE;

/* Create ForeignKey(s) in Second database */

ALTER TABLE `portfolio_usage`
ADD CONSTRAINT `portfolio_usage_FK_1`
FOREIGN KEY (`media_id`) REFERENCES `portfolio_media` (`id`) ON DELETE CASCADE;


/* The foreign keys that were dropped are now re-created*/

ALTER TABLE `avantage`
ADD CONSTRAINT `avantage_FK_1`
FOREIGN KEY (`personnage_id`) REFERENCES `personnage` (`id`) ON DELETE CASCADE;

ALTER TABLE `demande_annulation`
ADD CONSTRAINT `demande_annulation_FK_1`
FOREIGN KEY (`camping_id`) REFERENCES `etablissement` (`id`);

ALTER TABLE `departement`
ADD CONSTRAINT `departement_FK_1`
FOREIGN KEY (`region_ref_id`) REFERENCES `region_ref` (`id`) ON DELETE SET NULL;

ALTER TABLE `etablissement`
ADD CONSTRAINT `etablissement_FK_1`
FOREIGN KEY (`ville_id`) REFERENCES `ville` (`id`) ON DELETE SET NULL;

ALTER TABLE `etablissement`
ADD CONSTRAINT `etablissement_FK_2`
FOREIGN KEY (`departement_id`) REFERENCES `departement` (`id`) ON DELETE SET NULL;

ALTER TABLE `etablissement`
ADD CONSTRAINT `etablissement_FK_3`
FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE SET NULL;

ALTER TABLE `etablissement`
ADD CONSTRAINT `etablissement_FK_4`
FOREIGN KEY (`related_1`) REFERENCES `etablissement` (`id`) ON DELETE SET NULL;

ALTER TABLE `etablissement`
ADD CONSTRAINT `etablissement_FK_5`
FOREIGN KEY (`related_2`) REFERENCES `etablissement` (`id`) ON DELETE SET NULL;

ALTER TABLE `multimedia_type_hebergement`
ADD CONSTRAINT `multimedia_type_hebergement_FK_1`
FOREIGN KEY (`type_hebergement_id`) REFERENCES `type_hebergement` (`id`) ON DELETE CASCADE;

ALTER TABLE `personnage`
ADD CONSTRAINT `personnage_FK_1`
FOREIGN KEY (`etablissement_id`) REFERENCES `etablissement` (`id`) ON DELETE CASCADE;

ALTER TABLE `region`
ADD CONSTRAINT `region_FK_1`
FOREIGN KEY (`pays_id`) REFERENCES `pays` (`id`) ON DELETE SET NULL;

ALTER TABLE `region`
ADD CONSTRAINT `region_FK_2`
FOREIGN KEY (`destination_id`) REFERENCES `destination` (`id`);

ALTER TABLE `region_ref`
ADD CONSTRAINT `region_ref_FK_1`
FOREIGN KEY (`pays_id`) REFERENCES `pays` (`id`) ON DELETE SET NULL;

ALTER TABLE `type_hebergement`
ADD CONSTRAINT `type_hebergement_FK_1`
FOREIGN KEY (`category_type_hebergement_id`) REFERENCES `category_type_hebergement` (`id`) ON DELETE SET NULL;

ALTER TABLE `type_hebergement`
ADD CONSTRAINT `type_hebergement_FK_2`
FOREIGN KEY (`type_hebergement_capacite_id`) REFERENCES `type_hebergement_capacite` (`id`) ON DELETE SET NULL;

ALTER TABLE `ville`
ADD CONSTRAINT `ville_FK_1`
FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE SET NULL;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
EOF
,
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
  'cungfoo' => <<<EOF
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

/* Foreign Keys must be dropped in the target to ensure that requires changes can be done*/

ALTER TABLE `avantage` DROP FOREIGN KEY `avantage_FK_1` ;

ALTER TABLE `demande_annulation` DROP FOREIGN KEY `demande_annulation_FK_1` ;

ALTER TABLE `departement` DROP FOREIGN KEY `departement_FK_1` ;

ALTER TABLE `etablissement` DROP FOREIGN KEY `etablissement_FK_1` ;

ALTER TABLE `etablissement` DROP FOREIGN KEY `etablissement_FK_2` ;

ALTER TABLE `etablissement` DROP FOREIGN KEY `etablissement_FK_3` ;

ALTER TABLE `etablissement` DROP FOREIGN KEY `etablissement_FK_4` ;

ALTER TABLE `etablissement` DROP FOREIGN KEY `etablissement_FK_5` ;

ALTER TABLE `multimedia_type_hebergement` DROP FOREIGN KEY `multimedia_type_hebergement_FK_1` ;

ALTER TABLE `personnage` DROP FOREIGN KEY `personnage_FK_1` ;

ALTER TABLE `region` DROP FOREIGN KEY `region_FK_1` ;

ALTER TABLE `region` DROP FOREIGN KEY `region_FK_2` ;

ALTER TABLE `region_ref` DROP FOREIGN KEY `region_ref_FK_1` ;

ALTER TABLE `type_hebergement` DROP FOREIGN KEY `type_hebergement_FK_1` ;

ALTER TABLE `type_hebergement` DROP FOREIGN KEY `type_hebergement_FK_2` ;

ALTER TABLE `ville` DROP FOREIGN KEY `ville_FK_1` ;


/* Alter table in target */
ALTER TABLE `activite`
    ADD COLUMN `image_path` varchar(255)  COLLATE utf8_general_ci NULL after `code`,
    ADD COLUMN `vignette` varchar(255)  COLLATE utf8_general_ci NULL after `image_path`,
    CHANGE `created_at` `created_at` datetime   NULL after `vignette`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`;

/* Alter table in target */
ALTER TABLE `avantage`
    ADD COLUMN `image_path` varchar(255)  COLLATE utf8_general_ci NULL after `personnage_id`,
    CHANGE `created_at` `created_at` datetime   NULL after `image_path`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`;

/* Alter table in target */
ALTER TABLE `baignade`
    ADD COLUMN `image_path` varchar(255)  COLLATE utf8_general_ci NULL after `code`,
    ADD COLUMN `vignette` varchar(255)  COLLATE utf8_general_ci NULL after `image_path`,
    CHANGE `created_at` `created_at` datetime   NULL after `vignette`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`;

/* Alter table in target */
ALTER TABLE `bon_plan`
    ADD COLUMN `image_menu` varchar(255)  COLLATE utf8_general_ci NULL after `prix_barre`,
    ADD COLUMN `image_page` varchar(255)  COLLATE utf8_general_ci NULL after `image_menu`,
    ADD COLUMN `image_liste` varchar(255)  COLLATE utf8_general_ci NULL after `image_page`,
    CHANGE `active_compteur` `active_compteur` tinyint(1)   NULL after `image_liste`,
    CHANGE `mise_en_avant` `mise_en_avant` tinyint(1)   NULL after `active_compteur`,
    CHANGE `push_home` `push_home` tinyint(1)   NULL after `mise_en_avant`,
    CHANGE `date_start` `date_start` date   NULL after `push_home`,
    CHANGE `day_start` `day_start` tinyint(4)   NOT NULL after `date_start`,
    CHANGE `day_range` `day_range` tinyint(4)   NOT NULL after `day_start`,
    CHANGE `nb_adultes` `nb_adultes` int(11)   NULL DEFAULT '1' after `day_range`,
    CHANGE `nb_enfants` `nb_enfants` int(11)   NULL DEFAULT '0' after `nb_adultes`,
    CHANGE `period_categories` `period_categories` varchar(255)  COLLATE utf8_general_ci NULL after `nb_enfants`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `period_categories`;

/* Alter table in target */
ALTER TABLE `category_type_hebergement`
    ADD COLUMN `image_menu` varchar(255)  COLLATE utf8_general_ci NULL after `minimum_price`,
    ADD COLUMN `image_page` varchar(255)  COLLATE utf8_general_ci NULL after `image_menu`,
    CHANGE `created_at` `created_at` datetime   NULL after `image_page`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `sortable_rank` `sortable_rank` int(11)   NULL after `updated_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `sortable_rank`;

/* Alter table in target */
ALTER TABLE `demande_annulation`
    ADD COLUMN `file_1` varchar(255)  COLLATE utf8_general_ci NULL after `sinistre_resume`,
    ADD COLUMN `file_2` varchar(255)  COLLATE utf8_general_ci NULL after `file_1`,
    ADD COLUMN `file_3` varchar(255)  COLLATE utf8_general_ci NULL after `file_2`,
    ADD COLUMN `file_4` varchar(255)  COLLATE utf8_general_ci NULL after `file_3`,
    CHANGE `created_at` `created_at` datetime   NULL after `file_4`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`;

/* Alter table in target */
ALTER TABLE `departement`
    ADD COLUMN `image_detail_1` varchar(255)  COLLATE utf8_general_ci NULL after `region_ref_id`,
    ADD COLUMN `image_detail_2` varchar(255)  COLLATE utf8_general_ci NULL after `image_detail_1`,
    CHANGE `created_at` `created_at` datetime   NULL after `image_detail_2`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`;

/* Alter table in target */
ALTER TABLE `destination`
    ADD COLUMN `image_detail_1` varchar(255)  COLLATE utf8_general_ci NULL after `code`,
    ADD COLUMN `image_detail_2` varchar(255)  COLLATE utf8_general_ci NULL after `image_detail_1`,
    CHANGE `created_at` `created_at` datetime   NULL after `image_detail_2`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `sortable_rank` `sortable_rank` int(11)   NULL after `updated_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `sortable_rank`;

/* Alter table in target */
ALTER TABLE `etablissement`
    ADD COLUMN `plan_path` varchar(255)  COLLATE utf8_general_ci NULL after `capacite`,
    ADD COLUMN `vignette` varchar(255)  COLLATE utf8_general_ci NULL after `plan_path`,
    CHANGE `related_1` `related_1` int(11)   NULL after `vignette`,
    CHANGE `related_2` `related_2` int(11)   NULL after `related_1`,
    CHANGE `created_at` `created_at` datetime   NULL after `related_2`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`;

/* Alter table in target */
ALTER TABLE `idee_weekend`
    ADD COLUMN `image_path` varchar(255)  COLLATE utf8_general_ci NULL after `home`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `image_path`;

/* Alter table in target */
ALTER TABLE `metadata`
    ADD COLUMN `visuel` varchar(255)  COLLATE utf8_general_ci NULL after `table_ref`;

/* Alter table in target */
ALTER TABLE `mise_en_avant`
    ADD COLUMN `image_fond_path` varchar(255)  COLLATE utf8_general_ci NULL after `id`,
    CHANGE `prix` `prix` varchar(255)  COLLATE utf8_general_ci NULL after `image_fond_path`,
    ADD COLUMN `illustration_path` varchar(255)  COLLATE utf8_general_ci NULL after `prix`,
    CHANGE `date_fin_validite` `date_fin_validite` date   NULL after `illustration_path`,
    CHANGE `sortable_rank` `sortable_rank` int(11)   NULL after `date_fin_validite`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `sortable_rank`;

/* Create table in target */
CREATE TABLE `multimedia_etablissement`(
    `id` int(11) NOT NULL  auto_increment ,
    `etablissement_id` int(11) NULL  ,
    `image_path` varchar(255) COLLATE utf8_general_ci NULL  ,
    `created_at` datetime NULL  ,
    `updated_at` datetime NULL  ,
    `active` tinyint(1) NULL  DEFAULT '1' ,
    PRIMARY KEY (`id`) ,
    KEY `multimedia_etablissement_FI_1`(`etablissement_id`)
) ENGINE=InnoDB DEFAULT CHARSET='utf8';


/* Create table in target */
CREATE TABLE `multimedia_etablissement_i18n`(
    `id` int(11) NOT NULL  ,
    `locale` varchar(5) COLLATE utf8_general_ci NOT NULL  DEFAULT 'fr' ,
    `titre` varchar(255) COLLATE utf8_general_ci NOT NULL  ,
    `seo_title` varchar(255) COLLATE utf8_general_ci NULL  ,
    `seo_description` text COLLATE utf8_general_ci NULL  ,
    `seo_h1` varchar(255) COLLATE utf8_general_ci NULL  ,
    `seo_keywords` text COLLATE utf8_general_ci NULL  ,
    `active_locale` tinyint(1) NULL  DEFAULT '1' ,
    PRIMARY KEY (`id`,`locale`)
) ENGINE=InnoDB DEFAULT CHARSET='utf8';


/* Create table in target */
CREATE TABLE `multimedia_etablissement_tag`(
    `multimedia_etablissement_id` int(11) NOT NULL  ,
    `tag_id` int(11) NOT NULL  ,
    PRIMARY KEY (`multimedia_etablissement_id`,`tag_id`) ,
    KEY `multimedia_etablissement_tag_FI_2`(`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET='utf8';


/* Alter table in target */
ALTER TABLE `multimedia_type_hebergement`
    ADD COLUMN `image_path` varchar(255)  COLLATE utf8_general_ci NULL after `type_hebergement_id`,
    CHANGE `created_at` `created_at` datetime   NULL after `image_path`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`;

/* Alter table in target */
ALTER TABLE `pays`
    ADD COLUMN `image_detail_1` varchar(255)  COLLATE utf8_general_ci NULL after `code`,
    ADD COLUMN `image_detail_2` varchar(255)  COLLATE utf8_general_ci NULL after `image_detail_1`,
    CHANGE `created_at` `created_at` datetime   NULL after `image_detail_2`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`;

/* Alter table in target */
ALTER TABLE `personnage`
    ADD COLUMN `image_path` varchar(255)  COLLATE utf8_general_ci NULL after `age`,
    CHANGE `created_at` `created_at` datetime   NULL after `image_path`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`;

/* Alter table in target */
ALTER TABLE `region`
    ADD COLUMN `image_path` varchar(255)  COLLATE utf8_general_ci NULL after `code`,
    ADD COLUMN `image_encart_path` varchar(255)  COLLATE utf8_general_ci NULL after `image_path`,
    ADD COLUMN `image_encart_petite_path` varchar(255)  COLLATE utf8_general_ci NULL after `image_encart_path`,
    CHANGE `pays_id` `pays_id` int(11)   NULL after `image_encart_petite_path`,
    CHANGE `destination_id` `destination_id` int(11)   NULL after `pays_id`,
    CHANGE `mea_home` `mea_home` tinyint(1)   NULL after `destination_id`,
    ADD COLUMN `image_detail_1` varchar(255)  COLLATE utf8_general_ci NULL after `mea_home`,
    ADD COLUMN `image_detail_2` varchar(255)  COLLATE utf8_general_ci NULL after `image_detail_1`,
    CHANGE `created_at` `created_at` datetime   NULL after `image_detail_2`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`;

/* Alter table in target */
ALTER TABLE `region_ref`
    ADD COLUMN `image_detail_1` varchar(255)  COLLATE utf8_general_ci NULL after `pays_id`,
    ADD COLUMN `image_detail_2` varchar(255)  COLLATE utf8_general_ci NULL after `image_detail_1`,
    CHANGE `created_at` `created_at` datetime   NULL after `image_detail_2`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`;

/* Alter table in target */
ALTER TABLE `service_complementaire`
    ADD COLUMN `image_path` varchar(255)  COLLATE utf8_general_ci NULL after `code`,
    ADD COLUMN `vignette` varchar(255)  COLLATE utf8_general_ci NULL after `image_path`,
    CHANGE `created_at` `created_at` datetime   NULL after `vignette`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`;

/* Alter table in target */
ALTER TABLE `thematique`
    ADD COLUMN `image_path` varchar(255)  COLLATE utf8_general_ci NULL after `code`,
    CHANGE `created_at` `created_at` datetime   NULL after `image_path`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`;

/* Alter table in target */
ALTER TABLE `theme`
    ADD COLUMN `image_path` varchar(255)  COLLATE utf8_general_ci NULL after `id`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `image_path`;

/* Alter table in target */
ALTER TABLE `type_hebergement`
    ADD COLUMN `image_hebergement_path` varchar(255)  COLLATE utf8_general_ci NULL after `nombre_place`,
    ADD COLUMN `image_composition_path` varchar(255)  COLLATE utf8_general_ci NULL after `image_hebergement_path`,
    CHANGE `created_at` `created_at` datetime   NULL after `image_composition_path`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`;

/* Alter table in target */
ALTER TABLE `type_hebergement_capacite`
    ADD COLUMN `image_menu` varchar(255)  COLLATE utf8_general_ci NULL after `id`,
    ADD COLUMN `image_page` varchar(255)  COLLATE utf8_general_ci NULL after `image_menu`,
    CHANGE `created_at` `created_at` datetime   NULL after `image_page`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `sortable_rank` `sortable_rank` int(11)   NULL after `updated_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `sortable_rank`;

/* Alter table in target */
ALTER TABLE `ville`
    ADD COLUMN `image_detail_1` varchar(255)  COLLATE utf8_general_ci NULL after `region_id`,
    ADD COLUMN `image_detail_2` varchar(255)  COLLATE utf8_general_ci NULL after `image_detail_1`,
    CHANGE `created_at` `created_at` datetime   NULL after `image_detail_2`,
    CHANGE `updated_at` `updated_at` datetime   NULL after `created_at`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `updated_at`;

/* Alter table in target */
ALTER TABLE `vos_vacances`
    ADD COLUMN `image_path` varchar(255)  COLLATE utf8_general_ci NULL after `age`,
    CHANGE `active` `active` tinyint(1)   NULL DEFAULT '1' after `image_path`;
/* Create ForeignKey(s) in Second database */

ALTER TABLE `multimedia_etablissement`
ADD CONSTRAINT `multimedia_etablissement_FK_1`
FOREIGN KEY (`etablissement_id`) REFERENCES `etablissement` (`id`) ON DELETE CASCADE;

/* Create ForeignKey(s) in Second database */

ALTER TABLE `multimedia_etablissement_i18n`
ADD CONSTRAINT `multimedia_etablissement_i18n_FK_1`
FOREIGN KEY (`id`) REFERENCES `multimedia_etablissement` (`id`) ON DELETE CASCADE;

/* Create ForeignKey(s) in Second database */

ALTER TABLE `multimedia_etablissement_tag`
ADD CONSTRAINT `multimedia_etablissement_tag_FK_1`
FOREIGN KEY (`multimedia_etablissement_id`) REFERENCES `multimedia_etablissement` (`id`) ON DELETE CASCADE;

ALTER TABLE `multimedia_etablissement_tag`
ADD CONSTRAINT `multimedia_etablissement_tag_FK_2`
FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE;


/* The foreign keys that were dropped are now re-created*/

ALTER TABLE `avantage`
ADD CONSTRAINT `avantage_FK_1`
FOREIGN KEY (`personnage_id`) REFERENCES `personnage` (`id`) ON DELETE CASCADE;

ALTER TABLE `demande_annulation`
ADD CONSTRAINT `demande_annulation_FK_1`
FOREIGN KEY (`camping_id`) REFERENCES `etablissement` (`id`);

ALTER TABLE `departement`
ADD CONSTRAINT `departement_FK_1`
FOREIGN KEY (`region_ref_id`) REFERENCES `region_ref` (`id`) ON DELETE SET NULL;

ALTER TABLE `etablissement`
ADD CONSTRAINT `etablissement_FK_1`
FOREIGN KEY (`ville_id`) REFERENCES `ville` (`id`) ON DELETE SET NULL;

ALTER TABLE `etablissement`
ADD CONSTRAINT `etablissement_FK_2`
FOREIGN KEY (`departement_id`) REFERENCES `departement` (`id`) ON DELETE SET NULL;

ALTER TABLE `etablissement`
ADD CONSTRAINT `etablissement_FK_3`
FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE SET NULL;

ALTER TABLE `etablissement`
ADD CONSTRAINT `etablissement_FK_4`
FOREIGN KEY (`related_1`) REFERENCES `etablissement` (`id`) ON DELETE SET NULL;

ALTER TABLE `etablissement`
ADD CONSTRAINT `etablissement_FK_5`
FOREIGN KEY (`related_2`) REFERENCES `etablissement` (`id`) ON DELETE SET NULL;

ALTER TABLE `multimedia_type_hebergement`
ADD CONSTRAINT `multimedia_type_hebergement_FK_1`
FOREIGN KEY (`type_hebergement_id`) REFERENCES `type_hebergement` (`id`) ON DELETE CASCADE;

ALTER TABLE `personnage`
ADD CONSTRAINT `personnage_FK_1`
FOREIGN KEY (`etablissement_id`) REFERENCES `etablissement` (`id`) ON DELETE CASCADE;

ALTER TABLE `region`
ADD CONSTRAINT `region_FK_1`
FOREIGN KEY (`pays_id`) REFERENCES `pays` (`id`) ON DELETE SET NULL;

ALTER TABLE `region`
ADD CONSTRAINT `region_FK_2`
FOREIGN KEY (`destination_id`) REFERENCES `destination` (`id`);

ALTER TABLE `region_ref`
ADD CONSTRAINT `region_ref_FK_1`
FOREIGN KEY (`pays_id`) REFERENCES `pays` (`id`) ON DELETE SET NULL;

ALTER TABLE `type_hebergement`
ADD CONSTRAINT `type_hebergement_FK_1`
FOREIGN KEY (`category_type_hebergement_id`) REFERENCES `category_type_hebergement` (`id`) ON DELETE SET NULL;

ALTER TABLE `type_hebergement`
ADD CONSTRAINT `type_hebergement_FK_2`
FOREIGN KEY (`type_hebergement_capacite_id`) REFERENCES `type_hebergement_capacite` (`id`) ON DELETE SET NULL;

ALTER TABLE `ville`
ADD CONSTRAINT `ville_FK_1`
FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE SET NULL;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
EOF
,
);
    }

}
