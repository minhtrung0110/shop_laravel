<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    protected $productService;
    protected $menuService;

    public function __construct(ProductService $Service,MenuService $menuService)
    {
        $this->productService = $Service;
        $this->menuService = $menuService;
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.list',[
            'title'=>'Danh sách sản phẩm ',
            'products'=>$this->productService->getAll(),
            //'menus'=>$this->productService->getMenu()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.add',[
            'title'=>'Thêm Sản Phẩm Mới',
            'menus'=>$this->productService->getMenu()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $this->productService->create($request);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.edit',[
            'title'=>'Thay Đổi Thông Tin Sản Phẩm',
            'product'=>$product,
            'menus'=>$this->productService->getMenu()
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
    public function update(Request $request, Product $product)
    {
       $result= $this->productService->update($request, $product);
       if($result)  return redirect()->route('admin.products.list');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $result = $this->productService->delete($request);
        if($result)  {
            return response()->json([
                'error'=>false,
                'message'=>'Xoá thành công!!!'
            ]);
        }
        return response()->json([
            'error'=>true
        ]);
    }
}
