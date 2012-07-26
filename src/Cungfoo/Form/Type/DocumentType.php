<?php

namespace Cungfoo\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormBuilderInterface;

use Cungfoo\Model\Author;
use Cungfoo\Model\LanguageQuery;

/**
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 */
class DocumentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $languages = LanguageQuery::create()->select(array('local'))->find()->toArray();

        $builder->add('id', 'hidden');

        $builder->add('documentI18ns', new TranslationCollectionType(), array(
            'i18n_class' => '\Cungfoo\Model\DocumentI18n',
            'languages' => $languages,
            'label' => 'Translations',
            'columns' => array(
                'title' => array(
                    'label' => 'Custom title'
                ),
                'body' => array(
                    'type' => 'textarea'
                )
            )
        ));

        $builder->add('category', new ModelType(), array(
            'class' => 'Cungfoo\Model\Category',
        ));

        $builder->add('authors', new ModelType(), array(
            'class' => 'Cungfoo\Model\Author',
            'multiple' => true,
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
}
