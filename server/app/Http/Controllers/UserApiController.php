<?php

namespace App\Http\Controllers;

use App\Modules\Users\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserApiController extends ApiServiceController
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function ratings($id)
    {
        $result = $this->service->ratings($id);
        return response()->json($result);
    }

}
