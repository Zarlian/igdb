<?php

namespace App\Http\Controllers;

use App\Modules\JWT\Services\JwtAuthService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class JwtAuthController extends Controller
{
    protected $service;

    public function __construct(JwtAuthService $service)
    {
        $this->service = $service;
    }
    public function register(Request $request){

        $response = $this->service->register($request->all());

        if ($this->service->hasErrors()) {
            $errors = $this->service->getErrors();
            $errors = $this->presentErrors($errors);
            return response()->json($errors, Response::HTTP_BAD_REQUEST);
        }

        return response()->json($response);
    }

// Controller class
    public function login(Request $request)
    {
        $response = $this->service->login($request->all());

        if ($this->service->hasErrors()) {
            $errors = $this->service->getErrors();
            $errors = $this->presentErrors($errors);
            return response()->json($errors, Response::HTTP_BAD_REQUEST);
        }

        $cookies = $response['cookies'] ?? [];
        $jsonResponse = response()->json([
            "status" => $response['status'],
            "message" => $response['message']
        ]);

        foreach ($cookies as $cookie) {
            $jsonResponse->withCookie($cookie);
        }

        return $jsonResponse;
    }


    public function profile() {
        $profileData = $this->service->profile();

        return response()->json($profileData);
    }

    public function refreshToken(){

            $this->service->refresh();

            return response()->json([
                "status" => true,
                "message" => "Token refreshed successfully"
            ]);

    }

    public function logout(){

        $response = $this->service->logout();
        return response()->json($response);
    }
}

