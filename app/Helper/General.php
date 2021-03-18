<?php
use App\ModelsAdmin\Language;
use Illuminate\Support\Facades\Config;



function get_language(){

   return Language::active()->Selection()->get();
}//enf of get_language

function get_default_lang(){

     return Config::get('app.locale');
}//enf of get_default_lang




