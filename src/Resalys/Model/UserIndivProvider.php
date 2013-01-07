<?php

namespace Resalys\Model;

use Symfony\Component\Security\Core\User\UserProviderInterface,
    Symfony\Component\Security\Core\User\UserInterface,
    Symfony\Component\Security\Core\Exception\UsernameNotFoundException,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\Security\Core\User\User,
    Symfony\Component\Security\Core\Exception\UnsupportedUserException;

use Resalys\Lib\Client\AuthIndivClient;

class UserIndivProvider extends UserProvider
{
    protected $app;
    protected $client;
    protected $password;

    public function __construct($app)
    {
        $this->app = $app;
        $this->client      = new AuthIndivClient($app['config']->get('root_dir'));
        $this->password    = !empty($_POST['_password']) ? $_POST['_password']: null;
    }
}
