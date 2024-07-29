@extends('layouts.master')

@section('content')

<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title">{{session('title')}}</h4>
    </div>
    <div class="page-rightheader ml-auto d-lg-flex d-none">
        <a class="btn btn-success" href="{{ route('create.programs') }}"> Create Program</a>

    </div>
</div>
<!--End Page header-->

<!-- Row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">All Programs</div>
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
                                <th class="wd-15p border-bottom-0">TITLE</th>
                                <th class="wd-15p border-bottom-0">LOGO</th>
                                <th class="wd-15p border-bottom-0">PROFILE_IMAGE</th>
                                <th class="wd-15p border-bottom-0">CATEGORY</th>
                                <th class="wd-20p border-bottom-0">IMAGES</th>
                                <th class="wd-20p border-bottom-0">DATE CREATED</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($programs as $program)
                            <tr>
                                <td>{{$program->id}}</td>
                                <td>{{$program->title}}</td>
                                <td>@if(is_string($program->logo))
                                    <img src="{{ asset('storage/' . $program->logo) }}" alt="Logo" class="img-fluid"
                                        style="max-width: 80%; max-height: 80%; border-radius:8px;">
                                    @endif
                                </td>
                                <td>@if(is_string($program->cover_pic))
                                    <img src="{{ asset('storage/' . $program->cover_pic) }}" alt="Cover Pic"
                                        class="img-fluid" style="max-width: 40%; max-height: 40%; border-radius:3px;">
                                    @endif
                                </td>
                                <td>{{$program->category}}</td>
                                <td>
                                    @foreach($program->gallery_images ?? [] as $image)
                                    @if(is_string($image))
                                    <img src="{{ asset('storage/' . $image)  }}" alt="Image" class="img-fluid"
                                        style="max-width: 15%; max-height: 20%; border-radius:3px;">
                                    @endif
                                    @endforeach


                                </td>
                                <td>{{$program->created_at}}</td>
                                <td>
                                    <a href="{{route('edit.programs', $program->id)}}"
                                        class="btn btn-light mr-2">Edit</a>
                                    <a href="{{route('confirm_delete.programs', $program->id)}}"
                                        class="btn btn-light">Delete</a>
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