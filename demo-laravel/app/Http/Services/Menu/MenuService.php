<?php
namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class MenuService {

    public function getParent(){
        return Menu::where('parent_id',0)->get();// tìm các danh muc đầu 
    }

    public function getAll()
    {
        return Menu::orderbyDesc('id')->paginate(20);
    }
    public function get()
    {
        return Menu::select('name','id','description','slug')->where('parent_id',0)->orderbyDesc('id')->get();
    }
    public function getId($id){
            return Menu::where('id',$id)->where('active',1)->firstOrFail();
        
    }
    public function create($request){
        try{
            Menu::create([
                 'name'=>(string)$request->input('name'),
                 'parent_id'=>(int)$request->input('parent_id'),
                 'description'=>(string)$request->input('description'),
                 'content'=>(string)$request->input('content'),
                 'active'=>(int)$request->input('active'),
                 'slug'=>Str::slug($request->input('name'))
             ]);
             session()->flash('success', 'Tạo Danh Mục Thành Công');
            } catch (\Exception $err) {
                Session::flash('error', $err->getMessage());
                return false;
         }
         return true;
    }
    public function delete($request)
    {
        $id = (int)$request->input('id');
        $menu = Menu::where('id', $id)->first();
        if ($menu) {
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }

        return false;
    }
    public function update($request, $menu): bool
    {
        if ($request->input('parent_id') != $menu->id) {// kiểm tra ko update danh mục cha thành chính nó.
            $menu->parent_id = (int)$request->input('parent_id');
        }

        $menu->name = (string)$request->input('name');
        $menu->description = (string)$request->input('description');
        $menu->content = (string)$request->input('content');
        $menu->active = (string)$request->input('active');
        $menu->save();

        Session::flash('success', 'Cập nhật thành công Danh mục');
        return true;
    }
    public function getProducts($menu,$request){
        $query=$menu->products() // hàm này bên Models/Menu tạo relationship
        ->select('id','name','price','price_sale','thumb')
        ->where('active',1);
        if($request->input('price')){
                $query->orderBy('price',$request->input('price'));
        }
        return $query
        ->orderbyDesc('id')
        ->paginate(12)
        ->withQueryString();
    }


}


