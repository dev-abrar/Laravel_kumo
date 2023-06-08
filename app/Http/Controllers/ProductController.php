<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\colors;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\productGallery;
use App\Models\Size;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Str;
use Image;

class ProductController extends Controller
{
    function product(){
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        return view('admin.product.product',[
            'categories'=>$categories,
            'subcategories'=>$subcategories,
            'brands'=>$brands,
        ]);
    }

    function getSubcategory(Request $request){
      $subcategories = Subcategory::where('category_id', $request->category_id)->get();
      $str = '<option value="">--Select any--</option>';

      foreach($subcategories as $subcategory){
        $str .= '<option value="'.$subcategory->id.'">'.$subcategory->subcategory_name.'</option>';
      }
      echo $str;
    }

    function product_store(Request $request){

        $random_num2 = random_int(100000, 999999);
        $slug = Str::lower(str_replace(' ', '_', $request->product_name)).'_'.$random_num2;
        $random_num = random_int(1000, 9999);
        $sku = Str::Upper(str_replace(' ', '_', substr($request->product_name, 0, 2))).'_'.$random_num;

        $product_id = Product::insertGetId([
            'product_name'=>$request->product_name,
            'price'=>$request->price,
            'discount'=>$request->discount,
            'after_discount'=>$request->price - ($request->price*$request->discount)/100,
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'subcategory_id'=>$request->subcategory_id,
            'brand'=>$request->brand,
            'short_desp'=>$request->short_desp,
            'long_desp'=>$request->long_desp,
            'aditional_info'=>$request->aditional_info,
            'sku'=>$sku,
            'slug'=>$slug,
            'created_at'=>Carbon::now(),
        ]);


        $preview_img = $request->preview;
        if($preview_img != ''){
            $extension = $preview_img->getClientOriginalExtension();
            $file_name = Str::lower(str_replace(' ', '_', $request->product_name)).'_'.$random_num2.'.'.$extension;
    
            Image::make($preview_img)->save(public_path('uploads/product/preview/'.$file_name));
    
            Product::find($product_id)->update([
                'preview'=>$file_name,
            ]);
        }
        
 
        $product_gallery = $request->gallery;
        if($product_gallery != ''){
            foreach($product_gallery as $sl=>$gallery){
                $extn_gallery = $gallery->getClientOriginalExtension();
                $file_name_gall = Str::lower(str_replace(' ', '_', $request->product_name)).'_'.$random_num2.$sl.'.'.$extn_gallery;
    
               Image::make($gallery)->save(public_path('uploads/product/gallery/'.$file_name_gall));
               productGallery::insert([
                'product_id'=>$product_id,
                'gallery'=>$file_name_gall,
                'created_at'=>Carbon::now(),
               ]);
             }
        }
       

        return back();
    }

    function product_list(){
        $products = product::all();
        return view('admin.product.product_list', [
            'products'=>$products,
        ]);
    }

    function pro_edit(Request $request){
        $pro_info = Product::find($request->product_id);
        $gall_img = productGallery::where('product_id', $request->product_id)->get();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        return view('admin.product.product_edit', [
            'pro_info'=>$pro_info,
            'categories'=>$categories,
            'subcategories'=>$subcategories,
            'brands'=>$brands,
            'gall_img'=>$gall_img,
        ]);
    }

