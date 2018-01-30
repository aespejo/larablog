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
			<form action="{{ route('users.store') }}" method="post">
				{{  csrf_field() }}
				<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
					<label class="name">Name</label>
					<input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Name" class="form-control">
					@if($errors->has('name'))
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
				</div>

				<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
					<label class="email">Email</label>
					<input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email" class="form-control">
					@if($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
				</div>
				<div class="form-group">
					<button class="btn btn-success">Save</button>
				</div>
			</form>		
		</div>
	</div>
@stop