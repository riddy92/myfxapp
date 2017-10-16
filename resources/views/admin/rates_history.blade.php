@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Currency Rate History
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Currency</th>
                                <th>Buy</th>
                                <th>Sell</th>
                            </tr>
                            </thead>
                                <tbody>
                                @if ( $rates )
                                    @foreach($rates as $rate)
                                        <tr>
                                            <td>{{ $rate->date->format('d/m/Y') }}</td>
                                            <td>{{ $rate->currency->short_name }}</td>
                                            <td>{{ $rate->buy_rate }}</td>
                                            <td>{{ $rate->sell_rate }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan="6">No rates added for today.</td>
                                </tr>
                                @endif
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
