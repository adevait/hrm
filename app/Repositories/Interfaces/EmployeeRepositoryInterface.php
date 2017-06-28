<?php

namespace App\Repositories\Interfaces;

use Carbon\Carbon;

/**
 * EmployeeRepositoryInterface defines the functions that every
 * concrete repository implementation MUST have in order to not
 * break the system workflow. 
 */
interface EmployeeRepositoryInterface
{
    /**
     * This method SHOULD return the collection of admin users 
     * in the database.
     * 
     * @return Illuminate\Support\Collection
     */
    public function getAdminUsers();

    /**
     * This method SHOULD return the collection of employees 
     * users in the database.
     * 
     * @return Illuminate\Support\Collection
     */
    public function getEmployeeUsers();

    /**
     * This method SHOULD return the collection of employees
     * that have the birth date on the date given as parameter.
     * 
     * @param  Carbon\Carbon $date The date to use as reference.
     * 
     * @return Illuminate\Support\Collection
     */
    public function getEmployeesWithBirtheyOn(Carbon $date);
}
