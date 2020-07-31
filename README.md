# Lumen 框架的手脚架

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

简化基于 Lumen 新项目初始化的时间。

## 已完成功能

1. 日志 JSON 化
2. 缓存基类设置
3. 允许跨域请求
4. 统一格式化返回
5. 开启 Cookie 支持
6. Makefile 自动脚本
7. 支持基于 RocketMQ 的秒级延时任务
8. 支持部分微信工具包

## 使用

```bash
composer create-project hnher/lumen LumenApp
```

### 延时任务

延时任务基于阿里云 RocketMQ 和 pm2 搭建。RocketMQ 作为消息传递、pm2 作为进程守护

#### 服务器需求

1. 阿里云 RocketMQ
2. pm2

#### 编写任务消息实例

```php
<?php
namespace App\Modules\Scheduler\Messages;


class TestMessage extends Message
{
    public $cmd = 'Scheduler:Test';

    public function __construct(array $params = [], int $delay = 10, string $key = '')
    {
        parent::__construct($params, $delay, $key);
    }
}
```

#### 发送延时任务消息

可以在代码任何地方使用 Scheduler 门面的 sendMessage 方法发送消息实例

```php
<?php
namespace App\Console\Commands;

use App\Facades\Scheduler\Scheduler;
use App\Modules\Scheduler\Messages\TestMessage;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'Test:Test';

    protected $description = '测试使用脚本';

    /**
     * 业务处理
     */
    public function handle()
    {
        Scheduler::sendMessage(new TestMessage());
    }
}
```

#### 消费任务消息

可以在 ecosystem.config.js 文件中指定运行实例和其他配置，也可以继承 ConsumerCommand 自定义消费

```bash
pm2 start ecosystem.config.js
```

Good Luck

### 格式化返回

您可以直接使用 Response 中间件格式化返回数据格式化后的数据如下所示

```json
{
  "code": 200,
  "message": "ok",
  "time": 1594020021,
  "dateTime": "2020-07-06 15:20:21",
  "data": {
    "datetime": "2020-07-06 15:20:21"
  }
}
```

如果您特定路由需要显示原有的响应信息则可以在 Response 中间件中 $except 属性中排除，例如众多支付回调。

```php
<?php

namespace App\Http\Middleware;

use App\Constants\ErrorConstant;
use Exception as BaseException;
use Closure;
use Illuminate\Http\Response as HttpResponse;
use stdClass;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Response
{
    private $timer = 0;

    public function __construct()
    {
        $this->timer = time();
    }

    //设置排除的路由 例如：/api/*
    //设置后则不会被格式化
    protected $except = [
        '/notify/alipay/*'
    ];
}
```

### 日志 Json 化

对日志进行了 Json 格式化主要为了 ELK 收集比较方便。您依然可以使用如下方式调用

```php
<?php

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        Log::info('测试日志写入', ['name' => '测试']);
    }
}
```

日志输出如下所示

```text
{"datetime": "2020-07-06 15:28:02", "timestamp": "2020-07-06T15:28:02.844005+08:00", "url": "artisan", "UA": "php artisan", "referer": "artisan", "uuid": "uuid:5eb4e2a3-e843-4224-bde3-7fce8008b8b9", "channel": "local", "level": "INFO", "message": "测试日志写入", "c": [{"name":"测试"}], "extra": [], "cookies": []}
```
具体 Json 如下

```json
{
    "datetime": "2020-07-06 15:28:02",
    "timestamp": "2020-07-06T15:28:02.844005+08:00", 
    "url": "artisan", 
    "UA": "php artisan", 
    "referer": "artisan",
    "uuid": "uuid:5eb4e2a3-e843-4224-bde3-7fce8008b8b9", 
    "channel": "local", 
    "level": "INFO", 
    "message": "测试日志写入", 
    "context": [
        {
            "name":"测试"
        }
    ], 
    "extra": [], 
    "cookies": []
}
```

### 跨域支持

Cross 中间件提供跨域支持，已经在全局开启。

### 响应日志

ResponseLogging 中间件提供了所有请求的响应日志记录，已经全局开启。

## 安全性漏洞

如果你发现任何安全性漏洞请发送邮件到 dyy@dyy.name

## License

本项目基于 Lumen 开发遵循 MIT 协议 [MIT license](https://opensource.org/licenses/MIT).
