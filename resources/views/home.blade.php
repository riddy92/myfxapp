@extends('layouts.app') @section('content')
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
								@if ($ratesToday) @foreach($ratesToday as $rate )
								<tr>
									<td>{{ $rate->currency->short_name }}</td>
									<td>{{ $rate->buy_rate }}</td>
									<td>{{ $rate->sell_rate }}</td>
								</tr>
								@endforeach @endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

    {{--  Rates for the last 3 days  --}}
    <div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Previous days rates</div>

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
								@if ($ratesPrevious)
                                    @foreach($ratesPrevious as $date => $rates )
                                        <tr>
                                            <td colspan="3">{{ $date }}</td>
                                        </tr>
                                        @foreach ($rates as $rate)
                                        <tr>
                                            <td>{{ $rate->currency->short_name }}</td>
                                            <td>{{ $rate->buy_rate }}</td>
                                            <td>{{ $rate->sell_rate }}</td>
                                        </tr>
                                        @endforeach
								    @endforeach
                                @endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	@endsection