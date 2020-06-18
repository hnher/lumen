<?php
/**
 * Http.php
 * Created On 2020/4/9 10:48 上午
 * Create by Retr0
 */

namespace App\Facades\Http;

use App\Modules\Http\Client\Factory;
use Illuminate\Support\Facades\Facade;
/**
 * @method static \App\Modules\Http\Client\PendingRequest asJson()
 * @method static \App\Modules\Http\Client\PendingRequest asForm()
 * @method static \App\Modules\Http\Client\PendingRequest attach(string $name, string $contents, string|null $filename = null, array $headers)
 * @method static \App\Modules\Http\Client\PendingRequest asMultipart()
 * @method static \App\Modules\Http\Client\PendingRequest bodyFormat(string $format)
 * @method static \App\Modules\Http\Client\PendingRequest contentType(string $contentType)
 * @method static \App\Modules\Http\Client\PendingRequest acceptJson()
 * @method static \App\Modules\Http\Client\PendingRequest accept(string $contentType)
 * @method static \App\Modules\Http\Client\PendingRequest retry(int $times, int $sleep = 0)
 * @method static \App\Modules\Http\Client\PendingRequest withHeaders(array $headers)
 * @method static \App\Modules\Http\Client\PendingRequest withBasicAuth(string $username, string $password)
 * @method static \App\Modules\Http\Client\PendingRequest withDigestAuth(string $username, string $password)
 * @method static \App\Modules\Http\Client\PendingRequest withToken(string $token, string $type = 'Bearer')
 * @method static \App\Modules\Http\Client\PendingRequest withCookies(array $cookies, string $domain)
 * @method static \App\Modules\Http\Client\PendingRequest withoutRedirecting()
 * @method static \App\Modules\Http\Client\PendingRequest withoutVerifying()
 * @method static \App\Modules\Http\Client\PendingRequest timeout(int $seconds)
 * @method static \App\Modules\Http\Client\PendingRequest withOptions(array $options)
 * @method static \App\Modules\Http\Client\PendingRequest beforeSending(callable $callback)
 * @method static \App\Modules\Http\Client\Response get(string $url, array $query = [])
 * @method static \App\Modules\Http\Client\Response post(string $url, array $data = [])
 * @method static \App\Modules\Http\Client\Response patch(string $url, array $data = [])
 * @method static \App\Modules\Http\Client\Response put(string $url, array $data = [])
 * @method static \App\Modules\Http\Client\Response delete(string $url, array $data = [])
 * @method static \App\Modules\Http\Client\Response send(string $method, string $url, array $options = [])
 * @method static \App\Modules\Http\Client\PendingRequest stub(callable $callback)
 * @method static \App\Modules\Http\Client\ResponseSequence fakeSequence(string $urlPattern = '*')
 *
 * @see \App\Modules\Http\Client\Factory
 */
class Http extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Factory::class;
    }
}
