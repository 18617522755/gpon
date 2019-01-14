<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    // limit 分页
    protected $limit = '';

    // limit值数组
    protected $limitArray = [];

    // 默认页码
    protected $pageNo = 1;

    // 默认分页大小
    protected $pageSize = 50;

    // 分页大小最小值
    protected $pageSizeMin = 50;

    // 分页大小最大值
    protected $pageSizeMax = 2000;

    // 接口用户信息[object]
    protected $userInfo;

    // 接口权限值
    protected $rightCode = ''; // 默认为空，接口不重写此属性会报错,重写值为 '0'（注意是string） 则说明不需要验证

    // 接口返回字段
    protected $return = ["code" => 0, "msg" => 'success', 'data' => []];

    /**
     * 构造函数用来接受参数，方便使用
     * info-continue: 接口的权限验证也在这里写，如果有接口不需要就可以在子类重写构造函数
     * @param Request $request
     */
    public function __construct(Request $request)
    {
//        // 设置 passport 的地址
//        $this->setUrl();
//
//        // 以数组形式获取全部参数
//        $this->all = $request->all();
//
//        // 获取用户信息
//        $this->userInfo = Auth::guard('api')->user();
//
//        //补充用户信息
//        $this->addUserInfo();
//
//        // 记录日志
//        $this->logRequest($request);
//
//        // 检查接口权限
//        $this->checkAuthority($this->rightCode);
    }

    /**
     * 设置返回信息的公共函数 info-notice: 需要继承 App\Http\Controllers\Controller 类
     * @param int $code | 0 为正确 -1为返回错误
     * @param string $msg | 返回的信息 success 表示成功返回
     * @param array $param | 需要额外增加的字段
     * @return void
     */
    protected function setReturnInfo($code, $msg, array $param = [])
    {
        $this->return = [
            "code" => $code,
            "msg" => $msg,
            "data" => []
        ];
        // 如果第三参不为空 则进行遍历赋值
        if (!empty($param)) {
            foreach ($param as $key => $value) {
                $this->return['data'][$key] = $value;
            }
        }
        // 记录返回参数日志
        Log::info('接口返回数据', $this->return);

        die(json_encode($this->return));
    }

}
