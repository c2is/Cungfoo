<?php

namespace Cungfoo\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\Base\BaseEtablissementTypeHebergementType;

/**
 * Test class for Additional builder enabled on the 'etablissement_type_hebergement' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type
 */
class EtablissementTypeHebergementType extends BaseEtablissementTypeHebergementType
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

} // EtablissementTypeHebergementType
