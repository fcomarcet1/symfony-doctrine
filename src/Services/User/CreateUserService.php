<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Entity\User;
use App\Repository\DoctrineUserRepository;

class CreateUserService
{
    private DoctrineUserRepository $doctrineUserRepository;

    public function __construct(DoctrineUserRepository $doctrineUserRepository)
    {
        $this->doctrineUserRepository = $doctrineUserRepository;
    }

    public function __invoke(string $name, string $email): User
    {
        $user = new User($name, $email);
        $this->doctrineUserRepository->save($user);

        return $user;
    }
}
