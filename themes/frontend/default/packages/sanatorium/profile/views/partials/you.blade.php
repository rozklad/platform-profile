
@hook('profile.for.you')

<div class="profile-block">
	
	<h2>{{ trans('sanatorium/newsletter::common.title') }}</h2>

	@if ( Cookie::get('has_newsletter') )
		<p class="alert alert-success">
			{{ trans('sanatorium/newsletter::messages.subscribed') }}
		</p>
	@else 
	<form method="POST" action="{{ route('sanatorium.newsletter.subscribe') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="email" name="email" class="form-control" placeholder="{{ trans('sanatorium/newsletter::common.email.placeholder') }}" value="{{ (isset($currentUser) ? $currentUser->email : null) }}">
		<button type="submit" class="btn btn-success">
			{{ trans('sanatorium/newsletter::actions.subscribe') }}
		</button>
	</form>
	@endif

</div>

<div class="row">
	<div class="col-sm-12 text-right">
		<a href="{{ route('user.logout') }}">
			{{ trans('sanatorium/profile::common.actions.logout') }}
		</a>
	</div>
</div>