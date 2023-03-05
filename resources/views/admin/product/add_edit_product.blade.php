@extends('admin.layouts.layout')
@section('title')
    Admin
@endsection
@section('admins_class')
    active
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header mt-4">
                <h4 class="text-center mb-0 py-2">
                    {{-- <i class="fa-solid fa-person"></i>  &nbsp; --}}
                    {{-- {{$title}} --}}
                    {{-- @php
                        echo $title;
                    @endphp --}}
                    @if ($title == 'Add')
                        <i class="fa-solid fa-user-plus"></i> &nbsp; Add New Admin
                    @else
                        <i class='fa-solid fa-user-pen'></i> &nbsp; Update Admin Information
                    @endif
                </h4>
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
                    action="{{ isset($products->id) ? route('add-edit.product', $products->slug) : route('add-edit.product') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                            value="{{ $products->name }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}*</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                            value="{{ $products->name }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}*</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="slug">Url/Slug:</label>
                        <input type="text" class="form-control" id="slug" name="slug"
                            placeholder="Enter url/slug" value="{{ $products->slug }}">
                        @error('slug')
                            <div class="text-danger">{{ $message }}*</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price"
                            value="{{ $products->price }}">
                        @error('price')
                            <div class="text-danger">{{ $message }}*</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="discount">Discount:</label>
                        <input type="text" class="form-control" id="discount" name="discount"
                            placeholder="Enter discount" value="{{ $products->discount }}">
                        @error('discount')
                            <div class="text-danger">{{ $message }}*</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock:</label>
                        <input type="text" class="form-control" id="stock" name="stock" placeholder="Enter stock"
                            value="{{ $products->stock }}">
                        @error('stock')
                            <div class="text-danger">{{ $message }}*</div>
                        @enderror
                    </div>
                    <div class="form-group" style="border: 1px solid #CED4DA; padding: 0.7rem;border-radius: 0.3125rem">
                        <div class="row">
                            <div class="col-6">
                                <h5>Select your product type:</h5>
                                <div class="d-flex">
                                    <div class="mr-2">
                                        <input type="radio" id="dry" name="product_type" value="Dry">
                                    <label for="dry">Dry</label>
                                    </div>
                                    <div class="ml-2">
                                        <input type="radio" id="frozen" name="product_type" value="Frozen">
                                    <label for="frozen">Frozen</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <h5>Do this product have any cutting system?:</h5>
                                <div class="d-flex">
                                    <div class="mr-2">
                                        <input type="radio" id="yes" name="cutting_system" value="Yes">
                                    <label for="yes">Yes</label>
                                    </div>
                                    <div class="ml-2">
                                        <input type="radio" id="no" name="cutting_system" value="No">
                                    <label for="no">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image">Profile Image:</label> <small class="text-muted">(Your image size should be
                            1000 x 1000 pixels)</small>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        @if ($title == 'Add')
                            <i class="fa-solid fa-plus"></i> &nbsp; Add Admin
                        @else
                            <i class="fa-solid fa-rotate"></i> &nbsp; Update Admin
                        @endif
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
