<?php

namespace Cungfoo;

use Silex\Application as BaseApplication;

class Application extends BaseApplication
{
    use \Silex\Application\TranslationTrait;
    use \Silex\Application\TwigTrait;
    use \Silex\Application\UrlGeneratorTrait;
    use \Silex\Application\MonologTrait;
    use \Silex\Application\SecurityTrait;
    use \Silex\Route\SecurityTrait;
}
