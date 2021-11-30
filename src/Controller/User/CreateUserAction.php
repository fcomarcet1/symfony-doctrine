<?php
declare(strict_types=1);

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class CreateUserAction extends AbstractController
{
    public function __construct()
    {
    }

    public function __invoke(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new CreateUserAction!'
        ]);
    }
}
