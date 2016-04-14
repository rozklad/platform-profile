@extends('layouts/default')

{{-- Page title --}}
@section('title')
{{{ trans('platform/users::auth/form.register.legend') }}} ::
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

<div class="row">

	<div class="col-md-12">

		{{-- Form --}}
		<form id="register-form" role="form" method="post" accept-char="UTF-8" autocomplete="off" data-parsley-validate>

			{{-- Form: CSRF Token --}}
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="panel panel-default">

				<div class="panel-heading">{{{ trans('platform/users::auth/form.register.legend') }}}</div>

				<div class="panel-body">

					{{-- Email Address --}}
					<div class="form-group{{ Alert::onForm('email', ' has-error') }}">

						<label class="control-label" for="email">{{{ trans('platform/users::auth/form.email') }}}</label>

						<input class="form-control" type="email" name="email" id="email" value="{{{ Input::old('email') }}}" placeholder="{{{ trans('platform/users::auth/form.email_placeholder') }}}"
						required
						autofocus
						data-parsley-trigger="change"
						data-parsley-error-message="{{{ trans('platform/users::auth/form.email_error') }}}">

						<span class="help-block">
							{{{ Alert::onForm('email') ?: trans('platform/users::auth/form.email_help') }}}
						</span>

					</div>

					{{-- Password --}}
					<div class="form-group{{ Alert::onForm('password', ' has-error') }}">

						<label class="control-label" for="password">{{{ trans('platform/users::auth/form.password') }}}</label>

						<input class="form-control" type="password" name="password" id="password" value="{{{ Input::old('password') }}}" placeholder="{{{ trans('platform/users::auth/form.password_placeholder') }}}"
						required
						data-parsley-trigger="change"
						data-parsley-minlength="6"
						data-parsley-error-message="{{{ trans('platform/users::auth/form.password_error') }}}">

						<span class="help-block">
							{{{ Alert::onForm('password') ?: trans('platform/users::auth/form.password_help') }}}
						</span>

					</div>

					{{-- Confirm Password --}}
					<div class="form-group{{ Alert::onForm('password_confirmation', ' has-error') }}">

						<label class="control-label" for="password_confirmation">{{{ trans('platform/users::auth/form.password_confirmation') }}}</label>

						<input class="form-control" type="password" name="password_confirmation" id="password_confirmation" value="{{{ Input::old('password_confirmation') }}}" placeholder="{{{ trans('platform/users::auth/form.password_placeholder') }}}"
						required
						data-parsley-trigger="change"
						data-parsley-equalto="#password"
						data-parsley-error-message="{{{ trans('platform/users::auth/form.password_confirmation_error') }}}">

						<span class="help-block">
							{{{ Alert::onForm('password_confirmation') ?: trans('platform/users::auth/form.password_confirmation_help') }}}
						</span>

					</div>

					<hr>
						
						@hook('register.after')

					<hr>

					{{-- Form actions --}}
					<div class="form-group">

						<button class="btn btn-primary btn-block" type="submit">{{{ trans('platform/users::auth/form.register.submit') }}}</button>

						<div class="help-block text-center">{{ trans('sanatorium/profile::common.already_have_an_account') }} <a href="{{ URL::route('user.login') }}">{{{ trans('platform/users::auth/form.login.legend') }}}</a></div>

					</div>

				</div>

			</div>

		</form>

	</div>

</div>

@stop
