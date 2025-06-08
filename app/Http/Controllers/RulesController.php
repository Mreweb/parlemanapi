<?php

namespace App\Http\Controllers;
use App\Application\Services\DBMessageService;
use App\Application\Services\RulesService;
use App\Http\Requests\Rules\RulesRequest;
use App\Http\Requests\Rules\RulesUpdateRequest;
use Illuminate\Http\Request;

class RulesController extends Controller{

    public function __construct(private RulesService $service) {}

    /**
     * @lrd:start
     * فهرست قانون ها
     *
     * @lrd:end
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
     * نمایش قانون
     * @lrd:end
     */
    public function show($id){
        $result = $this->service->get($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @lrd:start
     * افزودن قانون
     *
     *  rule_preparation مقدمات قانون
     *
     *  rule_executive_branch قواعد روابط شعبه اجرایی
     *
     *  rule_history سوابق قبلی
     *
     *  rule_approve_date تاریخ تصویب
     *
     *  rule_president_notification_number شماره ابلاغ رئیس جمهور
     *
     *  rule_president_notification_date تاریخ ابلاغ رئیس جمهور
     *
     *  rule_person_id نماینده درخواست کننده
     *
     *  rule_president_id رئیس جمهور
     *
     *  rule_gov_period_id شماره دولت
     *
     *  rule_parliament_period_id دوره مجلس
     *
     * @lrd:end
     */

    public function store(RulesRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * ویرایش قانون
     * @lrd:end
     */
    public function update(RulesUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * حذف قانون
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }

}
