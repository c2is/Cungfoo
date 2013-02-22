<?php

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Validator\Constraints as Assert;

class CrudableBaseFormTypeBehaviorBuilder extends OMBuilder
{
    const TAB_CHARACTER = "    ";

    const CRUDABLE_TYPE_TEXTRICH = 'textrich';
    const CRUDABLE_TYPE_FILE     = 'cungfoo_file';

    public $overwrite = true;

    /**
     * Gets the package for the [base] object classes.
     * @return string
     */
    public function getPackage()
    {
        return str_replace('Model', 'Form.Type', parent::getPackage()) . ".Base";
    }

    /**
     * Returns the name of the current class being built.
     * @return string
     */
    public function getUnprefixedClassname()
    {
        return 'Base' . $this->getStubObjectBuilder()->getUnprefixedClassname() . 'Type';
    }

    public function camelize($string)
    {
        $string = preg_replace("/([_-\s]?([a-zA-Z0-9]+))/e",
            "ucwords('\\2')",
            $string
        );

        return strtoupper($string[0]) . substr($string, 1);
    }

    /**
     * Adds class phpdoc comment and openning of class.
     * @param      string &$script The script will be modified in this method.
     */
    protected function addClassOpen(&$script)
    {
        $table     = $this->getTable();
        $tableName = $table->getName();
        $script   .= "use Symfony\\Component\\Form\\FormBuilderInterface,
\tSymfony\\Component\\OptionsResolver\\Options,
\tSymfony\\Component\\OptionsResolver\\OptionsResolverInterface,
\tSymfony\\Component\\Validator\\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the '$tableName' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.".$this->getPackage()."
 */
class {$this->getClassname()} extends AppAwareType
{";
    }

    /**
     * Specifies the methods that are added as part of the basic OM class.
     * This can be overridden by subclasses that wish to add more methods.
     *
     * @param $script
     * @see   ObjectBuilder::addClassBody()
     */
    protected function addClassBody(&$script)
    {

        $this->fileFields     = array_map(array('CrudableBaseFormTypeBehaviorBuilder', 'trimArray'), explode(',', $this->getTable()->getBehavior('crudable')->getParameter('crud_type_file')));
        $this->richtextFields = array_map(array('CrudableBaseFormTypeBehaviorBuilder', 'trimArray'), explode(',', $this->getTable()->getBehavior('crudable')->getParameter('crud_type_richtext')));

        $this->addBuildForm($script);
        $this->addSetDefaultOptions($script);
        $this->addGetName($script);

        $this->addRoute();
    }

    /**
     * Returns options array in the string format (indented)
     *
     * @param array $options
     * @param int $iteration
     * @return string
     */
    private function exportOptionsArray($options, $iteration = 0)
    {
        $iteration++;

        $ouput = '';
        if (is_array($options))
        {
            if ($iteration == 1)
            {
                $ouput .= sprintf("array(\n");
            }

            foreach ($options as $key => $value)
            {
                if (is_array($value))
                {
                    $ouput .= sprintf("%s'%s' => array(\n%s", str_repeat(self::TAB_CHARACTER, $iteration +2), $key, $this->exportOptionsArray($value, $iteration +2));
                }
                else
                {
                    if (is_bool($value))
                    {
                        $ouput .= sprintf("%s'%s' => %s,\n", str_repeat(self::TAB_CHARACTER, $iteration +2), $key, $value ? 'true' : 'false');
                    }
                    else if (is_int($key))
                    {
                        if (strpos($value, 'new ') === 0)
                        {
                            $ouput .= sprintf("%s%s,\n", str_repeat(self::TAB_CHARACTER, $iteration +2), $value);
                        }
                        else
                        {
                            $ouput .= sprintf("%s%s => '%s',\n", str_repeat(self::TAB_CHARACTER, $iteration +2), $key, $value);
                        }
                    }
                    else
                    {
                        $ouput .= sprintf("%s'%s' => '%s',\n", str_repeat(self::TAB_CHARACTER, $iteration +2), $key, $value);
                    }
                }
            }

            $ouput .= sprintf("%s)", str_repeat(self::TAB_CHARACTER, $iteration +1));
            if ($iteration > 1)
            {
                $ouput .= ",\n";
            }
        }

        return $ouput;
    }

    private function trimArray($value)
    {
        return trim($value);
    }

    private function getFieldType($column)
    {
        if (in_array($column->getName(), $this->fileFields)) {
            return 'cungfoo_file';
        }

        switch ($column->getType()) {
            case \PropelTypes::VARCHAR:
            case \PropelTypes::FLOAT:
                return 'text';
            case \PropelTypes::LONGVARCHAR:
                return 'textarea';
            case \PropelTypes::INTEGER:
                return 'integer';
            case \PropelTypes::BOOLEAN:
                return 'checkbox';
            case \PropelTypes::ENUM:
                return 'choice';
            case \PropelTypes::DATE:
                return 'date';
            case \PropelTypes::TIMESTAMP:
                return 'datetime';
            case self::CRUDABLE_TYPE_TEXTRICH:
                $column->setType(PropelTypes::LONGVARCHAR);
                return 'textrich';
        }

        return null;
    }

    /**
     * Adding a constraints.
     *
     * @param Column $column
     * @return array
     */
    private function getConstraints(Column $column)
    {
        $constraints = array();

        if ($column->getAttribute('required', false)) {
            $constraints[] = 'new Assert\NotBlank()';
        }

        return $constraints;
    }

    private function getFieldOptions($column)
    {
        $options = array();

        $options += array('required' => false);
        $options += array('label' => sprintf('%s.%s', $column->getTable()->getName(), $column->getName()));

        $constraints = $this->getConstraints($column);
        if (count($constraints)) {
            $options += array('constraints' => $constraints);
        }

        switch ($column->getType()) {
            case \PropelTypes::TIMESTAMP:
            case \PropelTypes::DATE:
                $options += array('widget' => 'single_text');
                break;
            case \PropelTypes::ENUM:
                $options += array('choices' => $column->getValueSet());
                break;
        }

        return $options;
    }

    /**
     * Adding all builders.
     *
     * @param string $script The script will be modified in this method.
     */
    protected function addBuildForm(&$script)
    {
        $tableFields = $this->getTableFields($this->getTable()->getColumns());
        $joinTableFields = $this->getJoinTableFields();
        $tableI18nFields = $this->getTable()->hasBehavior('i18n') ? $this->getTableFields($this->getTable()->getBehavior('i18n')->getI18nColumns()) : array();

        foreach ($tableFields as $fieldname => $field) {
            $this->addFieldMethods($fieldname, $field, $script);
        }

        foreach ($joinTableFields as $fieldname => $field) {
            $this->addFieldMethods($fieldname, $field, $script);
        }

        foreach ($tableI18nFields as $fieldname => $field) {
            $this->addFieldMethods($fieldname, $field, $script);
        }

        $script .= "
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface \$builder, array \$options)
    {";

        foreach ($tableFields as $fieldname => $field) {
            $camelName = $this->camelize($fieldname);

            $script .= "
        \$builder->add('{$fieldname}', \$this->get{$camelName}Type(), \$this->get{$camelName}Options());";
        }

        foreach ($joinTableFields as $fieldname => $field) {
            $camelName = $this->camelize($fieldname);

            $script .= "
        \$builder->add('{$fieldname}', \$this->get{$camelName}Type(), \$this->get{$camelName}Options());";
        }

        if (count($tableI18nFields)) {
            $i18nTableName = sprintf('%sI18ns', $this->getTable()->getName());
            $i18nTableClassname = sprintf('%s\\%sI18n', $this->getTable()->getNamespace(), $this->getTable()->getPhpName());

            $script .= "\$builder->add('{$i18nTableName}', 'translation_collection', array(
            'i18n_class' => '{$i18nTableClassname}',
            'label' => '{$i18nTableName}',
            'required' => false,
            'languages' => array('fr', 'de'),
            'columns' => array(\n";

            foreach ($tableI18nFields as $fieldname => $field) {
                $camelName = $this->camelize($fieldname);

                $script .= "                '{$fieldname}' => array_merge(array('type' => \$this->get{$camelName}Type()), \$this->get{$camelName}Options()),\n";
            }


            $script .= "
            )
        ));

";
        }

