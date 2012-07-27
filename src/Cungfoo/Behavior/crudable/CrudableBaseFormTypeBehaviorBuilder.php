<?php

class CrudableBaseFormTypeBehaviorBuilder extends OMBuilder
{
    public $overwrite = true;

    /**
     * Gets the package for the [base] object classes.
     * @return string
     */
    public function getPackage()
    {
        return parent::getPackage() . ".om";
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
        $table = $this->getTable();
        $tableName = $table->getName();
        $script .= "use Symfony\\Component\\Form\\AbstractType;
use Symfony\\Component\\Form\\FormEvents;
use Symfony\\Component\\Form\\FormEvent;
use Symfony\\Component\\Form\\FormBuilderInterface;

/**
 * Test class for Additional builder enabled on the '$tableName' table.
 *
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 * @package    propel.generator.".$this->getPackage()."
 */
class {$this->getClassname()} extends AbstractType
{
";
    }

    /**
     * Specifies the methods that are added as part of the basic OM class.
     * This can be overridden by subclasses that wish to add more methods.
     * @see        ObjectBuilder::addClassBody()
     */
    protected function addClassBody(&$script)
    {
        $this->addBuildForm($script);
        $this->addGetDefaultOptions($script);
        $this->addGetName($script);
    }

    protected function addBuildForm(&$script)
    {
        $builders = "";

        foreach ($this->getTable()->getColumns() as $col)
        {
            if ('id' === $col->getName()) {
                $builders .= "        \$builder->add('{$col->getName()}', 'hidden');\n";
                continue;
            }

            if (in_array($col->getName(), array('created_at', 'updated_at'))) {
                continue;
            }

            if ($col->isLobType()) {
                $builders .= "        \$builder->add('{$col->getName()}');\n";
            } elseif ($col->getType() === PropelTypes::DATE) {
                $builders .= "        \$builder->add('{$col->getName()}', 'date');\n";
            } elseif ($col->getType() === PropelTypes::TIME || $col->getType() === PropelTypes::TIMESTAMP) {
                $builders .= "        \$builder->add('{$col->getName()}', 'datetime');\n";
            } elseif ($col->getType() === PropelTypes::OBJECT) {
                $builders .= "        \$builder->add('{$col->getName()}');\n";
            } elseif ($col->getType() === PropelTypes::PHP_ARRAY) {
                $builders .= "        \$builder->add('{$col->getName()}');\n";
                if ($col->isNamePlural()) {
                    $builders .= "        \$builder->add('{$col->getName()}');\n";
                }
            } elseif ($col->isEnumType()) {
                $builders .= "        \$builder->add('{$col->getName()}');\n";
            } elseif ($col->isBooleanType()) {
                $builders .= "        \$builder->add('{$col->getName()}', 'checkbox');\n";
            } else {
                $builders .= "        \$builder->add('{$col->getName()}');\n";
            }
        }

        $script .= "
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface \$builder, array \$options)
    {
{$builders}
    }
";
    }

    protected function addGetDefaultOptions(&$script)
    {
        $dataClass = sprintf('%s\\%s',
            $this->getTable()->getNamespace(),
            $this->getStubObjectBuilder()->getUnprefixedClassname()
        );

        $script .= "
    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions(array \$options)
    {
        return array(
            'data_class' => '{$dataClass}',
        );
    }
";
    }

    protected function addGetName(&$script)
    {
        $name = strtolower($this->getStubObjectBuilder()->getUnprefixedClassname());

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
     * @return string
     */
    public function getNamespace()
    {
        return $this->getTable()->getNamespace() . '\\om';
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
}
