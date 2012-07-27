<?php

namespace Cungfoo\Model;

use Symfony\Component\Form\FormBuilderInterface;

use Cungfoo\Model\om\BaseCategoryType;

/**
 * Test class for Additional builder enabled on the 'category' table.
 *
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 * @package    propel.generator.Cungfoo.Model
 */
class CategoryType extends BaseCategoryType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Cungfoo\Model\Category',
        );
    }

} // CategoryType
