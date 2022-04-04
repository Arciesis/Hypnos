<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class Admin implements UserInterface, PasswordAuthenticatedUserInterface
{
    use UserTrait;
}
