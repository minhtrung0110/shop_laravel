<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Menu\MenuService;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }
    public function index(){
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
}
