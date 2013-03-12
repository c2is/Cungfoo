<?php

require_once dirname(__FILE__) . '/CrudableBaseFormTypeBehaviorBuilder.php';
require_once dirname(__FILE__) . '/CrudableFormTypeBehaviorBuilder.php';
require_once dirname(__FILE__) . '/CrudableBaseListingBehaviorBuilder.php';
require_once dirname(__FILE__) . '/CrudableListingBehaviorBuilder.php';
require_once dirname(__FILE__) . '/CrudableBehaviorQueryBuilderModifier.php';
require_once dirname(__FILE__) . '/CrudableBehaviorPeerBuilderModifier.php';
require_once dirname(__FILE__) . '/../seo/SeoBehavior.php';

class CrudableBehavior extends Behavior
{
    // default parameters value
    protected $parameters = array(
        'route_prefix'      => '/',
        'crud_prefix'       => null,
        'crud_model'        => null,
        'crud_form'         => null,
        'crud_type_file'    => null,
    );

    protected $additionalBuilders = array(
        'CrudableBaseFormTypeBehaviorBuilder',
        'CrudableFormTypeBehaviorBuilder',
        'CrudableBaseListingBehaviorBuilder',
        'CrudableListingBehaviorBuilder',
    );

    protected
        $queryBuilderModifier,
        $metadataTable;

    public function crudTypeFileExists()
    {
        return $this->getTable()->getBehavior('crudable')->getParameter('crud_type_file');
    }

    public function objectMethods($builder)
    {
        $this->builder = $builder;
        $script = '';

        $this->addSaveFromCrud($script);

        if ($this->crudTypeFileExists())
        {
            $this->addGetUploadDir($script);
            $this->addGetUploadRootDir($script);

            if ($this->getTable()->getBehavior('crudable')->getParameter('crud_type_file')) {
                foreach (explode(',', $this->getTable()->getBehavior('crudable')->getParameter('crud_type_file')) as $columnName)
                {
                    $columnName = trim($columnName);
                    $this->addGetPortfolioMedia($columnName, $script);
                    $this->addSavePortfolioUsage($columnName, $script);
                }
            }
        }

        return $script;
    }

    public function modifyTable()
    {
        $this->addMetadataTable();

        if (!$this->getTable()->hasBehavior('seo') && $this->getTable()->getName() != 'seo')
        {
            $seoBehavior = new SeoBehavior();
            $seoBehavior->setName('seo');
            $this->getTable()->addBehavior($seoBehavior);
        }
    }

    protected function addMetadataTable()
    {
        $table = $this->getTable();
        $database = $table->getDatabase();
        $metadataTableName = 'metadata';
        if ($database->hasTable($metadataTableName)) {
            $this->metadataTable = $database->getTable($metadataTableName);
        } else {
            $this->metadataTable = $database->addTable(array(
                'name'      => $metadataTableName,
                'phpName'   => ucfirst($metadataTableName),
                'package'   => $table->getPackage(),
                'schema'    => $table->getSchema(),
                'namespace' => $table->getNamespace() ? '\\' . $table->getNamespace() : null,
            ));

            $this->metadataTable->addColumn(array(
                'name'          => 'id',
                'type'          => PropelTypes::INTEGER,
                'size'          => 5,
                'primaryKey'    => 'true',
                'autoIncrement' => 'true',
                'required'      => 'true',
            ));

            $this->metadataTable->addColumn(array(
                'name'       => 'table_ref',
                'type'       => PropelTypes::VARCHAR,
                'size'       => 255,
                'required'   => 'true',
            ));

            $this->metadataTable->addColumn(array(
                'name'       => 'title',
                'type'       => PropelTypes::VARCHAR,
                'size'       => 255,
            ));

            $this->metadataTable->addColumn(array(
                'name'       => 'subtitle',
                'type'       => PropelTypes::VARCHAR,
                'size'       => 255,
            ));

            $this->metadataTable->addColumn(array(
                'name'       => 'accroche',
                'type'       => PropelTypes::VARCHAR,
                'size'       => 255,
            ));

            $crudableBehavior = new CrudableBehavior();
            $crudableBehavior->setName('crudable');
            $crudableBehavior->addParameter(array('name' => 'crud_prefix', 'value' => '/metadata'));
            $crudableBehavior->addParameter(array('name' => 'crud_type_file', 'value' => 'visuel'));
            $this->metadataTable->addBehavior($crudableBehavior);

            $i18nBehavior = new I18nBehavior();
            $i18nBehavior->setName('i18n');
            $i18nBehavior->addParameter(array('name' => 'i18n_columns', 'value' => 'title,subtitle,accroche'));
            $this->metadataTable->addBehavior($i18nBehavior);

            // every behavior adding a table should re-execute database behaviors
            foreach ($database->getBehaviors() as $behavior) {
                $behavior->modifyDatabase();
            }
        }
    }

