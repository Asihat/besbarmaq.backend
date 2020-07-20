<?php

use Illuminate\Database\Seeder;

class LentaTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Lenta::create([
            'name'	=> 'Қуырдақ',
            'description' => 'Вкусный Қуырдақ, принимаю заказ до обеда',
            'user_id' => 14,
            'price' => 1200.0,
            'photo' => 'firstlenta.png',
            'work_time' => '120 мин',
            'average_time' => '120 мин'
        ]);
    }
}
