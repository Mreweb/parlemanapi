<?php

namespace App\Infrastructure\Persistence\Repositories\Auth;
use App\Application\Services\DBMessageService;
use App\Domain\Interfaces\IAuthRepository;
use App\Infrastructure\Persistence\Eloquent\Person\PersonEloquent;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthRepository implements IAuthRepository {


    public function otp(){

    }

    public function verifyOtp(){

    }

    public function loginByUsername(array $data){

        $record = DB::table('captcha')->where('captcha_id', $data['captcha_id'])->first();
        if (!$record) {
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"کد امنیتی نامعتبر است" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }

        if (Carbon::parse($record->created_at)->timestamp < Carbon::now()->subMinutes(100)->timestamp) {
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"کد امنیتی منقضی شده است" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }

        $valid = strtolower($record->captcha_code) === strtolower($data['captcha_code']);
        if (!$valid) {
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"کد امنیتی نامعتبر است" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }

        $query = PersonEloquent::query();
        $query->select('person_id','person_name','person_last_name','person_email','person_phone','person_role');
        $query->where('username', $data['username']);
        $query->where('password',  md5($data['password']) );

        $person =  $query->get();
        if($person->count() == 0){
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"اطلاعات نامعتبر است" ) , 400, [], JSON_UNESCAPED_UNICODE);
        } else{
            $key = env('JWT_SECRET');
            $payload = $person->toArray()[0];
            //$payload['token_create_date'] = Carbon::now();
            $payload['token_create_date'] = time();
            $payload['token_expire_time'] = time()+env('TOKEN_EXPIRE_TIME');
            $jwt = JWT::encode($payload, $key, 'HS256');
            return response()->json( DBMessageService::get_message(
                [
                    'token'=> $jwt
                    //'decoded'=> JWT::decode($jwt, new Key($key, 'HS256'))
                ],
                'SuccessAction',"ورود با موفقیت انجام شد" ) , 201, [], JSON_UNESCAPED_UNICODE);
        }



    }

}
