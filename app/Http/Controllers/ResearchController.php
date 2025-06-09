<?php

namespace App\Http\Controllers;
use App\Application\Services\DBMessageService;
use App\Application\Services\PersonResearchService;
use App\Http\Requests\Research\ResearchRequest;
use App\Http\Requests\Research\ResearchUpdateRequest;
use Illuminate\Http\Request;

class ResearchController extends Controller{

    public function __construct(private PersonResearchService $service) {}

    /**
     * @lrd:start
     * فهرست آرا اعتماد
     * @lrd:end
     * @LRDparam person_research_president_id string
     * @LRDparam person_research_gov_period_id string
     * @LRDparam person_research_parliament_period_id string
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
     * نمایش تحقیق و تفحص
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
     * افزودن تحقیق و تفحص
     *
     *  person_research_president_id رئیس جمهور
     *
     *  person_research_person_id شخصی که از او استیضاح شده
     *
     *  person_research_gov_period_id دشماره دولت
     *
     *  person_research_parliament_period_id در کدام دوره مجلس
     *
     *  person_research_meeting اجلاسیه
     *
     *  person_research_register_number شماره ثبت
     *
     *  person_research_register_date تاریخ ثبت
     *
     *  person_research_subject	موضوع تحقیق
     *
     *  person_research_summary	چکیده تحقیق
     *
     *  person_research_worksheet_media_id	کاربرگ تحقیق
     *
     *  person_research_commission_id	کمیسیون تخصصی
     *
     *  person_research_commission_result	نتیجه در کمیسیون تخصصی
     *
     *  person_research_commission_number	شماره جلسه صحن علنی
     *
     *  person_research_public_court_date	تاریخ طرح در صحن علنی
     *
     *  person_research_public_court_result		نتیجه طرح در صحن علنی
     *
     *  person_research_team_result	نتیجه نهایی هیأت تحقیق و تفحص
     *
     *  person_research_team_result_ministry_id	دستگاه ذیربط
     *
     *  person_research_contents_summary	چکیده اقدامات دستگاه مخاطب
     *
     *  person_research_team_person_ids آرایه افراد حاضر در تیم تحقیق  و تفحص
     *
     *  person_research_signatures_person_ids آرایه افراد  حمایت کنندگاه تحقیق
     *
     * @lrd:end
     */
    public function store(ResearchRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * ویرایش تحقیق و تفحص
     * @lrd:end
     */
    public function update(ResearchUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * حذف تحقیق و تفحص
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }

}
