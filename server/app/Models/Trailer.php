<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trailer extends Model
{
    use HasFactory;

    protected $fillable = ['game_id', 'url'];
    protected $hidden = ['id', 'game_id', 'created_at', 'updated_at'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
