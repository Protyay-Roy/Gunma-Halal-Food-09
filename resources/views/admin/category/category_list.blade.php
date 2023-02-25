@extends('admin.layouts.layout')
@section('title')
    Admin
@endsection
@section('content')
    <div class="card">
        <div class="card-header mt-4    ">
            <h4 class="text-center mb-0 py-2"><i class="fa-solid fa-person"></i> All admin list</h4>
        </div>
        <div class="card-body">
            {{-- <h4 class="card-title">All admin list</h4> --}}
            <div class="table-responsive pt-3">
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
                <table id="bootstrap_datatable" class="table table-dark table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>
                                Admins:
                            </th>
                            <th>
                                Name:
                            </th>
                            <th>
                                Email:
                            </th>
                            <th>
                                Type:
                            </th>
                            <th>
                                Mobile:
                            </th>
                            <th>
                                Address:
                            </th>
                            {{-- <th>
                                Status:
                            </th> --}}
                            <th>
                                Action:
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                            <tr>
                                <td class="image_status">
                                    <a href="{{ url('' . $admin->image) }}" title="View Image">
                                        <img src="{{ url('' . $admin->image) }}" alt="{{ $admin->image }}">
                                    </a>
                                    @if ($admin->status == 1)
                                        <a href="javascript:void(0)" class="change_status text-success"
                                            id="admin-{{ $admin->id }}" status_id="{{ $admin->id }}"
                                            status_path="admin">
                                            {{-- <i class="mdi mdi-checkbox-marked-circle" status="Active"></i> --}}
                                            <i class="fa-sharp fa-solid fa-circle-check" status="Active"></i>
                                            {{-- <i class="fa-solid fa-circle" status="Active" title="Change into inactive"></i> --}}

                                        </a>
                                    @else
                                        <a href="javascript:void(0)" class="change_status text-success"
                                            id="admin-{{ $admin->id }}" status_id="{{ $admin->id }}"
                                            status_path="admin">
                                            <i class="fa-regular fa-circle" status="Inactive"
                                                title="Change into active"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    {{ $admin->name }}
                                </td>
                                <td>
                                    {{ $admin->email }}
                                </td>
                                <td>
                                    {{ ucfirst($admin->type) }}
                                </td>
                                <td>
                                    {{ $admin->mobile }}
                                </td>
                                <td>
                                    {{ $admin->address }}
                                </td>
                                {{-- <td>
                                    @if ($admin->status == 1)
                                        <a href="javascript:void(0)" class="change_status text-success"
                                        id="brand-{{ $admin->id }}" status_id="{{ $admin->id }}"
                                            status_path="brand">
                                            <i class="fa-sharp fa-solid fa-circle-check" status="Active"></i>
                                            <i class="fa-solid fa-circle"></i>

                                        </a>
                                    @else
                                        <a href="javascript:void(0)" class="change_status text-success"
                                            id="brand-{{ $admin->id }}" status_id="{{ $admin->id }}"
                                            status_path="brand">
                                            <i class="fa-regular fa-circle" status="Inactive"></i>
                                        </a>
                                    @endif
                                </td> --}}
                                <td>
                                    <a href="{{ route('add-edit.admin', $admin->email) }}" class="action_btn text-info"
                                        title="Edit Admin">
                                        <i class="fa-solid fa-pencil"></i>

                                    </a>
                                    @if ($admin->type !== 'admin')
                                        <a href="" class="action_btn text-danger" title="Delete Admin">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
