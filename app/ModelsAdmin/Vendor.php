<?php

namespace App\ModelsAdmin;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $guarded = [];
    

    protected $appends = ['image_path'];

    public function getLogoPathAttribute()
    {
        return asset('uploads/vendors_logo/' . $this->logo);

    }//end of get image path

    public function scopeActive($query)
    {

        return $query->where('active', 1);
         
    }// end of scopeActive 

    
    public function category()
    {

        return $this -> belongsTo ('App\ModelsAdmin\MainCategory', 'category_id', 'id');

    }// end of belongsTo category

    public function getActive()
    {
        return $this->active == 1 ? 'مفعل' : 'غير مفعل';

    }// end of getActive 


    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }//end of get first name


    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }//end of get last name



}// end of vendor 
