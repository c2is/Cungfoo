<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'top_camping' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseTopCampingType extends AppAwareType
{
    public function getIdType()
    {
        return 'integer';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'top_camping.id',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getEtablissementType()
    {
        return 'model';
    }

    public function getEtablissementOptions()
    {
        return array(
            'required' => false,
            'label' => 'top_camping.etablissement_id',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
            'class' => 'Cungfoo\Model\Etablissement',
        );
    }

    public function getSortableRankType()
    {
        return 'integer';
    }

    public function getSortableRankOptions()
    {
        return array(
            'required' => false,
            'label' => 'top_camping.sortable_rank',
        );
    }

    public function getActiveType()
    {
        return 'checkbox';
    }

    public function getActiveOptions()
    {
        return array(
            'required' => false,
            'label' => 'top_camping.active',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', $this->getIdType(), $this->getIdOptions());
        $builder->add('etablissement', $this->getEtablissementType(), $this->getEtablissementOptions());
        $builder->add('sortable_rank', $this->getSortableRankType(), $this->getSortableRankOptions());
        $builder->add('active', $this->getActiveType(), $this->getActiveOptions());
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cungfoo\Model\TopCamping',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'TopCamping';
    }

} // BaseTopCampingType
