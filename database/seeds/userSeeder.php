<?php

use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('users')->insert([
            'name' => 'John Doe',
            'email' =>'John.Doe@hotmail.com' ,
            'password' => Hash::make('password'),
        ]);
    }
    
}
