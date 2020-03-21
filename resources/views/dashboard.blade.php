@extends('layouts.app')

    

@section('content')

    @include('layouts.headers.cards')

    @if(  Auth::user()->role == 'admin'  )
        @include('schedule.dashboard.adminDashboard')
    @elseif(  Auth::user()->role == 'engineer' )
        @include('schedule.dashboard.engineerSchedule')
    @elseif(  Auth::user()->role == 'accountant' )
        @include('schedule.dashboard.accountantSchedule')
    @elseif(  Auth::user()->role == 'employee' )
        @include('schedule.dashboard.employeeSchedule')
    @endif

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush