@extends('layouts.app')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
			Create a new post
		</div>
		<div class="panel-body">
			<form action="{{ route('category.store') }}" method="post">
				<!-- @if(session('success') || session('error') )
				<div class="alert {{ session('success') ? 'alert-success' : 'alert-warning' }} alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong></strong> {{ session('success') ?  session('success') : session('error') }}
				</div>	
				@endif -->
				{{  csrf_field() }}
				<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
					<label class="name">Category Name</label>
					<input type="text" name="name" id="name" value="" placeholder="Category name" class="form-control">
					@if($errors->has('name'))
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
				</div>
				<div class="form-group">
					<button class="btn btn-success">Save</button>
				</div>
			</form>
					
		</div>
	</div>
	

@stop