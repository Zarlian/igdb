<?php

namespace App\Http\Controllers;

use App\Modules\Developers\Services\DeveloperService;

class DeveloperApiController extends ApiServiceController
{
    protected $service;

    public function __construct(DeveloperService $service)
    {
        $this->service = $service;
    }
}
