<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameLanguage extends Model
{
    use HasFactory;

    protected $fillable = ['game_id', 'language', 'short_description', 'long_description'];

    protected $hidden = ['created_at', 'updated_at', 'id', 'game_id'];

    protected $table = 'games_language';

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
