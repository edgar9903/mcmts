@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<table class="datatable_users table table-hover nowrap w-100" >
					<thead>
					<tr>
						<th>Name</th>
						<th>Surname</th>
						<th>username</th>
						<th>Email</th>
						<th>Status</th>
						<th></th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					@foreach($users as $user)
						<tr>
							<td>{{$user->name}}</td>
							<td>{{$user->surname}}</td>
							<td>{{$user->username}}</td>
							<td>{{$user->email}}</td>
							<td>{{$user->email_validation ? "Active" : "Inactive" }} </td>
							<td>
								<a class="btn btn-outline-warning"  href="{{ route('user.info',['id' => $user->id]) }}">Edit</a>
								<a class="btn btn-outline-danger ml-2" href="{{ route('user.delete',['id' => $user->id]) }}">Delete</a>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
