@extends('app')

@section('content')
    <div class="container py-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body pt-3 px-4 pb-4">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
                    <div class="me-lg-4">
                        <h1 class="h3 mb-1">Posts</h1>
                        <p class="text-muted mb-0">Review posts linked to the selected customer.</p>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Status</th>
                                <th scope="col">Post</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <th scope="row">{{ $post->id }}</th>
                                    <td>{{ $post->customer->name }}</td>
                                    <td>{{ $post->customer->email }}</td>
                                    <td>{{ $post->customer->phone }}</td>
                                    <td>
                                        @if ($post->customer->deleted_at === null)
                                            <span class="badge text-bg-success">ACTIVE</span>
                                        @else
                                            <span class="badge text-bg-danger">DELETED</span>
                                        @endif
                                    </td>
                                    <td>
                                        <p class="mb-0">{{ $post->title }}</p>
                                        <small class="text-muted">{{ $post->post }}</small>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
