

<div class="panel panel-default">

	<div class="panel-heading">{{ trans('sanatorium/profile::common.tabs.addresses') }}</div>

	<div class="panel-body">

		<form method="POST" action="{{ route('user.addresses') }}">

			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="fakturacni-header">
					<h4 class="panel-title">
						<a class="btn-block" role="button" data-toggle="collapse" data-parent="#accordion" href="#fakturacni-udaje" aria-expanded="true" aria-controls="fakturacni-udaje">
							{{ trans('sanatorium/orders::cart.billing.title') }}
						</a>
					</h4>
				</div>
				<div id="fakturacni-udaje" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="fakturacni-header">
					<div class="panel-body">

						<input type="hidden" name="address[fakturacni][label]" value="Fakturační adresa">

						<div class="form-group">
							<div class="col-sm-4">
								<label for="name" class="control-label">{{ trans('sanatorium/orders::cart.billing.name') }}</label>
							</div>
							<div class="col-sm-8">
								<input type="text" class="form-control" value="{{ $primaryAddresses['fakturacni']->name }}" name="address[fakturacni][name]" id="name">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4">
								<label for="street" class="control-label">{{ trans('sanatorium/orders::cart.billing.street') }}</label>
							</div>
							<div class="col-sm-8">
								<input type="text" class="form-control" value="{{ $primaryAddresses['fakturacni']->street }}" name="address[fakturacni][street]" id="street">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4">
								<label for="city" class="control-label">{{ trans('sanatorium/orders::cart.billing.city') }}</label>
							</div>
							<div class="col-sm-8">
								<input type="text" class="form-control" value="{{ $primaryAddresses['fakturacni']->city }}" name="address[fakturacni][city]" id="city">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4">
								<label for="postcode" class="control-label">{{ trans('sanatorium/orders::cart.billing.zip') }}</label>
							</div>
							<div class="col-sm-8">
								<input type="text" class="form-control" value="{{ $primaryAddresses['fakturacni']->postcode }}" name="address[fakturacni][postcode]" id="postcode">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4">
								<label for="country" class="control-label">{{ trans('sanatorium/orders::cart.billing.country') }}</label>
							</div>
							<div class="col-sm-8">
								<input type="text" class="form-control" value="{{ $primaryAddresses['fakturacni']->country }}" name="address[fakturacni][country]" id="fakturacni-country">
							</div>
						</div>

					</div>
				</div>
			 </div>

			 <div class="panel panel-default">
				<div class="panel-heading" role="tab" id="dodaci-header">
					<h4 class="panel-title">
						<a class="btn-block" role="button" data-toggle="collapse" data-parent="#accordion" href="#dodaci-udaje" aria-expanded="true" aria-controls="dodaci-udaje">
							{{ trans('sanatorium/orders::cart.delivery.title') }}
						</a>
					</h4>
				</div>
				<div id="dodaci-udaje" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="dodaci-header">
					<div class="panel-body">

						<input type="hidden" name="address[dodaci][label]" value="Dodací adresa">

						<div class="form-group">
							<div class="col-sm-4">
								<label for="dodaci-name" class="control-label">{{ trans('sanatorium/orders::cart.delivery.name') }}</label>
							</div>
							<div class="col-sm-8">
								<input type="text" class="form-control" value="{{ $primaryAddresses['dodaci']->name }}" name="address[dodaci][name]" id="dodaci-name">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4">
								<label for="dodaci-street" class="control-label">{{ trans('sanatorium/orders::cart.delivery.street') }}</label>
							</div>
							<div class="col-sm-8">
								<input type="text" class="form-control" value="{{ $primaryAddresses['dodaci']->street }}" name="address[dodaci][street]" id="dodaci-street">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4">
								<label for="dodaci-city" class="control-label">{{ trans('sanatorium/orders::cart.delivery.city') }}</label>
							</div>
							<div class="col-sm-8">
								<input type="text" class="form-control" value="{{ $primaryAddresses['dodaci']->city }}" name="address[dodaci][city]" id="dodaci-city">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4">
								<label for="dodaci-postcode" class="control-label">{{ trans('sanatorium/orders::cart.delivery.zip') }}</label>
							</div>
							<div class="col-sm-8">
								<input type="text" class="form-control" value="{{ $primaryAddresses['dodaci']->postcode }}" name="address[dodaci][postcode]" id="dodaci-postcode">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4">
								<label for="dodaci-country" class="control-label">{{ trans('sanatorium/orders::cart.delivery.country') }}</label>
							</div>
							<div class="col-sm-8">
								<input type="text" class="form-control" value="{{ $primaryAddresses['dodaci']->country }}" name="address[dodaci][country]" id="dodaci-country">
							</div>
						</div>
					</div>
				</div>
			 </div>

			 <div class="panel panel-default">
				<div class="panel-heading" role="tab" id="firemni-header">
					<h4 class="panel-title">
						<a class="btn-block" role="button" data-toggle="collapse" data-parent="#accordion" href="#firemni-udaje" aria-expanded="true" aria-controls="firemni-udaje">
							{{ trans('sanatorium/orders::cart.company.title') }}
						</a>
					</h4>
				</div>
				<div id="firemni-udaje" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="firemni-header">
					<div class="panel-body">
						<div class="form-group">
							<div class="col-sm-4">
								<label for="ic" class="control-label">{{ trans('sanatorium/orders::cart.company.ic') }}</label>
							</div>
							<div class="col-sm-8">
								<input type="text" class="form-control" value="{{ $primaryAddresses['fakturacni']->ic }}" name="address[fakturacni][ic]" id="ic">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4">
								<label for="dic" class="control-label">{{ trans('sanatorium/orders::cart.company.dic') }}</label>
							</div>
							<div class="col-sm-8">
								<input type="text" class="form-control" value="{{ $primaryAddresses['fakturacni']->dic }}" name="address[fakturacni][dic]" id="dic">
							</div>
						</div>
					</div>
				</div>
			 </div>

			 <button type="submit" class="btn btn-primary btn-block">
				{{ trans('action.submit') }}
			 </button>

		</form>

	</div>

</div>
