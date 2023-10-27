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
                    <form action="{{ route('store.categories') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$category->id}}" name="category_id">
                        <div class="">
                            <div class="form-group">
                                <label for="category_name" class="form-label">Category Name:</label>
                                <input type="text" name="category_name" class="form-control"
                                       placeholder="Category Name" value="{{$category->category_name}}">
                                @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description" class="form-label">Description:</label>
                                <textarea name="description" rows="5" cols="40" class="form-control tinymce-editor"
                                          placeholder="Description">{{$category->description}}</textarea>
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="file" class="form-label">Thumbnail:</label>

                                <input type="file" name="image" class="form-control" {{$category->id == null ? 'required' : ''}}>
                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <img class="mt-2" src="{{$category->image}}" height="150">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-1 mb-0">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End Row -->

@endsection