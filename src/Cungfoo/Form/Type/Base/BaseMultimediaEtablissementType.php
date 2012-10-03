<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'multimedia_etablissement' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseMultimediaEtablissementType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'multimedia_etablissement.id',
            'required' => false,
        ));
        $builder->add('etablissement', 'model', array(
            'class' => '\Cungfoo\Model\Etablissement',
            'constraints' => array(
            ),
            'label' => 'multimedia_etablissement.etablissement',
            'required' => false,
        ));
        $builder->add('image_path', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'multimedia_etablissement.image_path',
            'required' => false,
        ));
        $builder->add('image_path_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'multimedia_etablissement.image_path_deleted',
            'required' => false,
        ));
        $builder->add('multimedia_etablissementI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\MultimediaEtablissementI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'en',
                2 => 'de',
            ),
            'label' => 'multimedia_etablissement.multimedia_etablissementI18ns',
            'columns' => array(
                'titre' => array(
                    'required' => false,
                    'label' => 'multimedia_etablissement.titre',
                    'type' => 'text',
                    'constraints' => array(
                        new Assert\NotBlank(),
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
            'data_class' => 'Cungfoo\Model\MultimediaEtablissement',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'MultimediaEtablissement';
    }

} // BaseMultimediaEtablissementType
