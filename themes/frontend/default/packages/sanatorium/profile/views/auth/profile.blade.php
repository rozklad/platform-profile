@extends('layouts/default')

{{-- Page title --}}
@section('title')
{{{ trans('platform/users::auth/form.profile.legend') }}} ::
@parent
@stop

{{-- Queue Assets --}}
{{ Asset::queue('platform-validate', 'platform/js/validate.js', 'jquery') }}

{{-- Inline Scripts --}}
@section('scripts')
@parent
@stop

{{-- Page content --}}
@section('page')
	
	@include('sanatorium/profile::tabs/layout')

@stop
