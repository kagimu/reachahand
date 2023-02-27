@extends('layouts.master')

@section('content')

    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title">{{session('title')}}</h4>
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
                        <div class="alert alert-info" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{Session::get('message')}}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap" id="example1">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th class="wd-15p border-bottom-0">USER</th>
                                <th class="wd-15p border-bottom-0">CAPTION</th>
                                <th class="wd-15p border-bottom-0">LOCATION</th>
                                <th class="wd-15p border-bottom-0">PRICE</th>
                                <th class="wd-15p border-bottom-0">PROPERTY TYPE</th>
                                <th class="wd-20p border-bottom-0">IMAGE</th>
                                <th class="wd-15p border-bottom-0">DATE</th>
                                <th class="wd-25p border-bottom-0">COMMENTS</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td>{{$post->user->first_name}} {{$post->user->last_name}}</td>
                                    <td>{{$post->desc}}</td>
                                    <td>{{$post->location}}</td>
                                    <td>{{$post->price}}</td>
                                    <td>{{$post->type}}</td>
                                    <td>
                                        @if(count($post->images))
                                        <img src="{{$post->images[0]}}" height="100">
                                        @endif
                                    </td>
                                    <td>{{$post->created_at}}</td>
                                    <td>{{$post->comments_count}}</td>
                                    <td><a href="{{route('show.posts', $post->id)}}" class="btn btn-light">View Post</a></td>
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