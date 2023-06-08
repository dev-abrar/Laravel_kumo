<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Str;
use Image;

class SubcategoryController extends Controller
{
    function subcategory(){
        $categoires = Category::all();
        $subcategoires = Subcategory::all();
        $trash_sub = Subcategory::onlyTrashed()->get();
        return view('admin.category.subcategory', [
            'categoires'=>$categoires,
            'subcategoires'=>$subcategoires,
            'trash_sub'=>$trash_sub,
        ]);
    }

    function subcategory_store(Request $request){
       $request->validate([
        'subcategory_img'=>'image',
       ]);

       if($request->subcategory_img == ''){
         Subcategory::insert([
            'subcategory_name'=>$request->subcategory_name,
            'category_id'=>$request->category_id,
         ]);
         return back();
       }
       else{
            $random_num = random_int(1000, 99999);
            $subcategory_img = $request->subcategory_img;
            $extn = $subcategory_img->getClientOriginalExtension();
            $file_name = Str::lower(str_replace(' ', '_', $request->subcategory_name)).'_'.$random_num.'.'.$extn;
            echo $file_name;
            image::make($subcategory_img)->save(public_path('uploads/subcategory/'.$file_name));

            Subcategory::insert([
                'subcategory_name'=>$request->subcategory_name,
                'category_id'=>$request->category_id,
                'subcategory_img'=>$file_name,
             ]);
             return back();
       }
    }

    function sub_delete($sub_id){
        Subcategory::find($sub_id)->delete();
        return back()->with('sub_del', 'Ja diya disi delete');
    }

    function sub_restore($sub_id){
       Subcategory::onlyTrashed()->find($sub_id)->restore();
       return back();
    }

    function sub_pdelete($sub_id){
        $present_img = Subcategory::onlyTrashed()->find($sub_id);
        if($present_img->subcategory_img != null){
          $delete_from = public_path('uploads/subcategory/'.$present_img->subcategory_img);
          unlink($delete_from);
        }
        
        Subcategory::onlyTrashed()->find($sub_id)->forceDelete();
        return back()->with('pdel', 'Yes Finaly Done');
    }

    function subcheck_delete(Request $request){
     
      foreach($request->subcategory_id as $subcategory){
        Subcategory::find($subcategory)->delete();
      }
      return back()->with('sub_del', 'Ja diya disi delete');
    }

    function checkall_restore(Request $request){

      if($request->btn == 1){
        foreach($request->subcategory_id as $subcategory){
          Subcategory::onlyTrashed()->find($subcategory)->restore();
        }
        return back();
      }
      else{
        foreach($request->subcategory_id as $delete){
          Subcategory::onlyTrashed()->find($delete)->forceDelete();
        }

        return back()->with('pdel', 'Yes Finaly Done');
      }
        
      }

      function sub_edit($sub_cat_id){
        $categories = Category::all();
        $subcategories_info = Subcategory::find($sub_cat_id);
          return view('admin.category.edit_subcategory', [
            'subcategories_info'=>$subcategories_info,
            'categories'=>$categories,
          ]);
      }

      function subcategory_update(Request $request){
       $request->validate([
        'subcategory_img'=>'image',
       ]);

       if($request->subcategory_img == ''){
        Subcategory::find($request->subcategory_id)->update([
          'subcategory_name'=>$request->subcategory_name,
          'category_id'=>$request->category_id,
        ]);
        return back();
       }
       else{

         $prev_img = Subcategory::find($request->subcategory_id);
        if($prev_img->subcategory_img != null){
        unlink(public_path('uploads/subcategory/'.$prev_img->subcategory_img));
       }

        $random_num = random_int(1000, 99999);
        $subcategory_img = $request->subcategory_img;
        $extn = $subcategory_img->getClientOriginalExtension();
        $file_name = Str::lower(str_replace(' ', '_', $request->subcategory_name)).'_'.$random_num.'.'.$extn;
        echo $file_name;
        image::make($subcategory_img)->save(public_path('uploads/subcategory/'.$file_name));

        Subcategory::find($request->subcategory_id)->update([
            'subcategory_name'=>$request->subcategory_name,
            'category_id'=>$request->category_id,
            'subcategory_img'=>$file_name,
         ]);
         return back();
       }
      }

}
