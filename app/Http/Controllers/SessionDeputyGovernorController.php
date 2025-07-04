<?php

namespace App\Http\Controllers;
use App\Application\Services\DBMessageService;
use App\Application\Services\SessionDeputyGovernorService;
use App\Http\Requests\SessionDeputyGovernor\SessionDeputyGovernorActionRequest;
use App\Http\Requests\SessionDeputyGovernor\SessionDeputyGovernorActionUpdateRequest;
use App\Http\Requests\SessionDeputyGovernor\SessionDeputyGovernorApprovalRequest;
use App\Http\Requests\SessionDeputyGovernor\SessionDeputyGovernorApprovalUpdateRequest;
use App\Http\Requests\SessionDeputyGovernor\SessionDeputyGovernorRequest;
use App\Http\Requests\SessionDeputyGovernor\SessionDeputyGovernorUpdateRequest;
use Illuminate\Http\Request;

class SessionDeputyGovernorController extends Controller{

    public function __construct(private SessionDeputyGovernorService $service) {}

    /**
     * @lrd:start
     * فهرست جلسات با معاونین پارلمان
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
     * نمایش جلسات با معاونین پارلمان
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
      افزودن جلسات با معاونین پارلمان
     *
     *  session_president_id  رئیس جمهور
     *
     *  session_person_id شناسه نماینده
     *
     *  session_gov_period_id شماره دولت
     *
     *  session_parliament_period_id شماره مجلس
     *
     *  session_start_date تاریخ شروع سفر
     *
     *  session_end_date تاریخ پایان سفر
     *
     *  session_province_id استان مقصد
     *
     *  session_description توضیحات
     *
     *  session_subject موضوع سفر
     *
     * @lrd:end
     */

    public function store(SessionDeputyGovernorRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * ویرایش جلسات با معاونین پارلمان
     * @lrd:end
     */
    public function update(SessionDeputyGovernorUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * حذف جلسات با معاونین پارلمان
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @lrd:start
     *  افزودن مصوبات جلسات با معاونین پارلمان
     * @lrd:end
     */
    public function add_approval(SessionDeputyGovernorApprovalRequest $request){
        $result = $this->service->add_approval($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     *   ویرایش جلسات با معاونین پارلمان
     * @lrd:end
     */
    public function update_approval(SessionDeputyGovernorApprovalUpdateRequest $request){
        $result = $this->service->update_approval($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }


    /**
     * @lrd:start
     *  افزودن جلسات با معاونین پارلمان
     * @lrd:end
     */
    public function add_action(SessionDeputyGovernorActionRequest $request){
        $result = $this->service->add_action($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     *   ویرایش جلسات با معاونین پارلمان
     * @lrd:end
     */
    public function update_action(SessionDeputyGovernorActionUpdateRequest $request){
        $result = $this->service->update_action($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

}
