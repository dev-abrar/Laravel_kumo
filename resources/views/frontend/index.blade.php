@extends('frontend.master')

@section('content')
<!-- ======================= Category & Slider ======================== -->
<section class="p-0">
    <div class="container">
        <div class="row">
        
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                <div class="killore-new-block-link border mb-3 mt-3">
                    <div class="px-3 py-3 ft-medium fs-md text-dark gray">Top Categories</div>
                    
                    <div class="killore--block-link-content">
                        <ul>
                            @foreach ($categories as $category)
                            <li><a href="javascript:void(0);">
                                <img  width="20" src="{{asset('uploads/category/')}}/{{$category->cat_img}}" alt="">
                                &nbsp;
                                {{$category->cat_name}}
                            </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12">
                <div class="home-slider auto-slider mb-3 mt-3">

                    <!-- Slide -->
                    <div data-background-image="{{asset('frontend/img/light-banner-1.png')}}" class="item">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="home-slider-container">

                                        <!-- Slide Title -->
                                        <div class="home-slider-desc">
                                            <div class="home-slider-title mb-4">
                                                <h5 class="fs-sm ft-ragular mb-2">New Collection</h5>
                                                <h1 class="mb-2 ft-bold">The Standard<br>With <span class="theme-cl">Smartness</span></h1>
                                                <span class="trending">Apple 10 comes with 6.5 inches full HD + High Valume</span>
                                            </div>

                                            <a href="#" class="btn btn-white stretched-link hover-black">Buy Now<i class="lni lni-arrow-right ml-2"></i></a>
                                        </div>
                                        <!-- Slide Title / End -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Slide -->
                    <div data-background-image="{{asset('frontend/img/light-banner-2.png')}}" class="item">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="home-slider-container">

                                        <!-- Slide Title -->
                                        <div class="home-slider-desc">
                                            <div class="home-slider-title mb-4">
                                                <h5 class="fs-sm ft-ragular mb-2">Super Sale</h5>
                                                <h1 class="mb-2 ft-bold">The Standard<br>With <span class="text-success">Smartness</span></h1>
                                                <span class="trending">Xiomi Redmi 10 comes with 6.5 inches full HD + LCD Screen</span>
                                            </div>

                                            <a href="#" class="btn btn-white stretched-link hover-black">Shop Now<i class="lni lni-arrow-right ml-2"></i></a>
                                        </div>
                                        <!-- Slide Title / End -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide -->
                    <div data-background-image="{{asset('frontend/img/light-banner-3.png')}}" class="item">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="home-slider-container">

                                        <!-- Slide Title -->
                                        <div class="home-slider-desc">
                                            <div class="home-slider-title mb-4">
                                                <h5 class="fs-sm ft-ragular mb-2">Super Sale</h5>
                                                <h1 class="mb-2 ft-bold">The Standard<br>With Smartness</h1>
                                                <span class="trending">Xiomi Redmi 10 comes with 6.5 inches full HD + LCD Screen</span>
                                            </div>

                                            <a href="#" class="btn theme-bg text-light">Shop Now<i class="lni lni-arrow-right ml-2"></i></a>
                                        </div>
                                        <!-- Slide Title / End -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </div>
</section>
<!-- ======================= Category & Slider ======================== -->

