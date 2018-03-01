<?php
/**
 * 首页控制器
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/20 0020
 * Time: 20:15
 */

namespace App\Http\Controllers\Web;

use App\Components\Utils;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;


class IndexController
{

    //首页
    public function wxPage(Request $request)
    {
//        dd($request->all());
        $app = app('wechat.official_account');
        $wx_config = $app->jssdk->buildConfig(array('onMenuShareTimeline', 'onMenuShareQQ', 'onMenuShareWeibo'), true);

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

    /*
     * 网页授权
     *
     * By TerryQi
     *
     * 2018-02-23
     *
     */
    public function webAuth(Request $request)
    {

    }


    /*
     * 测试cookie
     *
     * By TerryQI
     *
     * 2018-02-23
     */
    public function testCookie(Request $request)
    {

        $user = $request->cookie('user');

        if (Utils::isObjNull($user)) {

            $user = Cookie::make('user', 'TerryQi', 30);
            Response::make()->withCookie($user);

//            dd("cookie is null");
//            $user = Cookie::forever('user', 'TerryQi');
////            Response::make()->withCookie($user);
//            response()->withCookie($user);
//            dd("has set cookie");
        }
        dd($user);
    }
}