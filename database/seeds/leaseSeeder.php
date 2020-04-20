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
        factory(App\Models\Lease::class, 100)->create();
    }
}
