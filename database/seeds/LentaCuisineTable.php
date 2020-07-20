<?php

use Illuminate\Database\Seeder;

class LentaCuisineTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\LentaCuisine::create([
            'cuisine_id' => 1,
            'lenta_id' => 1,
        ]);
    }
}
