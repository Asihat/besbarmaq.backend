<?php

use Illuminate\Database\Seeder;

class FoodCategoryTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\FoodCategory::create([
           'name' => 'Горячие блюда',
           'description' => 'Горячие блюда'
        ]);

        \App\Models\FoodCategory::create([
            'name' => 'Супы',
            'description' => 'Супы'
        ]);

        \App\Models\FoodCategory::create([
            'name' => 'Салаты',
            'description' => 'Салаты'
        ]);

        \App\Models\FoodCategory::create([
            'name' => 'Завтраки',
            'description' => 'Завтраки'
        ]);

        \App\Models\FoodCategory::create([
            'name' => 'Мучные продукты',
            'description' => 'Мучные продукты'
        ]);

        \App\Models\FoodCategory::create([
            'name' => 'Правильное Питание',
            'description' => 'Правильное Питание'
        ]);

        \App\Models\FoodCategory::create([
            'name' => 'Напитки',
            'description' => 'Напитки'
        ]);

        \App\Models\FoodCategory::create([
            'name' => 'Замарозки',
            'description' => 'Замарозки'
        ]);

        \App\Models\FoodCategory::create([
            'name' => 'Торты',
            'description' => 'Торты'
        ]);

        \App\Models\FoodCategory::create([
            'name' => 'Закуски',
            'description' => 'Закуски'
        ]);

        \App\Models\FoodCategory::create([
            'name' => 'Сушенные продукты',
            'description' => 'Сушенные продукты'
        ]);

        \App\Models\FoodCategory::create([
            'name' => 'Капченные продукты',
            'description' => 'Капченные продукты'
        ]);

        \App\Models\FoodCategory::create([
            'name' => 'Молочные продукты',
            'description' => 'Закуски'
        ]);
    }
}
