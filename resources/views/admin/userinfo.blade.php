@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<form action="{{ route('admin.user.update') }}" method="post">
						@method('PUT')
						@csrf
						<input type="hidden" name="id" value="{{ Crypt::encrypt($user->id) }}">

						<div class="form-group">
							<label for="id">ID</label>
							<input type="text" id="id" class="form-control" value="{{$user->id }}"  disabled>
						</div>

						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ empty(old('name'))?$user->name:old('name') }}" autocomplete="name" autofocus>
							@error('name')
							<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
							@enderror
						</div>
						<div class="form-group">
							<label for="surname">Surname</label>
							<input type="text" id="surname" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ empty(old('surname'))?$user->surname:old('surname') }}" autocomplete="surname" autofocus>
							@error('surname')
							<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
							@enderror
						</div>

						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" id="username" class="form-control" value="{{$user->username }}"  disabled>
						</div>

						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" id="email" class="form-control" value="{{$user->email }}"  disabled>
						</div>

						<div class="form-group">
							<button class="btn btn-primary w-100">Submit</button>
						</div>
					</form>
			</div>
		</div>
	</div>
@endsection
