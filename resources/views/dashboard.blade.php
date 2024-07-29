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
    <div class="col-sm-12 col-md-6 col-xl-3">
        <div class="card bg-blue">
            <div class="card-body">
                <a href="{{route('index.posts')}}"></a>
                <div class="d-flex no-block align-items-center">
                    <div>
                        <h6 class="text-white">Blogs</h6>
                        <h2 class="text-white m-0 font-weight-bold">{{$posts}}</h2>
                    </div>
                    <div class="ml-auto">
                        <span class="text-white display-6"><i class="fa fa-file-text-o fa-2x"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-xl-3">
        <a href="{{route('index.clients')}}"></a>
        <div class="card bg-teal">
            <div class="card-body">
                <div class="d-flex no-block align-items-center">
                    <div>
                        <h6 class="text-white">Registered Staff</h6>
                        <h2 class="text-white m-0 font-weight-bold">{{$clients}}</h2>
                    </div>
                    <div class="ml-auto">
                        <span class="text-white display-6"><i class="fa fa-user-circle fa-2x"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-xl-3">
        <div class="card bg-blue">
            <div class="card-body">
                <div class="d-flex no-block align-items-center">
                    <div>
                        <h6 class="text-white">Events</h6>
                        <h2 class="text-white m-0 font-weight-bold">{{$events}}</h2>
                    </div>
                    <div class="ml-auto">
                        <span class="text-white display-6"><i class="fa fa-server fa-2x"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-xl-3">
        <div class="card bg-teal">
            <div class="card-body">
                <div class="d-flex no-block align-items-center">
                    <div>
                        <h6 class="text-white">Partners</h6>
                        <h2 class="text-white m-0 font-weight-bold">{{$partners}}</h2>
                    </div>
                    <div class="ml-auto">
                        <span class="text-white display-6"><i class="fa fa-users fa-2x"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Most Active Staff</h3>
                <div class="card-options ">
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap mb-0 border">
                                <thead>
                                    <tr>
                                        <th class="wd-lg-10p">NAME</th>
                                        <th class="wd-lg-10p">Surname</th>
                                        <th class="wd-lg-10p">Posts Uploaded</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($active_clients as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->username}}</td>
                                        <td>
                                            {{number_format($user->posts->count())}} posts
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection