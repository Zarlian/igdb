<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\ApiServiceController;
use App\Modules\Games\Services\UserGameService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GameApiController extends ApiServiceController
{
    protected $service;

    public function __construct(UserGameService $service)
    {
        $this->service = $service;
    }

    public function ratings($id)
    {
        $result = $this->service->ratings($id);
        return response()->json($result);
    }

    public function featured()
    {
        $result = $this->service->featured();
        return response()->json($result);
    }

    public function favorites()
    {
        $result = $this->service->favorites();
        return response()->json($result);
    }

    public function topRated()
    {
        $result = $this->service->topRated();
        return response()->json($result);
    }

    public function popular()
    {
        $result = $this->service->popular();
        return response()->json($result);
    }

}
