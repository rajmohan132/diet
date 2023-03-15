<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\userrole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Artisan;

class UserController extends Controller
{
    public function index()
    {

        
 
        $user = User::latest()->paginate(10);
        return view('user_list',compact('user'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userrole = Userrole::where('status', 1)->get();
        return view('user-add',compact('userrole'));
    }

    public function store(Request $request)
    {
       
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        //     'passowrd' => 'required',
        //     'userrole' => 'required',
        //     'status' => 'required',
            
        // ]);
        $input = $request->all();

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->userrole =  $request->userrole;
        $user->status =  $request->status;
      
        $user->save();

     
        return redirect()->route('user-add.create')
                        ->with('success','User created successfully.');

    }
    public function show(User $user)
    {
        //
    }


}
