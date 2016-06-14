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

	<p class="alert alert-info">

		{{ trans('sanatorium/profile::messages.no_orders')}}

	</p>

@endif

<?php /*
@foreach( $items as $item )
						<?php $product = Product::find($item->get('id')); ?>
						@if ( is_object($product) )
						<tr class="product-row" data-id="{{ $item->get('id') }}" data-rowid="{{ $item->get('rowId') }}">
							<td class="text-center">
								@if ( $product->has_cover_image )
									<a href="{{ $product->url }}" target="_blank">
										<img src="{{ $product->coverThumb(60,60) }}" alt="{{ $product->product_title }}" width="60" height="60">
									</a>
								@else
									{{ $item->get('id') }}
								@endif
							</td>
							<td class="col-xs-4">
								<a href="{{ $product->url }}" target="_blank">{{ $product->product_title }}</a> <span class="text-muted">({{ $product->code }})</span>
							</td>
							<td class="text-right">
								{{-- Price one --}}
								{{ $product->getPrice('vat', 1) }}
							</td>
							<td class="text-right">
								<span class="total-price-item" data-price-type="vat_quantity">
									{{-- Price item quantity --}}
									{{ $product->getPrice('vat', $item->quantity()) }}
								</span>
							</td>
						</tr>
						@endif
					@endforeach
*/