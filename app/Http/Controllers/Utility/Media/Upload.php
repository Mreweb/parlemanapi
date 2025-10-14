<?php

namespace App\Http\Controllers\Utility\Media;
use App\Application\Services\Utility\DBMessageService;
use App\Application\Services\Utility\Media\UploadService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Utility\Media\Upload\UploadRequest;
use Illuminate\Support\Str;

class Upload extends Controller {


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
            'attachment_id' => Str::uuid()->toString(),
            'attachment_title' => $request->get('title'),
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
