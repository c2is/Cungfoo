<?php

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Validator\Constraints as Assert;

class CrudableBaseListingBehaviorBuilder extends OMBuilder
{
    const TAB_CHARACTER = "\t";

    public $overwrite = true;

    /**
     * Gets the package for the [base] object classes.
     * @return string
     */
    public function getPackage()
    {
        return str_replace('Model', 'Listing.Crud', parent::getPackage()) . ".Base";
    }

    /**
     * Returns the name of the current class being built.
     * @return string
     */
    public function getUnprefixedClassname()
    {
        return 'Base' . $this->getStubObjectBuilder()->getUnprefixedClassname() . 'Listing';
    }

    /**
     * Adds class phpdoc comment and openning of class.
     * @param      string &$script The script will be modified in this method.
     */
    protected function addClassOpen(&$script)
    {
        $table     = $this->getTable();
        $tableName = $table->getName();
        $script .= "use Cungfoo\\Listing\\Listing,
\tCungfoo\\Listing\\Column;

/**
 * Generated listing class for '$tableName' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.".$this->getPackage()."
 */
class {$this->getClassname()} extends Listing
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
        $this->addColumns($script);
        $this->addGetName($script);
    }

    protected function generateColumn($name, $type)
    {
        return sprintf("\n%s\$this->addColumn(new Column\%sColumn('%s'));", str_repeat(self::TAB_CHARACTER, 2), $type, $name);
    }

    /**
     * Adding all columns.
     *
     * @param string $script The script will be modified in this method.
     */
    protected function addColumns(&$script)
    {
        $columnsRender = "";

        // Manage table columns
        foreach ($this->getTable()->getColumns() as $column)
        {
            if ($column->isPrimaryKey())
            {
                $columnsRender .= $this->generateColumn($column->getName(), 'Text');
            }

            if ($column->getType() != PropelTypes::VARCHAR)
            {
                continue;
            }

            $columnsRender .= $this->generateColumn($column->getName(), 'Text');
        }

        $script .= "
    /**
     * {@inheritdoc}
     */
    public function configure()
    {{$columnsRender}
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

        return str_replace('Model', 'Listing\Crud', $namespace);
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
