@extends('layouts.master')

@section('content')


<!-- End Row-->

<div class="col-lg-12">>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Event</h4>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('index.events') }}"> Back</a>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <div class="card-body">
            <form action="{{ route('store.events') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" name="title" class="form-control" placeholder="">
                    @error('title')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description:</label>
                    <textarea name="description" rows="4" cols="30" id="textarea"></textarea>
                    @error('description')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="start" class="form-label">start time or date:</label>
                    <input type="text" name="start" class="form-control" placeholder="">
                    @error('start')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="end" class="form-label">end time or date:</label>
                    <input type="text" name="end" class="form-control" placeholder="">
                    @error('end')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="venue" class="form-label">Exact Location incase of event:</label>
                    <input type="text" name="venue" class="form-control" placeholder="Location">
                    @error('venue')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="date" class="form-label">Full date of event:</label>
                    <input type="text" name="date" class="form-control" placeholder="date">
                    @error('date')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                 <div class="form-group">
                    <label for="social_media_links" class="form-label">Map Directions or Zoom link:</label>
                    <input type="text" name="social_media_links" class="form-control" placeholder="">
                    @error('social_media_links')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                  <div class="form-group">
                    <label for="twitter_link" class="form-label">twitter_link:</label>
                    <input type="text" name="twitter_link" class="form-control" placeholder="twitter_link">
                    @error('twitter_link')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                 <div class="col-md-10">
                    <label for='main_image' class="form-label">Select Cover Picture:</label>
                    <input type="file" name="main_image" id="main_image" class="form-control" />
                    @error('main_image')
                    <div class="alert alert-danger mt-4 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-10">
                    <label for="other_images" class="form-label">Upload other Images of the Event:</label>
                    <input type="file" name="other_images[]" id="other_images" multiple="multiple" class="form-control">
                    @error('other_image')
                    <div class="alert alert-danger mt-4 mb-1">{{ $message }}</div>
                    @enderror
                </div>
               
                <button type="submit" class="btn btn-primary mt-5 mb-0">Create Event</button>

            </form>
        </div>
    </div>
</div>

<!-- End Row -->

@endsection