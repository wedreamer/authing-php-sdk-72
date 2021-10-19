<?php

declare(strict_types=1);
require_once __DIR__ . '../../../vendor/autoload.php';

use Authing\Mgmt\ManagementClient;

// 初始化资源与权限客户端
// 通过用户池 id 与 用户池密码进行初始化
// 通过回调函数进行初始化
// $management = new ManagementClient("5f819ffdaaf252c4df2c9266", "06eca4ed85c807db9fc6a9d5483a4dc7");
$management = new ManagementClient(function ($options) {
    $options->userPoolId = '5f88506c81cd279930195660';
    $options->secret = 'f6bbab3309f021639c6b04d6e54133cd';
    // $options->host = 'http://localhost:3000';
});

// $management->setHost('http://localhost:3000');

$orgManagement = $management->orgs();

$res = $orgManagement->paginate();

var_dump($res);

