<?php

namespace App\Http\Controllers;
use App\Application\Services\DBMessageService;
use App\Application\Services\ProjectsService;
use App\Http\Requests\Projects\ProjectsRequest;
use App\Http\Requests\Projects\ProjectsUpdateRequest;
use Illuminate\Http\Request;

class ProjectsController extends Controller{

    public function __construct(private ProjectsService $service) {}

    /**
     * @lrd:start
     * فهرست طرح ها
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
     * @LRDparam project_title string
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
        $result = $this->service->get($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @lrd:start
     * افزودن طرح
     *
     *  project_title شخصی که تذکر دهنده بوده
     *
     *  project_register_number در کدام شخص ریاست جمهوری تذکر داده شده
     *
     *  project_create_date در کدام دوره دولت
     *
     *  project_handle_way در کدام دوره مجلس
     *
     *  project_topic_relevance اجلاسیه
     *
     *  project_government_vote تاریخ قرائت
     *
     *  project_status شماره ثبت
     *
     *  project_end_date شماره جلسه علنی صحن مجلس
     *
     *  project_person_id عنوان تذکر
     *
     *  project_president_id چکیده تذکر
     *
     *  project_gov_period_id فایل کاربرگ تذکر
     *
     *  project_parliament_period_id مخاطب تذکر
     *
     *  person_projects_participation_ids آرایه افراد امضا کننده
     *
     *  person_projects_related_commission_ids آرایه کمیسیون های مرتبط
     *
     *  person_projects_special_commission_ids آرایه کمیسیون های تخصصی
     *
     * @lrd:end
     */

    public function store(ProjectsRequest $request){
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
    public function update(ProjectsUpdateRequest $request){
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
