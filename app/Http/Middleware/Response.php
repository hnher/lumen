<?php
/**
 * 用于将所有响应 JSON 格式化
 * Response.php
 * Created On 2020/2/17 5:29 下午
 * Create by retr
 */

namespace App\Http\Middleware;

use App\Constants\ErrorConstant;
use App\Http\Resources\JsonResource;
use Exception as BaseException;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use stdClass;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Response
{
    private int $timer;

    public function __construct()
    {
        $this->timer = time();
    }

    //设置排除的路由 例如：/api/*
    //设置后则不会被格式化
    protected array $except = [
        '/notify/*'
    ];

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);

        //此处排除特定路由不格式化输出
        if ($this->inExceptArray($request)) {
            return $response;
        }

        $data = [
            'code' => $response->getStatusCode(),
            'message' => 'ok',
            'time' => $this->timer,
            'dateTime' => date('Y-m-d H:i:s', $this->timer),
            'data' => new stdClass()
        ];
        $exception = $response->exception;
        //异常单独处理
        if ($exception !== null) {
            /**
             * 此处处理 HTTP 异常
             * 如 404 ， 403 ，500
             */
            if ($exception instanceof HttpException) {
                $data['code'] = $response->getStatusCode();
                $data['message'] = ErrorConstant::HTTP_ERROR[$response->getStatusCode()] ?? HttpResponse::$statusTexts[$response->getStatusCode()];
                $response->setContent($data);
                //此处必须提前 return 因为所有的异常类均继承 Exception 类
                return $response;
            }

            /**
             * 此处处理自定义异常
             */
            if ($exception instanceof BaseException) {
                $data['code'] = $exception->getCode();
                $data['message'] = $exception->getMessage();
                $response->setContent($data);
                return $response;
            }
        } else {

            //此处用于处理验证器异常
            if ($response->getStatusCode() == 422) {
                $data['message'] = ErrorConstant::HTTP_ERROR[$response->getStatusCode()] ?? HttpResponse::$statusTexts[$response->getStatusCode()];
                $data['data'] = ['validators' => json_decode($response->getContent())];
                $response->setContent(json_encode($data, true));
                return $response;
            }

            //如果是空字符则格式化为对象型
            if (empty($response->original)) {
                $data['data'] = new stdClass();
                $response->setContent($data);
                return $response;
            }
            if (gettype($response->original) == 'boolean') {
                $data['data'] = ['status' => $response->original];
            }
            //返回字符串型格式化
            if (gettype($response->original) == 'string') {
                $data['data'] = ['body' => $response->original];
            }
            if ($response->original instanceof LengthAwarePaginator) {
                $data['data']= [
                    'currentPage' => $response->original->currentPage(),
                    'items' => JsonResource::collection($response->original->items()),
                    'lastPage' => $response->original->lastPage()
                ];
            }
            //数组处理，此处仅对一位数组进行处理
            if (gettype($response->original) == 'array') {
                $data['data'] = $response->original;
                if (!empty($response->original[0])) {
                    $data['data'] = ['items' => $response->original];
                }
            }
            //集合处理
            if (gettype($response->original) == 'object' && $response->original instanceof Collection) {
                $data['data'] = ['items' => JsonResource::collection($response->original)];
            }
            //模型处理
            if ($response->original instanceof Model) {
                $data['data'] = JsonResource::make($response->original);
            }

            $response->setContent($data);
        }

        return $response;
    }

    protected function inExceptArray($request): bool
    {
        foreach ($this->except as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->fullUrlIs($except) || $request->is($except)) {
                return true;
            }
        }

        return false;
    }
}
