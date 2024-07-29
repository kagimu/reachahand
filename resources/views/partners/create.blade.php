@extends('layouts.master')

@section('content')


<!-- End Row-->

<div class="col-lg-12">>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Partner</h4>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('index.partners') }}"> Back</a>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <div class="card-body">
            <form action="{{ route('store.partners') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="partner_name" class="form-label">Partner's Name:</label>
                    <input type="text" name="partner_name" class="form-control" placeholder="">
                    @error('partner_name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
               <div class="form-group">
                    <label for="category" class="form-label">Category of Partner:</label>
                    <select name="category" class="form-control">
                        <option value="">Select a category</option>
                        <option value="Implementing Partner">Implementing Partner</option>
                        <option value="Implementing/Supporting Partner">Implementing/Supporting Partner</option>
                        <option value="Strategic/Supporting Partner">Strategic/Supporting Partner</option>
                        <option value="Corporate Partner">Corporate Partner</option>
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
                    <label for='cover_pic' class="form-label">Select Cover Picture of the Partner:</label>
                    <input type="file" name="cover_pic" id="cover_pic" class="form-control" />
                    @error('cover_pic')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-10">
                    <label for="programs_supported_images" class="form-label">Upload other Images about the
                        Partner:</label>
                    <input type="file" name="programs_supported_images[]" id="programs_supported_images"
                        multiple="multiple" class="form-control">
                    @error('programs_supported_image')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>



                <button type="submit" class="btn btn-primary mt-1 mb-0">Create Partner</button>

            </form>
        </div>
    </div>
</div>

<!-- End Row -->

@endsection