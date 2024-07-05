@extends('layouts.master')

@section('content')

<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title">{{session('title')}}</h4>
    </div>
    <div class="page-rightheader ml-auto d-lg-flex d-none">
        <a class="btn btn-success" href="{{ route('create.impacts') }}"> Create Impact</a>

    </div>
</div>
<!--End Page header-->

<!-- Row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">All Impact Posts</div>
            </div>
            <div class="card-body">
                @if(Session::has('message'))
                <div class="alert alert-info" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true"></button>
                    {{Session::get('message')}}
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="wd-15p border-bottom-0">AUTHOR</th>
                                <th class="wd-15p border-bottom-0">TITLE</th>
                                <th class="wd-15p border-bottom-0">TAG</th>
                                <th class="wd-15p border-bottom-0">OWNER</th>
                                <th class="wd-15p border-bottom-0">LOCATION</th>
                                <th class="wd-20p border-bottom-0">IMAGES</th>
                                <th class="wd-15p border-bottom-0">DATE</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($impacts as $impact)
                            <tr>
                                <td>{{$impact->id}}</td>
                                <td>{{$impact->user->name}}</td>
                                <td>{{$impact->title}}</td>
                                <td>{{$impact->tag}}</td>
                                <td>{{$impact->owner}}</td>
                                <td>{{$impact->location}}</td>
                                <td>
                                    @foreach($impact->images ?? [] as $image)
                                    @if(is_string($image))
                                    <img src="{{ asset('storage/' . $image)  }}" alt="Image" class="img-fluid"
                                        style="max-width: 50%; max-height: 60%; border-radius:3px;">
                                    @endif
                                    @endforeach


                                </td>
                                <td>{{$impact->created_at}}</td>
                                <td>
                                    <a href="{{route('edit.impacts', $impact->id)}}" class="btn btn-light mr-2">Edit</a>
                                    <a href="{{route('confirm_delete.impacts', $impact->id)}}"
                                        class="btn btn-light">Delete</a>
                                    <a href="{{route('show.impacts', $impact->id)}}" class="btn btn-light">View
                                        Impact</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <!-- table-responsive -->
            </div>
        </div>
    </div>
    <!-- End Row -->
    <!--End Page header-->

    @endsection