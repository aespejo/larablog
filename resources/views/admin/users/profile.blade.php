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
			My Profile
		</div>
		<div class="panel-body">
			<form action="{{ route('users.profile.update') }}" method="post" enctype="multipart/form-data">
				{{  csrf_field() }}
				<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
					<label class="name">Name</label>
					<input type="text" name="name" id="name" value="{{$user->name}}" placeholder="Name" class="form-control">
					@if($errors->has('name'))
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
				</div>

				<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
					<label class="email">Email</label>
					<input type="email" name="email" id="email" value="{{$user->email}}" placeholder="Email" class="form-control">
					@if($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
				</div>
				<div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
					<label class="avatar">Featured</label>
					<input type="file" name="avatar" id="avatar" placeholder="Profile Avatar" class="form-control">
					@if($errors->has('avatar'))
                        <span class="help-block">{{ $errors->first('avatar') }}</span>
                    @endif
				</div>
				<div class="row">	
				
					<div class="col-md-6 form-group {{ $errors->has('password') ? 'has-error' : '' }}">
						<label class="password">Password</label>
						<input type="password" name="password" id="password" value="{{ old('password') }}" placeholder="Password" class="form-control">
						@if($errors->has('password'))
	                        <span class="help-block">{{ $errors->first('password') }}</span>
	                    @endif
					</div>
					<div class="col-md-6 form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
						<label class="password">Confirm Password</label>
						<input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" class="form-control">
						@if($errors->has('password_confirmation'))
	                        <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
	                    @endif
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 form-group {{ $errors->has('facebook') ? 'has-error' : '' }}">
						<label class="email">Facebook Profile</label>
						<input type="text" name="facebook" id="facebook" value="{{$user->profile->facebook}}" placeholder="Facebook" class="form-control">
						@if($errors->has('facebook'))
	                        <span class="help-block">{{ $errors->first('facebook') }}</span>
	                    @endif
					</div>
					<div class="col-md-6 form-group {{ $errors->has('youtube') ? 'has-error' : '' }}">
						<label class="youtube">Youtube Profile</label>
						<input type="text" name="youtube" id="youtube" value="{{ $user->profile->youtube }}" placeholder="Youtube" class="form-control">
						@if($errors->has('youtube'))
	                        <span class="help-block">{{ $errors->first('youtube') }}</span>
	                    @endif
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 form-group {{ $errors->has('google') ? 'has-error' : '' }}">
						<label class="google">Google Profile</label>
						<input type="text" name="google" id="google" value="{{$user->profile->google}}" placeholder="Google+" class="form-control">
						@if($errors->has('google'))
	                        <span class="help-block">{{ $errors->first('google') }}</span>
	                    @endif
					</div>
					<div class="col-md-6 form-group {{ $errors->has('twitter') ? 'has-error' : '' }}">
						<label class="twitter">twitterProfile</label>
						<input type="text" name="twitter" id="twitter" value="{{ $user->profile->twitter}}" placeholder="Youtube" class="form-control">
						@if($errors->has('twitter'))
	                        <span class="help-block">{{ $errors->first('twitter') }}</span>
	                    @endif
					</div>
				</div>
				<div class="form-group {{ $errors->has('about') ? 'has-error' : '' }}">
					<label class="about">About</label>
					<textarea rows="6" cols="5" placeholder="About" class="form-control"  name="about" id="about">{{$user->profile->about}}</textarea>
					@if($errors->has('about'))
                        <span class="help-block">{{ $errors->first('about') }}</span>
                    @endif
				</div>
				<div class="form-group">
					<button class="btn btn-success">Save</button>
				</div>
			</form>		
		</div>
	</div>
@stop