<?php

namespace App\Http\Controllers;

use App\Application\Services\CityService;
use App\Application\Services\DBMessageService;
use App\Http\Requests\City\CityRequest;
use App\Http\Requests\City\CityUpdateRequest;
use Illuminate\Http\Request;


class CityController extends Controller{


    public function __construct(private CityService $service) {}

    /**
     * @lrd:start
     * فهرست شهرها
     * @lrd:end
     * @LRDparam province_id integer
     * @LRDparam city_name string
     * @LRDparam page_index integer
     * @LRDparam page_size integer
     */
    public function index(Request $request){
        $filters = $request->all();
        $result = $this->service->list($filters);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @lrd:start
     * نمایش شهر
     * @lrd:end
     */
    public function show($id){
        if(!is_numeric($id)){
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"فرمت شناسه نامعتبر است" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
        $result = $this->service->get($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }


    /**
     * @lrd:start
     * افزودن شهر
     *
     * city_name نام شهر
     *
     * city_province_id شناسه استان شهر
     *
     * @lrd:end
     */
    public function store(CityRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * @lrd:start
     * بروزرسانی شهر
     * @lrd:end
     */
    public function update(CityUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * @lrd:start
     * حذف شهر
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }

}
