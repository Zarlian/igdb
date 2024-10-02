<?php

namespace App\Http\Controllers;

use App\Modules\Users\Services\GamelistApiService;
use Illuminate\Http\Response;

class GamelistApiController extends Controller
{
    protected $service;

    public function __construct(GamelistApiService $service)
    {
        $this->service = $service;
    }

    public function games($userId)
    {
        $result = $this->service->games($userId);
        return response()->json($result);
    }

    public function addGame($id, $gameId)
    {

        $result = $this->service->addGame($id, $gameId);
        if ($this->service->hasErrors()) {
            $errors = $this->service->getErrors();
            $errors = $this->presentErrors($errors);
            return response()->json($errors, Response::HTTP_BAD_REQUEST);
        }

        return response()->json($result, Response::HTTP_CREATED);
    }

    public function removeGame($userId, $gameId)
    {
        $result = $this->service->removeGame($userId, $gameId);
        if ($this->service->hasErrors()) {
            $errors = $this->service->getErrors();
            $errors = $this->presentErrors($errors);
            return response()->json($errors, Response::HTTP_BAD_REQUEST);
        }

        return response()->json($result);
    }

}
