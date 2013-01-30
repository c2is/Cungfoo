<?php

namespace Cungfoo\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\FormView,
    Symfony\Component\Form\FormInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\Base\BaseBaignadeType;

/**
 * Test class for Additional builder enabled on the 'baignade' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type
 */
class BaignadeType extends BaseBaignadeType
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
                    'title'         => 'crud.tab.datas',
                    'content'       => array(
                        'code',
                        'etablissements',
                        'baignadeI18ns',
                    )
                ),
                array(
                    'title'         => 'crud.tab.medias',
                    'content'       => array(
                        'image_path',
                        'image_path_deleted',
                        'vignette',
                        'vignette_deleted',
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

} // BaignadeType
