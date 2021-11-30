<?php
declare(strict_types=1);

namespace App\Controller\User;

use App\Controller\ApiController;
use App\Http\Response\ApiResponse;
use App\Services\User\UpdateUserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class UpdateUserAction extends ApiController
{
    private UpdateUserService $updateUserService;

    public function __construct(UpdateUserService $updateUserService)
    {
        $this->updateUserService = $updateUserService;
    }


    /**
     * @throws \JsonException
     */
    public function __invoke(Request $request, string $id): ApiResponse
    {
        $data = \json_decode(
            $request->getContent(),
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        $user = ($this->updateUserService)($id, $data['name']);
        //$user = $this->updateUserService->__invoke($id, $data['name']);

        return $this->createResponse(['user' => $user->toArray()], ApiResponse::HTTP_CREATED);

    }
}
