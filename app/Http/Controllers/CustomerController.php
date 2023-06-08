<?php

namespace App\Http\Controllers;

use App\Models\Customerlogin;
use App\Models\CustomerVerify;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Notifications\CusEmailVerifyNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use Illuminate\Support\Facades\Notification;
use Stripe\Customer;

class CustomerController extends Controller
{
   function customer_register_login(){
    return view('frontend.customer.login');
   }

   function customer_register_store(Request $request){
       $request->validate([
        'name'=>'required',
        'email'=>'required|unique:customerlogins',
        'password'=>'required',
       ]);
       $customer_id = Customerlogin::insertGetId([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
        'created_at'=>Carbon::now(),
       ]);
       $customer = Customerlogin::find($customer_id);

       $info = CustomerVerify::create([
        'customer_id'=>$customer_id,
        'token'=>uniqid(),
        'created_at'=>Carbon::now(),
       ]);

       Notification::send($customer, new CusEmailVerifyNotification($info));
        return back()->with('email_ver', 'We have sent you an email');

   }
  
   function customer_login(Request $request){
    $request->validate([
        'log_email'=>'required',
        'password'=>'required',
    ]);
    if(Auth::guard('customerlogin')->attempt(['email' => $request->log_email, 'password' => $request->password])){
           if(Auth::guard('customerlogin')->user()->email_verified_at == null){
            return back()->with('not_verified', 'Not Verified Email . Please Verify your email');
           }
           else{
            return redirect('/');
           }
    }
    else{
        return back()->with('wrong', 'Wrong Credential');
    }
   }

   function customer_logout(){
    Auth::guard('customerlogin')->logout();
    return redirect('/');
   }

   function customer_profile(){
    return view('frontend.customer.profile');
   }

   function customer_update(Request $request){
    // If Photo not exists
     if($request->photo == ''){
        // if password not exists
         if($request->password == ''){
               Customerlogin::find(Auth::guard('customerlogin')->id())->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'country'=>$request->country,
                'address'=>$request->address,
               ]);
               return back();
         }
        //  If password exists
         else{
            if(Hash::check($request->old_password, Auth::guard('customerlogin')->user()->password)){
                Customerlogin::find(Auth::guard('customerlogin')->id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'country'=>$request->country,
                    'address'=>$request->address,
                    'password'=>Hash::make($request->password),
                   ]);
                   return back();
            }
            else{
                return back()->with('pass_wrong', 'Current Password wrong');
            }
         }
     }

    //  If photo exists
     else{
        if($request->password == ''){
            $photo = $request->photo;
            $extension = $photo->getClientOriginalExtension();
            $file_name = Auth::guard('customerlogin')->id().'.'.$extension;

            Image::make($photo)->save(public_path('uploads/customer/'.$file_name));
            Customerlogin::find(Auth::guard('customerlogin')->id())->update([
             'name'=>$request->name,
             'email'=>$request->email,
             'country'=>$request->country,
             'address'=>$request->address,
             'photo'=>$file_name,
            ]);
            return back();
      }
     //  If password exists
      else{
         if(Hash::check($request->old_password, Auth::guard('customerlogin')->user()->password)){
            $photo = $request->photo;
            $extension = $photo->getClientOriginalExtension();
            $file_name = Auth::guard('customerlogin')->id().'.'.$extension;

            Image::make($photo)->save(public_path('uploads/customer/'.$file_name));
             Customerlogin::find(Auth::guard('customerlogin')->id())->update([
                 'name'=>$request->name,
                 'email'=>$request->email,
                 'country'=>$request->country,
                 'address'=>$request->address,
                 'password'=>Hash::make($request->password),
                 'photo'=>$file_name,
                ]);
                return back();
         }
         else{
             return back()->with('pass_wrong', 'Current Password wrong');
         }
      }
     }
   }

   function myorder(){
    $myorders = Order::where('customer_id', Auth::guard('customerlogin')->id())->orderBy('created_at', 'DESC')->get();
    return view('frontend.myorder', [
        'myorders'=>$myorders,
    ]);
}
   
    function review_store(Request $request){
        OrderProduct::where('customer_id', Auth::guard('customerlogin')->id())->where('product_id', $request->product_id)->update([
          'review'=>$request->review,
          'star'=>$request->star,
        ]);
        return back();
    }

    function customer_email_verify($token){
        $customer = CustomerVerify::where('token', $token)->firstOrFail(); 
        Customerlogin::find($customer->customer_id)->update([
            'email_verified_at'=>Carbon::now(),
        ]);
        return redirect()->route('customer.register.login')->with('verified_email', 'Email Verified SuccessFully');
    }
}
