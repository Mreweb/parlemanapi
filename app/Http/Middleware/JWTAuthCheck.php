<?php

namespace App\Http\Middleware;

use App\Application\Services\DBMessageService;
use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
use Illuminate\Http\Request;
use UnexpectedValueException;

class JWTAuthCheck{
    public function handle(Request $request, Closure $next){

        $key = env('JWT_SECRET');
        $header = $request->header('authorization');
        $header = str_ireplace("Bearer ","",$header);
        try {
            $decoded = JWT::decode($header, new Key($key, 'HS256'));
            $decoded_array = (array) $decoded;
            if($decoded_array['token_expire_time'] < time()){
                return response()->json(DBMessageService::get_message(null,"ErrorAction","خطا در احراز هویت"), 401);
            }
            if(!isset($decoded_array['person_id'])){
                return response()->json(DBMessageService::get_message(null,"ErrorAction","خطا در احراز هویت"), 401);
            }
        } catch (SignatureInvalidException|UnexpectedValueException  $e) {
            return response()->json(DBMessageService::get_message(null,"ErrorAction","خطا در احراز هویت"), 401);
        }
        return $next($request);
    }
}
