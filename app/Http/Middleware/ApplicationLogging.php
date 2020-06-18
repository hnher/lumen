<?php
/**
 * ApplicationLogging.php
 * Created On 2020/6/18 4:22 下午
 * Create by Retr0
 */

namespace App\Http\Middleware;

use App\Facades\Json\Json;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Closure;

class ApplicationLogging
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
            'header' => $request->header(),
            'method' => $request->method(),
            'data' => Json::decode($response->getContent() ?? "{}") ?? []
        ];

        Log::info('请求日志', $responseData);

        return $response;
    }
}
