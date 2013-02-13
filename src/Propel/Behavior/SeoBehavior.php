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
    );

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
            'type'    => 'VARCHAR',
            'default' => '',
        ));

        $this->getTable()->addColumn(array(
            'name'    => $this->getParameter('description_column'),
            'type'    => 'LONGVARCHAR',
        ));

        $this->getTable()->getBehavior('i18n')->addParameter(array(
            'name' => 'i18n_columns',
            'value' => $this->getTable()->getBehavior('i18n')->getParameter('i18n_columns').','.$this->getParameter('title_column').','.$this->getParameter('description_column'),
        ));
    }
}
