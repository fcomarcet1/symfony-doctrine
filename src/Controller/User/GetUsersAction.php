<?php
declare(strict_types=1);

namespace App\Controller\User;

use App\Controller\ApiController;
use App\Entity\User;
use App\Http\Response\ApiResponse;
use App\Services\User\GetUsersService;


class GetUsersAction extends ApiController
{
    public function __construct(private GetUsersService $getUsersService)
    {
    }

    public function __invoke(): ApiResponse
    {
        $users = $this->getUsersService->__invoke();

        $result = array_map(static function (User $user) {
            return $user->toArray();
        }, $users);

        return $this->createResponse(['users' => $result], ApiResponse::HTTP_OK);

    }

}