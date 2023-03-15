<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use App\Models\userrole;
use App\Models\Custom_plan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::with('getuser')->get();

        $cstmr = Customer::with('getuser')->get();
        $i = 0;
        $customer_arr = [];
        foreach ($cstmr as $data) {
            $customer_arr[$i]['id'] = $data->id;
            $customer_arr[$i]['user_id'] = $data->user_id;
            $customer_arr[$i]['sponsor_id'] = $data->sponsor_id;
            $customer_arr[$i]['firstname'] = $data->firstname;
            $customer_arr[$i]['lastname'] = $data->lastname;
            $customer_arr[$i]['streetaddress'] = $data->streetaddress;
            $customer_arr[$i]['country'] = $data->country;
            $customer_arr[$i]['mobno'] = $data->mobno;
            $customer_arr[$i]['alternativemob'] = $data->alternativemob;
            $customer_arr[$i]['status'] = $data->status;
            $customer_arr[$i]['first_name'] = $data->firstname;
            $customer_arr[$i]['subscription'] = Custom_plan::get_subscription($data->user_id);
            $customer_arr[$i]['downline'] = $this->getdownlines($data->user_id);
            $i++;
        }
        return view('customer-list', compact('customer', 'customer_arr'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    function getdownlines($sponsor_id)
    {
        $downline_customer = Customer::where('sponsor_id', $sponsor_id)->get();
        if($downline_customer->isEmpty()){
            return null;
        }
        $i = 0;
        $dwn_customer_arr = [];
        foreach ($downline_customer as $data) {
            $dwn_customer_arr[$i]['id'] = $data->id;
            $dwn_customer_arr[$i]['user_id'] = $data->user_id;
            $dwn_customer_arr[$i]['sponsor_id'] = $data->sponsor_id;
            $dwn_customer_arr[$i]['firstname'] = $data->firstname;
            $dwn_customer_arr[$i]['lastname'] = $data->lastname;
            $dwn_customer_arr[$i]['streetaddress'] = $data->streetaddress;
            $dwn_customer_arr[$i]['country'] = $data->country;
            $dwn_customer_arr[$i]['mobno'] = $data->mobno;
            $dwn_customer_arr[$i]['alternativemob'] = $data->alternativemob;
            $dwn_customer_arr[$i]['status'] = $data->status;
            $dwn_customer_arr[$i]['first_name'] = $data->firstname;
            $dwn_customer_arr[$i]['subscription'] = Custom_plan::get_subscription($data->user_id);
            $i++;
        }
        return $dwn_customer_arr;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        try {
            DB::beginTransaction();
            $userrole = userrole::where('id', 5)->value('id');
            $input = $request->all();
            $user = new User;
            $user->name = $request->firstname;
            $user->email = $request->email;
            $user->userrole = $userrole;
            $user->password = Hash::make($request->password);
            $user->save();
            $user_id = $user->id;

            $customer = new Customer;
            $customer->firstname = $request->firstname;
            $customer->lastname = $request->lastname;
            $customer->streetaddress = $request->streetaddress;
            $customer->streetaddress1 = $request->streetaddress1;
            $customer->country = $request->country;
            $customer->mobno = $request->mobno;
            $customer->alternativemob = $request->alternativemob;
            $customer->status = $request->status;
            $customer->user_id = $user_id;
            if ($image = $request->file('image')) {
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->storeAs('public/profileimages', $profileImage);
                $input['image'] = "$profileImage";
                $customer->image = $profileImage;
            }
            $customer->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('customer-add.create')
                ->with('error', 'User creation failed.');
        }


        return redirect()->route('customer-add.create')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $customer = Customer::with('getuser')->all();
        //dd($customer);
        // :join('user', 'user.id','=' ,'customers.email'  )
        // ->select('*')
        // ->selectRaw('customers.status as status')
        //  ->get();

        return view('customer-list', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::with('getuser')->find($id);
        // $user = User::where('status', 1)->get();
        // return view('customer-edit',['user'=>$user , 'customer'=>$customer]);


        return view('customer-edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $customerid = $request->customer_id;


        $userrole = userrole::where('id', 5)->value('id');


        $input = $request->all();


        try {
            DB::beginTransaction();
            $customer = Customer::find($customerid);
            $user_id = $customer->user_id;

            $input = $request->all();

            if ($image = $request->file('image')) {

                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                // $image->move($destinationPath, $profileImage);

                $image->storeAs('public/profileimages', $profileImage);
                $customer->image = $profileImage;
            }
            $customer->firstname = $request->firstname;
            $customer->lastname = $request->lastname;
            $customer->streetaddress = $request->streetaddress;
            $customer->streetaddress1 = $request->streetaddress1;
            $customer->country = $request->country;
            $customer->mobno = $request->mobno;
            $customer->alternativemob = $request->alternativemob;
            $customer->status = $request->status;
            $customer->save();

            $user = User::find($user_id); //dd($user);
            $user->name = $request->firstname;
            $user->email = $request->email;
            $user->userrole = $userrole;
            $user->password = Hash::make($request->password);
            $user->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('customer-edit',$customerid)
                ->with('error', 'User updation failed.');
        }
        return redirect()->route('customer-edit',$customerid)
            ->with('success', 'Plan updated successfully.');
    }

    public function add_customer_downline($id)
    {
        return view('add-customer-downline', compact('id'));
    }

    public function store_customer_downline(Request $request, $id)
    {

        $userrole = userrole::where('id', 5)->value('id');

        $input = $request->all();
        $user = new User;
        $user->name = $request->firstname;
        $user->email = $request->email;
        $user->userrole = $userrole;
        $user->password = Hash::make($request->password);

        $user->save();

        $user_id = $user->id;

        $customer = new Customer;
        $customer->firstname = $request->firstname;
        $customer->lastname = $request->lastname;
        $customer->streetaddress = $request->streetaddress;
        $customer->streetaddress1 = $request->streetaddress1;
        $customer->country = $request->country;
        $customer->mobno = $request->mobno;
        $customer->alternativemob = $request->alternativemob;
        $customer->status = $request->status;
        $customer->user_id = $user_id;
        $customer->sponsor_id = $id;

        if ($image = $request->file('image')) {
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->storeAs('public/profileimages', $profileImage);
            $input['image'] = "$profileImage";
            $customer->image = $profileImage;
        }
        $customer->save();
        return redirect()->route('add-customer-downline', $id)
            ->with('success', 'User created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
