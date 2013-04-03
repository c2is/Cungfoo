<?php

namespace Cungfoo\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\FormView,
    Symfony\Component\Form\FormInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\Base\BaseCoordonneesContactType;

use Cungfoo\Model\CoordonneesParametragesPeer as Parameters;

/**
 * Test class for Additional builder enabled on the 'coordonnees_contact' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type
 */
class CoordonneesContactType extends BaseCoordonneesContactType
{
    public function getSujetType()
    {
        return 'choice';
    }

    public function getSujetOptions()
    {
        return array(
            'required' => false,
            'label' => 'coordonnees_contact.sujet',
            'choices' => array(
                Parameters::DEMANDE_INFORMATION => Parameters::get(Parameters::DEMANDE_INFORMATION),
                Parameters::DEMANDE_CATALOGUE   => Parameters::get(Parameters::DEMANDE_CATALOGUE),
                Parameters::RESERVATION_GROÜP   => Parameters::get(Parameters::RESERVATION_GROÜP),
                Parameters::RECRUTEMENT         => Parameters::get(Parameters::RECRUTEMENT),
                Parameters::ACHAT_DE_MOBIL_HOME => Parameters::get(Parameters::ACHAT_DE_MOBIL_HOME),
                Parameters::INFORMATIONS_CE     => Parameters::get(Parameters::INFORMATIONS_CE),
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        //$this->getMetadata($options['data_class'])
        //    ->addPropertyConstraint('field1', new Assert\MinLength(5))
        //;
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->setAttribute('groups',
            array(
                array(
                    'title'         => 'crud.tab.datas',
                    'content'       => array(
                        'civilite',
                        'nom',
                        'prenom',
                        'type',
                        'adresse',
                        'ville',
                        'code_postal',
                        'pays',
                        'email',
                        'telephone',
                        'fax',
                        'sujet',
                        'message',
                    )
                ),
            )
        );
    }

} // CoordonneesContactType
