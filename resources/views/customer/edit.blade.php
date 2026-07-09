@extends('app')

@section('content')
    <div class="container mt-2">
        <h6>{{ $customer->name }} need to update</h6>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('customer.update', $customer->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="exampleFormControlInput1" placeholder="Enter Name" name="name"
                            value="{{ old('name', $customer->name)}}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class=" mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                        <input type="email" class="form-control  @error('email') is-invalid @enderror"
                            id="exampleFormControlInput6" placeholder="name@example.com" name="email"
                            value="{{ old('email', $customer->email)}}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class=" mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Phone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                            id="exampleFormControlInput4" placeholder="Enter Phone" name="phone"
                            value="{{ old('phone', $customer->phone)}}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type=" submit" class="btn btn-primary float-end">Update Customer</button>

                </form>
            </div>
        </div>
    </div>

@endsection