<?php

namespace App\Security;

use App\Exception\AccountDeletedException;
use App\Entity\User as AppUser;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\DisabledException;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }

        if (!$user->getIsActif())  {
            throw new DisabledException("....");
        }elseif ($user->getPartenaire() != null && !$user->getPartenaire()->getIsActive())  {
           // dd($user->getPartenaire()->getIsActive());
            throw new DisabledException(".....");
        }

        // user is deleted, show a generic Account Not Found message.
       /* if ($user->isDeleted()) {
            throw new AccountDeletedException('...');
        }*/
    }

    public function checkPostAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }


        // user account is expired, the user may be notified
      /*  if ($user->isExpired()) {
            throw new AccountExpiredException('...');
        }*/
    }
}