    protected function addSaveFromCrud(&$script)
    {
        $script .= "
/**
 * @param \Symfony\Component\Form\Form \$form
 * @param PropelPDO \$con
 * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
 * @throws PropelException
 * @throws Exception
 * @see        doSave()
 */
public function saveFromCrud(\Symfony\Component\Form\Form \$form, PropelPDO \$con = null)
{
    return \$this->save(\$con);
}
";
    }

    protected function addGetUploadDir(&$script)
    {
        $tableName = $this->getTable()->getName() . 's';
        $script .= "
/**
 * @return string
 */
public function getUploadDir()
{
    return 'uploads/$tableName';
}
";
    }

    protected function addGetPortfolioMedia($columnName, &$script)
    {
        $utils = new \Cungfoo\Lib\Utils();
        $columnNameCamelize = $utils->camelize($columnName);

        $script .= "
/**
 * @return void
 */
public function get{$columnNameCamelize}()
{
    \$peer = self::PEER;

    \$medias = \Cungfoo\Model\PortfolioMediaQuery::create()
        ->select('id')
        ->usePortfolioUsageQuery()
            ->filterByTableRef(\$peer::TABLE_NAME)
            ->filterByColumnRef('{$columnName}')
            ->filterByElementId(\$this->getId())
        ->endUse()
        ->find()
        ->toArray()
    ;

    return implode(';', \$medias);
}
";
    }

    protected function addSavePortfolioUsage($columnName, &$script)
    {
        $utils = new \Cungfoo\Lib\Utils();
        $columnNameCamelize = $utils->camelize($columnName);

        $script .= "
/**
 * @return void
 */
public function set{$columnNameCamelize}(\$v)
{
    \$peer = self::PEER;

    \$values = explode(';', \$v);

    \Cungfoo\Model\PortfolioUsageQuery::create()
        ->filterByTableRef(\$peer::TABLE_NAME)
        ->filterByColumnRef('{$columnName}')
        ->filterByElementId(\$this->getId())
        ->filterByMediaId(\$values, \Criteria::NOT_IN)
        ->find()
        ->delete()
    ;

    if (\$v) {
        foreach (\$values as \$index => \$value) {
            \$usage = \Cungfoo\Model\PortfolioUsageQuery::create()
                ->filterByTableRef(\$peer::TABLE_NAME)
                ->filterByColumnRef('{$columnName}')
                ->filterByElementId(\$this->getId())
                ->filterByMediaId(\$value)
                ->findOne()
            ;

            if (!\$usage) {
                \$usage = new \Cungfoo\Model\PortfolioUsage();
                \$usage
                    ->setTableRef(\$peer::TABLE_NAME)
                    ->setColumnRef('{$columnName}')
                    ->setElementId(\$this->getId())
                    ->setMediaId(\$value)
                ;
            }

            \$usage
                ->setSortableRank(\$index)
                ->save()
            ;
        }

    }
}
";
    }

    protected function addGetUploadRootDir(&$script)
    {
        $absoluteModelDir = realpath(sprintf('%s/%s/%s',
            $this->getTable()->getGeneratorConfig()->getBuildProperties()['phpDir'],
            str_replace('\\', '/', $this->getTable()->getDatabase()->getNamespace()),
            $this->getTable()->getGeneratorConfig()->getBuildProperties()['namespaceOm']
        ));
        $absoluteWebDir     = realpath($this->getTable()->getGeneratorConfig()->getBuildProperties()['behaviorCrudableWebDir']);
        $subDirectoryLevel  = str_repeat('/..', count(array_diff_assoc(explode('/', $absoluteModelDir), explode('/', $absoluteWebDir))));
        $relativeWebDir     = implode('/', array_diff_assoc(explode('/', $absoluteWebDir), explode('/', $absoluteModelDir)));

        $script .= "
/**
 * @return string
 */
public function getUploadRootDir()
{
    return __DIR__.'$subDirectoryLevel/$relativeWebDir/'.\$this->getUploadDir();
}
";
    }

    public function getQueryBuilderModifier()
    {
        if (is_null($this->queryBuilderModifier))
        {
            $this->queryBuilderModifier = new CrudableBehaviorQueryBuilderModifier($this);
        }

        return $this->queryBuilderModifier;
    }

    public function getPeerBuilderModifier()
    {
        if (is_null($this->peerBuilderModifier)) {
            $this->peerBuilderModifier = new CrudableBehaviorPeerBuilderModifier($this);
        }

        return $this->peerBuilderModifier;
    }
}
