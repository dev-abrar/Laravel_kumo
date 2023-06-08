<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Str;
use Image;

class BrandController extends Controller
{
    function brand(){
        $brands = Brand::Paginate(5);
        return view('admin.brand.brand', [
            'brands'=>$brands,
        ]);
    }
    function brand_store(Request $request){
      $brand_id = Brand::insertGetId([
        'brand_name'=>$request->brand_name,
      ]);

      if($request->brand_logo != ''){
        $random_num = random_int(1000, 99999);
        $brand_logo = $request->brand_logo;
        $extn = $brand_logo->getClientOriginalExtension();
        $file_name = Str::lower(str_replace(' ', '_', $request->brand_name)).'_'.$random_num.'.'.$extn;
        
        Image::make($brand_logo)->save(public_path('uploads/brand/'.$file_name));

        Brand::find($brand_id)->update([
            'brand_logo'=>$file_name,
        ]);
      }

      return back();
    }

    function brand_delete($brand_id){
      $prev_photo = Brand::find($brand_id);
      if($prev_photo->brand_logo != null){
        unlink(public_path('uploads/brand/'.$prev_photo->brand_logo));
      }

        Brand::find($brand_id)->delete();
        return back();
    }
}
