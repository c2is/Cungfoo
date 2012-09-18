<?php

namespace Cungfoo\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\Base\BaseEtablissementBaignadeType;

/**
 * Test class for Additional builder enabled on the 'etablissement_baignade' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type
 */
class EtablissementBaignadeType extends BaseEtablissementBaignadeType
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

} // EtablissementBaignadeType
