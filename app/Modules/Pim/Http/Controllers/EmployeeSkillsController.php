<?php

namespace App\Modules\Pim\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Settings\Repositories\Interfaces\SkillRepositoryInterface as SkillRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeSkillRepositoryInterface as EmployeeSkillRepository;
use Illuminate\Http\Request;

class EmployeeSkillsController extends Controller
{
    private $skillRepository;
    private $employeeSkillRepository;

    public function __construct(
            SkillRepository $skillRepository,
            EmployeeSkillRepository $employeeSkillRepository
        )
    {
        $this->skillRepository = $skillRepository;
        $this->employeeSkillRepository = $employeeSkillRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($employeeId, Request $request)
    {
        $this->employeeSkillRepository->deleteByColumn('user_id', $employeeId);
        $skills = (array)$request->input('skills');
        foreach ($skills as $key => $value) {
            $skill = $this->skillRepository->getByMany(['name' => $value])->first();
            if(!$skill) {
                $skill = $this->skillRepository->create(['name' => $value]);
            }
            $this->employeeSkillRepository->create(['user_id' => $employeeId, 'skill_id' => $skill->id]);
        }
        return redirect()->route('pim.employees.qualifications.index', [$employeeId]);
    }
}