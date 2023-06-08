@extends('layouts.dashboard')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Product Coupon</a></li>
    </ol>
</nav>

<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h3>Coupon List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Coupon Name</th>
                        <th>Type Name</th>
                        <th>Amount</th>
                        <th>Expire</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($coupons as $coupon)
                        
                    <tr>
                        <td>{{$coupon->coupon_name}}</td>
                        <td>{{$coupon->type==1?'Percentage':'Fixed'}}</td>
                        <td>{{$coupon->amount}}</td>
                        <td>{{ Carbon\Carbon::now()->diffInDays($coupon->expire_date, false); }} days left</td>
                        <td>
                            <a href="{{route('coupon.delete', $coupon->id)}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Add New Coupon</h2>
            </div>
            <div class="card-body">
                <form action="{{route('coupon.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="coupon_name" placeholder="Coupon_name">
                    </div>
                    <div class="form-group">
                       <select name="type" class="form-control">
                        <option value="">-Select Type-</option>
                        <option value="1">Percentage</option>
                        <option value="2">Fixed</option>
                       </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="amount" placeholder="Amount">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" name="expire_date" placeholder="Expire_date">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add Coupon</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection