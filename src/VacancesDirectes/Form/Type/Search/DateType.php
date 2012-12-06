<?php

namespace VacancesDirectes\Form\Type\Search;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Validator\ExecutionContext;

use Cungfoo\Form\Type\AppAwareType;

class DateType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $locale = $this->getApplication()['context']->get('language');

        $builder->add('dateDebut', 'hidden', array(
            'required' => false,
        ));

        $builder->add('nbJours', 'choice', array(
            'choices'     => array(4 => "4 jours", 7 => "7 jours", 14 => "14 jours", 21 => "21 jours", 28 => "28 jours"),
            'label'       => 'date_search.nb_jours',
            'empty_value' => "date_search.nb_jours.empty_value",
            'empty_data'  => null,
            'required'    => false,
        ));

        $builder->add('isCamping', 'hidden', array(
            'required' => false,
        ));

        $destinationCurrentChoice = $this->getApplication()['request']->get('SearchDate')['destination'];

        $destinationChoices = \Cungfoo\Model\RegionQuery::create()
            ->useI18nQuery($locale, 'region_i18n')
                ->withColumn('region_i18n.Name', 'Name')
            ->endUse()
            ->usePaysQuery()
                ->withColumn('pays.Code', 'PaysCode')
                ->useI18nQuery($locale, 'pays_i18n')
                    ->withColumn('pays_i18n.Name', 'PaysName')
                ->endUse()
                ->withColumn('pays.Code', 'PaysCode')
            ->endUse()
            ->select(array('Code', 'PaysName', 'Name', 'PaysCode'))
            ->orderBy('PaysName')
            ->orderBy('Name')
            ->findActive()
            ->toArray()
        ;

        $builder->add('destination', 'choice', array(
            'choices'     => $this->formatForListDestination($destinationChoices),
            'label'       => 'date_search.destination',
            'empty_value' => "date_search.destination.empty_value",
            'empty_data'  => null,
            'required'    => false,
            'data' => $destinationCurrentChoice
        ));

        $region = \Cungfoo\Model\RegionQuery::create()
            ->filterByCode($destinationCurrentChoice)
            ->findOne()
        ;

        $villes = \Cungfoo\Model\VilleQuery::create()
            ->joinWithI18n($locale)
            ->withColumn('VilleI18n.name', 'Name')
            ->select(array('Code', 'Name'))
            ->filterByDestination($region, $destinationCurrentChoice)
            ->orderBy('Name')
            ->findActive()
        ;

        $builder->add('ville', 'choice', array(
            'choices'     => $this->formatForList($villes, 'Code', 'Name'),
            'label'     => 'date_search.ville',
            'empty_value' => "date_search.ville.empty_value",
            'empty_data'  => null,
            'required'  => false,
        ));

        $campings = \Cungfoo\Model\EtablissementQuery::create()
            ->select(array('Code', 'Name'))
            ->filterByDestination($region, $destinationCurrentChoice)
            ->orderByName()
            ->findActive()
        ;

        $builder->add('camping', 'choice', array(
            'choices'     => $this->formatForList($campings, 'Code', 'Name'),
            'label'     => 'date_search.camping',
            'empty_value' => "date_search.camping.empty_value",
            'empty_data'  => null,
            'required'  => false,
        ));

        $builder->add('nbAdultes', 'text', array(
            'label'     => 'date_search.nb_adultes',
            'required'  => false,
        ));

        $builder->add('nbEnfants', 'text', array(
            'label'     => 'date_search.nb_enfants',
            'required'  => false,
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
        return 'SearchDate';
    }

    protected function formatForListDestination($list)
    {
        $pays = array();

        $choices = array();
        foreach ($list as $item)
        {
            $choices[$item['PaysName']][$item['Code']] = $item['Name'];
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
}
