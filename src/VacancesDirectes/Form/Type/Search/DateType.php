<?php

namespace VacancesDirectes\Form\Type\Search;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\FormEvents,
    Symfony\Component\Form\FormEvent,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

class DateType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $app = $this->getApplication();

        $locale = $app['context']->get('language');
        $data   = $app['session']->get('search_engine_data');
        $currentDestination = is_object($data) && property_exists($data, 'destination') ? $data->destination : null;

        $builder->add('dateDebut', 'hidden', array(
            'required' => false,
        ));

        $builder->add('isBasseSaison', 'hidden', array(
            'required' => false,
        ));

        $builder->add('nbJoursBasseSaison', 'choice', array(
            'choices'     => array(
                2  => "2 " . $app->trans('date_search.nuits'),
                3  => "3 " . $app->trans('date_search.nuits'),
                4  => "4 " . $app->trans('date_search.nuits'),
                5  => "5 " . $app->trans('date_search.nuits'),
                6  => "6 " . $app->trans('date_search.nuits'),
                7  => "7 " . $app->trans('date_search.nuits'),
                8  => "8 " . $app->trans('date_search.nuits'),
                9  => "9 " . $app->trans('date_search.nuits'),
                10 => "10 " . $app->trans('date_search.nuits'),
                11 => "11 " . $app->trans('date_search.nuits'),
                12  => "12 " . $app->trans('date_search.nuits'),
                13  => "13 " . $app->trans('date_search.nuits'),
                14 => "14 " . $app->trans('date_search.nuits'),
                15  => "15 " . $app->trans('date_search.nuits'),
                16  => "16 " . $app->trans('date_search.nuits'),
                17 => "17 " . $app->trans('date_search.nuits'),
                18 => "18 " . $app->trans('date_search.nuits'),
                19  => "19 " . $app->trans('date_search.nuits'),
                20  => "20 " . $app->trans('date_search.nuits'),
                21 => "21 " . $app->trans('date_search.nuits'),
                22  => "22 " . $app->trans('date_search.nuits'),
                23  => "23 " . $app->trans('date_search.nuits'),
                24 => "24 " . $app->trans('date_search.nuits'),
                25 => "25 " . $app->trans('date_search.nuits'),
                26  => "26 " . $app->trans('date_search.nuits'),
                27  => "27 " . $app->trans('date_search.nuits'),
                28 => "28 " . $app->trans('date_search.nuits')
            ),
            'label'       => 'date_search.nb_jours',
            'empty_value' => "date_search.nb_jours.empty_value",
            'empty_data'  => null,
            'required'    => false,
        ));

        $builder->add('nbJoursHauteSaison', 'choice', array(
            'choices'     => array(
                3  => "3 " . $app->trans('date_search.nuits'),
                4  => "4 " . $app->trans('date_search.nuits'),
                7  => "7 " . $app->trans('date_search.nuits'),
                10 => "10 " . $app->trans('date_search.nuits'),
                11 => "11 " . $app->trans('date_search.nuits'),
                14 => "14 " . $app->trans('date_search.nuits'),
                17 => "17 " . $app->trans('date_search.nuits'),
                18 => "18 " . $app->trans('date_search.nuits'),
                21 => "21 " . $app->trans('date_search.nuits'),
                24 => "24 " . $app->trans('date_search.nuits'),
                25 => "25 " . $app->trans('date_search.nuits'),
                28 => "28 " . $app->trans('date_search.nuits')
            ),
            'label'       => 'date_search.nb_jours',
            'empty_value' => "date_search.nb_jours.empty_value",
            'empty_data'  => null,
            'required'    => false,
        ));

        $builder->add('isCamping', 'hidden', array(
            'required' => false,
        ));

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
            ->useVilleQuery()
                ->useEtablissementQuery()
                    ->filterByActive(true)
                ->endUse()
            ->endUse()
            ->usePaysQuery()
                ->filterByActive(true)
            ->endUse()
            ->setDistinct()
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
            'data' => $currentDestination
        ));

        $builder->add('nbAdultes', 'text', array(
            'label'     => 'date_search.nb_adultes',
            'required'  => false,
        ));

        $builder->add('nbEnfants', 'text', array(
            'label'     => 'date_search.nb_enfants',
            'required'  => false,
        ));

        $dateType = $this;
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($app, $dateType) {
                $form = $event->getForm();
                $data = $event->getData();

                if(null === $data) {
                    return;
                }

                $locale = $app['context']->get('language');
                $currentDestination = $data->destination;

                $region = \Cungfoo\Model\RegionQuery::create()
                    ->filterByCode($currentDestination)
                    ->findOne()
                ;

                $villes = \Cungfoo\Model\VilleQuery::create()
                    ->joinWithI18n($locale)
                    ->withColumn('VilleI18n.name', 'Name')
                    ->select(array('Code', 'Name'))
                    ->_if($currentDestination)
                    ->filterByDestination($region, $currentDestination)
                    ->_endif()
                    ->useEtablissementQuery()
                    ->filterByActive(true)
                    ->endUse()
                    ->useRegionQuery()
                    ->filterByActive(true)
                    ->usePaysQuery()
                    ->filterByActive(true)
                    ->endUse()
                    ->endUse()
                    ->setDistinct()
                    ->orderBy('Name')
                    ->findActive()
                    ->toArray()
                ;

                $form->add($app['form.factory']->createNamed('ville', 'choice', null, array(
                    'choices'       => $dateType->formatForList($villes, 'Code', 'Name'),
                    'label'         => 'date_search.ville',
                    'empty_value'   => "date_search.ville.empty_value",
                    'empty_data'    => null,
                    'required'      => false,
                )));

                $campings = \Cungfoo\Model\EtablissementQuery::create()
                    ->select(array('Code', 'Name'))
                    ->_if($currentDestination)
                    ->filterByDestinationSearch($region, $currentDestination)
                    ->_endif()
                    ->orderByName()
                    ->findActive()
                    ->toArray()
                ;

                $form->add($app['form.factory']->createNamed('camping', 'choice', null, array(
                    'choices'       => $dateType->formatForList($campings, 'Code', 'Name'),
                    'label'         => 'date_search.camping',
                    'empty_value'   => "date_search.camping.empty_value",
                    'empty_data'    => null,
                    'required'      => false,
                )));
            }
        );
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'constraints'     => new Assert\Callback(array('methods' => array('isValide'))),
            'csrf_protection' => false,
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
            if (!in_array($item['PaysCode'], $pays))
            {
                $choices[$item['PaysCode']] = $item['PaysName'];
                $pays[] = $item['PaysCode'];
            }
            $choices[$item['Code']] = $item['Name'];
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