    function product_update(Request $request){
        $random_num2 = random_int(100000, 999999);
        $product_gallery = $request->gallery;
        // if preview empty
        if($request->preview == ''){

            // if gallery empty
            if($request->gallery == ''){
                Product::find($request->product_id)->update([
                    'product_name'=>$request->product_name,
                    'price'=>$request->price,
                    'discount'=>$request->discount,
                    'after_discount'=>$request->price - ($request->price*$request->discount)/100,
                    'category_id'=>$request->category_id,
                    'subcategory_id'=>$request->subcategory_id,
                    'subcategory_id'=>$request->subcategory_id,
                    'brand'=>$request->brand,
                    'short_desp'=>$request->short_desp,
                    'long_desp'=>$request->long_desp,
                    'aditional_info'=>$request->aditional_info,
                    'created_at'=>Carbon::now(),
                ]);
            }

            // if gallery not empty
            else{
                $present_gallery = productGallery::where('product_id', $request->product_id)->get();
                foreach($present_gallery as $gall){
                    unlink(public_path('uploads/product/gallery/'.$gall->gallery));

                    productGallery::where('product_id', $gall->product_id)->delete();
                }
                foreach($product_gallery as $sl=>$gallery){
                    $extn_gallery = $gallery->getClientOriginalExtension();
                    $file_name_gall = Str::lower(str_replace(' ', '_', $request->product_name)).'_'.$random_num2.$sl.'.'.$extn_gallery;
        
                   Image::make($gallery)->save(public_path('uploads/product/gallery/'.$file_name_gall));
                   productGallery::insert([
                    'product_id'=>$request->product_id,
                    'gallery'=>$file_name_gall,
                    'created_at'=>Carbon::now(),
                   ]);
                 }
            }
        }

        // if preview not empty
        else{

            // if gallery empty
            if($request->gallery == ''){
                $prev_img = Product::find($request->product_id);
                unlink(public_path('uploads/product/preview/'.$prev_img->preview));

                $preview_img = $request->preview;
                    $extension = $preview_img->getClientOriginalExtension();
                    $file_name = Str::lower(str_replace(' ', '_', $request->product_name)).'_'.$random_num2.'.'.$extension;
            
                    Image::make($preview_img)->save(public_path('uploads/product/preview/'.$file_name));
                    Product::find($request->product_id)->update([
                        'product_name'=>$request->product_name,
                        'price'=>$request->price,
                        'discount'=>$request->discount,
                        'after_discount'=>$request->price - ($request->price*$request->discount)/100,
                        'category_id'=>$request->category_id,
                        'subcategory_id'=>$request->subcategory_id,
                        'subcategory_id'=>$request->subcategory_id,
                        'brand'=>$request->brand,
                        'short_desp'=>$request->short_desp,
                        'long_desp'=>$request->long_desp,
                        'aditional_info'=>$request->aditional_info,
                        'preview'=>$file_name,
                        'created_at'=>Carbon::now(),
                    ]);
            }

            // if gallery not empty
            else{
                $prev_img = Product::find($request->product_id);
                unlink(public_path('uploads/product/preview/'.$prev_img->preview));

                $preview_img = $request->preview;
                    $extension = $preview_img->getClientOriginalExtension();
                    $file_name = Str::lower(str_replace(' ', '_', $request->product_name)).'_'.$random_num2.'.'.$extension;
            
                    Image::make($preview_img)->save(public_path('uploads/product/preview/'.$file_name));

                $present_gallery = productGallery::where('product_id', $request->product_id)->get();
                foreach($present_gallery as $gall){
                    unlink(public_path('uploads/product/gallery/'.$gall->gallery));

                    productGallery::where('product_id', $gall->product_id)->delete();
                }
                foreach($product_gallery as $sl=>$gallery){
                    $extn_gallery = $gallery->getClientOriginalExtension();
                    $file_name_gall = Str::lower(str_replace(' ', '_', $request->product_name)).'_'.$random_num2.$sl.'.'.$extn_gallery;
        
                   Image::make($gallery)->save(public_path('uploads/product/gallery/'.$file_name_gall));
                   productGallery::insert([
                    'product_id'=>$request->product_id,
                    'gallery'=>$file_name_gall,
                    'created_at'=>Carbon::now(),
                   ]);
                 }
                Product::find($request->product_id)->update([
                    'product_name'=>$request->product_name,
                    'price'=>$request->price,
                    'discount'=>$request->discount,
                    'after_discount'=>$request->price - ($request->price*$request->discount)/100,
                    'category_id'=>$request->category_id,
                    'subcategory_id'=>$request->subcategory_id,
                    'subcategory_id'=>$request->subcategory_id,
                    'brand'=>$request->brand,
                    'short_desp'=>$request->short_desp,
                    'long_desp'=>$request->long_desp,
                    'aditional_info'=>$request->aditional_info,
                    'preview'=>$file_name,
                    'created_at'=>Carbon::now(),
                ]);
            }
        }
        return back();
    }

    function product_delete($product_id){

        $prev_img = Product::find($product_id);
        unlink(public_path('uploads/product/preview/'.$prev_img->preview));
        
        $present_gallery = productGallery::where('product_id', $product_id)->get();
        foreach($present_gallery as $gall){
            unlink(public_path('uploads/product/gallery/'.$gall->gallery));

            productGallery::where('product_id', $gall->product_id)->delete();
        }

         
        Product::find($product_id)->delete();
        return back()->with('success', 'Deleted');
    }

    function product_inventory($product_id){
        $colors = colors::all();
        $inventories = Inventory::where('product_id', $product_id)->get();
        $product_info = Product::find($product_id);
        $sizes = Size::where('category_id', $product_info->category_id)->get();
        return view('admin.product.inventory', [
            'colors'=>$colors,
            'inventories'=>$inventories,
            'sizes'=>$sizes,
            'product_info'=>$product_info,
        ]);
    }

    function inventory_store(Request $request){
        if(Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->exists()){
            Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->increment('quantity', $request->quantity);
        }
        else{
            Inventory::insert([
                'product_id'=>$request->product_id,
                'color_id'=>$request->color_id,
                'size_id'=>$request->size_id,
                'quantity'=>$request->quantity,
                'created_at'=>Carbon::now(),
            ]);
        }
        return back();
    }

    function inventory_delete($product_id){
        Inventory::find($product_id)->delete();
        return back();
    }
}
