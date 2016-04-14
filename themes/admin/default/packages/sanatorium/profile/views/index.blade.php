@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
{{ trans('sanatorium/profile::common.title') }}
@stop

{{-- Inline scripts --}}
@section('scripts')
@parent
@stop

{{-- Inline styles --}}
@section('styles')
@parent
@stop

{{-- Page content --}}
@section('page')

{{-- Grid --}}
<section class="panel panel-default panel-grid">

	{{-- Grid: Header --}}
	<header class="panel-heading">

		<nav class="navbar navbar-default navbar-actions">

			<div class="container-fluid">

				<div class="navbar-header">

					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#actions">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<span class="navbar-brand">{{{ trans('sanatorium/profile::common.title') }}}</span>

				</div>

				<div class="collapse navbar-collapse" id="actions">

					<ul class="nav navbar-nav navbar-right">

						<li>

							<!-- Place buttons here -->

						</li>

					</ul>

				</div>

			</div>

		</nav>

	</header>

	<div class="panel-body">

		<div class="col-sm-6">
			
			<form method="POST" enctype="multipart/form-data" action="{{ route('sanatorium.profile.helper.process', ['type' => 'eshop']) }}">

			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<fieldset>
				
				<legend>{{ trans('sanatorium/profile::common.version.shop') }}</legend>

				<p>
					{{ trans('sanatorium/profile::common.version.shop_help') }}
				</p>

				<button type="submit" class="btn btn-primary">
					{{ trans('action.submit') }}
				</button>

			</fieldset>

			</form>

		</div>

	</div>

</section>

@stop

