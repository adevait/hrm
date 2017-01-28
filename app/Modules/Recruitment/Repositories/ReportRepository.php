<?php

namespace App\Modules\Recruitment\Repositories;

use DB;
use App\Repositories\EloquentRepository;
use App\User;
use Carbon\Carbon;
use App\Modules\Recruitment\Repositories\Interfaces\ReportRepositoryInterface;

class ReportRepository extends EloquentRepository implements ReportRepositoryInterface
{
    protected $allowedAttributes = ['model'];
    
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getQry($inputs = array(), $columns = [])
    {
        $filters = [
            ['key' => 'role', 'operator' => '=', 'value' => $this->model::USER_ROLE_CANDIDATE]
        ];

        foreach ($inputs as $key => $value) {
            if(in_array($key, ['first_name', 'last_name', 'email'])) {
                $operator = 'like';
            } elseif($key == 'salary_from') {
                $operator = '>=';
            } elseif($key == 'salary_to') {
                $operator = '<=';
            } else {
                $operator = '=';
            }
            $filters[]=['key' => $key, 'operator' => $operator, 'value' => $value];
        }

        $response = $this->model->whereNull('deleted_at')
            ->where('role', '=', $this->model::USER_ROLE_CANDIDATE);
        foreach ($inputs as $key => $value) {
            switch ($key) {
                case 'first_name':
                case 'last_name':
                case 'email':
                    $response->where($key, 'like', $value.'%');
                    break;
                case 'skills':
                    foreach ($value as $skill) {
                        $response->whereHas('skills', function($query) use ($skill) {
                            $query->where('skill_id', $skill);
                        });
                    }
                    break;
                case 'salary_from':
                    $response->whereHas('user_preferences', function($query) use ($value) {
                        $query->where('salary', '>=', $value);
                    });
                    break;
                case 'salary_to':
                    $response->whereHas('user_preferences', function($query) use ($value) {
                        $query->where('salary', '<=', $value);
                    });
                    break;
                case 'contract_type_id':
                    $response->whereHas('user_preferences', function($query) use ($value) {
                        $query->where('contract_type_id', '=', $value);
                    });
                    break;
                case 'location':
                    $response->whereHas('user_preferences', function($query) use ($value) {
                        $query->where('location', '=', $value);
                    });
                    break;
            }
        }

        if ($columns) {
            return $response->select($columns);
        }

        $response = $response->get();

        return $response;
    }
}
