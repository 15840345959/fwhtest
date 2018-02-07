<?php
/**
 * 首页控制器
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/20 0020
 * Time: 20:15
 */

namespace App\Http\Controllers\Web;

use App\Components\ADManager;
use App\Components\QNManager;
use App\Libs\CommonUtils;
use App\Models\AD;
use Illuminate\Http\Request;
use App\Libs\ServerUtils;
use App\Components\RequestValidator;
use Illuminate\Support\Facades\Redirect;


class IndexController
{

    //首页
    public function wxPage(Request $request)
    {
//        dd($request->all());
        $app = app('wechat.official_account');
        $wx_config = $app->jssdk->buildConfig(array('onMenuShareQQ', 'onMenuShareWeibo'), true);

//        dd($wx_config);

        return view('wxPage.index.index', ['wx_config' => $wx_config]);
    }

    /*
     * 第三方微信登录接口
     *
     *
     */
    public function webLogin()
    {
        Log::info('webLogin request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $app = app('wechat.open_platform');

        $app->server->push(function ($message) {
            Log::info(\GuzzleHttp\json_encode($message));
            return "web登录！";
        });

        return view('web.my.index', []);
    }

}