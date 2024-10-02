<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gamelist extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'game_id'];

    protected $table = 'gamelist';
}
