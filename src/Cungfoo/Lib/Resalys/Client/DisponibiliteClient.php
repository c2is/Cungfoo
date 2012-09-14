<?php

namespace Cungfoo\Lib\Resalys\Client;

use Silex\Application;
use Symfony\Component\Yaml\Yaml;

class DisponibiliteClient extends BaseClient
{
    protected function getRequests()
    {
        return array(
            'getProposals65',
        );
    }

    protected function getEnvelopeFormat()
    {
        return array(
            // some options
        );
    }
}
