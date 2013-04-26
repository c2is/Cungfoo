<?php

namespace Cungfoo\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\Base\BaseCacheGeneratorType;

/**
 * Test class for Additional builder enabled on the 'cache_generator' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type
 */
class CacheGeneratorType extends BaseCacheGeneratorType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->remove('cache_generatorI18ns');
        $builder->remove('created_at');
        $builder->remove('updated_at');
        //$this->getMetadata($options['data_class'])
        //    ->addPropertyConstraint('field1', new Assert\MinLength(5))
        //;
    }
    
    public function getUrlOptions()
    {
        $options = parent::getUrlOptions();
        $options['required'] = true;

        return $options;
    }
    
    public function getCachedAtOptions()
    {
        $options = parent::getCachedAtOptions();
        $options['disabled'] = true;

        return $options;
    }
    
    public function getCacheTimeOptions()
    {
        $options = parent::getCacheTimeOptions();
        $options['attr'] = array(
            'rel' => 'tooltip',
            'title' => 'crud.tooltip.cache.time',
        );

        return $options;
    }

} // CacheGeneratorType
