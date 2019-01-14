<?php

namespace App\Http\Controllers\Gpon;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TestController extends Controller {

    function index(){

        $result=DB::table('gpon_user_list')->first();
        $result=json_decode(json_encode($result),true);

        $this->setReturnInfo(0,'success',$result);

    }

}