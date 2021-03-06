<?php
namespace App\Http\Services\Slider;

use App\Models\Slider;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class SliderService {

    public function get(){
       return Slider::orderbyDesc('id')->paginate(10);
    }
    public function getAll(){
        return Slider::orderbyDesc('sort_by')->get();
     }
    public function create($request){
        try{
            Slider::create($request->input());
            Session::flash('success','Thành công');
          
        }
        catch(Exception $e){
            Logger::error($e->getMessage);
            Session::flash('error','Thất bại');
            return false;
        }
        return true;
    }
    public function update($request, $slider){
        try{
            $slider->fill($request->input());
            $slider->save();
            Session::flash('success','Thành công');
        }
        catch(Exception $e){
            Logger::error($e->getMessage);
            Session::flash('error','Thất Bại');
            return false;
        }
        return true;/// load file JS ko dc nen ko thể update Ảnh
    }

    public function delete($request){
        $slider=Slider::where('id',$request->input('id'))->first();
        if($slider){
            $path=str_replace('storage','public',$slider->thumb);
            Storage::delete($path);
            $slider->delete();

            return true;
        }
        return false;
    }
}