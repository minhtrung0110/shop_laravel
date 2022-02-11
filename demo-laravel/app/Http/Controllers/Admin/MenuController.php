<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Menu\MenuService;
use App\Models\Menu;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }
    public function index(){

        // Thisdd($this->menuService->getAll());
        return view('admin.menu.list',[
            'title'=>'Danh sách danh mục',
            'menus'=>$this->menuService->getAll()
        ]);
    }

    public function create(){
        return view('admin.menu.add',[
            'title'=>'Thêm Danh Mục Mới',
            'menus'=>$this->menuService->getParent()
        ]);
    }

    public function store(CreateFormRequest $request){// có 1 class CreateFormRequest trong thư mực Request
        $result=$this->menuService->create($request);
        return redirect()->back();
    }
    public function destroy(Request $request){// có 1 class DestroyFormRequest trong
        $result=$this->menuService->delete($request);
       
       if($result){
            return response()->json([
                'error'=>false,
                'message'=>'Xoá thành công danh mục.'
            ]);
        }
        return response()->json([
            'error'=>true
        ]);
    }
    public function update(Menu $menu,CreateFormRequest $request){
        $result=$this->menuService->update($request,$menu);
        return redirect('/admin/menus/list');

    }
    public function show(Menu $menu){
        return view('admin.menu.edit',
        ['title'=>'Sửa Danh Mục',
        'menu'=>$menu,
        'menu_parent'=>$this->menuService->getParent()
        ]);

    }
}
