@extends('layouts.master')

@section('content')


    <!-- End Row-->
    
        <div class="col-lg-12">>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Post</h4>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('posts.index') }}"> Back</a>
                </div>
                @if(session('status'))
                <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
                </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="">
                            <div class="form-group">
                                <label for="user_id" class="form-label">User ID:</label>
                                <input type="text" name="user_id" class="form-control" placeholder="User ID">
                                @error('user_id')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category_id" class="form-label">Category ID:</label>
                                <input type="text" name="category_id" class="form-control" placeholder="Category ID">
                                @error('category_id')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="label">Post Body: </label>
                                <textarea name="desc" rows="4" cols="30" class="form-control tinymce-editor" required></textarea>
                                @error('desc')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-10">
                            <input type="file" name="images[]" accept="images/*" multiple="multiple" class="form-control">
                                @error('image')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4 mb-0">Submit Post</button>
                        

                    </form>
                </div>
            </div>
        </div>
    
    <!-- End Row -->

    @endsection