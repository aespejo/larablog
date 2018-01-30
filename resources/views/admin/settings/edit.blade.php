@extends('layouts.app')

@section('content')
	<!-- @if(session('success') || session('error') )
		<div class="alert {{ session('success') ? 'alert-success' : 'alert-warning' }} alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong></strong> {{ session('success') ?  session('success') : session('error') }}
		</div>	
	@endif -->
	<div class="panel panel-default">

		<div class="panel-heading">
			Create new user
		</div>
		<div class="panel-body">
			<form action="{{ route('settings.update', ['id'=>$settings->id]) }}" method="post">
				{{  csrf_field() }}
				<div class="form-group {{ $errors->has('site_name') ? 'has-error' : '' }}">
					<label class="site_name">Site name</label>
					<input type="text" name="site_name" id="site_name" value="{{ $settings->site_name }}" placeholder="Site Name" class="form-control">
					@if($errors->has('site_name'))
                        <span class="help-block">{{ $errors->first('site_name') }}</span>
                    @endif
				</div>

				<div class="form-group {{ $errors->has('contact_email') ? 'has-error' : '' }}">
					<label class="contact_email">Contact email address</label>
					<input type="email" name="contact_email" id="contact_email" value="{{ $settings->contact_email }}" placeholder="Email" class="form-control">
					@if($errors->has('contact_email'))
                        <span class="help-block">{{ $errors->first('contact_email') }}</span>
                    @endif
				</div>

				<div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
					<label class="contact_number">Contact number</label>
					<input type="text" name="contact_number" id="contact_number" value="{{ $settings->contact_number }}" placeholder="Contact Number" class="form-control">
					@if($errors->has('contact_number'))
                        <span class="help-block">{{ $errors->first('contact_number') }}</span>
                    @endif
				</div>

				<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
					<label class="address">Address</label>
					<input type="text" name="address" id="address" value="{{ $settings->address }}" placeholder="Address" class="form-control">
					@if($errors->has('address'))
                        <span class="help-block">{{ $errors->first('address') }}</span>
                    @endif
				</div>
				<div class="form-group">
					<button class="btn btn-success">Save</button>
				</div>
			</form>		
		</div>
	</div>
@stop