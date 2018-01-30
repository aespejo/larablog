@extends('layouts.app')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
			Tags
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<th>Tag Name</th>
						<th>Actions</th>
					</thead>
					<tbody>
						@if($tags->count())
							@foreach($tags as $tag)
								<tr>
									<td>{{ $tag->tag }}</td>
									<td style="text-align: left">
										<div class="btn-group  btn-group-sm" role="group" aria-label="...">
											<a href="{{ route('tags.edit', ['id' => $tag->id ]) }}"  class="btn btn-success">
												<!-- <button type="button" class="btn btn-success"> -->
													<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
												<!-- </button> -->
											</a>
											<a href="{{ route('tags.delete', ['id' => $tag->id]) }}" class="btn btn-danger">
											 	<!-- <button type="button" class="btn btn-danger"> -->
											 		<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
											 	<!-- </button> -->
										 	</a>
										</div>
									</td>
								</tr>	
							@endforeach
						@else
							<tr>
								<td colspan="3" style="text-align: center"><h3>No records found</h3></td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>

@stop