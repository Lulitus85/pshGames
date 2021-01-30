<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nick_name', 'photo'];

    public function game(){
        return $this->hasMany('App\Game');
    }

    public function result(){
        return $this->hasMany('App\Result');
    }
}
