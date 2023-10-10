@extends('layouts.master')

@section('content')

    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title">{{session('title')}}</h4>
        </div>
        <div class="page-rightheader ml-auto d-lg-flex d-none">
            <a class="btn btn-success" href="{{ route('create.agents') }}"> Create agent</a>

        </div>
    </div>
    <!--End Page header-->

    <!-- Row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">List of {{session('title')}}</div>
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
                                <th class="wd-15p border-bottom-0">NAME</th>
                                <th class="wd-15p border-bottom-0">PHONE NUMBER</th>
                                <th class="wd-15p border-bottom-0">PROFILE PICTURE</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($agents as $t)
                                <tr>
                                    <td>{{$t->id}}</td>
                                    <td>{{$t->agent_name}}</td>
                                    <td>{{$t->phone}}</td>
                                    <td><img src="{{ $t->profile_pic }}" height="70"></td>

                                    <td><a href="{{route('edit.agents', $t->id)}}" class="btn btn-light">Edit</a>

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
