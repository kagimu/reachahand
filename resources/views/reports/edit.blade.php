@extends('layouts.master')

@section('content')

 <div class="col-lg-12">>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Report</h4>
        </div>
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('index.reports') }}" enctype="multipart/form-data"> Back</a>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
        </div>
        @endif
        <div class="card-body">
                <form action="{{ route('update.reports', $report->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title" class="form-label">Report Name:</label>
                        <input type="text" name="title" class="form-control" placeholder="" value="{{ old('title', $report->title) }}">
                        @error('title')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="desc" class="form-label">Brief Description of the report:</label>
                        <textarea name="desc" rows="4" cols="30" id="textarea">{{ old('desc', $report->desc) }}</textarea>
                        @error('desc')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="year" class="form-label">Date:</label>
                        <input type="text" name="year" class="form-control" placeholder="" value="{{ old('year', $report->year) }}">
                        @error('year')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                <div class="col-md-10">
                    <label for="reports" class="form-label">Update the Report Documents:</label>
                    <input type="file" name="reports[]" id="reports" multiple="multiple" class="form-control">
                    @error('report')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-10">
                    <label for="image" class="form-label">Update CoverArt:</label>
                    <input type="file" name="image" id="image" class="form-control"/>
                    @error('image')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-4 mb-0">Update Post</button>
            </form>
        </div>
    </div>
</div>

@endsection