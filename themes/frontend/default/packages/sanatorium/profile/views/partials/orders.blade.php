<div class="panel panel-default">

	<div class="panel-heading">{{ trans('sanatorium/profile::common.tabs.orders') }}</div>

	<div class="panel-body">

		@if ( count($orders) )


			<table class="table table-striped">

				<thead>

					<th>{{ trans('sanatorium/orders::orders/common.attributes.public_id') }}</th>
					<th>{{ trans('sanatorium/orders::orders/common.attributes.created_at') }}</th>
					<th>{{ trans('sanatorium/orders::orders/common.attributes.price') }}</th>
					<th>{{ trans('sanatorium/orders::orders/common.attributes.status') }}</th>
					<th></th>

				</thead>

				<tbody>

					@foreach( $orders as $order )

						<tr>

							<td class="col-xs-2">

								<a href="{{ route('sanatorium.orders.orders.show', ['id' => $order->id]) }}">
									{{ $order->public_id }}
								</a>

							</td>

							<td class="col-xs-2">{{ $order->created_at->format('j.n.Y') }}</td>

							<td class="col-xs-2">{{ $order->price_vat }}</td>

							<td class="col-xs-2">
								<span class="{{ $order->status->css_class }}">
									{{ $order->status->name }}
								</span>
							</td>

							<td class="col-xs-4 text-right">

								<a href="{{ route('sanatorium.orders.orders.track', ['id' => $order->id]) }}">
									<i class="fa fa-truck"></i>
									{{ trans('sanatorium/orders::cart.actions.track') }}
								</a>

								&nbsp;

								<a href="{{ route('sanatorium.orders.orders.show', ['id' => $order->id]) }}">
									<i class="ion-document"></i>
									{{ trans('action.show') }}
								</a>

							</td>

						</tr>

					@endforeach

				</tbody>

			</table>


		@else

			<p class="alert alert-info text-center">

				{{ trans('sanatorium/profile::messages.no_orders')}}

			</p>

		@endif

	</div>

</div>