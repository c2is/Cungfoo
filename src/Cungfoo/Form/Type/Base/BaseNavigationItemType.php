<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'navigation_item' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseNavigationItemType extends AppAwareType
{
    public function getIdType()
    {
        return 'hidden';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'navigation_item.id',
        );
    }

    public function getParentType()
    {
        return 'model';
    }

    public function getParentOptions()
    {
        return array(
            'required' => false,
            'label' => 'navigation_item.parent_id',
            'class' => 'Cungfoo\Model\NavigationItem',
        );
    }

    public function getNavigationType()
    {
        return 'model';
    }

    public function getNavigationOptions()
    {
        return array(
            'required' => false,
            'label' => 'navigation_item.navigation_id',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
            'class' => 'Cungfoo\Model\Navigation',
        );
    }

    public function getSortableRankType()
    {
        return 'integer';
    }

    public function getSortableRankOptions()
    {
        return array(
            'required' => false,
            'label' => 'navigation_item.sortable_rank',
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
            'label' => 'navigation_item.created_at',
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
            'label' => 'navigation_item.updated_at',
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
            'label' => 'navigation_item.active',
        );
    }

    public function getTitleType()
    {
        return 'text';
    }

    public function getTitleOptions()
    {
        return array(
            'required' => false,
            'label' => 'navigation_item_i18n.title',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getPathType()
    {
        return 'text';
    }

    public function getPathOptions()
    {
        return array(
            'required' => false,
            'label' => 'navigation_item_i18n.path',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
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
            'label' => 'navigation_item_i18n.seo_title',
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
            'label' => 'navigation_item_i18n.seo_description',
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
            'label' => 'navigation_item_i18n.seo_h1',
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
            'label' => 'navigation_item_i18n.seo_keywords',
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
            'label' => 'navigation_item_i18n.active_locale',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', $this->getIdType(), $this->getIdOptions());
        $builder->add('parent', $this->getParentType(), $this->getParentOptions());
        $builder->add('navigation', $this->getNavigationType(), $this->getNavigationOptions());
        $builder->add('sortable_rank', $this->getSortableRankType(), $this->getSortableRankOptions());
        $builder->add('created_at', $this->getCreatedAtType(), $this->getCreatedAtOptions());
        $builder->add('updated_at', $this->getUpdatedAtType(), $this->getUpdatedAtOptions());
        $builder->add('active', $this->getActiveType(), $this->getActiveOptions());$builder->add('navigation_itemI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\NavigationItemI18n',
            'label' => 'navigation_itemI18ns',
            'required' => false,
            'languages' => array('fr', 'de'),
            'columns' => array(
                'title' => array_merge(array('type' => $this->getTitleType()), $this->getTitleOptions()),
                'path' => array_merge(array('type' => $this->getPathType()), $this->getPathOptions()),
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
            'data_class' => 'Cungfoo\Model\NavigationItem',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'NavigationItem';
    }

} // BaseNavigationItemType
