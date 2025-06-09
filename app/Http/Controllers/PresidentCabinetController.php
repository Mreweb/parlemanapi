<?php

namespace App\Http\Controllers;
use App\Application\Services\DBMessageService;
use App\Application\Services\PresidentCabinetService;
use App\Http\Requests\PresidentCabinet\PresidentCabinetRequest;
use App\Http\Requests\PresidentCabinet\PresidentCabinetUpdateRequest;
use Illuminate\Http\Request;

class PresidentCabinetController extends Controller{

    public function __construct(private PresidentCabinetService $service) {}

    /**
     * @lrd:start
     *  فهرست کابینه
     * @lrd:end
     */
    public function index(Request $request){
        $filters = $request->all();
        $result = $this->service->list($filters);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }
    /**
     * @lrd:start
     * نمایش کابینه
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
     * افزودن کابینه
     * @lrd:end
     */
    public function store(PresidentCabinetRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * ویرایش کابینه
     * @lrd:end
     */
    public function update(PresidentCabinetUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * حذف کابینه
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }

}
