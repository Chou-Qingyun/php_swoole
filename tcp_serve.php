<?php 
$server = new Swoole\Server('127.0.0.1', 9501);

$server->set([
    "reactor_num" => 2,
    "worker_num" => 4,   //进程数  查看进程数的命令：ps aft | grep tcp_server.php
    "max_request"  => 100000
]);

//$fd 客户端连接的唯一标识
//$reactor_id 线程id
$server->on('Connect', function($server, $fd, $reactor_id) {
    echo "Client: Connect. {$fd} ". PHP_EOL;
    echo "线程id：{$reactor_id}". PHP_EOL;
});

$server->on('Receive', function($server, $fd, $from_id, $data) {
    $server->send($fd, "Server: from:{$from_id}：" . $data . PHP_EOL);
});

$server->on('Close', function($server, $fd) {
    echo "Client: Close. \n";
});

$server->start();