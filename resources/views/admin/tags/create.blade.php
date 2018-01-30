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
			Create new tags
		</div>
		<div class="panel-body">
			<form action="{{ route('tags.store') }}" method="post">
				{{  csrf_field() }}
				<div class="form-group {{ $errors->has('tag') ? 'has-error' : '' }}">
					<label class="tag">Tag</label>
					<input type="text" name="tag" id="tag" value="{{ old('tag') }}" placeholder="Tag" class="form-control">
					@if($errors->has('tag'))
                        <span class="help-block">{{ $errors->first('tag') }}</span>
                    @endif
				</div>
				<div class="form-group">
					<button class="btn btn-success">Save</button>
				</div>
			</form>		
		</div>
	</div>
@stop