<!-- ======================= Product List ======================== -->
<section class="middle">
    <div class="container">
    
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="sec_title position-relative text-center">
                    <h2 class="off_title">Trendy Products</h2>
                    <h3 class="ft-bold pt-3">Our Trending Products</h3>
                </div>
            </div>
        </div>
        
        <div class="row align-items-center rows-products">			
            <!-- Single -->
            @foreach ($products as $product)
            <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                <div class="product_grid card b-0">
                    @if ($product->discount)
                    <div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">Sale</div>
                    <div class="badge bg-danger text-white position-absolute ft-regular ab-right text-upper">-{{$product->discount}}%</div>
                    @endif
                    <div class="card-body p-0">
                        <div class="shop_thumb position-relative">
                            <a class="card-img-top d-block overflow-hidden" href="{{route('details', $product->slug)}}"><img class="card-img-top" src="{{asset('uploads/product/preview')}}/{{$product->preview}}" alt="..."></a>
                        </div>
                    </div>
                    <div class="card-footer b-0 p-0 pt-2 bg-white d-flex align-items-start justify-content-between">
                        <div class="text-left">
                            <div class="text-left">
                                <div class="elso_titl"><span class="small">{{$product->rel_to_category->cat_name}}</span></div>
                                <h5 class="fs-md mb-0 lh-1 mb-1"><a href="{{route('details', $product->slug)}}">{{$product->product_name}}</a></h5>
                                <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                    @php
                                    $total_review = App\Models\OrderProduct::where('product_id', $product->id)->whereNotNull('review')->count();
                                    $total_star = App\Models\OrderProduct::where('product_id', $product->id)->whereNotNull('review')->sum('star');
                                    if($total_review == 0){
                                        $avg = 0;
                                    }
                                    else{
                                        $avg = round($total_star/$total_review);
                                    }
                                    @endphp
                                   @for ($i=1; $i<=$avg; $i++)
                                        <i class="fas fa-star filled"></i>
                                   @endfor
                                   @for ($i=$avg; $i<=4; $i++)
                                        <i class="fas fa-star"></i>
                                   @endfor
                                </div>
                                <div class="elis_rty">
                                    @if ($product->discount)
                                    <span class="ft-medium text-muted line-through fs-md mr-2">&#2547; {{$product->price}}</span>
                                    @endif
                                    <span class="ft-bold theme-cl fs-lg mr-2">&#2547; {{$product->after_discount}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
        
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="position-relative text-center">
                    <a href="shop-style-1.html" class="btn stretched-link borders">Explore More<i class="lni lni-arrow-right ml-2"></i></a>
                </div>
            </div>
        </div>
        
    </div>
</section>
<!-- ======================= Product List ======================== -->

<!-- ======================= Brand Start ============================ -->
<section class="py-3 br-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="smart-brand">
                    
                    <div class="single-brnads">
                        <img src="assets/img/shop-logo-1.png" class="img-fluid" alt="" />
                    </div>
                    
                    <div class="single-brnads">
                        <img src="assets/img/shop-logo-2.png" class="img-fluid" alt="" />
                    </div>
                    
                    <div class="single-brnads">
                        <img src="assets/img/shop-logo-3.png" class="img-fluid" alt="" />
                    </div>
                    
                    <div class="single-brnads">
                        <img src="assets/img/shop-logo-4.png" class="img-fluid" alt="" />
                    </div>
                    
                    <div class="single-brnads">
                        <img src="assets/img/shop-logo-5.png" class="img-fluid" alt="" />
                    </div>
                    
                    <div class="single-brnads">
                        <img src="assets/img/shop-logo-6.png" class="img-fluid" alt="" />
                    </div>
                    
                    <div class="single-brnads">
                        <img src="assets/img/shop-logo-1.png" class="img-fluid" alt="" />
                    </div>
                    
                    <div class="single-brnads">
                        <img src="assets/img/shop-logo-2.png" class="img-fluid" alt="" />
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======================= Brand Start ============================ -->

<!-- ======================= Tag Wrap Start ============================ -->
<section class="bg-cover" style="background:url({{asset('frontend/img/e-middle-banner.png')}}) no-repeat;">
    <div class="ht-60"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="tags_explore text-center">
                    <h2 class="mb-0 text-white ft-bold">Big Sale Up To 70% Off</h2>
                    <p class="text-light fs-lg mb-4">Exclussive Offers For Limited Time</p><p>
                    <a href="#" class="btn btn-lg bg-white px-5 text-dark ft-medium">Explore Your Order</a>
                </p></div>
            </div>
        </div>
    </div>
    <div class="ht-60"></div>
</section>
<!-- ======================= Tag Wrap Start ============================ -->

<!-- ======================= All Category ======================== -->
<section class="middle">
    <div class="container">
    
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="sec_title position-relative text-center">
                    <h2 class="off_title">Popular Categories</h2>
                    <h3 class="ft-bold pt-3">Trending Categories</h3>
                </div>
            </div>
        </div>
        
        <div class="row align-items-center justify-content-center">
            @foreach ($categories as $category)
            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-4">
                <div class="cats_side_wrap text-center mx-auto mb-3">
                    <div class="sl_cat_01"><div class="d-inline-flex align-items-center justify-content-center p-4 circle mb-2 border"><a href="javascript:void(0);" class="d-block"><img src="{{asset('uploads/category')}}/{{$category->cat_img}}" class="img-fluid" width="40" alt=""></a></div></div>
                    <div class="sl_cat_02"><h6 class="m-0 ft-medium fs-sm"><a href="javascript:void(0);">{{$category->cat_name}}</a></h6></div>
                </div>
            </div>
            @endforeach
        </div>
        
    </div>
