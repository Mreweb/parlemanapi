<?php

namespace App\Http\Controllers;
use App\Application\Services\DBMessageService;
use App\Application\Services\QuestionService;
use App\Http\Requests\Question\QuestionRequest;
use App\Http\Requests\Question\QuestionUpdateRequest;
use Illuminate\Http\Request;

class QuestionController extends Controller{

    public function __construct(private QuestionService $service) {}

    /**
     * @lrd:start
     * فهرست تذکر ها
     *
     * question_subject محور سوال
     *
     *  question_president_id شناسه رئیس جمهور
     *
     *  question_gov_period_id شماره دولت
     *
     *  question_parliament_period_id دوره مجلس
     *
     * @lrd:end
     * @LRDparam question_subject string
     * @LRDparam question_president_id string
     * @LRDparam question_gov_period_id string
     * @LRDparam question_parliament_period_id string
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
     * نمایش سوال
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
     * افزودن سوال
     *
     *  question_person_id شخصی که تذکر دهنده بوده
     *
     *  question_president_id در کدام شخص ریاست جمهوری تذکر داده شده
     *
     *  question_gov_period_id در کدام دوره دولت
     *
     *  question_parliament_period_id در کدام دوره مجلس
     *
     *  question_meeting اجلاسیه
     *
     *  question_reading_date تاریخ قرائت
     *
     *  question_register_number شماره ثبت
     *
     *  question_check_public_parliament_number شماره جلسه علنی صحن مجلس
     *
     *  question_subject عنوان تذکر
     *
     *  question_summary چکیده تذکر
     *
     *  question_worksheet_media_id فایل کاربرگ تذکر
     *
     *  question_to_person_id مخاطب تذکر
     *
     *  question_commission_id کمیسیون تخصصی
     *
     *  question_commission_session_date تاریخ جلسه کمیسیون
     *
     *  question_commission_session_result	نتیجه بررسی در کمیسیون
     *
     *  question_commission_receipt_date تاریخ اعلام وصول
     *
     *  question_check_public_parliament_date تاریخ بررسی در صحن علنی
     *
     *  question_check_public_parliament_result نتیجه بررسی در صحن علنی
     *
     *  question_answer_media_id فایل پاسخ سوال
     *
     *  question_to_person_actions چکیده اقدامات دستگاه مخاطب سوال
     *
     *  question_signature_person_ids آرایه افراد امضا گنندگان سوال
     *
     * @lrd:end
     */
    public function store(QuestionRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * ویرایش سوال
     * @lrd:end
     */
    public function update(QuestionUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * حذف سوال
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }

}
