<?php

namespace Cungfoo\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\FormView,
    Symfony\Component\Form\FormInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\Base\BaseVilleType;

/**
 * Test class for Additional builder enabled on the 'ville' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type
 */
class VilleType extends BaseVilleType
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

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->setAttribute('groups',
            array(
                array(
                    'title'         => 'ville.donnees',
                    'content'       => array(
                        'code',
                        'region',
                        'villeI18ns',
                    )
                ),
                array(
                    'title'         => 'ville.medias',
                    'content'       => array(
                        'image_detail_1',
                        'image_detail_1_deleted',
                        'image_detail_2',
                        'image_detail_2_deleted',
                    )
                ),
                array(
                    'title'         => 'ville.parametrages',
                    'content'       => array(
                        'active',
                    )
                ),
            )
        );
    }

} // VilleType

