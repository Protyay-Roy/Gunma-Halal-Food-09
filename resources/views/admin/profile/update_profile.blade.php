@extends('admin.layouts.layout')
@section('title')
    Profile
@endsection
@section('content')
    <div class="card">
        <div class="card-header mt-4">
            <h4 class="text-center mb-0 py-2"><i class="fa-solid fa-person"></i> Update Your Profile Information
            </h4>
        </div>
        <div class="card-body p-0">
            <div class="pt-3">
                @if (Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success:</strong> {{ Session('success_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (Session::has('error_message'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error:</strong> {{ Session('error_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-6">
                        <div class="form_card">
                            <h4>Update Personal Information</h4>
                            <form>
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input type="email" class="form-control" value="{{ auth('admin')->user()->email }}"
                                        readonly>
                                    <small class="form-text text-muted">This email can't be changed.</small>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ auth('admin')->user()->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile:</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" value="{{ auth('admin')->user()->mobile }}">
                                </div>
                                <div class="form-group">
                                    <label for="address">Address:</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ auth('admin')->user()->address }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </form>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form_card">
                            <h4>Change Password</h4>
                            <form>
                                <div class="form-group">
                                    <label for="old_password">Old Password</label>
                                    <input type="text" class="form-control" id="old_password" name="old_password" placeholder="Enter old password">
                                </div>
                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <input type="text" class="form-control" id="new_password" name="new_password" placeholder="Enter New password">
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="text" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password">
                                </div>
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
