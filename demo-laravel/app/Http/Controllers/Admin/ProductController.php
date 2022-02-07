<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function _constructor(){}

    public function index(){
        return view('admin.product.listproduct');
    }

    public function getProduct($id){
            return 'Chi Tiết Sản Phẩm '.$id.' .';
    }
    // Show Form Sản Phẩm
    public function addProduct(){
        return view('admin.product.formAddProduct');
    }
    public function updateProduct(){
        return view('admin.product.formUpdateProduct',['id'=>2]);
    }
    public function deleteProduct($id){
        return 'Show Form Xoá Sản Phẩm';
    }
    // Handle_CRUD
    public function handleAddProduct(){
        return redirect('admin.addproduct');
    }
    public function handleUpdateProduct($id){
        return redirect('admin.updateproduct');
    }
    public function handleDeleteProduct($id){
        return 'Xữ Lý Sản Phẩm';
    }
}
