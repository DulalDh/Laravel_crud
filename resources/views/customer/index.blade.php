@extends('app')

@section('content')
    <div class="container mt-2">
        <div class="d-flex justify-content-between mb-2">
            <h6>Customers</h6>
            <a href="{{ route('customer.create') }}" type="button" class="btn btn-primary">Add New</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('customer.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="search" name="search" class="form-control" placeholder="Search customers"
                    value="{{ request('search') }}">
                <button class="btn btn-outline-primary" type="submit">Search</button>
                @if (request('search'))
                    <a href="{{ route('customer.index') }}" class="btn btn-outline-secondary">Clear</a>
                @endif
            </div>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <th scope="row">{{ $customer->id }}</th>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>
                            @if($customer->deleted_at === null)
                                <span class="badge bg-success">ACTIVE</span>
                            @else
                                <span class="badge bg-danger">DELETED</span>
                            @endif
                        </td>

                        <td class="d-flex">
                            <div class="d-flex justify-content-between gap-1">
                                <a href="{{ route('customer.edit', $customer->id) }}" type="button" class="btn btn-secondary"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" aria-label="Edit customer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16" aria-hidden="true">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706l-1 1-2.121-2.121 1-1a.5.5 0 0 1 .707 0l1.414 1.414Z" />
                                        <path
                                            d="M13.793 4.354 11.672 2.232 4.939 8.965a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.854-6.612Z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>
                                    <span class="visually-hidden">Edit customer</span>
                                </a>
                                @if ($customer->deleted_at === null)
                                    <form action="{{ route('customer.destroy', $customer->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?, You want to delete customer')"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" role="button" aria-label="Delete customer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                viewBox="0 0 16 16" aria-hidden="true">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                <path
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2H5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1h2.5a1 1 0 0 1 1 1M4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4z" />
                                            </svg>
                                            <span class="visually-hidden">Delete customer</span>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('customer.delete', $customer->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?, You want to delete customer permanently')"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" role="button" aria-label="Delete customer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                viewBox="0 0 16 16" aria-hidden="true">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                <path
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2H5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1h2.5a1 1 0 0 1 1 1M4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4z" />
                                            </svg>
                                            <span class="visually-hidden">Delete customer</span>
                                        </button>
                                    </form>
                                @endif
                                @if ($customer->deleted_at !== null)
                                    <form action="{{ route('customer.restore', $customer->id) }}" method="POST"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Restore">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success" role="button" aria-label="Restore customer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                viewBox="0 0 16 16" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2z" />
                                                <path
                                                    d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466" />
                                            </svg>
                                            <span class="visually-hidden">Restore customer</span>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{ $customers->links() }}
    </div>
@endsection