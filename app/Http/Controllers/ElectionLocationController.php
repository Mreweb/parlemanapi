<?php

namespace App\Http\Controllers;
use App\Application\Services\DBMessageService;
use App\Application\Services\ElectionLocationService;
use App\Http\Requests\ElectionLocation\ElectionLocationRequest;
use App\Http\Requests\ElectionLocation\ElectionLocationUpdateRequest;
use Illuminate\Http\Request;

class ElectionLocationController extends Controller{

    public function __construct(private ElectionLocationService $service) {}


    /**
     * @lrd:start
     * فهرست حوزه انتخابیه
     * @lrd:end
     * @LRDparam province_id integer
     * @LRDparam election_location_title string
     * @LRDparam page_index integer
     * @LRDparam page_size integer
     *
     */
    public function index(Request $request){
        $filters = $request->all();
        $result = $this->service->list($filters);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }
    /**
     * @lrd:start
     * نمایش حوزه انتخابیه
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
     * ثبت حوزه انتخابیه
     *
     * election_location_title عنوان
     *
     * election_location_province_id استان حوزه
     *
     * election_location_cities شهر بصورت آرایه عددی
     * @lrd:end
     */
    public function store(ElectionLocationRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * فهرست همه
     * @lrd:end
     */
    public function all(){
        $result = $this->service->all();
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }
    /**
     * @lrd:start
     * ویرایش حوزه انتخابیه
     * @lrd:end
     */
    public function update(ElectionLocationUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    /**
     * @lrd:start
     * حذف حوزه انتخابیه
     * @lrd:end
     */
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }

}
