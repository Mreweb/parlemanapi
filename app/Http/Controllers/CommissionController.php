<?php

namespace App\Http\Controllers;
use App\Application\Services\CommissionService;
use App\Application\Services\DBMessageService;
use App\Http\Requests\Commission\CommissionRequest;
use App\Http\Requests\Commission\CommissionUpdateRequest;
use Illuminate\Http\Request;

class CommissionController extends Controller{

    public function __construct(private CommissionService $service) {}

    /**
     * @LRDparam commission_name string
     */
    public function index(Request $request){
        $filters = $request->only(['commission_name']);
        $perPage = $request->get('per_page', 10);
        $result = $this->service->list($filters, $perPage);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }
    public function show($id){
        $result = $this->service->get($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }

    public function store(CommissionRequest $request){
        $result = $this->service->create($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    public function update(CommissionUpdateRequest $request){
        $result = $this->service->update($request->validated());
        if($result){
            return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json( DBMessageService::get_message(null,'ErrorAction',"عملیات با خطا مواجه شد" ) , 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    public function destroy($id){
        $result = $this->service->delete($id);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);

    }

}
