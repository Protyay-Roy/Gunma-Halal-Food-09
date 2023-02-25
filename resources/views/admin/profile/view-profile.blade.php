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
            <div class="row">

                <div class="col-4">
                    <div class="profile-image">
                        <img src="{{ url('' . auth('admin')->user()->image) }}" alt="{{ auth('admin')->user()->image }}"
                            class="img-fluid">
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
            </div>
        </div>
    </div>
@endsection
