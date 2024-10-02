<?php

namespace App\Modules\Users\Services;

use App\Models\Game;
use App\Models\Gamelist;
use App\Modules\Core\Services\Service;


class GamelistApiService extends Service {

    protected $fields = ["id", "name", "email"];

    protected $rules = [];

    protected $gameModel;

    public function __construct(Gamelist $model, Game $gameModel){
        parent::__construct($model);
        $this->gameModel = $gameModel;
    }

    public function games($userId){
        $gameList = $this->model->where('user_id', $userId)->get();

        $gameIds = $gameList->pluck('game_id')->toArray();
        $games = $this->gameModel->whereIn('id', $gameIds)->get();

        return $games;
    }

    public function addGame($userId, $gameId)
    {
        $game = $this->gameModel->find($gameId);
        if(!$game){
            $this->errors->add('game', 'Game not found');
            return;
        }
        $gamelist = $this->model->where('user_id', $userId)->where('game_id', $gameId)->first();
        if($gamelist){
            $this->errors->add('game', 'Game already in list');
            return;
        }
        $gamelist = $this->model->create([
            'user_id' => $userId,
            'game_id' => $gameId
        ]);
        return $gamelist;
    }


    public function removeGame($userId, $gameId)
    {
        $gamelist = $this->model->where('user_id', $userId)->where('game_id', $gameId)->first();
        if(!$gamelist){
            $this->errors->add('game', 'Game not in list');
            return;
        }
        $gamelist->delete();
        return $gamelist;
    }


}
