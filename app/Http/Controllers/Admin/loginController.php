<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ModelsAdmin\Admin;
use Illuminate\Http\Request;

class loginController extends Controller
{

    public function getlogin()
    {
        return view('admin.auth.login');
    }

    public function postlogin(Request $request)
    {
           //dd($request->all());
           $request->validate([

            'email'         =>'required',
            'password'      =>'required',
        ]);

        
        $remember_me = $request->has('remember_me') ? true : false;

         if (auth()->guard('admin')->attempt([

            'email' => $request->input("email"),
            'password' => $request->input("password")],
             $remember_me))
             {

               // notify()->success('تم الدخول بنجاح  ');
                return redirect() -> route('admin.dashboard');

             }
             // notify()->error('خطا في البيانات  برجاء المحاوله مجدا ');
                return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);

             }


 
}
