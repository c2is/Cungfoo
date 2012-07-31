<?php

namespace Cungfoo\Model\om;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Test class for Additional builder enabled on the 'document' table.
 *
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 * @package    propel.generator.Cungfoo.Model.om
 */
class BaseDocumentType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden');
        $builder->add('category', 'model', array (
  'class' => '\\Cungfoo\\Model\\Category',
));
        $builder->add('authors', 'model', array (
  'class' => 'Cungfoo\\Model\\Author',
  'multiple' => true,
));
        $builder->add('documentI18ns', 'translation_collection', array (
  'i18n_class' => 'Cungfoo\\Model\\DocumentI18n',
  'languages' =>
  array (
    0 => 'en_EN',
  ),
  'label' => 'Translations',
  'columns' =>
  array (
    'title' =>
    array (
    ),
    'body' =>
    array (
    ),
  ),
));
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Cungfoo\Model\Document',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'document';
    }

} // BaseDocumentType
