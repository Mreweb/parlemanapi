<?php

namespace App\Http\Controllers\PersonArea\Plan;
use App\Application\Services\PersonArea\Plan\PlanService;
use App\Application\Services\Utility\DBMessageService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PersonArea\Plan\PlanRequest;
use App\Http\Requests\PersonArea\Plan\PlanUpdateRequest;
use Illuminate\Http\Request;

class PlanController extends Controller{

    public function __construct(private PlanService $service) {}

    /**
     * @lrd:start
     * فهرست طرح ها
     *
     * plan_title محور سوال
     *
     *  plan_president_id شناسه رئیس جمهور
     *
     *  plan_gov_period_id شماره دولت
     *
     *  plan_parliament_period_id دوره مجلس
     *
     * @lrd:end
     * @LRDparam plan_title string
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
     * نمایش طرح
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
     * افزودن طرح
     *
     *  plan_title عنوان طرح
     *
     *  plan_content متن طرح
     *
     *  plan_prev_title عنوان قبل
     *
     *  plan_date  تاریخ اعلام وصول
     *
     *  plan_president_id رئیس جمهور
     *
     *  plan_gov_period_id شماره دولت
     *
     *  plan_parliament_period_id شماره مجلس
     *
     *  plan_president_letter_number شماره نامه رئیس جمهور به مجلس
     *
     *  plan_president_letter_date تاریخ نامه رئیس جمهور به مجلس
     *
     *  plan_president_deputy_letter_number	معاون رئیس جمهور به مجلس
     *
     *  plan_president_deputy_letter_date تاریخ نامه معاون رئیس جمهور به مجلس
     *
     *  plan_priority نحوه اعلام وصول
     *
     *  plan_register_number شماره ثبت
     *
     *  plan_print_number شماره چاپ
     *
     *  plan_print_date تاریخ چاپ
     *
     *  plan_prev_register_number شماره ثبت قبلی
     *
     *  plan_period دوره
     *
     *  plan_print_date تاریخ چاپ
     *
     *  plan_print_date تاریخ چاپ
     *
     *  plan_print_date تاریخ چاپ
     *
     *  main_commission کمسیسون های اصلی
     *
     *  sub_commission کمیسیون های فرعی
     *
     *  ministry_signatures وزرای امضا کننده
     *
     *  type نوع درخواست
     *
     *  bill_85_review بررسی طرح طبق اصل 85 قانون اساسی
     *
     *  deputy_actions اقدامات معاونت
     *
     *  guardian_council ابلاغ مصوبه به شورای نگهبان
     *
     *  promote_law ابلاغ قانون
     *
     *  workflow_commission فرآیند بررسی در کمیسیون
     *
     *  workflow_public_court فرآیند بررسی در صحن علی مجلس
     *
     *  slience تقاضای مسکوت ماندن
     *
     *  attachments آرایه ای از پیوست ها
     *
     * @lrd:end
     */

    public function store(PlanRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * ویرایش طرح
     * @lrd:end
     */
    public function update(PlanUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * حذف طرح
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }

}
