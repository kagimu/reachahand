@extends('layouts.master')

@section('content')


<!-- End Row-->

<div class="col-lg-12">>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Program</h4>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('index.programs') }}"> Back</a>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <div class="card-body">
            <form action="{{ route('store.programs') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title" class="form-label">Program Name:</label>
                    <input type="text" name="title" class="form-control" placeholder="">
                    @error('title')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
               <div class="form-group">
                    <label for="category" class="form-label">Category of Program:</label>
                    <select name="category" class="form-control">
                        <option value="">Select a category</option>
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
                    <label for="desc" class="form-label">Description:</label>
                    <textarea name="desc" rows="4" cols="30" id="textarea"></textarea>
                    @error('desc')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-10">
                    <label for='logo' class="form-label">Add Logo:</label>
                    <input type="file" name="logo" id="logo" class="form-control" />
                    @error('logo')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-10">
                    <label for='cover_pic' class="form-label">Add Cover Image:</label>
                    <input type="file" name="cover_pic" id="cover_pic" class="form-control" />
                    @error('cover_pic')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-10">
                    <label for="gallery_images" class="form-label">Upload other Images of the Program:</label>
                    <input type="file" name="gallery_images[]" id="gallery_images" multiple="multiple"
                        class="form-control">
                    @error('gallery_image')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Create Program</button>

            </form>
        </div>
    </div>
</div>

<!-- End Row -->

@endsection