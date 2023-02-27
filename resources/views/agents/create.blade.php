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
                    <form action="{{ route('store.agents') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$agent->id}}" name="agent_id">
                        <div class="">
                            <div class="form-group">
                                <label for="agent_name" class="form-label">Agent Name:</label>
                                <input type="text" name="agent_name" class="form-control" placeholder="Enter agent name" value="{{$agent->agent_name}}">
                                @error('agent_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Agent Contact:</label>
                                <input type="text" name="phone" class="form-control" placeholder="Enter agent name" value="{{$agent->agent_name}}">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{--<div class="form-group">--}}
                                {{--<strong>Logo:</strong>--}}
                                {{--<input type="file" name="logo" class="form-control" placeholder="Logo">--}}
                            {{--</div>--}}
                        </div>
                        <button type="submit" class="btn btn-primary mt-4 mb-0">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End Row -->

@endsection