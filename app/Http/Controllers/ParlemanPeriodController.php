<?php

namespace App\Http\Controllers;
use App\Application\Services\DBMessageService;
use App\Application\Services\ParlemanPeriodService;
use App\Http\Requests\ParlemanPeriod\ParlemanPeriodRequest;
use App\Http\Requests\ParlemanPeriod\ParlemanPeriodUpdateRequest;
use Illuminate\Http\Request;

class ParlemanPeriodController extends Controller{

    public function __construct(private ParlemanPeriodService $service) {}


    /**
     * @lrd:start
     * فهرست دوره های مجلس
     * @lrd:end
     * @LRDparam period_title string
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
     * نمایش دوره های مجلس
     * @lrd:end
     */
    public function show($id){
        $result = $this->service->get($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }


    /**
     * @lrd:start
     * حذف دوره های مجلس
     * @lrd:end
     */
    public function store(ParlemanPeriodRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * @lrd:start
     * ویرایش دوره های مجلس
     * @lrd:end
     */
    public function update(ParlemanPeriodUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * @lrd:start
     * حذف دوره های مجلس
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }

}
