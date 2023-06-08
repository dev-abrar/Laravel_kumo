<?php

namespace App\Http\Controllers;

use App\Mail\CustomerInvoiceMail;
use App\Models\BillingDetail;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ShippingDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Str;

class CheckoutController extends Controller
{
   function checkout(){
    $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();
    $countries = Country::all();
    return view('frontend.checkout', [
     'carts'=>$carts,
     'countries'=>$countries,
    ]);
   }

   function getCities(Request $request){
      $str = '<option value="">-- Select City --</option>';
       $cities = City::where('country_id', $request->country_id)->get();
       foreach($cities as $city){
           $str.= '<option value="'.$city->id.'">'.$city->name.'</option>';
       }
       echo $str;
   }

   function order_store(Request $request){
    $request->validate([
      'name'=>'required',
      'email'=>'required',
      'billing_number'=>'required',
      'shipping_number'=>'required',
      'country_id'=>'required',
      'city_id'=>'required',
      'address'=>'required',
      'payment_method'=>'required',
    ]);
    
     $random_number = random_int(1000, 99999);
     $city = City::find($request->city_id);
     $order_id = '#'.Str::upper(substr($city->name, 0, 3)).'_'.$random_number;
     $customer_id = Auth::guard('customerlogin')->id();

     if($request->payment_method == 1){
      Order::insert([
        'order_id'=>$order_id,
        'customer_id'=>$customer_id,
        'subtotal'=>$request->sub_total,
        'total'=>$request->sub_total+$request->charge - ($request->discount),
        'charge'=>$request->charge,
        'discount'=>$request->discount,
        'payment_method'=>$request->payment_method,
        'created_at'=>Carbon::now(),
       ]);
  
       BillingDetail::insert([
        'order_id'=>$order_id,
        'customer_id'=>$customer_id,
        'name'=> Auth::guard('customerlogin')->user()->name,
        'email'=>Auth::guard('customerlogin')->user()->email,
        'billing_number'=>$request->billing_number,
        'company'=>$request->company,
        'address'=>Auth::guard('customerlogin')->user()->address,
        'created_at'=>Carbon::now(),
       ]);
  
       ShippingDetail::insert([
        'order_id'=>$order_id,
        'name'=>$request->name,
        'email'=>$request->email,
        'shipping_number'=>$request->shipping_number,
        'country_id'=>$request->country_id,
        'city_id'=>$request->city_id,
        'address'=>$request->address,
        'zip'=>$request->zip,
        'notes'=>$request->notes,
        'created_at'=>Carbon::now(),
       ]);
  
       $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();
       
       foreach($carts as $cart){
        OrderProduct::insert([
          'order_id'=>$order_id,
          'customer_id'=>$customer_id,
          'product_id'=>$cart->product_id,
          'price'=>$cart->rel_to_product->after_discount,
          'color_id'=>$cart->color_id,
          'size_id'=>$cart->size_id,
          'quantity'=>$cart->quantity,
          'created_at'=>Carbon::now(),
         ]);
  
         Inventory::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->decrement('quantity', $cart->quantity);
  
        //  Cart::find($cart->id)->delete();
       }
  
      //  $mail = Auth::guard('customerlogin')->user()->email;
      //  Mail::to($mail)->send(new CustomerInvoiceMail($order_id)); 
  
       $new_order_id = substr($order_id, 1);
       return redirect()->route('order.success', $new_order_id)->withOrdersuccess('Ordersuccess');
     }
     elseif($request->payment_method == 2){
      $data = $request->all();
      return redirect('/pay')->with('data', $data);
     }
     else{
      $data = $request->all();
      return redirect('/stripe')->with('data', $data);
     }
   }

   function order_success($order_id){
    if(session('ordersuccess')){
      return view('frontend.order_success', compact('order_id'));
    }
    else{
      abort('404');
    }
   }
}
