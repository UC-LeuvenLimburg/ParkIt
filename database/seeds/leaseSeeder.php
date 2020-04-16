<?php

use Illuminate\Database\Seeder;

class leaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('leases')->insert([
            'user_id' => 2,
            'rentable_id' => 5 ,
            'start_time' => now(),
            'end_time' => now(),
        ]);
        factory(App\Models\Lease::class, 100)->create();
    }

}
