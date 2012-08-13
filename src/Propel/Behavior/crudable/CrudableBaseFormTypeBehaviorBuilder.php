<?php

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Validator\Constraints as Assert;

class CrudableBaseFormTypeBehaviorBuilder extends OMBuilder
{
    const TAB_CHARACTER = "\t";

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
        $this->addBuildForm($script);
        $this->addSetDefaultOptions($script);
        $this->addGetName($script);

        $this->addRoute();
    }

    /**
     * Adding builder
     *
     * @param string $columnName
     * @param string $type
     * @param array  $options
     * @return string
     */
    private function addBuilder($columnName, $type = "text", $options = array())
    {
        $options = array_merge($options, array(
            'label'    => sprintf('%s.%s', $this->getTable()->getName(), $columnName),
            'required' => false,
        ));

        return sprintf("\n%s\$builder->add('%s', '%s'%s);", str_repeat(self::TAB_CHARACTER, 2), $columnName, $type, $this->exportOptionsArray($options));
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
                $ouput .= sprintf(", array(\n");
            }

            foreach ($options as $key => $value)
            {
                if (is_array($value))
                {
                    $ouput .= sprintf("%s'%s' => array(\n%s", str_repeat(self::TAB_CHARACTER, $iteration +2), $key, $this->exportOptionsArray($value, $iteration));
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

    /**
     * Adding add builder method.
     *
     * @param Column $column
     * @return string
     */
    private function addBuilderAccordingToColumn(Column $column)
    {
        if (!in_array($column->getName(), array('created_at', 'updated_at')))
        {
            return $this->addBuilder($column->getName(), $this->getColumnType($column), array(
                'constraints' => $this->addConstraints($column)
            ));
        }
    }

    /**
     * Adding a constraints.
     *
     * @param Column $column
     * @return array
     */
    private function addConstraints(Column $column)
    {
        $constraints = array();
        if ($column->getAttribute('required', false))
        {
            $constraints[] = 'new Assert\NotBlank()';
        }

        return $constraints;
    }

    /**
     * @param Column $column
     * @return string
     */
    private function getColumnType(Column $column)
    {
        if ($column->getAttribute('widget', false))
        {
            return $column->getAttribute('widget');
        }
        elseif (PropelTypes::VARCHAR === $column->getType())
        {
            return 'text';
        }
        elseif (PropelTypes::INTEGER === $column->getType())
        {
            return 'integer';
        }
        elseif (PropelTypes::FLOAT === $column->getType())
        {
            return 'text';
        }
        elseif (PropelTypes::DATE === $column->getType())
        {
            return 'date';
        }
        elseif (PropelTypes::TIMESTAMP === $column->getType())
        {
            return 'datetime';
        }
        elseif (PropelTypes::LONGVARBINARY === $column->getType())
        {
            return 'file';
        }
    }

    /**
     * Adding all builders.
     *
     * @param string $script The script will be modified in this method.
     */
    protected function addBuildForm(&$script)
    {
        $builders = "";

        // Manage table columns
        foreach ($this->getTable()->getColumns() as $column)
        {
            // For the primary key
            if ($column->isPrimaryKey())
            {
                $builders .= $this->addBuilder($column->getName(), 'hidden');
            }
            // for the foreign key
            elseif ($column->isForeignKey())
            {
                foreach ($column->getForeignKeys() as $fColumn)
                {
                    $options['class'] = sprintf('\\%s\\%s', $fColumn->getForeignTable()->getNamespace(), $fColumn->getForeignTable()->getPhpName());
                    $options['constraints'] = $this->addConstraints($column);
                    $builders .= $this->addBuilder($fColumn->getForeignTable()->getName(), 'model', $options);
                }
            }
            // for the other columns
            else
            {
                $builders .= $this->addBuilderAccordingToColumn($column);
            }
        }

        // Manage foreign key with multiple value
        /** @var Table $otherTable */
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
                        if ($otherColumnFK->getForeignTable()->getName() != $this->getTable()->getName())
                        {
                            $builders .= $this->addBuilder(
                                sprintf('%ss', $otherColumnFK->getForeignTable()->getName()),
                                'model',
                                array(
                                    'class'         => sprintf('%s\\%s', $otherTable->getNamespace(), ucfirst($otherColumnFK->getForeignTable()->getName())),
                                    'constraints'   => $this->addConstraints($otherColumn),
                                    'multiple'      => true,
                                )
                            );

                            break 2;
                        }
                    }
                }
            }
        }

        // Manage i18n behavior
        if ($this->getTable()->hasBehavior('i18n'))
        {
            $i18nColumns = array();
            foreach ($this->getTable()->getBehavior('i18n')->getI18nColumns() as $i18nColumn)
            {
                $i18nColumns[$i18nColumn->getName()] = array(
                    'required'      => false,
                    'label'         => sprintf('%s.%s', $this->getTable()->getName(), $i18nColumn->getName()),
                    'type'          => $this->getColumnType($i18nColumn),
                    'constraints'   => $this->addConstraints($i18nColumn),
                );
            }

            // set default languages
            $languagesConfiguration = array(locale_get_default());

            // get the configuration of the site languages
            $languageParameter = $this->getDatabase()->getBehavior('crudable')->getParameter('languages_file');
            if (null !== $languageParameter)
            {
                $propelDirectory    = $this->getDatabase()->getGeneratorConfig()->getBuildProperties()['projectDir'];
                $languageFilename   = sprintf('%s/%s', $propelDirectory, $languageParameter);

                if (file_exists($languageFilename))
                {
                    $languagesConfiguration = array_keys(Yaml::parse($languageFilename)['languages']);
                }
            }

            $options = array(
                'i18n_class' => sprintf('%s\\%sI18n', $this->getTable()->getNamespace(), ucfirst($this->getTable()->getName())),
                'languages' => $languagesConfiguration,
                'label' => 'Translations',
                'columns' => $i18nColumns
            );

            $builders .= $this->addBuilder(
                sprintf('%sI18ns', $this->getTable()->getName()),
                'translation_collection',
                $options
            );
        }

        $script .= "
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface \$builder, array \$options)
    {{$builders}
    }
