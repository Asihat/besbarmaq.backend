<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lenta extends Model
{
    protected $table = 'lenta';

    public function Index($user_id)
    {
        $lenta = $this->LentaCategory;
        return $lenta;
    }

    public function LentaCategory()
    {
        return $this->hasMany('App\Models\LentaCategory', 'lenta_id', 'id');
    }

}
