@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{route('pim.employees.social_media.create', Route::input('employeeId'))}}" class="btn btn-primary pull-right">{{trans('app.pim.employees.external_accounts.add_new')}}</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.employees.external_accounts.main')}}</div>
            <table class="table table-bordered table-hover">
                <thead>
                    <th>{{trans('app.id')}}</th>
                    <th>{{trans('app.pim.employees.external_accounts.account')}}</th>
                    <th></th>
                </thead>
                <tbody>
                    @forelse($accounts as $account)
                        <tr>
                            <td>{{$account->id}}</td>
                            <td><a href="{{$account->url}}">{{get_account_name($account->type)}}</a></td>
                            <td>
                                @include('includes._datatable_actions', [
                                    'deleteUrl' => route('pim.employees.social_media.destroy', [$account->user_id, $account->id]), 
                                    'editUrl' => route('pim.employees.social_media.edit', [$account->user_id, $account->id])
                                ])
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-centered">{{trans('app.no_data')}}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection