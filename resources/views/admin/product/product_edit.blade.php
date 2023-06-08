@extends('layouts.dashboard')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Add New Product</a></li>
    </ol>
</nav>

<form action="{{route('product.update')}}" method="POST" enctype="multipart/form-data">
@csrf
<div class="card">
    <div class="card-header">
        <h4>Add New Product</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="mb-3">
                    <input type="hidden" name="product_id" value="{{$pro_info->id}}">
                    <label>Product Name</label>
                    <input type="text" class="form-control" name="product_name" value="{{$pro_info->product_name}}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-3">
                    <label>Product Price</label>
                    <input type="number" class="form-control" name="price" value="{{$pro_info->price}}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-3">
                    <label>Product Discount</label>
                    <input type="number" class="form-control" name="discount" value="{{$pro_info->discount}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label>Select Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">--Select any--</option>
                        @foreach ($categories as $category)
                        <option {{$category->id == $pro_info->category_id?'selected':''}} value="{{$category->id}}">{{$category->cat_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label>Select Sub Category</label>
                    <select name="subcategory_id" id="subcategory_id" class="form-control">
                        <option value="">--Select any--</option>
                        @foreach ($subcategories as $subcategory)
                        <option {{$subcategory->id == $pro_info->subcategory_id?'selected':''}} value="{{$subcategory->id}}">{{$subcategory->subcategory_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-3">
                    <label>Product Brand</label>
                    <select name="brand" class="form-control">
                        <option value="">--Select any--</option>
                        @foreach ($brands as $brand)
                        <option {{$brand->id == $pro_info->brand?'selected':''}} value="{{$brand->id}}">{{$brand->brand_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="mb-3">
                    <label>Short Description</label>
                    <input type="text" class="form-control" name="short_desp" value="{{$pro_info->short_desp}}">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mb-3">
                    <label>Long Description</label>
                    <textarea id="summernote" name="long_desp">{{$pro_info->long_desp}}</textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mb-3">
                    <label>Aditional Information</label>
                    <textarea id="summernote2" name="aditional_info">{{$pro_info->aditional_info}}</textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label>Product Preview</label>
                   <input type="file" class="form-control" name="preview">
                   <div class="my-2">
                    <img width="200" src="{{asset('uploads/product/preview')}}/{{$pro_info->preview}}" alt="">
                   </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label>Product Gallery</label>
                   <input type="file" multiple class="form-control" name="gallery[]">
                   <div class="my-2">
                    @foreach ($gall_img as $gallery)
                    <img width="100" src="{{asset('uploads/product/gallery')}}/{{$gallery->gallery}}" alt="">
                    @endforeach
                   </div>
                </div>
            </div>
            <div class="col-lg-6 m-auto">
                <div class="mt-4">
                    <button class="btn btn-primary form-control" type="submit">Update Product</button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>


@endsection

@section('footer_content')
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
    $(document).ready(function() {
        $('#summernote2').summernote();
    });
</script>
@endsection