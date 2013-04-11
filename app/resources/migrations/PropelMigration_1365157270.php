<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1365157270.
 * Generated on 2013-04-05 12:21:07 by m.brunot
 */
class PropelMigration_1365157270
{

    public function preUp($manager)
    {
        // add the pre-migration code here
    }

    public function postUp($manager)
    {
        try
        {
            $pdo = $manager->getPdoConnection('cungfoo');

            $sql  = 'INSERT INTO navigation (name,active) VALUES ("footer_home", 1)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $sql  = 'SELECT id FROM navigation WHERE name = "footer_home"';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $navigation = $stmt->fetch();

            $sql  = 'INSERT INTO navigation_item (navigation_id, created_at) VALUES (:navigation_id, :created_at)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
              ':navigation_id' => $navigation['id'],
              ':created_at'    => date(),
            ));

            $sql  = 'SELECT id FROM navigation_item ORDER BY created_at DESC';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $item = $stmt->fetch();

            $sql  = 'INSERT INTO navigation_item_i18n (id, locale, title, path) VALUES (:id, "de", "Unsere Regionen", "/reiseziele/campingplatz-region/")';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(':id' => $item['id']));

            $sql  = 'INSERT INTO navigation_item_i18n (id, locale, title, path) VALUES (:id, "fr", "Nos régions", "/destinations/camping-region/")';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(':id' => $item['id']));

            $sql  = 'INSERT INTO navigation_item (navigation_id, created_at) VALUES (:navigation_id, :created_at)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
              ':navigation_id' => $navigation['id'],
              ':created_at'    => date(),
            ));

            $sql  = 'SELECT id FROM navigation_item ORDER BY created_at DESC';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $item = $stmt->fetch();

            $sql  = 'INSERT INTO navigation_item_i18n (id, locale, title, path) VALUES (:id, "de", "Unsere Départements", "/reiseziele/campingplatz-departement/")';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(':id' => $item['id']));

            $sql  = 'INSERT INTO navigation_item_i18n (id, locale, title, path) VALUES (:id, "fr", "Nos départements", "/destinations/camping-departement/")';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(':id' => $item['id']));
        }
        catch (\Exception $e)
        {
            $this->capaciteByTypeHebergement = array();
        }
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
  'cungfoo' => "
# This is a fix for InnoDB in MySQL >= 4.1.x
# It 'suspends judgement' for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

USE `vacancesdirectes`;

/* Create table in target */
CREATE TABLE `navigation`(
  `id` int(11) NOT NULL  auto_increment ,
  `name` varchar(255) COLLATE utf8_general_ci NOT NULL  ,
  `active` tinyint(1) NULL  DEFAULT '1' ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET='utf8';


/* Create table in target */
CREATE TABLE `navigation_i18n`(
  `id` int(11) NOT NULL  ,
  `locale` varchar(5) COLLATE utf8_general_ci NOT NULL  DEFAULT 'fr' ,
  `seo_title` varchar(255) COLLATE utf8_general_ci NULL  ,
  `seo_description` text COLLATE utf8_general_ci NULL  ,
  `seo_h1` varchar(255) COLLATE utf8_general_ci NULL  ,
  `seo_keywords` text COLLATE utf8_general_ci NULL  ,
  `active_locale` tinyint(1) NULL  DEFAULT '1' ,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=InnoDB DEFAULT CHARSET='utf8';


/* Create table in target */
CREATE TABLE `navigation_item`(
  `id` int(11) NOT NULL  auto_increment ,
  `parent_id` int(11) NULL  ,
  `navigation_id` int(11) NOT NULL  ,
  `sortable_rank` int(11) NULL  ,
  `created_at` datetime NULL  ,
  `updated_at` datetime NULL  ,
  `active` tinyint(1) NULL  DEFAULT '1' ,
  PRIMARY KEY (`id`) ,
  KEY `navigation_item_FI_1`(`parent_id`) ,
  KEY `navigation_item_FI_2`(`navigation_id`)
) ENGINE=InnoDB DEFAULT CHARSET='utf8';


/* Create table in target */
CREATE TABLE `navigation_item_i18n`(
  `id` int(11) NOT NULL  ,
  `locale` varchar(5) COLLATE utf8_general_ci NOT NULL  DEFAULT 'fr' ,
  `title` varchar(255) COLLATE utf8_general_ci NOT NULL  ,
  `path` varchar(255) COLLATE utf8_general_ci NOT NULL  ,
  `seo_title` varchar(255) COLLATE utf8_general_ci NULL  ,
  `seo_description` text COLLATE utf8_general_ci NULL  ,
  `seo_h1` varchar(255) COLLATE utf8_general_ci NULL  ,
  `seo_keywords` text COLLATE utf8_general_ci NULL  ,
  `active_locale` tinyint(1) NULL  DEFAULT '1' ,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=InnoDB DEFAULT CHARSET='utf8';

/* Create ForeignKey(s) in Second database */

ALTER TABLE `navigation_i18n`
ADD CONSTRAINT `navigation_i18n_FK_1`
FOREIGN KEY (`id`) REFERENCES `navigation` (`id`) ON DELETE CASCADE;

/* Create ForeignKey(s) in Second database */

ALTER TABLE `navigation_item`
ADD CONSTRAINT `navigation_item_FK_1`
FOREIGN KEY (`parent_id`) REFERENCES `navigation_item` (`id`) ON DELETE CASCADE;

ALTER TABLE `navigation_item`
ADD CONSTRAINT `navigation_item_FK_2`
FOREIGN KEY (`navigation_id`) REFERENCES `navigation` (`id`) ON DELETE CASCADE;

/* Create ForeignKey(s) in Second database */

ALTER TABLE `navigation_item_i18n`
ADD CONSTRAINT `navigation_item_i18n_FK_1`
FOREIGN KEY (`id`) REFERENCES `navigation_item` (`id`) ON DELETE CASCADE;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
",
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
