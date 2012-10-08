<?php

namespace Resalys\Lib\Client;

use Silex\Application;
use Symfony\Component\Yaml\Yaml;

class AuthClient extends AbstractClient
{
    protected function getName()
    {
        return 'auth';
    }

    protected function getRequests()
    {
        return array(
            'openSession',
        );
    }

    protected function getEnvelopeFormat()
    {
        if (!$this->getOption('customer_login', false))
        {
            throw new \Exception('customer_login parameter does not exist.');
        }

        if (!$this->getOption('customer_password', false))
        {
            throw new \Exception('customer_password parameter does not exist.');
        }

        return array(
            'base_id'           => $this->getOption('base_id', ''),
            'username'          => $this->getOption('username', ''),
            'password'          => $this->getOption('password', ''),
            'customer_login'    => $this->getOption('customer_login', ''),
            'customer_password' => $this->getOption('customer_password', ''),
        );
    }

    public function setCredentials($username, $password)
    {
        $this->addOption('customer_login', $username);
        $this->addOption('customer_password', $password);
    }

    public function getSession()
    {
        $this->addOption('languages', array('fr'));
        $this->parse();

        return $this->data['openSession']['fr'];
    }
}
