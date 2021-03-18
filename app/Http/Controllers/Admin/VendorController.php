<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ModelsAdmin\Vendor;
use Illuminate\Http\Request;

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

        $vendors= Vendor::all();
        return view('admin.vendors.index',compact('vendors'));
    }// end of index

 
    public function create()
    {
        return view('admin.vendors.create');
    }// end of index

   
    public function store(Request $request)
    {
        //
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
