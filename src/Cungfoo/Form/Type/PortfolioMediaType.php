<?php

namespace Cungfoo\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\FormView,
    Symfony\Component\Form\FormInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\Base\BasePortfolioMediaType;

/**
 * Test class for Additional builder enabled on the 'portfolio_media' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type
 */
class PortfolioMediaType extends BasePortfolioMediaType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        //$this->getMetadata($options['data_class'])
        //    ->addPropertyConstraint('field1', new Assert\MinLength(5))
        //;
    }

    public function getFileType()
    {
        return 'hidden';
    }

    public function getWidthType()
    {
        return 'hidden';
    }

    public function getHeightType()
    {
        return 'hidden';
    }

    public function getSizeType()
    {
        return 'hidden';
    }

    public function getActiveType()
    {
        return 'hidden';
    }

    public function getSeoTitleType()
    {
        return 'hidden';
    }

    public function getSeoDescriptionType()
    {
        return 'hidden';
    }

    public function getSeoH1Type()
    {
        return 'hidden';
    }

    public function getSeoKeywordsType()
    {
        return 'hidden';
    }

    public function getActiveLocaleType()
    {
        return 'hidden';
    }

    /**

                'seo_title' => array_merge(array('type' => $this->getSeoTitleType()), $this->getSeoTitleOptions()),
                'seo_description' => array_merge(array('type' => $this->getSeoDescriptionType()), $this->getSeoDescriptionOptions()),
                'seo_h1' => array_merge(array('type' => $this->getSeoH1Type()), $this->getSeoH1Options()),
                'seo_keywords' => array_merge(array('type' => $this->getSeoKeywordsType()), $this->getSeoKeywordsOptions()),
                'active_locale' => array_merge(array('type' => $this->getActiveLocaleType()), $this->getActiveLocaleOptions()),
    */
} // PortfolioMediaType
