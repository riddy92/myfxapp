@extends('layouts.app')

@section('content')
    <div class="content-container">
        <div class="content-row">
            <div class="col">
                <div class="rates-panel-body">
                    <div class="rates-panel-heading">
                        Currency Rate History
                    </div>
                    <div class="rates-panel-body">
                        <table class="rates-table">
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
