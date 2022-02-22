<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\Slider\SliderService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{

    protected $sliderService;

    public function _constructor(SliderService $slider){
        $this->sliderService = $slider;
    }
    public function index() {
        return view('admin.main',[
            'title'=> 'Trang Quản Trị Hệ Thống',

    ]);
    }
    public function welcome() {
        return view('welcome');
    }
}
