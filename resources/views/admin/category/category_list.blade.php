@extends('admin.layouts.layout')
@section('title')
    Category
@endsection
@section('content')
    <div class="card">
        {{-- <div class="loader">
            <img src="{{ asset('images/pre_loder/loading-loading-gif.gif') }}" alt="loading..." />
        </div> --}}
        <div class="card-header mt-4">
            <h4 class="text-center mb-0 py-2"><i class="fa-solid fa-person"></i> All category list</h4>
        </div>
        <div class="card-body body-content">
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
                                Categories:
                            </th>
                            <th>
                                Name:
                            </th>
                            <th>
                                Under Category:
                            </th>
                            <th>
                                Url:
                            </th>
                            {{-- <th>
                                Meta Description:
                            </th> --}}
                            {{-- <th>
                                Description:
                            </th> --}}
                            {{-- <th>
                                Address:
                            </th> --}}
                            <th>
                                Status:
                            </th>
                            <th>
                                Action:
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (App\Models\Category::with('mainCategory')->get() as $category)
                            <tr>
                                <td class="cat_image">
                                    @if (!empty($category->image))
                                        <a href="{{ url('' . $category->image) }}" title="View Image">
                                            <img src="{{ url('' . $category->image) }}" alt="{{ $category->image }}"
                                                class="img-fluid">
                                        </a>
                                    @else
                                        <img src="{{ url('images/dummy_image/no_img.png') }}" alt="no_img.png"
                                            title="No Image" class="img-fluid bg-light" style="border:1px solid #ffffff">
                                    @endif
                                    {{-- @if ($category->status == 1)
                                        <a href="javascript:void(0)" class="change_status text-success"
                                            id="admin-{{ $category->id }}" status_id="{{ $category->id }}"
                                            status_path="category">
                                            <i class="fa-sharp fa-solid fa-circle-check" status="Active"></i>

                                        </a>
                                    @else
                                        <a href="javascript:void(0)" class="change_status text-success"
                                            id="admin-{{ $category->id }}" status_id="{{ $category->id }}"
                                            status_path="category">
                                            <i class="fa-regular fa-circle" status="Inactive"
                                                title="Change into active"></i>
                                        </a>
                                    @endif --}}
                                </td>
                                <td>
                                    {{ $category->name }}
                                </td>
                                <td>
                                    @if (!empty($category->mainCategory->name))
                                        {{$category->mainCategory->name}}
                                    @else
                                        Main Category
                                    @endif
                                </td>
                                {{-- <td>
                                    {{ ucfirst($category->meta_description) }}
                                </td> --}}
                                {{-- <td>
                                    {{ $category->description }}
                                </td> --}}
                                <td> {{ $category->slug }} </td>
                                <td>
                                    @if ($category->status == 1)
                                        <a href="javascript:void(0)" class="change_status text-success"
                                            id="category-{{ $category->id }}" status_id="{{ $category->id }}"
                                            status_path="category">
                                            <i class="fa-sharp fa-solid fa-circle-check" status="Active"></i>
                                            {{-- <i class="fa-solid fa-circle"></i> --}}

                                        </a>
                                    @else
                                        <a href="javascript:void(0)" class="change_status text-success"
                                            id="category-{{ $category->id }}" status_id="{{ $category->id }}"
                                            status_path="category">
                                            <i class="fa-regular fa-circle" status="Inactive"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('add-edit.admin', $category->slug) }}" class="action_btn text-info"
                                        title="Edit Admin">
                                        <i class="fa-solid fa-pencil"></i>

                                    </a>
                                    <a href="javascript:" class="text-danger action_btn delete_row" title="Delete Category"
                                        delete_id={{ $category->id }} delete_path="category">
                                        <i class="fa-solid fa-trash"></i>
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
