@extends('layouts.dashboard')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Add New Brand</a></li>
    </ol>
</nav>
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Category List</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>SL</th>
                        <th>Brand Name</th>
                        <th>Brand Logo</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($brands as $sl=>$brand)
                        
                    <tr>
                        <td>{{$sl+1}}</td>
                        <td>{{$brand->brand_name}}</td>
                        <td>
                            @if ($brand->brand_logo == null)
								<img src="{{ Avatar::create($brand->brand_name)->toBase64() }}" />
								@else
								<img src="{{ asset('uploads/brand') }}/{{$brand->brand_logo}}" />
								@endif
                        </td>
                        <td>
                          <a href="{{route('brand.delete', $brand->id)}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    
                </table>
                {{$brands->links()}}
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Add new Brand</h6>
                <form class="forms-sample" action="{{route('brand.store')}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Brand Name</label>
                        <input type="text" class="form-control" name="brand_name" placeholder="Brand Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Brand Logo</label>
                        <input type="file" class="form-control" name="brand_logo"
                            onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        
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
@endsection
