<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ModelsAdmin\Vendor;
use Illuminate\Http\Request;
use App\ModelsAdmin\MainCategory;

class VendorController extends Controller
{
    public function __construct()
    {
            $this->middleware(['permission:vendors_read'])->only('index');
            $this->middleware(['permission:vendors_create'])->only('create');
            $this->middleware(['permission:vendors_update'])->only('edit');
            $this->middleware(['permission:vendors_delete'])->only('destroy');
    }//end of construct

    public function index()
    {

        $vendors= Vendor::latest()->paginate(5);
        return view('admin.vendors.index',compact('vendors'));
    }// end of index

 
    public function create()
    {
        $categories = MainCategory::where('translation_of', 0)->active()->get();
        return view('admin.vendors.create',compact('categories'));
    }// end of index

   
    public function store(Request $request)
    {
        //dd($request->all());
        
        $request->validate([


            'category_id'   =>'required',
            'first_name'    =>'required',
            'last_name'     =>'required',
            'email'         =>'required|unique:vendors',
            'logo'          =>'image:jpeg,bmp,png',
            'password'      =>'required|confirmed',
            'phone'         =>'required|array|min:1',
            'phone.0'       =>'required',
            'address'       =>'required',
            'active'        =>'required',

        ]);//end of validate




        
    }// end of index

  
    public function edit(Vendor $vendor)
    {
        //
    }// end of index


    public function update(Request $request, Vendor $vendor)
    {
        //
    }// end of index

 
    public function destroy(Vendor $vendor)
    {
        //
    }// end of index
}
