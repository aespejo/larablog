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
			@if(isset($tag->id))
				Update tag: {{ $tag->name }}
			@else
				Record does not exist!
			@endif
		</div>
		<div class="panel-body">
			@if(isset($tag->id))
				<form action="{{ route('tags.update', ['id' => $tag->id]) }}" method="post">
					{{  csrf_field() }}
					<input type="hidden" name="id" id="" value="{{ $tag->id }}">
					<div class="form-group {{ $errors->has('tag') ? 'has-error' : '' }}">
						<label class="name">Tag</label>
						<input type="text" name="tag" id="tag" value="{{ $tag->tag }}" placeholder="Tag" class="form-control">
						@if($errors->has('tag'))
	                        <span class="help-block">{{ $errors->first('tag') }}</span>
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