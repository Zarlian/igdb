<?php

namespace App\Modules\Games\Services;

use App\Models\GameGenre;
use App\Models\GameLanguage;
use App\Models\GamePlatform;
use App\Models\GameUser;
use App\Models\Screenshot;
use App\Models\Trailer;

class AdminGameService extends BaseGameService
{
    public function find($id)
    {
        $game = $this->model
            ->select($this->fields)
            ->with($this->getRelationFields())
            ->with('translations')
            ->find($id);

        return $this->mapToAdminFormat($game);
    }

    public function mapToAdminFormat($game)
    {
        return $this->map($game);
    }

    //todo refactor create, update, delete methods

    public function create($data, $ruleKey = "add")
    {
        $game = parent::create($data, $ruleKey);

        if (isset($data['genres'])) {
            $game->genres()->attach($data['genres']);
        }

        if (isset($data['platforms'])) {
            $game->platforms()->attach($data['platforms']);
        }

        if (isset($data['translations'])) {
            foreach ($data['translations'] as $translationData) {
                $translation = new GameLanguage($translationData);
                $game->translations()->save($translation);
            }
        }

        if (isset($data['screenshots'])) {
            foreach ($data['screenshots'] as $screenshotUrl) {
                $screenshot = new Screenshot(['url' => $screenshotUrl]);
                $game->screenshots()->save($screenshot);
            }
        }

        if (isset($data['trailers'])) {
            foreach ($data['trailers'] as $trailerUrl) {
                $trailer = new Trailer(['url' => $trailerUrl]);
                $game->trailers()->save($trailer);
            }
        }

        return $game;
    }

    public function update($data, $id)
    {
        $game = parent::update($data, $id);

        if (isset($data['genres'])) {
            $game->genres()->sync($data['genres']);
        }

        if (isset($data['platforms'])) {
            $game->platforms()->sync($data['platforms']);
        }

        if (isset($data['translations'])) {
            foreach ($data['translations'] as $translationData) {
                $translation = GameLanguage::where('game_id', $id)
                    ->where('language', $translationData['language'])
                    ->first();

                if ($translation) {
                    $translation->update($translationData);
                } else {
                    $translationData['game_id'] = $id;
                    $translation = new GameLanguage($translationData);
                    $game->translations()->save($translation);
                }
            }
        }

        if (isset($data['screenshots'])) {
            $game->screenshots()->delete();
            foreach ($data['screenshots'] as $screenshotUrl) {
                $screenshot = new Screenshot(['url' => $screenshotUrl, 'game_id' => $id]);
                $game->screenshots()->save($screenshot);
            }
        }

        if (isset($data['trailers'])) {
            $game->trailers()->delete();
            foreach ($data['trailers'] as $trailerUrl) {
                $trailer = new Trailer(['url' => $trailerUrl, 'game_id' => $id]);
                $game->trailers()->save($trailer);
            }
        }
        return $game;
    }

    public function delete($id)
    {
        $screenshots = Screenshot::where('game_id', $id)->get();
        foreach ($screenshots as $screenshot) {
            $screenshot->delete();
        }
        $trailers = Trailer::where('game_id', $id)->get();
        foreach ($trailers as $trailer) {
            $trailer->delete();
        }

        $translations = GameLanguage::where('game_id', $id)->get();
        foreach ($translations as $translation) {
            $translation->delete();
        }

        $ratings = GameUser::where('game_id', $id)->get();
        foreach ($ratings as $rating) {
            $rating->delete();
        }

        $gameGenre = GameGenre::where('game_id', $id)->get();
        foreach ($gameGenre as $genre) {
            $genre->delete();
        }

        $gamePlatform = GamePlatform::where('game_id', $id)->get();
        foreach ($gamePlatform as $platform) {
            $platform->delete();
        }

        $game = $this->model->find($id);
        $game->delete();
        return $game;
    }

    public function toggleFeatured($id)
    {
        $game = $this->model->find($id);
        $game->featured = !$game->featured;
        $game->save();
        return $game;
    }

}
