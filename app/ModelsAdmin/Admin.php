<?php

namespace App\ModelsAdmin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;


class Admin extends Authenticatable
    {
        use LaratrustUserTrait;
        use Notifiable;
    
      
        protected $fillable = [
            'first_name','last_name', 'email', 'password', 'image','created_at', 'updated_at',
        ];
    
      
        protected $hidden = [
            'password', 'remember_token',
        ];

        protected $appends = ['image_path'];


        protected $casts = [
            'email_verified_at' => 'datetime',
        ];

        
    public function getImagePathAttribute()
    {
        return asset('uploads/admins_images/' . $this->image);

    }//end of get image path

    
    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }//end of get first name


    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }//end of get last name



    }

