<?php

namespace App\Http\Controllers;
use App\Application\Services\DBMessageService;
use App\Application\Services\UploadService;
use App\Http\Requests\Upload\UploadRequest;
use Illuminate\Support\Str;


class Upload{


    public function __construct(private UploadService $service) {}


    /**
     * @lrd:start
     بارگذاری فایل
     * @lrd:end
     *
     * @LRDparam file
     */
    public function save(UploadRequest $request){

        $request->validated();
        $path = $request->file('file')->store('uploads', 'public');

        $extension = $request->file('file')->getClientOriginalExtension();
        $data = [
            'media_id' => Str::uuid()->toString(),
            'path' => $path,
            'base_64' => base64_encode(file_get_contents($request->file('file'))),
            'extension' => $extension
        ];
        $result = $this->service->save($data);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }

    public function get_file($id){
        $result = $this->service->get_file($id);
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }

    }




}
