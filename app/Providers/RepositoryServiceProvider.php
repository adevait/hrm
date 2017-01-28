<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Settings as Settings;
use App\Modules\Pim as Pim;
use App\Modules\Leave as Leave;
use App\Modules\Recruitment as Recruitment;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $bindings = [
            Settings\Repositories\CompanyRepository::class => [Settings\Repositories\Interfaces\CompanyRepositoryInterface::class],
            Settings\Repositories\ContractTypeRepository::class => [Settings\Repositories\Interfaces\ContractTypeRepositoryInterface::class],
            Settings\Repositories\JobPositionRepository::class => [Settings\Repositories\Interfaces\JobPositionRepositoryInterface::class],
            Settings\Repositories\EducationInstitutionRepository::class => [Settings\Repositories\Interfaces\EducationInstitutionRepositoryInterface::class],
            Settings\Repositories\LanguageRepository::class => [Settings\Repositories\Interfaces\LanguageRepositoryInterface::class],
            Settings\Repositories\SkillRepository::class => [Settings\Repositories\Interfaces\SkillRepositoryInterface::class],
            Settings\Repositories\SalaryComponentsRepository::class => [Settings\Repositories\Interfaces\SalaryComponentsRepositoryInterface::class],
            Pim\Repositories\EmployeeRepository::class => [Pim\Repositories\Interfaces\EmployeeRepositoryInterface::class],
            Pim\Repositories\CandidateRepository::class => [Pim\Repositories\Interfaces\CandidateRepositoryInterface::class],
            Pim\Repositories\EmployeeSocialMediaRepository::class => [Pim\Repositories\Interfaces\EmployeeSocialMediaRepositoryInterface::class],
            Pim\Repositories\EmployeeContactDetailsRepository::class => [Pim\Repositories\Interfaces\EmployeeContactDetailsRepositoryInterface::class],
            Pim\Repositories\EmployeeWorkExperienceRepository::class => [Pim\Repositories\Interfaces\EmployeeWorkExperienceRepositoryInterface::class],
            Pim\Repositories\EmployeeSkillRepository::class => [Pim\Repositories\Interfaces\EmployeeSkillRepositoryInterface::class],
            Pim\Repositories\EmployeeEducationRepository::class => [Pim\Repositories\Interfaces\EmployeeEducationRepositoryInterface::class],
            Pim\Repositories\EmployeeLanguageRepository::class => [Pim\Repositories\Interfaces\EmployeeLanguageRepositoryInterface::class],
            Pim\Repositories\EmployeeSalaryRepository::class => [Pim\Repositories\Interfaces\EmployeeSalaryRepositoryInterface::class],
            Pim\Repositories\EmployeePreferencesRepository::class => [Pim\Repositories\Interfaces\EmployeePreferencesRepositoryInterface::class],
            Pim\Repositories\SalariesSalaryComponentsRepository::class => [Pim\Repositories\Interfaces\SalariesSalaryComponentsRepositoryInterface::class],
            Leave\Repositories\LeaveTypeRepository::class => [Leave\Repositories\Interfaces\LeaveTypeRepositoryInterface::class],
            Leave\Repositories\HolidayRepository::class => [Leave\Repositories\Interfaces\HolidayRepositoryInterface::class],
            Leave\Repositories\EmployeeLeaveRepository::class => [Leave\Repositories\Interfaces\EmployeeLeaveRepositoryInterface::class],
            Leave\Repositories\EmployeeLeaveStatusRepository::class => [Leave\Repositories\Interfaces\EmployeeLeaveStatusRepositoryInterface::class],
            Recruitment\Repositories\ReportRepository::class => [Recruitment\Repositories\Interfaces\ReportRepositoryInterface::class]

        ];

        foreach ($bindings as $concrete => $interfaces) {
            foreach ($interfaces as $interface) {
                $this->app->bind($interface, $concrete);
            }
        }
    }
}
