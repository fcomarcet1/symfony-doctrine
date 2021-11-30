<?php
declare(strict_types=1);

namespace App\Controller\User;

use App\Controller\ApiController;
use App\Http\Response\ApiResponse;
use App\Services\User\CreateUserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CreateUserAction extends ApiController
{
    private CreateUserService $createUserService;

    public function __construct(CreateUserService $createUserService)
    {
        $this->createUserService = $createUserService;
    }

    /**
     * @throws \JsonException
     */
    public function __invoke(Request $request): ApiResponse
    {
        // Get data from request
        $data = json_decode(
            $request->getContent(),
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        $user = ($this->createUserService)($data['name'], $data['email']);
        //$user = $this->createUserService->__invoke($data['name'], $data['email']);

        return $this->createResponse(['user' => $user->toArray()], ApiResponse::HTTP_CREATED);
    }
}
