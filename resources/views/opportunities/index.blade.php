@extends('layouts.master')

@section('content')

<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title">{{session('title')}}</h4>
    </div>
    <div class="page-rightheader ml-auto d-lg-flex d-none">
        <a class="btn btn-success" href="{{ route('create.opportunities') }}"> Create Opportunity</a>

    </div>
</div>
<!--End Page header-->

<!-- Row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">All Opportunities</div>
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
                                <th class="wd-15p border-bottom-0">title</th>
                                <th class="wd-15p border-bottom-0">Deadline</th>
                                <th class="wd-15p border-bottom-0">cover image</th>
                                <th class="wd-15p border-bottom-0">Documents</th>
                                <th class="wd-15p border-bottom-0">DATE</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($opportunities as $opportunity)
                            <tr>
                                <td>{{$opportunity->id}}</td>
                                <td>{{$opportunity->title}}</td>
                                <td>{{$opportunity->date}}</td>
                                <td>
                                    @if(is_string($opportunity->cover_pic))
                                    <img src="{{ asset('storage/' . $opportunity->cover_pic)  }}" alt="Image"
                                        class="img-fluid" style="max-width: 100%; max-height: 100%;">
                                    @endif

                                </td>
                                <td>
                                    @if(is_array($opportunity->documents_url))
                                    @if(count($opportunity->documents_url) > 0)
                                    <a href="{{ asset($opportunity->documents_url[0]) }}" target="_blank">
                                        View PDF
                                    </a>
                                    @else
                                    No PDF available
                                    @endif
                                    @elseif($opportunity->documents_url)
                                    <a href="{{ asset($opportunity->documents_url) }}" target="_blank">
                                        <strong>View PDF</strong>
                                    </a>
                                    @else
                                    No PDF available
                                    @endif
                                </td>
                                <td>{{$opportunity->created_at}}</td>
                                <td>
                                    <a href="{{route('edit.opportunities', $opportunity->id)}}"
                                        class="btn btn-light mr-2">Edit</a>
                                    <a href="{{route('confirm_delete.opportunities', $opportunity->id)}}"
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