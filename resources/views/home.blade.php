
@extends('layouts.app') @section('content')
<div class="content-container">
	<div class="content-row">
		<div class="col">
			<div class="rates-panel-body">
				<div class="rates-panel-heading"> Naira (&#8358;) market rates {{ date('d/m/Y')}}</div>

				<div class="rates-body">
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
								@if ($ratesToday) 
									@foreach($ratesToday as $rate )
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

    <div class="content-row">
            <div class = "text_wrapper">
                <p>
                    JustFX provides live Naira (&#8358;) parallel market rates. The accuracy of information is our number 1 priority. To contact us, please email info@justfx.me
                </p>
            </div>
    </div>

    {{--  Rates for the last 3 days  --}}
    <div class="content-row">
		<div class="col">
			<div class="rates-panel-body">
				<div class="rates-panel-heading">Naira (&#8358;) rates previous 3 days </div>

                <div class="rates-body">
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
								@if ($ratesPrevious)
                                    @foreach($ratesPrevious as $date => $rates )
                                        <tr>
                                            <td class="date-data"  colspan="3">{{ $date }}</td>
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