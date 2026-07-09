@extends('app')

@section('content')
    <div class="container mt-2">
        <h6>Open New Shop</h6>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('shop.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Shop Name</label>
                        <input type="text" class="form-control @error('shop_name') is-invalid @enderror"
                            id="exampleFormControlInput1" placeholder="Enter Shop Name" name="shop_name"
                            value="{{ old('shop_name')}}">
                        @error('shop_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class=" mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Shop Number</label>
                        <input type="text" class="form-control @error('shop_number') is-invalid @enderror"
                            id="exampleFormControlInput2" placeholder="Enter Shop Number" name="shop_number"
                            value="{{ old('shop_number')}}">
                        @error('shop_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Shop Address</label>
                        <input type="text" class="form-control @error('shop_address') is-invalid @enderror"
                            id="exampleFormControlInput3" placeholder="Enter Shop Address" name="shop_address"
                            value="{{ old('shop_address')}}">
                        @error('shop_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class=" mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Shop Phone</label>
                        <input type="text" class="form-control @error('shop_phone') is-invalid @enderror"
                            id="exampleFormControlInput4" placeholder="Enter Shop Phone" name="shop_phone"
                            value="{{ old('shop_phone')}}">
                        @error('shop_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class=" mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Shop Email</label>
                        <input type="email" class="form-control  @error('shop_email') is-invalid @enderror"
                            id="exampleFormControlInput6" placeholder="name@example.com" name="shop_email"
                            value="{{ old('shop_email')}}">
                        @error('shop_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class=" mb-3">
                        <label for="exampleFormControlInput1" class="form-label">TIN Number</label>
                        <input type="text" class="form-control  @error('tin_number') is-invalid @enderror"
                            id="exampleFormControlInput6" placeholder="Enter TIN Number" name="tin_number"
                            value="{{ old('tin_number')}}">
                        @error('tin_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Create
                        Shop</button>

                </form>
            </div>
        </div>
    </div>

@endsection