@extends('admin.layouts.layout')
@section('title')
    Admin
@endsection
@section('admins_class')
    active
@endsection
{{-- @php
    $admins_class = 'active';
@endphp --}}

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header mt-4">
                <h4 class="text-center mb-0 py-2"><i class="fa-solid fa-person"></i> {{$title}}</h4>
            </div>
            <div class="card-body col-8">
                @if (Session::has('error_message'))
                    <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
                        <strong>Error:</strong> {{ Session('error_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form class="forms-sample"
                    action="{{ isset($admins->id) ? route('add-edit.admin', $admins->email) : route('add-edit.admin') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                            value="{{ $admins->name }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}*</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                            value="{{ $admins->email }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}*</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="type">Admin Type:</label>
                        <select name="type" id="type" class="form-control">
                            {{-- @if (!empty($admins->id))
                                <option value="{{$admins->type}}">{{ucfirst($admins->type)}}</option>
                                <option value="vendor" >Vendor</option>
                                <option value="admin">Admin</option>
                            @else --}}
                            <option {{(isset($admins->id) && $admins->type == 'vendor') ? 'selected' : ''}} value="vendor" >Vendor</option>
                            <option {{(isset($admins->id) && $admins->type == 'admin') ? 'selected' : ''}} value="admin">Admin</option>
                            {{-- @endif --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile No.:</label>
                        <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile number"
                            value="{{ $admins->mobile }}">
                        @error('mobile')
                            <div class="text-danger">{{ $message }}*</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="Address"
                            value="{{ $admins->address }}">
                        @error('address')
                            <div class="text-danger">{{ $message }}*</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        @error('password')
                            <div class="text-danger">{{ $message }}*</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                            placeholder="Confirm Password">
                        @error('confirm_password')
                            <div class="text-danger">{{ $message }}*</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Profile Image:</label> <small class="text-muted">(Your image size should be 1000 x 1000 pixels)</small>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        @if ($title == 'Add New Admin')
                            Add Admin
                        @else
                            Update Admin
                        @endif
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
