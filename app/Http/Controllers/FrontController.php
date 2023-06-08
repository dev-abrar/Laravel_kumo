<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Inventory;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\productGallery;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    function index(){
        $categories = Category::all();
        $products = Product::take(8)->latest()->get();
        $best_selling = OrderProduct::groupBy('product_id')
        ->selectRaw('sum(quantity) as sum, product_id')
        ->orderBy('sum', 'DESC')->get();
        $top_selling = OrderProduct::groupBy('product_id')
        ->selectRaw('sum(star) as sum, product_id')->orderBy('sum', 'DESC')->get();
        return view('frontend.index',[
            'categories'=>$categories,
            'products'=>$products,
            'best_selling'=>$best_selling,
            'top_selling'=>$top_selling,
        ]);
    }

    function details($slug){
        $slug_info = Product::where('slug', $slug)->get();
        $product_id = $slug_info->first()->id;
        $product_info = Product::find($product_id);
        $galleries = productGallery::where('product_id',$product_id)->get();
        $related_products = Product::where('category_id', $product_info->category_id)->where('id', '!=', $product_id)->get();
        $available_colors = Inventory::where('product_id', $product_info->id)
        ->groupBy('color_id')
        ->selectRaw('count(*) as total, color_id')
        ->get();
        $available_sizes = Inventory::where('product_id', $product_info->id)
        ->groupBy('size_id')
        ->selectRaw('count(*) as total, size_id')
        ->get();
        $all_review = OrderProduct::where('product_id', $product_id)->whereNotNull('review')->get();
        $total_review = OrderProduct::where('product_id', $product_id)->whereNotNull('review')->count();
        $total_star = OrderProduct::where('product_id', $product_id)->whereNotNull('review')->sum('star');
        return view('frontend.details', [
            'product_info'=>$product_info,
            'galleries'=>$galleries,
            'related_products'=>$related_products,
            'available_colors'=>$available_colors,
            'available_sizes'=>$available_sizes,
            'all_review'=>$all_review,
            'total_review'=>$total_review,
            'total_star'=>$total_star,
        ]);
    }

    function getSize(Request $request){
        $sizes = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->get();
          $str = '';
        foreach($sizes as $size){
            if($size->size_id == 1){
                $str = '<div class="form-check size-option form-option form-check-inline mb-2">
                <input checked class="form-check-input" type="radio" name="size_id" value="'.$size->size_id.'" id="size'.$size->size_id.'">
                <label class="form-option-label" for="size'.$size->size_id.'">'.$size->rel_to_size->size_name.'</label></div>';
            }
            else{
                $str .= '<div class="form-check size-option form-option form-check-inline mb-2">
                <input class="form-check-input" type="radio" name="size_id" value="'.$size->size_id.'" id="size'.$size->size_id.'">
                <label class="form-option-label" for="size'.$size->size_id.'">'.$size->rel_to_size->size_name.'</label></div>';
            }
           
        }
        echo $str;
    }

    function cart(Request $request){
        $discount = '0';
        $type = '';
        $msg = '';


      if(isset($request->coupon_name)){
          if(Coupon::where('coupon_name', $request->coupon_name)->exists()){
            if(Carbon::now()->format('Y-m-d') <= Coupon::where('coupon_name', $request->coupon_name)->first()->expire_date){
                if(Coupon::where('coupon_name', $request->coupon_name)->first()->type ==1){
                    $type = 1;
                    $discount = 21;
                }
                else{
                    $type = 2;
                    $discount = 100;
                }
            }
            else{
                $msg = 'Coupon Code has been Expired';
                $discount = '0';
            }
        } 
        else{
            $msg = 'Coupon Code Does not Exist';
            $discount = '0';
        }
      }

        $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();
        return view('frontend.cart', [
          'carts'=>$carts,
          'discount'=>$discount,
          'msg'=>$msg,
          'type'=>$type,
        ]);
    }

    function wishlist(){
        $wishlist = Wishlist::where('customer_id', Auth::guard('customerlogin')->id())->get();
        return view('frontend.wishlist', [
            'wishlist'=>$wishlist,
        ]);
    }
}
