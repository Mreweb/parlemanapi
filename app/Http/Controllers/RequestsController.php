<?php

namespace App\Http\Controllers;
use App\Application\Services\DBMessageService;
use App\Application\Services\RequestsService;
use App\Http\Requests\Requests\RequestsRequest;
use App\Http\Requests\Requests\RequestsTrackRequest;
use App\Http\Requests\Requests\RequestsUpdateRequest;
use App\Http\Requests\Requests\RequestsUpdateTrackRequest;
use Illuminate\Http\Request;

class RequestsController extends Controller{

    public function __construct(private RequestsService $service) {}

    /**
     * @lrd:start
     * فهرست درخواست ها
     *
     * request_title محور سوال
     *
     *  request_president_id شناسه رئیس جمهور
     *
     *  request_gov_period_id	 شماره دولت
     *
     *  request_parliament_period_id دوره مجلس
     *
     * @lrd:end
     * @LRDparam request_title string
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
     * نمایش درخواست
     * @lrd:end
     */
    public function show($id){
        $result = $this->service->get($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @lrd:start
     * افزودن درخواست
     *
     *  request_title عنوان درخواست
     *
     *  request_date تاریخ درخواست
     *
     *  request_place مکان درخواست
     *
     *  request_phone تلفن تماس
     *
     *  request_description شرح درخواست
     *
     *  request_command دستور لازم
     *
     *  request_serial شماره درخواست
     *
     *  request_person_id نماینده درخواست کننده
     *
     *  request_president_id رئیس جمهور
     *
     *  request_gov_period_id شماره دولت
     *
     *  request_parliament_period_id دوره مجلس
     *
     * @lrd:end
     */

    public function store(RequestsRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * ویرایش درخواست
     * @lrd:end
     */
    public function update(RequestsUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * حذف درخواست
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }


    /**
     * @lrd:start
     * افزودن پیگیری درخواست
     *
     *  request_id عنوان درخواست
     *
     *  request_commission_title ارجا به مبادی ذیربط
     *
     *  request_subject_title سوابق موضوع
     *
     *  request_subject_description شرح پیگیری
     *
     *  request_subject_result نتیجه نهایی
     *
     * @lrd:end
     */

    public function add_track(RequestsTrackRequest $request){
        $result = $this->service->add_track($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * ویرایش پیگیری درخواست
     * @lrd:end
     */
    public function update_track(RequestsUpdateTrackRequest $request){
        $result = $this->service->update_track($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * حذف پیگیری درخواست
     * @lrd:end
     */
    public function delete_track($id){
        $result = $this->service->delete_track($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }

}
