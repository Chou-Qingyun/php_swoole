<?php 
//连接swoole tcp服务
$client = new Swoole\Client(SWOOLE_SOCK_TCP);

if (!$client->connect('127.0.0.1', 9501)) {
    echo "连接失败" . PHP_EOL;
    exit;
}
// php cli
fwrite(STDOUT, "请输入消息：");
$msg = trim(fgets(STDIN));

$client->send($msg);

$result = $client->recv();
echo $result;
