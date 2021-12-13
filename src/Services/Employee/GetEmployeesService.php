<?php
declare(strict_types=1);

namespace App\Services\Employee;

use App\Repository\DoctrineEmployeeRepository;

class GetEmployeesService
{

    public function __construct(private DoctrineEmployeeRepository $employeeRepository)
    {
    }



    public function __invoke(): array
    {
        return $this->employeeRepository->getAll();
    }

}