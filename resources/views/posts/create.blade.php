@extends('layouts.master')

@section('content')


<!-- End Row-->

<div class="col-lg-12">>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Blog</h4>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('index.posts') }}"> Back</a>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <div class="card-body">
            <form action="{{ route('store.posts') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" name="title" class="form-control" placeholder="">
                    @error('title')
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
                <div class="form-group">
                    <label for="tag" class="form-label">tag:</label>
                    <input type="text" name="tag" class="form-control" placeholder="#">
                    @error('tag')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="date" class="form-label">Exact date written:</label>
                    <input type="text" name="date" class="form-control" placeholder="">
                    @error('date')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="owner" class="form-label">Author:</label>
                    <input type="text" name="owner" class="form-control" placeholder="">
                    @error('owner')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                  <div class="col-md-10">
                    <label for='cover_pic' class="form-label">Select Cover Picture:</label>
                    <input type="file" name="cover_pic" id="cover_pic" class="form-control" />
                    @error('cover_pic')
                    <div class="alert alert-danger mt-4 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-5 mb-0">Create Blog</button>

            </form>
        </div>
    </div>
</div>

<!-- End Row -->

@endsection