<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;
use App\Http\Services\CartService;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    protected SliderService $slider;
    protected MenuService $menu;
    protected CartService $cart;

    public function __construct(SliderService $slider,MenuService $menu,ProductService $product, CartService $cart){
        $this->slider = $slider;
        $this->menu = $menu;
        $this->product = $product;
        $this->cart = $cart;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   // $product_cart = $this->cart->getProduct();
        return view('home',[
            'title'=>'KOF-Tresor',
            'slides'=>$this->slider->getAll(),
            'menus'=>$this->menu->get(),
            'products'=>$this->product->show(),
          //  'products_cart'=>$product_cart,
           // 'cart_qty'=>Session::get('carts'),
        ]);
    }
    public function loadProduct(Request $request){
            $page=$request->input('page',0);
            $result=$this->product->show($page);
            if(count($result)!=0){
                $html=view('products.list',['products'=>$result])->render();
                return response()->json([ 'data'=>$html]);
            }
            return response()->json([ 'data'=>""]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
