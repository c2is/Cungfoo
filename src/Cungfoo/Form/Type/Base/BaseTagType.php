<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'tag' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseTagType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'tag.id',
            'required' => false,
        ));
        $builder->add('multimedia_etablissements', 'model', array(
            'class' => 'Cungfoo\Model\MultimediaEtablissement',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'tag.multimedia_etablissements',
            'required' => false,
        ));
        $builder->add('tagI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\TagI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'en',
                2 => 'de',
            ),
            'label' => 'tag.tagI18ns',
            'columns' => array(
                'name' => array(
                    'required' => false,
                    'label' => 'tag.name',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
            ),
            'required' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cungfoo\Model\Tag',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Tag';
    }

} // BaseTagType
