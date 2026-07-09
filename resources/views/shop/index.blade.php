@extends('app')

@section('content')
    <div class="container mt-2">
        <div class="d-flex justify-content-between mb-2">
            <h6>Shops</h6>
            <a href="{{ route('shop.create') }}" type="button" class="btn btn-primary">Add New</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('shop.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="search" name="search" class="form-control" placeholder="Search shops"
                    value="{{ request('search') }}">
                <button class="btn btn-outline-primary" type="submit">Search</button>
                @if (request('search'))
                    <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary">Clear</a>
                @endif
            </div>
        </form>
        <table class="table table-striped">
            <thead>
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
                        <td>{{ $shop->shop_name }}</td>
                        <td>{{ $shop->shop_address }}</td>
                        <td>{{ $shop->shop_phone }}</td>
                        <td>{{ $shop->shop_email }}</td>
                        <td>{{ $shop->tin_number ?? 'N/A' }}</td>

                        <td style="width:120px">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('shop.edit', $shop->id) }}" type="button" class="btn btn-secondary"
                                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                    Edit
                                </a>
                                <form action="{{ route('shop.destroy', $shop->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?, You want to delete shop')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{ $shopData->links() }}
    </div>
@endsection