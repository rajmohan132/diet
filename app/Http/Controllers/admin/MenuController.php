<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use Validator;
use Artisan;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu::join('categories','menus.category' , '=' , 'categories.id'  )
                ->select('*')
                ->selectRaw('menus.status as mstatus,menus.id as menid')
                ->paginate(10);
                
    
        return view('menu-list',compact('menu'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('status', 1)->get();
        $menu =  Menu::All();
        $menu_number  = 0;
        $menu_number = count($menu)+1;
        $menucode = "MN000".$menu_number;
        return view('menu-add',compact('category','menucode'));
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'menucode' => 'required',
            'category' => 'required',
            'menuname' => 'required',
            
            'status' => 'required',
            
        ]);
        $input = $request->all();
  //dd($request);
        if ($image = $request->file('image')) {
            // $destinationPath = 'menu/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->storeAs('public/menuimages', $profileImage);
            $input['image'] = "$profileImage";
        }
       
    

        Menu::create($input);

     
        return redirect()->route('menu-add.create')
                        ->with('success','Menu created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
         $menu = Menu::find($id);
        $category = Category::where('status', 1)->get();
        return view('menu-edit',['menu'=>$menu , 'category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $menuid = $request->menuid;
        $menu = Menu::find($menuid);

                $request->validate([
            'menucode' => 'required',
            'category' => 'required',
            'menuname' => 'required',
            
            'status' => 'required',
            
        ]);
        $input = $request->all();
        $profileImage=null;
         if ($image = $request->file('image')) {
            // $destinationPath = 'menu/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->storeAs('public/menuimages', $profileImage);
            $input['image'] = "$profileImage";
        }
        $menu->menucode = $request->menucode;
        $menu->category = $request->category;
        $menu->menuname = $request->menuname;
        $menu->status = $request->status;
        if($profileImage!==null){
        $menu->image = $profileImage;
        }
        $menu->update();

        return redirect()->route('menu-add.create')
                        ->with('success','Menu updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }
    public function updateStatus($id)
    {
        //

        $menu = Menu::find($id);
        $menu->status = "0";
        $menu->update();
        return redirect()->route('menu-add.create')
                        ->with('success','Menu deleted successfully.');

    }
}
