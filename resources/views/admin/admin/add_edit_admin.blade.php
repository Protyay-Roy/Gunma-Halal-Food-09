@extends('admin.layouts.layout')

@php
    $admin_class = 'active';
@endphp

@section('content')
    {{-- <div class="heading-title mt-3">
        <h3 class="text-center">Add New Admin</h3>
        <hr class="bg-dark w-100">

    </div> --}}
    <div class="card mt-4">


    </div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card d-flex">

            <div class="card-header">
                <h4 class="text-center mb-0 py-2"><i class="fa-solid fa-person"></i> Add New Admin</h4>
            </div>
            <div class="card-body col-8">
                <form class="forms-sample" action="{{ route('store.admin') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$admin->name}}">
                        @error('name')
                            <div class="text-danger">{{ $message }}*</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{$admin->email}}">
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile No.:</label>
                        <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile number" value="{{$admin->mobile}}">
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="{{$admin->address}}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                            placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                        <label for="image">Profile Image:</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Add Admin</button>
                </form>
            </div>
        </div>
    </div>
@endsection
