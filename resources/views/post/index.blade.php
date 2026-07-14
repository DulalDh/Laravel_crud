@extends('app')

@section('content')
        <table class="table table-striped">
            <thead>
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
                            @if($post->customer->deleted_at === null)
                                <span class="badge bg-success">ACTIVE</span>
                            @else
                                <span class="badge bg-danger">DELETED</span>
                            @endif
                        </td>

                        <td>
                            <p class="mp-0">{{ $post->title }}</p>
                            <small>{{$post->post }}</small>
                        </td>
                       
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection