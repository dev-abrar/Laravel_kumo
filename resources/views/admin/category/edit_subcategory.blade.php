@extends('layouts.dashboard')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item"><a href="#">Edit Sub Category</a></li>
    </ol>
  </nav>
<div class="row">
    <div class="col-lg-4 m-auto">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Add new Sub Category</h6>
                <form class="forms-sample" action="{{route('subcategory.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Sub Category Name</label>
                        <input type="text" class="form-control" name="subcategory_name" placeholder="Sub Category Name" value="{{$subcategories_info->subcategory_name}}">
                    </div>
                    <div class="form-group">
                        <label>Category Name</label>
                        <select name="category_id" class="form-control">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{$category->id == $subcategories_info->category_id?'selected':''}}>{{$category->cat_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Cateory Image</label>
                        <input type="file" class="form-control" name="subcategory_img" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        @error('subcategory_img')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="my-2">
                        <img width="100" id="blah" src="{{asset('uploads/subcategory')}}/{{$subcategories_info->subcategory_img}}" alt="">
                    </div>
                    <input type="hidden" name="subcategory_id" value="{{$subcategories_info->id}}">
                    <button type="submit" class="btn btn-primary mr-2">SubCategory Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
  @endsection