        $script .= "
    }
";
    }

    protected function addBuilder($fieldname, $field, &$script)
    {

    }

    protected function addFieldMethods($fieldname, $field, &$script)
    {
        $camelName = $this->camelize($fieldname);
        $type = $field['type'];
        $options = $this->exportOptionsArray($field['options']);

        $script .= "
    public function get{$camelName}Type()
    {
        return '{$type}';
    }

    public function get{$camelName}Options()
    {
        return {$options};
    }
";
    }

    protected function getTableFields($columns)
    {
        $fields = array();
        $foreignKeysByTable = array();

        foreach ($columns as $column) {
            if ($column->isForeignKey()) {
                foreach ($column->getForeignKeys() as $fColumn) {
                    if (empty($foreignKeysByTable[$fColumn->getForeignTable()->getName()])) {
                        $foreignKeysByTable[$fColumn->getForeignTable()->getName()] = 0;
                    }

                    $foreignKeysByTable[$fColumn->getForeignTable()->getName()]++;
                }
            }
        }

        foreach ($columns as $column) {
            if ($column->isForeignKey()) {
                foreach ($column->getForeignKeys() as $fColumn) {
                    $columnName = $fColumn->getForeignTable()->getName();
                    if ($foreignKeysByTable[$fColumn->getForeignTable()->getName()] > 1) {
                        $columnName = sprintf("%s_related_by_%s", $columnName, $column->getName());
                    }

                    $fields[$columnName]['type'] = 'model';
                    $fields[$columnName]['options'] = array_merge($this->getFieldOptions($column), array(
                        'class' => sprintf('%s\\%s', $fColumn->getForeignTable()->getNamespace(), ucfirst($fColumn->getForeignTable()->getPhpName())),
                    ));
                }
            }
            else {
                if (in_array($column->getName(), $this->richtextFields)) {
                    $column->setType(self::CRUDABLE_TYPE_TEXTRICH);
                }

                $fields[$column->getName()]['type'] = $this->getFieldType($column);
                $fields[$column->getName()]['options'] = $this->getFieldOptions($column);

                if (in_array($column->getName(), $this->fileFields)) {
                    $columnDeleted = clone $column;
                    $columnDeleted->setName($column->getName().'_deleted');
                    $fields[$columnDeleted->getName()]['type'] = 'checkbox';
                    $fields[$columnDeleted->getName()]['options'] = array_merge(array('property_path' => false), $this->getFieldOptions($columnDeleted));
                }
            }
        }

        return $fields;
    }

    protected function getJoinTableFields()
    {
        $fields = array();

        foreach ($this->getDatabase()->getTables() as $otherTable)
        {
            if ($otherTable->getName() == $this->getTable()->getName())
            {
                continue;
            }

            /** @var Column $otherColumn */
            foreach ($otherTable->getColumns() as $otherColumn)
            {
                $isForeignKey = false;
                if ($otherColumn->isForeignKey())
                {
                    /** @var Column $fColumn */
                    foreach ($otherColumn->getForeignKeys() as $otherColumnFK)
                    {
                        if ($otherColumnFK->getForeignTable()->getName() == $this->getTable()->getName())
                        {
                            $isForeignKey = true;
                            break 2;
                        }
                    }
                }
            }

            if ($isForeignKey)
            {
                foreach ($otherTable->getColumns() as $otherColumn)
                {
                    /** @var Column $fColumn */
                    foreach ($otherColumn->getForeignKeys() as $otherColumnFK)
                    {
                        if ($otherColumnFK->getTable()->getAttribute('isCrossRef'))
                        {
                            if ($otherColumnFK->getForeignTable()->getName() != $this->getTable()->getName())
                            {
                                    $columnName = sprintf('%ss', $otherColumnFK->getForeignTable()->getName());
                                    $fields[$columnName]['type'] = 'model';
                                    $fields[$columnName]['options'] = array_merge($this->getFieldOptions($otherColumn), array(
                                        'class' => sprintf('%s\\%s', $otherTable->getNamespace(), ucfirst($otherColumnFK->getForeignTable()->getPhpName())),
                                        'multiple' => true
                                    ));

                                break 2;
                            }
                        }
                    }
                }
            }
        }

        return $fields;
    }

    /**
     * Adding set default options method.
     *
     * @param string $script The script will be modified in this method.
     */
    protected function addSetDefaultOptions(&$script)
    {
        $dataClass = sprintf('%s\\%s',
            $this->getTable()->getNamespace(),
            $this->getStubObjectBuilder()->getUnprefixedClassname()
        );

        $script .= "
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface \$resolver)
    {
        \$resolver->setDefaults(array(
            'data_class' => '{$dataClass}',
        ));
    }
