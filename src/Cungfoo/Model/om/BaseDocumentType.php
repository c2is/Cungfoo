<?php

namespace Cungfoo\Model\om;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'document' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Model.om
 */
class BaseDocumentType extends AppAwareType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array (
  'label' => 'document.id',
));
        $builder->add('category', 'model', array (
  'class' => '\\Cungfoo\\Model\\Category',
  'label' => 'document.category',
));
        $builder->add('authors', 'model', array (
  'class' => 'Cungfoo\\Model\\Author',
  'multiple' => true,
  'label' => 'document.authors',
));
        $builder->add('documentI18ns', 'translation_collection', array (
  'i18n_class' => 'Cungfoo\\Model\\DocumentI18n',
  'languages' =>
  array (
    0 => 'fr',
    1 => 'en',
  ),
  'label' => 'document.documentI18ns',
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
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cungfoo\Model\Document',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Document';
    }

} // BaseDocumentType
