<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'etablissement_service_complementaire' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseEtablissementServiceComplementaireType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('etablissement_id', 'hidden', array(
            'label' => 'etablissement_service_complementaire.etablissement_id',
            'required' => false,
        ));
        $builder->add('service_complementaire_id', 'hidden', array(
            'label' => 'etablissement_service_complementaire.service_complementaire_id',
            'required' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cungfoo\Model\EtablissementServiceComplementaire',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'EtablissementServiceComplementaire';
    }

} // BaseEtablissementServiceComplementaireType
