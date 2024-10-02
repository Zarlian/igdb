<?php

namespace App\Http\Controllers;

use App\Modules\Users\Services\RatingService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RatingApiController extends Controller
{
    protected $service;

    public function __construct(RatingService $service)
    {
        $this->service = $service;
    }

    public function rateGame(Request $request, $userId, $gameId)
    {
        $result = $this->service->rateGame($request->all(), $userId, $gameId);
        if ($this->service->hasErrors()) {
            $errors = $this->service->getErrors();
            $errors = $this->presentErrors($errors);
            return response()->json($errors, Response::HTTP_BAD_REQUEST);
        }
        return response()->json($result, Response::HTTP_CREATED);
    }
}
