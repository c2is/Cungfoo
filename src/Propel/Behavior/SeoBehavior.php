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

        $this->addGetMetadata($script);

        return $script;
    }

    public function modifyTable()
    {
        if (!$this->getTable()->hasBehavior('i18n'))
        {
            $this->getTable()->addBehavior(array(
                'name'    => 'i18n',
            ));

            foreach ($this->getTable()->getDatabase()->getBehaviors() as $behavior) {
                $behavior->modifyDatabase();
            }
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
    }

    protected function addGetMetadata(&$script)
    {
        $utils = new \Cungfoo\Lib\Utils();

        $script .= "
/**
 * @param PropelPDO \$con
 * @return array             The object's metadata
 */
public function getMetadata(PropelPDO \$con = null)
{
    \$metadata = array(";
        foreach ($this->parameters as $seoColumn)
        {
            $getColumn = 'get' . $utils->camelize($seoColumn);
            $script .= "
        '$seoColumn' => \$this->$getColumn(),";
        }

        $script .= "
    );";


    if ($this->getTable()->hasBehavior('crudable'))
    {
        $tableName = $this->getTable()->getName();
        $script .= "
    \$utils = new \Cungfoo\Lib\Utils();
    if (\$tableMetadata = \Cungfoo\Model\MetadataPeer::get('$tableName'))
    {
        foreach (\$metadata as \$seoColumn => \$value) 
        {
            if (!trim(\$value))
            {
                \$getColumn = 'get' . \$utils->camelize(\$seoColumn);
                \$metadata[\$seoColumn] = \$tableMetadata->\$getColumn();
            }
        }
    }";
    }

    $script .= "
    return \$metadata;
}
";
    }
}
