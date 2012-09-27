<?php
namespace Cungfoo\Form\Type;

use Symfony\Component\Form\AbstractType,
    Silex\Application;

abstract class AppAwareType extends AbstractType
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function getApplication()
    {
        return $this->app;
    }

    public function setApplication(Application $app)
    {
        $this->app = $app;
    }

    public function getMetadata($class)
    {
        return $this->app['validator.mapping.class_metadata_factory']->getClassMetadata($class);
    }
}