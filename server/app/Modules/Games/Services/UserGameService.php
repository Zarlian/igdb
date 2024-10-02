<?php

namespace App\Modules\Games\Services;

use Illuminate\Support\Facades\DB;


class UserGameService extends BaseGameService
{
    public function ratings($id)
    {
        return $this->model
            ->select($this->fields)
            ->with("ratings")
            ->find($id);
    }

    public function featured()
    {
        return $this->model
            ->select($this->fields)
            ->where('featured', 1)
            ->get();
    }

    public function favorites()
    {
        $topGames = DB::table('gamelist')
            ->select('game_id')
            ->groupBy('game_id')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        $topGameIds = $topGames->pluck('game_id')->toArray();

        $games = $this->model
            ->select('id', 'title', 'cover', 'average_rating', 'rating_count')
            ->whereIn('id', $topGameIds)
            ->get();

        return $games;
    }

    public function topRated()
    {
        return $this->model
            ->select($this->fields)
            ->orderBy('average_rating', 'desc')
            ->limit(10)
            ->get();
    }

    public function popular()
    {
        return $this->model
            ->select($this->fields)
            ->orderBy('rating_count', 'desc')
            ->get(10);
    }

}
