<?php

namespace App\Http\Controllers;
use App\Application\Services\DBMessageService;
use App\Application\Services\MeetingDeputyGovernorService;
use App\Http\Requests\MeetingDeputyGovernor\MeetingDeputyGovernorActionRequest;
use App\Http\Requests\MeetingDeputyGovernor\MeetingDeputyGovernorActionUpdateRequest;
use App\Http\Requests\MeetingDeputyGovernor\MeetingDeputyGovernorApprovalRequest;
use App\Http\Requests\MeetingDeputyGovernor\MeetingDeputyGovernorApprovalUpdateRequest;
use App\Http\Requests\MeetingDeputyGovernor\MeetingDeputyGovernorRequest;
use App\Http\Requests\MeetingDeputyGovernor\MeetingDeputyGovernorUpdateRequest;
use Illuminate\Http\Request;

class MeetingDeputyGovernorController extends Controller{

    public function __construct(private MeetingDeputyGovernorService $service) {}

    /**
     * @lrd:start
     * فهرست دیدار با نماینده ها
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
     * نمایش دیدار با نماینده ه
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
      افزودن دیدار با نماینده ه
     *
     *  meeting_president_id  رئیس جمهور
     *
     *  meeting_person_id شناسه نماینده
     *
     *  meeting_gov_period_id شماره دولت
     *
     *  meeting_parliament_period_id شماره مجلس
     *
     *  meeting_start_date تاریخ شروع سفر
     *
     *  meeting_end_date تاریخ پایان سفر
     *
     *  meeting_province_id استان مقصد
     *
     *  meeting_description توضیحات
     *
     *  meeting_subject موضوع سفر
     *
     * @lrd:end
     */

    public function store(MeetingDeputyGovernorRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * ویرایش دیدار با نماینده ه
     * @lrd:end
     */
    public function update(MeetingDeputyGovernorUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * حذف دیدار با نماینده ه
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @lrd:start
     *  افزودن مصوبات دیدار با نماینده ه
     * @lrd:end
     */
    public function add_approval(MeetingDeputyGovernorApprovalRequest $request){
        $result = $this->service->add_approval($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     *   ویرایش مصوبات دیدار با نماینده ه
     * @lrd:end
     */
    public function update_approval(MeetingDeputyGovernorApprovalUpdateRequest $request){
        $result = $this->service->update_approval($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }


    /**
     * @lrd:start
     *  افزودن اقدامات دیدار با نماینده ه
     * @lrd:end
     */
    public function add_action(MeetingDeputyGovernorActionRequest $request){
        $result = $this->service->add_action($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     *   ویرایش اقدامات دیدار با نماینده ه
     * @lrd:end
     */
    public function update_action(MeetingDeputyGovernorActionUpdateRequest $request){
        $result = $this->service->update_action($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

}
