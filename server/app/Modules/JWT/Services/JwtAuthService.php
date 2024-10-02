<?php

namespace App\Modules\JWT\Services;


use App\Models\User;
use App\Modules\Core\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Random;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtAuthService extends Service
{
    protected $rules = [
        "register" => [
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required"
            ],
        "login" => [
            "email" => "required|email",
            "password" => "required"
        ]
    ];
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function login($data)
    {
        if (!$this->validate($data, 'login')) {
            return [
                "status" => false,
                "message" => "Validation failed"
            ];
        }

        $csrfLength = env("CSRF_TOKEN_LENGTH");
        $csrfToken = Random::generate($csrfLength);

        // JWTAuth
        $token = JWTAuth::claims(['X-XSRF-TOKEN' => $csrfToken])->attempt($data);

        if (empty($token)) {
            return [
                "status" => false,
                "message" => "Invalid details"
            ];
        }

        // Add cookies
        $ttl = env("JWT_COOKIE_TTL");
        $tokenCookie = cookie("token", $token, $ttl);
        $csrfCookie = cookie("X-XSRF-TOKEN", $csrfToken, $ttl);

        return [
            "status" => true,
            "message" => "User logged in successfully",
            "cookies" => [$tokenCookie, $csrfCookie]
        ];
    }

    public function register($data)
    {
        if (!$this->validate($data, 'register')) {
            return;
        }

        $data['password'] = Hash::make($data['password']);

        $this->model->create($data);

        return [
            "status" => true,
            "message" => "User registered successfully"
        ];
    }

    public function logout()
    {
        auth()->logout();

        return [
            "status" => true,
            "message" => "User logged out successfully"
        ];
    }

    public function refresh()
    {
        $csrfLength = env('CSRF_TOKEN_LENGTH');
        $csrfToken = Random::generate($csrfLength);

        $token = JWTAuth::claims(['X-CSRF-TOKEN' => $csrfToken])->refresh();

        $ttl = env("JWT_COOKIE_TTL");   // added token expiry
        $tokenCookie = cookie("token", $token, $ttl);  // added jwt token cookie
        $csrfCookie = cookie("X-XSRF-TOKEN", $csrfToken, $ttl); // added csrf token cookie


        $response = [
            "status" => true,
            "message" => "New access token"
        ];

        return response()->$response->withCookie($tokenCookie)->withCookie($csrfCookie);
    }

    public function profile() {
        $user = auth()->user();

        return [
            "status" => true,
            "message" => "Profile data",
            "data" => $user
        ];
    }
}
