<?php

namespace App\Http\Controllers;

use App\Modules\Platforms\Services\PlatformService;

class PlatformApiController extends ApiServiceController
{
    protected $service;

    public function __construct(PlatformService $service)
    {
        $this->service = $service;
    }
}
