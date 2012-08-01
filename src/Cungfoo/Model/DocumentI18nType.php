<?php

namespace Cungfoo\Model;

use Symfony\Component\Form\FormBuilderInterface;

use Cungfoo\Model\om\BaseDocumentI18nType;

/**
 * Test class for Additional builder enabled on the 'document_i18n' table.
 *
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 * @package    propel.generator.Cungfoo.Model
 */
class DocumentI18nType extends BaseDocumentI18nType
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
            'data_class' => 'Cungfoo\Model\DocumentI18n',
        );
    }

} // DocumentI18nType
