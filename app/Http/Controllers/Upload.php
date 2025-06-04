<?php

namespace App\Http\Controllers;
use App\Application\Services\DBMessageService;
use App\Http\Requests\Upload\UploadRequest;
use Illuminate\Http\Request;


class Upload{
    /**
     * @lrd:start
     بارگذاری فایل
     * @lrd:end
     *
     * @LRDparam file
     */
    public function index(UploadRequest $request){

        $request->validated();
        $path = $request->file('file')->store('uploads', 'public');

        $result = [
            'path' => $path
        ];
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }



}
