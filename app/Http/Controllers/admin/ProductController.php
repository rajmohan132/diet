<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Plan;
use App\Models\SubPlan;
use App\Models\Product;

class ProductController extends Controller
{

    public function index()
    {
    
      
        $products = Product::join('plans','products.plan' ,'=' ,'plans.id' )
                 ->join('sub_plans','products.subplan' ,'=' ,'sub_plans.id' )
                 ->select('*')
                 ->selectRaw('products.status as pstatus,plans.planname as pname,products.id as pid')
                 ->get();
                //  var_dump($products);die();
        $category = Category::All();
        $menu = Menu::All();
        return view('product-list',["products"=>$products ,'category'=>$category ,'menu'=>$menu ]);
      
       
    }

    public function create()
    {
        $plan = Plan::where('status', 1)->get();
        $subplan = SubPlan::where('status', 1)->get();
        $category = Category::where('status', 1)->get();
        $menu = Menu::where('status', 1)->get();
        return view('product-add',['plan'=>$plan ,'subplan'=>$subplan ,'category'=>$category , 'menu'=>$menu ]);
    }


    public function store(Request $request){
            $request->validate([
            'plan' => 'required',
            'subplan' => 'required',
            'category' => 'required',
            'menu' => 'required',
            'status' => 'required',
            
        ]);
         
         $product = new Product;
         $cat = $request['category'];
         $cat_i = implode("," , $cat);

         $men = $request['menu'];
         $men_i = implode("," , $men);

         $product['plan'] = $request['plan'];
         $product['subplan'] = $request['subplan'];
         $product['status'] = $request['status'];
         $product['category'] = $cat_i;
         $product['menu'] = $men_i;
        if($request->has('is_custom')){
            $product['is_custom'] = $request['is_custom'];
        }

         $product->save();

        return redirect()->route('product-add.create')
                        ->with('success','Product created successfully.');
    }

    public function edit($id){

        $product = Product::find($id);
        $plan = Plan::where('status', 1)->get();
        $subplan = SubPlan::where('status', 1)->get();
        $category = Category::where('status', 1)->get();
        $menu = Menu::where('status', 1)->get();

        return view('product-edit' , ['product'=>$product ,'plan'=>$plan , 'subplan'=>$subplan , 
        'category'=>$category , 'menu'=>$menu]);

    }

    public function update(Request $request){
        //dd($request);
        $id = $request['pdt_id'];
        $product  = Product::find($id);
        $cat = $request['category'];
        $cat_i = implode("," , $cat);

         $men = $request['menu'];
         $men_i = implode("," , $men);

         $product['plan'] = $request['plan'];
         $product['subplan'] = $request['subplan'];
         $product['status'] = $request['status'];
         $product['category'] = $cat_i;
         $product['menu'] = $men_i;
         if($request->has('is_custom')){
            $product['is_custom'] = $request['is_custom'];
        }

         $product->update();

        return redirect()->route('product-add.create')
                        ->with('success','Product updated successfully.');

    }

}
