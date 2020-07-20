<?php

use Illuminate\Database\Seeder;

class ChiefsCategoryTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ChiefCategory::create([
            'name' => 'Шеф-Повар',
            'description' => 'Шеф-Повар'
        ]);

        \App\Models\ChiefCategory::create([
            'name' => 'Пекарь',
            'description' => 'Пекарь'
        ]);

        \App\Models\ChiefCategory::create([
            'name' => 'Кондитер',
            'description' => 'Кондитер'
        ]);

        \App\Models\ChiefCategory::create([
            'name' => 'Фьюжн-мастер',
            'description' => 'Фьюжн-мастер'
        ]);

        \App\Models\ChiefCategory::create([
            'name' => 'Повар высокой кухни',
            'description' => 'Повар высокой кухни'
        ]);

        \App\Models\ChiefCategory::create([
            'name' => 'Диетолог',
            'description' => 'Диетолог'
        ]);

        \App\Models\ChiefCategory::create([
            'name' => 'Технолог еды',
            'description' => 'Технолог еды'
        ]);

        \App\Models\ChiefCategory::create([
            'name' => 'Кулинар',
            'description' => 'Кулинар'
        ]);
    }
}
