@extends('app')

@section('content')
    <div class="container py-4">
        <div class="card border-0 shadow-lg overflow-hidden">
            <div class="border-primary-subtle px-4 py-3">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3">
                    <div class="me-lg-4">
                        <h1 class="h3 mb-1">Shops</h1>
                        <p class="text-muted mb-0">Review, search, and manage shop records.</p>
                    </div>

                    <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-2">
                        <form action="{{ route('shop.index') }}" method="GET" class="d-flex flex-column flex-sm-row gap-2" data-debounced-search-form>
                            <div class="input-group">
                                <input
                                    type="search"
                                    name="search"
                                    class="form-control"
                                    placeholder="Search shops"
                                    value="{{ request('search') }}"
                                    data-debounced-search-input
                                >
                            </div>
                        </form>

                        <a href="{{ route('shop.create') }}" class="btn btn-primary text-nowrap">
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
