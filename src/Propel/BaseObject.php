<?php

namespace Propel;

use \BaseObject as BaseObjectDefault;

class BaseObject extends BaseObjectDefault
{
    public function __construct()
    {
        if (defined('CURRENT_LANGUAGE'))
        {
            $this->currentLocale = CURRENT_LANGUAGE;
        }

        parent::__construct();
    }
}
