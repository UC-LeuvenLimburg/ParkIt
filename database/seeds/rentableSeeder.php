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
        DB::table('rentables')->insert([
            'user_id' => 2,
            'adress' => 'fakestraat 20',
            'postal_code' => 4200,
            'date_of_hire' => date("Y/m/d"),
            'start_time_rp' => now(),
            'end_time_rp' => now(),
            'price/h' => 6.5 ,
            'bankaccount_nr' => 'GB22VTKG87647593824219',
            'description' =>'Parking space is on the right side of the house',
        ]);
        factory(App\Models\Rentable::class, 100)->create();
    }
    
}
