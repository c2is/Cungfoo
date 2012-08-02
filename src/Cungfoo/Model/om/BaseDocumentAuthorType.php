<?php

namespace Cungfoo\Model\om;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Test class for Additional builder enabled on the 'document_author' table.
 *
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 * @package    propel.generator.Cungfoo.Model.om
 */
class BaseDocumentAuthorType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('document_id', 'hidden', array (
  'label' => 'document_author.document_id',
));
        $builder->add('author_id', 'hidden', array (
  'label' => 'document_author.author_id',
));
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Cungfoo\Model\DocumentAuthor',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'documentauthor';
    }

} // BaseDocumentAuthorType
