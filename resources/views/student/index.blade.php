@extends('app')

@section('content')
    <div class="container mt-2">
        <div class="d-flex justify-content-between mb-2">
            <h6>Students</h6>
            <a href="{{ route('student.create') }}" type="button" class="btn btn-primary">Add New</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('student.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="search" name="search" class="form-control" placeholder="Search students"
                    value="{{ request('search') }}">
                <button class="btn btn-outline-primary" type="submit">Search</button>
                @if (request('search'))
                    <a href="{{ route('student.index') }}" class="btn btn-outline-secondary">Clear</a>
                @endif
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Courses</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    <tr>
                        <th scope="row">{{ $student->id }}</th>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>
                            @forelse ($student->courses as $course)
                                <span class="badge bg-secondary">{{ $course->title }}</span>
                            @empty
                                <span class="text-muted">No courses</span>
                            @endforelse
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('student.edit', $student->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                                <form action="{{ route('student.destroy', $student->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this student?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No students found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $students->links() }}
    </div>
@endsection
