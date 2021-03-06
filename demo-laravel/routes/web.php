<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController; // phải ghi App mới chạy
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\ProductControllerdemo;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\HomeController;


Route::get('/home_temp', function () {
    return view('home_temp');
})->name('welcome');

//Login-Admin
Route::get('/admin/users/login',[LoginController::class,'index'])->name('login');
Route::post('/admin/users/login/store',[LoginController::class,'store']);

/*Check  Login admin*/
Route::middleware('auth')->group(function (){
    Route::prefix('admin')->group(function(){
        Route::get('/',[MainController::class,'index'])->name('admin');
        Route::get('/main',[MainController::class,'index']);
        //Menu
        Route::prefix('/menus')->group(function(){
         Route::get('/add',[MenuController::class,'create'])->name('admin.menus.add');
         Route::post('/add',[MenuController::class,'store']);//handle
         Route::get('/list',[MenuController::class,'index']);//handle
         Route::DELETE('/destroy',[MenuController::class,'destroy']);//handle
         Route::get('/edit/{menu}',[MenuController::class,'show']);
        Route::post('/edit/{menu}',[MenuController::class,'update']);//handle
         });
         //Product
        Route::prefix('/products')->group(function(){
            Route::get('/add',[ProductController::class,'create'])->name('admin.products.add');
            Route::post('/add',[ProductController::class,'store']);//handle

            Route::get('/list',[ProductController::class,'index'])->name('admin.products.list');
            Route::DELETE('/destroy',[ProductController::class,'destroy']);//handle
            Route::get('edit/{product}',[ProductController::class,'show']);
           Route::post('edit/{product}',[ProductController::class,'update']);//handle
        });
        //Upload
        Route::post('upload/services', [\App\Http\Controllers\Admin\UploadController::class, 'store']);
        //Slider
        Route::prefix('/sliders')->group(function(){
            Route::get('/add',[SliderController::class,'create'])->name('admin.sliders.add');
            Route::post('/add',[SliderController::class,'store']);//handle

            Route::get('/list',[SliderController::class,'index'])->name('admin.sliders.list');
            Route::DELETE('/destroy',[SliderController::class,'destroy']);//handle
            Route::get('edit/{slider}',[SliderController::class,'show']);
           Route::post('edit/{slider}',[SliderController::class,'update']);//handle
        });
   

    });
});
//Client////////////////////////////////
Route::prefix('/')->group(function(){
    Route::get('',[HomeController::class,'index'])->name('home');
    Route::post('/services/load-product/',[HomeController::class,'loadProduct']);
    Route::get('/products/{id}-{slug}.html', [App\Http\Controllers\MenuController::class,'index']);
    Route::get('/detail-product/{id}-{slug}.html', [App\Http\Controllers\ProductController::class,'index']);
    Route::post('/add-cart', [App\Http\Controllers\CartController::class,'index']);
    Route::get('/carts', [App\Http\Controllers\CartController::class,'show']);
    Route::post('/carts', [App\Http\Controllers\CartController::class,'addCart']);
    Route::post('/update-cart', [App\Http\Controllers\CartController::class,'update']);
    Route::get('/cart/delete/{id}', [App\Http\Controllers\CartController::class,'remove']);
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
/*Route::prefix('admin/product')->group( function(){

    Route::get('/',[ProductControllerdemo::class,'index']);
    //Show Form Products
    Route::get('/add',[ProductControllerdemo::class,'addProduct'])->name('admin.addproduct');
    Route::get('/update/{id?}',[ProductControllerdemo::class,'updateProduct'])->name('admin.updateproduct');
    //Route::get('/delete/{$id}',[ProductControllerdemo::class,'addProduct']);
    // Handle Product
    Route::post('/add',[ProductControllerdemo::class,'handleAddProduct']);
    Route::post('/update/{$id?}',[ProductControllerdemo::class,'handleUpdateProduct']);   
    Route::delete('/delete/{$id}',[ProductControllerdemo::class,'handleDeleteProduct'])->name('admin.deleteproduct');;   
    });
Route::middleware('checkloginadmin')->prefix('admin')->group( function(){
    Route::get('/',[DashboardController::class,'index']);
   
    });*/