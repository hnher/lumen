<?php

namespace App\Modules\NSQ;

use App\Exceptions\NSQ\NSQConnectException;
use App\Facades\Log\Log;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class NSQ
{
    /**
     * 推送消息到 NSQ 队列
     * @param array $message
     * @param string $topic
     * @param int $delay
     * @param string $unit
     * @return bool
     * @throws NSQConnectException
     */
    public function pub(array $message, string $topic, int $delay = 0, string $unit = 's'): bool
    {
        //此处设置延迟时间
        if ($delay > 0 && $unit === 's') {
            $delay = $delay * 1000;
        }
        //设置推送的url
        $url = vsprintf('http://' . $this->getNode() . '/pub?topic=%s&defer=%s', [$topic, $delay]);

        $response = Http::post($url, $message)->body();
        Log::info('发送到队列结果为', ['nsq' => $response]);
        return $response === 'OK';
    }

    /**
     * 随机获取节点地址
     * @return string
     * @throws NSQConnectException
     */
    private function getNode(): string
    {
        //随机从任意服务发现中拿到节点地址
        $response = Http::get(Arr::random(config('nsq.lookupd')) . '/nodes');

        if ($response->status() !== 200) {
            throw new NSQConnectException();
        }

        $data = collect($response->json()['producers']);
        $client = collect($data->random());

        return $client->get('broadcast_address') . ':' . $client->get('http_port');
    }
}
