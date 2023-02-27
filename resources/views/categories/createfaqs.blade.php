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

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{session('title')}}</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('store.faqs') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$category_id}}" name="category_id">
                        <div class="">
                            <div class="form-group">
                                <label for="question" class="form-label">Question:</label>
                                <input type="text" name="question" class="form-control"
                                       placeholder="Enter your question" value="" required>
                            </div>

                            <div class="form-group">
                                <label for="answer" class="form-label">Answer:</label>
                                <textarea name="answer" rows="5" cols="40" class="form-control tinymce-editor"
                                          placeholder="Enter your answer" required></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4 mb-0">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End Row -->

@endsection