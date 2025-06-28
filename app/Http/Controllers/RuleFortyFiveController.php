<?php

namespace App\Http\Controllers;
use App\Application\Services\DBMessageService;
use App\Application\Services\RuleFortyFiveService;
use App\Http\Requests\RuleFortyFive\RuleFortyFiveRequest;
use App\Http\Requests\RuleFortyFive\RuleFortyFiveUpdateRequest;
use App\Http\Requests\RuleTTF\RuleTTFRequest;
use App\Http\Requests\RuleTTF\RuleTTFUpdateRequest;
use Illuminate\Http\Request;

class RuleFortyFiveController extends Controller{

    public function __construct(private RuleFortyFiveService $service) {}

    /**
     * @lrd:start
     * فهرست ماده 45
     * @lrd:end
     * @LRDparam rule_forty_five_president_id string
     * @LRDparam rule_forty_five_gov_period_id string
     * @LRDparam rule_forty_five_parliament_period_id string
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
     * نمایش ماده 45
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
     * افزودن ماده 45
     *
     *  rule_forty_five_president_id رئیس جمهور
     *
     *  rule_forty_five_person_id نام نمیانده متقاضی
     *
     *  rule_forty_five_gov_period_id دشماره دولت
     *
     *  rule_forty_five_parliament_period_id در کدام دوره مجلس
     *
     *  rule_forty_five_meeting اجلاسیه
     *
     *  rule_forty_five_register_number شماره ثبت
     *
     *  rule_forty_five_subject	موضوع درخواست
     *
     *  rule_forty_five_summary چکیده موضوع
     *
     *  rule_forty_five_worksheet_id کاربرگ
     *
     *  rule_forty_five_commission_id کمیسیون تخصصی
     *
     *  rule_forty_five_commission_result  نتیجه در کمیسیون تخصصی
     *
     *  rule_forty_five_commission_content  چکیده گزارش دستگاه در کمیسیون تخصصی
     *
     *   rule_forty_five_public_parliament_session_number  شماره جلسه صحن علنی
     *
     *  rule_forty_five_public_court_date تاریخ بررسی در صحن علنی
     *
     *  rule_forty_five_public_parliament_check_result  نتیجه در صحن علنی
     *
     *  rule_forty_five_public_parliament_content  چکیده گزارش  در صحن علنی
     *
     *  rule_forty_five_ministry_id دستگاه ذیربط
     *
     *   rule_forty_five_summary_content  چکیده اقدامات دستگاه مخاطب
     *
     *   rule_forty_five_signatures_person_ids  نمایندگان مخالف رای اعتماد
     *
     * @lrd:end
     */
    public function store(RuleFortyFiveRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * ویرایش ماده 45
     * @lrd:end
     */
    public function update(RuleFortyFiveUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * حذف ماده 45
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }

}
