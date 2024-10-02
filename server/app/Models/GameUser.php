<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameUser extends Model
{
    use HasFactory;

    protected $fillable = ['game_id', 'user_id', 'rating', 'review'];

    protected $table = 'game_user';
}
