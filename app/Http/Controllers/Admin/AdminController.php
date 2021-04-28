<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ModelsAdmin\Admin;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{


    public function __construct()
    {
            $this->middleware(['permission:admins_read'])->only('index');
            $this->middleware(['permission:admins_create'])->only('create');
            $this->middleware(['permission:admins_update'])->only('edit');
            $this->middleware(['permission:admins_delete'])->only('destroy');

    }//end of construct

    public function index(Request $request)
    {
        $admins=Admin::whereRoleIs('admin')->where(function ($query) use ($request) {
        
            return $query->when($request->search, function ($q) use ($request) {

               return $q->where('first_name','like','%' .$request->search .'%') 

               ->orwhere('last_name','like','%' .$request->search .'%')

               ->orwhere('email','like','%' .$request->search .'%');
           });

       })->latest()->paginate(5);

        return view('admin.admins.index',compact('admins'));

    }//end of index

  
    public function create()
    {
        return view('admin.admins.create');

    }//end of create

 
    public function store(Request $request)
    {
      
        $request->validate([

            'first_name'     =>'required',
            'last_name'     =>'required',
            'email'         => 'required|unique:admins',
            'image'         =>'image',
            'password'      =>'required|confirmed',
            'permissions'   => 'required|min:1',

        ]);//end of validate

        $request_data =$request ->except(['password','password_confirmation','Permissions[]','image']);
        $request_data['password'] = bcrypt($request->password);


        if ($request->image) {
            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/admins_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }//end of if

        $admin = Admin::create($request_data);
        $admin->attachRole('admin');
        $admin->syncPermissions($request->permissions);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admins.index');



    }//end of store


    public function edit(Admin $admin)
    {
      
        return view('admin.admins.edit',compact('admin'));

    }//end of edit


 
    public function update(Request $request, Admin $admin)
    {
        $request->validate([

            'first_name'    =>'required',
            'last_name'     =>'required',
            'email'         => ['required', Rule::unique('admins')->ignore($admin->id),],
            'image'         =>'image',
            'permissions'   => 'required|min:1'

        ]);//end of validate
        


        $request_data = $request->except(['permissions', 'image']);

        if ($request->image) { 

            if ($admin->image != 'default.png') {

                Storage::disk('public_uploads')->delete('/admins_images/' . $admin->image);

            }//end of inner if

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/admins_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
           
        }//end of external if
   

        $admin->update($request_data);
       
        $admin->syncPermissions($request->permissions);
        
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admins.index');

    }//end of update


    public function destroy(Admin $admin)
    {

        if ($admin->image != 'default.png') {

            Storage::disk('public_uploads')->delete('/admins_images/' . $admin->image);

        }//end of if

        
        $admin->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('admins.index');

    }//end of destroy
}
