<?php

namespace Resalys\Lib\Client;

use Silex\Application;
use Symfony\Component\Yaml\Yaml;

class AuthIndivClient extends AuthClient
{
    protected function getName()
    {
        return 'auth_indiv';
    }
}
