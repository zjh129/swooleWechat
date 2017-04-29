#swooleWechat
使用swoole framework搭建一个微信服务号接口开发项目，其中使用了EasyWeChat微信开源项目

本项目使用swoole framework官方框架开发.
框架项目地址：(https://github.com/swoole/framework)
Swoole IDE智能提示
----
```shell
https://github.com/eaglewu/swoole-ide-helper
```

[框架介绍](https://github.com/swoole/framework)

> HttpServer和AppServer虽然可以直接访问，但是还是要配合nginx或apache，请求静态文件是由Nginx/Apache直接处理，当请求的文件不存在时，发送给Swoole服务器，来进行处理。

HttpServer的使用方法
----
http服务器跟fpm和apache很像，只是去包含documentRoot中的php文件，没有带有任何额外功能。
与appServer.php不同，httpServer.php是没有携带任何Swoole Web框架功能的。
```shell
php server/httpServer.php
```

HttpClient的使用方法
----
类似于curl、file_get_contents等方法，http请求客户端
```shell
php server/httpClient.php
```

AppServer的使用方法
----
AppServer就是Swoole的内置应用服务器，你需要按照Swoole Web框架的规范来写代码，所以应用程序的代码都在apps/目录中。
URL会路由到Controller的方法中，数据库的处理使用Swoole框架提供的Model或者SelectDB，模板使用smarty引擎或者直接使用php作为模板。
```shell
php server/appServer.php
```


EventWorkerServer的使用方法
----
EventWorkerServer是做事件触发功能,可做异步执行脚本。
数据处理脚本如下：
事件定义脚本：/apps/events/*.php
事件执行脚本：/apps/classes/Handler/*.php
此功能的好处可以项目中耗时的工作放到这里处理，在一定程度上可以代替常用的队列消息管理器。
```shell
php server/eventWorkersServer.php//启动事件触发功能
php server/eventWorkersClient.php//触发事件
```