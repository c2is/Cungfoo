<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'job' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseJobType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'job.id',
            'required' => false,
        ));
        $builder->add('name', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'job.name',
            'required' => false,
        ));
        $builder->add('type', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'job.type',
            'required' => false,
        ));
        $builder->add('params', '', array(
            'constraints' => array(
            ),
            'label' => 'job.params',
            'required' => false,
        ));
        $builder->add('message', '', array(
            'constraints' => array(
            ),
            'label' => 'job.message',
            'required' => false,
        ));
        $builder->add('completed_at', 'datetime', array(
            'constraints' => array(
            ),
            'label' => 'job.completed_at',
            'required' => false,
        ));
        $builder->add('status', 'integer', array(
            'constraints' => array(
            ),
            'label' => 'job.status',
            'required' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cungfoo\Model\Job',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Job';
    }

} // BaseJobType
