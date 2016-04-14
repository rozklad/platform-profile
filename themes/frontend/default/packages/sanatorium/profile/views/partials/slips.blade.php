@if ( count($slips) )

	
	<table class="table table-striped">
		
		<thead>
			
			<th>{{ trans('sanatorium/shoporders::orders/common.attributes.public_id') }}</th>
			<th>{{ trans('sanatorium/shoporders::orders/common.attributes.created_at') }}</th>
			<th>{{ trans('sanatorium/shoporders::orders/common.attributes.status') }}</th>
			<th></th>

		</thead>
		
		<tbody>
		
			@foreach( $slips as $order )
			
				@if ( $order->status->id == '5' || $order->status->id == '7' )
				<tr>

					<td class="col-xs-2">
						
						<a href="{{ route('sanatorium.shoporders.orders.show', ['id' => $order->id]) }}">
							{{ $order->public_id }}
						</a>

					</td>

					<td class="col-xs-2">{{ $order->created_at->format('j.n.Y') }}</td>

					<td class="col-xs-2">
						<span class="{{ $order->status->css_class }}">
							{{ $order->status->name }}
						</span>
					</td>

					<td class="col-xs-4 text-right">
						
						<a href="{{ route('sanatorium.shoporders.orders.slip', ['id' => $order->id]) }}">
							<i class="ion-document"></i>
							{{ trans('action.show') }}
						</a>

					</td>

				</tr>
				@endif

			@endforeach

		</tbody>

	</table>
	

@else

	<p class="alert alert-info">

		{{ trans('sanatorium/profile::messages.no_orders')}}

	</p>

@endif