<?php

namespace App\Http\Services;

use App\Jobs\SendMail;
use App\Models\Order;
use App\Models\Customers;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class CartService {

    public function create($request){
        $qty=(int)$request->input('num_product');
        $product_id=(int)$request->input('product_id');
        
        if ($qty <= 0 || $product_id <= 0) {
            Session::flash('error', 'Số lượng hoặc Sản phẩm không chính xác');
            return false;
        }
        
        $carts = Session::get('carts');
        if (is_null($carts)) {
            Session::put('carts', [
                $product_id => $qty
            ]);
            return true;
        }

        $exists = Arr::exists($carts, $product_id);
        if ($exists) {
            $carts[$product_id] = $carts[$product_id] + $qty;
            Session::put('carts', $carts);
            return true;
        }

        $carts[$product_id] = $qty;
        Session::put('carts', $carts);

        return true;
        
    }
    public function update($request){
        Session::put('carts', $request->input('num_product'));
        return true;
    }
    public function getProduct(){
        $carts = Session::get('carts');
        if (is_null($carts)) {
            return [];
        }
        $product_id=array_keys($carts);
        return Product::select('id','name','thumb','price','price_sale')
        ->where('active',1)
        ->whereIn('id',$product_id)
        ->get();
    }
    public function remove($id){
        $carts = Session::get('carts');
        if (is_null($carts)) return false;
        unset($carts[$id]);
        Session::put('carts', $carts);
        return true;

    }
    public function addCart($request){
        try {
            DB::beginTransaction();

            $carts = Session::get('carts');

            if (is_null($carts))
                return false;

            $customer = Customers::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'content' => $request->input('content')
            ]);

            $order=$this->infoProductCart($carts, $customer->id);
            $data=[
                'order'=>$order,
                'customer'=>$customer
             ];
            //dd($data['customer']);
            DB::commit();
            Session::flash('success', 'Đặt Hàng Thành Công');
            $data_send_mail=[
                'name'=>$request->input('name'),
                'email'=> $request->input('email'),
                'phone'=> $request->input('phone')
            ];
           
            #Queue
          
            SendMail::dispatch( $data)->delay(now()->addSeconds(5));

            Session::forget('carts');
        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error', 'Đặt Hàng Lỗi, Vui lòng thử lại sau');
            return false;
        }

        return true;
    }
    protected function infoProductCart($carts, $customer_id)
    {

        $product_id=array_keys($carts);
        $products= Product::select('id','name','thumb','price','price_sale')
        ->where('active',1)
        ->whereIn('id',$product_id)
        ->get();

        $data=[];
        foreach ($products as $product){
            $data[] = [
                'customer_id'=>$customer_id,
                'product_id'=>$product->id,
                'pty'=>$carts[$product->id],
                'price'=>$product->price_sale != 0 ? $product->price_sale : $product->price,

            ];
           
        }
         Order::insert($data);
         return $products;

    }

}
