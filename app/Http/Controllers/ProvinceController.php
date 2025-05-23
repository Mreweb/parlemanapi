<?php

namespace App\Http\Controllers;

use App\Application\Services\DBMessageService;
use App\Application\Services\ProvinceService;
use App\Http\Requests\Province\ProvinceRequest;
use App\Http\Requests\Province\ProvinceUpdateRequest;
use Illuminate\Http\Request;

class ProvinceController extends Controller{

    public function __construct(private ProvinceService $service) {}

    /**
     * @LRDparam province_id string
     * @LRDparam province_name string
     */
    public function index(Request $request){
        $filters = $request->only(['province_id', 'province_name']);
        $perPage = $request->get('per_page', 10);
        $result = $this->service->list($filters, $perPage);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }
    public function show($id){
        $result = $this->service->get($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }
    public function cities($id){
        $result = $this->service->get_cities($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }


    public function store(ProvinceRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    public function update(ProvinceUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }

}
