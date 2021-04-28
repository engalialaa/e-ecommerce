<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->Increments('id');
            $table->char('name', 150);
            $table->char('phone',50);	
            $table->text('address');
            $table->char('email',100)->nullable();
            $table->string('password');
            $table->text('logo')->default('default.png');	
            $table->char('category_id',10);	
            $table->tinyInteger('active')->default('0'); 
            $table->timestamp('email_verified_at')->nullable();	
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
        Schema::dropIfExists('vendors');
    }
}
