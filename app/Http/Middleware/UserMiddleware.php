<?php
/**
 * UserMiddleware.php
 * Created On 2020/7/21 5:08 下午
 * Create by Retr0
 */

namespace App\Http\Middleware;

use App\Cache\UserCache;
use App\Facades\Json\Json;
use Closure;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (empty($token)) {
            $token = $request->input('token');
        }

        $user = UserCache::getUserToken($token);

        app('app')->user = Json::decode($user);

        return $next($request);
    }
}
