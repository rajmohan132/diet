<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\userrole; 
use App\Models\Privilage; 
use Illuminate\Http\Request;
use Validator;
use Artisan;

class UserroleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


 



    public function index()
    {
        $userrole= userrole::latest()->paginate(10);
    
        return view('role_list',compact('userrole'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user-role-add');
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
            'rolename' => 'required',
            'status' => 'required',
            
        ]);
        $input = $request->all();

        userrole::create($input);

     
        return redirect()->route('user-role-add.create')
                        ->with('success','userrole added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\userrole  $userrole
     * @return \Illuminate\Http\Response
     */
    public function show(userrole $userrole)
    {
        // dd($userrole);
        return view('user-role-add.show',compact('userrole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\userrole  $userrole
     * @return \Illuminate\Http\Response
     */

     public function edit($id)
     {
         //
         $userrole = userrole::find($id);
         return view('userrole-edit',compact('userrole'));
     }
 
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\userrole  $userrole
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request)
    {
        //
        $userroleid = $request->userrole_id;
        $userrole = userrole::find($userroleid);
        $request->validate([
            'rolename' => 'required',
            'status' => 'required',
            
        ]);
        $input = $request->all();

        
        $userrole->rolename = $request->rolename;
        $userrole->status = $request->status;
       
      
        $userrole->update();
        return redirect()->route('user-role-add.create')
                        ->with('success','userrole updated successfully.');


    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\userrole  $userrole
     * @return \Illuminate\Http\Response
     */
    public function destroy(userrole $userrole)
    {
        //
    }


    

}
