@extends('frontend.master')

@section('content')

<!-- ======================= Top Breadcrubms ======================== -->
<div class="gray py-3">
    <div class="container">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ======================= Top Breadcrubms ======================== -->

<!-- ======================= Dashboard Detail ======================== -->
<section class="middle">
    <div class="container">
        <div class="row justify-content-center justify-content-between">
        
            <div class="col-12 col-md-12 col-lg-4 col-xl-4 text-center miliods">
                <div class="d-block border rounded mfliud-bot">
                    <div class="dashboard_author px-2 py-5">
                        <div  class="dash_auth_thumb circle p-1 border d-inline-flex mx-auto mb-2">
                            @if (Auth::guard('customerlogin')->user()->photo == null)
                                <img src="{{ Avatar::create(Auth::guard('customerlogin')->user()->name)->toBase64() }}" />
                                @else
                                <img src="{{asset('uploads/customer')}}/{{Auth::guard('customerlogin')->user()->photo}}" alt="" class="img-fluid circle" width="100">
                                @endif
                        </div>
                        <div class="dash_caption">
                            <h4 class="fs-md ft-medium mb-0 lh-1">{{Auth::guard('customerlogin')->user()->name}}</h4>
                            <span class="text-muted smalls">{{Auth::guard('customerlogin')->user()->country}}</span>
                        </div>
                    </div>
                    
                    <div class="dashboard_author">
                        <h4 class="px-3 py-2 mb-0 lh-2 gray fs-sm ft-medium text-muted text-uppercase text-left">Dashboard Navigation</h4>
                        <ul class="dahs_navbar">
                            <li><a href="{{route('myorder')}}"><i class="lni lni-shopping-basket mr-2"></i>My Order</a></li>
                            <li><a href="{{route('wishlist')}}" class="active"><i class="lni lni-heart mr-2"></i>Wishlist</a></li>
                            <li><a href="{{route('customer.profile')}}"><i class="lni lni-user mr-2"></i>Profile Info</a></li>
                            <li><a href="{{route('customer.logout')}}"><i class="lni lni-power-switch mr-2"></i>Log Out</a></li>
                        </ul>
                    </div>
                    
                </div>
            </div>
            
            <div class="col-12 col-md-12 col-lg-8 col-xl-8 text-center">
                <!-- row -->
                <div class="row align-items-center">
                
                    <!-- Single -->
                    @forelse ($wishlist as $wish)
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <div class="product_grid card b-0">
                            <div class="badge bg-success text-white position-absolute ft-regular ab-left text-upper">Sale</div>
                            <a href="{{route('wish.delete', $wish->id)}}" class="btn btn_love position-absolute ab-right theme-cl"><i class="fas fa-times"></i></a> 
                            <div class="card-body p-0">
                                <div class="shop_thumb position-relative">
                                    <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img class="card-img-top" src="{{asset('uploads/product/preview')}}/{{$wish->rel_to_product->preview}}" alt="..."></a>
                                </div>
                            </div>
                            <div class="card-footers b-0 pt-3 px-2 bg-white d-flex align-items-start justify-content-center">
                                <div class="text-left">
                                    <div class="text-center">
                                        <div class="cart_single_caption pl-2">
                                            <h4 class="product_title fs-sm ft-medium mb-0 lh-1">{{$wish->rel_to_product->product_name}}</h4>
                                            <div class="elis_rty"><span class="ft-bold fs-md text-dark">&#2547;{{$wish->rel_to_product->after_discount}}</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="m-auto">
                        <h2 class="text-danger">No Product Wishlist</h2>
                    </div>
                    @endforelse
                </div>
                <!-- row -->
            </div>
            
        </div>
    </div>
</section>
<!-- ======================= Dashboard Detail End ======================== -->
@endsection