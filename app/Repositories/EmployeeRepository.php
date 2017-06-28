<?php

namespace App\Repositories;

use DB;
use App\Repositories\EloquentRepository;
use App\User;
use Carbon\Carbon;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;

class EmployeeRepository extends EloquentRepository implements EmployeeRepositoryInterface
{
    protected $allowedAttributes = ['model'];

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAdminUsers()
    {
        return $this->model->where('role', $this->model::USER_ROLE_ADMIN)->get();
    }

    public function getEmployeeUsers()
    {
        return $this->model->where('role', $this->model::USER_ROLE_EMPLOYEE)->get();
    }

    public function getEmployeesWithBirtheyOn(Carbon $date)
    {
        $birthday_date = '%' . $date->format('-m-d');

        return $this->model
            ->where('role', $this->model::USER_ROLE_EMPLOYEE)
            ->where('birth_date', 'LIKE', $birthday_date)
            ->get();
    }
}
