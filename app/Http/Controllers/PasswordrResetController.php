<?php

namespace App\Http\Controllers;

use App\Models\Customerlogin;
use App\Models\CustomerResPass;
use App\Notifications\CustomerPassResetNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PasswordrResetController extends Controller
{
    function forgot_pass(){
        return view('frontend.customer.pass_reset');
    }

    function password_reset_req(Request $request){
       $request->validate([
        'email'=>'required',
       ]);
       if(Customerlogin::where('email', $request->email)->exists()){
         $customer = Customerlogin::where('email', $request->email)->firstorFail();

         CustomerResPass::where('customer_id', $customer->id)->delete();
          $info = CustomerResPass::create([
            'customer_id'=>$customer->id,
            'token'=>uniqid(),
            'created_at'=>Carbon::now(),
         ]);
       
         Notification::send($customer, new CustomerPassResetNotification($info));
         return back()->with('res_req', 'We sent you an email');
         
       }
       else{
         return back()->withInvalid('Email does not esists');
       }
    }
    function pass_reset_form($token){
        return view('frontend.customer.password_reset_form', [
            'token'=>$token,
        ]);
    }
    function pass_reset_confirm(Request $request){
        $reset_info = CustomerResPass::where('token', $request->token)->firstorFail();
        Customerlogin::find($reset_info->customer_id)->update([
            'password'=>bcrypt($request->password),
        ]);

        CustomerResPass::where('customer_id', $reset_info->customer_id)->delete();
        return back()->withSuccess('Password reset Successfull');
    }
}
