<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\ModelsAdmin\MainCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use DB;
use Illuminate\Support\Str;


class MainCategoriesController extends Controller
{
    public function index()
    {
        $default_lang = get_default_lang();

        $maincategories = MainCategories::where('translation_lang', $default_lang)
        ->selection()
        ->get();

        return view('admin.maincategories.index',compact('maincategories'));
    }//end of index

   
    public function create()
    {
        return view('admin.maincategories.create');

    }//end of create

  
    public function store(Request $request)
    {
      
        
       //dd($request->all());
       $request->validate([

    
            'image'             => 'required_without:id|mimes:jpg,jpeg,png',
            'category'          => 'required|array|min:1',
            'category.*.name'   => 'required',
            'category.*.abbr'   => 'required',
            'category.*.active' => 'required',

    ]);
         
         try{
         
        
            $main_catrgory= collect($request->category);

            $filter=$main_catrgory->filter(function($value,$key){
                 
                return $value['abbr']== get_default_lang();
            });//end of filter


             $default_category = array_values ($filter->all())[0];

                
            if ($request->image) {
                Image::make($request->image)
                    ->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save(public_path('uploads/category_images/' . $request->image->hashName()));
                    $request_data['image'] = $request->image->hashName();

        }//end of if

              DB::beginTransaction();
                $default_category_id = MainCategories::insertGetId([
                    'translation_lang' => $default_category['abbr'],
                    'translation_of' => 0,
                    'name' => $default_category['name'],
                    'slug' => $default_category['name'],
                    'image' => $request_data
                ]); //end of default_category_id


           $categories=$main_catrgory->filter(function($value,$key){
            return $value['abbr'] !== get_default_lang();
        });//enf of categories


            if(isset($categories) && $categories->count())
            {
                $categories_arr = [];
                foreach($categories as $category){
                    $categories_arr[] = [
                        'translation_lang' => $category['abbr'],
                        'translation_of'   => $default_category_id ,
                        'name'             => $category['name'],
                        'slug'             => $category['name'],
                        'image'            =>  $request_data
                    ];
                }//end of foreach

                MainCategories::insert($categories_arr);
            }//end of if 

         DB::commit();
         session()->flash('success', __('site.added_successfully'));
         return redirect()->route('maincategories.index');

        } catch (\Exception $ex) {

            DB::rollback();
            session()->flash('error', __('errrrrrrrrrror'));
            return redirect()->route('maincategories.index');

        }//en ofcatch
    }//end of store

   
    public function edit(MainCategories $mainCategories)
    {
        //
    }//end of edit

    public function update(Request $request, MainCategories $mainCategories)
    {
        //
    }//end of update

    
    public function destroy(MainCategories $mainCategories)
    {
        //
    }//end of destory
}
