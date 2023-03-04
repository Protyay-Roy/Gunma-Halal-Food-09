@extends('admin.layouts.layout')
@section('title')
    Add Category
@endsection
{{-- @section('admins_class')
    active
@endsection --}}

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header mt-4">
                <h4 class="text-center mb-0 py-2"><i class="fa-solid fa-person"></i> {{ $title }} Category</h4>
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
                    action="{{ isset($categories->id) ? route('add-edit.category', $categories->slug) : route('add-edit.category') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"
                            value="{{ $categories->name }}">
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category Type:</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="{{ null }}">Main Category</option>
                            @foreach (App\Models\Category::where(['category_id'=>null,'status'=>1])->select('id', 'name')->get() as $category)
                                <option value="{{ $category->id }}"
                                    {{ !empty($category->id) & ($categories->category_id == $category->id) ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('name')
                            <div class="text-danger">{{ $message }}*</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="meta_description">Meta Description:</label>
                        <input type="text" class="form-control" id="meta_description" name="meta_description"
                            placeholder="Enter Meta Description" value="{{ $categories->meta_description }}">
                        @error('meta_description')
                            <div class="text-danger">{{ $message }}*</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        {{-- <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description"
                            value="{{ $categories->description }}"> --}}
                        @if (!empty($categories->id))
                            <textarea name="description" id="description" class="form-control" rows="4">
                                {{ $categories->description }}
                            </textarea>
                        @else
                            <textarea name="description" id="description" class="form-control" rows="4"></textarea>
                        @endif
                        {{-- <textarea name="description" id="description" class="form-control"  rows="4">
                                {{!empty($categories->description) ? $categories->description : ''}}
                            </textarea> --}}
                        @error('description')
                            <div class="text-danger">{{ $message }}*</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="slug">Url:</label> <small class="text-muted">(Url must be unique.)</small>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter Url"
                            value="{{ $categories->slug }}">
                        @error('slug')
                            <div class="text-danger">{{ $message }}*</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Category Image:</label> <small class="text-muted">(Your image size should be
                            1000 x 1000 pixels)</small>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        @if ($title == 'Add')
                            <i class="fa-solid fa-plus"></i> &nbsp; Add Category
                        @else
                            <i class="fa-solid fa-rotate"></i> &nbsp; Update Category
                        @endif
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
