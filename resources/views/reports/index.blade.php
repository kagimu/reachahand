@extends('layouts.master')

@section('content')

<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title">{{session('title')}}</h4>
    </div>
    <div class="page-rightheader ml-auto d-lg-flex d-none">
        <a class="btn btn-success" href="{{ route('create.reports') }}"> Create Report</a>

    </div>
</div>
<!--End Page header-->

<!-- Row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">All Reports</div>
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
                                <th class="wd-15p border-bottom-0">Year</th>
                                  <th class="wd-15p border-bottom-0">Cover Art</th>
                                <th class="wd-15p border-bottom-0">reports (pdf)</th>
                                <th class="wd-15p border-bottom-0">DATE</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $report)
                            <tr>
                                <td>{{$report->id}}</td>
                                <td>{{$report->title}}</td>
                                <td>{{$report->year}}</td>
                                 <td>@if(is_string($report->image))
                                    <img src="{{ asset('storage/' . $report->image) }}" alt="Cover Pic"
                                        class="img-fluid" style="max-width: 80%; max-height: 80%;">
                                    @endif
                                </td>
                                <td>
                                    @if(is_array($report->report_url))
                                    @if(count($report->report_url) > 0)
                                    <a href="{{ asset($report->report_url[0]) }}" target="_blank">
                                        View PDF
                                    </a>
                                    @else
                                    No PDF available
                                    @endif
                                    @elseif($report->report_url)
                                    <a href="{{ asset($report->report_url) }}" target="_blank">
                                        <strong>View PDF</strong>
                                    </a>
                                    @else
                                    No PDF available
                                    @endif
                                </td>
                                <td>{{$report->created_at}}</td>
                                <td>
                                   <a href="{{route('edit.reports', $report->id)}}" class="btn btn-light mr-2">Edit</a>
                                    <a href="{{route('confirm_delete.reports', $report->id)}}"
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