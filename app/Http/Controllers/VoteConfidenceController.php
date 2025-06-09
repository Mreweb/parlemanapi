<?php

namespace App\Http\Controllers;
use App\Application\Services\DBMessageService;
use App\Application\Services\VoteConfidenceService;
use App\Http\Requests\VoteConfidence\VoteConfidenceRequest;
use App\Http\Requests\VoteConfidence\VoteConfidenceUpdateRequest;
use Illuminate\Http\Request;

class VoteConfidenceController extends Controller{

    public function __construct(private VoteConfidenceService $service) {}

    /**
     * @lrd:start
     * فهرست آرا اعتماد
     * @lrd:end
     * @LRDparam vote_confidence_president_id string
     * @LRDparam vote_confidence_gov_period_id string
     * @LRDparam vote_confidence_parliament_period_id string
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
     * نمایش آرا اعتماد
     * @lrd:end
     */
    public function show($id){
        $result = $this->service->get($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @lrd:start
     * افزودن آرا اعتماد
     *
     *  vote_confidence_president_id رئیس جمهور
     *
     *  vote_confidence_person_id شخصی که از او استیضاح شده
     *
     *  vote_confidence_gov_period_id دشماره دولت
     *
     *  vote_confidence_parliament_period_id در کدام دوره مجلس
     *
     *  vote_confidence_meeting اجلاسیه
     *
     *  vote_confidence_register_number شماره ثبت
     *
     *  vote_confidence_commission_id	کمیسیون تخصصی
     *
     *  vote_confidence_commission_meeting_date تاریج جلسه کمیسیون
     *
     *  vote_confidence_commission_report گزارش کمیسیون در صحن
     *
     *  vote_confidence_public_court_date تاریخ بررسی در صحن علنی
     *
     *  vote_confidence_public_parliament_session_number شماره جلسه صحن علنی
     *
     *  vote_confidence_public_parliament_check_result نتیجه بررسی در صحن علنی
     *
     *  vote_confidence_ministry_person_name نام وزیر پیشنهادی
     *
     *  vote_confidence_ministry_id نام وزارتخانه
     *
     *  vote_confidence_action_summary چکیده اقدامات دستگاه مخاطب
     *
     *   vote_confidence_president_contents_summary چکیده مطالب رئیس جمهور
     *
     *   vote_confidence_contents_summary نچکیده مطالب وزیر مورد رای اعتماد
     *
     *   vote_confidence_supporters_summary چکیده مطالب موافقین رای اعتماد
     *
     *   vote_confidence_opposing_summary چکیده مطالب مخالفین رای اعتماد
     *
     *   vote_confidence_opposing_person_ids  نمایندگان موافق رای اعتماد
     *
     *   vote_confidence_supporters_person_id نمایندگان مخالف رای اعتماد
     *
     * @lrd:end
     */
    public function store(VoteConfidenceRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * ویرایش آرا اعتماد
     * @lrd:end
     */
    public function update(VoteConfidenceUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * حذف آرا اعتماد
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }

}
