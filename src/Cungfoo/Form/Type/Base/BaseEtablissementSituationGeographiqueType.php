<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'etablissement_situation_geographique' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseEtablissementSituationGeographiqueType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('etablissement_id', 'hidden', array(
            'label' => 'etablissement_situation_geographique.etablissement_id',
            'required' => false,
        ));
        $builder->add('situation_geographique_id', 'hidden', array(
            'label' => 'etablissement_situation_geographique.situation_geographique_id',
            'required' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cungfoo\Model\EtablissementSituationGeographique',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'EtablissementSituationGeographique';
    }

} // BaseEtablissementSituationGeographiqueType