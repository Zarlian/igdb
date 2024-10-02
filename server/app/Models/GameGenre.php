<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameGenre extends Model
{
    use HasFactory;

    protected $fillable = ['game_id', 'genre_id'];
    protected $hidden = ['game_id', 'genre_id','created_at', 'updated_at'];

    protected $table = 'game_genre';
}
