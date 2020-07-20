<?php

use Illuminate\Database\Seeder;

class ChiefsTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Chiefs::create([
            'id' => 15,
            'description' => 'I am good person. Order my food',
            'status' => 1,
            'work_time' => '8 till 18',
            'location_id' => 1,
            'gender' => 'Female',
            'contact' => 'google.com',
            'home_cook' => 0,
        ]);
    }
}
