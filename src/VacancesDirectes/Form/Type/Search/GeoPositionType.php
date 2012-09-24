<?php

namespace VacancesDirectes\Form\Type\Search;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Validator\ExecutionContext;

use Cungfoo\Form\Type\AppAwareType,
    Cungfoo\Lib\GeographicCoordinates;

class GeoPositionType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $geographicCoordinates = new GeographicCoordinates();
        $builder->add('geographic_coordinates', 'hidden', array(
            'data' => implode(',', $geographicCoordinates->getGeographicCoordinatesByIp('corse.fr'))
        ));

        $builder->add('temps_trajet', 'choice', array(
            'choices' => array(
                '1' => 'de 1 à 2h',
                '2' => 'de 2 à 4h',
                '4' => 'de 4 à 6h',
                '6' => '6h et +',
            )
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'GeoPosition';
    }
}
