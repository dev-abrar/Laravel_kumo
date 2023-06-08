<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\colors;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    function variation(){
        $colors = colors::all();
        $sizes = Size::all();
        $categories = Category::all();
        return view('admin.product.variation', [
            'colors'=>$colors,
            'sizes'=>$sizes,
            'categories'=>$categories,
        ]);
    }

    function color_store(Request $request){
        if($request->btn == 1){
            colors::insert([
                'color_name'=>$request->color_name,
                'color_code'=>$request->color_code,
                'created_at'=>Carbon::now(),
               ]);
        }
        else{
            Size::insert([
                'category_id'=>$request->category_id,
                'size_name'=>$request->size_name,
                'created_at'=>Carbon::now(),
               ]);
        }
      
       return back();
    }

    function color_delete($color_id){
        colors::find($color_id)->delete();
        return back();
    }
    function size_delete($size_id){
        Size::find($size_id)->delete();
        return back();
    }
}
