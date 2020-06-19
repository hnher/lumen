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

## 使用

```bash
composer create-project hnher/lumen LumenApp
```

## 延时任务

延时任务基于阿里云 RocketMQ 和 pm2 搭建。RocketMQ 作为消息传递、pm2 作为进程守护

### 服务器需求

1. 阿里云 RocketMQ
2. pm2

### 编写任务消息实例

```php
namespace App\Modules\Scheduler\Messages;


class TestMessage extends Message
{
    public function __construct(string $cmd = 'Scheduler:Test', array $params = [], string $key = '', int $delay = 10)
    {
        parent::__construct($cmd, $params, $key, $delay);
    }
}
```

### 发送延时任务消息

可以在代码任何地方使用 Scheduler 门面的 sendMessage 方法发送消息实例

```php
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
        $res = Scheduler::sendMessage(new TestMessage());

        dd($res);
    }
}
```

### 消费任务消息

可以在 ecosystem.config.js 文件中指定运行实例和其他配置，也可以继承 ConsumerCommand 自定义消费

```bash
pm2 start ecosystem.config.js
```

Good Luck

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
