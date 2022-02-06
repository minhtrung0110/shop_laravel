<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController; // phải ghi App mới chạy
use App\Http\Controllers\Admin\MainController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin/users/login',[LoginController::class,'index']);
Route::post('/admin/users/login/store',[LoginController::class,'store']);
Route::get('/admin/main',[MainController::class,'index'])->name('admin');

/**------------------------Demo -------------------- */
Route::prefix('product')->group( function () {

    Route::get('detail/{id1}-{descri1}',function($id1,$des1){
        $content1='Sản Phảm số :'.$id1.' Mô tả: '.$des1.' .';
        return  $content1;
    });
   
});
Route::prefix('news')->group( function () {

    Route::get('detail/{id}-{des}',function($id,$des){ 
        $content= 'Thông tin san phẩm số :'.$id.' Mô tả: '.$des.' .';
        return  $content;
    });//->where('id','/d+')->where( 'des','.+');
   
});