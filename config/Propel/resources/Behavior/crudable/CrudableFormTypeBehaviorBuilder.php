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
        return parent::getPackage();
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

use {$this->getNamespace()}\\om\\Base{$this->getClassname()};

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
     */
    protected function addClassBody(&$script)
    {
        $this->addBuildForm($script);
    }

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
