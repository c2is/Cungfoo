<?php

/**
 * @author     Morgan Brunot
 */
class ActiveBehavior extends Behavior
{
    // default parameters value
    protected $parameters = array(
        'active_column' => 'active',
    );

    public function modifyTable()
    {
        if (!$this->getTable()->containsColumn($this->getParameter('active_column')))
        {
            $this->getTable()->addColumn(array(
                'name'    => $this->getParameter('active_column'),
                'type'    => 'BOOLEAN',
                'default' => true,
            ));
        }
    }

    protected function getColumnPhpName($column)
    {
        return $this->getColumnForParameter($column)->getPhpName();
    }

    protected function getColumnConstant($columnName, $builder)
    {
        return $builder->getColumnConstant($this->getColumnForParameter($columnName));
    }

    public function objectMethods($builder)
    {
        return "
/**
 * return true is the object is active
 *
 * @return boolean
 */
public function is" . $this->getColumnPhpName('active_column') . "()
{
    return \$this->get" . $this->getColumnPhpName('active_column') . "();
}
";
    }

    public function queryMethods($builder)
    {
        return "
/**
 * return only active objects
 *
 * @return boolean
 */
public function find" . $this->getColumnPhpName('active_column') . "(\$con = null)
{
    \$this->filterBy" . $this->getColumnPhpName('active_column') . "(true);

    return parent::find(\$con);
}
";
    }
}
