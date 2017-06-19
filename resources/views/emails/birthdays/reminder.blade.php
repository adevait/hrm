
@extends('layouts.mail')

@section('content')

<!-- CTA Button Text Definition -->
<?php $action_text = isset($action_text) ? $action_text : trans('emails.generic.reminder.action_text'); ?>

<table style="{{ $style['email-body_inner'] }}" align="center" width="570" cellpadding="0" cellspacing="0">
    <tr>
        <td style="{{ $fontFamily }} {{ $style['email-body_cell'] }}">
            <!-- Greeting -->
            <h1 style="{{ $style['header-1'] }}">
                {{trans('emails.birthdays.reminder.greetings', ['name' => $admin->name])}}
            </h1>

            <!-- Intro -->
            <p style="{{ $style['paragraph'] }}"> 
                {{trans('emails.birthdays.reminder.intro', ['date' => $date->format('d/m/Y')])}}
            </p>

            <p style="{{ $style['paragraph'] }}"> 
            @foreach ($employees as $employee)
                {{ $employee->name }} <label style="{{ $style['label-small'] }}">({{ $employee->email }})</label> <br>
            @endforeach
            </p>

            <!-- Outro -->
            <p style="{{ $style['paragraph'] }}"> 
                {{trans('emails.birthdays.reminder.outro')}}
            </p>

            <!-- Salutation -->
            <p style="{{ $style['paragraph'] }}">
                {{ trans('emails.birthdays.reminder.salutation') }} <br> {{ config('app.name') }}
            </p>
        </td>
    </tr>
</table>
@endsection
