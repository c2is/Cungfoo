<?php

namespace VacancesDirectesCe\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType,
    Cungfoo\Model\PaysQuery,
    Cungfoo\Model\RegionQuery,
    Cungfoo\Model\EtablissementQuery;

class AchatLineaireType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nbAdultes', 'hidden', array(
            'required' => true,
        ));

        $paysList = PaysQuery::create()
            ->useI18nQuery()
                ->withColumn('Name')
                ->orderByName()
            ->endUse()
            ->select(array('Code'))
            ->find()
            ->toArray()
        ;

        $builder->add('pays', 'choice', array(
            'choices'   => $this->formatForList($paysList, 'Code', 'Name', 'Pays'),
            'label' => 'Pays',
            'required' => false,
            'empty_value' => false
        ));

        $regionsList = RegionQuery::create()
            ->useI18nQuery('fr', 'region_i18n')
                ->withColumn('region_i18n.Name', 'Name')
                ->orderByName()
            ->endUse()
            ->usePaysQuery()
                ->withColumn('pays.Code', 'Pays')
            ->endUse()
            ->select(array('Code'))
            ->find()
            ->toArray()
        ;

        $builder->add('region', 'choice', array(
            'choices'   => $this->formatForList($regionsList, 'Code', 'Name', 'Région'),
            'label' => 'Region',
            'required' => false,
            'empty_value' => false,
        ));

        $campingsList = EtablissementQuery::create()
            ->useI18nQuery()
                ->withColumn('Name')
                ->orderByName()
            ->endUse()
            ->useVilleQuery()
                ->useRegionQuery()
                    ->withColumn('region.Code', 'Region')
                ->endUse()
            ->endUse()
            ->select(array('Code'))
            ->find()
            ->toArray()
        ;

        $builder->add('campings', 'choice', array(
            'choices'   => $this->formatForList($campingsList, 'Code', 'Name'),
            'multiple'  => true,
            'label' => 'Campings',
            'required' => false,
            'empty_value' => false,
        ));

        $builder->add('dateDebut', 'hidden', array(
            'label' => 'Date de début',
            'required' => false,
        ));

        $builder->add('dateFin', 'hidden', array(
            'label' => 'Date de fin',
            'required' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'constraints' => new Assert\Callback(array('methods' => array('isValide')))
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'AchatLineaire';
    }

    protected function formatForList($list, $key, $value, $empty = null)
    {
        $choices = array();
        if ($empty !== null)
        {
            $choices[0] = $empty;
        }

        foreach ($list as $item)
        {
            $choices[$item[$key]] = $item[$value];
        }

        return $choices;
    }

} // BaseActiviteType
