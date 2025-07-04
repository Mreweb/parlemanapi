<?php

namespace App\Http\Controllers;
use App\Application\Services\DBMessageService;
use App\Application\Services\MediaDeputyGovernorService;
use App\Http\Requests\MediaDeputyGovernor\MediaDeputyGovernorActionRequest;
use App\Http\Requests\MediaDeputyGovernor\MediaDeputyGovernorActionUpdateRequest;
use App\Http\Requests\MediaDeputyGovernor\MediaDeputyGovernorApprovalRequest;
use App\Http\Requests\MediaDeputyGovernor\MediaDeputyGovernorApprovalUpdateRequest;
use App\Http\Requests\MediaDeputyGovernor\MediaDeputyGovernorRequest;
use App\Http\Requests\MediaDeputyGovernor\MediaDeputyGovernorUpdateRequest;
use Illuminate\Http\Request;

class MediaDeputyGovernorController extends Controller{

    public function __construct(private MediaDeputyGovernorService $service) {}

    /**
     * @lrd:start
     * فهرست نشست رسانه ها
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
     * نمایش نشست رسانه
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
      افزودن نشست رسانه
     *
     *  media_president_id  رئیس جمهور
     *
     *  media_person_id شناسه نماینده
     *
     *  media_gov_period_id شماره دولت
     *
     *  media_parliament_period_id شماره مجلس
     *
     *  media_start_date تاریخ شروع سفر
     *
     *  media_end_date تاریخ پایان سفر
     *
     *  media_province_id استان مقصد
     *
     *  media_description توضیحات
     *
     *  media_subject موضوع سفر
     *
     * @lrd:end
     */

    public function store(MediaDeputyGovernorRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * ویرایش نشست رسانه
     * @lrd:end
     */
    public function update(MediaDeputyGovernorUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * حذف نشست رسانه
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @lrd:start
     *  افزودن مصوبات نشست رسانه
     * @lrd:end
     */
    public function add_approval(MediaDeputyGovernorApprovalRequest $request){
        $result = $this->service->add_approval($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     *   ویرایش مصوبات نشست رسانه
     * @lrd:end
     */
    public function update_approval(MediaDeputyGovernorApprovalUpdateRequest $request){
        $result = $this->service->update_approval($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }


    /**
     * @lrd:start
     *  افزودن اقدامات نشست رسانه
     * @lrd:end
     */
    public function add_action(MediaDeputyGovernorActionRequest $request){
        $result = $this->service->add_action($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     *   ویرایش اقدامات نشست رسانه
     * @lrd:end
     */
    public function update_action(MediaDeputyGovernorActionUpdateRequest $request){
        $result = $this->service->update_action($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

}
