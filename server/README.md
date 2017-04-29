#说明文档

###httpServer
http服务器跟fpm和apache很像，只是去包含documentRoot中的php文件，没有带有任何额外功能。
####命令
```sh
sudo /usr/local/php/bin/php httpServer.php start|stop|reload
```



###appServer
AppServer就是Swoole的内置应用服务器，你需要安装Swoole Web框架的规范来写代码，所以应用程序的代码都在apps/目录中。 URL会路由到Controller的方法中，数据库的处理使用Swoole框架提供的Model或者SelectDB，模板使用smarty引擎或者直接使用php作为模板。
具体的代码可以参考 apps/下的php文件。

使用AppServer启动后，程序会直接读取 apps/controllers 中的控制器代码，不会使用index.php作为入口。

####命令
```sh
sudo /usr/local/php/bin/php appServer.php start|stop|reload
```

###websocketServer

####命令
```sh
sudo /usr/local/php/bin/php websocketServer.php
```

####测试socket
```sh
sudo /usr/local/php/bin/php websocketClientAsync.php
sudo /usr/local/php/bin/php websocketClientSync.php 
telnet 127.0.0.1 9443
```
```javascript
var wsServer = 'ws://127.0.0.1:9443';
var websocket = new WebSocket(wsServer); 
websocket.onopen = function (evt) { 
	console.log("Connected to WebSocket server.");
}; 

websocket.onclose = function (evt) { 
	console.log("Disconnected"); 
}; 

websocket.onmessage = function (evt) { 
	console.log('Retrieved data from server: ' + evt.data); 
}; 

websocket.onerror = function (evt, e) {
	console.log('Error occured: ' + evt.data);
};
websocket.send('{"url":"Home\/test","sendData":{"kk":"value"}}');
```

socket发送消息格式:
```json
{
  'url':'home/index',
  'sendData':{
    'userName':'test',
  },
}
```
