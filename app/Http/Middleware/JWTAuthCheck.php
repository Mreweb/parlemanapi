<?php

namespace App\Http\Middleware;

use App\Application\Services\Utility\DBMessageService;
use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\Key;
use Firebase\JWT\JWT;

class JWTAuthCheck{
    public function handle(Request $request, Closure $next){
        $key = env("JWT_SECRET");
        $header = $request->header('authorization');
        $header = str_ireplace("Bearer ", "", $header);

        $decoded = JWT::decode($header, new Key($key, 'HS256'));
        $decoded_array = (array)$decoded;

        if ($decoded_array['token_expire_time'] < time()) {
            return response()->json(DBMessageService::get_message(null, "ErrorAction", "توکن منقضی شده است"), 401);
        }

        if (!isset($decoded_array['person_id'])) {
            return response()->json(DBMessageService::get_message(null, "ErrorAction", "شناسه کاربر در توکن یافت نشد"), 401);
        }


        $request->setUserResolver(function () use ($decoded_array) {
            return $decoded_array;
        });


        return $next($request);
    }
}
