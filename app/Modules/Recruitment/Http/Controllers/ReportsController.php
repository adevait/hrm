<?php

namespace App\Modules\Recruitment\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Recruitment\Repositories\Interfaces\ReportRepositoryInterface as ReportRepository;
use App\Modules\Settings\Repositories\Interfaces\ContractTypeRepositoryInterface as ContractTypeRepository;
use App\Modules\Settings\Repositories\Interfaces\SkillRepositoryInterface as SkillRepository;
use App\Modules\Pim\Repositories\Interfaces\CandidateRepositoryInterface as CandidateRepository;
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

    public function download(CandidateRepository $candidateRepository) 
    {
        $reports = Datatables::collection($this->reportRepository->getCollection([[
                'key' => 'role',
                'operator' => '=',
                'value' => $candidateRepository->model::USER_ROLE_CANDIDATE
            ]], ['id' ,'first_name', 'last_name', 'email', 'gender', 'birth_date', 'notes', 'how_did_they_hear'])->get())
            ->addColumn('phone', function($candidate) {
                return @$candidate->contact->phone;
            })
            ->addColumn('address', function($candidate) {
                return @$candidate->address->street_1 . ' ' . @$candidate->address->city . ' ' . @$candidate->address->country;
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
            ->addColumn('social_accounts', function($candidate) {
                return @implode(', ', $candidate->social_accounts->pluck('url')->toArray());
            })
            ->addColumn('education_major', function($candidate) {
                return @implode(', ', $candidate->education->pluck('major')->toArray());
            })
            ->addColumn('comments', function($candidate) {
                return @$candidate->user_preferences->comments;
            })
            ->removeColumn('id')
            ->make(true);

        $reports = $reports->getData(true)['data'];

        Excel::create('Recruitment report', function($excel) use($reports) {

            $excel->sheet('Report', function($sheet) use($reports) {

                $sheet->fromArray($reports);

            });

        })->export('xls');
    }
}