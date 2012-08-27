<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'camping_service_complementaire' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseCampingServiceComplementaireType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('camping_id', 'hidden', array(
            'label' => 'camping_service_complementaire.camping_id',
            'required' => false,
        ));
        $builder->add('service_complementaire_id', 'hidden', array(
            'label' => 'camping_service_complementaire.service_complementaire_id',
            'required' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cungfoo\Model\CampingServiceComplementaire',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'CampingServiceComplementaire';
    }

} // BaseCampingServiceComplementaireType
