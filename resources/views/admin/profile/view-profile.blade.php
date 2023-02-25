@extends('admin.layouts.layout')

@section('content')
    <div class="card">
        <div class="card-header mt-4">
            <h4 class="text-center mb-0 py-2"><i class="fa-solid fa-person"></i> {{ auth('admin')->user()->name }} Profile
            </h4>
        </div>
        <div class="card-body">
            {{-- <h4 class="card-title">All admin list</h4> --}}
            <div class="pt-3">
                @if (Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success:</strong> {{ Session('success_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                {{-- @if (Session::has('error_message'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error:</strong> {{ Session('error_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif --}}
                {{-- @foreach ($error_message as $message)
                    {{$message}}
                @endforeach --}}
                <div class="row">
                    <div class="col-4">
                        <div class="profile-image">
                            <img src="{{ url('' . auth('admin')->user()->image) }}" alt="{{ auth('admin')->user()->image }}"
                                class="img-fluid">
                            <div class="overlay text-center">
                                <div class="image-button">
                                    <a href="{{ url('' . auth('admin')->user()->image) }}" class="btn btn-info mb-4">View
                                        Image</a>
                                    {{-- <button type="button" class="btn btn-warning" data-toggle="modal"
                                        data-target="#exampleModal">
                                        Update Image
                                    </button> --}}
                                </div>
                            </div>
                        </div>

                    </div>
                    <table class="table table-bordered col-4 offset-2">
                        <tr>
                            <th>Name:</th>
                            <td>{{ auth('admin')->user()->name }}</td>
                        </tr>
                        <tr>
                            <th>Mobile:</th>
                            <td>{{ auth('admin')->user()->mobile }}</td>
                        </tr>
                        <tr>
                            <th>Address:</th>
                            <td>{{ auth('admin')->user()->address }}</td>
                        </tr>
                        <tr>
                            <th>Admin Type:</th>
                            <td>{{ auth('admin')->user()->type }}</td>
                        </tr>
                        <tr>
                            <th>Admin Status:</th>
                            <td>
                                @if (auth('admin')->user()->status === 1)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="row">
                    <div class="img-btn col-md-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <h4>Upload Profile Image</h4>
                        <form action="{{ route('upload_image') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <label for="update_image">Choose Image:</label>
                            <input type="file" name="update_image" id="update_image" class="form-control">
                            <button class="btn btn-success mt-2 float-right">Update Image</button>
                        </form>
                        {{-- @error('update_image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- <form action="{{ route('upload_image') }}" enctype="multipart/form-data" method="POST" id="myform">
            @csrf
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Update Profile Image</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label for="update_image">Choose Image:</label>
                            <input type="file" name="update_image" id="update_image" class="form-control">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="cng_prfl_img">Update Image</button>
                        </div>
                    </div>
                </div>
            </div>
        </form> --}}
    </div>
@endsection
