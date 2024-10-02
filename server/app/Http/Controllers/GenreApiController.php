<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiServiceController;
use App\Modules\Genres\Services\GenreService;

class GenreApiController extends ApiServiceController
{
    protected $service;

    public function __construct(GenreService $service)
    {
        $this->service = $service;
    }
}
