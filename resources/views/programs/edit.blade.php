@extends('layouts.master')

@section('content')

<div class="col-lg-12">>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Program - {{$program->title}}</h4>
        </div>
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('index.programs') }}" enctype="multipart/form-data"> Back</a>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <div class="card-body">
            <form action="{{ route('update.programs', $program->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title" class="form-label">Title of Program:</label>
                    <input type="text" name="title" class="form-control" placeholder=""
                        value="{{ old('title', $program->title) }}">
                    @error('title')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category" class="form-label">category of Program:</label>
                    <input type="text" name="category" class="form-control" placeholder=""
                        value="{{ old('category', $program->category) }}">
                         <select name="category" class="form-control">
                        <option value="{{ old('category', $program->category) }}">{{ old('category', $program->category) }}</option>
                        <option value="SRHR">SRHR</option>
                        <option value="Youth Livelihoods and Innovations">Youth Livelihoods and Innovations</option>
                        <option value="SautiPlus Media Hub">SautiPlus Media Hub</option>
                        <option value="IDEAS">IDEAS</option>
                    </select>
                    @error('category')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="desc" class="form-label">Brief Description of the Property:</label>
                   <textarea name="desc" rows="4" cols="30" id="textarea"></textarea>
                        required>{{ old('desc', $program->desc) }}</textarea>
                    @error('desc')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-10">
                    <label for='logo' class="form-label">Update Logo:</label>
                    <input type="file" name="logo" id="logo" class="form-control"
                        value="{{ old('logo', $program->logo) }}">
                    @error('logo')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-10">
                    <label for="cover_pic" class="form-label">Update Cover Picture:</label>
                    <input type="file" name="cover_pic" id="cover_pic" class="form-control"
                        value="{{ old('cover_pic', $program->cover_pic) }}">
                    @error('cover_pic')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-10">
                    <label for="gallery_images" class="form-label">Update the Images of the Program:</label>
                    <input type="file" name="gallery_images[]" id="gallery_images" multiple="multiple"
                        class="form-control">
                    @error('gallery_image')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary mt-4 mb-0">Update Program</button>
            </form>
        </div>
    </div>
</div>

@endsection