<?php

use Illuminate\Database\Seeder;

class CuisineCategoryTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\CuisineCategory::create(
            ['name' => 'Казахская', 'description' => 'Казахская кухняго)']
        );

        \App\Models\CuisineCategory::create(
            ['name' => 'Русская', 'description' => 'Русская кухняго)']
        );

        \App\Models\CuisineCategory::create(
            ['name' => 'Грузинская', 'description' => 'Грузинская кухняго)']
        );

        \App\Models\CuisineCategory::create(
            ['name' => 'Узбекская', 'description' => 'Узбекская кухняго)']
        );


        \App\Models\CuisineCategory::create(
            ['name' => 'Японская', 'description' => 'Японская кухняго)']
        );

        \App\Models\CuisineCategory::create(
            ['name' => 'Корейская', 'description' => 'Корейская)']
        );
    }
}
