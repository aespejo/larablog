@extends('layouts.app')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
			Categories
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<th>Category Name</th>
						<th>Actions</th>
					</thead>
					<tbody>
						@if($categories->count())
							@foreach($categories as $category)
								<tr>
									<td>{{ $category->name }}</td>
									<td style="text-align: left">
										<div class="btn-group  btn-group-sm" role="group" aria-label="...">
											<a href="{{ route('category.edit', ['id' => $category->id ]) }}"  class="btn btn-success">
												<!-- <button type="button" class="btn btn-success"> -->
													<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
												<!-- </button> -->
											</a>
											<a href="{{ route('category.delete', ['id' => $category->id]) }}" class="btn btn-danger">
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