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
			@if(isset($category->id))
				Update category: {{ $category->name }}
			@else
				Record does not exist!
			@endif
		</div>
		<div class="panel-body">
			@if(isset($category->id))
				<form action="{{ route('category.update', ['id' => $category->id]) }}" method="post">
					{{  csrf_field() }}
					<input type="hidden" name="id" id="" value="{{ $category->id }}">
					<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
						<label class="name">Category Name</label>
						<input type="text" name="name" id="name" value="{{ $category->name }}" placeholder="Category name" class="form-control">
						@if($errors->has('name'))
	                        <span class="help-block">{{ $errors->first('name') }}</span>
	                    @endif
					</div>
					<div class="form-group">
						<button class="btn btn-success">Save</button>
					</div>
				</form>		
			@else
				<h2>Record does not  exist!</h2>
			@endif	
		</div>
	</div>
@stop