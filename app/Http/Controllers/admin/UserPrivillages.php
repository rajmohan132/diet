<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\userrole;
use App\Models\Privilage;
use App\Models\User_privilege;
use Illuminate\Http\Request;
use Validator;
use Artisan;

class UserPrivillages extends Controller
{
    public function index()
    {
        $privilage = Privilage::All();
        $user_privilage = User_privilege::join('userroles', 'user_privileges.user_role','=','userroles.id' )
                                               ->select('*')
                                               ->selectRaw('user_privileges.id as uid') 
                                               ->get();
        
        return view('user_privilage_list',['privilage'=>$privilage , 'user_privilage'=>$user_privilage ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createold()
    {
        $privilage = Privilage::All();
        $userrole = userrole::All();
        return view('user-privillages',["privilage"=>$privilage,'userrole'=>$userrole]);
    }

    public function store(Request $request){

        $privilages = $request['privilages'];
        $priv_string = implode("," , $privilages);

        $user_privilage = new User_privilege;
        $user_privilage->user_role = $request['user_role'];
        $user_privilage->privilages = $priv_string;
        $user_privilage->save();
        return redirect()->route('user-privillages.create')
                        ->with('success','User Privilage created successfully.');
    }

    public function edit($id){

        $user_privilage  = User_privilege::find($id);
        
        $privilage = Privilage::All();
        $userrole = userrole::All();
        return view('edit-user-privilage',['user_privilage'=>$user_privilage , 'privilage'=>$privilage ,'userrole'=>$userrole ]);
    }

    public function update(Request $request){

        $id = $request['upid'];
        $user_privilage  = User_privilege::find($id);

        $privilages = $request['privilages'];
        $priv_string = implode("," , $privilages);
        $user_privilage->user_role = $request['user_role'];
        $user_privilage->privilages = $priv_string;
        $user_privilage->update();
        return redirect()->route('user-privillages.create')
                        ->with('success','User Privilage updated successfully.');


        
    }

    public function create()
    {
        $data = [];
        $data['roles'] = userrole::where('id','!=',1)->get();
        //dd($data);
        return view('user-privillages', compact('data'));
      
    }

    public function getmenus($role_id = "", Request $request)
    {
        $data = [];
        $role = $role_id ? $role_id : $request->role;
        $data['curr_role'] = $role;
        $data['roles'] = userrole::all();
        $permitted_menus  = userrole::where('id', $role)->first();
        $data['permitted_menus'] = unserialize($permitted_menus->permitted_menus);
        // $data['menus'] = Menu::all();
        $data['menus'] = $this->getMainMenu();
        return view('user-privillages', compact('data'));
    }

    function getMainMenu(){
        $menu = Privilage::where('parent', '#')->get();
        $i = 0;
        $mnu_arr = [];
       foreach($menu as $data){
        $mnu_arr[$i]['id'] = $data->id;
        $mnu_arr[$i]['name'] = $data->name;
        $mnu_arr[$i]['route'] = $data->route;
        $mnu_arr[$i]['parent'] = $data->parent;
        $mnu_arr[$i]['submenu'] = $this->getSubMenu($data->id);
        $mnu_arr[$i]['icon'] = $data->icon;
        $i++;
        }
        return $mnu_arr;
    }

    function getSubMenu($parent){
        $menu = Privilage::where('parent', $parent)->get();
        $i = 0;
        $arr = [];
       foreach($menu as $data){
        $arr[$i]['id'] = $data->id;
        $arr[$i]['name'] = $data->name;
        $arr[$i]['route'] = $data->route;
        $arr[$i]['parent'] = $data->parent;
        $arr[$i]['icon'] = $data->icon;
        $i++;
        }
        return $arr;
    }

    public function storeassignroles($id = "", Request $request)
    {
        $menu = serialize($request->menu);
        $role = userrole::where('id', $request->role_id)->first();
        $role->permitted_menus = $menu;
        $role->save();
        //dd($request);
// return redirect()->back();

        return redirect('getmenus/'.$request->role_id)->with('success', 'Menu assigned successfully');
    }

   

}
