<?php

namespace Resalys\Lib\Client;

use Silex\Application;
use Symfony\Component\Yaml\Yaml;

class DisponibiliteClient extends AbstractClient
{
    protected function getName()
    {
        return 'disponibilite';
    }

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