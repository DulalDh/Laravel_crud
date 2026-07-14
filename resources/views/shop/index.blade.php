@extends('app')

@section('content')
    <div class="container py-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                    <div>
                        <p class="text-uppercase text-muted small mb-1">Management</p>
                        <h1 class="h4 mb-0">Shops</h1>
                    </div>

                    <a href="{{ route('shop.create') }}" class="btn btn-primary px-3">
                        Add New
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('shop.index') }}" method="GET" class="mb-4">
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-md">
                            <div class="input-group">
                                <span class="input-group-text bg-white">Search</span>
                                <input
                                    type="search"
                                    name="search"
                                    class="form-control"
                                    placeholder="Search shops"
                                    value="{{ request('search') }}"
                                >
                                <button class="btn btn-outline-primary" type="submit">Search</button>
                            </div>
                        </div>
                        @if (request('search'))
                            <div class="col-12 col-md-auto">
                                <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary w-100">Clear</a>
                            </div>
                        @endif
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">TIN</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shopData as $shop)
                                <tr>
                                    <th scope="row">{{ $shop->id }}</th>
                                    <td class="fw-semibold">{{ $shop->shop_name }}</td>
                                    <td>{{ $shop->shop_address }}</td>
                                    <td>{{ $shop->shop_phone }}</td>
                                    <td>{{ $shop->shop_email }}</td>
                                    <td>{{ $shop->tin_number ?? 'N/A' }}</td>
                                    <td style="width: 150px;">
                                        <div class="d-flex flex-wrap gap-2">
                                            <a href="{{ route('shop.edit', $shop->id) }}" class="btn btn-outline-secondary btn-sm">
                                                Edit
                                            </a>
                                            <form action="{{ route('shop.destroy', $shop->id) }}" method="POST" onsubmit="return confirm('Are you sure?, You want to delete shop')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $shopData->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
