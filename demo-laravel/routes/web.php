<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController; // phải ghi App mới chạy
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;


Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/admin/users/login',[LoginController::class,'index'])->name('login');
Route::post('/admin/users/login/store',[LoginController::class,'store']);
/*Check  Login admin*/
Route::middleware('auth')->group(function (){
    Route::prefix('admin')->group(function(){
        Route::get('/',[MainController::class,'index'])->name('admin');
        Route::get('/main',[MainController::class,'index']);
        //Menu
        Route::prefix('/menus')->group(function(){
         Route::get('/add',[MenuController::class,'create']);

         });
   

    });
});







/**------------------------Demo -------------------- */
Route::prefix('wood')->group( function () {

    Route::get('detail/{id1?}/{descri1?}.html',function($id1,$des1){
        $content1='Sản Phảm số :'.$id1.' Mô tả: '.$des1.' .';
        return  $content1;
    })->name('product.detail');
   
});
Route::prefix('news')->group( function () {

    Route::get('detail/{id}-{des}',function($id,$des){ 
        $content= 'Thông tin san phẩm số :'.$id.' Mô tả: '.$des.' .';
        return  $content;
    });//->where('id','/d+')->where( 'des','.+');
   
});
Route::prefix('member')->middleware('checkpermission')->group( function () {// Phân quyền truy cập cho group này chuyển dến CheckPermission trong Middleware

    Route::get('add/{id?}/{des?}',function($id=1,$des='Áo Đẹp'){ 
        $content= 'Thêm san phẩm số :'.$id.' Mô tả: '.$des.' .';
        return  $content;
    });
    Route::get('delete/{id?}/{des?}',function($id=1,$des='Áo Đẹp'){ 
        $content= 'Xoá san phẩm số :'.$id.' Mô tả: '.$des.' .';
        return  $content;
    });
   
});
/*--------------------------------------Handle Product CRUDF --------------------------------*/
Route::prefix('admin/product')->group( function(){

    Route::get('/',[ProductController::class,'index']);
    //Show Form Products
    Route::get('/add',[ProductController::class,'addProduct'])->name('admin.addproduct');
    Route::get('/update/{id?}',[ProductController::class,'updateProduct'])->name('admin.updateproduct');
    //Route::get('/delete/{$id}',[ProductController::class,'addProduct']);
    // Handle Product
    Route::post('/add',[ProductController::class,'handleAddProduct']);
    Route::post('/update/{$id?}',[ProductController::class,'handleUpdateProduct']);   
    Route::delete('/delete/{$id}',[ProductController::class,'handleDeleteProduct'])->name('admin.deleteproduct');;   
    });
Route::middleware('checkloginadmin')->prefix('admin')->group( function(){
    Route::get('/',[DashboardController::class,'index']);
   
    });