<?php

namespace App\Http\View\Composers;
 
use App\Repositories\UserRepository;
use Illuminate\View\View;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
 
class CartComposer
{
 
    public function __construct()
    {
        
    }
 
    
    public function compose(View $view)
    {
        $carts = Session::get('carts');
   
        if (is_null($carts)) return [];
        $product_id=array_keys($carts);
        $product_cart= Product::select('id','name','thumb','price','price_sale')
        ->where('active',1)
        ->whereIn('id',$product_id)
        ->get();
        $view->with('product_cart', $product_cart);
       // ->with('cart_qty_noti',$carts);
    }
}