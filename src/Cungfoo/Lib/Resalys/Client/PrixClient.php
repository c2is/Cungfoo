<?php

namespace Cungfoo\Lib\Resalys\Client;

use Silex\Application;
use Symfony\Component\Yaml\Yaml;

class PrixClient extends BaseClient
{
    protected function getRequests()
    {
        return array(
            'getFlowProposals',
        );
    }

    protected function getEnvelopeFormat()
    {
        return array(
            // some options
        );
    }
}
