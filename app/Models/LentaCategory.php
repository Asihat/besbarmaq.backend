<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LentaCategory extends Model
{
    protected $table = 'lenta_category';

    public function FoodCategory() {
        return $this->hasOne('App\Models\FoodCategory', 'id', 'category_id');
    }
}
