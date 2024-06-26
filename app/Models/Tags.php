<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function posts(){
        return $this->morphedByMany('App\Models\Posts', 'taggable');
    }

    public function videos(){
        return $this->morphedByMany('App\Models\Posts', 'taggable');
    }
}
