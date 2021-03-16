<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_categories', function (Blueprint $table) {
            $table->Increments('id');
            $table->char('translation_lang', 10);
            $table->integer('translation_of')->unsigned();	
            $table->char('name', 150);	
            $table->char('slug', 150)->nullable();	
            $table->text('image')->default('default.png');	
            $table->tinyInteger('active')->default('1'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main_categories');
    }
}
