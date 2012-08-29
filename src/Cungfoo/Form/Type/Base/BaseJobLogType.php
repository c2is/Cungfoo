<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'job_log' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseJobLogType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'job_log.id',
            'required' => false,
        ));
        $builder->add('job', 'model', array(
            'class' => '\Cungfoo\Model\Job',
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'job_log.job',
            'required' => false,
        ));
        $builder->add('level', '', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'job_log.level',
            'required' => false,
        ));
        $builder->add('message', '', array(
            'constraints' => array(
            ),
            'label' => 'job_log.message',
            'required' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cungfoo\Model\JobLog',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'JobLog';
    }

} // BaseJobLogType
