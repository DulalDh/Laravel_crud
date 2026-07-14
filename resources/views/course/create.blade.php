@extends('app')

@section('content')
    <div class="container mt-2">
        <h6>Open New Course</h6>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('course.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                            id="exampleFormControlInput1" placeholder="Enter Title" name="title" value="{{ old('title')}}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class=" mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Description</label>
                        <input type="text" class="form-control  @error('description') is-invalid @enderror"
                            id="exampleFormControlInput6" placeholder="Enter description" name="description"
                            value="{{ old('description')}}">
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Create Course</button>
                </form>
            </div>
        </div>
    </div>

@endsection