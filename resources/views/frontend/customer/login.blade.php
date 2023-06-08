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
									<li class="breadcrumb-item"><a href="#">Pages</a></li>
									<li class="breadcrumb-item active" aria-current="page">Login</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<!-- ======================= Top Breadcrubms ======================== -->
			
			<!-- ======================= Login Detail ======================== -->
			<section class="middle">
				<div class="container">
					<div class="row align-items-start justify-content-between">
					
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
							
							<div class="mb-3">
								<h3>Login</h3>
								@if (session('not_verified'))
									<div class="alert alert-danger">{{session('not_verified')}}</div>
								@endif 
								@if (session('wrong'))
									<div class="alert alert-danger">{{session('wrong')}}</div>
								@endif 
								@if (session('login'))
									<div class="alert alert-danger">{{session('login')}}</div>
								@endif 
								@if (session('verified_email'))
									<div class="alert alert-success">{{session('verified_email')}}</div>
								@endif 
							</div>
							<form class="border p-3 rounded" action="{{route('customer.login')}}" method="POST">
								@csrf	
								<div class="form-group">
									<label>Email *</label>
									<input type="text" name="log_email" class="form-control" placeholder="Email*">
									@error('log_email')
										<strong class="text-danger">{{$message}}</strong>
									@enderror
								</div>
								
								<div class="form-group">
									<label>Password *</label>
									<input type="password" name="password" class="form-control" placeholder="Password*">
									@error('password')
										<strong class="text-danger">{{$message}}</strong>
									@enderror
								</div>
								
								<div class="form-group">
									<div class="d-flex align-items-center justify-content-between">
										<div class="eltio_k2">
											<a href="{{route('forgot.pass')}}">Lost Your Password?</a>
										</div>	
									</div>
								</div>
								
								<div class="form-group">
									<button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Login</button>
								</div>
							</form>
						</div>
						
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mfliud">
							<div class="mb-3">
								<h3>Register</h3>
							</div>
							@if (session('email_ver'))
							<div class="alert alert-success">{{session('email_ver')}}</div>
							@endif
							<form class="border p-3 rounded" action="{{route('customer.register.store')}}" method="POST">
								@csrf
								<div class="row">
									<div class="form-group col-md-12">
										<label>Full Name *</label>
										<input name="name" type="text" class="form-control" placeholder="Full Name">
										@error('name')
											<strong class="text-danger">{{ $message }}</strong>
										@enderror
									</div>
								</div>
								
								<div class="form-group">
									<label>Email *</label>
									<input name="email" type="text" class="form-control" placeholder="Email*">
									@error('email')
											<strong class="text-danger">{{ $message }}</strong>
										@enderror
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label>Password *</label>
										<input name="password" type="password" class="form-control" placeholder="Password*">
										@error('password')
											<strong class="text-danger">{{ $message }}</strong>
										@enderror
									</div>
									
									
									<div class="form-group col-md-6">
										<label>Confirm Password *</label>
										<input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password*">
									</div>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Create An Account</button>
								</div>
							</form>
						</div>
						
					</div>
				</div>
			</section>
			<!-- ======================= Login End ======================== -->
			
			<!-- ============================= Customer Features =============================== -->
			<section class="px-0 py-3 br-top">
				<div class="container">
					<div class="row">
						
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
							<div class="d-flex align-items-center justify-content-start py-2">
								<div class="d_ico">
									<i class="fas fa-shopping-basket theme-cl"></i>
								</div>
								<div class="d_capt">
									<h5 class="mb-0">Free Shipping</h5>
									<span class="text-muted">Capped at $10 per order</span>
								</div>
							</div>
						</div>
						
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
							<div class="d-flex align-items-center justify-content-start py-2">
								<div class="d_ico">
									<i class="far fa-credit-card theme-cl"></i>
								</div>
								<div class="d_capt">
									<h5 class="mb-0">Secure Payments</h5>
									<span class="text-muted">Up to 6 months installments</span>
								</div>
							</div>
						</div>
						
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
							<div class="d-flex align-items-center justify-content-start py-2">
								<div class="d_ico">
									<i class="fas fa-shield-alt theme-cl"></i>
								</div>
								<div class="d_capt">
									<h5 class="mb-0">15-Days Returns</h5>
									<span class="text-muted">Shop with fully confidence</span>
								</div>
							</div>
						</div>
						
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
							<div class="d-flex align-items-center justify-content-start py-2">
								<div class="d_ico">
									<i class="fas fa-headphones-alt theme-cl"></i>
								</div>
								<div class="d_capt">
									<h5 class="mb-0">24x7 Fully Support</h5>
									<span class="text-muted">Get friendly support</span>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</section>
			<!-- ======================= Customer Features ======================== -->
@endsection