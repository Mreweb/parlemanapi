<?php

namespace App\Http\Middleware;

use App\Application\Services\Utility\DBMessageService;
use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
use Illuminate\Http\Request;
use UnexpectedValueException;

class JWTAuthMultiRole{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $key = env("JWT_SECRET");
        $header = $request->header('authorization');
        $header = str_ireplace("Bearer ", "", $header);

        try {
            $decoded = JWT::decode($header, new Key($key, 'HS256'));
            $decoded_array = (array) $decoded;

            if (!isset($decoded_array['token_expire_time']) || $decoded_array['token_expire_time'] < time()) {
                return response()->json(DBMessageService::get_message(null, "ErrorAction", "توکن منقضی شده است"), 401);
            }
            if (!isset($decoded_array['person_id'])) {
                return response()->json(DBMessageService::get_message(null, "ErrorAction", "احراز هویت ناموفق"), 401);
            }

            $userRole = $decoded_array['person_role'] ?? null;
            if (!$userRole) {
                return response()->json(DBMessageService::get_message(null, "ErrorAction", "نقش کاربر مشخص نشده است"), 403);
            }

            if (!empty($roles) && !in_array($userRole, $roles)) {
                return response()->json(DBMessageService::get_message(null, "ErrorAction", "دسترسی غیرمجاز"), 403);
            }

            $request->merge([
                'jwt_user' => $decoded_array
            ]);

        } catch (SignatureInvalidException | UnexpectedValueException $e) {
            return response()->json(DBMessageService::get_message(null, "ErrorAction", "توکن نامعتبر است"), 401);
        }

        return $next($request);
    }
}
