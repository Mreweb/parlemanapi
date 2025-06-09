<?php

namespace App\Http\Controllers;
use App\Application\Services\DBMessageService;
use App\Application\Services\RuleTTFService;
use App\Http\Requests\RuleTTF\RuleTTFRequest;
use App\Http\Requests\RuleTTF\RuleTTFUpdateRequest;
use Illuminate\Http\Request;

class RuleTTFController extends Controller{

    public function __construct(private RuleTTFService $service) {}

    /**
     * @lrd:start
     * فهرست ماده 243
     * @lrd:end
     * @LRDparam rule_ttf_president_id string
     * @LRDparam rule_ttf_gov_period_id string
     * @LRDparam rule_ttf_parliament_period_id string
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
     * نمایش ماده 243
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
     * افزودن ماده 243
     *
     *  rule_ttf_president_id رئیس جمهور
     *
     *  rule_ttf_person_id شخصی که از او استیضاح شده
     *
     *  rule_ttf_gov_period_id دشماره دولت
     *
     *  rule_ttf_parliament_period_id در کدام دوره مجلس
     *
     *  rule_ttf_meeting اجلاسیه
     *
     *  rule_ttf_register_number شماره ثبت
     *
     *  rule_ttf_subject	کمیسیون تخصصی
     *
     *  rule_ttf_summary تاریج جلسه کمیسیون
     *
     *  rule_ttf_worksheet_id گزارش کمیسیون در صحن
     *
     *  rule_ttf_commission_id تاریخ بررسی در صحن علنی
     *
     *  rule_ttf_commission_result شماره جلسه صحن علنی
     *
     *  rule_ttf_public_court_date نتیجه بررسی در صحن علنی
     *
     *  rule_ttf_public_parliament_session_number نام وزیر پیشنهادی
     *
     *  rule_ttf_public_parliament_check_result نام وزارتخانه
     *
     *  rule_ttf_ministry_id چکیده اقدامات دستگاه مخاطب
     *
     *   rule_ttf_summary_content چکیده مطالب رئیس جمهور
     *
     *   rule_ttf_signatures_person_ids  نمایندگان مخالف رای اعتماد
     *
     * @lrd:end
     */
    public function store(RuleTTFRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * ویرایش ماده 243
     * @lrd:end
     */
    public function update(RuleTTFUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * حذف ماده 243
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }

}
