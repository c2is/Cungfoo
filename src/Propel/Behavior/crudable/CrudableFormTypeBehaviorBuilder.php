<?php

class CrudableFormTypeBehaviorBuilder extends OMBuilder
{
    public $overwrite = false;

    /**
     * Gets the package for the [base] object classes.
     * @return string
     */
    public function getPackage()
    {
        return str_replace('Model', 'Form.Type', parent::getPackage());
    }

    /**
     * Return the user-defined parent namespace.
     *
     * @param null $namespace
     * @return mixed
     */
    public function getParentNamespace($namespace = null)
    {
        return sprintf('%s\Base', $this->getNamespace($namespace));
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
        if ($namespace === null) {
            $namespace = $this->getTable()->getNamespace();
        }
        return str_replace('Model', 'Form\Type', $namespace);
    }

    /**
     * Returns the name of the current class being built.
     * @return string
     */
    public function getUnprefixedClassname()
    {
        return $this->getStubObjectBuilder()->getUnprefixedClassname() . 'Type';
    }

    /**
     * Adds class phpdoc comment and openning of class.
     * @param      string &$script The script will be modified in this method.
     */
    protected function addClassOpen(&$script)
    {
        $table = $this->getTable();
        $tableName = $table->getName();
        $script .= "use Symfony\\Component\\Form\\FormBuilderInterface,
\tSymfony\Component\Validator\Constraints as Assert;

use {$this->getParentNamespace()}\\Base{$this->getClassname()};

/**
 * Test class for Additional builder enabled on the '$tableName' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.".$this->getPackage()."
 */
class {$this->getClassname()} extends Base{$this->getClassname()}
{
";
    }

    /**
     * Specifies the methods that are added as part of the basic OM class.
     * This can be overridden by subclasses that wish to add more methods.
     * @see        ObjectBuilder::addClassBody()
     *
     * @param string $script The script will be modified in this method.
     */
    protected function addClassBody(&$script)
    {
        $this->addBuildForm($script);
    }

    /**
     * Adding add builder method.
     *
     * @param string $script The script will be modified in this method.
     */
    protected function addBuildForm(&$script)
    {
        $script .= "
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface \$builder, array \$options)
    {
        parent::buildForm(\$builder, \$options);

        //\$this->getMetadata(__NAMESPACE__)
        //    ->addPropertyConstraint('field1', new Assert\MinLength(5))
        //    ->addPropertyConstraint('field2', new Assert\NotBlank())
        //;
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
}
