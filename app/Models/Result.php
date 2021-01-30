<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'id_player', 'id_game', 'score'];

    public function game(){
        return $this->belongsTo('App\Game');
    }

    public function player(){
        return $this->belongsTo('App\Player');
    }
}
