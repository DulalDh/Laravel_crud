@extends('app')

@section('content')
    <div class="container mt-2">
        <div class="d-flex justify-content-between mb-2">
            <h6>Courses</h6>
            <a href="{{ route('course.create') }}" type="button" class="btn btn-primary">Add New</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('course.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="search" name="search" class="form-control" placeholder="Search courses"
                    value="{{ request('search') }}">
                <button class="btn btn-outline-primary" type="submit">Search</button>
                @if (request('search'))
                    <a href="{{ route('course.index') }}" class="btn btn-outline-secondary">Clear</a>
                @endif
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Students</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($courses as $course)
                    <tr>
                        <th scope="row">{{ $course->id }}</th>
                        <td>{{ $course->title }}</td>
                        <td>{{ $course->description ?? 'N/A' }}</td>
                        <td>{{ $course->students_count }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('course.edit', $course->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                                <form action="{{ route('course.destroy', $course->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this course?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No courses found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $courses->links() }}
    </div>
@endsection
