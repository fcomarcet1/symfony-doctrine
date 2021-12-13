<?php
declare(strict_types=1);

namespace App\Controller\Employee;


use App\Controller\ApiController;
use App\Entity\Employee;
use App\Http\Response\ApiResponse;
use App\Services\Employee\GetEmployeesService;

class GetEmployeesAction extends ApiController
{
    public function __construct(private GetEmployeesService $getEmployeesService)
    {
    }

    public function __invoke(): ApiResponse
    {
        $employees = $this->getEmployeesService->__invoke();

        $result = array_map(static function (Employee $employee) {
            return $employee->toArray();
        }, $employees);

        return $this->createResponse($result, ApiResponse::HTTP_OK);
    }

}