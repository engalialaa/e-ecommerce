<?php

namespace App\ModelsAdmin;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{

    protected $guarded = [];



    public function scopeActive($query)
        {
            return $query->where('active', 1);
            
       }// end of scopeActive


       
    public function getActive(){
        return   $this -> active == 1 ? 'مفعل'  : 'غير مفعل';
      }//end of getActive

      public function  scopeSelection($query){

        return $query -> select('id','abbr', 'name', 'direction', 'active');
    }

}//end of MainCategories




