<?php

namespace App\Http\Controllers;
use App\Application\Services\DBMessageService;
use App\Application\Services\InterpellationService;
use App\Http\Requests\Interpellations\InterpellationRequest;
use App\Http\Requests\Interpellations\InterpellationUpdateRequest;
use Illuminate\Http\Request;

class InterpellationController extends Controller{

    public function __construct(private InterpellationService $service) {}

    /**
     * @lrd:start
     * فهرست استیضاح ها
     *
     * interpellation_axis محور استیضاح
     *
     * @lrd:end
     * @LRDparam interpellation_axis string
     */

    public function index(Request $request){
        $filters = $request->all();
        $result = $this->service->list($filters);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }
    /**
     * @lrd:start
     * نمایش استیضاح
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
     * افزودن استیضاح
     *
     *  interpellation_president_id رئیس جمهور
     *
     *  interpellation_person_id شخصی که از او استیضاح شده
     *
     *  interpellation_gov_period_id شماره دولت
     *
     *  interpellation_parliament_period_id در کدام دوره مجلس
     *
     *  interpellation_meeting اجلاسیه
     *
     *  interpellation_register_number شماره ثبت
     *
     *  interpellation_axis محور استیضاح
     *
     *  interpellation_summary چکیده استیضاح
     *
     *  interpellation_worksheet_media_id  کاربرگ استیضاح
     *
     *  interpellation_correspondence_worksheet_media_id مکاتبات مجلس با دولت
     *
     *  interpellation_commission_id کمیسیون تخصصی
     *
     *  interpellation_commission_meeting_date مخاطب تذکر
     *
     *  interpellation_commission_result کمیسیون تخصصی
     *
     *  interpellation_receipt_date تاریج جلسه کمیسیون
     *
     *  interpellation_public_court_date تاریخ بررسی در صحن علنی
     *
     *  interpellation_public_parliament_session_number شماره جلسه صحن علنی
     *
     *  interpellation_public_parliament_check_result نتیجه بررسی در صحن علنی
     *
     *  interpellation_parliament_correspondence مکاتبات مجلس و دولت در استیضاح
     *
     *  interpellation_audience مخاطب استیضاح
     *
     *  interpellation_designer نام نماینده طراح استیضاح
     *
     *  interpellation_action_summary چکیده اقدامات دستگاه مخاطب
     *
     *  interpellation_contents_summary چکیده مطالب استیضاح کنندگان
     *
     *  interpellation_president_contents_summary چکیده مطالب رئیس جمهور
     *
     *  interpellation_supporters_contents_summary چکیده مطالب موافقین استیضاح
     *
     *  interpellation_opponents_contents_summary چکیده مطالب مخالفین استیضاح
     *
     *  interpellation_governors_opinion نظر استانداران در رصد آراء نمایندگان
     *
     *  interpellation_governors_actions اقدامات استانداران در رفع استیضاح
     *
     *  interpellation_deputies_actions اقدامات معاونین امور مجلس در رفع استیضاح
     *
     *  interpellations_opposing_person_ids نمایندگان مخالف استیضاح
     *
     *  interpellation_supporters_person_ids نمایندگان موافق استیضاح
     *
     *  interpellation_opt_person_ids نمایندگان انصراف دهنده
     *
     *  interpellation_return_opt_person_ids نمایندگان انصراف دهنده از انصراف
     *
     *  interpellation_signatures_person_ids نمایندگان انصراف دهنده از انصراف
     *
     * @lrd:end
     */
    public function store(InterpellationRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * ویرایش استیضاح
     * @lrd:end
     */
    public function update(InterpellationUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * حذف استیضاح
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }

}
