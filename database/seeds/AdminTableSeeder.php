<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\ModelsAdmin\Admin::create([
            'first_name'  => 'super',
            'last_name'  => 'admin ',
            'email'      => 'super_admin@app.com',
            'password'   =>  bcrypt('123456'),
        ]);
        
        $admin->attachRole('super_admin');
        
    }
}
