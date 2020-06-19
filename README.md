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

### 延时任务
```bash
//启动任务消费者
pm2 start ecosystem.config.js
```

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
