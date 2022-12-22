<?php

namespace App\Console\Commands\NSQ;

use Amp\Loop;
use App\Facades\Json\Json;
use App\Facades\Log\Log;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Nsq\Lookup;
use Nsq\Message;

class NSQConsumerCommand extends Command
{
    protected $signature = 'nsq:consumer {topic}';

    protected $name = 'NSQ 消费者进程';

    protected $description = '用于启动 NSQ 消费者';

    public function handle()
    {
        $topic = $this->argument('topic');
        Loop::run(function () use ($topic) {
            $lookup = Lookup::create(config('nsq.lookupd'));
            $lookup->subscribe($topic, 'command', function (Message $message) {
                $body = collect(Json::decode($message->body));
                Log::info('接收到来自 NSQ 的消息', [
                    'id' => $message->id,
                    'body' => $body->toArray(),
                    'timestamp' => $message->timestamp,
                    'attempts' => $message->attempts,
                ]);

                try {
                    Artisan::call($body->get('command'), $body->get('params', []));
                } catch (Exception $e) {
                    Log::error('命令执行失败', ['body' => $body->toArray(), 'code' => $e->getCode(), 'message' => $e->getMessage()]);
                    yield $message->finish();
                    return;
                }

                //将消息设置为完成
                yield $message->finish();
            });
        });
    }
}
