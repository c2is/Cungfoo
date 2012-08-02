<?php

namespace Cungfoo\Model\om;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Test class for Additional builder enabled on the 'document_i18n' table.
 *
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 * @package    propel.generator.Cungfoo.Model.om
 */
class BaseDocumentI18nType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array (
  'label' => 'document_i18n.id',
));
        $builder->add('locale', 'hidden', array (
  'label' => 'document_i18n.locale',
));
        $builder->add('title', 'text', array (
  'label' => 'document_i18n.title',
));
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Cungfoo\Model\DocumentI18n',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'DocumentI18n';
    }

} // BaseDocumentI18nType
