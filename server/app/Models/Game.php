<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

    use HasFactory;

    protected $fillable = ['title', 'release_date','cover', 'esrb_rating', 'average_rating', 'rating_count', 'developer_id', 'featured'];


    protected $hidden = ['created_at', 'updated_at'];

    public function developer()
    {
        return $this->belongsTo(Developer::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'game_genre');
    }

    public function platforms()
    {
        return $this->belongsToMany(Platform::class, 'game_platform');
    }

    public function screenshots()
    {
        return $this->hasMany(Screenshot::class);
    }


    public function trailers()
    {
        return $this->hasMany(Trailer::class);
    }

    public function ratings()
    {
        return $this->hasMany(GameUser::class);
    }

    public function translations()
    {
        return $this->hasMany(GameLanguage::class);
    }


}
