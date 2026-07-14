@extends('app')

@section('content')
    <div class="container mt-2">
        <h6>Create New Student</h6>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('student.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Student Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="exampleFormControlInput1" placeholder="Enter Student Name" name="name"
                            value="{{ old('name')}}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class=" mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Student Email</label>
                        <input type="email" class="form-control  @error('email') is-invalid @enderror"
                            id="exampleFormControlInput6" placeholder="name@example.com" name="email"
                            value="{{ old('email')}}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>
                    <button type="submit" class="btn btn-primary float-end">Create
                        Student</button>
                </form>
            </div>
        </div>
    </div>

@endsection