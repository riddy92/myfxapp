@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                        <Currencies></Currencies>
                    <div class="panel-body">

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                        <Rates></Rates>
                    <div class="show-all text-center">
                        <a href="{{ route('rates.history') }}">Show history</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
