<?php

use Illuminate\Database\Seeder;

class LentaCategoryTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\LentaCategory::create([
           'lenta_id' => 1,
            'category_id' => 1,
        ]);

        \App\Models\LentaCategory::create([
            'lenta_id' => 1,
            'category_id' => 2,
        ]);

        \App\Models\LentaCategory::create([
            'lenta_id' => 1,
            'category_id' => 3,
        ]);
    }
}
