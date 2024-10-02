<?php

namespace App\Modules\Games\Services;

use App\Models\Game;
use App\Modules\Core\Services\Service;
use Illuminate\Support\Facades\App;

class BaseGameService extends Service
{
    protected $fields = ["id", "title", "developer_id", "release_date", "esrb_rating", "average_rating", "rating_count", 'cover', 'featured'];

    protected $rules;
    protected $translatable = true;
    public function __construct(Game $model)
    {
        parent::__construct($model);
        $this->rules = [
            'add' => $this->getRules(),
            'update' => $this->getRules(),
        ];
    }

    protected function getRules()
    {
        return [
            'title' => 'required|string|max:100',
            'developer_id' => 'required|integer',
            'release_date' => 'required|string',
            'esrb_rating' => 'required|string|max:50',
            'cover' => 'required|string',
            'featured' => 'required|boolean',
            'genres' => 'required|array',
            'genres.*' => 'integer|exists:genres,id',
            'platforms' => 'required|array',
            'platforms.*' => 'integer|exists:platforms,id',
            'translations' => 'required|array',
            'translations.*.language' => 'required|string|max:2',
            'translations.*.short_description' => 'required|string',
            'translations.*.long_description' => 'required|string',
        ];
    }

    protected function getRelationFields()
    {
        return [
            'screenshots',
            'developer',
            'genres',
            'platforms',
            'trailers'
        ];
    }



    public function map($game)
    {
        if (!$game) {
            return "no games found";
        }

        $gameArray = $game->toArray();
        $gameArray["genres"] = collect($gameArray["genres"])->pluck('name');
        $gameArray["platforms"] = collect($gameArray["platforms"])->pluck('name');
        $gameArray["screenshots"] = collect($gameArray["screenshots"])->pluck('url');
        $gameArray["developer"] = $gameArray["developer"]["name"];
        $gameArray["trailers"] = collect($gameArray["trailers"])->pluck('url');
        return $gameArray;
    }

    public function all($perPage, $search)
    {
        $games = $this->fetchGames($perPage, $search);

        return [
            'data' => $this->transformGames($games),
                'current_page' => $games->currentPage(),
                'first_item' => $games->firstItem(),
                'last_page' => $games->lastPage(),
                'path' => $games->path(),
                'per_page' => $games->perPage(),
                'last_item' => $games->lastItem(),
                'total' => $games->total(),
                'first_page_url' => $games->url(1),
                'last_page_url' => $games->url($games->lastPage()),
                'next_page_url' => $games->nextPageUrl(),
                'prev_page_url' => $games->previousPageUrl(),
                'links' => [
                    'first' => $games->url(1),
                    'last' => $games->url($games->lastPage()),
                    'prev' => $games->previousPageUrl(),
                    'next' => $games->nextPageUrl(),
                ],

        ];
    }


    private function fetchGames($perPage, $search)
    {
        $language = App::getLocale();

        $model = $this->model;
        if ($search) {
            $model =  $model->where('title', 'like', "%$search%");
        }

        return $model
            ->select($this->fields)
            ->with($this->getRelationFields())
            ->with(['translations' => function ($query) use ($language) {
                $query->where('language', $language);
            }])
            ->paginate($perPage)
            ->withQueryString();
    }

    private function transformGames($games)
    {
        return $games->map(function ($game) {
            return $this->mapToUserFormat($game);
        })->toArray();
    }

    private function mapToUserFormat($game)
    {
        if (!$game) {
            return "no games found";
        }

        $gameArray = $this->map($game);
        $gameArray["short_description"] = $gameArray["translations"][0]["short_description"];
        $gameArray["long_description"] = $gameArray["translations"][0]["long_description"];

        unset($gameArray["translations"]);

        return $gameArray;
    }

    public function find($id)
    {
        $language = App::getLocale();
        $game = $this->model
            ->select($this->fields)
            ->with($this->getRelationFields())
            ->with(['translations' => function ($query) use ($language) {
                $query->where('language', $language);
            }])
            ->find($id);

        return $this->mapToUserFormat($game);
    }
}
