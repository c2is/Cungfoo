<?php

namespace Cungfoo\Model;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Model\om\BaseAuthorType;

/**
 * Test class for Additional builder enabled on the 'author' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Model
 */
class AuthorType extends BaseAuthorType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        //$this->getMetadata(__NAMESPACE__)
        //    ->addPropertyConstraint('field1', new Assert\MinLength(5))
        //    ->addPropertyConstraint('field2', new Assert\NotBlank())
        //;
    }

} // AuthorType
