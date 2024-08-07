@extends('layouts.master')

@section('content')

<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title">{{session('title')}}</h4>
    </div>
</div>
<!--End Page header-->

<div class="main-proifle">
    <div class="row pb-4">
        <div class="col-lg-7">
            <div class="box-widget widget-user">
                <div class="widget-user-image d-sm-flex">
                    <img src="{{ $event->user->profile_pic_url ? asset($event->user->profile_pic_url) : asset('images/placeholder.png') }}"
                        alt="img" class="img-fluid" style="max-width: 25%; max-height: 50%; border-radius:40px;">
                    <div class="ml-sm-4 mt-4">
                        <h4 class="pro-user-username mb-3 font-weight-bold">{{$event->user->name}} @if($event->user->role
                            == 'admin') <span class="badge badge-warning">Admin</span> @endif</h4>
                        <div class="d-flex mb-1">
                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                                width="24">
                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                <path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3"></path>
                                <path
                                    d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z">
                                </path>
                            </svg>
                            <div class="h6 mb-0 ml-3 mt-1">The Time Property was Created: {{$event->created_at}}</div>
                        </div>
                        <div class="d-flex">
                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                                width="24">
                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                <path
                                    d="M15.2 18.21c1.21.41 2.48.67 3.8.76v-1.5c-.88-.07-1.75-.22-2.6-.45l-1.2 1.19zM6.54 5h-1.5c.09 1.32.35 2.59.75 3.79l1.2-1.21c-.24-.83-.39-1.7-.45-2.58zM14 8h5V5h-5z"
                                    opacity=".3"></path>
                                <path
                                    d="M20 15.5c-1.25 0-2.45-.2-3.57-.57-.1-.03-.21-.05-.31-.05-.26 0-.51.1-.71.29l-2.2 2.2c-2.83-1.44-5.15-3.75-6.59-6.58l2.2-2.21c.28-.27.36-.66.25-1.01C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.5c0-.55-.45-1-1-1zM5.03 5h1.5c.07.88.22 1.75.46 2.59L5.79 8.8c-.41-1.21-.67-2.48-.76-3.8zM19 18.97c-1.32-.09-2.6-.35-3.8-.76l1.2-1.2c.85.24 1.72.39 2.6.45v1.51zM12 3v10l3-3h6V3h-9zm7 5h-5V5h5v3z">
                                </path>
                            </svg>
                            <div class="h6 mb-0 ml-3 mt-1">Username: {{$event->user->username}}</div>
                        </div>
                    </div>
                </div>
                <h5 class="font-weight-bold mt-4">EVENT Headline</h5>
                <div class="main-profile-bio mb-4">
                    {{$event->title}}
                </div>
                <h5 class="font-weight-bold mt-10">DESCRIPTION</h5>
                <div class="main-profile-bio mb-4">
                     {!! $event->description !!}
                </div>
                <h5 class="font-weight-bold mt-6">LOCATION</h5>
                <div class="main-profile-bio mb-4">
                    {{$event->venue}}
                </div>
                <h5 class="font-weight-bold mt-4">Start time</h5>
                <div class="main-profile-bio mb-4">
                    {{$event->start}}
                </div>
                <h5 class="font-weight-bold mt-4">End time</h5>
                <div class="main-profile-bio mb-4">
                    {{$event->end}}
                </div>
                <h5 class="font-weight-bold mt-4">Full date</h5>
                <div class="main-profile-bio mb-4">
                    {{$event->date}}
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <!-- Images -->
            <h5 class="font-weight-bold">Event Images</h5>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        @if($event->other_images)
                            @foreach($event->other_images as $image)
                                @if(is_string($image))
                                    <div class="col-md-6 mb-3">
                                        <img src="{{ asset('storage/' . $image) }}" alt="Image" class="img-fluid"
                                            style="max-width: 100%; max-height: 100%; border-radius:8px;">
                                    </div>
                                @endif
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>

            <!-- Videos -->
            <h5 class="font-weight-bold mt-4">Cover Image</h5>
            <div class="row">

               @if (is_string($event->main_image))
                <div class="col-8">
                    <div class="embed-responsive embed-responsive-16by9 mb-3">
                        <div class="col-md-8 mb-3">
                            <img src="{{ asset('storage/' . $event->main_image) }}" alt="Image" class="img-fluid"
                                style="max-width: 100%; max-height: 100%; border-radius:8px;">
                        </div>
                    </div>
                </div>
                @endif


            </div>

            <a class="carousel-control-prev" href="#carousel-captions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-captions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>

</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="border-0">
            <div class="tab-content">
                <div class="tab-pane active" id="tab-7">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="font-weight-bold">Comments</h5>
                            @foreach($comments as $comment)
                            <div class="media mr-5">
                                <div class="media-icon bg-primary-transparent text-primary mr-4">
                                    <img src="{{$comment->user->avatar}}">
                                </div>
                                <div class="media-body">
                                    <h6 class="font-weight-bold mb-1"> {{$comment->user->name}}</h6>
                                    <p>{{$comment->comment}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection