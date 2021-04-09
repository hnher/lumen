<?php
/**
 * logging.php
 * Created On 2020/6/18 2:39 下午
 * Create by Retr0
 */

return [
    'default' => env('LOG_CHANNEL', 'app'),
    'channels' => [
        //如果需要可以在此处定义多个通道处理不同的日志
        'app' => [
            // 日志驱动模式：
            'driver' => 'daily',
            'tap' => [App\Logging\JsonFormatter::class],
            // 日志存放路径
            'path' => storage_path('logs/' . env('APP_NAME') . '.log'),
            // 日志等级：
            'level' => 'info',
            // 日志分片周期，多少天一个文件
            'days' => 30
        ],

        //响应日志通道
        'response' => [
            // 日志驱动模式：
            'driver' => 'daily',
            'tap' => [App\Logging\JsonFormatter::class],
            // 日志存放路径
            'path' => storage_path('logs/response.log'),
            // 日志等级：
            'level' => 'info',
            // 日志分片周期，多少天一个文件
            'days' => 1
        ]
    ]
];
