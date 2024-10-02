<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\ApiServiceController;
use App\Modules\Games\Services\AdminGameService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class AdminGameApiController extends ApiServiceController
{
    protected $service;

    public function __construct(AdminGameService $service)
    {
        $this->service = $service;
    }

    public function toggleFeatured($id)
    {
        $result = $this->service->toggleFeatured($id);
        if ($this->service->hasErrors()) {
            $errors = $this->service->getErrors();
            $errors = $this->presentErrors($errors);
            return response()->json($errors, Response::HTTP_BAD_REQUEST);
        }

        return response()->json($result);
    }
}
