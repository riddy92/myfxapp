@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Market rates as at {{ date('d/m/Y')}}</div>

                <div class="panel-body">
                     <div class="currency-table">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Currency</th>
                                <th>Buy</th>
                                <th>Sell</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if ($rates)
                                    @foreach($rates as $rate )
                                    <tr>
                                        <td>{{ $rate->currency->short_name }}</td>
                                        <td>{{ $rate->buy_rate }}</td>
                                        <td>{{ $rate->sell_rate }}</td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
