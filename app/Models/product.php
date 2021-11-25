<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'name', 'price', 'id_category', 'id_brand', 'status', 'sale', 'company', 'hinhanh', 'detail',
    ];
}
