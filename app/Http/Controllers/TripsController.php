<?php

namespace App\Http\Controllers;
use App\Application\Services\DBMessageService;
use App\Application\Services\TripService;
use App\Http\Requests\Trip\TripActionRequest;
use App\Http\Requests\Trip\TripActionUpdateRequest;
use App\Http\Requests\Trip\TripApprovalRequest;
use App\Http\Requests\Trip\TripApprovalUpdateRequest;
use App\Http\Requests\Trip\TripRequest;
use App\Http\Requests\Trip\TripUpdateRequest;
use Illuminate\Http\Request;

class TripsController extends Controller{

    public function __construct(private TripService $service) {}

    /**
     * @lrd:start
     * فهرست سفر ها
     *
     * @lrd:end
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
     * نمایش سفر
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
     * افزودن سفر
     *
     *  trip_president_id  رئیس جمهور
     *
     *  trip_person_id شناسه نماینده
     *
     *  trip_gov_period_id شماره دولت
     *
     *  trip_parliament_period_id شماره مجلس
     *
     *  trip_start_date تاریخ شروع سفر
     *
     *  trip_end_date تاریخ پایان سفر
     *
     *  trip_province_id استان مقصد
     *
     *  trip_description توضیحات
     *
     *  trip_subject موضوع سفر
     *
     * @lrd:end
     */

    public function store(TripRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * ویرایش سفر
     * @lrd:end
     */
    public function update(TripUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * حذف سفر
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @lrd:start
     *  افزودن مصوبات سفر
     * @lrd:end
     */
    public function add_approval(TripApprovalRequest $request){
        $result = $this->service->add_approval($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     *   ویرایش مصوبات سفر
     * @lrd:end
     */
    public function update_approval(TripApprovalUpdateRequest $request){
        $result = $this->service->update_approval($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }


    /**
     * @lrd:start
     *  افزودن اقدامات سفر
     * @lrd:end
     */
    public function add_action(TripActionRequest $request){
        $result = $this->service->add_action($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     *   ویرایش اقدامات سفر
     * @lrd:end
     */
    public function update_action(TripActionUpdateRequest $request){
        $result = $this->service->update_action($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

}
