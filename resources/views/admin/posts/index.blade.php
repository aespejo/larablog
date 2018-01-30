@extends('layouts.app')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
			Blog Posts
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				
					<table class="table">
						<thead>
							<th>Image</th>
							<th>Title</th>
							<th>Actions</th>
						</thead>
						@if($posts->count())
							<tbody>
								@foreach($posts as $post)
									<tr>
										<td><img src="{{ $post->featured }}" alt="{{ $post->title }}" height="60px" width="80px"></td>
										<td>{{ $post->title }}</td>
										<td style="text-align: left">
											<div class="btn-group  btn-group-sm" role="group" aria-label="...">
												<a href="{{ route('post.edit', ['id' => $post->id ]) }}"  class="btn btn-success">
													<!-- <button type="button" class="btn btn-success"> -->
														<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
													<!-- </button> -->
												</a>
												<a href="{{ route('post.trash', ['id' => $post->id]) }}" class="btn btn-danger">
												 	<!-- <button type="button" class="btn btn-danger"> -->
												 		<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
												 	<!-- </button> -->
											 	</a>
											</div>
										</td>
									</tr>	
								@endforeach
							</tbody>
						@else
							<tr>
								<td colspan="3" style="text-align: center"><h3>No records found</h3></td>
							</tr>
						@endif
					</table>
				
			</div>
		</div>
	</div>

@stop