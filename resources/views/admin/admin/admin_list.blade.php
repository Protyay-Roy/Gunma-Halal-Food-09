@extends('admin.layouts.layout')
@section('title')
    Admin
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">All admin list</h4>
            <div class="table-responsive pt-3">
                <table id="data_table" class="table table-dark table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>
                                No.:
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
                            <th>
                                Action:
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                            <tr>
                                <td>
                                    {{$loop->index+1}}
                                </td>
                                <td>
                                    {{$admin->name}}
                                </td>
                                <td>
                                    {{$admin->email}}
                                </td>
                                <td>
                                    {{$admin->type}}
                                </td>
                                <td>
                                    {{$admin->mobile}}
                                </td>
                                <td>
                                    {{$admin->address}}
                                </td>
                                <td>
                                    <a href="{{route('add-edit.admin',$admin->email)}}" class="text-warning px-3">
                                        <i class="fa-solid fa-pencil" title="Edit Admin"></i>

                                    </a>
                                    <a href="" class="text-danger px-3">
                                        <i class="fa-solid fa-trash" title="Delete Admin"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