";
    }

    /**
     *
     *
     * @param string $script The script will be modified in this method.
     */
    protected function addGetName(&$script)
    {
        $name = $this->getStubObjectBuilder()->getUnprefixedClassname();

        $script .= "
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return '{$name}';
    }
";
    }

    /**
     * Closes class.
     * @param      string &$script The script will be modified in this method.
     */
    protected function addClassClose(&$script)
    {
        $script .= "
} // " . $this->getClassname() . "
";
    }

    /**
     * Return the user-defined namespace for this table,
     * or the database namespace otherwise.
     *
     * @param null $namespace
     * @return string
     */
    public function getNamespace($namespace = null)
    {
        return sprintf('%s\Base', $this->getChildrenNamespace($namespace));
    }

    /**
     * Return the user-defined children namespace.
     *
     * @param null $namespace
     * @return mixed
     */
    public function getChildrenNamespace($namespace = null)
    {
        if ($namespace === null)
        {
            $namespace = $this->getTable()->getNamespace();
        }

        return str_replace('Model', 'Form\Type', $namespace);
    }

    /**
     * Creating a crud.yml file.
     *
     * @return mixed
     */
    protected function addRoute()
    {
        if (null === $this->getTable()->getBehavior('crudable')->getParameter('crud_prefix'))
        {
            return;
        }

        $behaviorParameters = $this->getTable()->getBehavior('crudable')->getParameters();

        // mandatory parameters
        $mandatoryParameters = array(
            'route_prefix'
        );

        // validate that the parameter are set
        foreach ($mandatoryParameters as $mandatoryParameter)
        {
            if (null === $behaviorParameters[$mandatoryParameter])
            {
                return;
            }
        }

        // validate the existence of the crud configuration file
        $propelDirectory = $this->getDatabase()->getGeneratorConfig()->getBuildProperties()['projectDir'];
        $crudFilename    = $this->getTable()->getGeneratorConfig()->getBuildProperties()['behaviorCrudableRoutesConf'];

        if (!file_exists($crudFilename))
        {
            // we created
            $fs = new Filesystem();
            $fs->touch($crudFilename);
        }

        $crudConfiguration = Yaml::parse($crudFilename);
        $crudConfiguration['crud']['prefix'] = $behaviorParameters['route_prefix'];
        $crudConfiguration['crud']['controller'] = $this->getTable()->getGeneratorConfig()->getBuildProperties()['behaviorCrudableRoutesController'];

        $tableParameters = $this->getTable()->getBehavior('crudable')->getParameters();
        $crudConfiguration['crud']['items'][$this->getTable()->getName()] = array(
            'prefix'    => $tableParameters['crud_prefix'] ?: sprintf('/%s', $this->getTable()->getName()),
            'model'     => $tableParameters['crud_model'] ?: sprintf('\\%s\\%s', $this->getTable()->getNamespace(), $this->getStubObjectBuilder()->getUnprefixedClassname()),
            'form'      => $tableParameters['crud_form'] ?: sprintf('\\%s\\%sType', $this->getChildrenNamespace($this->getTable()->getNamespace()), $this->getStubObjectBuilder()->getUnprefixedClassname()),
        );

        file_put_contents($crudFilename, Yaml::dump($crudConfiguration, 4));
    }
}
