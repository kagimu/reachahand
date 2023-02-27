@extends('layouts.master')

@section('content')

 <div class="col-lg-12">>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Agent</h4>
        </div>
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('agents.index') }}" enctype="multipart/form-data"> Back</a>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
        </div>
        @endif
        <div class="card-body">
            <form action="{{ route('agents.update',$agent->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="">
                    <div class="form-group">
                        <label for="agent_name" class="form-label">agent Name:</label>
                        <input type="text" name="agent_name" value="{{ $agent->agent_name }}" class="form-control" placeholder="agent Name">
                        @error('agent_name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <strong>Profile Picture:</strong>
                        <input type="file" name="profile_pic" class="form-control" placeholder="Profile_pic">
                        <img src="/profile_pic/{{ $agent->profile_pic }}" width="300px">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection