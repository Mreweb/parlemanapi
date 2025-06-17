<?php

namespace App\Http\Controllers;

use App\Application\Services\DBMessageService;
use App\Application\Services\PersonService;
use App\Http\Requests\Person\PersonCommissionRequest;
use App\Http\Requests\Person\PersonElectionRequest;
use App\Http\Requests\Person\PersonRequest;
use App\Http\Requests\Person\PersonUpdateRequest;
use App\Http\Requests\Person\PersonFractionRequest;
use Illuminate\Http\Request;

class PersonController extends Controller{

    public function __construct(private PersonService $service) {}

    /**
     * @lrd:start
     * فهرست کاربران
     * @lrd:end
     * @LRDparam person_national_code string
     * @LRDparam person_phone string
     * @LRDparam person_last_name string
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
     * نمایش کاربران
     * @lrd:end
     */
    public function show($id){
        if(!is_numeric($id)){
            return response()->json( DBMessageService::get_message(null,'ErrorAction') , 400, [], JSON_UNESCAPED_UNICODE);
        }
        $result = $this->service->get($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @lrd:start
     * نمایش تمامی اطلاعات کاربر
     * @lrd:end
     */
    public function get_all_info($id){
        if(!is_numeric($id)){
            return response()->json( DBMessageService::get_message(null,'ErrorAction') , 400, [], JSON_UNESCAPED_UNICODE);
        }
        $result = $this->service->get_all_info($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @lrd:start
     * افزودن کاربران
     * @lrd:end
     */
    public function store(PersonRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * ویرایش کاربران
     * @lrd:end
     */
    public function update(PersonUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * حذف کاربران
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }


    /**
     * @lrd:start
     * افزودن فراکسیون
     * @lrd:end
     */
    public function update_fraction(PersonFractionRequest $request){
        $result = $this->service->update_fraction($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * @lrd:start
     * افزودن حوزه انتخابیه
     * @lrd:end
     */
    public function update_election(PersonElectionRequest $request){
        $result = $this->service->update_election($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * افزودن کمیسیون
     * @lrd:end
     */
    public function update_commission(PersonCommissionRequest $request){
        $result = $this->service->update_commission($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }


}
