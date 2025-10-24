<?php

namespace App\Http\Controllers\PersonArea\Notice;
use App\Application\Services\PersonArea\Notice\NoticeService;
use App\Application\Services\Utility\DBMessageService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PersonArea\Notice\NoticeRequest;
use App\Http\Requests\PersonArea\Notice\NoticeUpdateRequest;
use Illuminate\Http\Request;

class NoticeController extends Controller{

    public function __construct(private NoticeService $service) {}

    /**
     * @lrd:start
     * فهرست تذکر ها
     *
     * notice_subject موضوع تذکر
     *
     *  notice_president_id شناسه رئیس جمهور
     *
     *  notice_gov_period_id شماره دولت
     *
     *  notice_parliament_period_id دوره مجلس
     *
     * @lrd:end
     * @LRDparam notice_subject string
     * @LRDparam notice_president_id string
     * @LRDparam notice_gov_period_id string
     * @LRDparam notice_parliament_period_id string
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
     * نمایش تذکر
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
     * افزودن تذکر
     *
     *  notice_person_id شخصی که تذکر دهنده بوده
     *
     *  notice_president_id در کدام شخص ریاست جمهوری تذکر داده شده
     *
     *  notice_gov_period_id در کدام دوره دولت
     *
     *  notice_parliament_period_id در کدام دوره مجلس
     *
     *  notice_meeting اجلاسیه
     *
     *  notice_type نوع تذکر
     *
     *  notice_reading_date تاریخ قرائت
     *
     *  notice_public_court_reading_date تاریخ قرائت در صحن
     *
     *  notice_register_number شماره ثبت
     *
     *   notice_session_number شماره جلسه علنی صحن مجلس
     *
     *   notice_subject عنوان تذکر
     *
     *   notice_summary چکیده تذکر
     *
     *   notice_to_person_id مخاطب تذکر
     *
     *   notice_ministry_id دستگاه تذکر
     *
     *   notice_designer_person_id طراح تذکر
     *
     *   notice_to_person_actions چکیده اقدامات دستگاه مخاطب تذکر
     *
     *   notice_signature_person_ids آرایه افراد امضا گنندگان تذکر
     *
     *   attachments آرایه ای از پیوست ها
     *
     * @lrd:end
     */
    public function store(NoticeRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * ویرایش تذکر
     * @lrd:end
     */
    public function update(NoticeUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * حذف تذکر
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }

}
