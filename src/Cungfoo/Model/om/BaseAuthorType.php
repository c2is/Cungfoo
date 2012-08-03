<?php

namespace Cungfoo\Model\om;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'author' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Model.om
 */
class BaseAuthorType extends AppAwareType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label'   => 'author.id',
            'required'   => false,
        ));
        $builder->add('name', 'text', array(
            'label'   => 'author.name',
            'required'   => false,
        ));
        $builder->add('documents', 'model', array(
            'class'   => 'Cungfoo\Model\Document',
            'multiple'   => true,
            'label'   => 'author.documents',
            'required'   => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cungfoo\Model\Author',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Author';
    }

} // BaseAuthorType
