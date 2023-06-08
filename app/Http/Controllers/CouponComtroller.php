<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponComtroller extends Controller
{
    function coupon(){
        $coupons = Coupon::all();
        return view('admin.product.coupon', [
            'coupons'=>$coupons,
        ]);
    }

    function coupon_store(Request $request){
        Coupon::insert([
            'coupon_name'=>$request->coupon_name,
            'type'=>$request->type,
            'amount'=>$request->amount,
            'expire_date'=>$request->expire_date,
        ]);
        return back();
    }

    function coupon_delete($coupon_id){
        Coupon::find($coupon_id)->delete();
        return back();
    }
}
