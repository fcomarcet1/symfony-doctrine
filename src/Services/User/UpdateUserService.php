<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Entity\User;
use App\Repository\DoctrineUserRepository;

class UpdateUserService
{
    private DoctrineUserRepository $doctrineUserRepository;

    public function __construct(DoctrineUserRepository $doctrineUserRepository)
    {
        $this->doctrineUserRepository = $doctrineUserRepository;
    }

    public function __invoke(string $id, string $name): User
    {
        if (null !== $user = $this->doctrineUserRepository->findOneByIdWithPlainSQL($id)) {
            $user->setName($name);
            $this->doctrineUserRepository->save($user);
        }
        return $user;
    }
}
