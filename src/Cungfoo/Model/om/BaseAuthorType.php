<?php

namespace Cungfoo\Model\om;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Test class for Additional builder enabled on the 'author' table.
 *
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 * @package    propel.generator.Cungfoo.Model.om
 */
class BaseAuthorType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array (
  'label' => 'author.id',
));
        $builder->add('name', 'text', array (
  'label' => 'author.name',
));
        $builder->add('documents', 'model', array (
  'class' => 'Cungfoo\\Model\\Document',
  'multiple' => true,
  'label' => 'author.documents',
));
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Cungfoo\Model\Author',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'author';
    }

} // BaseAuthorType
