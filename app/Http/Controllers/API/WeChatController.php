<?php
/**
 * File_Name:TestController.php
 * Author: leek
 * Date: 2017/9/26
 * Time: 11:19
 */

namespace App\Http\Controllers\API;

use App\Components\TestManager;
use App\Http\Controllers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Components\RequestValidator;
use Illuminate\Support\Facades\Log;


class WeChatController extends Controller
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $app = app('wechat.official_account');

        $app->server->push(function ($message) {

            Log::info(\GuzzleHttp\json_encode($message));


            switch ($message['MsgType']) {
                case 'event':
                    return '收到事件消息';
                    break;
                case 'text':
                    return '收到文字消息';
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                // ... 其它消息
                default:
                    return '收到其它消息';
                    break;
            }
        });
        $response = $app->server->serve();
        return $response;
    }


    //发送模板消息
    public function sendTemplateMessage()
    {
        $app = app('wechat.official_account');

        $app->template_message->send([
            'touser' => 'onrxSszCPDlGBJanfjURTQHMIamE',
            'template_id' => 'IuMgI8WdRtLe4bOPLzwQlFjuaAcAK8hDp2yWwq0DCGc',
            'url' => 'https://easywechat.org',
            'data' => [
                'first' => '测试消息',
                'keyword1' => '测试消息',
                'keyword2' => '测试消息',
                'keyword3' => '测试消息',
                'keyword4' => '测试消息',
                'remark' => '请注意预约时间'
            ],
        ]);
        $response = $app->server->serve();
        return $response;
    }

    /*
     * 测试菜单相关
     *
     * By TerryQi
     *
     * 2018-03-01
     */
    public function setMenu()
    {
        $app = app('wechat.official_account');
        $buttons = [
            [
                "type" => "click",
                "name" => "今日歌曲",
                "key" => "V1001_TODAY_MUSIC"
            ],
            [
                "name" => "菜单",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "搜索",
                        "url" => "http://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "视频",
                        "url" => "http://v.qq.com/"
                    ],
                    [
                        "type" => "click",
                        "name" => "赞一下我们",
                        "key" => "V1001_GOOD"
                    ],
                ],
            ],
        ];
        $app->menu->create($buttons);

        $list = $app->menu->list();

        return $list;
    }


    //根据openid获取unionid
    public function getUserInfo()
    {
        $app = app('wechat.official_account');
        $user = $app->user->get("onrxSszCPDlGBJanfjURTQHMIamE");
        return ApiResponse::makeResponse(true, $user, ApiResponse::SUCCESS_CODE);

    }
}