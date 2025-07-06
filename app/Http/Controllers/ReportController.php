<?php

namespace App\Http\Controllers;
use App\Application\Services\DBMessageService;
use App\Application\Services\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller{

    public function __construct(private ReportService $service) {}

    /**
     * @lrd:start
     * جستجو آمار با تعداد برای هر فرد و بر اساس استان
     *
     * @lrd:end
     * @LRDparam person_id integer
     * @LRDparam province_id integer
     */

    public function data_count(Request $request){
        $filters = $request->all();
        $result = $this->service->data_count($filters);
        return response()->json( DBMessageService::get_message($result) , 201, [], JSON_UNESCAPED_UNICODE);
    }


}
