
@hook('profile.for.you')

<div class="panel panel-default">

	<div class="panel-heading">{{ trans('sanatorium/profile::common.tabs.you') }}</div>

	<div class="panel-body">

		<h4>{{ trans('sanatorium/profile::common.headlines.newsletter') }}</h4>

		@if ( Cookie::get('has_newsletter') )
			<p class="alert alert-success">
				{{ trans('sanatorium/newsletter::messages.subscribed') }}
			</p>
		@else
		<form method="POST" action="{{ route('sanatorium.newsletter.subscribe') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="form-group">
				<input type="email" name="email" class="form-control" placeholder="{{ trans('sanatorium/newsletter::common.email.placeholder') }}" value="{{ (isset($currentUser) ? $currentUser->email : null) }}">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">
				{{ trans('sanatorium/newsletter::actions.subscribe') }}
				</button>
			</div>
		</form>
		@endif

		<h4>{{ trans('sanatorium/profile::common.headlines.account') }}</h4>

		<div class="row">
			<div class="col-sm-12">
				<a href="{{ route('user.logout') }}">
					{{ trans('sanatorium/profile::common.actions.logout') }}
				</a>
			</div>
		</div>

	</div>

</div>
