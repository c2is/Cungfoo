<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'document_author' table.
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
class DocumentAuthorTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.DocumentAuthorTableMap';

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
        $this->setName('document_author');
        $this->setPhpName('DocumentAuthor');
        $this->setClassname('Cungfoo\\Model\\DocumentAuthor');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('DOCUMENT_ID', 'DocumentId', 'INTEGER' , 'document', 'ID', true, null, null);
        $this->addForeignPrimaryKey('AUTHOR_ID', 'AuthorId', 'INTEGER' , 'author', 'ID', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Document', 'Cungfoo\\Model\\Document', RelationMap::MANY_TO_ONE, array('document_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('Author', 'Cungfoo\\Model\\Author', RelationMap::MANY_TO_ONE, array('author_id' => 'id', ), 'CASCADE', null);
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
            'crudable' => array('route_controller' => '\Cungfoo\Controller\CrudController', 'route_prefix' => '/admin', 'routes_file' => '../Cungfoo/crud.yml', 'languages_file' => '../languages.yml', 'crud_prefix' => '', 'crud_model' => '', 'crud_form' => '', ),
        );
    } // getBehaviors()

} // DocumentAuthorTableMap
