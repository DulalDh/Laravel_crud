@extends('app')

@section('content')
    <div class="container py-4">
        <div class="card border-0 shadow-lg overflow-hidden">
            <div class="border-primary-subtle px-4 py-3">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3">
                    <div class="me-lg-4">
                        <h1 class="h3 mb-1">Customers</h1>
                        <p class="text-muted mb-0">Review, search, and manage customer records.</p>
                    </div>

                    <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-2">
                        <form action="{{ route('customer.index') }}" method="GET" class="d-flex flex-column flex-sm-row gap-2" data-debounced-search-form>
                            <div class="input-group">
                                <input
                                    type="search"
                                    name="search"
                                    class="form-control"
                                    placeholder="Search customers"
                                    value="{{ request('search') }}"
                                    data-debounced-search-input
                                >
                            </div>
                        </form>

                        <a href="{{ route('customer.create') }}" class="btn btn-primary text-nowrap">
                            Add New
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body pt-3 px-4 pb-4">
                @if (session('success'))
                    <div class="alert alert-success mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Status</th>
                                <th scope="col">DOB</th>
                                <th scope="col" class="text-nowrap">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <th scope="row">{{ $customer->id }}</th>
                                    <td class="fw-semibold">{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>
                                        @if ($customer->deleted_at === null)
                                            <span class="badge text-bg-success">ACTIVE</span>
                                        @else
                                            <span class="badge text-bg-danger">DELETED</span>
                                        @endif
                                    </td>
                                    <td>{{ $customer->customer_detail->dob ?? 'N/A' }}</td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-outline-secondary btn-sm">
                                                Edit
                                            </a>

                                            @if ($customer->deleted_at === null)
                                                <form action="{{ route('customer.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Are you sure?, You want to delete customer')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                                </form>
                                            @else
                                                <form action="{{ route('customer.delete', $customer->id) }}" method="POST" onsubmit="return confirm('Are you sure?, You want to delete customer permanently')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                                </form>
                                            @endif

                                            @if ($customer->deleted_at !== null)
                                                <form action="{{ route('customer.restore', $customer->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-outline-success btn-sm">Restore</button>
                                                </form>
                                            @endif

                                            <a class="btn btn-outline-primary btn-sm" href="{{ route('post.index', $customer->id) }}">Posts</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
