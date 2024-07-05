@extends('layouts.master')

@section('content')

<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title">{{session('title')}}</h4>
    </div>
    <div class="page-rightheader ml-auto d-lg-flex d-none">
        <a class="btn btn-success" href="{{ route('create.events') }}"> Add New Event</a>

    </div>
</div>
<!--End Page header-->

<!-- Row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">All Events</div>
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
                                <th class="wd-15p border-bottom-0">Author</th>
                                <th class="wd-15p border-bottom-0">TITLE</th>
                                <th class="wd-15p border-bottom-0">starts</th>
                                <th class="wd-15p border-bottom-0">ends</th>
                                <th class="wd-15p border-bottom-0">venue</th>
                                <th class="wd-20p border-bottom-0">main_image</th>
                                 <th class="wd-20p border-bottom-0">other images</th>
                                <th class="wd-15p border-bottom-0">DATE</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                            <tr>
                                <td>{{$event->id}}</td>
                                <td>{{$event->user->name}}</td>
                                <td>{{$event->title}}</td>
                                <td>{{$event->start}}</td>
                                <td>{{$event->end}}</td>
                                <td>{{$event->venue}}</td>
                                 <td>@if(is_string($event->main_image))
                                    <img src="{{ asset('storage/' . $event->main_image) }}" alt="Cover Pic"
                                        class="img-fluid" style="max-width: 80%; max-height: 80%;">
                                    @endif
                                </td>
                                <td>
                                    @foreach($event->images ?? [] as $image)
                                    @if(is_string($image))
                                    <img src="{{ asset('storage/' . $image)  }}" alt="Image" class="img-fluid"
                                        style="max-width: 25%; max-height: 30%; border-radius:3px;">
                                    @endif
                                    @endforeach


                                </td>
                                <td>{{$event->created_at}}</td>
                                <td>
                                    <a href="{{route('edit.events', $event->id)}}" class="btn btn-light mr-2">Edit</a>
                                    <a href="{{route('confirm_delete.events', $event->id)}}"
                                        class="btn btn-light">Delete</a>
                                    <a href="{{route('show.events', $event->id)}}" class="btn btn-light">View Event
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