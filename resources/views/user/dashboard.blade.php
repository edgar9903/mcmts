@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				@if($user->email_validation)
					<form action="{{ route('EditProfile') }}" method="post">
						@method('PUT')
						@csrf
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
							<label for="suremailname">Email</label>
							<input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ empty(old('email'))?$user->email:old('email') }}" required autocomplete="email" autofocus>
							@error('email')
							<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
							@enderror
						</div>

						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="password" autofocus>
							@error('password')
							<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
							@enderror
						</div>

						<div class="form-group">
							<label for="new_password">New Password</label>
							<input type="password" id="new_password" class="form-control @error('new_password') is-invalid @enderror" name="new_password"  autocomplete="new_password" autofocus>
							@error('new_password')
							<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
							@enderror
						</div>

						<div class="form-group">
							<label for="password_confirmation">Confirm Password</label>
							<input type="password" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  autocomplete="password_confirmation" autofocus>
							@error('password_confirmation')
							<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
							@enderror
						</div>

						<div class="form-group">
							<button class="btn btn-primary w-100">Submit</button>
						</div>
					</form>
				@else
					<a href="{{ route('SendConfirmMail',['id' => $user->id]) }}">Please Confirm your account</a>
				@endif
			</div>
		</div>
	</div>
@endsection
