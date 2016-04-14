<div class="profile-head hidden text-center">
	<h1>Your profile</h1>
	<h2>{{ $user->first_name }} {{ $user->last_name }}</h2>
</div>

<div class="tab-panel">

	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="you {{ (isset($active) && $active == 'profile' ? 'active' : null) }}">
			<a href="#you" aria-controls="you" role="tab" data-toggle="tab">
				{{ trans('sanatorium/profile::common.tabs.you') }}
			</a>
		</li>
		<li role="presentation">
			<a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">
				{{ trans('sanatorium/profile::common.tabs.basic') }}
			</a>
		</li>
		<li role="presentation" class="tab-account tab-account-addresses {{ (isset($active) && $active == 'addresses' ? 'active' : null) }}">
			<a href="{{ route('user.addresses') }}" aria-controls="addresses" role="tab">
				{{ trans('sanatorium/profile::common.tabs.addresses') }}
			</a>
		</li>
		<li role="presentation" class="tab-account tab-account-orders {{ (isset($active) && $active == 'orders' ? 'active' : null) }}">
			<a href="{{ route('user.orders') }}" aria-controls="orders" role="tab">
				{{ trans('sanatorium/profile::common.tabs.orders') }}
			</a>
		</li>
		@if( config('sanatorium-shoporders.show_slips') )
		<li role="presentation tab-account tab-account-slips {{ (isset($active) && $active == 'slips' ? 'active' : null) }}">
			<a href="{{ route('user.slips') }}" aria-controls="slips" role="tab">
				{{ trans('sanatorium/profile::common.tabs.slips') }}
			</a>
		</li>
		@endif

		@hook('profile.tabs.nav')
	</ul>

	<!-- Tab panes -->
  	<div class="tab-content">
    	
		<div role="tabpanel" class="tab-pane {{ (isset($active) && $active == 'profile' ? 'active' : null) }}" id="you">

    		@include('sanatorium/profile::partials/you')

		</div>

    	<div role="tabpanel" class="tab-pane" id="basic">

    		@include('sanatorium/profile::partials/basic')

		</div>

		<div role="tabpanel" class="tab-pane {{ (isset($active) && $active == 'addresses' ? 'active' : null) }}" id="addresses">

    		@include('sanatorium/profile::partials/addresses')

		</div>

		<div role="tabpanel" class="tab-pane {{ (isset($active) && $active == 'orders' ? 'active' : null) }}" id="orders">

    		@include('sanatorium/profile::partials/orders')

		</div>

		<div role="tabpanel" class="tab-pane {{ (isset($active) && $active == 'slips' ? 'active' : null) }}" id="slips">

    		@include('sanatorium/profile::partials/slips')

		</div>
	
		@hook('profile.tabs.content')

	</div>

</div>