";
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

        $behaviorParameters = $this->getDatabase()->getBehavior('crudable')->getParameters();

        // mandatory parameters
        $mandatoryParameters = array(
            'route_controller',
            'route_prefix',
            'routes_file',
            'languages_file',
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
        $crudFilename    = sprintf('%s/%s', $propelDirectory, $behaviorParameters['routes_file']);

        if (!file_exists($crudFilename))
        {
            // we created
            $fs = new Filesystem();
            $fs->touch($crudFilename);
        }

        $crudConfiguration = Yaml::parse($crudFilename);
        $crudConfiguration['crud']['prefix'] = $behaviorParameters['route_prefix'];
        $crudConfiguration['crud']['controller'] = $behaviorParameters['route_controller'];

        $tableParameters = $this->getTable()->getBehavior('crudable')->getParameters();
        $crudConfiguration['crud']['items'][$this->getTable()->getName()] = array(
            'prefix'    => $tableParameters['crud_prefix'] ?: sprintf('/%s', $this->getTable()->getName()),
            'model'     => $tableParameters['crud_model'] ?: sprintf('\\%s\\%s', $this->getTable()->getNamespace(), $this->getStubObjectBuilder()->getUnprefixedClassname()),
            'form'      => $tableParameters['crud_form'] ?: sprintf('\\%s\\%sType', $this->getChildrenNamespace($this->getTable()->getNamespace()), $this->getStubObjectBuilder()->getUnprefixedClassname()),
        );

        file_put_contents($crudFilename, Yaml::dump($crudConfiguration, 4));
    }
}
