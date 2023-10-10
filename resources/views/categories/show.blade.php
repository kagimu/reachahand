@extends('layouts.master')

@section('content')

    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title">{{session('title')}}</h4>
        </div>
        <div class="page-rightheader ml-auto d-lg-flex d-none">
            <a class="btn btn-success" href="{{ route('create.faqs', $category->id) }}"> Create FAQ</a>

        </div>
    </div>
    <!--End Page header-->

    <!-- Row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Frequently Asked Questions</div>
                </div>
                <div class="card-body">

                    <div class="list-group">
                        @foreach($faqs as $faq)
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{$faq->question}}</h5>
                            </div>
                            <p class="mb-1">{{$faq->answer}}</p>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
        <!--End Page header-->

@endsection