@extends('layouts.master')

@section('content')

    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title">{{session('title')}}</h4>
        </div>
        {{--<div class="page-rightheader ml-auto d-lg-flex d-none">--}}
            {{--<ol class="breadcrumb">--}}
                {{--<li class="breadcrumb-item"><a href="#" class="d-flex"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg><span class="breadcrumb-icon"> Home</span></a></li>--}}
                {{--<li class="breadcrumb-item"><a href="#">Tables</a></li>--}}
                {{--<li class="breadcrumb-item active" aria-current="page">Data Tables</li>--}}
            {{--</ol>--}}
        {{--</div>--}}
    </div>
    <!--End Page header-->

    <!-- Row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">List of Registered {{session('title')}}</div>
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
                                <th class="wd-15p border-bottom-0">First name</th>
                                <th class="wd-15p border-bottom-0">Surname</th>
                                <th class="wd-20p border-bottom-0">Phone</th>
                                <th class="wd-15p border-bottom-0">{{$role == 'client'  }}</th>
                                <th class="wd-25p border-bottom-0">Status</th>

                                <th class="wd-10p border-bottom-0">Registered Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->first_name}}</td>
                                <td>{{$user->last_name}}</td>
                                <td>{{$user->phone}}</td>
                                <td>
                                    @if($role == 'client')
                                        {{$user == 'client'}}
                                    @else
                                        {{$user == 'Support/Admin'}}
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-{{$user->active == 1 ? 'success' : 'danger'}} mt-2">
                                        {{$user->active == 1 ? 'active' : 'inactive'}}
                                    </span>

                                </td>
                                <td>{{$user->created_at}}</td>

                                <td><a href="{{route('activate.user', $user->id)}}" class="btn btn-light">{{$user->active == 1 ? 'De-Activate' : 'Activate'}}</a></td>
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