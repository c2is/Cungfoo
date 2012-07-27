<?php

namespace Cungfoo\Model;

use Symfony\Component\Form\FormBuilderInterface;

use Cungfoo\Model\om\BaseAuthorType;

/**
 * Test class for Additional builder enabled on the 'author' table.
 *
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 * @package    propel.generator.Cungfoo.Model
 */
class AuthorType extends BaseAuthorType
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
            'data_class' => 'Cungfoo\Model\Author',
        );
    }

} // AuthorType
