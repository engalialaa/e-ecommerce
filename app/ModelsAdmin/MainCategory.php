<?php

namespace App\ModelsAdmin;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
  
    protected $guarded = [];


    protected $appends = ['image_path'];



    public function scopeActive($query)
    {
        return $query->where('active', 1);
        
    }// end of scopeActive

    
    public function  scopeSelection($query){

        return $query->select('id','translation_lang', 'name', 'image', 'active');
    }

    public function getActive(){
        return   $this -> active == 1 ? 'مفعل'  : 'غير مفعل';
      }//end of getActive

      public function getImagePathAttribute()
      {
          return asset('uploads/category_images/' . $this->image);
          
      }//end of get image path


           // get all translation categories
    public function categories()
    {
        return $this->hasMany(self::class, 'translation_of');

    }//end of categories


    
    public function vendors(){

        return $this -> hasMany('App\ModelsAdmin\Vendor','category_id','id');

    }//end of hasMany vendors



}//end of MainCategory



