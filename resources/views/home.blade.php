@extends('layouts.mantis')

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
@endsection
