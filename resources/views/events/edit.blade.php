@extends('layouts.master')

@section('content')

<div class="col-lg-12">>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Blog</h4>
        </div>
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('index.posts') }}" enctype="multipart/form-data"> Back</a>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <div class="card-body">
            <form action="{{ route('update.posts', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" name="title" class="form-control" placeholder=""
                        value="{{ old('title', $post->title) }}">
                    @error('title')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="desc" class="form-label">Brief Description of the Blog:</label>
                    <textarea name="desc" rows="4" cols="30" class="form-control tinymce-editor"
                        required>{{ old('desc', $post->desc) }}</textarea>
                    @error('desc')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tag" class="form-label">tag:</label>
                    <input type="text" name="tag" class="form-control" placeholder="#"
                        value="{{ old('tag', $post->tag) }}">
                    @error('tag')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="location" class="form-label">Exact Location incase of event:</label>
                    <input type="text" name="location" class="form-control" placeholder=""
                        value="{{ old('location', $post->location) }}">
                    @error('location')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="owner" class="form-label">Author:</label>
                    <input type="text" name="owner" class="form-control" placeholder=""
                        value="{{ old('owner', $post->owner) }}">
                    @error('owner')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-10">
                    <label for="images" class="form-label">Update the Images of the Property:</label>
                    <input type="file" name="images[]" id="images" multiple="multiple" class="form-control">
                    @error('image')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-10">
                    <label for='cover_pic' class="form-label">Update Cover Picture:</label>
                    <input type="file" name="cover_pic" id="cover_pic" class="form-control" />
                    @error('cover_pic')
                    <div class="alert alert-danger mt-4 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-10">
                    <label for="video" class="form-label">Update Video:</label>
                    <input type="file" name="video" id="video" class="form-control" />
                    @error('video')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-4 mb-0">Update Blog</button>
            </form>
        </div>
    </div>
</div>

@endsection