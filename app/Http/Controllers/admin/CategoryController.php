<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Validator;
use Artisan;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::latest()->paginate(10);
    
        return view('category-list',compact('category'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
      
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category =  Category::All();
        $category_number  = 0;
        $category_number = count($category)+1;
        $category_code = "CG000".$category_number;
        return view('category-add',['categorycode'=>$category_code]);
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
            'categorycode' => 'required',
            'categoryname' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            
        ]);
        $input = $request->all();
        if ($image = $request->file('image')) {
           
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            // $image->move($destinationPath, $profileImage);
                               
            $image->storeAs('public/subplanimages', $profileImage);
           

        }
    
        $category = new Category;
    
        $category->categorycode = $request->categorycode;
        $category->categoryname = $request->categoryname;
        $category->image = $profileImage;
        $category->status = $request->status;
        // $plan->planimage = $profileImage;
      
        $category->save();

     
        return redirect()->route('category-add.create')
                        ->with('success','Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('category-add.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Category::find($id);
        return view('category-edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        

        $request->validate([
            'categorycode' => 'required',
            'categoryname' => 'required',
            'status' => 'required',
            
        ]);

        //
        $category_id = $request->categoryid;
        $category = Category::find($category_id);

        $input = $request->all();
        $profileImage=null;
        if ($image = $request->file('image')) {
           
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            // $image->move($destinationPath, $profileImage);
                               
            $image->storeAs('public/subplanimages', $profileImage);
           

        }

        
    
        $category->categorycode = $request->categorycode;
        $category->categoryname = $request->categoryname;
        if($profileImage!==null){
        $category->image = $profileImage;
        }
        
        
        
        $category->status = $request->status;
        // $plan->planimage = $profileImage;
        
      
        $category->update();
        return redirect()->route('category-add.create')
                        ->with('success','Category updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    public function updateStatus($id)
    {
        //

        $category = Category::find($id);
        $category->status = "0";
        $category->update();
        return redirect()->route('plan-add.create')
                        ->with('success','Category deleted successfully.');

    }
}