</section>
<!-- ======================= All Category ======================== -->

<!-- ======================= Customer Review ======================== -->
<section class="gray">
    <div class="container">
    
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="sec_title position-relative text-center">
                    <h2 class="off_title">Testimonials</h2>
                    <h3 class="ft-bold pt-3">Client Reviews</h3>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12">
                <div class="reviews-slide px-3">
                    
                    <!-- single review -->
                    <div class="single_review">
                        <div class="sng_rev_thumb"><figure><img src="{{asset('frontend/img/team-1.jpg')}}" class="img-fluid circle" alt="" /></figure></div>
                        <div class="sng_rev_caption text-center">
                            <div class="rev_desc mb-4">
                                <p class="fs-md">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.</p>
                            </div>
                            <div class="rev_author">
                                <h4 class="mb-0">Mark Jevenue</h4>
                                <span class="fs-sm">CEO of Addle</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- single review -->
                    <div class="single_review">
                        <div class="sng_rev_thumb"><figure><img src="{{asset('frontend/img/team-2.jpg')}}" class="img-fluid circle" alt="" /></figure></div>
                        <div class="sng_rev_caption text-center">
                            <div class="rev_desc mb-4">
                                <p class="fs-md">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.</p>
                            </div>
                            <div class="rev_author">
                                <h4 class="mb-0">Henna Bajaj</h4>
                                <span class="fs-sm">Aqua Founder</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- single review -->
                    <div class="single_review">
                        <div class="sng_rev_thumb"><figure><img src="{{asset('frontend/img/team-3.jpg')}}" class="img-fluid circle" alt="" /></figure></div>
                        <div class="sng_rev_caption text-center">
                            <div class="rev_desc mb-4">
                                <p class="fs-md">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.</p>
                            </div>
                            <div class="rev_author">
                                <h4 class="mb-0">John Cenna</h4>
                                <span class="fs-sm">CEO of Plike</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- single review -->
                    <div class="single_review">
                        <div class="sng_rev_thumb"><figure><img src="{{asset('frontend/img/team-4.jpg')}}" class="img-fluid circle" alt="" /></figure></div>
                        <div class="sng_rev_caption text-center">
                            <div class="rev_desc mb-4">
                                <p class="fs-md">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.</p>
                            </div>
                            <div class="rev_author">
                                <h4 class="mb-0">Madhu Sharma</h4>
                                <span class="fs-sm">Team Manager</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======================= Customer Review ======================== -->

