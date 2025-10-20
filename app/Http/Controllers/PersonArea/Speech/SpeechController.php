<?php

namespace App\Http\Controllers\PersonArea\Speech;
use App\Application\Services\PersonArea\Speech\SpeechService;
use App\Application\Services\Utility\DBMessageService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PersonArea\Speech\SpeechRequest;
use App\Http\Requests\PersonArea\Speech\SpeechUpdateRequest;
use Illuminate\Http\Request;

class SpeechController extends Controller{

    public function __construct(private SpeechService $service) {}

    /**
     * @lrd:start
     * فهرست نطق_ ها
     *
     * speech_subject موضوع نطق_
     *
     *  speech_president_id شناسه رئیس جمهور
     *
     *  speech_gov_period_id شماره دولت
     *
     *  speech_parliament_period_id دوره مجلس
     *
     * @lrd:end
     * @LRDparam speech_subject string
     * @LRDparam speech_president_id string
     * @LRDparam speech_gov_period_id string
     * @LRDparam speech_parliament_period_id string
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
     * نمایش نطق_
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
     * افزودن نطق_
     *
     *  speech_person_id شخصی که نطق_ دهنده بوده
     *
     *  speech_president_id در کدام شخص ریاست جمهوری نطق_ داده شده
     *
     *  speech_gov_period_id در کدام دوره دولت
     *
     *  speech_parliament_period_id در کدام دوره مجلس
     *
     *  speech_meeting اجلاسیه
     *
     *  speech_type نوع نطق_
     *
     *  speech_reading_date تاریخ قرائت
     *
     *  speech_public_court_reading_date تاریخ قرائت در صحن
     *
     *  speech_register_number شماره ثبت
     *
     *   speech_session_number شماره جلسه علنی صحن مجلس
     *
     *   speech_subject عنوان نطق_
     *
     *   speech_summary چکیده نطق_
     *
     *   speech_to_person_id مخاطب نطق_
     *
     *   speech_ministry_id دستگاه نطق_
     *
     *   speech_designer_person_id طراح نطق_
     *
     *   speech_to_person_actions چکیده اقدامات دستگاه مخاطب نطق_
     *
     *   speech_signature_person_ids آرایه افراد امضا گنندگان نطق_
     *
     *   attachments آرایه ای از پیوست ها
     *
     * @lrd:end
     */
    public function store(SpeechRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * ویرایش نطق_
     * @lrd:end
     */
    public function update(SpeechUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * حذف نطق_
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }

}
