<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Slider\SliderService;
use App\Http\Requests\Slider\SliderRequest;
use App\Models\Slider;

class SliderController extends Controller
{   

    protected $sliderService;
    public function __construct(SliderService $sliderService){
        $this->sliderService = $sliderService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('admin.slider.list',[
            'title'=>'Danh Sách Các Banner',
            'sliders'=>$this->sliderService->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        return view ('admin.slider.add',[
            'title'=>'Thêm Banner',
            //'sliders'=>$this->sliderService->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request,[
           'name'=>'required',
           'thumb'=>'required',
           'url'=>'required'
       ]);
       $this->sliderService->create($request);
       return redirect('/admin/sliders/add');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        return view ('admin.slider.edit',[
            'title'=>'Sửa Banner',
            'slider'=>$slider
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        
       $this->validate($request,[
        'name'=>'required',
        'thumb'=>'required',
        'url'=>'required'
        ]);
        $result= $this->sliderService->update($request, $slider);
       if($result)  return redirect()->route('admin.sliders.list');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request  $request)
    {
        $result= $this->sliderService->delete($request);
        if($result){
            return response()->json([
                'error'=>false,
                'message'=> 'Xoá Slider Thành công .'
            ]);
        }
        return response()->json([
            'error'=>true,
            'message'=> 'Xoá Slider Thất bại .'
        ]);
    

    }
}
