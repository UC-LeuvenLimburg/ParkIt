<?php

use Faker\Calculator\Iban;
use Illuminate\Database\Seeder;

class rentableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Rentable::class, 100)->create();
    }
    
}
