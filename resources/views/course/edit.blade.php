@extends('app')

@section('content')
    <div class="container mt-2">
        <h6>{{ $course->title }} need to update</h6>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('course.update', $course->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                            id="exampleFormControlInput1" placeholder="Enter title" name="title"
                            value="{{ old('title', $course->title)}}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class=" mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Description</label>
                        <input type="text" class="form-control  @error('description') is-invalid @enderror"
                            id="exampleFormControlInput6" placeholder="Enter description" name="description"
                            value="{{ old('description', $course->description)}}">
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type=" submit" class="btn btn-primary float-end">Update Course</button>

                </form>
            </div>
        </div>
    </div>

@endsection