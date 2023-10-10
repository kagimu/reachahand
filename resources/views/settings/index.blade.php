@extends('layouts.master')

@section('content')

    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title">{{session('title')}}</h4>
        </div>
        @if(Session::has('message'))
            <div class="alert alert-info" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{Session::get('message')}}
            </div>
        @endif
    </div>
    <!--End Page header-->

    <div class="row">
        <div class="col-md-12">
            <div class="card overflow-hidden">
                <div class="card-header bg-light">
                    <h4 class="card-title">Welcome Message On the App</h4>
                    <div class="ml-auto mt-4 mt-sm-0">
                        <a data-toggle="modal" data-target="#editModal" class="btn btn-light">Edit</a>
                    </div>
                </div>
                <div class="card-body">
                    <p>{{!is_null($setting) ? $setting->message : ''}}</p>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="normalmodal" style="padding-right: 5px; display: none;" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="normalmodal1">Edit Welcome Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{route('store.settings')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <textarea class="form-control mb-4" placeholder="Add welcome message" rows="3" name="message">{{!is_null($setting) ? $setting->message : ''}}</textarea>
                    </div>
                    <div class="modal-footer">
                        {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection