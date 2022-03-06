<?php
namespace App\Http\Services\Product;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class ProductService {
    CONST LIMIT =4;

    public function getMenu(){
    return Menu::where('active',1)->get();

    }
    public function show($page=null){
        return Product::select('id','name','price','price_sale','thumb')
        ->where('active',1)
        ->orderbyDesc('id')
        ->when($page!=null,function($query) use ($page){
                $offset=$page*self::LIMIT;
                $query->offset($offset);
        })
        ->limit(self::LIMIT)
        ->get();
    }
    public function getAll(){
        return Product::with('menu')->orderbyDesc('id')->paginate(15);
    
     }
     public function getDetailProduct($id){
         return Product::where('active',1)
         ->where('id',$id)
         ->with('menu')// gội hàm menu trong Model
         ->firstOrFail();
     }
    public function getRelativeProduct($id='',$menu_id=''){
        return Product::where('active',1)
        ->where('id','!=',$id)
        ->where('menu_id',$menu_id)
        ->orderbyDesc('id')
        ->limit(8)
        ->get();
    }
    protected function isValidPrice($request){
        $check=($request->input('price')!=0 && $request->input('price_sale')!=0 )?true:false;
        if($check &&  $request->input('price_sale') >= $request->input('price')){
                Session::flash('error','Gía giảm phải nhỏ hơn giá gốc');
                return false;
        }
        if($request->input('price_sale') !=0 && (int) $request->input('price')==0){
            Session::flash('error','Vui lòng nhập giá gốc');
            return false;
        }
        return true;
    }

    public function create($request){
        $isValidPrice=$this->isValidPrice($request);
        if(!$isValidPrice) return false;
        try {
            $request->except('_token');
            Product::create($request->all());
            Session::flash('success','Thêm sản phẩm thành công ');
        }
        catch(Exception $e){
            session()->flash('error','Thêm sản phẩm thất bại !!! ');
          //  Log::info($e->getMessage());
            return false;
        }
        return true;
    }
    public function update($request, $product){
        $isValidPrice=$this->isValidPrice($request);
        if(!$isValidPrice) return false;

        try {
           $product->fill($request->input());
           $product->save();
           session()->flash('success','Cập nhật sản phẩm thành công!!! ');
        }
        catch(Exception $e){
            session()->flash('error','Cập nhật sản phẩm thất bại !!! ');
          //  Log::info($e->getMessage());
            return false;
        }
        return true;
    }
    public function delete($request){
        $product=Product::where('id',$request->input('id'))->first();
        if($product ){
            $product->delete();
            return true;
        }
        return false;
    }
}