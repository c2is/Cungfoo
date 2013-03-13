<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1361289848.
 * Generated on 2013-02-18 11:10:54 by vagrant
 */
class PropelMigration_1361289848
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

/* Create table in target */
CREATE TABLE `portfolio_media`(
    `id` int(11) NOT NULL  auto_increment ,
    `file` varchar(255) COLLATE utf8_general_ci NULL  ,
    `width` varchar(255) COLLATE utf8_general_ci NULL  ,
    `height` varchar(255) COLLATE utf8_general_ci NULL  ,
    `size` varchar(255) COLLATE utf8_general_ci NULL  ,
    `type` varchar(255) COLLATE utf8_general_ci NULL  ,
    `created_at` datetime NULL  ,
    `updated_at` datetime NULL  ,
    `active` tinyint(1) NULL  DEFAULT '1' ,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET='utf8';


/* Create table in target */
CREATE TABLE `portfolio_media_i18n`(
    `id` int(11) NOT NULL  ,
    `locale` varchar(5) COLLATE utf8_general_ci NOT NULL  DEFAULT 'fr' ,
    `title` varchar(255) COLLATE utf8_general_ci NOT NULL  ,
    `description` text COLLATE utf8_general_ci NULL  ,
    `seo_title` varchar(255) COLLATE utf8_general_ci NULL  ,
    `seo_description` text COLLATE utf8_general_ci NULL  ,
    `seo_h1` varchar(255) COLLATE utf8_general_ci NULL  ,
    `seo_keywords` text COLLATE utf8_general_ci NULL  ,
    `active_locale` tinyint(1) NULL  DEFAULT '1' ,
    PRIMARY KEY (`id`,`locale`)
) ENGINE=InnoDB DEFAULT CHARSET='utf8';


/* Create table in target */
CREATE TABLE `portfolio_media_tag`(
    `media_id` int(11) NOT NULL  ,
    `tag_id` int(11) NOT NULL  ,
    PRIMARY KEY (`media_id`,`tag_id`) ,
    KEY `portfolio_media_tag_FI_2`(`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET='utf8';


/* Create table in target */
CREATE TABLE `portfolio_tag`(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `category_id` INTEGER,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    INDEX `portfolio_tag_FI_1` (`category_id`),
    CONSTRAINT `portfolio_tag_FK_1`
        FOREIGN KEY (`category_id`)
        REFERENCES `portfolio_tag_category` (`id`)
        ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET='utf8';


/* Create table in target */
CREATE TABLE `portfolio_tag_category` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `slug` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET='utf8';


/* Create table in target */
CREATE TABLE `portfolio_tag_i18n`(
    `id` int(11) NOT NULL  ,
    `locale` varchar(5) COLLATE utf8_general_ci NOT NULL  DEFAULT 'fr' ,
    `name` varchar(255) COLLATE utf8_general_ci NULL  ,
    `slug` varchar(255) COLLATE utf8_general_ci NULL  ,
    `description` text COLLATE utf8_general_ci NULL  ,
    `seo_title` varchar(255) COLLATE utf8_general_ci NULL  ,
    `seo_description` text COLLATE utf8_general_ci NULL  ,
    `seo_h1` varchar(255) COLLATE utf8_general_ci NULL  ,
    `seo_keywords` text COLLATE utf8_general_ci NULL  ,
    `active_locale` tinyint(1) NULL  DEFAULT '1' ,
    PRIMARY KEY (`id`,`locale`)
) ENGINE=InnoDB DEFAULT CHARSET='utf8';


/* Create table in target */
CREATE TABLE `portfolio_usage`(
    `id` int(11) NOT NULL  auto_increment ,
    `media_id` int(11) NOT NULL  ,
    `table_ref` varchar(255) COLLATE utf8_general_ci NOT NULL  ,
    `column_ref` varchar(255) COLLATE utf8_general_ci NOT NULL  ,
    `element_id` int(11) NOT NULL  ,
    `sortable_rank` int(11) NULL  ,
    `created_at` datetime NULL  ,
    `updated_at` datetime NULL  ,
    `active` tinyint(1) NULL  DEFAULT '1' ,
    PRIMARY KEY (`id`) ,
    KEY `portfolio_usage_FI_1`(`media_id`)
) ENGINE=InnoDB DEFAULT CHARSET='utf8';

ALTER TABLE `portfolio_tag`
    ADD `category_id` INTEGER AFTER `id`;

CREATE INDEX `portfolio_tag_FI_1` ON `portfolio_tag` (`category_id`);

ALTER TABLE `portfolio_tag` ADD CONSTRAINT `portfolio_tag_FK_1`
    FOREIGN KEY (`category_id`)
    REFERENCES `portfolio_tag_category` (`id`)
    ON DELETE SET NULL;

CREATE TABLE `portfolio_tag_category`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `slug` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

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
  'cungfoo' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}
