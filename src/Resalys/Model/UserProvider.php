<?php

namespace Resalys\Model;

use Symfony\Component\Security\Core\User\UserProviderInterface,
    Symfony\Component\Security\Core\User\UserInterface,
    Symfony\Component\Security\Core\User\User,
    Symfony\Component\Security\Core\Exception\UsernameNotFoundException,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class UserProvider implements UserProviderInterface
{
    protected $password;
    protected $factory;

    public function __construct($app)
    {
        $this->password = !empty($_POST['_password']) ? $_POST['_password']: null;
        $this->factory  = $app['security.encoder_factory'];
    }

    public function loadUserByUsername($username)
    {
        if (!$username)
        {
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
        }

        if ($this->password && $this->password != "cesoft")
        {
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
        }

        $user = new User($username, '');
        $encoder = $this->factory->getEncoder($user);
        $password = $encoder->encodePassword($this->password, $user->getSalt());

        return new User($username, $password, array('ROLE_USER'), true, true, true, true);
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
