<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function cart_store(Request $request){
        $request->validate([
            'color_id'=>'required',
            'size_id'=>'required',
        ]);
       if(Auth::guard('customerlogin')->id()){
        if($request->btn == 1){
            if(Cart::where('customer_id', Auth::guard('customerlogin')->id())->where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->exists()){
                Cart::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->increment('quantity', $request->quantity);
            }
            else{
                Cart::insert([
                    'customer_id'=>Auth::guard('customerlogin')->id(),
                    'product_id'=>$request->product_id,
                    'color_id'=>$request->color_id,
                    'size_id'=>$request->size_id,
                    'quantity'=>$request->quantity,
                    'created_at'=>Carbon::now(),
                ]);
            }
            return back()->with('cart_added', 'Cart Successfully Added');
        }
        else{
           Wishlist::insert([
            'customer_id'=>Auth::guard('customerlogin')->id(),
            'product_id'=>$request->product_id,
           ]);
           return back();
        }
       }
       else{
       return redirect()->route('customer.register.login')->withLogin('Please Login to add cart');
       }
    }

    function cart_delete($cart_id){
       Cart::find($cart_id)->delete();
       return back();
    }

    function wish_delete($wiah_id){
        Wishlist::find($wiah_id)->delete();
        return back();
        }
  function cart_update(Request $request){
     foreach($request->quantity as $cart_id=>$quantity){
         Cart::find($cart_id)->update([
            'quantity'=>$quantity,
         ]);
        }
        return back();
  }
}
