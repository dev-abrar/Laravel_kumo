@extends('layouts.dashboard')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item"><a href="#">Edit Category</a></li>
    </ol>
  </nav>
<div class="row">
    <div class="col-lg-4 m-auto">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Add new Category</h6>
                <form class="forms-sample" action="{{route('category.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control" name="cat_name" value="{{$category_info->cat_name}}">
                        @error('cat_name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Cateory Image</label>
                        <input type="file" class="form-control" name="cat_img" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        @error('cat_img')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="my-2">
                        <img width="100" id="blah" src="{{asset('uploads/category')}}/{{$category_info->cat_img}}" alt="">
                    </div>
                    <input type="hidden" name="cat_id" value="{{$category_info->id}}">
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
  @endsection