
@extends('layouts.app') @section('content')
<div class="content-container">
	<div class="content-row">
		<div class="col">
			<div class="rates-panel-body">
				<div class="rates-panel-heading">Market rates as at {{ date('d/m/Y')}}</div>

				<div class="rates-panel-body">
					<div class="currency-table">
						<table class="rates-table">
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

    <div class="col">
            <div class = "text_wrapper">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi in est tortor. Aliquam non libero ut mi rhoncus faucibus eu in eros. Aliquam interdum vulputate libero in tristique. Donec venenatis feugiat nunc mattis tempor. Ut laoreet, purus ac volutpat fermentum, eros quam luctus justo, cursus consectetur orci lorem eu purus. 
                </p>
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