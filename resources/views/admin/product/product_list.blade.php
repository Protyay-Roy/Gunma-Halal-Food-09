@extends('admin.layouts.layout')
@section('title')
    Admin
@endsection
@section('content')
    <div class="card">
        <div class="card-header mt-4">
            <h4 class="text-center mb-0 py-2"><i class="fa-solid fa-user"></i> &nbsp; All admin list</h4>
        </div>
        <div class="card-body body-content">
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
                <table id="bootstrap_datatable" class="table table-dark table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>
                                Products:
                            </th>
                            <th>
                                Name:
                            </th>
                            <th>
                                Add by:
                            </th>
                            <th>
                                Category:
                            </th>
                            {{-- <th>
                                Slug:
                            </th> --}}
                            <th>
                                Price:
                            </th>
                            <th>
                                Discount:
                            </th>
                            <th>
                                Product type:
                            </th>
                            <th>
                                Cutting:
                            </th>
                            <th>
                                Stock:
                            </th>
                            <th>
                                Action:
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (App\Models\Product::get() as $product)
                            <tr>
                                <td class="image_status">
                                    @if (!empty($product->image))
                                        <a href="{{ url('' . $product->image) }}" title="View Image">
                                            <img src="{{ url('' . $product->image) }}" alt="{{ $product->image }}"
                                                class="img-fluid">
                                        </a>
                                    @else
                                        <img src="{{ url('images/dummy_image/no_img.png') }}" alt="person.png"
                                            title="No Image" class="img-fluid bg-light" style="border:1px solid #ffffff">
                                    @endif
                                    @if ($product->status == 1)
                                        <a href="javascript:void(0)" class="change_status text-success"
                                            id="product-{{ $product->id }}" status_id="{{ $product->id }}"
                                            status_path="product">
                                            {{-- <i class="mdi mdi-checkbox-marked-circle" status="Active"></i> --}}
                                            <i class="fa-sharp fa-solid fa-circle-check" status="Active"></i>
                                            {{-- <i class="fa-solid fa-circle" status="Active" title="Change into inactive"></i> --}}

                                        </a>
                                    @else
                                        <a href="javascript:void(0)" class="change_status text-success"
                                            id="product-{{ $product->id }}" status_id="{{ $product->id }}"
                                            status_path="product">
                                            <i class="fa-regular fa-circle" status="Inactive"
                                                title="Change into active"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    {{ $product->name }}
                                </td>
                                <td>
                                    {{ $product->admin_id }}
                                </td>
                                <td>
                                    {{ $product->category_id }}
                                </td>
                                {{-- <td>
                                    {{ $product->slug }}
                                </td> --}}
                                <td>
                                    {{ $product->price }}
                                </td>
                                <td>
                                    {{ $product->discount }}
                                </td>
                                <td>
                                    {{ $product->product_type }}
                                </td>
                                <td>
                                    {{ $product->cutting_system }}
                                </td>
                                <td>
                                    {{ $product->stock }}
                                </td>
                                <td>
                                    <a href="{{ route('add-edit.product', $product->slug) }}" class="action_btn text-info"
                                        title="Edit Product">
                                        <i class="fa-solid fa-pen-to-square"></i>

                                    </a>
                                    <a href="javascript:" class="text-danger action_btn delete_row" title="Delete Product"
                                        delete_id={{ $product->id }} delete_path="product">
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
