<?php
declare(strict_types=1);

namespace App\Services\User;

use App\Repository\DoctrineUserRepository;

class GetUsersService
{

    public function __construct(private DoctrineUserRepository $userRepository)
    {
    }

    public function __invoke(): array
    {
        return $this->userRepository->getAll();
    }

}