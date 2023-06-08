<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Str;
use Image;

class CategoryController extends Controller
{
    function category(){
        $categories = Category::all();
        $trash = Category::onlyTrashed()->get();
        return view('admin.category.category', [
            'categories'=>$categories,
            'trash'=>$trash,
        ]);
    }
    function category_store(Request $request){
        $request->validate([
            'cat_name'=>'required|unique:categories',
            'cat_img'=>'image',
        ]);

        if($request->cat_img == ''){
            Category::insert([
                'cat_name'=>$request->cat_name,
            ]);
            return back();
        }
        else{
            $random_num = random_int(1000, 99999);
            $cat_img = $request->cat_img;
            $extn = $cat_img->getClientOriginalExtension();
            $file_name = Str::lower(str_replace(' ', '_', $request->cat_name)).'_'.$random_num.'.'.$extn;
            
            Image::make($cat_img)->save(public_path('uploads/category/'.$file_name));

            Category::insert([
                'cat_name'=>$request->cat_name,
                'cat_img'=>$file_name,
            ]);
            return back();
        }
    }

    function category_delete($category_id){
        Category::find($category_id)->delete();
        return back();
    }

    function category_edit($category_id){
        $category_info = Category::find($category_id);
        return view('admin.category.category_edit', [
            'category_info'=>$category_info,
        ]);
    }

    function category_update(Request $request){
      if($request->cat_img == ''){
        Category::find($request->cat_id)->update([
            'cat_name'=>$request->cat_name,
        ]);
        return back();
      }
      else{
        $present_img = Category::find($request->cat_id);
        if($present_img->cat_img != null){
            unlink(public_path('uploads/category/'.$present_img->cat_img));
        }
            
        $random_num = random_int(1000, 99999);
        $cat_img = $request->cat_img;
        $extn = $cat_img->getClientOriginalExtension();
        $file_name = Str::lower(str_replace(' ', '_', $request->cat_name)).'_'.$random_num.'.'.$extn;
            
            
        Image::make($cat_img)->save(public_path('uploads/category/'.$file_name));

        Category::find($request->cat_id)->update([
                'cat_name'=>$request->cat_name,
                'cat_img'=>$file_name,
        ]);
        return back();
      }
    }

    function category_restore($category_id){
        Category::onlyTrashed()->find($category_id)->restore();
        return back();
    }
    function category_per_delete($category_id){
        $present_img = Category::onlyTrashed()->find($category_id);
        unlink(public_path('uploads/category/'.$present_img->cat_img));
        
        Category::onlyTrashed()->find($category_id)->forceDelete();
        return back();
    }

    function check_delete(Request $request){
      foreach($request->category_id as $category){
        Category::find($category)->delete();
    }
    return back();
    }
    function check_restore(Request $request){
       foreach($request->cat_id as $restore){
        Category::onlyTrashed()->find($restore)->restore();
       }
       return back();
    }

}
