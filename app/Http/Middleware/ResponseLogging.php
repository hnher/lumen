<?php
/**
 * ApplicationLogging.php
 * Created On 2020/6/18 4:22 下午
 * Create by Retr0
 */

namespace App\Http\Middleware;

use App\Facades\Json\Json;
use Closure;
use Illuminate\Support\Facades\Log;

/**
 * Class ApplicationLogging
 * 应用程序请求日志
 * 如果启用则会记录每一次的请求内容和响应内容
 * @package App\Http\Middleware
 * Module retr
 */
class ResponseLogging
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $responseData = [
            'params' => $request->all(),
            'response' => Json::decode($response->getContent() ?? "{}") ?? []
        ];

        Log::channel('response')->info('请求日志', $responseData);

        return $response;
    }
}
