<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\ModelsAdmin\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use DB;
use Illuminate\Support\Str;


class MainCategoriesController extends Controller
{

    public function __construct()
    {
            $this->middleware(['permission:maincategories_read'])->only('index');
            $this->middleware(['permission:maincategories_create'])->only('create');
            $this->middleware(['permission:maincategories_update'])->only('edit');
            $this->middleware(['permission:maincategories_delete'])->only('destroy');
    }//end of construct

    public function index()
    {

        $default_lang   = get_default_lang();
        $maincategories = MainCategory::where('translation_lang', $default_lang)
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
      
        
   
       $request->validate([

    
            'image'             => 'image',
            'category'          => 'required|array|min:1',
            'category.*.name'   => 'required',
            'category.*.abbr'   => 'required',
            'category.*.active' => 'required',

    ]);
         
         try{

            $request_image = $request->except(['image','category','_method','_token']);
        
            $main_catrgory= collect($request->category);

            $filter=$main_catrgory->filter(function($value,$key){
                 
                return $value['abbr']== get_default_lang();
            });//end of filter


             $default_category = array_values ($filter->all())[0];

         
            if ($request->has('image')) {
                Image::make($request->image)
                    ->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save(public_path('uploads/category_images/' . $request->image->hashName()));

                    $request_image= $request->image->hashName();
  
        }//end of if

              DB::beginTransaction();
                $default_category_id = MainCategory::insertGetId([
                    'translation_lang' => $default_category['abbr'],
                    'translation_of' => 0,
                    'name' => $default_category['name'],
                    'slug' => $default_category['name'],
                    'image' => $request_image 
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
                         'image'            => $request_image
                    ];
                }//end of foreach

                MainCategory::insert($categories_arr);
            }//end of if 

         DB::commit();
         session()->flash('success', __('site.added_successfully'));
         return redirect()->route('maincategories.index');

        } catch (\Exception $ex) {

            DB::rollback();
            session()->flash('error', __('حدث خطأ لم يتم اضافه البيانات '));
            return redirect()->route('maincategories.index');

        }//en ofcatch
    }//end of store

   

    public function edit(MainCategory $maincategory)
    {
       
        return view('admin.maincategories.edit', compact('maincategory'));

    }//end of edit



    public function update(Request $request, MainCategory $maincategory)
    {
     

       $request->validate([

    
        'image'             => 'image',
        'category'          => 'required|array|min:1',
        'category.*.name'   => 'required|string|min:4',
        'category.*.abbr'   => 'required',
   
        
        ]);//end of validate

        try{

        $request_image = $request->except(['image','category','_method','_token']);

        $request_data = array_values ($request->category)[0];
  
    
        if (!$request->has('category.0.active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

               // update data
        $maincategory->update([

                'name'   => $request_data['name'],
                'active' => $request-> active 
               
        ]);//end of update data

            // update image
        if ($request->has('image')){ 

            Storage::disk('public_uploads')->delete('/category_images/' . $maincategory->image);

              }//end of has image

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/category_images/' . $request->image->hashName()));

            $request_image= $request->image->hashName();

       

             $maincategory->update([
             'image'  => $request_image
    ]);//end of update image

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('maincategories.index');

    } catch (\Exception $ex) {

            session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('maincategories.index');

    }//en ofcatch

    }//end of update

    
    public function destroy(MainCategory $maincategory)
    {
        dd($maincategory->id);
        //
    }//end of destory
}
