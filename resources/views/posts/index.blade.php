@extends('layouts.master')

@section('content')

<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title">{{session('title')}}</h4>
    </div>
    <div class="page-rightheader ml-auto d-lg-flex d-none">
        <a class="btn btn-success" href="{{ route('create.posts') }}"> Create Post</a>

    </div>
</div>
<!--End Page header-->

<!-- Row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">All Posts</div>
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
                                <th class="wd-15p border-bottom-0">POSTED BY</th>
                                <th class="wd-15p border-bottom-0">TITLE</th>
                                <th class="wd-15p border-bottom-0">TAG</th>
                                <th class="wd-15p border-bottom-0">AUTHOR</th>
                                <th class="wd-15p border-bottom-0">date written</th>
                                <th class="wd-20p border-bottom-0">IMAGES</th>
                                <th class="wd-15p border-bottom-0">post uploaded on</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->user->name}}</td>
                                <td>{{ Str::limit($post->title, 20) }}</td>
                                <td>{{$post->tag}}</td>
                                <td>{{$post->owner}}</td>
                                <td>{{$post->date}}</td>
                                <td>{{$post->created_at}}</td>
                                <td>
                                    <a href="{{route('edit.posts', $post->id)}}" class="btn btn-light mr-2">Edit</a>
                                    <a href="{{route('confirm_delete.posts', $post->id)}}"
                                        class="btn btn-light">Delete</a>
                                    <a href="{{route('show.posts', $post->id)}}" class="btn btn-light">View Blog
                                        Details</a>
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