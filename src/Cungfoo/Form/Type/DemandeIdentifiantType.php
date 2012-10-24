<?php

namespace Cungfoo\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\Base\BaseDemandeIdentifiantType;

/**
 * Test class for Additional builder enabled on the 'demande_identifiant' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type
 */
class DemandeIdentifiantType extends BaseDemandeIdentifiantType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('permanence_choices', 'choice', array(
            'choices'       => array(
                'lundi' => 'lundi',
                'mardi' => 'mardi',
                'mercredi' => 'mercredi',
                'jeudi' => 'jeudi',
                'vendredi' => 'vendredi',
                'samedi' => 'samedi'
            ),
            'expanded'      => true,
            'multiple'      => true,
            'label'         => 'demande_identifiant.permanence',
            'property_path' => false,
        ));

        $builder->add('contact_mail', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
                new Assert\Email(),
            ),
            'label' => 'demande_identifiant.contact_mail',
            'required' => false,
        ));

        $builder->remove('permanence');
        //$this->getMetadata($options['data_class'])
        //    ->addPropertyConstraint('field1', new Assert\MinLength(5))
        //;
    }

} // DemandeIdentifiantType
