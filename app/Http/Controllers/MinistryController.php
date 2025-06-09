<?php

namespace App\Http\Controllers;
use App\Application\Services\DBMessageService;
use App\Application\Services\MinistryService;
use App\Http\Requests\Ministry\MinistryRequest;
use App\Http\Requests\Ministry\MinistryUpdateRequest;
use Illuminate\Http\Request;

class MinistryController extends Controller{

    public function __construct(private MinistryService $service) {}

    /**
     * @lrd:start
     * فهرست وزارتخانه
     * @lrd:end
     * @LRDparam ministry_name string
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
     * ویرایش وزارتخانه
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
     * ذخیره وزارتخانه
     * @lrd:end
     */
    public function store(MinistryRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * @lrd:start
     * ویرایش وزارتخانه
     * @lrd:end
     */
    public function update(MinistryUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * @lrd:start
     * حذف وزارتخانه
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }

}
