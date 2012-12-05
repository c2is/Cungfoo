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
        $this->addForeignPrimaryKey('etablissement_id', 'EtablissementId', 'INTEGER' , 'etablissement', 'id', true, null, null);
        $this->addForeignPrimaryKey('type_hebergement_id', 'TypeHebergementId', 'INTEGER' , 'type_hebergement', 'id', true, null, null);
        $this->addColumn('minimum_price', 'MinimumPrice', 'VARCHAR', false, 255, null);
        $this->addColumn('minimum_price_discount_label', 'MinimumPriceDiscountLabel', 'VARCHAR', false, 255, null);
        $this->addColumn('minimum_price_start_date', 'MinimumPriceStartDate', 'DATE', false, null, null);
        $this->addColumn('minimum_price_end_date', 'MinimumPriceEndDate', 'DATE', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Etablissement', 'Cungfoo\\Model\\Etablissement', RelationMap::MANY_TO_ONE, array('etablissement_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('TypeHebergement', 'Cungfoo\\Model\\TypeHebergement', RelationMap::MANY_TO_ONE, array('type_hebergement_id' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // EtablissementTypeHebergementTableMap
