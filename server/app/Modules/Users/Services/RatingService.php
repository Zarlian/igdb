<?php

namespace App\Modules\Users\Services;

use App\Models\Game;
use App\Models\GameUser;
use App\Modules\Core\Services\Service;


class RatingService extends Service {

    protected $fields = ["id", "name", "email"];

    protected $rules = [];

    protected $gameModel;

    protected function getRelationFields()
    {
        return [
            "rate" => ["rating"| "required|numeric|between:1,5"]
        ];
    }


    public function __construct(GameUser $model, Game $gameModel){
        parent::__construct($model);
        $this->gameModel = $gameModel;
    }


    public function rateGame($data, $userId, $gameId){
        if(! $this->validate($data, "rate")){
            return;
        }
        $rating =  $this->model->create([
            'user_id' => $userId,
            'game_id' => $gameId,
            'rating' => $data['rating'],
            'review' => $data['review']
        ]);

        $game = $this->gameModel->find($gameId);
        $game->rating_count = $game->rating_count + 1;
        $game->average_rating = number_format(($game->average_rating + $data['rating']) / $game->rating_count, 1);
        $game->save();

        return $rating;
    }


}
