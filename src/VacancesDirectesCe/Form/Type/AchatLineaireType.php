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
        if ($this->getApplication()['request']->get('_route') == "reservation_recherche")
        {
            $builder->add('nbAdultes', 'choice', array(
                'required' => false,
                'choices'  => $this->formatForNb(range(1, 10), 'adulte'),
                'empty_value' => "Nombre d'adultes",
                'empty_data'  => null
            ));

            $builder->add('nbEnfants', 'choice', array(
                'required' => false,
                'choices'  => $this->formatForNb(range(0, 10), 'enfant'),
                'empty_value' => "Nombre d'enfants",
                'empty_data'  => null
            ));
        }
        else
        {
            $builder->add('nbAdultes', 'hidden', array(
                'required' => true,
            ));

            $builder->add('nbEnfants', 'hidden', array(
                'required' => true,
            ));
        }


        $paysList = PaysQuery::create()
            ->useI18nQuery()
                ->withColumn('Name')
                ->orderByName()
            ->endUse()
            ->select(array('Code', 'Name'))
            ->findActive()
            ->toArray()
        ;

        $builder->add('pays', 'choice', array(
            'choices'   => $this->formatForList($paysList, 'Code', 'Name', 'Pays'),
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
            ->select(array('Code', 'Name', 'Pays'))
            ->findActive()
            ->toArray()
        ;

        $builder->add('region', 'choice', array(
            'choices'   => $this->formatForList($regionsList, 'Code', 'Name', 'Région'),
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
            ->select(array('Code', 'Name', 'Region'))
            ->findActive()
            ->toArray()
        ;

        $builder->add('campings', 'choice', array(
            'choices'   => $this->formatForList($campingsList, 'Code', 'Name'),
            'multiple'  => true,
            'required' => false,
            'empty_value' => false,
        ));

        $builder->add('dateDebut', 'hidden', array(
            'required' => false,
        ));

        $builder->add('dateFin', 'hidden', array(
            'required' => false,
        ));

        $builder->add('isBasseSaison', 'choice', array(
            'choices'  => array('Linéaire classique', 'Linéaire mini'),
            'required' => false,
            'expanded' => true,
            'multiple' => false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'constraints' => new Assert\Callback(array('methods' => array('isValid')))
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'AchatLineaire';
    }

    protected function formatForNb($values, $label)
    {
        $choices = array();
        foreach ($values as $key => $value)
        {
            $choices[$value] = sprintf("%s %s%s", $value, $label, $value > 1 ? 's' : '');
        }

        return $choices;
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
