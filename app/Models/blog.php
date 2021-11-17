<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    protected $table = 'blogs';
    public $timestamps = false;
    protected $fillable = [
        'title', 'image', 'description', 'content'
    ];
    public function comment()
    {
        return $this->hasMany('App\Models\comment', 'id_blog');
    }
}