<!-- ======================= Top Seller Start ============================ -->
<section class="space min">
    <div class="container">
        
        <div class="row">
            
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="top-seller-title"><h4 class="ft-medium">Top Seller</h4></div>
                <div class="ftr-content">
                
                    @foreach ($best_selling->take(3) as $best)
                    <!-- Single Item -->
                    <div class="product_grid row">
                        <div class="col-xl-4 col-lg-5 col-md-5 col-4">
                            <div class="shop_thumb position-relative">
                                <a class="card-img-top d-block overflow-hidden" href="{{route('details', $best->rel_to_product->slug)}}"><img class="card-img-top" src="{{asset('uploads/product/preview')}}/{{$best->rel_to_product->preview}}" alt="..."></a>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-7 col-md-7 col-8 pl-0">
                            <div class="text-left mfliud">
                                <div class="elso_titl"><span class="small">{{$best->rel_to_product->rel_to_category->cat_name}}</span></div>
                                <h5 class="fs-md mb-0 lh-1 mb-1 ft-medium"><a href="{{route('details', $best->rel_to_product->slug)}}">{{$best->rel_to_product->product_name}}</a></h5>
                                <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                    @php
                                        $total_review = App\Models\OrderProduct::where('product_id', $best->product_id)->whereNotNull('review')->count();
                                        $total_star = App\Models\OrderProduct::where('product_id', $best->product_id)->whereNotNull('review')->sum('star');
                                        $avg = round($total_star/$total_review);
                                    @endphp
                                    @for ($i=1; $i<=$avg; $i++)
                                    <i class="fas fa-star filled"></i>
                                    @endfor
                                    @for ($i=$avg; $i<=4; $i++)
                                    <i class="fas fa-star"></i>
                                    @endfor
                                </div>
                                <div class="elis_rty"><span class="ft-bold text-dark fs-sm">&#2547;{{$best->rel_to_product->after_discount}}</span></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="ftr-title"><h4 class="ft-medium">Top Rated Products</h4></div>
                <div class="ftr-content">
                    @foreach ($top_selling->take(3) as $rate)
                    <!-- Single Item -->
                    <div class="product_grid row">
                        <div class="col-xl-4 col-lg-5 col-md-5 col-4">
                            <div class="shop_thumb position-relative">
                                <a class="card-img-top d-block overflow-hidden" href="{{route('details', $rate->rel_to_product->slug)}}"><img class="card-img-top" src="{{asset('uploads/product/preview')}}/{{$rate->rel_to_product->preview}}" alt="..."></a>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-7 col-md-7 col-8 pl-0">
                            <div class="text-left mfliud">
                                <div class="elso_titl"><span class="small">{{$rate->rel_to_product->rel_to_category->cat_name}}</span></div>
                                <h5 class="fs-md mb-0 lh-1 mb-1 ft-medium"><a href="{{route('details', $rate->rel_to_product->slug)}}">{{$rate->rel_to_product->product_name}}</a></h5>
                                <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                    @php
                                    $total_review = App\Models\OrderProduct::where('product_id', $rate->product_id)->whereNotNull('review')->count();
                                    $total_star = App\Models\OrderProduct::where('product_id', $rate->product_id)->whereNotNull('review')->sum('star');
                                    $avg = round($total_star/$total_review);
                                    @endphp
                                    @for ($i=1; $i<=$avg; $i++)
                                    <i class="fas fa-star filled"></i>
                                    @endfor
                                    @for ($i=$avg; $i<=4; $i++)
                                    <i class="fas fa-star"></i>
                                    @endfor
                                </div>
                                <div class="elis_rty"><span class="ft-bold text-dark fs-sm">&#2547;{{$rate->rel_to_product->after_discount}}</span></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="ftr-title"><h4 class="ft-medium">Recent Products</h4></div>
                <div class="ftr-content">
                    <!-- Single Item -->
                    <div class="product_grid row">
                        <div class="col-xl-4 col-lg-5 col-md-5 col-4">
                            <div class="shop_thumb position-relative">
                                <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img class="card-img-top" src="assets/img/shop/7.png" alt="..."></a>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-7 col-md-7 col-8 pl-0">
                            <div class="text-left mfliud">
                                <div class="elso_titl"><span class="small">TV/LED</span></div>
                                <h5 class="fs-md mb-0 lh-1 mb-1 ft-medium"><a href="shop-single-v1.html">Smart 43 Inch LED</a></h5>
                                <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="elis_rty"><span class="ft-bold text-dark fs-sm">$909 - $1400</span></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Single Item -->
                    <div class="product_grid row">
                        <div class="col-xl-4 col-lg-5 col-md-5 col-4">
                            <div class="shop_thumb position-relative">
                                <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img class="card-img-top" src="assets/img/shop/8.png" alt="..."></a>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-7 col-md-7 col-8 pl-0">
                            <div class="text-left mfliud">
                                <div class="elso_titl"><span class="small">Headphone</span></div>
                                <h5 class="fs-md mb-0 lh-1 mb-1 ft-medium"><a href="shop-single-v1.html">Vivo Smart Headphone</a></h5>
                                <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="elis_rty"><span class="ft-bold text-dark fs-sm">$129 - $549</span></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Single Item -->
                    <div class="product_grid row">
                        <div class="col-xl-4 col-lg-5 col-md-5 col-4">
                            <div class="shop_thumb position-relative">
                                <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img class="card-img-top" src="assets/img/shop/9.png" alt="..."></a>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-7 col-md-7 col-8 pl-0">
                            <div class="text-left mfliud">
                                <div class="elso_titl"><span class="small">Mobiles</span></div>
                                <h5 class="fs-md mb-0 lh-1 mb-1 ft-medium"><a href="shop-single-v1.html">Micro Android Phones</a></h5>
                                <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="elis_rty"><span class="ft-bold text-dark fs-sm">$990 - $1949</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
</section>
<!-- ======================= Top Seller Start ============================ -->
@endsection