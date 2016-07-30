<div class="row">

	<div class="col-md-12">

		{{-- Form --}}
		<form id="profile-form" role="form" method="post" accept-char="UTF-8" data-parsley-validate>

			{{-- Form: CSRF Token --}}
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="panel panel-default">

				<div class="panel-heading">{{ trans('sanatorium/profile::common.tabs.basic') }}</div>

				<div class="panel-body">

					{{-- First Name --}}
					<div class="form-group{{ Alert::onForm('first_name', ' has-error') }}">

						<label class="control-label" for="first_name">{{ trans('platform/users::auth/form.first_name') }}</label>

						<input class="form-control" type="text" name="first_name" id="first_name" value="{{{ $currentUser->first_name }}}" placeholder="{{{ trans('platform/users::auth/form.first_name') }}}">

						<span class="help-block">
							{{{ Alert::onForm('first_name') ?: trans('platform/users::auth/form.first_name_help') }}}
						</span>

					</div>

					{{-- Last Name --}}
					<div class="form-group{{ Alert::onForm('last_name', ' has-error') }}">

						<label class="control-label" for="last_name">{{ trans('platform/users::auth/form.last_name') }}</label>

						<input class="form-control" type="text" name="last_name" id="last_name" value="{{{ $currentUser->last_name }}}" placeholder="{{{ trans('platform/users::auth/form.last_name') }}}">

						<span class="help-block">
							{{{ Alert::onForm('last_name') ?: trans('platform/users::auth/form.last_name_help') }}}
						</span>

					</div>

					{{-- Email Address --}}
					<div class="form-group{{ Alert::onForm('email', ' has-error') }}">

						<label class="control-label" for="email">{{ trans('platform/users::auth/form.email') }}</label>

						<input class="form-control" type="email" name="email" id="email" value="{{{ $currentUser->email }}}" placeholder="{{{ trans('platform/users::auth/form.email_placeholder') }}}"
						required
						data-parsley-trigger="change"
						data-parsley-error-message="{{{ trans('platform/users::auth/form.email_error') }}}">

						<span class="help-block">
							{{{ Alert::onForm('email') ?: trans('platform/users::auth/form.email_help') }}}
						</span>

					</div>

					{{-- Password --}}
					<div class="form-group{{ Alert::onForm('password', ' has-error') }}">

						<label class="control-label" for="password">{{{ trans('platform/users::auth/form.password') }}}</label>

						<input class="form-control" type="password" name="password" id="password" placeholder="{{{ trans('platform/users::auth/form.password_placeholder') }}}"
						data-parsley-trigger="change"
						data-parsley-minlength="6"
						data-parsley-error-message="{{{ trans('platform/users::auth/form.password_error') }}}">

						<span class="help-block">
							{{{ Alert::onForm('password') ?: trans('platform/users::auth/form.password_help') }}}
						</span>

					</div>

					{{-- Password Confirmation --}}
					<div class="form-group{{ Alert::onForm('password_confirmation', ' has-error') }}">

						<label class="control-label" for="password_confirmation">{{{ trans('platform/users::auth/form.password_confirmation') }}}</label>

						<input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="{{{ trans('platform/users::auth/form.password_placeholder') }}}"
						data-parsley-trigger="change"
						data-parsley-equalto="#password"
						data-parsley-error-message="{{{ trans('platform/users::auth/form.password_confirmation_error') }}}">

						<span class="help-block">
							{{{ Alert::onForm('password_confirmation') ?: trans('platform/users::auth/form.password_confirmation_help') }}}
						</span>

					</div>

					{{-- Form actions --}}
					<div class="form-group">

						<button class="btn btn-primary btn-block" type="submit">{{{ trans('action.save') }}}</button>

					</div>

				</div>

			</div>

		</form>

	</div>

</div>