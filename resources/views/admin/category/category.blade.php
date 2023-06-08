@extends('layouts.dashboard')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item"><a href="#">Category</a></li>
    </ol>
  </nav>
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Category List</h3>
            </div>
            <div class="card-body">
                <form action="{{route('check.delete')}}" method="POST">
                    @csrf
                <table class="table table-striped">
                    <tr>
                        <th><input type="checkbox" id="checkall"> Select All</th>
                        <th>SL</th>
                        <th>Category Name</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($categories as $sl=>$category)
                        
                    <tr>
                        <td><input type="checkbox" class="category" name="category_id[]" value="{{$category->id}}"></td>
                        <td>{{$sl+1}}</td>
                        <td>{{$category->cat_name}}</td>
                        <td>
                            <img width="100" src="{{asset('uploads/category')}}/{{$category->cat_img}}" alt="">
                        </td>
                        <td>
                            <div class="dropdown mb-2">
                                <button class="btn p-0" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                  <a class="dropdown-item d-flex align-items-center" href="{{route('category.edit', $category->id)}}"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>
                                  <a class="dropdown-item d-flex align-items-center" href="{{route('category.delete', $category->id)}}"><i data-feather="trash" class="icon-sm mr-2"></i> <span class="">Delete</span></a>
                                </div>
                              </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="my-2">
                    <button type="submit" class="btn btn-danger">Delete All</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Add new Category</h6>
                <form class="forms-sample" action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control" name="cat_name">
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
                        <img width="100" id="blah" src="" alt="">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@if ($trash->count() >= 1)
<div class="row mt-5">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Trash Category List</h3>
            </div>
            <div class="card-body">
                <form action="{{route('check.restore')}}" method="POST">
                    @csrf
                <table class="table table-striped">
                    <tr>
                        <th><input id="resall" type="checkbox">Select All</th>
                        <th>SL</th>
                        <th>Category Name</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($trash as $sl=>$category)
                        
                    <tr>
                        <td><input type="checkbox" class="restore" name="cat_id[]" value="{{$category->id}}"></td>
                        <td>{{$sl+1}}</td>
                        <td>{{$category->cat_name}}</td>
                        <td>
                            <img width="100" src="{{asset('uploads/category')}}/{{$category->cat_img}}" alt="">
                        </td>
                        <td>
                            <div class="dropdown mb-2">
                                <button class="btn p-0" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                  <a class="dropdown-item d-flex align-items-center" href="{{route('category.restore', $category->id)}}"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Restore</span></a>
                                  <a class="dropdown-item d-flex align-items-center" href="{{route('category.per_delete', $category->id)}}"><i data-feather="trash" class="icon-sm mr-2"></i> <span class="">Permanent Delete</span></a>
                                </div>
                              </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="my-2">
                    <button type="submit" class="btn btn-primary">Restore All</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@section('footer_content')
<script>
    $("#checkall").on('click', function(){
    this.checked ? $(".category").prop("checked",true) : $(".category").prop("checked",false);  
})

    $("#resall").on('click', function(){
    this.checked ? $(".restore").prop("checked",true) : $(".restore").prop("checked",false);  
})
</script>
@endsection