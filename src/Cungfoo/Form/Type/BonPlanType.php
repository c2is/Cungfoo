<?php

namespace Cungfoo\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\FormView,
    Symfony\Component\Form\FormInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\Base\BaseBonPlanType;

/**
 * Test class for Additional builder enabled on the 'bon_plan' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type
 */
class BonPlanType extends BaseBonPlanType
{

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
                        'prix',
                        'date_debut',
                        'date_fin',
                        'bon_planI18ns',
                    )
                ),
                array(
                    'title'         => 'crud.tab.resalys',
                    'content'       => array(
                        'date_start',
                        'day_start',
                        'day_range',
                        'nb_adultes',
                        'nb_enfants',
                        'period_categories',
                        'bon_plan_categories',
                        'etablissements',
                        'regions',
                        'bon_planI18ns',
                    )
                ),
                array(
                    'title'         => 'crud.tab.medias',
                    'content'       => array(
                        'image_menu',
                        'image_menu_deleted',
                        'image_page',
                        'image_page_deleted',
                        'image_liste',
                        'image_liste_deleted',
                    )
                ),
                array(
                    'title'         => 'crud.tab.parameters',
                    'content'       => array(
                        'active_compteur',
                        'mise_en_avant',
                        'push_home',
                        'active',
                    )
                ),
            )
        );
    }
} // BonPlanType
