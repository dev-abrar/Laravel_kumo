@extends('layouts.dashboard')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Edit Product</a></li>
    </ol>
</nav>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>Product List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>After Discount</th>
                        <th>Preview</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($products as $product)
                        
                    <tr>
                        <td>{{$product->product_name}}</td>
                        <td>&#2547;{{$product->price}}</td>
                        <td>{{$product->discount==null?'0':$product->discount}}%</td>
                        <td>&#2547;{{$product->after_discount}}</td>
                        <td>
                            <img width="200" src="{{asset('uploads/product/preview')}}/{{$product->preview}}" alt="">
                        </td>
                        <td>  
                            <a href="{{route('product.inventory', $product->id)}}" name="product_id" value="{{$product->id}}" class="btn btn-primary btn-icon"> <i data-feather="layers"></i></a>
                           <form action="{{route('edit.product')}}" method="GET" class="d-inline">
                            @csrf
                            <button type="submit" name="product_id" value="{{$product->id}}" class="btn btn-success btn-icon">
                                <i data-feather="edit"></i>
                            </button>
                           </form>
                           <button class="btn btn-danger btn-icon d_btn" data-id='{{route('product.delete', $product->id)}}'><i data-feather="trash"></i></button>
                            
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_content')
<script>
    $('.d_btn').click(function(){
         Swal.fire({
             title: 'Are you sure?',
             text: "You won't be able to revert this!",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes, delete it!'
             }).then((result) => {
             if (result.isConfirmed) {
                 link = $(this).attr('data-id');
                 window.location.href = link;
             }
             })
       });
 
 </script>
    @if (session('success'))
         <script>
             Swal.fire(
                 'Deleted!',
                 'Your user has been deleted.',
                 'success'
                 )
         </script>
     
    @endif
@endsection

