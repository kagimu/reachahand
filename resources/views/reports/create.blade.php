@extends('layouts.master')

@section('content')


<!-- End Row-->

<div class="col-lg-12 mb-10">>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Annual Report</h4>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('index.reports') }}"> Back</a>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <div class="card-body">
            <form action="{{ route('store.reports') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-label">Report title:</label>
                    <input type="text" name="name" class="form-control" placeholder="">
                    @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="desc" class="form-label">Brief Description of the Report:</label>
                    <textarea name="desc" rows="4" cols="30" class="form-control tinymce-editor" required></textarea>
                    @error('desc')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="year" class="form-label">Date:</label>
                    <input type="text" name="year" class="form-control" placeholder="2023">
                    @error('year')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-10">
                    <label for="reports" class="form-label">Upload Report(S) and Use PDF only:</label>
                    <input type="file" name="reports[]" id="reports" multiple="multiple" class="form-control">
                    @error('report')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                 <div class="col-md-10">
                    <label for="image" class="form-label">Upload Cover Image:</label>
                    <input type="file" name="image" id="image"  class="form-control">
                    @error('image')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary mt-1 mb-10">Upload Annual Report</button>

            </form>
        </div>
    </div>
</div>

<!-- End Row -->

@endsection