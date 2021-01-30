<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['id'];

    public function player(){
        return $this->hasMany('App\Player');
    }

    public function result(){
        return $this->hasMany('App\Result');
    }
}
