<?php

namespace App\Http\Controllers\BossErea\TripDeputy;
use App\Application\Services\BossErea\TripDeputy\TripDeputyGovernorService;
use App\Application\Services\Utility\DBMessageService;
use App\Http\Controllers\Controller;
use App\Http\Requests\BossErea\TripDeputyGovernor\TripDeputyGovernorActionRequest;
use App\Http\Requests\BossErea\TripDeputyGovernor\TripDeputyGovernorActionUpdateRequest;
use App\Http\Requests\BossErea\TripDeputyGovernor\TripDeputyGovernorApprovalRequest;
use App\Http\Requests\BossErea\TripDeputyGovernor\TripDeputyGovernorApprovalUpdateRequest;
use App\Http\Requests\BossErea\TripDeputyGovernor\TripDeputyGovernorRequest;
use App\Http\Requests\BossErea\TripDeputyGovernor\TripDeputyGovernorUpdateRequest;
use Illuminate\Http\Request;

class TripsDeputyGovernorController extends Controller{

    public function __construct(private TripDeputyGovernorService $service) {}

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
      افزودن سفر معاون استان
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

    public function store(TripDeputyGovernorRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * ویرایش سفر معاون استان
     * @lrd:end
     */
    public function update(TripDeputyGovernorUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * حذف سفر معاون استان
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @lrd:start
     *  افزودن مصوبات سفر معاون استان
     * @lrd:end
     */
    public function add_approval(TripDeputyGovernorApprovalRequest $request){
        $result = $this->service->add_approval($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     *   ویرایش مصوبات سفر معاون استان
     * @lrd:end
     */
    public function update_approval(TripDeputyGovernorApprovalUpdateRequest $request){
        $result = $this->service->update_approval($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }


    /**
     * @lrd:start
     *  افزودن اقدامات سفر معاون استان
     * @lrd:end
     */
    public function add_action(TripDeputyGovernorActionRequest $request){
        $result = $this->service->add_action($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     *   ویرایش اقدامات سفر معاون استان
     * @lrd:end
     */
    public function update_action(TripDeputyGovernorActionUpdateRequest $request){
        $result = $this->service->update_action($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

}
