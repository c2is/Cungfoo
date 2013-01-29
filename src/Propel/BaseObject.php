<?php

namespace Propel;

use \BaseObject as BaseObjectDefault;

class BaseObject extends BaseObjectDefault
{
    public function __construct()
    {
        try
        {
            global $app;

            $this->currentLocale = $app['context']->get('language');
        }
        catch (\Exception $e) {}

        parent::__construct();
    }
}
