@extends('layouts.app')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
			Users
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				
					<table class="table">
						<thead>
							<th>Image</th>
							<th>Name</th>
							<th>Permissions</th>
							<th>Actions</th>
						</thead>
						@if($users->count())
							<tbody>
								@foreach($users as $user)
									<tr>
										<td>
											@if(is_object($user->profile))
												<img src="{{ asset($user->profile->avatar) }}" alt="{{ $user->name }}" height="60px" width="60px" style="border-right: 50%">
											@else
												<img src="{{ asset('uploads/avatars/default.png') }}" alt="{{ $user->name }}" height="60px" width="60px" style="border-right: 50%">
											@endif
										</td>
										<td> {{ $user->name }} </td>
										<td> 
											@if($user->admin)
												<a href="{{ route('users.removeadmin', ['id' => $user->id]) }}" class="btn btn-sm btn-danger">Remove admin permission</a>
											@else 
												<a href="{{route('users.setadmin', ['id' => $user->id])}}" class="btn btn-sm btn-success">Make Admin</a>
											@endif 
										</td>
										<td style="text-align: left">
											@if(Auth::user()->id !== $user->id)
												<a href="{{ route('users.delete', ['id' => $user->id]) }}" class="btn btn-sm btn-danger">
												 	<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
											 	</a>
										 	@endif
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