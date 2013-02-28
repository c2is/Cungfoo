<?php

namespace Cungfoo\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\FormView,
    Symfony\Component\Form\FormInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\Base\BaseDepartementType;

/**
 * Test class for Additional builder enabled on the 'departement' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type
 */
class DepartementType extends BaseDepartementType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        //$this->getMetadata($options['data_class'])
        //    ->addPropertyConstraint('field1', new Assert\MinLength(5))
        //;
    }

    public function getCodeOptions()
    {
        return array_merge(parent::getCodeOptions(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getNameOptions()
    {
        return array_merge(parent::getNameOptions(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getRegionRefOptions()
    {
        return array_merge(parent::getRegionRefOptions(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getSlugOptions()
    {
        return array_merge(parent::getSlugOptions(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->setAttribute('groups',
            array(
                array(
                    'title'         => 'crud.tab.datas',
                    'content'       => array(
                        'code',
                        'region_ref',
                        'departementI18ns',
                    )
                ),
                array(
                    'title'         => 'crud.tab.medias',
                    'content'       => array(
                        'image_detail_1',
                        'image_detail_2',
                    )
                ),
                array(
                    'title'         => 'crud.tab.parameters',
                    'content'       => array(
                        'active',
                    )
                ),
            )
        );
    }

} // DepartementType
