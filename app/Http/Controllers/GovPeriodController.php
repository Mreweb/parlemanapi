<?php

namespace App\Http\Controllers;
use App\Application\Services\DBMessageService;
use App\Application\Services\GovPeriodService;
use App\Http\Requests\GovPeriod\GovPeriodRequest;
use App\Http\Requests\GovPeriod\GovPeriodUpdateRequest;
use Illuminate\Http\Request;

class GovPeriodController extends Controller{

    public function __construct(private GovPeriodService $service) {}

    /**
     * @lrd:start
     * فهرست دوره ریاست جمهوری
     * @lrd:end
     * @LRDparam gov_period_name string
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
     * نمایش دوره ریاست جمهوری
     * @lrd:end
     */
    public function show($id){
        $result = $this->service->get($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @lrd:start
     * افزودن دوره ریاست جمهوری
     * @lrd:end
     */
    public function store(GovPeriodRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * ویرایش دوره ریاست جمهوری
     * @lrd:end
     */
    public function update(GovPeriodUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * حذف دوره ریاست جمهوری
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }

}
