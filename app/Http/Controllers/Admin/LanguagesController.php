<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ModelsAdmin\Language;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    public function __construct()
    {
            $this->middleware(['permission:languages_read'])->only('index');
            $this->middleware(['permission:languages_create'])->only('create');
            $this->middleware(['permission:languages_update'])->only('edit');
            $this->middleware(['permission:languages_delete'])->only('destroy');
    }

   
    public function index(Request $request)
    {

        $languages = Language::when($request->search,function($q) use ($request){

            return $q->where('name','like','%' .$request->search .'%')
            ->orwhere('abbr','like','%' .$request->search .'%');

        })->latest()->paginate(5);
        return view('admin.languages.index',compact('languages'));
    }

   
    public function create()
    {
        return view('admin.languages.create');
    }

    
    public function store(Request $request)
    {
            // dd($request->all());
            $request->validate([
            
                'name' => 'required|string|max:100',
                'abbr' => 'required|string|max:10',
                'active' => 'required|in:1',
                'direction' => 'required|in:rtl,ltr',

            ]);

            Language::create($request->all());
            
            session()->flash('success', __('site.added_successfully'));
            return redirect()->route('languages.index');

    }

    public function edit(Language $language)
    {
        return view('admin.languages.edit',compact('language'));
    }

 
    public function update(Request $request, Language $language)
    {
                 
        $request->validate([

            'name' => 'required|string|max:100',
            'abbr' => 'required|string|max:10',
            'direction' => 'required|in:rtl,ltr',


        ]);

        if (!$request->has('active'))
        $request->request->add(['active' => 0]);

    
        $language->update($request->all());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('languages.index');
    }
    


    public function destroy(Language $language)
    {
        $language->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('languages.index');

    }
}
