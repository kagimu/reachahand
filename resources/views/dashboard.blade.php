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
            <div class="card bg-success">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h6 class="text-white">Posts</h6>
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
            <div class="card bg-yellow">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h6 class="text-white">Users</h6>
                            <h2 class="text-white m-0 font-weight-bold">{{$clients}}</h2>
                        </div>
                        <div class="ml-auto">
                            <span class="text-white display-6"><i class="fa fa-users fa-2x"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-3">
            <div class="card bg-pink">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h6 class="text-white">Support</h6>
                            <h2 class="text-white m-0 font-weight-bold">{{$support}}</h2>
                        </div>
                        <div class="ml-auto">
                            <span class="text-white display-6"><i class="fa fa-wrench fa-2x"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-3">
            <div class="card bg-success">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h6 class="text-white">Agents</h6>
                            <h2 class="text-white m-0 font-weight-bold">{{$agents}}</h2>
                        </div>
                        <div class="ml-auto">
                            <span class="text-white display-6"><i class="fa fa-th-list fa-2x"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">New Support Users</h3>
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
                                        <th class="wd-lg-10p">First name</th>
                                        <th class="wd-lg-10p">Surname</th>
                                        <th class="wd-lg-10p">Phone</th>
                                        <th class="wd-lg-10p">Email</th>
                                        <th class="wd-lg-10p">Status</th>
                                        <th class="wd-lg-10p">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($support_users as $user)
                                        <tr>
                                            <td>{{$user->first_name}}</td>
                                            <td>{{$user->last_name}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>
                                                {{$user->email}}
                                            </td>
                                            <td>
                                    <span class="badge badge-{{$user->active == 1 ? 'success' : 'danger'}} mt-2">
                                        {{$user->active == 1 ? 'active' : 'inactive'}}
                                    </span>

                                            </td>

                                            <td><a href="{{route('activate.user', $user->id)}}"
                                                   class="btn btn-light">{{$user->active == 1 ? 'De-Activate' : 'Activate'}}</a>
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

        <div class="col-xl-4 col-lg-5 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Most Active Clients</h3>
                    <div class="card-options ">
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table transaction-table mb-0 text-nowrap">
                            <tbody>
                            @foreach($active_clients as $user)
                                <tr>
                                    <td class="d-flex">
                                        {{--<img class="w-7 h-7 rounded shadow mr-3" src="{{$user->avatar}}" alt="">--}}
                                        <div class="mt-1">
                                            <h6 class="mb-1 font-weight-semibold">{{$user->first_name . " " . $user->last_name}}</h6>
                                            <small class="text-muted">{{$user->phone}}</small>
                                        </div>
                                    </td>
                                    <td class="text-right">
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

@endsection
