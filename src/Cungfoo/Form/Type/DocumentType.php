<?php

namespace Cungfoo\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormBuilderInterface;

use Cungfoo\Model\Author;

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
        $builder->add('id', 'hidden');
        $builder->add('title');
        $builder->add('body');

        $builder->add('author', 'collection', array(
            'type' => new AuthorType(),
            'options' => array('data_class' => '\Cungfoo\Model\Author'),
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
