<?php

use Illuminate\Database\Seeder;

class PortionTypeTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\PortionType::create([
           'name' => 'Порция'
        ]);

        \App\Models\PortionType::create([
            'name' => 'кг'
        ]);

        \App\Models\PortionType::create([
            'name' => 'Штук'
        ]);

        \App\Models\PortionType::create([
            'name' => 'Пол.порции'
        ]);

        \App\Models\PortionType::create([
            'name' => 'Грамм'
        ]);
    }
}
