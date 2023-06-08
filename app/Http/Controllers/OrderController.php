<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class OrderController extends Controller
{
   function orders(){
    $orders = Order::all();
    return view('admin.order.orders', [
        'orders'=>$orders,
    ]);
   }

   function status_update(Request $request){
     Order::where('order_id', $request->order_id)->update([
        'status'=>$request->status,
     ]);
     return back();
   }

   function download_invoice($order_id){
      $info = Order::find($order_id);
      $data = $info->order_id;
      $pdf = PDF::loadView('frontend.customer.invoice', [
         'data'=>$data,
      ]);
      return $pdf->download('invoice.pdf');
   }
}
