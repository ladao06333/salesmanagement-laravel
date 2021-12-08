<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class history extends Model
{
    protected $table = 'history';
    protected $fillable = ['email', 'phone', 'name', 'id_user', 'price'];
}
