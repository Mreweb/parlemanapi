<?php

namespace App\Http\Controllers\PersonArea\Statement;
use App\Application\Services\PersonArea\Statement\StatementService;
use App\Application\Services\Utility\DBMessageService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PersonArea\Statement\StatementRequest;
use App\Http\Requests\PersonArea\Statement\StatementUpdateRequest;
use Illuminate\Http\Request;

class StatementController extends Controller{

    public function __construct(private StatementService $service) {}

    /**
     * @lrd:start
     * فهرست بیانیه ها
     *
     * statement_subject موضوع بیانیه
     *
     *  statement_president_id شناسه رئیس جمهور
     *
     *  statement_gov_period_id شماره دولت
     *
     *  statement_parliament_period_id دوره مجلس
     *
     * @lrd:end
     * @LRDparam statement_subject string
     * @LRDparam statement_president_id string
     * @LRDparam statement_gov_period_id string
     * @LRDparam statement_parliament_period_id string
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
     * نمایش بیانیه
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
     * افزودن بیانیه
     *
     *  statement_person_id شخصی که بیانیه دهنده بوده
     *
     *  statement_president_id در کدام شخص ریاست جمهوری بیانیه داده شده
     *
     *  statement_gov_period_id در کدام دوره دولت
     *
     *  statement_parliament_period_id در کدام دوره مجلس
     *
     *  statement_meeting اجلاسیه
     *
     *  statement_type نوع بیانیه
     *
     *  statement_reading_date تاریخ قرائت
     *
     *  statement_public_court_reading_date تاریخ قرائت در صحن
     *
     *  statement_register_number شماره ثبت
     *
     *   statement_session_number شماره جلسه علنی صحن مجلس
     *
     *   statement_subject عنوان بیانیه
     *
     *   statement_summary چکیده بیانیه
     *
     *   statement_to_person_id مخاطب بیانیه
     *
     *   statement_ministry_id دستگاه بیانیه
     *
     *   statement_designer_person_id طراح بیانیه
     *
     *   statement_to_person_actions چکیده اقدامات دستگاه مخاطب بیانیه
     *
     *   statement_signature_person_ids آرایه افراد امضا گنندگان بیانیه
     *
     *   attachments آرایه ای از پیوست ها
     *
     * @lrd:end
     */
    public function store(StatementRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * ویرایش بیانیه
     * @lrd:end
     */
    public function update(StatementUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * حذف بیانیه
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }

}
