<?php

namespace App\Http\Controllers\PersonArea\Enactment;
use App\Application\Services\PersonArea\Enactment\EnactmentService;
use App\Application\Services\Utility\DBMessageService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PersonArea\Enactment\EnactmentRequest;
use App\Http\Requests\PersonArea\Enactment\EnactmentUpdateRequest;
use Illuminate\Http\Request;

class EnactmentController extends Controller{

    public function __construct(private EnactmentService $service) {}

    /**
     * @lrd:start
     * فهرست لایحه ها
     *
     * enactment_title محور سوال
     *
     *  enactment_president_id شناسه رئیس جمهور
     *
     *  enactment_gov_period_id شماره دولت
     *
     *  enactment_parliament_period_id دوره مجلس
     *
     * @lrd:end
     * @LRDparam enactment_title string
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
     * نمایش لایحه
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
     * افزودن لایحه
     *
     *  enactment_title عنوان لایحه
     *
     *  enactment_content متن لایحه
     *
     *  enactment_prev_title عنوان قبل
     *
     *  enactment_date  تاریخ اعلام وصول
     *
     *  enactment_president_id رئیس جمهور
     *
     *  enactment_gov_period_id شماره دولت
     *
     *  enactment_parliament_period_id شماره مجلس
     *
     *  enactment_president_letter_number شماره نامه رئیس جمهور به مجلس
     *
     *  enactment_president_letter_date تاریخ نامه رئیس جمهور به مجلس
     *
     *  enactment_president_deputy_letter_number	معاون رئیس جمهور به مجلس
     *
     *  enactment_president_deputy_letter_date تاریخ نامه معاون رئیس جمهور به مجلس
     *
     *  enactment_priority نحوه اعلام وصول
     *
     *  enactment_register_number شماره ثبت
     *
     *  enactment_print_number شماره چاپ
     *
     *  enactment_print_date تاریخ چاپ
     *
     *  enactment_prev_register_number شماره ثبت قبلی
     *
     *  enactment_period دوره
     *
     *  enactment_print_date تاریخ چاپ
     *
     *  enactment_print_date تاریخ چاپ
     *
     *  enactment_print_date تاریخ چاپ
     *
     *  main_commission کمسیسون های اصلی
     *
     *  sub_commission کمیسیون های فرعی
     *
     *  ministry_signatures وزرای امضا کننده
     *
     *  type نوع درخواست
     *
     *  bill_85_review بررسی لایحه طبق اصل 85 قانون اساسی
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
     *  attachments آرایه ای از پیوست ها
     *
     * @lrd:end
     */

    public function store(EnactmentRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * ویرایش لایحه
     * @lrd:end
     */
    public function update(EnactmentUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * حذف لایحه
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }

}
