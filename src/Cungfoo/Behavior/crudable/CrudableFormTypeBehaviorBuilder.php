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
        $script .= "use Symfony\\Component\\Form\\AbstractType;
use Symfony\\Component\\Form\\FormEvents;
use Symfony\\Component\\Form\\FormEvent;
use Symfony\\Component\\Form\\FormBuilderInterface;

use {$this->getNamespace()}\\om\\Base{$this->getClassname()};

/**
 * Test class for Additional builder enabled on the '$tableName' table.
 *
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 * @package    propel.generator.".$this->getPackage()."
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
        $this->addGetDefaultOptions($script);
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
    }
";
    }

    protected function addGetDefaultOptions(&$script)
    {
        $dataClass = sprintf('%s\\%s', $this->getNamespace(), $this->getStubObjectBuilder()->getUnprefixedClassname());

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
