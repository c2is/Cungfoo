<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'etablissement_type_hebergement' table.
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
class EtablissementTypeHebergementTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.EtablissementTypeHebergementTableMap';

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
        $this->setName('etablissement_type_hebergement');
        $this->setPhpName('EtablissementTypeHebergement');
        $this->setClassname('Cungfoo\\Model\\EtablissementTypeHebergement');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('ETABLISSEMENT_ID', 'EtablissementId', 'INTEGER' , 'etablissement', 'ID', true, null, null);
        $this->addForeignPrimaryKey('TYPE_HEBERGEMENT_ID', 'TypeHebergementId', 'INTEGER' , 'type_hebergement', 'ID', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Etablissement', 'Cungfoo\\Model\\Etablissement', RelationMap::MANY_TO_ONE, array('etablissement_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('TypeHebergement', 'Cungfoo\\Model\\TypeHebergement', RelationMap::MANY_TO_ONE, array('type_hebergement_id' => 'id', ), null, null);
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
            'crudable' => array('route_controller' => '\Cungfoo\Controller\CrudController', 'route_prefix' => '/', 'routes_file' => '../Cungfoo/crud.yml', 'languages_file' => '../languages.yml', 'crud_prefix' => '', 'crud_model' => '', 'crud_form' => '', ),
        );
    } // getBehaviors()

} // EtablissementTypeHebergementTableMap
