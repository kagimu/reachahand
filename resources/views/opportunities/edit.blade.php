@extends('layouts.master')

@section('content')

<div class="col-lg-12">>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Opportunity - {{$opportunity->title}}</h4>
        </div>
        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('index.opportunities') }}" enctype="multipart/form-data"> Back</a>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <div class="card-body">
            <form action="{{ route('update.opportunities', $opportunity->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title" class="form-label">Opportunity title:</label>
                    <input type="text" name="title" class="form-control" placeholder="Name of the Job Opportunity"
                        value="{{ old('title', $opportunity->title) }}">
                    @error('title')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="date" class="form-label">Submission Deadline:</label>
                    <input type="text" name="date" class="form-control" placeholder=""
                        value="{{ old('date', $opportunity->date) }}">
                    @error('date')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="desc" class="form-label">Brief Description of the Opportunity:</label>
                    <textarea name="desc" rows="4" cols="30" id="textarea">{{ old('desc', $opportunity->desc) }}</textarea>
                    @error('desc')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-10">
                    <label for="documents" class="form-label">Update Document(s) showing job description:</label>
                    <input type="file" name="documents[]" id="documents" multiple="multiple" class="form-control">
                    @error('document')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-10">
                    <label for='cover_pic' class="form-label">Update Cover Picture:</label>
                    <input type="file" name="cover_pic" id="cover_pic" class="form-control"
                        value="{{ old('cover_pic', $opportunity->cover_pic) }}">
                    @error('cover_pic')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-4 mb-0">Update Opportunity</button>
            </form>
        </div>
    </div>
</div>

@endsection