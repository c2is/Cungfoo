<?php

namespace Cungfoo\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\FormView,
    Symfony\Component\Form\FormInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Model\PortfolioUsageQuery;

class PortfolioSearchType extends AppAwareType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('search', 'text', array(
            'label'     => 'Search',
            'required'  => false,
        ));

        $tablesUsed = PortfolioUsageQuery::create()->select('table_ref')->find()->toArray();
        $tableChoices = array();
        foreach ($tablesUsed as $table) {
            $tableChoices[$table] = $table;
        }
        $builder->add('table', 'choice', array(
            'label'         => 'Table',
            'choices'       => $tableChoices,
            'required'      => false,
            'empty_value'   => 'Choisissez une table',
            'attr'          => array(
                'class'    => 'portfolio-search-form-table',
            ),
        ));

        $columnsUsed = PortfolioUsageQuery::create()->select('column_ref')->find()->toArray();
        $columnChoices = array();
        foreach ($columnsUsed as $column) {
            $columnChoices[$column] = $column;
        }
        $builder->add('column', 'choice', array(
            'label'         => 'Champ',
            'choices'       => $columnChoices,
            'required'      => false,
            'empty_value'   => 'Choisissez un champ',
            'attr'          => array(
                'disabled' => 'disabled',
                'class'    => 'portfolio-search-form-column',
            ),
        ));
    }

    public function getName()
    {
        return 'PortfolioSearch';
    }
}
