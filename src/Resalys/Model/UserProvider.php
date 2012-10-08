<?php

namespace Resalys\Model;

use Symfony\Component\Security\Core\User\UserProviderInterface,
    Symfony\Component\Security\Core\User\UserInterface,
    Symfony\Component\Security\Core\Exception\UsernameNotFoundException,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\Security\Core\User\User,
    Symfony\Component\Security\Core\Exception\UnsupportedUserException;

use Resalys\Lib\Client\AuthClient;

class UserProvider implements UserProviderInterface
{
    protected $app;
    protected $client;
    protected $password;

    public function __construct($app)
    {
        $this->app = $app;
        $this->client      = new AuthClient($app['config']->get('root_dir'));
        $this->password    = !empty($_POST['_password']) ? $_POST['_password']: null;
    }

    public function loadUserByUsername($username)
    {
        $user = null;

        if (!$username)
        {
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
        }

        if ($this->password)
        {
            $this->client->setCredentials($username, $this->password);

            try
            {
                $this->app['session']->set('resalys_user', $this->client->getSession());
            }
            catch (\Exception $exception)
            {
                throw new UsernameNotFoundException('Username / Password not found.');
            }

            if (!$this->app['session']->get('resalys_user'))
            {
                throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
            }
        }

        return new User($username, $this->password, array('ROLE_USER'), true, true, true, true);
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User)
        {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'Symfony\Component\Security\Core\User\User';
    }
}
