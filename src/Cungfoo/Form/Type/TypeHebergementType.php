<?php

namespace Cungfoo\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\FormView,
    Symfony\Component\Form\FormInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\Base\BaseTypeHebergementType;

/**
 * Test class for Additional builder enabled on the 'type_hebergement' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type
 */
class TypeHebergementType extends BaseTypeHebergementType
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

    public function getSlugOptions()
    {
        return array_merge(parent::getSlugOptions(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getNombrePlaceOptions()
    {
        return array_merge(parent::getNombrePlaceOptions(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getCategoryTypeHebergementOptions()
    {
        return array_merge(parent::getCategoryTypeHebergementOptions(), array('read_only' => true, 'attr' => array(
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
                        'category_type_hebergement',
                        'nombre_place',
                        'type_hebergement_capacites',
                        'nombre_chambre',
                        'type_hebergementI18ns',

                    )
                ),
                array(
                    'title'         => 'crud.tab.medias',
                    'content'       => array(
                        'image_hebergement_path',
                        'image_composition_path',
                        'slider',
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

} // TypeHebergementType
