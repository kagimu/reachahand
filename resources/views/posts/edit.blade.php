@extends('layouts.master')

@section('content')

 <div class="col-lg-12">>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Post</h4>
        </div>
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('posts.index') }}" enctype="multipart/form-data"> Back</a>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
        </div>
        @endif
        <div class="card-body">
            <form action="{{ route('posts.update',$post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="">
                    <div class="form-group">
                        <label for="desc" class="form-label">Caption:</label>
                        <input type="text" name="desc" value="{{ $post->desc }}" class="form-control" placeholder="Caption">
                        @error('desc')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="custom-file">
                        <label for="images" class="custom-file-input">Choose Image:</label>
                        <input type="file" name="image[]" value="{{ $post->image }}" class="custom-file-input" id="images" multiple="multiple">
                        @error('image')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection