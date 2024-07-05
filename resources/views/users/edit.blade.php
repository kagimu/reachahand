@extends('layouts.master')

@section('content')

<div class="col-lg-12">>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit {{$user->name}}`s Details</h4>
        </div>
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('index.clients') }}" enctype="multipart/form-data"> Back</a>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <div class="card-body">
            <form action="{{ route('update.users', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="first_name" class="form-label">Surname:</label>
                    <input type="text" name="first_name" class="form-control" placeholder=""
                        value="{{ old('first_name', $user->first_name) }}">
                    @error('first_name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="last_name" class="form-label">Other Name</label>
                    <input type="text" name="last_name" class="form-control" placeholder=""
                        value="{{ old('last_name', $user->last_name) }}">
                    @error('last_name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" name="username" class="form-control" placeholder=""
                        value="{{ old('username', $user->username) }}">
                    @error('username')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="position" class="form-label">Role / Position of work:</label>
                    <input type="text" name="position" class="form-control" placeholder=""
                        value="{{ old('position', $user->position) }}">
                    @error('position')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email:</label>
                    <input type="text" name="email" class="form-control" placeholder=""
                        value="{{ old('email', $user->email) }}">
                    @error('email')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label"> Password:</label>
                    <input type="password" name="password" class="form-control" placeholder="******"
                        value="{{ old('password', $user->password) }}">
                    @error('password')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password:</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="******"
                        value="{{ old('password_confirmation', $user->password_confirmation) }}">
                </div>
                <div class="col-md-10">
                    <label for='profile_pic' class="form-label">Select Profile Picture:</label>
                    <input type="file" name="profile_pic" id="profile_pic" class="form-control"
                        value="{{ old('profile_pic', $user->profile_pic) }}">
                    @error('profile_pic')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-4 mb-0">Update Blog</button>
            </form>
        </div>
    </div>
</div>

@endsection