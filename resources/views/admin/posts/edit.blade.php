@extends('layouts.app')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
			Edit post : {{ $post->title }}
		</div>
		<div class="panel-body">
			<form action="{{ route('post.update', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
				{{  csrf_field() }}
				<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
					<label class="title">Title</label>
					<input type="text" name="title" id="title" value="{{ $post->title }}" placeholder="Title" class="form-control">
					@if($errors->has('title'))
                        <span class="help-block">{{ $errors->first('title') }}</span>
                    @endif
				</div>
				<div class="form-group {{ $errors->has('featured') ? 'has-error' : '' }}">
					<label class="featured">Featured</label>
					<input type="file" name="featured" id="featured" value="{{ old('featured') }}" placeholder="Featured Image" class="form-control">
					@if($errors->has('featured'))
                        <span class="help-block">{{ $errors->first('featured') }}</span>
                    @endif
				</div>
				<div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
					<label class="category">Select Category</label>
					<select class="form-control" name="category" id="category">
						<option selected="" value="">Select category</option>
						@if($categories)
							@foreach($categories as $category)
								<option value="{{ $category->id }}" @if($post->category_id == $category->id) selected="selected" @endif>{{ $category->name }}</option>
							@endforeach;
						@endif
					</select>
					@if($errors->has('category'))
                        <span class="help-block">{{ $errors->first('category') }}</span>
                    @endif
				</div>
				<div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
					<label>Select tag</label>
					@if($tags->count())
						@foreach($tags as $tag)
							<div class="checkbox">
							    <label>
							    	<input type="checkbox" value="{{ $tag->id }}" name="tags[]" 
										@foreach($post->tags as $selTag)
											@if($selTag->id == $tag->id) 
												checked 
											@endif
										@endforeach
							    	> {{ $tag->tag }} 
							    </label>
						  	</div>
					  	@endforeach
					@endif
					@if($errors->has('tags'))
                        <span class="help-block">{{ $errors->first('tags') }}</span>
                    @endif
				</div>
				<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
					<label class="title">Content</label>
					<textarea class="form-control" name="content" id="content" rows="5" cols="5">{{ $post->content }}</textarea>
					@if($errors->has('content'))
                        <span class="help-block">{{ $errors->first('content') }}</span>
                    @endif
				</div>
				<div class="form-group">
					<button class="btn btn-success">Save</button>
				</div>
				<!-- <div class="form-group">
					<label class="title">Category</label>
					<select class="form-control">
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</div> -->
			</form>
		</div>
	</div>
@stop

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css">
@stop

@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#content').summernote();
	});
</script>
@stop