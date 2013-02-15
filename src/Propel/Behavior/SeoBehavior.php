<?php

/**
 * @author     Guillaume Manen
 */
class SeoBehavior extends Behavior
{
    // default parameters value
    protected $parameters = array(
        'title_column' => 'seo_title',
        'description_column' => 'seo_description',
        'h1_column' => 'seo_h1',
        'keywords_column' => 'seo_keywords',
    );

    public function objectMethods($builder)
    {
        $this->builder = $builder;
        $script = '';
        return $script;
    }

    public function modifyTable()
    {
        if (!$this->getTable()->hasBehavior('i18n'))
        {
            $this->getTable()->addBehavior(array(
                'name'    => 'i18n',
            ));
        }

        $this->getTable()->addColumn(array(
            'name'    => $this->getParameter('title_column'),
            'type'    => PropelTypes::VARCHAR,
            'default' => '',
        ));

        $this->getTable()->addColumn(array(
            'name'    => $this->getParameter('description_column'),
            'type'    => PropelTypes::LONGVARCHAR,
        ));

        $this->getTable()->addColumn(array(
            'name'    => $this->getParameter('h1_column'),
            'type'    => PropelTypes::VARCHAR,
            'default' => '',
        ));

        $this->getTable()->addColumn(array(
            'name'    => $this->getParameter('keywords_column'),
            'type'    => PropelTypes::LONGVARCHAR,
        ));

        $this->getTable()->getBehavior('i18n')->addParameter(array(
            'name' => 'i18n_columns',
            'value' => $this->getTable()->getBehavior('i18n')->getParameter('i18n_columns').','.$this->getParameter('title_column').','.$this->getParameter('description_column').','.$this->getParameter('h1_column').','.$this->getParameter('keywords_column'),
        ));

        $table = $this->getTable();
        $database = $table->getDatabase();
        $seoTableName = 'seo';
        if ($database->hasTable($seoTableName)) {
            $this->seoTable = $database->getTable($seoTableName);
        } else {
            $this->seoTable = $database->addTable(array(
                'name'      => $seoTableName,
                'phpName'   => ucfirst($seoTableName),
                'package'   => $table->getPackage(),
                'schema'    => $table->getSchema(),
                'namespace' => $table->getNamespace() ? '\\' . $table->getNamespace() : null,
            ));

            $this->seoTable->addColumn(array(
                'name'          => 'id',
                'type'          => PropelTypes::INTEGER,
                'size'          => 5,
                'primaryKey'    => 'true',
                'autoIncrement' => 'true',
                'required'      => 'true',
            ));

            $this->seoTable->addColumn(array(
                'name'       => 'table_ref',
                'type'       => PropelTypes::VARCHAR,
                'size'       => 255,
                'required'   => 'true',
            ));

            $this->seoTable->addColumn(array(
                'name'       => 'title',
                'type'       => PropelTypes::VARCHAR,
                'size'       => 255,
            ));

            $this->seoTable->addColumn(array(
                'name'       => 'subtitle',
                'type'       => PropelTypes::VARCHAR,
                'size'       => 255,
            ));

            $this->seoTable->addColumn(array(
                'name'       => 'visuel',
                'type'       => PropelTypes::VARCHAR,
                'size'       => 255,
            ));

            $this->seoTable->addColumn(array(
                'name'       => 'accroche',
                'type'       => PropelTypes::VARCHAR,
                'size'       => 255,
            ));

            $crudableBehavior = new CrudableBehavior();
            $crudableBehavior->setName('crudable');
            $crudableBehavior->addParameter(array('name' => 'crud_prefix', 'value' => '/seo'));
            $crudableBehavior->addParameter(array('name' => 'crud_type_file', 'value' => 'visuel'));
            $this->seoTable->addBehavior($crudableBehavior);

            $i18nBehavior = new I18nBehavior();
            $i18nBehavior->setName('i18n');
            $i18nBehavior->addParameter(array('name' => 'i18n_columns', 'value' => 'title,subtitle,accroche'));
            $this->seoTable->addBehavior($i18nBehavior);

            // every behavior adding a table should re-execute database behaviors
            foreach ($database->getBehaviors() as $behavior) {
                $behavior->modifyDatabase();
            }
        }
    }
}
