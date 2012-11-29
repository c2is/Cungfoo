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
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('CODE', 'Code', 'INTEGER', true, null, null);
        $this->addColumn('NAME', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('TITLE', 'Title', 'VARCHAR', false, 255, null);
        $this->addColumn('ADDRESS1', 'Address1', 'VARCHAR', false, 255, null);
        $this->addColumn('ADDRESS2', 'Address2', 'VARCHAR', false, 255, null);
        $this->addColumn('ZIP', 'Zip', 'VARCHAR', false, 255, null);
        $this->addColumn('CITY', 'City', 'VARCHAR', false, 255, null);
        $this->addColumn('MAIL', 'Mail', 'VARCHAR', false, 255, null);
        $this->addColumn('COUNTRY_CODE', 'CountryCode', 'VARCHAR', false, 255, null);
        $this->addColumn('PHONE1', 'Phone1', 'VARCHAR', false, 255, null);
        $this->addColumn('PHONE2', 'Phone2', 'VARCHAR', false, 255, null);
        $this->addColumn('FAX', 'Fax', 'VARCHAR', false, 255, null);
        $this->addColumn('OPENING_DATE', 'OpeningDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('CLOSING_DATE', 'ClosingDate', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('VILLE_ID', 'VilleId', 'INTEGER', 'ville', 'ID', false, null, null);
        $this->addForeignKey('CATEGORIE_ID', 'CategorieId', 'INTEGER', 'categorie', 'ID', false, null, null);
        $this->addColumn('GEO_COORDINATE_X', 'GeoCoordinateX', 'VARCHAR', false, 255, null);
        $this->addColumn('GEO_COORDINATE_Y', 'GeoCoordinateY', 'VARCHAR', false, 255, null);
        $this->addColumn('VIDEO_PATH', 'VideoPath', 'VARCHAR', false, 255, null);
        $this->addColumn('IMAGE_360_PATH', 'Image360Path', 'VARCHAR', false, 255, null);
        $this->addColumn('CAPACITE', 'Capacite', 'VARCHAR', false, 255, null);
        $this->addColumn('PLAN_PATH', 'PlanPath', 'VARCHAR', false, 255, null);
        $this->addColumn('VIGNETTE', 'Vignette', 'VARCHAR', false, 255, null);
        $this->addColumn('PUBLISHED', 'Published', 'BOOLEAN', false, 1, null);
        $this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('ACTIVE', 'Active', 'BOOLEAN', false, 1, null);
        $this->addColumn('ENABLED', 'Enabled', 'BOOLEAN', false, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Ville', 'Cungfoo\\Model\\Ville', RelationMap::MANY_TO_ONE, array('ville_id' => 'id', ), 'SET NULL', null);
        $this->addRelation('Categorie', 'Cungfoo\\Model\\Categorie', RelationMap::MANY_TO_ONE, array('categorie_id' => 'id', ), 'SET NULL', null);
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
        $this->addRelation('MultimediaEtablissement', 'Cungfoo\\Model\\MultimediaEtablissement', RelationMap::ONE_TO_MANY, array('id' => 'etablissement_id', ), 'CASCADE', null, 'MultimediaEtablissements');
        $this->addRelation('TopCamping', 'Cungfoo\\Model\\TopCamping', RelationMap::ONE_TO_MANY, array('id' => 'etablissement_id', ), 'CASCADE', null, 'TopCampings');
        $this->addRelation('DernieresMinutesEtablissement', 'Cungfoo\\Model\\DernieresMinutesEtablissement', RelationMap::ONE_TO_MANY, array('id' => 'etablissement_id', ), null, null, 'DernieresMinutesEtablissements');
        $this->addRelation('EtablissementI18n', 'Cungfoo\\Model\\EtablissementI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null, 'EtablissementI18ns');
        $this->addRelation('TypeHebergement', 'Cungfoo\\Model\\TypeHebergement', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'TypeHebergements');
        $this->addRelation('Destination', 'Cungfoo\\Model\\Destination', RelationMap::MANY_TO_MANY, array(), null, null, 'Destinations');
        $this->addRelation('Activite', 'Cungfoo\\Model\\Activite', RelationMap::MANY_TO_MANY, array(), null, null, 'Activites');
        $this->addRelation('ServiceComplementaire', 'Cungfoo\\Model\\ServiceComplementaire', RelationMap::MANY_TO_MANY, array(), null, null, 'ServiceComplementaires');
        $this->addRelation('SituationGeographique', 'Cungfoo\\Model\\SituationGeographique', RelationMap::MANY_TO_MANY, array(), null, null, 'SituationGeographiques');
        $this->addRelation('Baignade', 'Cungfoo\\Model\\Baignade', RelationMap::MANY_TO_MANY, array(), null, null, 'Baignades');
        $this->addRelation('Thematique', 'Cungfoo\\Model\\Thematique', RelationMap::MANY_TO_MANY, array(), null, null, 'Thematiques');
        $this->addRelation('PointInteret', 'Cungfoo\\Model\\PointInteret', RelationMap::MANY_TO_MANY, array(), null, null, 'PointInterets');
        $this->addRelation('Event', 'Cungfoo\\Model\\Event', RelationMap::MANY_TO_MANY, array(), null, null, 'Events');
        $this->addRelation('DernieresMinutes', 'Cungfoo\\Model\\DernieresMinutes', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'DernieresMinutess');
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
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_updated_at' => 'false', ),
            'active' => array('active_column' => 'active', ),
            'i18n' => array('i18n_table' => '%TABLE%_i18n', 'i18n_phpname' => '%PHPNAME%I18n', 'i18n_columns' => 'country,ouverture_reception,ouverture_camping,arrivees_departs,description', 'i18n_pk_name' => '', 'locale_column' => 'locale', 'default_locale' => 'fr', 'locale_alias' => '', ),
            'crudable' => array('route_prefix' => '/', 'crud_prefix' => '/etablissement', 'crud_model' => '', 'crud_form' => '', 'crud_type_file' => 'plan_path, vignette', 'crud_search' => 'name, title', ),
        );
    } // getBehaviors()

} // EtablissementTableMap
