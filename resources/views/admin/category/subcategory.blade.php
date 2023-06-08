@extends('layouts.dashboard')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item"><a href="#">Sub Category</a></li>
    </ol>
  </nav>

  <div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Category List</h3>
            </div>
            @if (session('sub_del'))
            <strong class="alert alert-success">{{session('sub_del')}}</strong>
                
            @endif
            <div class="card-body">
                <form action="{{route('subcheck.delete')}}" method="POST">
                    @csrf
                <table class="table table-striped">
                    <tr>
                        <th><input type="checkbox" id="suball"> Select All</th>
                        <th>SL</th>
                        <th>Sub Category Name</th>
                        <th>Category Name</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>

                    @forelse ($subcategoires as $sl=>$subcategory)
                        
                    <tr>
                        <td><input type="checkbox" class="subcategory" name="subcategory_id[]" value="{{$subcategory->id}}"></td>
                        <td>{{$sl+1}}</td>
                        <td>{{$subcategory->subcategory_name}}</td>
                        <td>
                            @if ($subcategory->category_id != null)
                                {{$subcategory->rel_to_category->cat_name}}
                                @else
                                {{'jkhsa'}}
                            @endif
                        </td>
                        <td>
                            <img width="100" src="{{asset('uploads/subcategory')}}/{{$subcategory->subcategory_img}}" alt="">
                        </td>
                        <td>
                            <a href="{{route('sub.edit', $subcategory->id)}}" class="btn btn-info">Edit</a>
                           <a href="{{route('sub.delete', $subcategory->id)}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="5"><strong class="text-danger">No data Found</strong></td>
                    </tr>
                    @endforelse
                </table>
                <div class="my-2">
                    <button type="submit" class="btn btn-danger">Delete All</button>
                </div>
            </form>
            </div>
        </div>

        @if ($trash_sub->count() >= 1)
        <div class="card">
            <div class="card-header">
                <h3>Category List</h3>
            </div>
            @if (session('pdel'))
            <strong class="alert alert-success">{{session('pdel')}}</strong>
                
            @endif
            <div class="card-body">
                <form action="{{route('checkall.restore')}}" method="POST">
                    @csrf
                <table class="table table-striped">
                    <tr>
                        <th><input type="checkbox" id="subreskall"> Select All</th>
                        <th>SL</th>
                        <th>Sub Category Name</th>
                        <th>Category Name</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($trash_sub as $sl=>$subcategory)
                        
                    <tr>
                        <td><input type="checkbox" class="subrescategory" name="subcategory_id[]" value="{{$subcategory->id}}"></td>
                        <td>{{$sl+1}}</td>
                        <td>{{$subcategory->subcategory_name}}</td>
                        <td>{{$subcategory->rel_to_category->cat_name}}</td>
                        <td>
                            <img width="100" src="{{asset('uploads/subcategory')}}/{{$subcategory->subcategory_img}}" alt="">
                        </td>
                        <td>
                           <a href="{{route('sub.restore', $subcategory->id)}}" class="btn btn-primary">Restore</a>
                           <a href="{{route('sub.pdelete', $subcategory->id)}}" class="btn btn-danger">Permanent Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="my-2">
                    <button type="submit" name="btn" value="1" class="btn btn-primary">Restore All</button>
                    <button type="submit" name="btn" value="2" class="btn btn-danger">Delete All</button>
                </div>
            </form>
            </div>
        </div>
        @endif
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Add new Sub Category</h6>
                <form class="forms-sample" action="{{route('subcategory.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Sub Category Name</label>
                        <input type="text" class="form-control" name="subcategory_name" placeholder="Sub Category Name">
                    </div>
                    <div class="form-group">
                        <label>Category Name</label>
                        <select name="category_id" class="form-control">
                            <option>--Select Category--</option>
                            @foreach ($categoires as $category)
                            <option value="{{$category->id}}">{{$category->cat_name}}</option>
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
                        <img width="100" id="blah" src="" alt="">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Add Subcategory</button>
                </form>
            </div>
        </div>
    </div>
  </div>

  @endsection

  @section('footer_content')
  <script>
      $("#suball").on('click', function(){
          this.checked ? $(".subcategory").prop("checked",true) : $(".subcategory").prop("checked",false);  
        })
        
        $("#subreskall").on('click', function(){
            this.checked ? $(".subrescategory").prop("checked",true) : $(".subrescategory").prop("checked",false);  
        })
    </script>

  @endsection