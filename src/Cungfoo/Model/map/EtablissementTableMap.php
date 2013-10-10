<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'etablissement' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.Cungfoo.Model.map
 */
class EtablissementTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.EtablissementTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('etablissement');
        $this->setPhpName('Etablissement');
        $this->setClassname('Cungfoo\\Model\\Etablissement');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('code', 'Code', 'INTEGER', true, null, null);
        $this->addColumn('slug', 'Slug', 'VARCHAR', true, 255, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('title', 'Title', 'VARCHAR', false, 255, null);
        $this->addColumn('address1', 'Address1', 'VARCHAR', false, 255, null);
        $this->addColumn('address2', 'Address2', 'VARCHAR', false, 255, null);
        $this->addColumn('zip', 'Zip', 'VARCHAR', false, 255, null);
        $this->addColumn('city', 'City', 'VARCHAR', false, 255, null);
        $this->addColumn('mail', 'Mail', 'VARCHAR', false, 255, null);
        $this->addColumn('country_code', 'CountryCode', 'VARCHAR', false, 255, null);
        $this->addColumn('phone1', 'Phone1', 'VARCHAR', false, 255, null);
        $this->addColumn('phone2', 'Phone2', 'VARCHAR', false, 255, null);
        $this->addColumn('fax', 'Fax', 'VARCHAR', false, 255, null);
        $this->addColumn('opening_date', 'OpeningDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('closing_date', 'ClosingDate', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('ville_id', 'VilleId', 'INTEGER', 'ville', 'id', false, null, null);
        $this->addForeignKey('departement_id', 'DepartementId', 'INTEGER', 'departement', 'id', false, null, null);
        $this->addForeignKey('categorie_id', 'CategorieId', 'INTEGER', 'categorie', 'id', false, null, null);
        $this->addColumn('geo_coordinate_x', 'GeoCoordinateX', 'VARCHAR', false, 255, null);
        $this->addColumn('geo_coordinate_y', 'GeoCoordinateY', 'VARCHAR', false, 255, null);
        $this->addColumn('video_path', 'VideoPath', 'VARCHAR', false, 255, null);
        $this->addColumn('image_360_path', 'Image360Path', 'VARCHAR', false, 255, null);
        $this->addColumn('capacite', 'Capacite', 'VARCHAR', false, 255, null);
        $this->addForeignKey('related_1', 'Related1', 'INTEGER', 'etablissement', 'id', false, null, null);
        $this->addForeignKey('related_2', 'Related2', 'INTEGER', 'etablissement', 'id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', false, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Ville', 'Cungfoo\\Model\\Ville', RelationMap::MANY_TO_ONE, array('ville_id' => 'id', ), 'SET NULL', null);
        $this->addRelation('Departement', 'Cungfoo\\Model\\Departement', RelationMap::MANY_TO_ONE, array('departement_id' => 'id', ), 'SET NULL', null);
        $this->addRelation('Categorie', 'Cungfoo\\Model\\Categorie', RelationMap::MANY_TO_ONE, array('categorie_id' => 'id', ), 'SET NULL', null);
        $this->addRelation('EtablissementRelatedByRelated1', 'Cungfoo\\Model\\Etablissement', RelationMap::MANY_TO_ONE, array('related_1' => 'id', ), 'SET NULL', null);
        $this->addRelation('EtablissementRelatedByRelated2', 'Cungfoo\\Model\\Etablissement', RelationMap::MANY_TO_ONE, array('related_2' => 'id', ), 'SET NULL', null);
        $this->addRelation('EtablissementRelatedById0', 'Cungfoo\\Model\\Etablissement', RelationMap::ONE_TO_MANY, array('id' => 'related_1', ), 'SET NULL', null, 'EtablissementsRelatedById0');
        $this->addRelation('EtablissementRelatedById1', 'Cungfoo\\Model\\Etablissement', RelationMap::ONE_TO_MANY, array('id' => 'related_2', ), 'SET NULL', null, 'EtablissementsRelatedById1');
        $this->addRelation('EtablissementTypeHebergement', 'Cungfoo\\Model\\EtablissementTypeHebergement', RelationMap::ONE_TO_MANY, array('id' => 'etablissement_id', ), 'CASCADE', null, 'EtablissementTypeHebergements');
        $this->addRelation('EtablissementDestination', 'Cungfoo\\Model\\EtablissementDestination', RelationMap::ONE_TO_MANY, array('id' => 'etablissement_id', ), 'CASCADE', null, 'EtablissementDestinations');
        $this->addRelation('EtablissementActivite', 'Cungfoo\\Model\\EtablissementActivite', RelationMap::ONE_TO_MANY, array('id' => 'etablissement_id', ), 'CASCADE', null, 'EtablissementActivites');
        $this->addRelation('EtablissementServiceComplementaire', 'Cungfoo\\Model\\EtablissementServiceComplementaire', RelationMap::ONE_TO_MANY, array('id' => 'etablissement_id', ), 'CASCADE', null, 'EtablissementServiceComplementaires');
        $this->addRelation('EtablissementSituationGeographique', 'Cungfoo\\Model\\EtablissementSituationGeographique', RelationMap::ONE_TO_MANY, array('id' => 'etablissement_id', ), 'CASCADE', null, 'EtablissementSituationGeographiques');
        $this->addRelation('EtablissementBaignade', 'Cungfoo\\Model\\EtablissementBaignade', RelationMap::ONE_TO_MANY, array('id' => 'etablissement_id', ), 'CASCADE', null, 'EtablissementBaignades');
        $this->addRelation('EtablissementThematique', 'Cungfoo\\Model\\EtablissementThematique', RelationMap::ONE_TO_MANY, array('id' => 'etablissement_id', ), 'CASCADE', null, 'EtablissementThematiques');
        $this->addRelation('EtablissementPointInteret', 'Cungfoo\\Model\\EtablissementPointInteret', RelationMap::ONE_TO_MANY, array('id' => 'etablissement_id', ), 'CASCADE', null, 'EtablissementPointInterets');
        $this->addRelation('EtablissementEvent', 'Cungfoo\\Model\\EtablissementEvent', RelationMap::ONE_TO_MANY, array('id' => 'etablissement_id', ), 'CASCADE', null, 'EtablissementEvents');
        $this->addRelation('Personnage', 'Cungfoo\\Model\\Personnage', RelationMap::ONE_TO_MANY, array('id' => 'etablissement_id', ), 'CASCADE', null, 'Personnages');
        $this->addRelation('TopCamping', 'Cungfoo\\Model\\TopCamping', RelationMap::ONE_TO_MANY, array('id' => 'etablissement_id', ), 'CASCADE', null, 'TopCampings');
        $this->addRelation('BonPlanEtablissement', 'Cungfoo\\Model\\BonPlanEtablissement', RelationMap::ONE_TO_MANY, array('id' => 'etablissement_id', ), 'CASCADE', null, 'BonPlanEtablissements');
        $this->addRelation('DemandeAnnulation', 'Cungfoo\\Model\\DemandeAnnulation', RelationMap::ONE_TO_MANY, array('id' => 'camping_id', ), null, null, 'DemandeAnnulations');
        $this->addRelation('EtablissementI18n', 'Cungfoo\\Model\\EtablissementI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null, 'EtablissementI18ns');
        $this->addRelation('TypeHebergement', 'Cungfoo\\Model\\TypeHebergement', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'TypeHebergements');
        $this->addRelation('Destination', 'Cungfoo\\Model\\Destination', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Destinations');
        $this->addRelation('Activite', 'Cungfoo\\Model\\Activite', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Activites');
        $this->addRelation('ServiceComplementaire', 'Cungfoo\\Model\\ServiceComplementaire', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'ServiceComplementaires');
        $this->addRelation('SituationGeographique', 'Cungfoo\\Model\\SituationGeographique', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'SituationGeographiques');
        $this->addRelation('Baignade', 'Cungfoo\\Model\\Baignade', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Baignades');
        $this->addRelation('Thematique', 'Cungfoo\\Model\\Thematique', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Thematiques');
        $this->addRelation('PointInteret', 'Cungfoo\\Model\\PointInteret', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'PointInterets');
        $this->addRelation('Event', 'Cungfoo\\Model\\Event', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Events');
        $this->addRelation('BonPlan', 'Cungfoo\\Model\\BonPlan', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'BonPlans');
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' =>  array (
  'create_column' => 'created_at',
  'update_column' => 'updated_at',
  'disable_updated_at' => 'false',
),
            'active' =>  array (
  'active_column' => 'active',
  'active_locale_column' => 'active_locale',
  'default_value' => 'false',
),
            'cungfoo_sluggable' =>  array (
  'default_value' => 'n-a',
),
            'i18n' =>  array (
  'i18n_table' => '%TABLE%_i18n',
  'i18n_phpname' => '%PHPNAME%I18n',
  'i18n_columns' => 'country,ouverture_reception,ouverture_camping,arrivees_departs,description,seo_title,seo_description,seo_h1,seo_keywords,active_locale',
  'i18n_pk_name' => NULL,
  'locale_column' => 'locale',
  'default_locale' => 'fr',
  'locale_alias' => '',
),
            'crudable' =>  array (
  'route_prefix' => '/',
  'crud_prefix' => '/etablissement',
  'crud_model' => NULL,
  'crud_form' => NULL,
  'crud_type_file' => 'plan, vignette, slider',
  'crud_search' => 'name, title',
  'crud_type_richtext' => 'description',
),
            'seo' =>  array (
  'seo_columns' => 'seo_title,seo_description,seo_h1,seo_keywords',
  'seo_description' => 'LONGVARCHAR',
  'seo_keywords' => 'LONGVARCHAR',
),
        );
    } // getBehaviors()

} // EtablissementTableMap
