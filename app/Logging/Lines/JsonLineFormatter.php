<?php
/**
 * JsonLine.php
 * Created On 2020/6/18 2:50 下午
 * Create by Retr0
 */

namespace App\Logging\Lines;

use App\Facades\Json\Json;
use Illuminate\Support\Facades\Request;
use Monolog\Formatter\LineFormatter;
use Monolog\Formatter\NormalizerFormatter;

class JsonLineFormatter extends LineFormatter
{
    /**
     * 格式化
     * @param array $record
     * @return string
     */
    public function format(array $record): string
    {
        $server = Request::server();
        $port = $server['SERVER_PORT'] ?? 80;
        $protocol = $port == 443 ? 'https://' : 'http://';
        $host = $server['HTTP_HOST'] ?? '';
        $uri = $server['REQUEST_URI'] ?? '';
        $referer = $server['HTTP_REFERER'] ?? '';
        $ua = $server['HTTP_USER_AGENT'] ?? '';
        $url = $protocol . $host . $uri;
        $cookies = Json::encode($_COOKIE ?? "");
        $authorization = $server['HTTP_AUTHORIZATION'] ?? '';
        if ($ua === 'Symfony') {
            $url = 'artisan';
            $referer = 'artisan';
            $ua = 'artisan';
        }

        $datetime = date('Y-m-d H:i:s', time());

        $output = '{"app": "%app%", "authorization": "'. $authorization .'", "datetime": "' . $datetime . '", "timestamp": "%datetime%", "url": "' . $url . '", "UA": "' . $ua . '", "referer": "' . $referer . '", "uuid": %uuid%, "domain": "%domain%", "channel": "%channel%", "level": "%level_name%", "message": "%message%", "context": [%context%], "extra": %extra%, "cookies": ' . $cookies . '}' . "\n";
        $vars = (new NormalizerFormatter())->format($record);
        $vars['app'] = config('app.name');
        $vars['channel'] = $vars['context']['channel'] ?? 'local';
        $vars['uuid'] = app('app')->uuid;
        $vars['domain'] = $host;
        foreach ($vars['extra'] as $var => $val) {
            if (false !== strpos($output, '%extra.' . $var . '%')) {
                $output = str_replace('%extra.' . $var . '%', $this->stringify($val), $output);
                unset($vars['extra'][$var]);
            }
        }
        if (isset($vars['context']['exception']) && !empty($vars['context']['exception'])) {
            $vars['context'] = $vars['context']['exception'];
            if (isset($vars['context']['trace'])) {
                unset($vars['context']['trace']);
            }
            if (isset($vars['context']['previous'])) {
                unset($vars['context']['previous']);
            }
        }

        if (false !== strpos($output, '%')) {
            $output = preg_replace('/%(?:extra|context)\..+?%/', '', $output);
        }

        foreach ($vars as $var => $val) {
            if (false !== strpos($output, '%' . $var . '%')) {
                $output = str_replace('%' . $var . '%', $this->stringify($val), $output);
            }
        }
        // remove leftover %extra.xxx% and %context.xxx% if any
        if (false !== strpos($output, '%')) {
            $output = preg_replace('/%(?:extra|context)\..+?%/', '', $output);
        }
        return $output;
    }
}
