<?php

namespace App\ModelsAdmin;

use Illuminate\Database\Eloquent\Model;

class MainCategories extends Model
{
  
    protected $guarded = [];


    protected $appends = ['image_path'];



    public function scopeActive($query)
    {
        return $query->where('active', 1);
        
    }// end of scopeActive

    
    public function  scopeSelection($query){

        return $query ->select('id','translation_lang', 'name', 'image', 'active');
    }

    public function getActive(){
        return   $this -> active == 1 ? 'مفعل'  : 'غير مفعل';
      }//end of getActive

      public function getImagePathAttribute()
      {
          return asset('uploads/category_images/' . $this->image);
  
      }//end of get image path


}//end of MainCategories



