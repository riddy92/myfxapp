@extends('layouts.app')

@section('content')
    <div class="dash-container">
        <div class="dash-row">
            <div class="dash-col">
                <div class="rates-panel-body">
                        <Currencies>
                        </Currencies>
                    <div>

                    </div>
                </div>
            </div>
            <div class="dash-col">
                <div class="rates-panel-body">
                        <Rates></Rates>
                    <div class="show-all text-center">
                        <a href="{{ route('rates.history') }}">Show history</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
