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
                        <li class="breadcrumb-item"><a href="#">Support</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ======================= Top Breadcrubms ======================== -->

<!-- ======================= Product Detail ======================== -->
<section class="middle">
    <div class="container">
    
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="text-center d-block mb-5">
                    <h2>Checkout</h2>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-between">
            <div class="col-12 col-lg-7 col-md-12">
                <form action="{{route('order.store')}}" method="POST">
                    @csrf
                    <h5 class="mb-4 ft-medium">Billing Details</h5>
                    <div class="row mb-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark">Full Name *</label>
                                <input type="text" class="form-control" readonly value="{{Auth::guard('customerlogin')->user()->name}}" />
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="text-dark">Email *</label>
                                <input type="email" class="form-control" readonly value="{{Auth::guard('customerlogin')->user()->email}}" />
                            </div>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="text-dark">Company</label>
                                <input type="text" name="company" class="form-control" placeholder="Company Name (optional)" />
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <input type="hidden" name="customer_id" value="{{Auth::guard('customerlogin')->id()}}">
                                <label class="text-dark">Mobile Number *</label>
                                <input type="number" name="billing_number" class="form-control" placeholder="Mobile Number" />
                                @error('billing_number')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <h5 class="mb-4 ft-medium mt-4">Shipping Details</h5>
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark">Full Name *</label>
                                <input type="text" name="name" class="form-control" value="{{Auth::guard('customerlogin')->user()->name}}" />
                                @error('name')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="text-dark">Email *</label>
                                <input type="email" name="email" class="form-control" value="{{Auth::guard('customerlogin')->user()->email}}" />
                                @error('email')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="text-dark">Mobile Number *</label>
                                <input type="number" name="shipping_number" class="form-control" placeholder="Mobile Number" />
                                @error('shipping_number')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark">Country *</label>
                                <select class="custom-select country_id" name="country_id">
                                  <option value="">-- Select Country --</option>
                                  @foreach ($countries as $country)
                                  <option value="{{$country->id}}">{{$country->name}}</option>
                                  @endforeach
                                </select>
                                @error('country_id')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark">City *</label>
                                <select class="custom-select city_id" name="city_id">
                                  <option value="">-- Select City --</option>
                                </select>
                                @error('city_id')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark">Address *</label>
                                <input type="text" name="address" class="form-control" value="{{Auth::guard('customerlogin')->user()->address}}" />
                                @error('address')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="text-dark">ZIP / Postcode *</label>
                                <input type="text" name="zip" class="form-control" placeholder="Zip / Postcode" />
                            </div>
                        </div>
                        
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="text-dark">Additional Information</label>
                                <textarea name="notes" class="form-control ht-50"></textarea>
                            </div>
                        </div>
                    </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-12 col-lg-4 col-md-12">
                <div class="d-block mb-3">
                    <h5 class="mb-4">Order Items ({{$carts->count()}})</h5>
                    <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">
                        @php
                            $sub_total = 0;
                        @endphp
                        @foreach ($carts as $cart)
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <!-- Image -->
                                    <a href="{{route('details', $cart->product_id)}}"><img src="{{asset('uploads/product/preview')}}/{{$cart->rel_to_product->preview}}" alt="..." class="img-fluid"></a>
                                </div>
                                <div class="col d-flex align-items-center">
                                    <div class="cart_single_caption pl-2">
                                        <h4 class="product_title fs-md ft-medium mb-1 lh-1">{{$cart->rel_to_product->product_name}}</h4>
                                        <p class="mb-1 lh-1"><span class="text-dark">Size: {{$cart->rel_to_size->size_name}}</span></p>
                                        <p class="mb-3 lh-1"><span class="text-dark">Color: {{$cart->rel_to_color->color_name}}</span></p>
                                        <h4 class="fs-md ft-medium mb-3 lh-1">&#2547; {{$cart->rel_to_product->after_discount}}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                            @php
                                $sub_total += $cart->rel_to_product->after_discount*$cart->quantity;
                            @endphp
                        @endforeach
                    </ul>
                </div>
                
                <div class="mb-4">
                    <div class="form-group">
                        <h6>Delivery Location</h6>
                        @error('charge')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                        <ul class="no-ul-list">
                            <li>
                                <input id="c1" class="radio-custom charge" name="charge" type="radio" value="60">
                                <label for="c1" class="radio-custom-label">Inside City</label>
                            </li>
                            <li>
                                <input id="c2" class="radio-custom charge" name="charge" type="radio" value="120">
                                <label for="c2" class="radio-custom-label">Outside City</label>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="form-group">
                        <h6>Select Payment Method</h6>
                        @error('payment_method')
                          <strong class="text-danger">{{$message}}</strong>
                        @enderror
                        <ul class="no-ul-list">
                            <li>
                                <input id="c3" value="1" class="radio-custom" name="payment_method" type="radio">
                                <label for="c3" class="radio-custom-label">Cash on Delivery</label>
                            </li>
                            <li>
                                <input id="c4" value="2" class="radio-custom" name="payment_method" type="radio">
                                <label for="c4" class="radio-custom-label">Pay With SSLCommerz</label>
                            </li>
                            <li>
                                <input id="c5" value="3" class="radio-custom" name="payment_method" type="radio">
                                <label for="c5" class="radio-custom-label">Pay With Stripe</label>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="card mb-4 gray">
                  <div class="card-body">
                    <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Subtotal</span> <span class="ml-auto text-dark ft-medium">&#2547;{{$sub_total}}</span>
                      </li>
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Discount</span> <span class="ml-auto text-dark ft-medium">&#2547;{{session('discount')}}</span>
                      </li>
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Charge</span> <span class="ml-auto text-dark ft-medium">&#2547; <span id="charge">0</span></span>
                      </li>
                      <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                        <span>Total</span> <span class="ml-auto text-dark ft-medium">&#2547;<span id="grand_total">{{$sub_total - session('discount')}}</span></span>
                      </li>
                    </ul>
                  </div>
                </div>
                <input type="hidden" class="sub_total" name="sub_total" value="{{$sub_total}}">
                <input type="hidden" class="discount" name="discount" value="{{session('discount')}}">
                
                <button type="submit" class="btn btn-block btn-dark mb-3" href="checkout.html">Place Your Order</button>
            </form>
            </div>
            
        </div>
        
    </div>
</section>
<!-- ======================= Product Detail End ======================== -->
@endsection
@section('footer_content')
<script>
    $('.charge').click(function(){
        var charge = $(this).val(); 
        var discount = $('.discount').val(); 
        var sub_total = $('.sub_total').val(); 
        var total = sub_total - discount + (parseInt(charge));
        $('#grand_total').html(total);
        $('#charge').html(charge);
    });
    // Select 2
    $(document).ready(function() {
        $('.country_id').select2();
        $('.city_id').select2();
    });
</script>

<script>
    $('.country_id').change(function(){
        var country_id = $(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:'/getCities',
            data:{'country_id': country_id},
            success:function(data){
                $('.city_id').html(data);
           }
        });
        
    });
</script>
@endsection