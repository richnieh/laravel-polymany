<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    use HasFactory;

    protected $fillable = [
        'path'
    ];

    public function tags(){
        return $this->morphToMany('App\Models\Tags', 'taggable');
    }
}
