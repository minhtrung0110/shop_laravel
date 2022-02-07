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
        return 'Show Form Thêm Sản Phẩm';
    }
    public function updateProduct($id){
        return 'Show Form Sửa Sản Phẩm';
    }
    public function deleteProduct($id){
        return 'Show Form Xoá Sản Phẩm';
    }
    // Handle_CRUD
    public function handleAddProduct(){
        return 'Xữ Lý Sản Phẩm';
    }
    public function handleUpdateProduct($id){
        return 'Xữ Lý Sản Phẩm';
    }
    public function handleDeleteProduct($id){
        return 'Xữ Lý Sản Phẩm';
    }
}
