<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'coordonnees_contact' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseCoordonneesContactType extends AppAwareType
{
    public function getIdType()
    {
        return 'hidden';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'coordonnees_contact.id',
        );
    }

    public function getCiviliteType()
    {
        return 'choice';
    }

    public function getCiviliteOptions()
    {
        return array(
            'required' => false,
            'label' => 'coordonnees_contact.civilite',
            'choices' => array(
                        'madame' => 'madame',
                        'mademoiselle' => 'mademoiselle',
                        'monsieur' => 'monsieur',
                    ),
        );
    }

    public function getNomType()
    {
        return 'text';
    }

    public function getNomOptions()
    {
        return array(
            'required' => false,
            'label' => 'coordonnees_contact.nom',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getPrenomType()
    {
        return 'text';
    }

    public function getPrenomOptions()
    {
        return array(
            'required' => false,
            'label' => 'coordonnees_contact.prenom',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getTypeType()
    {
        return 'choice';
    }

    public function getTypeOptions()
    {
        return array(
            'required' => false,
            'label' => 'coordonnees_contact.type',
            'choices' => array(
                        'particulier' => 'particulier',
                        'professionnel' => 'professionnel',
                    ),
        );
    }

    public function getAdresseType()
    {
        return 'textarea';
    }

    public function getAdresseOptions()
    {
        return array(
            'required' => false,
            'label' => 'coordonnees_contact.adresse',
        );
    }

    public function getVilleType()
    {
        return 'text';
    }

    public function getVilleOptions()
    {
        return array(
            'required' => false,
            'label' => 'coordonnees_contact.ville',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getCodePostalType()
    {
        return 'text';
    }

    public function getCodePostalOptions()
    {
        return array(
            'required' => false,
            'label' => 'coordonnees_contact.code_postal',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getPaysType()
    {
        return 'text';
    }

    public function getPaysOptions()
    {
        return array(
            'required' => false,
            'label' => 'coordonnees_contact.pays',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getEmailType()
    {
        return 'text';
    }

    public function getEmailOptions()
    {
        return array(
            'required' => false,
            'label' => 'coordonnees_contact.email',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getTelephoneType()
    {
        return 'text';
    }

    public function getTelephoneOptions()
    {
        return array(
            'required' => false,
            'label' => 'coordonnees_contact.telephone',
        );
    }

    public function getFaxType()
    {
        return 'text';
    }

    public function getFaxOptions()
    {
        return array(
            'required' => false,
            'label' => 'coordonnees_contact.fax',
        );
    }

    public function getMessageType()
    {
        return 'textarea';
    }

    public function getMessageOptions()
    {
        return array(
            'required' => false,
            'label' => 'coordonnees_contact.message',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getCreatedAtType()
    {
        return 'datetime';
    }

    public function getCreatedAtOptions()
    {
        return array(
            'required' => false,
            'label' => 'coordonnees_contact.created_at',
            'widget' => 'single_text',
        );
    }

    public function getUpdatedAtType()
    {
        return 'datetime';
    }

    public function getUpdatedAtOptions()
    {
        return array(
            'required' => false,
            'label' => 'coordonnees_contact.updated_at',
            'widget' => 'single_text',
        );
    }

    public function getActiveType()
    {
        return 'checkbox';
    }

    public function getActiveOptions()
    {
        return array(
            'required' => false,
            'label' => 'coordonnees_contact.active',
        );
    }

    public function getSeoTitleType()
    {
        return 'text';
    }

    public function getSeoTitleOptions()
    {
        return array(
            'required' => false,
            'label' => 'coordonnees_contact_i18n.seo_title',
        );
    }

    public function getSeoDescriptionType()
    {
        return 'textarea';
    }

    public function getSeoDescriptionOptions()
    {
        return array(
            'required' => false,
            'label' => 'coordonnees_contact_i18n.seo_description',
        );
    }

    public function getSeoH1Type()
    {
        return 'text';
    }

    public function getSeoH1Options()
    {
        return array(
            'required' => false,
            'label' => 'coordonnees_contact_i18n.seo_h1',
        );
    }

    public function getSeoKeywordsType()
    {
        return 'textarea';
    }

    public function getSeoKeywordsOptions()
    {
        return array(
            'required' => false,
            'label' => 'coordonnees_contact_i18n.seo_keywords',
        );
    }

    public function getActiveLocaleType()
    {
        return 'checkbox';
    }

    public function getActiveLocaleOptions()
    {
        return array(
            'required' => false,
            'label' => 'coordonnees_contact_i18n.active_locale',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', $this->getIdType(), $this->getIdOptions());
        $builder->add('civilite', $this->getCiviliteType(), $this->getCiviliteOptions());
        $builder->add('nom', $this->getNomType(), $this->getNomOptions());
        $builder->add('prenom', $this->getPrenomType(), $this->getPrenomOptions());
        $builder->add('type', $this->getTypeType(), $this->getTypeOptions());
        $builder->add('adresse', $this->getAdresseType(), $this->getAdresseOptions());
        $builder->add('ville', $this->getVilleType(), $this->getVilleOptions());
        $builder->add('code_postal', $this->getCodePostalType(), $this->getCodePostalOptions());
        $builder->add('pays', $this->getPaysType(), $this->getPaysOptions());
        $builder->add('email', $this->getEmailType(), $this->getEmailOptions());
        $builder->add('telephone', $this->getTelephoneType(), $this->getTelephoneOptions());
        $builder->add('fax', $this->getFaxType(), $this->getFaxOptions());
        $builder->add('message', $this->getMessageType(), $this->getMessageOptions());
        $builder->add('created_at', $this->getCreatedAtType(), $this->getCreatedAtOptions());
        $builder->add('updated_at', $this->getUpdatedAtType(), $this->getUpdatedAtOptions());
        $builder->add('active', $this->getActiveType(), $this->getActiveOptions());$builder->add('coordonnees_contactI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\CoordonneesContactI18n',
            'label' => 'coordonnees_contactI18ns',
            'required' => false,
            'languages' => array('fr', 'de'),
            'columns' => array(
                'seo_title' => array_merge(array('type' => $this->getSeoTitleType()), $this->getSeoTitleOptions()),
                'seo_description' => array_merge(array('type' => $this->getSeoDescriptionType()), $this->getSeoDescriptionOptions()),
                'seo_h1' => array_merge(array('type' => $this->getSeoH1Type()), $this->getSeoH1Options()),
                'seo_keywords' => array_merge(array('type' => $this->getSeoKeywordsType()), $this->getSeoKeywordsOptions()),
                'active_locale' => array_merge(array('type' => $this->getActiveLocaleType()), $this->getActiveLocaleOptions()),

            )
        ));


    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cungfoo\Model\CoordonneesContact',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'CoordonneesContact';
    }

} // BaseCoordonneesContactType
