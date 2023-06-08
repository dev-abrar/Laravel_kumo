<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Image;

class UserController extends Controller
{
    function users(){
        $users = User::where('id', '!=', Auth::id())->get();
        $total = User::count();
        return view('admin.users.users', compact('users', 'total'));
    }
    function user_delete($user_id){
      User::find($user_id)->delete();
      return back()->with('success', 'jata');
    }
    function user_edit(){
        return view('admin.users.edit');
    }
    function user_update(Request $request){
        User::find(Auth::id())->update([
            'name'=>$request->name,
            'email'=>$request->email,
        ]);
        return back();
    }

    function update_password(Request $request){
        $request->validate([
            'old_password'=>'required',
            'password'=>['required', 'confirmed', Password::min(8)],
            'password_confirmation'=>'required',
        ],[
            'old_password.required'=>' Old Password Field is required', 
        ]);
        
        if(Hash::check($request->old_password, Auth::user()->password)){
            User::find(Auth::id())->update([
                'password'=>bcrypt($request->password),
            ]);
            return back()->with('success', 'Hoise tomar kaj');
         }
         else{
            return back()->with('old_pass', 'Ager ta thik nai');
         }
    }

    function update_photo(Request $request){
        $request->validate([
            'photo'=>['required','image'],
        ]);

        if(Auth::user()->photo != NULL){
            $prev_photo = public_path('uploads/users/'.Auth::user()->photo);
            unlink($prev_photo);
        }
        $uploaded_photo = $request->photo;
        $extension = $uploaded_photo->getClientOriginalExtension();
        $file_name = Auth::id().'.'.$extension;

        Image::make($uploaded_photo)->save(public_path('uploads/users/'.$file_name));

        User::find(Auth::id())->update([
            'photo'=>$file_name,
        ]);
        return back()->with('img_success','Successfully Updated!');
    }
}
