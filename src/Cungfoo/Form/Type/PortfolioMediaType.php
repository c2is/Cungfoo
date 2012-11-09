<?php

namespace Cungfoo\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\Base\BasePortfolioMediaType;

/**
 * Test class for Additional builder enabled on the 'portfolio_media' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type
 */
class PortfolioMediaType extends BasePortfolioMediaType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->remove('name_origin');
        $builder->remove('path_origin');
        $builder->remove('path_miniature');
        $builder->remove('size');
        $builder->remove('type');

        $builder->add('portfolio_tags', 'model', array(
            'class' => 'Cungfoo\Model\PortfolioTag',
            'constraints' => array(
            ),
            'multiple' => true,
            'expanded' => true,
            'label' => 'portfolio_media.portfolio_tags',
            'required' => false,
        ));

        //$this->getMetadata($options['data_class'])
        //    ->addPropertyConstraint('field1', new Assert\MinLength(5))
        //;
    }

} // PortfolioMediaType
