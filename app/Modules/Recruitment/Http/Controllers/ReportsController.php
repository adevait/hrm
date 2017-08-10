<?php

namespace App\Modules\Recruitment\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Recruitment\Repositories\Interfaces\ReportRepositoryInterface as ReportRepository;
use App\Modules\Settings\Repositories\Interfaces\ContractTypeRepositoryInterface as ContractTypeRepository;
use App\Modules\Settings\Repositories\Interfaces\SkillRepositoryInterface as SkillRepository;
use Datatables;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    private $reportRepository;

    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ContractTypeRepository $contractTypeRepository, SkillRepository $skillRepository, Request $request)
    {
        $allSkills = $skillRepository->getAll()->pluck('name', 'id');
        $contractTypes = $contractTypeRepository->getAll()->pluck('name', 'id');
        $inputs = $request->only(['first_name', 'last_name', 'email', 'skills', 'salary_from', 'salary_to', 'contract_type_id', 'location']);
        $filter = http_build_query($inputs);
        return view('recruitment::reports.index', compact('contractTypes', 'allSkills', 'inputs', 'filter'));
    }

    /**
     * Return data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable(Request $request)
    {
        $inputs = array_filter($request->only(['first_name', 'last_name', 'email', 'skills', 'salary_from', 'salary_to', 'contract_type_id', 'location']));

        return Datatables::of($this->reportRepository->getQry(
                $inputs, 
                ['id', 'first_name', 'last_name', 'email']))
            ->addColumn('phone', function($candidate) {
                return @$candidate->contact->phone;
            })
            ->addColumn('skills', function($candidate) {
                return @implode(', ', $candidate->skills->pluck('name')->toArray());
            })
            ->addColumn('salary', function($candidate) {
                return @format_price($candidate->user_preferences->salary);
            })
            ->addColumn('contract_type', function($candidate) {
                return @$candidate->user_preferences->contractType->name;
            })
            ->addColumn('location', function($candidate) {
                return @get_location_name($candidate->user_preferences->location);
            })
            ->addColumn('comments', function($candidate) {
                return @$candidate->user_preferences->comments;
            })
            ->addColumn('actions', function($employee){
                return view('includes._datatable_actions', [
                    'showUrl' => route('recruitment.reports.show', $employee->id)
                ]);
            })
            ->removeColumn('id')
            ->make();
    }

    public function show($id)
    {
        $candidate = $this->reportRepository->getById($id);
        $breadcrumb = ['title' => $candidate->first_name.' '.$candidate->last_name, 'id' => $candidate->id];
        return view('recruitment::reports.show', compact('candidate', 'breadcrumb'));
    }

    public function download() 
    {
        // $reports = $this->reportRepository->getQry([], ['id' ,'first_name', 'last_name', 'email', 'gender', 'birth_date', 'notes', 'how_did_they_hear'])->get();

        // $columns = ['id', 'deleted_at', 'updated_at', 'created_at', 'user_id'];
        // foreach ($reports as $report) {
        //     $jobs = $report->jobs()->get(['id'])->toArray();
        //     dd($jobs);
        //     if(isset($jobs[0])) {
        //         foreach ($jobs as $key => $value) {
        //             $report[$key] = $value;
        //         }
        //     }
        //     $address = $report->address()->get()->toArray();
        //     if(isset($address[0])) {
        //         foreach ($address[0] as $key => $value) {
        //             $report[$key] = $value;
        //         }
        //     }
        //     $skills = $report->skills()->get()->toArray();
        //     if(isset($skills[0])) {
        //         foreach ($skills[0] as $key => $value) {
        //             $report[$key] = $value;
        //         }
        //     }
        //     $social_accounts = $report->social_accounts()->get()->toArray();
        //     if(isset($social_accounts[0])) {
        //         foreach ($social_accounts[0] as $key => $value) {
        //             $report[$key] = $value;
        //         }
        //     }
        //     $experience = $report->experience()->get()->toArray();
        //     if(isset($experience[0])) {
        //         foreach ($experience[0] as $key => $value) {
        //             $report[$key] = $value;
        //         }
        //     }
        //     $education = $report->education()->get()->toArray();
        //     if(isset($education[0])) {
        //         foreach ($education[0] as $key => $value) {
        //             $report[$key] = $value;
        //         }
        //     }
        //     $languages = $report->languages()->get()->toArray();
        //     if(isset($languages[0])) {
        //         foreach ($languages[0] as $key => $value) {
        //             // if(!in_array($key, $columns)) {
        //             //     $report[$key] = $value;
        //             // }
        //             $report[$key] = $value;
        //         }
        //     }
        // }
        // 
        // $reports = $this->reportRepository->getQry([], ['id' ,'first_name', 'last_name', 'email', 'gender', 'birth_date', 'notes', 'how_did_they_hear'])->get();
        $reports = Datatables::of($this->reportRepository->getQry(
                [], 
                ['id' ,'first_name', 'last_name', 'email', 'gender', 'birth_date', 'notes', 'how_did_they_hear']))
            ->addColumn('phone', function($candidate) {
                return @$candidate->contact->phone;
            })
            ->addColumn('skills', function($candidate) {
                return @implode(', ', $candidate->skills->pluck('name')->toArray());
            })
            ->addColumn('salary', function($candidate) {
                return @format_price($candidate->user_preferences->salary);
            })
            ->addColumn('contract_type', function($candidate) {
                return @$candidate->user_preferences->contractType->name;
            })
            ->addColumn('location', function($candidate) {
                return @get_location_name($candidate->user_preferences->location);
            })
            ->addColumn('comments', function($candidate) {
                return @$candidate->user_preferences->comments;
            })
            ->removeColumn('id');

        dd(json_decode(json_encode($reports), TRUE));
        
        Excel::create('Recruitment report', function($excel) use($reports) {

            $excel->sheet('Report', function($sheet) use($reports) {

                // $sheet->rowsToRepeatAtTop([])
                $sheet->fromArray($reports);

            });

        })->export('xls');
    }
}