@extends('layouts.master')

@section('content')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title">{{session('title')}}</h4>
        </div>
    </div>
    <!--End Page header-->
    <div class="row">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{session('title')}}</h4>
                </div>

                @if(session('status'))
                    <div class="alert alert-success mb-1 mt-1">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card-body">
                   <form method="POST" action="{{ route('store.agents') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="agent_name">Agent Name</label>
                            <input type="text" class="form-control @error('agent_name') is-invalid @enderror" id="agent_name" name="agent_name" value="{{ old('agent_name') }}" required>
                            @error('agent_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="profile_pic">Profile Picture</label>
                            <input type="file" class="form-control-file @error('profile_pic') is-invalid @enderror" id="profile_pic" name="profile_pic">
                            @error('profile_pic')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- End Row -->

@endsection