<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';
    protected $fillable = ['user_id', 'lenta_id', 'comment'];
}
