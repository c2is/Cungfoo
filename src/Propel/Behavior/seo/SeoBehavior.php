<?php

require_once dirname(__FILE__) . '/SeoBehaviorPeerBuilderModifier.php';

/**
 * @author     Guillaume Manen
 */
class SeoBehavior extends Behavior
{
    // default parameters value
    protected $parameters = array(
        'seo_columns' => 'seo_title,seo_description,seo_h1,seo_keywords',
        'seo_description' => 'LONGVARCHAR',
        'seo_keywords' => 'LONGVARCHAR'
    );

    protected function getSeoColumns()
    {
        return explode(',', $this->getParameter('seo_columns'));
    }

    protected function getSeoColumnType($columnName)
    {
        $definedType = $this->getParameter($columnName);
        return $definedType && defined('PropelTypes::' . $definedType) ? constant('PropelTypes::' . $definedType) : PropelTypes::VARCHAR;
    }

    protected function camelize($string)
    {
        return preg_replace_callback(
            '/(^|_|\.)+(.)/',
            function ($match) {
                return ('.' === $match[1] ? '_' : '').strtoupper($match[2]);
            },
            $string
        );
    }

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

        foreach ($this->getSeoColumns() as $seoColumn)
        {
            $this->getTable()->addColumn(array(
                'name'    => $seoColumn,
                'type'    => $this->getSeoColumnType($seoColumn),
            ));
        }

        $this->getTable()->getBehavior('i18n')->addParameter(array(
            'name' => 'i18n_columns',
            'value' => $this->getTable()->getBehavior('i18n')->getParameter('i18n_columns').','.$this->getParameter('seo_columns'),
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

            foreach ($this->getSeoColumns() as $seoColumn)
            {
                $this->seoTable->addColumn(array(
                    'name'    => $seoColumn,
                    'type'    => $this->getSeoColumnType($seoColumn),
                ));
            }

            $crudableBehavior = new CrudableBehavior();
            $crudableBehavior->setName('crudable');
            $crudableBehavior->addParameter(array('name' => 'crud_prefix', 'value' => '/seo'));
            $this->seoTable->addBehavior($crudableBehavior);

            $i18nBehavior = new I18nBehavior();
            $i18nBehavior->setName('i18n');
            $i18nBehavior->addParameter(array('name' => 'i18n_columns', 'value' => $this->getParameter('seo_columns')));
            $this->seoTable->addBehavior($i18nBehavior);

            // every behavior adding a table should re-execute database behaviors
            foreach ($database->getBehaviors() as $behavior)
            {
                $behavior->modifyDatabase();
            }
        }
    }

    public function getPeerBuilderModifier()
    {
        if (is_null($this->peerBuilderModifier)) {
            $this->peerBuilderModifier = new SeoBehaviorPeerBuilderModifier($this);
        }

        return $this->peerBuilderModifier;
    }

    public function objectFilter(&$script)
    {
        foreach ($this->getSeoColumns() as $seoColumn)
        {
            $methodName = 'get' . $this->camelize($seoColumn);

            $newMethod = "

    /**
     * Get the [%2\$s] column value.
     *
     * @return string
     */
    public function %1\$s()
    {
        if (trim(\$this->getCurrentTranslation()->%1\$s()))
        {
            return trim(\$this->getCurrentTranslation()->%1\$s());
        }

        \$peerClassName = self::PEER;
        if (\$peerClassName::getSeo())
        {
            return \$peerClassName::getSeo()->%1\$s();
        }

        return '';
    }
";
            $table = $this->getTable();
            $newMethod = sprintf($newMethod, $methodName, $seoColumn);
            $parser = new PropelPHPParser($script, true);
            $parser->replaceMethod($methodName, $newMethod);
            $script = $parser->getCode();
        }
    }
}
