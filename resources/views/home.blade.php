{{-- @extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }} <a href="{{ route('client') }}">Jelajahi</a>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection --}}

@extends('layouts.mantis')

@section('content')
    <div class="row mt-4">
        @php
            $role = auth()->user()->role->role_name;
        @endphp

        @if ($role == 'superadmin')
            @include('superadmindashboard')
        @elseif ($role == 'venue')
            @include('adminvenuedashboard')
        @else
            @include('userdashboard')
        @endif
    </div>
@endsection
