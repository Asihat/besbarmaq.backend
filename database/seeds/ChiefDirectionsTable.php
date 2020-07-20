<?php

use Illuminate\Database\Seeder;

class ChiefDirectionsTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ChiefDirections::create([
           'chief_id' => 15,
           'category_id' => 1,
        ]);

        \App\Models\ChiefDirections::create([
            'chief_id' => 15,
            'category_id' => 2,
        ]);

        \App\Models\ChiefDirections::create([
            'chief_id' => 15,
            'category_id' => 3,
        ]);


    }
}
