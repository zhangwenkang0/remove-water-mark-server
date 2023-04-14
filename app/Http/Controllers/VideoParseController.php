<?php

namespace App\Http\Controllers;

require(dirname(__FILE__) . '/../../Services/VideoParse/video_spider.php');

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Services\VideoParse\Video;
use function Sodium\add;


class VideoParseController extends Controller
{
    public function parse(Request $request)
    {
        $request->validate([
            'url' => 'required|string|url'
        ]);

        $user = $request->user();
        $url = $request->input('url');
        Log::info("video-parse|user_id:{$user->id}|{$url}");
        $urlInfo = parse_url($url);
        $host = $urlInfo['host'];

        $domain = implode('.', array_slice(explode('.', $host), -2));

        $api = new Video;
        LOG::info("准备解析:{$domain}");
        $result = Cache::remember(md5($url), 3600, function () use($api, $domain, $url) {
            switch ($domain) {
                //抖音
                case 'douyin.com':
                    $data = $api->douyin($url);
                    break;
                //微视
                case 'qq.com':
                    $data = $api->weishi($url);
                    break;
                //快手
                case 'kuaishou.com':
                case 'chenzhongtech.com':
                case 'kuaishouapp.com':
                    $data =$api->kuaishou($url);
                    break;
                //最右
                case 'xiaochuankeji.cn':
                case 'izuiyou.com':
                    $data = $api->zuiyou($url);
                    break;
                //皮皮虾
                case 'hulushequ.com':
                case 'pipix.com':
                    $data = $api->pipixia($url);
                    break;
                //皮皮搞笑
                case 'ippzone.com':
                    $data =  $api->pipigaoxiao($url);
                    break;
                //火山视频
                case 'huoshan.com':
                    $data =  $api->huoshan($url);
                    break;
                //微博
                case 'weibo.com':
                    $data =  $api->weibo($url);
                    break;
                //bilibili 短链接
                case 'b23.tv':
                    $data =  $api->bilibili($url);
                    break;
                case 'bilibili.com':
                    $data =  $api->bbq($url);
                    break;
                default:
                    abort(Response::HTTP_BAD_REQUEST, '解析失败，请检查地址');

            }
            abort_if(Arr::get($data, 'code') != 200, Response::HTTP_INTERNAL_SERVER_ERROR, '解析失败，请稍后再试');
            return $data;
        });

        Log::debug("------------解析完成-----------");
        Log::debug(json_encode($result));
        if (Arr::get($result, 'code')==200) {
            (new Record)->add($user['id'], $url, $host, $result['data']['url']);
            return response()->json($result);
        } else {
            Cache::forget(md5($url));
            return response()->json(['message' => '转换失败，请检查链接是否有效，或联系客服'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
